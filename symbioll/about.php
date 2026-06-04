<?php
$pageTitle = "À propos — Symbioll Group";
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
    <p class="eyebrow">À propos</p>
    <h1>Symbioll est un studio technologique qui construit des solutions intelligentes.</h1>
    <p>
        Nous développons des plateformes digitales modernes pour répondre à des problématiques
        concrètes : commerce, immobilier, sécurité, data, automatisation et transformation numérique.
    </p>
</section>

<section class="section">
    <p class="section-label">Notre mission</p>
    <h2>Transformer les idées ambitieuses en produits technologiques solides.</h2>

    <div class="about-block">
        <p>
            Symbioll Group œuvre dans le développement de solutions ITech capables
            d’apporter de la structure, de la visibilité et de l’intelligence aux organisations.
        </p>

        <p>
            Notre approche repose sur une conviction simple : la technologie ne doit pas seulement
            être belle ou moderne. Elle doit comprendre les réalités du terrain, fluidifier les opérations,
            révéler les données importantes et aider les utilisateurs à mieux décider.
        </p>
    </div>
</section>

<section class="section dark">
    <p class="section-label">Nos domaines</p>

    <div class="grid-3">
        <div class="card">
            <h3>Solutions web & mobile</h3>
            <p>Applications modernes, rapides, accessibles et adaptées aux usages réels.</p>
        </div>

        <div class="card">
            <h3>Data & intelligence</h3>
            <p>Analyse, tableaux de bord, automatisation et systèmes de décision.</p>
        </div>

        <div class="card">
            <h3>Infrastructures digitales</h3>
            <p>Plateformes structurantes pour les entreprises, institutions et écosystèmes.</p>
        </div>
    </div>
</section>

<section class="cta">
    <h2>Une technologie sérieuse doit être simple à utiliser.</h2>
    <p>C’est cette philosophie qui guide chaque produit Symbioll.</p>
</section>

</main>

<footer>
    <p>© <?= date("Y") ?> Symbioll Group. All rights reserved.</p>
</footer>

</body>
</html>