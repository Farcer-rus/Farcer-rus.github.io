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

            <div class="contact-form__input-wrapper">
                <textarea name="text" class="contact-form__input contact-form__text" placeholder="Введите ваше сообщение"></textarea>
                <div class="contact-form__error contact-form__error_text"></div>
            </div>

            <div class="contact-form__input-wrapper">
                <input class="contact-form__input contact-form__file" type="file" name="files[]">
                <div class="contact-form__error contact-form__error_file"></div>
            </div>

            <div class="contact-form__input-wrapper">
                <input type="checkbox" name="agreement" class="contact-form__input contact-form__checkbox" id="agreement">
                <label for="agreement" class="contact-form__checkbox-label">Я принимаю условия <a href="#">пользовательского соглашения</a></label>
                <div class="contact-form__error contact-form__error_agreement"></div>
            </div>

            <button class="contact-form__button" type="submit"> Получить прайс </button>
        </form>
        
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    
    <script src="/mail/js/mail.js"></script>

    <script>
        $(function() {
            $('.contact-form__input_tel').mask('+3(000)000-00-00');
        });
    </script>
</body>

</html>