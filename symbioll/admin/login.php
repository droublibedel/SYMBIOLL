<?php
session_start();

require_once "../includes/db.php";
require_once "../includes/functions.php";

$error = "";

if (isPostRequest()) {
    $email = sanitize($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
    $stmt->execute([":email" => $email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin["password_hash"])) {
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_name"] = $admin["fullname"];
        redirect("dashboard.php");
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin — Symbioll</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<main class="admin-login">
    <div class="contact-card admin-login-card">
        <a href="../index.php" class="logo">symbioll<span>.</span></a>

        <h2>Connexion admin</h2>

        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>

            <button class="btn primary full" type="submit">Se connecter</button>
        </form>
    </div>
</main>

</body>
</html>