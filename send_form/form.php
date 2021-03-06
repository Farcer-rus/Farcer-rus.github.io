<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>

<link type="text/css" href="/send_form/form.css" rel="stylesheet" />

<script src="/send_form/jquery-1.9.1.min.js"></script>
<script src="/send_form/jquery.form.js"></script>

<script type="text/javascript">
// функция передачи формы AJAX посредством "ajaxForm", связана с плагином: jquery.form.js
jQuery(function() {
var FormId = jQuery('.send_form:eq(0)'); // получаем class формы: eq(1)-какая форма на странице по счету, счет от "0", то есть "eq(0)"-первая, "eq(1)"-вторая и тд.
var bar = jQuery('.bar:eq(0)'); // получаем class прогресс-бара
var percent = jQuery('.percent:eq(0)'); // получаем class прогресс-бара
var status = jQuery('.status:eq(0)'); // вывод результатов

// получаем class формы <form>, сериализуем массив и отправляем в PHP файл
  FormId.ajaxForm({
    beforeSubmit: validate, // указывает на дополнительную валидацию script, false или true с "function validate()"
    beforeSend: function() { // функция работает до отправки
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) { // функция работает во время отправки
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
// изменение цвета прогресс-бара при загрузке в формате background-color: rgb(255, 255, 255)
		bar.css('background-color','rgb('+Math.ceil((100+(percentComplete*1.5)))+','+Math.ceil(255-(percentComplete))+','+Math.ceil((80+(percentComplete/1.4)))+')');
    },
    success: function() { // функция работает после отправки
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
// вывод результатов после отправки с файла PHP
	complete: function(xhr) {
		status.html(xhr.responseText);
	}
  });
});
</script>

<script type="text/javascript">
// функция валидации на js-скрипте /\ пример /\
function validate() {
  jQuery('input:text[name *= 1]').each(function () {
		if(jQuery(this).val() == '') {
		  jQuery(this).addClass("error");
		} else {
		  jQuery(this).removeClass('error');
		return true;
		}
	});
}
</script>

</head>

<body>

<div style="float: left; width: 285px;"> <!-- ====1=== -->
<!-- Простая форма HTML -->
<!--
  Можно добавлять/удалять любые поля input, textarea, radio, checkbox, select.
  При добавлении полей обязательно!!! указывайте name="имя_поля[проверять да[1] или нет[0]]"
-->
<div class="form_body">
<form action="/send_form/send.php" method="post" class="send_form" enctype="multipart/form-data">
<div class="form_title">Форма отправки Ajax!</div>

<div class="text_title">Имя:</div>
<div><input type="text" class="form_field" name="Имя[1]" placeholder="Имя" /></div>

<div class="text_title">E-mail:</div>
<div><input type="text" class="form_field" name="E-mail[1]" placeholder="E-mail" /></div>

<div class="text_title">Телефон:</div>
<div><input type="text" class="form_field" name="Телефон[0]" placeholder="Телефон" /></div>

<div class="textarea_title">Сообщение:</div>
<div><textarea rows="3" class="form_field" name="Сообщение[0]"></textarea></div>


</div> <!-- ====/3=== -->

</body>
</html>
