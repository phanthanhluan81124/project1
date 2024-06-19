<?php
namespace Luan\Project1\Phpmailer\phpmailer;

// require_once __DIR__ . "./phpmailer/src/DSNConfigurator.php";
require_once __DIR__ . "./phpmailer/src/Exception.php";
// require_once __DIR__ . "./phpmailer/src/OAuth.php";
// require_once __DIR__ . "./phpmailer/src/OAuthTokenProvider.php";
require_once __DIR__ . "./phpmailer/src/PHPMailer.php";
// require_once __DIR__ . "./phpmailer/src/POP3.php";
require_once __DIR__ . "./phpmailer/src/SMTP.php";


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// class SenMail 
// {
//     public static function send($title, $content)
//     {
//         $mail = new PHPMailer();
//         try{
//             $mail->SMTPDebug = 2;
//             $mail->isSMTP();
//             $mail->Host = 'smtp.gmail.com';
//             $mail->SMTPAuth = true;
//             $mail->Username ="phanthanhluana8@gmail.com";
//             $mail->Password = '0865969204';
//             $mail->SMTPSecure = 'tls';
//             $mail->Port = 587;
//             $mail->SMTPOptions = array(
//                 'ssl' => array(
//                     'verify_peer'=>false,
//                     'verify_peer_name'=>false,
//                     'verify_peer_signed'=>true
//                 )
//             );

//             $mail->setFrom('phanthanhluana8@gmail.com', 'Forgot Password');
//             $mail->addAddress('luanptph42636@fpt.edu.vn');

//             $mail->isHTML(true);
//             $mail->Subject = "=?utf-8?b?".base64_decode($title);
//             $mail->Body = $content;
//             $mail->AltBody ='';

//             $mail->send();
//             return true;
//         }catch(Exception $e){
//             echo 'Message could not be sent .Mailer Error:', $mail->ErrorInfo;
//         }
//     }
// }

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

class SenMail
{

    public static function SenMail($title, $content, $addressMail)
    {
        # code...

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();
            $mail->CharSet = 'utf8';                                           //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'phanthanhluana8@gmail.com';                     //SMTP username
            $mail->Password = 'adtx iffg eajf vpyu';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('phanthanhluana8@gmail.com', 'project1');
            $mail->addAddress($addressMail);     
            //Add a recipient              //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $title;
            $mail->Body = $content;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


