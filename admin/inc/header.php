<?php
require_once __DIR__ . '/../../config/path.php'; 
require_once __DIR__ . '/auth.php';
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title><?= $title ?? 'Admin' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/admin/assets/css/admin.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= BASE_URL ?>/admin/dashboard.php">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/admin/dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/admin/vehicles/list.php">Phương tiện</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/admin/owners/list.php">Chủ sở hữu</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/admin/violations/list.php">Vi phạm</a></li>

      </ul>
      <span class="navbar-text me-3"><?= $_SESSION['admin_name'] ?? '' ?></span>
      <a class="btn btn-outline-light btn-sm" href="<?= BASE_URL ?>/admin/logout.php">Logout</a>
    </div>
  </div>
</nav>
<div class="container py-4">
<script src="<?= BASE_URL ?>/admin/assets/js/vehicles.js"></script>


