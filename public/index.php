<?php
require_once __DIR__ . '/../config/db.php';
/* Top 3 xe vi phạm nhiều nhất */
$topVehicles = $pdo->query("
  SELECT v.brand, v.model, COUNT(*) AS cnt
  FROM violations AS viol
  JOIN vehicles  AS v ON v.vehicle_id = viol.vehicle_id
  GROUP BY v.brand, v.model
  ORDER BY cnt DESC
  LIMIT 3
")->fetchAll();

/* Top 3 lỗi vi phạm nhiều nhất */
$topFaults = $pdo->query("
  SELECT description, COUNT(*) AS cnt
  FROM violations
  GROUP BY description
  ORDER BY cnt DESC
  LIMIT 3
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi" class="h-100">
<head>
  <meta charset="utf-8">
  <title>Tra cứu vi phạm giao thông</title>

  <!-- Bootstrap & icon CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="d-flex flex-column h-100 bg-light">

  <!-- ===== HERO ===== -->
  <header class="hero text-center text-white mb-4">
    <div class="container py-5">
      <h1 class="display-5 fw-bold mb-3">
        <i class="fa-solid fa-car-burst me-2"></i>
        Tra cứu phương tiện vi phạm
      </h1>

      <!-- Form tra cứu -->
      <form id="searchForm" class="row g-2 justify-content-center needs-validation" novalidate>
        <div class="col-auto">
          <div class="input-group">
            <span class="input-group-text bg-white"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input name="license" id="license" type="text"
                   class="form-control"
                   placeholder="VD: 28A-12345"
                   pattern="^[0-9]{2}[A-Z][0-9A-Z]?-?(?:[0-9]{5}|[0-9]{3}\.[0-9]{2})$"
                   required>
            <div class="invalid-feedback">Biển số không hợp lệ.</div>
          </div>
        </div>
        <div class="col-auto">
          <button class="btn btn-primary px-4" type="submit">Tra cứu</button>
        </div>
      </form>
    </div>
  </header>

  <!-- ===== NỘI DUNG CHÍNH ===== -->
  <main class="flex-shrink-0">
    <div class="container">

      <!-- Thống kê nhanh -->
      <div class="row gy-4">
        <!-- Top xe -->
        <div class="col-md-6">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent fw-semibold">
              <i class="fa-solid fa-motorcycle me-1"></i>Top 3 xe vi phạm nhiều nhất
            </div>
            <ul class="list-group list-group-flush">
              <?php foreach ($topVehicles as $v): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($v['brand'].' '.$v['model']) ?>
                <span class="badge rounded-pill bg-danger"><?= $v['cnt'] ?></span>
              </li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>

        <!-- Top lỗi -->
        <div class="col-md-6">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent fw-semibold">
              <i class="fa-solid fa-triangle-exclamation me-1"></i>Top 3 lỗi vi phạm nhiều nhất
            </div>
            <ul class="list-group list-group-flush">
              <?php foreach ($topFaults as $f): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($f['description']) ?>
                <span class="badge rounded-pill bg-warning text-dark"><?= $f['cnt'] ?></span>
              </li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
      </div>

      <!-- Kết quả tra cứu -->
      <div id="resultCard" class="card shadow-sm mt-5 d-none">
        <div class="card-header bg-primary text-white">
          <i class="fa-solid fa-table-list me-1"></i>Kết quả tra cứu
          <span id="spinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
        </div>
        <div class="card-body" id="resultBody"><!-- dynamic --></div>
      </div>
    </div>
  </main>
  <footer class="text-body-secondary py-4 mt-auto text-center">
    <div class="small mb-2">&copy; <?= date('Y') ?> Tra cứu vi phạm</div>
    <a href="../admin/login.php" class="btn btn-sm btn-secondary">
      <i class="fa-solid fa-lock me-1"></i>Đăng nhập Quản trị
    </a>
  </footer>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="assets/js/search.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
