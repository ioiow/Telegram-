<?php
require_once("config.php");
session_start();
if (!isset($_SESSION["auth"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];

    // TODO: Заменить на список пользователей из БД или файла
    $chat_ids = [/* добавь chat_id пользователей сюда */];

    foreach ($chat_ids as $chat_id) {
        $url = API_URL . "sendMessage?chat_id=$chat_id&text=" . urlencode($text);
        file_get_contents($url);
    }

    $msg = "Сообщение отправлено!";
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Отправить сообщение</title></head>
<body>
<h2>Отправить сообщение</h2>
<?php if (isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
<form method="POST">
    <textarea name="text" rows="5" cols="40" placeholder="Введите сообщение" required></textarea><br>
    <button type="submit">Отправить</button>
</form>
<p><a href="dashboard.php">← Назад</a></p>
</body>
</html>