<?php

if (php_sapi_name() !== "cli") {
    die("Ce script doit être exécuté en ligne de commande.\n");
}

require_once dirname(__DIR__) . "/includes/db.php";

$email = $argv[1] ?? null;
$password = $argv[2] ?? null;
$name = $argv[3] ?? "Admin";

if (!$email || !$password) {
    echo "Usage: php scripts/create-admin.php email mot_de_passe [nom]\n";
    exit(1);
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
    INSERT INTO admins (fullname, email, password_hash)
    VALUES (:name, :email, :hash)
    ON DUPLICATE KEY UPDATE
        fullname = VALUES(fullname),
        password_hash = VALUES(password_hash)
");

$stmt->execute([
    ":name" => $name,
    ":email" => $email,
    ":hash" => $hash,
]);

echo "Admin prêt : {$email}\n";
