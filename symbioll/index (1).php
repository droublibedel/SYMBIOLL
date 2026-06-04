<?php
$pageTitle = "Symbioll.Industries — Building intelligent systems";
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

<section class="hero">
    <div class="hero-glow"></div>

    <div class="hero-content">
        <p class="eyebrow">Symbioll.Industries</p>

        <h1>
            Nous construisons des infrastructures digitales intelligentes pour les pays emmergents.
        </h1>

        <p class="hero-text">
            Symbioll conçoit des solutions technologiques modernes dans les domaines
            du commerce, de la data, de l’immobilier, de la sécurité et des infrastructures numériques.
        </p>

        <div class="hero-actions">
            <a href="about.php" class="btn primary">Découvrir Symbioll</a>
            <a href="contact.php" class="btn secondary">Nous contacter</a>
        </div>
    </div>
</section>

<section class="section">
    <p class="section-label">Notre vision</p>
    <h2>Créer des technologies utiles, élégantes et profondément adaptées aux réalités africaines.</h2>

    <div class="grid-3">
        <div class="card">
            <h3>Innovation</h3>
            <p>Des produits pensés pour résoudre de vrais problèmes économiques, sociaux et opérationnels.</p>
        </div>

        <div class="card">
            <h3>Intelligence</h3>
            <p>Des systèmes qui transforment les données en décisions, en automatisations et en valeur.</p>
        </div>

        <div class="card">
            <h3>Impact</h3>
            <p>Une ambition claire : participer à la construction d’infrastructures digitales africaines fortes.</p>
        </div>
    </div>
</section>

<section class="section dark">
    <p class="section-label">Réalisations</p>
    <h2>Des projets conçus comme des infrastructures, pas comme de simples applications.</h2>

    <div class="projects">
        <div class="project-card">
            <span>01</span>
            <h3>VENEXT</h3>
            <p>Infrastructure d’intelligence économique pour le commerce africain.</p>
        </div>

        <div class="project-card">
            <span>02</span>
            <h3>Mandara</h3>
            <p>Plateforme digitale pour la gestion immobilière, les paiements et la sécurité.</p>
        </div>

        <div class="project-card">
            <span>03</span>
            <h3>Shoogum</h3>
            <p>Solution digitale pour accompagner les entrepreneurs modernes.</p>
        </div>
    
       <div class="project-card">
            <span>04</span>
            <h3>Sentynell</h3>
            <p>Solution digitale et infrastructure de transmission, d'orchestration et d'exploitation de l'information terrain en temps réel..</p>
        </div>
    </div>
</section>

<section class="cta">
    <h2>Construisons ensemble les prochains systèmes intelligents.</h2>
    <p>Vous avez une idée, un besoin ou une collaboration à proposer ?</p>
    <a href="contact.php" class="btn primary">Entrer en contact</a>
</section>

</main>

<footer>
    <p>© <?= date("Y") ?> Symbioll Group. All rights reserved.</p>
</footer>

</body>
</html>