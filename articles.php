<?php
// Affichage des erreurs PHP (debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
require_once __DIR__ . '/bdd.php';

// Récupération de tous les articles
$stmt = $pdo->query("SELECT * FROM article");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des catégories uniques
$stmtTags = $pdo->query("SELECT DISTINCT mot_classement FROM article");
$tags = $stmtTags->fetchAll(PDO::FETCH_COLUMN);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les articles - Pernois Matériaux</title>
    <link rel="icon" href="Images/Logo.jpg" type="image/jpg">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container nav">
        <div class="brand">Pernois<span>Materiaux</span></div>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php#about">À propos</a>
            <a href="index.php#contact">Contact</a>
        </nav>
    </div>
</header>

<main class="container">

    <!-- HERO -->
    <section class="hero">
        <h1>Tous nos articles</h1>
        <p>Découvrez l’ensemble de nos matériaux disponibles.</p>
    </section>

    <!-- BARRE DE RECHERCHE -->
   <div class="filters-container">

        <!-- Recherche -->
        <div class="search-bar">
            <input 
                type="text" 
                id="searchInput"
                placeholder="Rechercher un matériau..."
                autocomplete="off"
            >
        </div>

        <!-- Menu déroulant catégories -->
        <div class="dropdown">
            <button type="button" id="dropdownBtn" class="dropdown-btn">
                Catégories ▼
            </button>

            <div id="dropdownMenu" class="dropdown-menu">
                <?php foreach ($tags as $tag): ?>
                    <label class="dropdown-item">
                        <input 
                            type="checkbox" 
                            class="filter-checkbox"
                            value="<?= strtolower($tag) ?>"
                        >
                        <?= htmlspecialchars($tag) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

    </div>


    <!-- ARTICLES -->
    <section id="articles" class="grid">

        <?php if (count($articles) > 0): ?>
            <?php foreach ($articles as $a): ?>

                <a href="article.php?id=<?= $a['id'] ?>" class="card-link">
                    <article 
                        class="card"
                        data-nom="<?= strtolower($a['nom']) ?>"
                        data-tag="<?= strtolower($a['mot_classement']) ?>"
                    >
                        <span class="tag">
                            <?= htmlspecialchars($a['mot_classement']) ?>
                        </span>

                        <div class="title">
                            <?= htmlspecialchars($a['nom']) ?>
                        </div>
                    </article>
                </a>

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

<button id="scrollTopBtn" title="Retour en haut">
    ↑
</button>


<script src="main.js"></script>
</body>
</html>
