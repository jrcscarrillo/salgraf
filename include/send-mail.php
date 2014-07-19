<?php
    $to			=	'jrcscarrillo@gmail.com';
	$subject	=	'pruebas';
	$message	=	'Recibiendo los emails';
	$headers	=	'From:jrcscarrillo@gmail.com'."\r\n".
					'Reply-To:jrcscarrillo@gmail.com'."\r\n".
					'MIME-Version: 1.0'."\r\n".
					'Content-type: text/html; charset=iso-8859-1'."\r\n".
					'X-Mailer: PHP/'.phpversion();
					
	if(mail($to, $subject, $message, $headers)) {
		echo "Email enviado";
	}
	else {
		echo "No se pudo enviar el email";
	}
?>