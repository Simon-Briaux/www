<?php
require_once "../includes/auth.php";
requireAdmin();
require_once "../includes/bdd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $stmt = $pdo->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);

    header("Location: dashboard.php");
    exit();
}

$pageTitle = "Ajouter un article";
require_once __DIR__ . "/../includes/header.php";
?>

<main class="container">
    <h1>Ajouter un article</h1>

    <form method="POST">
        <input type="text" name="title" placeholder="Titre" required>
        <textarea name="content" placeholder="Contenu" required></textarea>
        <button type="submit" class="btn-primary">Enregistrer</button>
    </form>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
