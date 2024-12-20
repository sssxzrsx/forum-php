<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/forum/css/style.css">

    <title>Форум Average</title>
</head>
<body>
<?php
require_once('layouts/header.php');
?>

    <h2>Добавить тему</h2>
    <input type="name" placeholder="Название темы" name="name" required>
    <input type="name" class="message" height="40px" placeholder="Ваше сообщение" name="theme" required>
    <button>Добавить</button>

    <div class="main">
        <a href="logout.php"><button>Exit Session</button></a>
    </div>
    
</body>
</html>