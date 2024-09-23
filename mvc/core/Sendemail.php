<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    function mailerSend($to, $subject, $content){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                    //Enable verbose debug output
            $mail->isSMTP();                                       //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                  //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                              //Enable SMTP authentication
            $mail->Username   = 'ducpham2004nha@gmail.com';        //SMTP username
            $mail->Password   = 'oclezgkegttyuits';                //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;       //Enable implicit TLS encryption
            $mail->Port       = 465;                               //TCP

            //Recipients
            $mail->setFrom('ducpham2004nha@gmail.com', 'UseGo');
            $mail->addAddress($to);                                //Add a recipient
            //Content
            $mail->isHTML(true);                                   //Set email format to HTML

            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body    = $content;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            return $mail->send();

        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if(!empty($_POST['class']) && $_POST['class'] == "sendemail") 
        {
            $path = _ROOT_URL . 'mvc/core/content/SendEmail.html';
            $contentMessage = file_get_contents($path);
            $contentMessage = str_replace("{{firstname}}", $_POST['firstname'], $contentMessage);
            $contentMessage = str_replace("{{active_token}}", $_POST['active_token'], $contentMessage);
            $toEmail = $_POST["email"];
            $subject = $_POST['firstname'] . ', Chào mừng đến với UseGo ✨';
            mailerSend($toEmail, $subject, $contentMessage);
        }
    }
