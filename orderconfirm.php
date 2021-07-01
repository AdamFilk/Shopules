<?php 
require 'dbconnect.php';
$id=$_GET['id'];
$status = 1;

$sql = "UPDATE orders SET status = :status WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':status',$status);
$stmt->bindParam(':id',$id);
$stmt->execute();

header('location:orderlist.php');
 ?>