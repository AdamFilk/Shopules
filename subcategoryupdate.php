<?php 
	require 'dbconnect.php';
	$id=$_POST['id'];
	$name= $_POST['name'];
	$cat_id=$_POST['cat_id'];
	

	$sql="UPDATE subcategories SET name=:name, category_id=:cat_id WHERE id=:id";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':cat_id',$cat_id);
	$stmt->execute();
	header('location:subcategorylist.php');
 ?>