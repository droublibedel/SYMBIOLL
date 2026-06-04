<?php
session_start();

require_once "../includes/db.php";
require_once "../includes/functions.php";

requireLogin();

$totalContacts = getTotalContacts($pdo);
$unreadContacts = getUnreadContacts($pdo);
$contacts = getLatestContacts($pdo, 100);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard — Symbioll</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header class="navbar">
    <a href="../index.php" class="logo">symbioll<span>.</span></a>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Déconnexion</a>
    </nav>
</header>

<main class="admin-page">

    <section class="page-hero admin-hero">
        <p class="eyebrow">Administration</p>
        <h1>Tableau de bord Symbioll</h1>
        <p>Bienvenue, <?= htmlspecialchars($_SESSION["admin_name"]) ?>.</p>
    </section>

    <section class="section admin-stats">
        <div class="grid-3">
            <div class="card">
                <h3>Total contacts</h3>
                <strong class="admin-number"><?= $totalContacts ?></strong>
            </div>

            <div class="card">
                <h3>Nouveaux messages</h3>
                <strong class="admin-number"><?= $unreadContacts ?></strong>
            </div>

            <div class="card">
                <h3>Statut</h3>
                <strong class="admin-number">Actif</strong>
            </div>
        </div>
    </section>

    <section class="section">
        <p class="section-label">Messages reçus</p>
        <h2>Contacts enregistrés</h2>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                        <th>Statut</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!$contacts): ?>
                        <tr>
                            <td colspan="7">Aucun contact enregistré.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?= formatDateTime($contact["created_at"]) ?></td>
                            <td><?= htmlspecialchars($contact["fullname"]) ?></td>
                            <td><?= htmlspecialchars($contact["email"]) ?></td>
                            <td><?= htmlspecialchars($contact["subject"] ?: "—") ?></td>
                            <td><?= getContactStatusBadge($contact["status"]) ?></td>
                            <td class="message-cell">
                                <?= nl2br(htmlspecialchars($contact["message"])) ?>
                            </td>
                            <td class="actions-cell">
                                <a href="mark-read.php?id=<?= $contact["id"] ?>" class="mini-btn">
                                    Lu
                                </a>

                                <a href="archive-contact.php?id=<?= $contact["id"] ?>" class="mini-btn">
                                    Archiver
                                </a>

                                <a href="delete-contact.php?id=<?= $contact["id"] ?>" 
                                   class="mini-btn danger"
                                   onclick="return confirm('Supprimer ce contact ?');">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </section>

</main>

</body>
</html>