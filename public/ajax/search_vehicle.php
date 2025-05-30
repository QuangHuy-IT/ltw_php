<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__.'/../../config/db.php';

$plate = trim($_GET['license_plate'] ?? '');
if ($plate === '') {
    echo json_encode(['success' => false, 'message' => 'Thiếu biển số']);
    exit;
}


$stmt = $pdo->prepare('SELECT * FROM vehicles WHERE license_plate = ?');
$stmt->execute([$plate]);
$vehicle = $stmt->fetch();

if (!$vehicle) {
    echo json_encode(['success' => false, 'message' => 'Không tìm thấy phương tiện']);
    exit;
}

$violations = $pdo
    ->prepare('SELECT violation_id, description, fine_amount, DATE(violation_date) AS violation_date,
                      payment_status
               FROM violations
               WHERE vehicle_id = ?
               ORDER BY violation_date DESC');
$violations->execute([$vehicle['vehicle_id']]);

echo json_encode([
    'success' => true,
    'data'    => [
        'vehicle'    => $vehicle,
        'violations' => $violations->fetchAll()
    ]
]);
