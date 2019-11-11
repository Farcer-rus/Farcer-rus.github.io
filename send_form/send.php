<?php
header("Content-Type: text/html; charset=UTF-8");

/************************** пришли POST данные с формы *************************************/
if(!empty($_POST['submit'])){ // если пришли POST данные с формы - продолжаем!

/*------------------------ start --------------------------*/
/* проверка поля "input" только русские буквы: '/^[а-я ]{3,20}$/iu'
 * проверка поля "input" только латинские буквы: '/^[a-z ]{3,20}$/i'
 * проверка поля "input" только русские и латинские буквы: '/^[a-zа-я ]{3,20}$/iu'
 * проверка поля "input" только русские, украинские и латинские буквы: '/^[а-яіїёa-z ]{3,20}$/iu'
 * проверка поля "input" только цифры: '/^[0-9]$/i'
 * проверка поля "input" только цифры и латинские буквы: '/^[a-z0-9]{3,20}$/i'
 * проверка поля "input" пропускать всё: '/(.*?)/iu'
*/
// по порядку полей в форме со значением: <input name="название[1]">
$pattern_1 = '/^[а-яіїёa-z ]{3,20}$/iu'; // шаблон проверки: "preg_match($pattern, $matches);"
$pattern_2 = '/([\w\-]+\@[\w\-]+\.[\w\-]+)/';
$pattern_3 = '/^[0-9-+)(]+$/i';
$pattern_4 = '/(.*?)/iu';
/* $pattern_5 = 'шаблон валидации';
 * $pattern_...
 * $pattern_20 = 'шаблон валидации';
*/

$pattern_file = '/\.(avi|zip|rar|jpg|JPG|txt|png|gif)$/'; // проверка расширения загружаемых файлов (для всех файлов)
$countFiles = 5; //проверять количество загружаемых файлов $countFiles
$sizeFiles = 10485760; // загружать файлы размером в сумме: не более 10МБ, размер указывать в байтах

// настройки для отправки письма
$HTTP_HOST = parse_url('http://'.$_SERVER["HTTP_HOST"]); // не трогать!!!
$HTTP_HOST = str_replace(array("http://","www."),"",$HTTP_HOST['host']); // не трогать!!! вырезает с адреса: "www" для формирования e-mail от которого придёт уведомление

$to = 'zanoskoai@gmail.com'; // кому отсылать: адрес e-mail
$from = "sales@".$HTTP_HOST; // адрес, от которого придёт уведомление, желательно указать существующий ящик на хостинге!
$signature = 'CITi.COM'; // подпись в письме
$title = "Сообщение с сайта: http://".$_SERVER["HTTP_HOST"]; // тема в письме

/*------------------------- end ---------------------------*/

// подключаем внешний файл
require '../send_form/valid_form.php'; // подключаем файл валидации "valid_form.php"

/************************** работа с данными POST запроса **********************************/
if(empty($errors)){ // если нет ошибок при валидации/проверке - можно продолжать


/********************* отправка письма **********************************/

/*------------------------ start --------------------------*/
require '../send_form/class.phpmailer.php'; // подключаем файл класса для отправки почты
  $mail = new PHPMailer();
  $mail->From = $from; // адрес, от которого придёт уведомление
  $mail->FromName = $signature; // подпись в письме от кого
  $mail->AddAddress($to); // кому: адрес e-mail
  $mail->IsHTML(true); // выставляем формат письма HTML
  $mail->CharSet = 'utf-8'; //кодировка письма
  $mail->Subject = $title; // тема письма

// обратите внимание, теперь мы можем писать красивые письма, с помощью html тегов
$mess .= '<html><body><table style="font-size: 13px;font-family: Arial, Tahoma, Verdana, sans-serif;line-height: 16px;padding: 0;border: 1px solid #B9B9B9;margin:0;border-collapse: collapse;" cellpadding="8" rules="all">';
$mess .= '<tr style="background: rgb(224, 245, 255);"><td><b>Отправлено со страницы: </b></td><td><span>'.$_SERVER['HTTP_REFERER'].'</span></td></tr>'; // страница с которой отправили письмо
  foreach ($_POST as $Name=>$pValue){ // разбираем массив POST на переменные, извлекаем Имя и Значение полей <input "name" и "value">
     $Value = htmlspecialchars(trim($pValue)); // получаем "value" поля input
	  if($Value != ''){ // если переданы значение "value", то посылаем их на почту
      $mess .= '<tr><td><b>'.$Name.': </b></td><td><span>'.$Value.'</span></td></tr>'; // формируем сообщение на почту
	  }
  }
$mess .= '<tr style="background: rgb(227, 255, 208);"><td><b>Отправлено с IP-адреса: </b></td><td><span>'.$_SERVER['REMOTE_ADDR'].'</span></td></tr>'; // IP-адрес откуда нам прислали письмо
$mess .= '</table></body></html>';

// если передан файл, то прикрепляем его к письму
if(!empty($_FILES['attachfile']['name'][0])){
 $tempFiles = count($_FILES['attachfile']['name']);
  for($i = 0; $i < $tempFiles; $i++){ // получаем количество файлов с массива
    if($_FILES['attachfile']['error'][$i] == 0){ // нет ошибки при передаче файла - продолжаем!
      if(!$mail->AddAttachment($_FILES['attachfile']['tmp_name'][$i], $_FILES['attachfile']['name'][$i], 'base64', $_FILES['attachfile']['type'][$i])) die ($mail->ErrorInfo);
    }
  }
}

// отправляем наше письмо
  $mail->Body = $mess;

// сообщение об успехе/неудаче
  if(!$mail->Send()) {
    $errors[] = 'Письмо не отправлено!<br>Ошибка: '.$mail->ErrorInfo;
  } else {
    $success[] = 'Спасибо! Сообщение отправлено!';
	 header('Refresh: 5; URL='.$_SERVER['HTTP_REFERER'].'');
  }

// очищаем переменные
  $mail->ClearAddresses(); //очищает предыдущие адреса (если письмо отправляется 1 раз, не требуется)
  $mail->ClearAttachments(); //очищает предыдущие файлы (если письмо отправляется 1 раз, не требуется)
  $mail->ClearCustomHeaders(); //очищает предыдущие заголовки (если письмо отправляется 1 раз, не требуется)
}
/*------------------------- end ---------------------------*/

/******************** Вывод сообщений ***************************************/
/*------------------------ start --------------------------*/
// Вывод сообщений\ошибок $errors[]
foreach ($errors as $error) { // разбираем массив $errors[]
    echo '<div style="background: #FDDCDC; padding: 0;">&bull; '.$error.'</div>'; // сообщения с ошибками: "background: #FFC3C3"
}

// Вывод сообщений\успеха $success[]
foreach ($success as $successfully) { // разбираем массив $errors[]
    echo '<div style="background: #A9FFA9; padding: 5px 0;">&bull; '.$successfully.'</div>'; // сообщения без ошибок: "background: #A9FFA9"
}
/*------------------------- end ---------------------------*/

} // end
?>
