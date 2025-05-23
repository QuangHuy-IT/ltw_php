<?php
require_once __DIR__ . '/../../inc/auth.php';
requireLogin();
$stmt = $pdo->query('SELECT v.vehicle_id, v.license_plate, v.vehicle_type, v.brand, v.color,
                    o.full_name AS owner_name
             FROM vehicles v
             LEFT JOIN owners o ON o.owner_id = v.owner_id
             ORDER BY v.vehicle_id DESC');

echo json_encode($stmt->fetchAll());
