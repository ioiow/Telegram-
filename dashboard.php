<?php
session_start();
if (!isset($_SESSION["auth"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Панель</title></head>
<body>
<h2>Панель управления ботом</h2>
<ul>
    <li><a href="send_post.php">Отправить сообщение</a></li>
    <li><a href="users.php">Пользователи</a></li>
    <li><a href="stats.php">Статистика</a></li>
    <li><a href="logout.php">Выйти</a></li>
</ul>
</body>
</html>