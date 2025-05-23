<?php
require_once __DIR__.'/../inc/auth.php'; requireLogin();
$id = intval($_GET['id'] ?? 0);
$vio = ['vehicle_id'=>'','violation_date'=>date('Y-m-d'),'description'=>'','fine_amount'=>0];
if($id){
  $st=$pdo->prepare('SELECT * FROM violations WHERE violation_id=?'); $st->execute([$id]);
  $vio=$st->fetch() ?: $vio;
}
$vehicles=$pdo->query('SELECT vehicle_id, license_plate FROM vehicles ORDER BY license_plate')->fetchAll();
?>
<form id="vioForm">
  <input type="hidden" name="violation_id" value="<?=$id?>">
  <div class="mb-2">
    <label class="form-label">Biển số</label>
    <select class="form-select" name="vehicle_id" required>
      <?php foreach($vehicles as $v): ?>
        <option value="<?=$v['vehicle_id']?>" <?= $v['vehicle_id']==$vio['vehicle_id']?'selected':'' ?>>
          <?=$v['license_plate']?>
        </option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="mb-2">
    <label class="form-label">Ngày</label>
    <input type="date" class="form-control" name="violation_date" value="<?=$vio['violation_date']?>">
  </div>
  <div class="mb-2">
    <label class="form-label">Mô tả</label>
    <textarea class="form-control" name="description"><?=$vio['description']?></textarea>
  </div>
  <div class="mb-2">
    <label class="form-label">Tiền phạt (₫)</label>
    <input type="number" class="form-control" name="fine_amount" value="<?=$vio['fine_amount']?>">
  </div>
  <button class="btn btn-primary">Lưu</button>
</form>
<script>
$('#vioForm').on('submit', e=>{
  e.preventDefault();
  $.post('ajax/save_violation.php', $(e.target).serialize(), r=>{
    if(r.success){bootstrap.Modal.getInstance('#vioModal').hide();loadVio();}
    else alert(r.message);
  },'json');
});
</script>
