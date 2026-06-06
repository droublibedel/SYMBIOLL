<?php

$configPath = dirname(__DIR__) . "/config.php";

if (!file_exists($configPath)) {
    die("Configuration manquante : copiez config.example.php vers config.php");
}

$config = require $configPath;
$db = $config["db"];

$host = $db["host"];
$port = $db["port"];
$dbname = $db["name"];
$username = $db["user"];
$password = $db["pass"];

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die("Erreur DB : " . $e->getMessage());
}
