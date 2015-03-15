<?php
$mailerLoaderPath = 'PHPMailer-master/';

require $mailerLoaderPath.'PHPMailerAutoload.php';
   

function sendActivationEmail($username, $email, $email_code){
    
    
    $subject = 'Roomr account activation';
    
    #TODO: change below for different environment
    $activationLink  = "http://localhost/Roomr/activate.php?email=".$email."&email_code=".$email_code;
        
    $message = $username.",\n\n".
        "Thank you for joining the Roomr community!\n".
        "We are dedicated to helping you find roommates you enjoy living with. Please click on the link below to activate your account, and begin meeting potential roommates:\n\n\n"
        
        
        .$activationLink.
        
        
        "\n\nHome is where the heart is, now go find those you want to share a home with :)\n\n
Cheers,\n
The Roomr Team
    ";
    
    email($email, $subject, $message);
}

#send an email from activation@roomr.com
function email($to, $subject, $message){

    $fromName = "The Roomr Team";
    $fromEmail = "theroomrteam@gmail.com";

    $mail      = new PHPMailer();
    $mail->isSMTP();
    $mail->Host     = 'smtp.gmail.com' ;

    #TODO: set up email server to avoid using personal gmail
    $mail->Username = "theroomrteam@gmail.com";
    $mail->Password = "roomrteam";

    $mail->From     = $fromEmail;
    $mail->FromName = $fromName;
    $mail->AddAddress($to);

    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "tls";
    $mail-> Port = 587;

    $mail->Subject  = $subject;
    $mail->Body     = $message;

    if(!$mail->Send()) {

        echo 'Message was not sent.';

        echo 'Mailer error: ' . $mail->ErrorInfo;

    } else {

        echo 'Message has been sent.';

    }
}
?>