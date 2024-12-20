<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'upisp-2-23';

    try {
        $connectionDB = new PDO ("mysql:host=$servername; dbname=$dbname", $username, $password);
        $connectionDB -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "CONNECTED DATABASE ";
    } catch (PDOException $e) {
        echo "ERROR CONNECTED" . $e -> getMessage();
        exit();
    }