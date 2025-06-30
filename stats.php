<?php
session_start();
if (!isset($_SESSION["auth"])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Статистика</title></head>
<body>
<h2>Статистика</h2>
<p>Раздел в разработке.</p>
<p><a href="dashboard.php">← Назад</a></p>
</body>
</html>