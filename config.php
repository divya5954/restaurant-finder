<?php
	//include 'userclass.php';
	ob_start();
	session_start();

	$dbhost='localhost';
	$dbuser='root';
	$dbpass='';
	$dbname='restro';

	try {
		$db=new PDO("mysql:host=".$dbhost.";dbname=".$dbname,$dbuser,$dbpass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		echo 'connection failed: '.$e->getMessage();
	}

?>