<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

function isLoggedIn(): bool {
    return isset($_SESSION['admin_id']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: BT3_LTW/admin/login.php');
        exit;
    }
}
