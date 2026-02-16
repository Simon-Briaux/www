<?php
require_once "../includes/auth.php";
requireAdmin();
require_once "../includes/bdd.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM artice WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $mot_classement = $_POST["mot_classement"];

    $stmt = $pdo->prepare("UPDATE artice SET nom = ?, mot_classement = ? WHERE id = ?");
    $stmt->execute([$nom, $mot_classement, $id]);

    header("Location: dashboard.php");
    exit();
}


$pageTitle = "Modifier article";
require_once __DIR__ . "/../includes/header.php";
?>

<main class="container">
    <h1>Modifier l'article</h1>

    <form method="POST">
        <input type="text" name="nom" value="<?= htmlspecialchars($article["nom"] ?? '') ?>" required>
        <input type="text" name="mot_classement" value="<?= htmlspecialchars($article["mot_classement"] ?? '') ?>" required>
        <button type="submit" class="btn-primary">Mettre à jour</button>
    </form>

</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
