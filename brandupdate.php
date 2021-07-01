<?php 
	require 'dbconnect.php';
	$id=$_POST['id'];
	$oldPhoto=$_POST['oldLogo'];
	$name= $_POST['name'];
	$newLogo=$_FILES['logo'];
	$image_name=$newLogo['name'];
	

	if($newLogo['size']>0){
		$source_dir="image/logo/";
		$file_name = mt_rand(1000000, 9999999);//random file name between 1000000 and 9999999
		//array pyaung
	    $file_exe_array = explode('.',$image_name);
	    $file_exe = $file_exe_array[1];

	    $file_path=$source_dir.$file_name.'.'.$file_exe;

	    move_uploaded_file($newLogo['tmp_name'], $file_path);
	}
	else{
		$file_path=$oldPhoto;
	}

	$sql="UPDATE brands SET logo=:logo, name=:name WHERE id=:id";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':logo',$file_path);
	$stmt->execute();
	header('location:brandlist.php');
 ?>