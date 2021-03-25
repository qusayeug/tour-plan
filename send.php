<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$email = $_POST['email'];

// Формирование самого письма
$title = "New message from Best Tour Plan";
$body = "
<h2>New message</h2>
<b>Name:</b> $name<br>
<b>Phone:</b> $phone<br>
<b>Message:</b><br>$message";

$titleSubs = "New subscriber to the Newsletter";
$bodySubs = "
<h2>New subscriber</h2>
<b>Email:</b> $email";

$titleModal = "New visitor to the Newsletter";
$bodyModal = "
<h2>New visitor</h2>
<b>Name:</b> $name<br>
<b>Phone:</b> $phone<br>
<b>Email:</b> $email<br>
<b>Message:</b>$message";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'tourplan.test5@gmail.com'; // Логин на почте
    $mail->Password   = 'Kusej521980'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('tourplan.test5@gmail.com', 'Евгений Кусей'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('evgen.kusey@gmail.com');  


    if ($email != "" && $phone != "") {
        $mail->isHTML(true);
        $mail->Subject = $titleModal;
        $mail->Body = $bodyModal;
    
        header('Location: booking-result.html');
    } else if ($email == "") {
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = $body;
    
        header('Location: thankyou.html');
    } else {
        $mail->isHTML(true);
        $mail->Subject = $titleSubs;
        $mail->Body = $bodySubs;
    
        header('Location: subscriber.html');
    }
// Отправка сообщения
    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
