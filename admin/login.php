<?php
require_once "../bdd.php";
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin["password"])) {
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_username"] = $admin["username"];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<?php $pageTitle = "Connexion Admin"; require_once "../header.php"; ?>

<main class="container">
    <h1>Connexion Admin</h1>

    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Identifiant" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
</main>

<?php require_once "../footer.php"; ?>
