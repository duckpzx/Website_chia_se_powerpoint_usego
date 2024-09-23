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
    }

    public function handleFileUpload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['uploaded_file'])) {
            $file = $_FILES['uploaded_file'];
            if ($file['error'] === UPLOAD_ERR_OK) {
                $inputFilePath = $file['tmp_name'];
                $uploadedFilePath = $this->uploadDir . basename($file['name']);

                // Ensure the upload directory exists
                if (!is_dir($this->uploadDir)) {
                    mkdir($this->uploadDir, 0777, true);
                }

                // Move the uploaded file
                if (move_uploaded_file($inputFilePath, $uploadedFilePath)) {
                    return $this->convertAndProcessFile($uploadedFilePath);
                } else {
                    throw new Exception("Failed.");
                }
            } else {
                throw new Exception("Upload error: " . $file['error']);
            }
        } else {
            throw new Exception("No file uploaded.");
        }
    }

    private function convertAndProcessFile($filePath) {
        $upload = new \ConvertApi\FileUpload($filePath);

        try {
            $result = ConvertApi::convert('png', ['File' => $upload]);
            
            if (!is_dir($this->outputDir)) {
                mkdir($this->outputDir, 0777, true);
            }

            $savedFiles = $result->saveFiles($this->outputDir);

            foreach ($savedFiles as $filePath) {
                $this->addTextToImage($filePath);
            }
            $baseNames = array_map('basename', $savedFiles);
            return ( implode('||', $baseNames) );

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function addTextToImage($filePath) {
        $image = imagecreatefrompng($filePath);
    
        if (!$image) {
            throw new Exception("Failed to create image from file.");
        }
    
        $shadowColor = imagecolorallocate($image, 50, 50, 50); 
        $textColor = imagecolorallocate($image, 255, 255, 255); 
    
        $fontSize = 42;
        $angle = 0;
        $text = 'Coppyright© Usego';
    
        if (!file_exists($this->fontFile)) {
            throw new Exception("Font file not found: " . $this->fontFile);
        }
    
        $textBox = imagettfbbox($fontSize, $angle, $this->fontFile, $text);
        $textWidth = $textBox[2] - $textBox[0];
        $textHeight = $textBox[1] - $textBox[7];
    
        $x = (imagesx($image) - $textWidth) / 2;
        $y = imagesy($image) - 50;
    
        $x = (int)round($x);
        $y = (int)round($y);
    
        $shadowOffset = 3;
        imagettftext($image, $fontSize, $angle, $x + $shadowOffset, $y + $shadowOffset, $shadowColor, $this->fontFile, $text);
    
        imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $this->fontFile, $text);
    
        imagepng($image, $filePath);
        imagedestroy($image);
    }
}
