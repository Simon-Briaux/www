<?php
require_once "../includes/auth.php";
requireAdmin();
?>

<?php $pageTitle = "Dashboard Admin"; require_once "../header.php"; ?>

<main class="container">
    <h1>Bienvenue <?= $_SESSION["admin_username"] ?> 👋</h1>

    <p>Zone d'administration.</p>

    <a href="logout.php">Se déconnecter</a>
</main>

<?php require_once "../footer.php"; ?>
