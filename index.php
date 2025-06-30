<?php
session_start();
$pin = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["pin"] === $pin) {
        $_SESSION["auth"] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Неверный PIN-код!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Вход</title></head>
<body>
<h2>Вход</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    <input type="password" name="pin" placeholder="PIN-код" required>
    <button type="submit">Войти</button>
</form>
</body>
</html>