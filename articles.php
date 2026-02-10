<?php
// Affichage des erreurs PHP (utile pour debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
require_once __DIR__ . '/bdd.php';

// Récupération de tous les articles
$stmt = $pdo->query("SELECT * FROM article");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les articles - Pernois Matériaux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container nav">
        <div class="brand">Pernois<span>Materiaux</span></div>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="articles.php">Articles</a>
            <a href="#about">À propos</a>
            <a href="#contact">Contact</a>
        </nav>
    </div>
</header>

<main class="container">

    <!-- HERO -->
    <section class="hero">
        <h1>Tous nos articles</h1>
        <p>Découvrez l’ensemble de nos matériaux disponibles.</p>
    </section>

    <!-- ARTICLES -->
    <section class="grid" style="margin-top:2rem;">
        <?php if (count($articles) > 0): ?>

            <?php foreach ($articles as $a): ?>
                <article class="card">

                    <?php if (!empty($a['image'])): ?>
                        <img
                            class="thumb"
                            src="images/<?= htmlspecialchars($a['image']) ?>"
                            alt="<?= htmlspecialchars($a['nom']) ?>">
                    <?php endif; ?>

                    <div class="content">
                        <span class="tag"><?= htmlspecialchars($a['mot_classement']) ?></span>

                        <div class="title"><?= htmlspecialchars($a['nom']) ?></div>
                    </div>

                </article>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Aucun article disponible pour le moment.</p>
        <?php endif; ?>
    </section>

</main>

<footer>
    <div class="container">
        <p>© 2026 — Pernois Matériaux</p>
    </div>
</footer>

<script src="main.js"></script>
</body>
</html>
