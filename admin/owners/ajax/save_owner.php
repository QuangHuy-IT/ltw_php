<?php
require_once __DIR__.'/../../inc/auth.php'; requireLogin();
$data=$_POST;$id=intval($data['owner_id']??0);
try{
 if($id){
   $sql='UPDATE owners SET full_name=?, id_number=?, phone=?, address=? WHERE owner_id=?';
   $pdo->prepare($sql)->execute([$data['full_name'],$data['id_number'],$data['phone'],$data['address'],$id]);
 }else{
   $sql='INSERT INTO owners(full_name,id_number,phone,address) VALUES (?,?,?,?)';
   $pdo->prepare($sql)->execute([$data['full_name'],$data['id_number'],$data['phone'],$data['address']]);
 }
 echo json_encode(['success'=>true]);
}catch(PDOException $e){
 echo json_encode(['success'=>false,'message'=>'Trùng CMND hoặc tên']);
}
