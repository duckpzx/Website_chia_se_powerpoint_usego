<?php
require_once dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

use ConvertApi\ConvertApi;

class Convert {
    private $apiSecret;
    private $uploadDir;
    private $outputDir;
    private $fontFile;

    public function __construct($apiSecret, $uploadDir, $outputDir, $fontFile) {
        ConvertApi::setApiSecret($apiSecret);
        $this->uploadDir = $uploadDir;
        $this->outputDir = $outputDir;
        $this->fontFile = $fontFile;

        // Ensure the upload and output directories exist
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
        if (!is_dir($this->outputDir)) {
            mkdir($this->outputDir, 0777, true);
        }
    }

    public function handleFileUpload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['uploaded_file'])) {
            $file = $_FILES['uploaded_file'];
            if ($file['error'] === UPLOAD_ERR_OK) {
                $inputFilePath = $file['tmp_name'];
                $uploadedFilePath = $this->uploadDir . basename($file['name']);

                // Move the uploaded file
                if (move_uploaded_file($inputFilePath, $uploadedFilePath)) {
                    return $this->convertAndProcessFile($uploadedFilePath);
                } else {
                    throw new Exception("failed.");
                }
            } else {
                throw new Exception("error: " . $file['error']);
            }
        } else {
            throw new Exception("No file");
        }
    }

    private function convertAndProcessFile( $pathfile ) {
        $upload = new \ConvertApi\FileUpload($pathfile);

        try {
            $result = ConvertApi::convert('png', ['File' => $upload]);
            $savedFiles = $result->saveFiles($this->outputDir);
            foreach ( $savedFiles as $file ) {
                $this->addTextToImage($file);
            }
            return [
                'files' => $pathfile,
                'images' => implode('||', array_map('basename', $savedFiles))
            ];

        } catch (Exception $e) {
            error_log("error: " . $e->getMessage());
            throw new Exception("error");
        }
    }

    private function addTextToImage($file) {
        $image = imagecreatefrompng($file);
    
        if (!$image) {
            throw new Exception("Failed.");
        }
    
        $shadowColor = imagecolorallocate($image, 50, 50, 50); 
        $textColor = imagecolorallocate($image, 255, 255, 255); 
    
        $fontSize = 42;
        $text = 'Copyright © Usego';
    
        if (!file_exists($this->fontFile)) {
            throw new Exception("not found: " . $this->fontFile);
        }

        // Calculate text box and position
        $this->drawText($image, $text, $fontSize, $shadowColor, $textColor);
    
        imagepng($image, $file);
        imagedestroy($image);
    }

    private function drawText($image, $text, $fontSize, $shadowColor, $textColor) {
        $angle = 0;

        $textBox = imagettfbbox($fontSize, $angle, $this->fontFile, $text);
        $textWidth = $textBox[2] - $textBox[0];
        $x = (imagesx($image) - $textWidth) / 2;
        $y = imagesy($image) - 50;
    
        $x = round($x);
        $y = round($y);

        // Draw shadow
        imagettftext($image, $fontSize, $angle, $x + 3, $y + 3, $shadowColor, $this->fontFile, $text);
        // Draw text
        imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $this->fontFile, $text);
    }
}
