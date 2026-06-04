<?php

function sanitize($data)
{
    return htmlspecialchars(
        trim($data),
        ENT_QUOTES,
        'UTF-8'
    );
}

function redirect($url)
{
    header("Location: " . $url);
    exit;
}

function isPostRequest()
{
    return $_SERVER["REQUEST_METHOD"] === "POST";
}

function isLoggedIn()
{
    return isset($_SESSION["admin_id"]);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        redirect("login.php");
    }
}

function formatDateTime($date)
{
    return date("d/m/Y à H:i", strtotime($date));
}

function getContactStatusBadge($status)
{
    switch ($status) {

        case "new":
            return '<span class="badge badge-new">Nouveau</span>';

        case "read":
            return '<span class="badge badge-read">Lu</span>';

        case "archived":
            return '<span class="badge badge-archived">Archivé</span>';

        default:
            return '<span class="badge">Inconnu</span>';
    }
}

function getTotalContacts(PDO $pdo)
{
    $stmt = $pdo->query("
        SELECT COUNT(*) as total
        FROM contacts
    ");

    $result = $stmt->fetch();

    return $result["total"] ?? 0;
}

function getUnreadContacts(PDO $pdo)
{
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as total
        FROM contacts
        WHERE status = 'new'
    ");

    $stmt->execute();

    $result = $stmt->fetch();

    return $result["total"] ?? 0;
}

function getLatestContacts(PDO $pdo, $limit = 10)
{
    $stmt = $pdo->prepare("
        SELECT *
        FROM contacts
        ORDER BY created_at DESC
        LIMIT :limit
    ");

    $stmt->bindValue(
        ":limit",
        (int)$limit,
        PDO::PARAM_INT
    );

    $stmt->execute();

    return $stmt->fetchAll();
}