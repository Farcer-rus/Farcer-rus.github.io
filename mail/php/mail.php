<?php

// mb_internal_encoding("UTF-8");
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

	use PHPMailer\PHPMailer\PHPMailer;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		require_once($_SERVER['DOCUMENT_ROOT'] . '/mail/phpmailer/phpmailer.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/mail/php/config.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/mail/php/valid.php');

		if(defined('HOST') && HOST != '') {
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = HOST;
			$mail->SMTPAuth = true;
			$mail->Username = LOGIN;
			$mail->Password = PASS;
			$mail->SMTPSecure = 'ssl';
			$mail->Port = PORT;
			$mail->AddReplyTo(SENDER);
		} else {
			$mail = new PHPMailer;
		}

		$mail->setFrom(SENDER);
    $mail->addAddress(CATCHER);
    $mail->CharSet = CHARSET;
    $mail->isHTML(true);
		$mail->Subject = SUBJECT;
		$mail->Body = "$name $tel $email"; 
		if(!$mail->send()) {
    } else {
      echo json_encode($msgs);
    }
	
	} else{
    header ("Location: /"); // главная страница вашего лендинга
	}