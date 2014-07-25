<?php
/*
 * @Author      Juan Carrillo
 * @Date        20 de Julio del 2014
 * @Project     Comprobantes Electronicos
 */

function enviamail($paraemail) {
    
/*
 * Para utilizar swift mailer se debe instancear los objetos del transporte SMTP
 * en este caso porque estamos usando el servidor de mail de google smtp.gmail.com
 */
    require_once($_SERVER['DOCUMENT_ROOT'].'/lib/swift_required.php');
    $transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
        ->setUsername('jrcscarrillo@gmail.com')
        ->setPassword('FREEdom1234')
        ;
/*
 * Tambien se instancia el objeto relacionado con el mensaje en base del transporte
 * y se reciben todas las variables en una array asociativa para identificar
 * cada campo de los atributos del mensaje
 */
$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('Comprobantes Electronicos');

if($paraemail['subject'] != '') {
    $message -> setSubject($paraemail['subject']);
}
if ($paraemail['fromemail']['email'] != '') {
    $message -> setFrom(array($paraemail['fromemail']['email'] => $paraemail['fromemail']['nombre']));
}

if ($paraemail['toemail']['email'] != '') {
    $message -> setTo(array($paraemail['toemail']['email'] => $paraemail['toemail']['nombre']));
}

if ($paraemail['body'] != '') {
    $message -> setBody($paraemail['body'], 'text/plain');
}

if ($paraemail['part'] != '') {
    $message -> addPart($paraemail['part'], 'text/html');
}

if(isset($paraemail['attach'])) {
if ($paraemail['attach'] != '') {
    $message -> attach(Swift_Attachment::fromPath($paraemail['attach']));
}}


    if ($mailer->send($message))
        {
        $envio = "Sent";
        } else {
            $envio = "Failed";
        }
    return $envio;
}