<?php
	if(session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	include 'conn.php';	

	if (isset($_SESSION['admin'])) {
		$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
		$query = $conn->query($sql);
		$user = $query->fetch_assoc();	
	}
	elseif (isset($_SESSION['staff'])) {
		$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['staff']."'";
		$query = $conn->query($sql);
		$user = $query->fetch_assoc();		
	}
	elseif (isset($_SESSION['customer'])) {
		$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['customer']."'";
		$query = $conn->query($sql);
		$user = $query->fetch_assoc();				
	}
?>