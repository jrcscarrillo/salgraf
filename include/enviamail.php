<?php
$to       = 'jrcscarrillo@gmail.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, you just received an email using sendmail!';
$headers  = 'From: sender@gmail.com' . "\r\n" .
            'Reply-To: sender@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
if(mail($to, $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed";

require_once 'class.phpMailer.class.php';
require_once 'PHPMailerAutoload.php';

$mail = new PHPMailer ();

$mail -> From = "jrcscarrillo@gmail.com";
$mail -> FromName = "Juan Carrillo";
$mail -> AddAddress ("jrcscarrillo@gmail.com", "Juan Carrillo");
$mail -> Subject = "Test";
$mail -> Body = "<h3>From GMail!</h3>";
$mail -> IsHTML (true);

$mail->IsSMTP();
$mail->Host = 'ssl://smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'jrcscarrillo@gmail.com';
$mail->Password = 'FREEdom1234';

if(!$mail->Send()) {
        echo 'Error: ' . $mail->ErrorInfo;
} else {
     echo 'Mail enviado!';
}

$to       = 'jrcscarrillo@gmail.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, you just received an email using sendmail!';
$headers  = 'From: sender@gmail.com' . "\r\n" .
            'Reply-To: sender@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
if(mail($to, $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed";
