<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>Форма обратной связи в модальном окне и без перезагрузки страницы</title>
<meta name='author' content="Дмитрий Давыдов" />
<meta name='copyright' content="Smartlanding.biz" />

 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="modalform/libs/remodal/remodal.css">
 <link rel="stylesheet" href="modalform/libs/remodal/remodal-default-theme.css">
 <link rel="stylesheet" href="modalform/css/formstyle.css">
 <link rel="stylesheet" href="css/style.css">
 <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>

</head>
<body>
<div class="butWrap">
  <a class="linkButton" data-remodal-target="firstModal" title="Консультация">Получить консультацию</a>
  <a class="linkButton" data-remodal-target="secondModal" title="Обратный звонок">Обратный звонок</a>
</div>

<div class="remodal" data-remodal-id="firstModal" data-remodal-options="hashTracking: false,closeOnConfirm: false">
  <button data-remodal-action="close" class="remodal-close"></button>
  <div class="formArea">
    
    <form id="firstForm" class="form" autocomplete="off">
    <p class="formTitle">Оставьте ваши контактные данные и наш консультант свяжется с вами</p>
    <p class="msgs"></p>
      <fieldset class="form-fieldset ui-input __first">
        <input name="uname" type="text" id="username" tabindex="0"/>
        <label for="username">
          <span data-text="Введите ваше имя">Введите ваше имя</span>
        </label>
      </fieldset>

      <fieldset class="form-fieldset ui-input __second">
        <input name="uemail" type="email" id="email" tabindex="0" />
        <label for="email">
          <span data-text="Введите ваш e-mail">Введите ваш e-mail</span>
        </label>
      </fieldset>

      <input name="formInfo" class="formInfo" type="hidden" value=""/>

      <div class="form-footer">
        <input type="submit" class="formBtn" value="Отправить заявку" />
      </div>
      <p class="formCreator"><a href="http://smartlanding.biz">smartlanding.biz</a></p>
    </form>
  </div>
</div>

<div class="remodal" data-remodal-id="secondModal" data-remodal-options="hashTracking: false,closeOnConfirm: false">
  <button data-remodal-action="close" class="remodal-close"></button>
  <div class="formArea">
  
  <form id="secondForm" class="form" autocomplete="off">
  <p class="formTitle">Закажите обратный звонок и наш консультант свяжется с вами</p>
  <p class="msgs"></p>

      <fieldset class="form-fieldset ui-input __first">
        <input name="uname" type="text" id="username" tabindex="0"/>
        <label for="username">
          <span data-text="Введите ваше имя">Введите ваше имя</span>
        </label>
      </fieldset>

      <fieldset class="form-fieldset ui-input __second">
        <input name="uphone" type="tel" id="phone" tabindex="0" pattern="^[ 0-9]+$"/>
        <label for="phone">
          <span data-text="Введите ваш телефон">Введите ваш телефон</span>
        </label>
      </fieldset>

      <input name="formInfo" class="formInfo" type="hidden" value=""/>

      <div class="form-footer">
        <input type="submit" class="formBtn" value="Обратный звонок" />
      </div>
      <p class="formCreator"><a href="http://smartlanding.biz">smartlanding.biz</a></p>
  </form>
  </div>
</div>
<p class="title">Демонстрация открытой формы, просто указываем уникальный id форме</p>
<div class="formArea">
  <form id="thirdForm" class="form" autocomplete="off">
  <p class="formTitle">Закажите обратный звонок и наш консультант свяжется с вами</p>
  <p class="msgs"></p>

      <fieldset class="form-fieldset ui-input __first">
        <input name="uname" type="text" id="username" tabindex="0"/>
        <label for="username">
          <span data-text="Введите ваше имя">Введите ваше имя</span>
        </label>
      </fieldset>

      <fieldset class="form-fieldset ui-input __second">
        <input name="uphone" type="tel" id="phone" tabindex="0" pattern="^[ 0-9]+$"/>
        <label for="phone">
          <span data-text="Введите ваш телефон">Введите ваш телефон</span>
        </label>
      </fieldset>

      <input name="formInfo" class="formInfo" type="hidden" value=""/>

      <div class="form-footer">
        <input type="submit" class="formBtn" value="Обратный звонок" />
      </div>
      <p class="formCreator"><a href="http://smartlanding.biz">smartlanding.biz</a></p>
  </form>
  </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
$(".linkButton").click(function() {
    $( "input[name*='formInfo']" ).val($(this).attr( "title" ));
});
</script>
<script src="modalform/libs/remodal/remodal.min.js"></script>
<script src="modalform/js/form.js"></script>

</body>
</html>
