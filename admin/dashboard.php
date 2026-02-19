<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../includes/auth.php";
requireAdmin();
require_once "../includes/bdd.php";

$pageTitle = "Dashboard Admin";
require_once __DIR__ . "/../includes/header.php";

/* =========================
   Récupération des articles
========================= */
$stmt = $pdo->query("SELECT * FROM article ORDER BY id ASC");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   Récupération des catégories
========================= */
$stmtTags = $pdo->query("SELECT DISTINCT mot_classement FROM article");
$tags = $stmtTags->fetchAll(PDO::FETCH_COLUMN);
?>

<main class="container">
    <h1>Bienvenue <?= htmlspecialchars($_SESSION["admin_username"]) ?> 👋</h1>

    <div style="margin:20px 0; display:flex; gap:10px; flex-wrap:wrap;">
        <a href="add.php" class="btn-primary">+ Ajouter un article</a>
        <a href="logout.php" class="logout-btn">⎋ Se déconnecter</a>
    </div>

    <!-- =========================
         BARRE DE RECHERCHE (LIVE)
    ========================== -->

    <div class="filters-container">

        <!-- Recherche -->
        <div class="search-bar">
            <input 
                type="text" 
                id="searchInput"
                placeholder="Rechercher un article..."
                autocomplete="off"
            >
        </div>

        <!-- Dropdown catégories -->
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


    <!-- =========================
         TABLE ARTICLES
    ========================== -->

    <table class="admin-table" id="articlesTable">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Mot classement</th>
            <th>Actions</th>
        </tr>

        <?php if (count($articles) > 0): ?>
            <?php foreach ($articles as $article): ?>

            <tr 
                class="article-row"
                data-nom="<?= strtolower($article["nom"]) ?>"
                data-tag="<?= strtolower($article["mot_classement"]) ?>"
            >
                <td><?= $article["id"] ?></td>

                <td><?= htmlspecialchars($article["nom"] ?? '') ?></td>

                <td><?= htmlspecialchars($article["mot_classement"] ?? '') ?></td>

                <td>
                    <a href="edit.php?id=<?= $article["id"] ?>" class="btn-edit">
                        Modifier
                    </a>

                    <a href="delete.php?id=<?= $article["id"] ?>"
                       class="btn-delete"
                       onclick="return confirm('Supprimer cet article ?')">
                       Supprimer
                    </a>
                </td>
            </tr>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun article trouvé.</td>
            </tr>
        <?php endif; ?>

    </table>

</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
