
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/forum/css/style3.css">
    <link rel="stylesheet" href="/forum/css/style1.css">
    <title>Регистрация</title>
</head>
<body>
<?php
require_once('layouts/header.php')
?>
    <div class="login-page">
        <div class="form">
            <form action="submit.php" method="post" class="register-form">
            <label for="name">Имя</label>
            <input type="name" placeholder="Введите имя" name="name" required>
            <label for="email">Почта</label>
            <input type="email" placeholder="Введите почту" name="email" required>
            <label for="password">Пароль</label>
            <input type="password" placeholder="Введите пароль" name="password" required>
            <button type="submit">Зарегестрироваться</button>
            </form>
            <p class="message">
                Уже есть аккаунт? <a href="auth.php">Войти</a>
            </p>
        </div>
    </div>

    <div class="footer">
    <h1>Good</h1>
    </div>

</body>
</html>