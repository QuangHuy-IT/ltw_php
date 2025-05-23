<?php
require_once __DIR__.'/../inc/auth.php'; requireLogin();
$id = intval($_GET['id'] ?? 0);
$owner_id = intval($_GET['owner_id'] ?? ($vehicle['owner_id'] ?? 0));


$vehicle = ['license_plate'=>'','vehicle_type'=>'','brand'=>'','model'=>'','color'=>''];
if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM vehicles WHERE vehicle_id=?');
    $stmt->execute([$id]);
    $vehicle = $stmt->fetch() ?: $vehicle;
}
?>
<form id="vehicleForm">
<input type="hidden" name="vehicle_id" value="<?= $id ?>">
<input type="hidden" name="owner_id" value="<?= $owner_id ?>">
<div class="row g-3">
  <div class="col-md-4">
    <label class="form-label">Biển số</label>
    <input class="form-control" name="license_plate" value="<?= $vehicle['license_plate'] ?>" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Loại</label>
    <input class="form-control" name="vehicle_type" value="<?= $vehicle['vehicle_type'] ?>">
  </div>
  <div class="col-md-4">
    <label class="form-label">Hãng</label>
    <input class="form-control" name="brand" value="<?= $vehicle['brand'] ?>">
  </div>
  <div class="col-md-4">
    <label class="form-label">Model</label>
    <input class="form-control" name="model" value="<?= $vehicle['model'] ?>">
  </div>
  <div class="col-md-4">
    <label class="form-label">Màu</label>
    <input class="form-control" name="color" value="<?= $vehicle['color'] ?>">
  </div>
</div>
<hr>
<button class="btn btn-primary">Lưu</button>
</form>
<script>
$('#vehicleForm').on('submit', function(e){
  e.preventDefault();
  $.post('ajax/save_vehicle.php', $(this).serialize(), res=>{
    if(res.success){bootstrap.Modal.getInstance('#vehicleModal').hide();loadTable();}
    else alert(res.message);
  },'json');
});
</script>
