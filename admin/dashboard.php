<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../includes/auth.php";
requireAdmin();
require_once "../includes/bdd.php";

$pageTitle = "Dashboard Admin";
require_once __DIR__ . "/../includes/header.php";

// Récupération des articles
$stmt = $pdo->query("SELECT * FROM articles ORDER BY id DESC");
$articles = $stmt->fetchAll();
?>

<main class="container">
    <h1>Bienvenue <?= htmlspecialchars($_SESSION["admin_username"]) ?> 👋</h1>

    <div style="margin:20px 0;">
        <a href="add.php" class="btn-primary">+ Ajouter un article</a>
        <a href="logout.php" class="logout-btn">⎋ Se déconnecter</a>
    </div>

    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($articles as $article): ?>
        <tr>
            <td><?= $article["id"] ?></td>
            <td><?= htmlspecialchars($article["title"]) ?></td>
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
    </table>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
