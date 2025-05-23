<?php
require_once __DIR__ . '/../../inc/auth.php';
requireLogin();
$stmt = $pdo->query('SELECT vehicle_id, license_plate, vehicle_type, brand, color FROM vehicles ORDER BY vehicle_id DESC');
echo json_encode($stmt->fetchAll());
