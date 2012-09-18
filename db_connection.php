<?php

ini_set('display_errors', 1); 

function db_connection(){
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	try{  
	$dbh = new PDO("mysql:host=$hostname;dbname=customer_management", $username,$password);
	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo "Database Connected";
	return($dbh);
	}
	catch(PDOException $e){
		echo $e->getMessage();
		}
	
}
	


?>
