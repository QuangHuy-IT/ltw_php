<?php
require_once __DIR__.'/../../inc/auth.php'; requireLogin();
$id=intval($_POST['id']??0);
$desc=$_POST['description']??'';
$fine=floatval($_POST['fine']??0);
$pdo->prepare('UPDATE violations SET description=?, fine_amount=? WHERE violation_id=?')
    ->execute([$desc,$fine,$id]);
echo json_encode(['success'=>true]);
