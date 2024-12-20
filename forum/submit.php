<?php

global $connectionDB;
require_once ('db.php');

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = htmlspecialchars($_POST['password']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $connectionDB -> prepare($query);

            $stmt -> bindParam(':name', $name);
            $stmt -> bindParam(':email', $email);
            $stmt -> bindParam(':password', $passwordHash);
            $stmt -> execute();
            header('Location: http://localhost/forum/index.php', true, 303);
        } catch (PDOException $e) {
            echo "Ошибка " . $e -> getMessage();
        }
    }