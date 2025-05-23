<?php
require_once __DIR__.'/../inc/auth.php'; requireLogin();
$id = intval($_GET['id']??0);
$owner=['full_name'=>'','id_number'=>'','phone'=>'','address'=>''];
if($id){
  $st=$pdo->prepare('SELECT * FROM owners WHERE owner_id=?');$st->execute([$id]);
  $owner=$st->fetch()?:$owner;
}
?>
<form id="ownerForm">
<input type="hidden" name="owner_id" value="<?= $id ?>">
<div class="mb-2">
  <label class="form-label">Họ tên</label>
  <input class="form-control" name="full_name" value="<?= $owner['full_name'] ?>" required>
</div>
<div class="mb-2">
  <label class="form-label">CMND/CCCD</label>
  <input class="form-control" name="id_number" value="<?= $owner['id_number'] ?>" required>
</div>
<div class="mb-2">
  <label class="form-label">Số điện thoại</label>
  <input class="form-control" name="phone" value="<?= $owner['phone'] ?>">
</div>
<div class="mb-2">
  <label class="form-label">Địa chỉ</label>
  <input class="form-control" name="address" value="<?= $owner['address'] ?>">
</div>
<button class="btn btn-primary">Lưu</button>
</form>
<script>
$('#ownerForm').on('submit',e=>{
 e.preventDefault();
 $.post('ajax/save_owner.php',$(e.target).serialize(),r=>{
   if(r.success){bootstrap.Modal.getInstance('#ownerModal').hide();loadOwners();}
   else alert(r.message);
 },'json');
});
</script>
