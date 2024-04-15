<?php
	if(session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	include 'conn.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: index');
	}

	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	
?>