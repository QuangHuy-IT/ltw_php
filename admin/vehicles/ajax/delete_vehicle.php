<?php
require_once __DIR__.'/../../inc/auth.php'; requireLogin();
$id=intval($_POST['id'] ?? 0);
$pdo->prepare('DELETE FROM vehicles WHERE vehicle_id=?')->execute([$id]);
echo json_encode(['success'=>true]);
