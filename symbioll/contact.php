<?php
require_once "includes/functions.php";
require_once "includes/db.php";

$pageTitle = "Contact — Symbioll Group";
$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = trim($_POST["fullname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $company = trim($_POST["company"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($fullname === "" || $email === "" || $message === "") {
        $error = "Veuillez remplir les champs obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse email invalide.";
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO contacts 
            (fullname, email, phone, company, subject, message)
            VALUES 
            (:fullname, :email, :phone, :company, :subject, :message)
        ");

        $stmt->execute([
            ":fullname" => $fullname,
            ":email" => $email,
            ":phone" => $phone,
            ":company" => $company,
            ":subject" => $subject,
            ":message" => $message
        ]);

        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>

    <link rel="stylesheet" href="assets/css/style.css">
    <script defer src="assets/js/main.js"></script>
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">
        symbioll<span>.</span>
    </a>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="about.php">À propos</a>
        <a href="contact.php">Contact</a>
    </nav>
</header>

<main>

<section class="page-hero">
    <p class="eyebrow">Contact</p>
    <h1>Parlez-nous de votre projet, de votre besoin ou de votre idée.</h1>
    <p>
        L’équipe Symbioll vous répondra avec attention.
    </p>
</section>

<section class="contact-section">
    <div class="contact-card">
        <?php if ($success): ?>
            <div class="alert success">
                Votre message a bien été envoyé. Merci de votre intérêt pour Symbioll.
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="contact.php">
            <div class="form-grid">
                <div>
                    <label>Nom complet *</label>
                    <input type="text" name="fullname" required>
                </div>

                <div>
                    <label>Email *</label>
                    <input type="email" name="email" required>
                </div>
            </div>

            <div class="form-grid">
                <div>
                    <label>Téléphone</label>
                    <input type="text" name="phone">
                </div>

                <div>
                    <label>Entreprise</label>
                    <input type="text" name="company">
                </div>
            </div>

            <div>
                <label>Sujet</label>
                <input type="text" name="subject">
            </div>

            <div>
                <label>Message *</label>
                <textarea name="message" rows="6" required></textarea>
            </div>

            <button type="submit" class="btn primary full">Envoyer le message</button>
        </form>
    </div>
</section>

</main>

<footer>
    <p>© <?= date("Y") ?> Symbioll Group. All rights reserved.</p>
</footer>

</body>
</html>