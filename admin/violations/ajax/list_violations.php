<?php
require_once __DIR__.'/../../inc/auth.php'; requireLogin();
$sql='SELECT v.*, ve.license_plate
      FROM violations v
      JOIN vehicles ve ON ve.vehicle_id=v.vehicle_id
      ORDER BY v.violation_id DESC';
echo json_encode($pdo->query($sql)->fetchAll());
