<?php 
	require 'dbconnect.php';

	$name=$_POST['name'];
	$image=$_FILES['photo'];
	$image_name= $image['name'];

	$source_dir="image/";
	$file_name = mt_rand(1000000, 9999999);//random file name between 1000000 and 9999999
	//array pyaung
    $file_exe_array = explode('.',$image_name);
    $file_exe = $file_exe_array[1];

    $file_path=$source_dir.$file_name.'.'.$file_exe;

    move_uploaded_file($image['tmp_name'], $file_path);

    $sql = "INSERT INTO categories (name,photo) VALUES(:name,:photo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':photo',$file_path);
   	$stmt->execute();

   	header('location:categorylist.php');

 ?>