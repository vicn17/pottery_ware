<?php
    //* import library phpmailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require './PHPMailer-master/src/Exception.php';
    require './PHPMailer-master/src/PHPMailer.php';
    require './PHPMailer-master/src/SMTP.php';
    // include "./PHPMailer-master/src/OAuth.php";
    // include "./PHPMailer-master/src/POP3.php";
    //* Send mail to user when sign up successfully
    function signUp($title, $content, $email, $user_name){
        echo '<script> alert("Đăng ký tài khoản thành công") </script>';
        $mail = new PHPMailer(true);  
        // print_r($mail);
        try {
            //Server settings
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER                     //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'nhutvichung@gmail.com';                     //SMTP username
            $mail->Password   = 'mpkbcccovycwqyqc';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('nhutvichung@gmail.com', 'VICN');
            $mail->addAddress($email, $user_name);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $title;
            $mail->Body    = $content;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    //* Send mail check gmail user when user sign up
    function checkUserSignup($title, $content, $email, $user_name){
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nhutvichung@gmail.com'; 
            $mail->Password   = 'mpkbcccovycwqyqc';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->setFrom('nhutvichung@gmail.com', 'VICN');
            $mail->addAddress($email, $user_name);
            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body    = $content;
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>