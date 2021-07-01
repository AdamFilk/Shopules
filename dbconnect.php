<?php 
	// host, db_name, user, password required, sometimes may need port number bar nyar
 $_HOST="localhost";
 $_DbName="shopulesPHP";
 $_User= "root";
 $_Password='';

// connection
 try{
 	$conn=new PDO("mysql:host=$_HOST;dbname=$_DbName",$_User,$_Password);
 	$conn->setAttribute(PDO::ATTR_ERRMODE,
 		PDO::ERRMODE_EXCEPTION);
 	
 }catch(PDOException $e){
 	echo $e->getMessage();
 }
 
 
 ?>