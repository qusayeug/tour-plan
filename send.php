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

if (isset($_POST['email'])) {
    $title = "New subscriber Best Tour Plan";
    $body = "
    <h2>New subscriber</h2>
    <b>Email:</b> $email";
} else {
    $title = "New appeal Best Tour Plan";
    $body = "
    <h2>New Appeal</h2>
    <b>Name:</b> $name<br>
    <b>Number:</b> $phone<br><br>
    <b>Message:</b><br>$message";
}

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'qusay.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'qusayeugene@qusay.ru'; // Логин на почте
    $mail->Password   = 'Kusej521980'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('qusayeugene@qusay.ru', 'Евгений'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('evgen.kusey@gmail.com');

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
header('Location: thankyou.html');