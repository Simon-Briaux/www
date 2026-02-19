<?php
// Affichage des erreurs PHP (debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
require_once __DIR__ . '/includes/bdd.php';

// Récupération de tous les articles
$stmt = $pdo->query("SELECT * FROM article");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des catégories uniques
$stmtTags = $pdo->query("SELECT DISTINCT mot_classement FROM article");
$tags = $stmtTags->fetchAll(PDO::FETCH_COLUMN);

?>

<?php
$pageTitle = "Tous les articles - Pernois Matériaux";
require_once "includes/header.php";
?>

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

            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun article disponible pour le moment.</p>
        <?php endif; ?>
    </section>
</main>



<button id="scrollTopBtn" title="Retour en haut">
    ↑
</button>


<?php require_once "includes/footer.php"; ?>

</body>
</html>
