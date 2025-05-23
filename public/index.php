<?php
require_once __DIR__.'/../config/db.php';

/* Top 3 xe vi phạm nhiều nhất */
$topVehicles = $pdo->query("
    SELECT v.brand, v.model, COUNT(*) AS cnt
      FROM violations AS viol
      JOIN vehicles    AS v ON v.vehicle_id = viol.vehicle_id
  GROUP BY v.brand, v.model          -- gộp theo Hãng + Model
  ORDER BY cnt DESC
     LIMIT 3
")->fetchAll();

/* Top 3 lỗi vi phạm nhiều nhất – KHÔNG còn JOIN */
$topFaults = $pdo->query("
    SELECT description, COUNT(*) AS cnt
      FROM violations
  GROUP BY description
  ORDER BY cnt DESC
     LIMIT 3
")->fetchAll();
?>

<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Tra cứu phương tiện vi phạm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="mb-4 text-center">Tra cứu phương tiện vi phạm</h1>

  <form id="searchForm" class="row g-3 needs-validation" novalidate>
      <div class="col-md-6 offset-md-3">
          <label for="license" class="form-label">Biển số xe</label>
          <input type="text" class="form-control" id="license" name="license" placeholder="VD: 30A‑123.45" required>
          <div class="invalid-feedback">Vui lòng nhập biển số.</div>
      </div>
      <div class="col‑12 text-center">
          <button class="btn btn-primary" type="submit">Tra cứu</button>
      </div>
  </form>

  <!-- ==== Thống kê nhanh ==== -->
<div class="row mt-5">
  <!-- Top 3 xe vi phạm -->
  <div class="col-md-6 mb-4">
    <h5 class="text-primary">Top 3 xe vi phạm nhiều nhất</h5>
    <ul class="list-group shadow-sm">
      <?php foreach ($topVehicles as $v): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <?= htmlspecialchars($v['brand'].' '.$v['model']) ?>
          <span class="badge bg-danger rounded-pill"><?= $v['cnt'] ?></span>
        </li>
      <?php endforeach; ?>
      <?php if (empty($topVehicles)): ?>
        <li class="list-group-item text-muted fst-italic">Chưa có dữ liệu</li>
      <?php endif; ?>
    </ul>
  </div>

  <!-- Top 3 lỗi vi phạm -->
  <div class="col-md-6 mb-4">
    <h5 class="text-primary">Top 3 lỗi vi phạm nhiều nhất</h5>
    <ul class="list-group shadow-sm">
      <?php foreach ($topFaults as $f): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <?= htmlspecialchars($f['description']) ?>
          <span class="badge bg-warning rounded-pill"><?= $f['cnt'] ?></span>
        </li>
      <?php endforeach; ?>
      <?php if (empty($topFaults)): ?>
        <li class="list-group-item text-muted fst-italic">Chưa có dữ liệu</li>
      <?php endif; ?>
    </ul>
  </div>
</div>
<!-- ==== /Thống kê nhanh ==== -->


  <div id="resultCard" class="card mt-5 d-none">
      <div class="card-header">Kết quả tra cứu</div>
      <div class="card-body" id="resultBody"><!-- dynamic --></div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="assets/js/search.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
