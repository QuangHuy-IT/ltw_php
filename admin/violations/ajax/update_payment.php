<?php
require_once __DIR__.'/../../inc/auth.php'; requireLogin();
$id=intval($_POST['id']??0);
$status=$_POST['status']=='đã nộp'?'đã nộp':'chưa nộp';
$pdo->prepare('UPDATE violations SET payment_status=? WHERE violation_id=?')
    ->execute([$status,$id]);
echo json_encode(['success'=>true]);
