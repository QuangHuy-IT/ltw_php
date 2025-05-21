<?php
require_once __DIR__.'/../../inc/auth.php'; requireLogin();
$in = $_POST;
$id = intval($in['vehicle_id'] ?? 0);

try {
  if ($id) {
      $sql = 'UPDATE vehicles SET license_plate=?, vehicle_type=?, brand=?, model=?, color=? WHERE vehicle_id=?';
      $pdo->prepare($sql)->execute([
        $in['license_plate'],$in['vehicle_type'],$in['brand'],$in['model'],$in['color'],$id
      ]);
  } else {
      $sql = 'INSERT INTO vehicles (license_plate, vehicle_type, brand, model, color)
              VALUES (?,?,?,?,?)';
      $pdo->prepare($sql)->execute([
        $in['license_plate'],$in['vehicle_type'],$in['brand'],$in['model'],$in['color']
      ]);
  }
  echo json_encode(['success'=>true]);
} catch (PDOException $e){
  echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
