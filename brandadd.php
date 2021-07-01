<?php 
	require 'dbconnect.php';

	$name=$_POST['name'];
	$image=$_FILES['logo'];
	$image_name= $image['name'];

	$source_dir="image/logo/";
	$file_name = mt_rand(1000000, 9999999);//random file name between 1000000 and 9999999
	//array pyaung
    $file_exe_array = explode('.',$image_name);
    $file_exe = $file_exe_array[1];

    $file_path=$source_dir.$file_name.'.'.$file_exe;

    move_uploaded_file($image['tmp_name'], $file_path);

    $sql = "INSERT INTO brands (name,logo) VALUES(:name,:logo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':logo',$file_path);
   	$stmt->execute();

   	header('location:brandlist.php');

 ?>