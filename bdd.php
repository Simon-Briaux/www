<?php
    $host = 'localhost';
    $dbname = 'pernoismateriaux';
    $user = 'simon';
    $pass = 'root';

    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    } catch (PDOException $e) {
        die("Erreur connexion BDD : " . $e->getMessage());
    }
?>