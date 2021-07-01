<?php 
	require 'dbconnect.php';

	$name=$_POST['name'];
	$phone=$_POST['phone'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $address=$_POST['address'];
  $role=2;

	

    $sql = "INSERT INTO users  (name,phone,email,password,address,role_id) VALUES(:name,:phone,:email,:password,:address,:role_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':phone',$phone);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':address',$address);
    $stmt->bindParam(':role_id',$role);
   	$stmt->execute();

    session_start();
    $_SESSION['reg_success']='Thanks! Your account has been succcessfully created and now Signed In.';
   	header('location:login.php');
    
 ?>