<?php
require_once __DIR__.'/../inc/auth.php'; requireLogin();
$title='Danh sách phương tiện'; include __DIR__.'/../inc/header.php';
?>
<h1 class="mb-3">Phương tiện</h1>
<button class="btn btn-primary mb-3" onclick="openForm()">+ Thêm mới</button>
<table id="tblVehicles" class="table table-bordered align-middle">
  <thead class="table-light">
    <tr>
      <th>ID</th><th>Biển số</th><th>Loại</th><th>Hãng</th><th>Màu</th><th width="120">Hành động</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<!-- Modal form -->
<div class="modal fade" id="vehicleModal" tabindex="-1">
 <div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header">
   <h5 class="modal-title" id="modalTitle"></h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
 </div><div class="modal-body" id="modalBody"></div></div></div></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/admin/assets/js/vehicles.js"></script>
<?php include __DIR__.'/../inc/footer.php'; ?>
