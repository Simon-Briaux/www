<?php
require_once "../includes/auth.php";
requireAdmin();
require_once "../includes/bdd.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    header("Location: dashboard.php");
    exit();
}

$pageTitle = "Modifier article";
require_once __DIR__ . "/../includes/header.php";
?>

<main class="container">
    <h1>Modifier l'article</h1>

    <form method="POST">
        <input type="text" name="title" value="<?= htmlspecialchars($article["title"]) ?>" required>
        <textarea name="content" required><?= htmlspecialchars($article["content"]) ?></textarea>
        <button type="submit" class="btn-primary">Mettre à jour</button>
    </form>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
