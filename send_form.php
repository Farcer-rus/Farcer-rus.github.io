<?php
$fio= $_POST['fio'];
$phone= $_POST['phone'];
$email= $_POST['email'];
$adres= $_POST['adres'];
$emailTo = '123428@bk.ru'; //Сюда введите Ваш email
$body = "$fio \n\n$phone\n\n$email \n\n$adres";
$headers = "Content-Type: text/plain; charset=utf-8\r\n".'From: MySite <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $emailTo;
mail($emailTo, $fio, $body, $headers);
$emailSent = true;
?>
