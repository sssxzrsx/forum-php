<?php 
require_once ('db.php');
global $connectionDB;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];


    try {
        $query = "SELECT * FROM users WHERE name = :name";
        $stmt = $connectionDB -> prepare($query);
        $stmt -> bindParam(':name', $name);
        $stmt -> execute();

        if ($stmt -> rowCount()>0) {
            $user = $stmt -> fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                echo "Успешно! " . $name;
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                header('Location: http://localhost/forum/profile.php', true, 303);
            }
            else { 
                echo "Неверный пароль!";
                header('Location: http://localhost/forum/auth.php', true, 303);
            }
        }
        else {
            header('Location: http://localhost/forum/auth.php', true, 303);
        }
    }
    catch (PDOException $e) {
        echo "Ошибка! " . $e -> getMessage();
        header('Location: http://localhost/forum/index.php', true, 404);
    }
}