<?php
require_once __DIR__ . '/../../inc/auth.php';
requireLogin();
$in = $_POST;
$owner_id = intval($in['owner_id'] ?? 0) ?: null;   // 0 ⇒ NULL
$id = intval($in['vehicle_id'] ?? 0);

try {
  if ($id) {
    $sql = 'UPDATE vehicles SET license_plate=?, vehicle_type=?, brand=?, model=?, color=?, owner_id=?
        WHERE vehicle_id=?';
    $pdo->prepare($sql)->execute([
      $in['license_plate'],
      $in['vehicle_type'],
      $in['brand'],
      $in['model'],
      $in['color'],
      $owner_id,
      $id
    ]);
  } else {
    $sql = 'INSERT INTO vehicles (license_plate, vehicle_type, brand, model, color, owner_id)
        VALUES (?,?,?,?,?,?)';
    $pdo->prepare($sql)->execute([
      $in['license_plate'],
      $in['vehicle_type'],
      $in['brand'],
      $in['model'],
      $in['color'],
      $owner_id
    ]);
  }
  echo json_encode(['success' => true]);
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
