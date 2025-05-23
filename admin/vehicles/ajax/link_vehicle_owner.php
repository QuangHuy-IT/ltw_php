<?php
require_once __DIR__.'/../../inc/auth.php';   // đã có $pdo
requireLogin();

$vehicle_id = intval($_POST['vehicle_id'] ?? 0);
$owner_id   = intval($_POST['owner_id']   ?? 0);

if(!$vehicle_id || !$owner_id){
    http_response_code(400);
    echo json_encode(['success'=>false,'message'=>'Thiếu dữ liệu']);
    exit;
}

$sql = 'UPDATE vehicles SET owner_id = ? WHERE vehicle_id = ?';
$pdo->prepare($sql)->execute([$owner_id, $vehicle_id]);

echo json_encode(['success'=>true]);
