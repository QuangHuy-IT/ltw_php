<?php               /* chọn xe chưa có chủ */
require_once __DIR__.'/../inc/auth.php';  requireLogin();
$owner_id = intval($_GET['owner_id'] ?? 0);
$vehicles  = $pdo->query(
  'SELECT vehicle_id, license_plate
     FROM vehicles WHERE owner_id IS NULL
  ORDER BY license_plate'
)->fetchAll();
?>
<form id="linkForm">
  <input type="hidden" name="owner_id" value="<?=$owner_id?>">
  <div class="mb-2">
    <label class="form-label">Chọn xe chưa có chủ</label>
    <select class="form-select" name="vehicle_id" required>
      <?php foreach($vehicles as $v): ?>
         <option value="<?=$v['vehicle_id']?>"><?=$v['license_plate']?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button class="btn btn-primary w-100">Gán xe</button>
</form>

<script>
$('#linkForm').on('submit',e=>{
  e.preventDefault();
  $.post('../vehicles/ajax/link_vehicle_owner.php',
         $(e.target).serialize(), r=>{
       if(r.success){
         bootstrap.Modal.getInstance('#ownerModal').hide();
         if(typeof loadOwners==='function') loadOwners();
         if(typeof loadTable==='function') loadTable();   // bảng Phương tiện
       }else alert(r.message);
  },'json');
});
</script>
