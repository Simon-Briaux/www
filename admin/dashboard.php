<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../includes/auth.php";
requireAdmin();
require_once "../includes/bdd.php";

$pageTitle = "Dashboard Admin";
require_once __DIR__ . "/../includes/header.php";

// Récupération de la recherche si elle existe
$search = $_GET["search"] ?? "";

// Récupération des articles filtrés si recherche
if (!empty($search)) {
    $stmt = $pdo->prepare("
        SELECT * FROM article 
        WHERE nom LIKE ? OR mot_classement LIKE ?
        ORDER BY id ASC
    ");
    $stmt->execute(["%$search%", "%$search%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM article ORDER BY id ASC");
}

$articles = $stmt->fetchAll();
?>

<main class="container">
    <h1>Bienvenue <?= htmlspecialchars($_SESSION["admin_username"]) ?> 👋</h1>

    <div style="margin:20px 0; display:flex; gap:10px; flex-wrap:wrap;">
        <a href="add.php" class="btn-primary">+ Ajouter un article</a>
        <a href="logout.php" class="logout-btn">⎋ Se déconnecter</a>
    </div>

    <!-- BARRE DE RECHERCHE -->
    <form method="GET" class="search-form">
        <input type="text" name="search" 
               placeholder="Rechercher un article ou catégorie..."
               value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn-primary">Rechercher</button>
    </form>

    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Mot classement</th>
            <th>Actions</th>
        </tr>

        <?php if (count($articles) > 0): ?>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article["id"] ?></td>
                <td><?= htmlspecialchars($article["nom"] ?? '') ?></td>
                <td><?= htmlspecialchars($article["mot_classement"] ?? '') ?></td>
                <td>
                    <a href="edit.php?id=<?= $article["id"] ?>" class="btn-edit">Modifier</a>
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
