<?php 
	require 'dbconnect.php';

	$name=$_POST['name'];
	$cat_id=$_POST['cat_id'];


	

    $sql = "INSERT INTO subcategories (name,category_id) VALUES(:name,:cat)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':cat',$cat_id);
   	$stmt->execute();

   	header('location:subcategorylist.php');

 ?>