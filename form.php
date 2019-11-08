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

<div class="checkbox_title">Ваши интересы:</div>
            <input type="checkbox" class="checkbox" name="Ваши интересы[][1]" value="" checked style="display: none;" />
<div><label><input type="checkbox" class="checkbox" name="Ваши интересы[][1]" value="Спорт" /><font>Спорт</font></label></div>
<div><label><input type="checkbox" class="checkbox" name="Ваши интересы[][1]" value="Кино" /><font>Кино</font></label></div>
<div><label><input type="checkbox" class="checkbox" name="Ваши интересы[][1]" value="Чтение" /><font>Чтение</font></label></div>

<div class="radio_title">Ваш браузер:</div>
            <input type="radio" class="radio" name="Ваш браузер[1]" value="" checked style="display: none;" />
<div><label><input type="radio" class="radio" name="Ваш браузер[1]" value="Chrome" /><font>Chrome</font></label></div>
<div><label><input type="radio" class="radio" name="Ваш браузер[1]" value="Safari" /><font>Safari</font></label></div>
<div><label><input type="radio" class="radio" name="Ваш браузер[1]" value="Firefox" /><font>Firefox</font></label></div>

<div class="select_title">Вы пьете по утрам:</div>
<select class="select" name="Вы пьете по утрам[1]">
  <option value="">Выберите</option> <!-- value пустой для валидации по умолчанию -->
  <option value="Чай">Чай</option>
  <option value="Кофе">Кофе</option>
  <option value="Молоко">Молоко</option>
</select>

<div class="file_title">Файлы: не более 10 MB и 5 шт.<br>Выделения нескольких файлов:<br>удерживайте Ctrl и кликом мышки выделите нужные файлы</div>
<div><input type="file" class="file" name="attachfile[]" multiple="multiple" /></div>

<div class="progress"><div class="bar"></div><div class="percent">0%</div></div>

<div class="checkbox_title"></div>
            <input type="checkbox" class="checkbox" name="Согласен с условиями[][1]" value="" checked style="display: none;" />
<div><label><input type="checkbox" class="checkbox" name="Согласен с условиями[][1]" value="Принять условия" /><font>Принимаю условия!</font></label></div>

<div><input type="submit" class="sub_form" name="submit" value="Отправить" /></div>

<div class="status"></div> <!-- результат с send.php -->
</form>
</div>

</div> <!-- ====/1=== -->


<div style="float: left; width: 285px;"> <!-- ====2=== -->
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

<div class="checkbox_title">Предпочитаете жанр:</div>
            <input type="checkbox" class="checkbox" name="Предпочитаете жанр[][1]" value="" checked style="display: none;" />
<div><label><input type="checkbox" class="checkbox" name="Предпочитаете жанр[][1]" value="Комедия" /><font>Комедия</font></label></div>
<div><label><input type="checkbox" class="checkbox" name="Предпочитаете жанр[][1]" value="Исторический" /><font>Исторический</font></label></div>
<div><label><input type="checkbox" class="checkbox" name="Предпочитаете жанр[][1]" value="Мелодрама" /><font>Мелодрама</font></label></div>

<div class="progress"><div class="bar"></div><div class="percent">0%</div></div>

<div class="checkbox_title"></div>
            <input type="checkbox" class="checkbox" name="Согласен с условиями[][1]" value="" checked style="display: none;" />
<div><label><input type="checkbox" class="checkbox" name="Согласен с условиями[][1]" value="Принять условия" /><font>Принимаю условия!</font></label></div>

<div><input type="submit" class="sub_form" name="submit" value="Отправить" /></div>

<div class="status"></div> <!-- результат с send.php -->
</form>
</div>

</div> <!-- ====/2=== -->

<div style="float: left; width: 285px;"> <!-- ====3=== -->
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
<div><input type="text" class="form_field" name="E-mail[0]" placeholder="E-mail" /></div>

<div class="text_title">Телефон:</div>
<div><input type="text" class="form_field" name="Телефон[1]" placeholder="Телефон" /></div>

<div class="progress"><div class="bar"></div><div class="percent">0%</div></div>

<div><input type="submit" class="sub_form" name="submit" value="Отправить" /></div>

<div class="status"></div> <!-- результат с send.php -->
</form>
</div>

</div> <!-- ====/3=== -->

</body>
</html>