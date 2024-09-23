<?php 
    require_once (__DIR__  . "/Shared/General.php");
    require_once (__DIR__  . "/Request.php");
    require_once (__DIR__  . "/bin/Convert.php");

class HandleDataUpload extends General {
    private $file, $fileName, $fileTmp, $fileRamdomString, $userId, 
            $imageUse, $fullname, $describe, 
            $title, $tags,
            $dataImages, $namePowerpoint;
    private $data;
    private $access;
    private $arrayAllPhotos = [];

    public $response, $error;
    public function __construct()
    {
        $this->access = new General;
        $this->userId = $this->access->accessUserId();
    }

    /* Description: When the user uploads a photo, it will 
    query and retrieve only the 3 latest records from the table 'ug_save_old_avatars', */

    public function updateAvatar($inputName, $folder, $typeFile, $changeSize = null, $status = true) 
    {
        // Parameters_1 -> File uploads
        // parameters_3 -> Folder name used to save names
        // Parameters_2 -> State whether you want to save old file memories

        $this->file = $_FILES[ $inputName ];
        $this->fileName = $this->file['name'];
        $this->fileTmp =  $this->file['tmp_name'];

        $this->fileRamdomString = sha1( uniqid() );
        $fileExt = pathinfo( $this->fileName, PATHINFO_EXTENSION );
        $fileNameSeparator = pathinfo( $this->fileName, PATHINFO_FILENAME );
    
        // Result name File 
        $pathFullImage = 'usego_' . $fileNameSeparator . $this->fileRamdomString  .'.'. $fileExt;
        
        if ( $typeFile == 'file' ) 
        { 
            // Type equals file then assign namePpt equals -> nameImageUrl
            $this->namePowerpoint = $pathFullImage;
        } 

        $pathNavigation = _WEB_PATH_UPLOADS . $folder . '/' . $pathFullImage;

        // If it is an image, reduce the size and do not save directly
        if( $changeSize !== null )
        {
            $savedImageOnFolder = $this->resizeAndSaveImage($this->fileTmp, $pathNavigation, $changeSize, $changeSize);
            if( !$savedImageOnFolder )
            {
                $savedImageOnFolder = move_uploaded_file($this->fileTmp, $pathNavigation);
            }
        } else {
            $savedImageOnFolder = move_uploaded_file($this->fileTmp, $pathNavigation);
        }
        
        if( $status === true && $savedImageOnFolder ) 
        {
            $this->oldPhotoSavingActivity( $pathFullImage );
        }
    }    

    private function resizeAndSaveImage( $sourcePath, $destinationPath, $maxWidth, $maxHeight, $quality = 75) 
    {
        // Check if file file exists or not
        if (!file_exists( $sourcePath )) {
            return false;
        }
    
        // Get image size
        list( $sourceWidth, $sourceHeight, $sourceType) = getimagesize($sourcePath );
    
        // Check if there is a valid size
        if ( $sourceWidth <= 0 || $sourceHeight <= 0 ) {
            return false;
        }
    
        // Calculate new size based on scale and size constraints
        $aspectRatio = (int)$sourceWidth / (int)$sourceHeight;
        if ( (int)$maxWidth / (int)$maxHeight > $aspectRatio ) {
            $newWidth = $maxHeight * $aspectRatio;
            $newHeight = $maxHeight;
        } else {
            $newWidth = $maxWidth;
            $newHeight = $maxWidth / $aspectRatio;
        }
    
        // Create a new image with calculated dimensions
        $destinationImage = imagecreatetruecolor($newWidth, $newHeight);
        switch ( $sourceType ) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            case IMAGETYPE_WEBP:
                $sourceImage = imagecreatefromwebp($sourcePath);
                break;
            // Add support for other image types if needed
            default:
                return false;
        }
    
        // Copy and shrink the image
        imagecopyresampled($destinationImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);
    
        // Save thumbnail image
        $success = imagejpeg($destinationImage, $destinationPath, $quality);
    
        // Release memory
        imagedestroy($sourceImage);
        imagedestroy($destinationImage);
    
        return $success;
    }    

    public function oldPhotoSavingActivity( $nameImage )
    {
        $this->data = [
            'avatar' => $nameImage,
            'createAt' => date('y-m-d H:i:s')
        ];

        // Execute update avatar  
        $this->fileUpdateAvatar( $this->data );

        $avatarAvailable_User = $this->fileCountAvatar();
        ( $avatarAvailable_User < 4 ) ? $this->fileSavedAvatar( $nameImage ) : $this->makeChangeAvatar( $nameImage );
        /* 
            If the number is less than 4, save immediately, 
            otherwise delete the oldest record and save
        */
    }

    public function useImageUpdate() 
    {
        // Get id 
        if ( $this->access->attributeEmpty( [ 'avatar' ] ) ) 
        {
            $this->imageUse = $_POST['avatar'];

            $this->data = [
                'avatar' => $this->imageUse,
            ];
            $this->fileUpdateAvatar( $this->data );
        } else 
        {
            $this->error = _on_error;
        }
    }

    /*  when users update fullname and description information */ 

    public function editInformation() 
    {
        // Get id 
        $this->data = [];      
        // Check exists fullname
        if (!empty( $_POST['fullname'] )) 
        {
            $this->fullname = $_POST['fullname'];
            $arrayFullname = explode(' ', $this->fullname);
            $this->data['firstname'] = $arrayFullname[0];
            $this->data['lastname'] = $arrayFullname[1];
        }
        // Check exists describe
        if (!empty( $_POST['describe'] )) 
        {
            $this->describe = $_POST['describe'];
            $this->data['describes'] = nl2br( $this->describe );
        }

        $this->updateInfoUser();
    }

    public function insertFilePowerpoint()
    {
        $this->fileSavedImages();
    }

    private function fileUpdateAvatar( $data ) 
    {
        $query = $this->access->MyModelsCrud->update('ug_users', $data, "id = $this->userId");
        $this->response = ( $query ) ? 'Ảnh đại diện đã được cập nhật.' : _on_error;
    }
    // Update avatar 

    private function makeChangeAvatar($image)
    {
        $this->removeOldAvatar();
        $this->fileSavedAvatar($image);
    }

    private function fileCountAvatar() 
    {
        return $this->access->MyModelsOther->getRows("SELECT userId FROM ug_save_old_avatars 
        WHERE userId = $this->userId");
    }
    // Check the number of avatars in the table

    private function fileSavedAvatar($image) 
    {
        $this->data = [
            'userId' => $this->userId,
            'avatar' => $image,
            'createAt' => date('y-m-d H:i:s')
        ];

        $this->access->MyModelsCrud->insert('ug_save_old_avatars', $this->data);
    }
    // Saved avatar on table 'ug_save_old_avatars'

    private function fileSavedImages() 
    {
        $this->data = [
            'userId' => $this->userId,
            'title' => $this->title,
            'tags' => $this->tags,
            'images' => implode('||', $this->arrayAllPhotos),
            'fileDownload' => $this->namePowerpoint,
            'createAt' => date('y-m-d H:i:s')
        ];

        $query = $this->access->MyModelsCrud->insert('ug_power_point', $this->data);
        // After saving the data, retrieve the data
        if( $query )
        {
            $dataNewPost = $this->access->MyModelsCrud->getRaw(" SELECT * FROM ug_power_point 
            WHERE userId = '$this->userId' ORDER BY id DESC LIMIT 1");
            echo json_encode( $dataNewPost );
        }
    }
    // Saved avatar on table 'ug_power_point'

    private function removeOldAvatar()
    {
        $idDeleteArray = $this->access->MyModelsOther->firstRaw("SELECT id, avatar FROM ug_save_old_avatars 
        WHERE userId = '$this->userId'
        ORDER BY createAt ASC LIMIT 1");

        // remove photos image > 3 on folder 
        if(!empty( $idDeleteArray )) 
        {
            $avartaOldImage = $idDeleteArray['avatar'];
            if($avartaOldImage && file_exists( _WEB_PATH_UPLOADS . 'avatar/' . $avartaOldImage )) 
            {
                unlink( _WEB_PATH_UPLOADS . 'avatar/' . $avartaOldImage );
            }

            // Remove on database 
            $idToDelete = $idDeleteArray['id'];
            // Id user to delete 
            $this->access->MyModelsCrud->remove('ug_save_old_avatars', "id = $idToDelete");   
        }
    }
    // Delete oldest photo

    private function updateInfoUser() 
    {
        $query = $this->access->MyModelsCrud->update('ug_users', $this->data, "id = $this->userId");
        $this->response = ( $query ) ? 'Thông tin đã được cập nhật.' : _on_error;
    }

    public function uploadPowerpoint()
    {
        if(!empty($_POST['title']) && !empty($_POST['tags']))
        {
            $this->title = $_POST['title'];
            $this->tags = $_POST['tags'];
        }
    }

    public function savedAllImagePowerpoint() 
    {
        if (!empty($_FILES['image-uploads']))
        {
            $this->dataImages = $_FILES['image-uploads'];
            
            if(is_array($this->dataImages) || is_object($this->dataImages))
            {
                foreach ($this->dataImages['name'] as $key => $imageName)
                {
                $this->fileName = $imageName;
                $this->fileTmp =  $this->dataImages['tmp_name'][$key];
                
                $this->fileRamdomString = sha1(uniqid());
                $fileExt = pathinfo($this->fileName, PATHINFO_EXTENSION);
                $fileNameSeparator = pathinfo($this->fileName, PATHINFO_FILENAME);

                // Result name File 
                $nameImageUrl = 'usego_' . $fileNameSeparator . $this->fileRamdomString  .'.'. $fileExt;

                $pathNavigation = _WEB_PATH_UPLOADS . 'powerpoint-images/' . $nameImageUrl;
                
                // Upload avatar 
                $savedImageOnFolder 
                = $this->resizeAndSaveImage($this->fileTmp, $pathNavigation, 1100, 1100);

                if(!$savedImageOnFolder) 
                {
                    $this->response = _on_error;
                } else {
                    $this->response = null;
                }

                array_push($this->arrayAllPhotos, $nameImageUrl);
                }
            }
        }
    }

    public function uploadImageProof() 
    {
        if ( $this->access->attributeEmpty( [ 'id' ] ) ) 
        try {
            $id = $_POST['id'];

            $apiSecret = 'secret_jOj2C98jqIRt8hVU';
            $uploadDir = _WEB_PATH_UPLOADS . 'proof-files/';
            $outputDir = _WEB_PATH_UPLOADS . 'proof-images/';
            $fontFile = _WEB_PATH_ROOT . '\views\cpanel\templates\fonts\static\Nunito-Medium.ttf';

            $fileHandler = new Convert($apiSecret, $uploadDir, $outputDir, $fontFile);
            $images = $fileHandler->handleFileUpload();
            
            $data = [
                'images' => $images,
                // 'file' => 
            ];
            $query = $this->access->MyModelsCrud->update("ug_service", $data, 
            "id_trade = '$id' AND userId = '$this->userId'");

            if ( $query )
            $this->response = $images;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

class definesUploadAction extends General {
    private $method;
    private $handle; 
    private $access;
    public function __construct()
    {
        $this->access = new General;
        $this->handle = new HandleDataUpload();
        $this->performDetermination();
    }

    public function performDetermination() 
    {
        if ( $this->access->attributeEmpty( ['class'] ) )
        {
            $this->method = $_POST['class'];
        
            switch ( $this->method )
            {
                // When entering the authentication code
                case 'updateavatar':
                    $this->handle->updateAvatar('avatar', 'avatar', 'image', 300, true); 
                    $this->handle->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;

                case 'useavatarold':
                    $this->handle->useImageUpdate();
                    $this->handle->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;

                case 'editinformation':
                    $this->handle->editInformation();
                    $this->handle->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;

                case 'uploadpowerpoint':
                    $this->handle->uploadPowerpoint();
                    $this->handle->updateAvatar('powerpoint', 'powerpoint', 'file', null, false);
                    $this->handle->savedAllImagePowerpoint();
                    $this->handle->insertFilePowerpoint();
                    $this->handle->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;

                case 'uploadimageproof':
                    $this->handle->uploadImageProof();
                    $this->handle->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;
            }
        }
    }
}

$handle = new definesUploadAction();