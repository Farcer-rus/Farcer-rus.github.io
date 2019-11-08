<?php
header("Content-Type: text/html; charset=UTF-8");

// функция преобразования размера файла в "B", "KB", "MB", "GB", "TB", "PB"
function humanSize($bytes=0) {
 $type = array("", "K", "M", "G", "T", "P");
 $index = 0;
  while($bytes >= 1024){
   $bytes/= 1024;
	$index++;
  }
   $bytes = round($bytes, 2);
  return($bytes." ".$type[$index]."B");
}

/******************** проверка/валидация *********************************************/
$errors = array(); // создаем массив для вывода ошибок: $errors[]
$success = array(); // создаем массив для вывода успеха: $success[]
$post = $_POST; // переназначаем переменную массива с формы $_POST
unset($_POST); // очищаем стандартную $_POST
$_POST = array(); // создаем чистую переменную $_POST для дальнейшей записи
/*------------------------ start --------------------------*/

// проверка/валидация формы
foreach ($post as $Name => $tempValue) { // разбираем массив POST на переменные и массив
	foreach ($tempValue as $vKey => $vValue) { // получаем переменные: "name" поля input, "value" поля input, $Key = ключ для валидации с <input name="Name[0 или 1]">
	// если есть массив, идем дальше
		if(is_array($vValue)) { // если с формы пришел массив, то есть [] <input name="одинаковое[][1]"> , то включаем эту часть кода
		 foreach ($vValue as $Key => $aValue) { // получаем переменные: key, value поля <input name="одинаковое[][$Key 0 или 1]" value="">
		  $vValue = $aValue; // переназначаем переменную с учетом массива
	    }
      count($tempValue[$Key]) ? $vKey = 0 : $vKey = 1; // здесь для проверки назначаем в соответствии ключа с формы: [$Key 0 или 1]
	  }
		
    $i++; // для получения $pattern_? , номер поля с формы для шаблона валидации
     $Value = htmlspecialchars(trim($vValue)); // преобразовуем специальные символы в HTML сущности и удаляем пробелы по бокам
    if($vKey == 1) { // если ключ 1 - проверяем форму, 0 - нет проверки, приходит с  <input name="Name[$Key 0 или 1]">
      if($Value == '') { // проверка формы на пустоту
        $errors[] = "Вы не ввели: ".$Name;
       } else if (!preg_match(${'pattern_'.$i} ? ${'pattern_'.$i} : '/(.*?)/iu', $Value)) { // если форма не пуста, валидация полей по шаблону $pattern_? '/^... $/i'
	      $errors[] = "Введено некорректно: ".$Name;
      }
    }
  }
}
/*------------------------- end ---------------------------*/

/*------------------------ start --------------------------*/
// создание нового массива $_POST['name']
foreach ($post as $tempName => $tempValue) { // разбираем массив POST c чекбоксов на переменные и массив
  $x = 0; // обнуляем: для добавления к имени массива: 1, 2 и тд.
   foreach ($tempValue as $mName => $mValue) { // разбираем массив POST c чекбоксов на переменные и массив
	  if(is_array($mValue)) { // если с формы пришел массив, то есть [] <input name="одинаковое[][1]"> , то включаем эту часть кода
		 foreach ($mValue as $Key => $aValue) { // получаем переменные: name = "$Name" value="$Value" поля <input name="одинаковое[][$Key 0 или 1]" value="$Value">
       $Value = htmlspecialchars(trim($aValue)); // преобразовуем специальные символы в HTML сущности и удаляем пробелы по бокам
				if($Value != '') {
				$x++; // для добавления к имени массива: 1, 2 и тд.
			   array($_POST[$tempName][] = $Value); // создание массива // '$_POST[Name]' => array('Key' => 'Value') //
         array_push($_POST[$tempName.'_'.$x] = $Value); // создание массива // '$_POST[Name_x]' => 'Value' //
        }
			}
		} else {
		  $aValue = htmlspecialchars(trim($mValue)); // преобразовуем специальные символы в HTML сущности и удаляем пробелы по бокам
		   array($_POST[$tempName] = $aValue); // создание основного массива // '$_POST[Name]' => 'Value' //
		}
  }
}
/*------------------------- end ---------------------------*/

/*------------------------ start --------------------------*/
// если передан файл, то проверка размера загружаемых файлов, количество и расширение
if(!empty($_FILES['attachfile']['name'][0])){
  $fileNameAtt = $_FILES['attachfile']['name'];
  $tempFiles = count($fileNameAtt);
    for($s = 0; $s < $tempFiles; $s++){ // получаем количество файлов с массива
      if(!preg_match($pattern_file, $fileNameAtt[$s])) { //проверка расширения загружаемых файлов: $pattern_file
	    $errors[] = "Недопустимый файл: ".mb_substr($fileNameAtt[$s], 0, 8).'..'.mb_substr($fileNameAtt[$s], -4); // вырезаем строку посередине 
      }
	   $tempSize += $_FILES['attachfile']['size'][$s]; // узнаем размер переданных файлов
    }
    if($tempSize > $sizeFiles){ // загружать файлы размером в сумме не более: $sizeFiles
	    $errors[] = "Превышен размер файла: ".humanSize($tempSize);
    } else if ($s > $countFiles) { //проверять количество загружаемых файлов: $countFiles
	    $errors[] = "Превышено количество: ".$s;
    }
}
/*------------------------- end ---------------------------*/
?>