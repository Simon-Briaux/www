<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($pageTitle) ? $pageTitle : "Pernois Matériaux" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/Images/Logo.jpg" type="image/jpg">

    <meta name="description" content="Pernois Matériaux - Vente de matériaux de construction">

    <!-- CSS -->
    <link rel="stylesheet" href="/includes/style.css">

    <!-- JS -->
    <script src="/includes/main.js" defer></script>
</head>
<body>

<header>
    <div class="container nav">
        <div class="brand">
            <a href="/index.php" class="card-link">
                Pernois<span>Materiaux</span>
            </a>
        </div>

        <?php require_once __DIR__ . "/auth.php"; ?>

        <nav>
            <?php if (isAdmin()): ?>
                <a href="/admin/dashboard.php">Admin</a>
            <?php else: ?>
                <a href="/admin/login.php">Connexion</a>
            <?php endif; ?>

            <a href="/index.php">Accueil</a>
            <a href="/articles.php">Articles</a>
            <a href="/index.php#about">À propos</a>
            <a href="/index.php#contact">Contact</a>
        </nav>
    </div>
</header>
