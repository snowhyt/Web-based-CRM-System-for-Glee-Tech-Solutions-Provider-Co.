<?php
	if(session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	include 'conn.php';	
	
	if (isset($_SESSION['customer'])) {
		$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['customer']."'";
		$query = $conn->query($sql);
		$user = $query->fetch_assoc();				
	}
?>