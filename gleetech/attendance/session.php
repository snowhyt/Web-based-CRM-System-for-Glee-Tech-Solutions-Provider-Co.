<?php
	//check session is already started
	if(session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}

	//connection details
	include 'conn.php';	

	//check if user is admin
	if (isset($_SESSION['admin'])) {
		$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
		$query = $conn->query($sql);
		$user = $query->fetch_assoc();	
	}
	//check if user is staff
	elseif (isset($_SESSION['staff'])) {
		$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['staff']."'";
		$query = $conn->query($sql);
		$user = $query->fetch_assoc();		
	}
	//check if user is customer
	elseif (isset($_SESSION['customer'])) {
		$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['customer']."'";
		$query = $conn->query($sql);
		$user = $query->fetch_assoc();				
	}
?>