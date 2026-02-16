<?php
require_once "../includes/auth.php";
requireAdmin();
require_once "../includes/bdd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $mot_classement = $_POST["mot_classement"];

    $stmt = $pdo->prepare("INSERT INTO artice (nom, mot_classement) VALUES (?, ?)");
    $stmt->execute([$nom, $mot_classement]);

    header("Location: dashboard.php");
    exit();
}


$pageTitle = "Ajouter un article";
require_once __DIR__ . "/../includes/header.php";
?>

<main class="container">
    <h1>Ajouter un article</h1>

    <form method="POST">
        <input type="text" name="nom" placeholder="Nom de l'article" required>
        <input type="text" name="mot_classement" placeholder="Mot de classement" required>
        <button type="submit" class="btn-primary">Enregistrer</button>
    </form>

</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
