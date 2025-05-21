<?php
require_once __DIR__.'/inc/auth.php'; requireLogin();
$title='Dashboard'; include __DIR__.'/inc/header.php';

// Lấy thống kê nhanh
$totalVehicles   = $pdo->query('SELECT COUNT(*) FROM vehicles')->fetchColumn();
$totalViolations = $pdo->query('SELECT COUNT(*) FROM violations')->fetchColumn();
$unpaid          = $pdo->query("SELECT COUNT(*) FROM violations WHERE payment_status='unpaid'")->fetchColumn();
?>
<h1 class="mb-4">Thống kê nhanh</h1>
<div class="row g-4">
  <div class="col-md-4"><div class="card text-bg-primary"><div class="card-body">
    <h2 class="card-title"><?= $totalVehicles ?></h2>
    <p class="card-text">Phương tiện đã đăng ký</p>
  </div></div></div>
  <div class="col-md-4"><div class="card text-bg-success"><div class="card-body">
    <h2 class="card-title"><?= $totalViolations ?></h2>
    <p class="card-text">Tổng vi phạm</p>
  </div></div></div>
  <div class="col-md-4"><div class="card text-bg-danger"><div class="card-body">
    <h2 class="card-title"><?= $unpaid ?></h2>
    <p class="card-text">Chưa nộp phạt</p>
  </div></div></div>
</div>
<?php include __DIR__.'/inc/footer.php'; // footer đóng </div></body></html>
