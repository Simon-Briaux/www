<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isAdmin() {
    return isset($_SESSION['admin_id']);
}

function requireAdmin() {
    if (!isAdmin()) {
        header("Location: /admin/login.php");
        exit();
    }
}
