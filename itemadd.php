<?php 
	require 'dbconnect.php';

    $name= $_POST['name'];
   
    $price=$_POST['price'];
    $discount=$_POST['discount'];
    $description=$_POST['desc'];
    $brand_id=$_POST['brand_id'];
    $subcategory_id=$_POST['subcategory_id'];
     $photo= $_FILES['photo'];
     $codeno=$_POST['codeno'];
     $desc=$_POST['desc'];
     $image_name=$photo['name'];

	$source_dir="image/";
	$file_name = mt_rand(1000000, 9999999);//random file name between 1000000 and 9999999
	//array pyaung
    $file_exe_array = explode('.',$image_name);
    $file_exe = $file_exe_array[1];

    $file_path=$source_dir.$file_name.'.'.$file_exe;

    move_uploaded_file($photo['tmp_name'], $file_path);

    $sql = "INSERT INTO items (codeno,name,photo,price,discount,description,brand_id,subcategory_id) VALUES(:codeno,:name,:photo,:price,:discount,:description,:brand_id,:subcategory_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':codeno',$codeno);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':photo',$file_path);
    $stmt->bindParam(':price',$price);
    $stmt->bindParam(':discount',$discount);
    $stmt->bindParam(':description',$description);
    $stmt->bindParam(':brand_id',$brand_id);
    $stmt->bindParam(':subcategory_id',$subcategory_id);
   	$stmt->execute();

   	header('location:itemlist.php');

 ?>