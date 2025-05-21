<?php require_once __DIR__.'/../config/db.php'; ?>
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
