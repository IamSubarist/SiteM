<?php
header('Content-Type: application/json');
try {

    $sendTo = 'введите почту, на которую будут приходить сообщения';
    $usermail = $_POST['email'];
    $username = $_POST['name'];
    $content = $_POST['msg'];
    $subject = $_POST['subject'];

    if ($usermail !== null && $username !== null && $content !== null) {
        $msg .= 'Имя: ' . $username . "\r\n";
        $msg .= 'Почта: ' . $usermail . "\r\n";
        $msg .= 'Услуга: ' . $subject . "\r\n";
        $msg .= 'Сообщение: ' . $content . "\r\n";
        $msg .= "";
        if (mail($sendTo, 'Обратная связь', $msg)) {
            getRespond('HTTP/1.1 201 Successful added', ['status' => true, 'message' => 'Сообщение отправлено']);
        }
    }
    getRespond('HTTP/1.1 403 not enough data', ['status' => false, 'message' => 'Недостаточно обязательных данных!']);
} catch (\Exception $e) {
    getRespond('HTTP/1.1 503 error added data', ['status' => false, 'message' => 'Ошибка отправки сообщения!']);
}
function getRespond($header, $respond)
{
    header($header);
    echo json_encode($respond);
    exit;
}
