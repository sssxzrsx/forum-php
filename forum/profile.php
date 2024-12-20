<?php
require_once ('db.php');
session_start();
global $connectionDB;

$stmt = $connectionDB -> prepare("SELECT * FROM users WHERE name = ?");
$stmt -> execute([$username]);
$user = $stmt -> fetch();

if ($user) {
    if (password_verify($password, $user['password'])) {
        echo "Успешно! " . $name;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header('Location: http://localhost/forum/profile.php');
        exit;
    } else {
     echo "Неверный пароль!";
     header('Location: http://localhost/forum/register.php');
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author_info'])) {
    $author_info = htmlspecialchars(trim($_POST['author_info']));
    $stmt = $pdo -> prepare("UPDATE users SET author_info = ? WHERE name = ?");
    $stmt -> execute([$author_info, $username]);
    $user['author_info'] = $author_info;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/forum/css/style3.css">
    <link rel="stylesheet" href="/forum/css/style1.css">
    <title>Профиль</title>
</head>
<body>
    <?php
    require_once('layouts/header.php');
    ?>
    <h1>Проифиль пользователя</h1>
    <div class="avatar">
        <img src="upload.php" method="POST" enctype="multipart/form-data" alt="Аватар" style="width: 150px; height: 150px; border-radius: 50%">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="avatar">Выбрать новый аватар</label>
            <input type="file" name="avatar" id="avatar" required>
            <button type="submit">Загрузить</button>
        </form>
    </div>
    <div class="gg">
        <form action="" mathod="POST">
            <label for="author_info">Изменить подпись</label><br>
            <textarea name="author_info" id="author_info" rows="4" cols="30">

            </textarea><br>
            <button type="submit">Сохранить</button>
        </form>
        <a href="logout.php"><button>Exit Session</button></a>
    </div>
</body>
</html>

