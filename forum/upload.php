<?php

echo '<pre>';
print_r($_FILES);
echo '</pre>';
// Подключаем базу данных
require_once 'db.php'; // Убедитесь, что подключение находится в этом файле
global $connectionDB;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $uploadDir = 'uploads'; // Папка для загрузки

    // Создаем папку, если её нет
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['avatar']['name']); // Имя файла
    $uploadFilePath = $uploadDir . '/' . $fileName; // Полный путь к файлу

    // Загружаем файл
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFilePath)) {
        echo "Файл успешно загружен: $uploadFilePath<br>";

        // Добавляем запись в базу данных
        try {
            $stmt = $connectionDB->prepare("INSERT INTO users (filename, avatar) VALUES (?, ?)");
            $stmt->execute([$fileName, $uploadFilePath]);
            echo "Файл добавлен в базу.";
        } catch (PDOException $e) {
            die("Ошибка базы данных: " . $e->getMessage());
        }
    } else {
        echo "Ошибка загрузки файла.";
    }
} else {
    echo "Нет файла для загрузки.";
}
?>