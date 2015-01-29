<?php
$mailerLoaderPath = 'PHPMailer-master/';

require $mailerLoaderPath.'PHPMailerAutoload.php';
   

function registerUser(){
    
    #TEST values
    $name = 'Jad';
    $username = 'scummyj';
    $password = 'onionknight';
    $email = 'jad.r.sayegh@gmail.com';
    
    $email_code = md5($username + microtime());
    #TEST
    echo "Email code is: ".$email_code. "\n";
    
    $registration = [ 'name'=>$name, 'username'=>$username, 'password'=> $password, 'email'=>$email, 'email_code'=>$email_code, 'activation'=>false];
    
    
    #TODO: check that the username / email is not already in the DB
    #TODO: put user values in the database
    #TODO: check that the database entry worked
    
    sendActivationEmail($registration);
    
}

function sendActivationEmail($registration){
    
    
    $subject = 'Roomr account activation';
    
    #TODO: change below for different environment
    $activationLink  = "http://localhost:8888/activate.php?email=".$registration['email']."&email_code=".$registration['email_code'];
        
    $message = $registration['username'].",\n\n".
        "Thank you for joining the Roomr community!\n".
        "We are dedicated to helping you find roommates you enjoy living with. Please click on the link below to activate your account, and begin meeting potential roommates:\n\n\n"
        
        
        .$activationLink.
        
        
        "\n\nHome is where the heart is, now go find those you want to share a home with :)\n\n
Cheers,\n
The Roomr Team
    ";
    
    email($registration['email'], $subject, $message);
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