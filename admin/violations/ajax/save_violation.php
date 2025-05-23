<?php
require_once __DIR__.'/../../inc/auth.php'; requireLogin();
$in=$_POST;
$id=intval($in['violation_id']??0);
if($id){
  $sql='UPDATE violations
        SET vehicle_id=?, violation_date=?, description=?, fine_amount=?
        WHERE violation_id=?';
  $pdo->prepare($sql)->execute([
    $in['vehicle_id'],$in['violation_date'],$in['description'],$in['fine_amount'],$id
  ]);
}else{
  $sql='INSERT INTO violations (vehicle_id, violation_date, description, fine_amount, payment_status)
        VALUES (?,?,?,?, "unpaid")';
  $pdo->prepare($sql)->execute([
    $in['vehicle_id'],$in['violation_date'],$in['description'],$in['fine_amount']
  ]);
}
echo json_encode(['success'=>true]);
