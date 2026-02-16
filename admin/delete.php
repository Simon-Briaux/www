<?php
require_once "../includes/auth.php";
requireAdmin();
require_once "../includes/bdd.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
$stmt->execute([$id]);

header("Location: dashboard.php");
exit();
