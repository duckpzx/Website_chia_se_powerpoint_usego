<?php 
class HandleDataRegister extends Controller {
    private $firstname, $lastname, $email, $password, $token, 
    $active_token, $codeOTP, $status, $createAt;
    private $data;
    private $MyModels, $MyModelsCrud;
    public $errors = [];
    public function __construct()
    {
        $this->MyModels = $this->models('MyModelsOther');
        $this->MyModelsCrud = $this->models('MyModelsCrud');
    }

    public function checkotp() 
    {
        $emailPrepare = $_POST['email_prepare'];
        $this->codeOTP = $_POST['active_token'];

        // check for existence of email in there ||
        $query = $this->checkEmailStripes($emailPrepare);
        // Check exists email
        if($query < 1)
        {
            $this->errors['accuracy'] = 'Xảy ra lỗi, email không tồn tại';
            return;
        } else {
            $checkOtp = $this->checkAccuracyOtp($emailPrepare);
            // Check exists code OTP 
            if($checkOtp < 1)
            {
                $this->errors['accuracy'] = 'Mã xác thực không chính xác';
                return;
            } else {
                $this->errors['accuracy'] = NULL;
            }
        }            
    }

    public function importeddata()
    {
        $requiredFields = ['firstname', 'lastname', 'email', 'password', 'active_token'];
        $isTrue = true;

        foreach ( $requiredFields as $field ) {
            if (empty(trim($_POST[$field]))) {
                $isTrue = false;
                break;
            }
        }

        if ($isTrue) {
            // Check exists email 
            $emailAtFirst = $_POST['email'];
            $this->processEmail($emailAtFirst);
            $emailExistence = $this->emailAlreadyExists();

            if($emailExistence > 0)
            {
                $this->errors['otp'] = 'Lỗi, email đã tồn tại trên hệ thống';
                return;
            } else {
                $this->errors['otp'] = null;
            }
                
            $encryptedPassword = base64_decode( $_POST ['password'] );
            // decryption password
            $this->firstname = $_POST ['firstname'];
            $this->lastname = $_POST ['lastname'];
            $this->password = password_hash($encryptedPassword, PASSWORD_DEFAULT);
            // Hashing
            $this->active_token = $_POST ['active_token'];
            $this->createAt = date('l, d m Y');

            $this->data = [
                'firstName' => $this->firstname,
                'lastName' => $this->lastname,
                'email' => $emailAtFirst,
                'password' => $this->password,
                'activeToken' => $this->active_token,
                'createAt' => $this->createAt,
            ];
            // check if the email exists seperated on the system
            $this->saveEmailNoExist();
        }
    }

    private function processEmail($emailAtFirst)
    {
        $arrayEmailPath = explode('||',  $emailAtFirst);
        $emailNotRandomString = $arrayEmailPath[0];
        $emailSeparateExtension = explode('@', $arrayEmailPath[1]);
        $domainEmail = '@'. $emailSeparateExtension[1];
        // Instance:  ducpham2004nha||fd378f3u53f4f@gmail.com
        //         => ducpham2004nha@gmail.com
        $this->email = $emailNotRandomString . $domainEmail;
    }

    public function setstatus() {
        $emailPrepare = $_POST['email_prepare'];
        $this->status = $_POST['status'];
        $this->email = $_POST['email'];

        $this->data = [
            'email' =>  $this->email,
            'status' => $this->status,
            'activeToken' => NULL
        ];

        // Delete other redundant emails
        $emailName = strstr($this->email, '@', true);
        // If exit 
        if ($emailName !== false) {
            $this->deleteOtherEmails($emailName, $emailPrepare);   
        }

        // Status updates and unstriped emails
        $this->saveEmailRemoveStripes($emailPrepare);
    }

    private function checkEmailStripes($emailPrepare)
    {
        $query = $this->MyModels->getRows("SELECT id FROM ug_users 
        WHERE email = '$emailPrepare'");
        return $query;
    }

    private function checkAccuracyOtp($emailPrepare)
    {
        $checkOtp = $this->MyModels->getRows("SELECT id FROM ug_users 
        WHERE email = '$emailPrepare' AND activeToken = '$this->codeOTP'");
        return $checkOtp;
    }

    private function emailAlreadyExists() 
    {
        return $this->MyModels->getRows("SELECT id FROM ug_users 
        WHERE email = '" . $this->email . "'");
    }

    // Stripeless email doesn't exist yet
    private function saveEmailNoExist()
    {
        $this->MyModelsCrud->insert('ug_users', $this->data);
    } 

    private function saveEmailRemoveStripes($emailPrepare)
    {
        $this->MyModelsCrud->update('ug_users', $this->data, "email = '$emailPrepare'");
    }

    private function deleteOtherEmails($emailName, $emailPrepare)
    {  
        $this->MyModelsCrud->remove('ug_users', "email LIKE '%$emailName%' AND email != '$emailPrepare'");
    }
}

class determineRegisterAction extends Request {
    private $method;
    private $handler; 

    public function __construct()
    {
        if ($this->isPost()) 
        {
            $this->handler = new HandleDataRegister();
            $this->performDetermination();
        }
    }

    public function sendJsonResponse()
    {
        header('Content-Type: application/json');
        if (!empty($this->handler->errors))
        echo json_encode(['error' => $this->handler->errors], JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function performDetermination() 
    {
        if(!empty($_POST['class'])) 
        {
            $this->method = $this->getBody()['class'];
        }
        // Value class 

        switch ($this->method)
        {
            // when entering the authentication code
            case 'checkotp':
                $this->handler->checkotp(); 
                $this->sendJsonResponse();
                break;

            case 'importeddata': 
                $this->handler->importeddata();
                $this->sendJsonResponse();
                break;

            case 'setstatus': 
                $this->handler->setstatus();
                $this->sendJsonResponse();
                break;
        }
    }
}

$handle = new determineRegisterAction();