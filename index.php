<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title> Создание формы обратной связи </title>
    <meta name="description" content="Создание формы обратной связи" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap&subset=cyrillic" rel="stylesheet">
    
</head>

<body>
    <div class="form-wrapper">

        <form class="contact-form" id="contact-form_1" method="POST" enctype="multipart/form-data">
            <p class="contact-form__title">Оставьте заявку на расчет стоимости</p>
            <p class="contact-form__description"></p>
            <div class="contact-form__input-wrapper">
                <input name="name" type="text" class="contact-form__input contact-form__input_name"
                    placeholder="Введите ваше имя">
                <div class="contact-form__error contact-form__error_name"></div>
            </div>
            
            <div class="contact-form__input-wrapper">
                <input name="tel" type="tel" class="contact-form__input contact-form__input_tel"
                    placeholder="Введите ваш телефон">
                <div class="contact-form__error contact-form__error_tel"></div>
            </div>

            <div class="contact-form__input-wrapper"> 
                <input name="email" type="email" class="contact-form__input contact-form__input_email"
                    placeholder="Введите ваш email">
                <div class="contact-form__error contact-form__error_email"></div>
            </div>

            <button class="contact-form__button" type="submit"> Получить прайс </button>
        </form>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/mail/js/mail.js"></script>
</body>

</html>