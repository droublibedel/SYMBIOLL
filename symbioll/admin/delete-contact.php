<?php
session_start();

require_once "../includes/db.php";
require_once "../includes/functions.php";

requireLogin();

$id = (int)($_GET["id"] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("
        DELETE FROM contacts 
        WHERE id = :id
    ");

    $stmt->execute([":id" => $id]);
}

redirect("dashboard.php");