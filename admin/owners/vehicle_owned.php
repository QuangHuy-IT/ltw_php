<?php                       /* danh sách xe đã gán */
require_once __DIR__.'/../inc/auth.php';  requireLogin();
$owner_id = intval($_GET['owner_id'] ?? 0);
/* lấy danh sách xe đã gán cho chủ sở hữu */
$rows = $pdo->prepare(
  'SELECT vehicle_id, license_plate, vehicle_type, brand, model, color
     FROM vehicles
     WHERE owner_id = ?'
);
$rows->execute([$owner_id]);
?>
<table class="table table-bordered table-sm" id="ownedTbl">
  <thead class="table-light">
    <tr>
      <th>Biển số</th><th>Loại</th><th>Hãng</th><th>Model</th><th>Màu</th><th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rows as $v): ?>
    <tr>
      <td><?=htmlspecialchars($v['license_plate'])?></td>
      <td><?=$v['vehicle_type']?></td>
      <td><?=$v['brand']?></td>
      <td><?=$v['model']?></td>
      <td><?=$v['color']?></td>
      
    </tr>
  <?php endforeach;?>
  </tbody>
</table>


<script>
$('#ownedTbl').on('click','.unlink', e=>{
  const id = $(e.currentTarget).data('id');
  if(!confirm('Gỡ xe này khỏi chủ sở hữu?')) return;
  $.post('../vehicles/ajax/link_vehicle_owner.php',
         {vehicle_id:id, owner_id:0}, r=>{
      if(r.success){
        $(e.currentTarget).closest('tr').remove();
        if(typeof loadTable==='function') loadTable(); // refresh bảng phương tiện
      }else alert(r.message);
  },'json');
});
</script>
