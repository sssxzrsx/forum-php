<?php
session_start();
global $connectionDB;
require ('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar']))
{
    $uploads_dir = 'uploads';
    $file = $_FILES['avatar'];
    $allowes_types = ['iamge/jpeg', 'image/png', 'image/gif'];

    if (!in_array($file['type'], $allowes_types)) {
        die('Файл должен быть изображением');
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Ошибка загрузки файла');
    }
    $file_name = uniqid() . '_' . basename($file['name']);
    $target_path = $uploads_dir . '/' . $file_name;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        $stmt = $connectionDB -> prepare("UPDATE users SET avatar = ? WHERE name = ?");
        $stmt -> execute([$file_name, $username]);
        header ('Location: index.php');
        exit;
    } else {
        die('Не удалось сохранить файл');
    }
} else {
    header ('Location: index.php');
    exit;
}
?>