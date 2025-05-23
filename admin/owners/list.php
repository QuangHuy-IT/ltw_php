<?php
require_once __DIR__.'/../inc/auth.php'; requireLogin();
$title='Chủ sở hữu'; include __DIR__.'/../inc/header.php';
?>
<h1 class="mb-3">Chủ sở hữu</h1>
<button class="btn btn-primary mb-3" onclick="openOwner()">+ Thêm</button>

<table id="tblOwners" class="table table-bordered align-middle">
  <thead class="table-light">
    <tr>
      <th>ID</th><th>Họ tên</th><th>CMND/CCCD</th><th>SĐT</th><th>Địa chỉ</th><th width="120">Hành động</th>
    </tr>
  </thead><tbody></tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="ownerModal" tabindex="-1"><div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header"><h5 class="modal-title" id="ownerTitle"></h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body" id="ownerBody"></div>
</div></div></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= BASE_URL ?>/admin/assets/js/owners.js"></script>
<?php include __DIR__.'/../inc/footer.php'; ?>
