<?php
    $mail = array(  
        'to' => "zanoskoai@gmail.com",  
        'subject' => "����� ���������",  
        'message' => "<html><body><p>����� ���������</p></body></html>",  
        'headers' => "MIME-Version: 1.0\r\n"."Content-type: text/html; charset=utf-8\r\n"."From: ��� ��������� ��������� ����������� <frommail@site.ru>\r\n");  

    mail($mail['to'], $mail['subject'], $mail['message'], iconv ('utf-8', 'windows-1251', $mail['headers']));