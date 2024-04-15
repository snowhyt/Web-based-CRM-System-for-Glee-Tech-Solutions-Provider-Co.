<?php
	include 'includes/session.php';
	include '../timezone.php';
	$range_to = date('m/t/Y');
	$range_from = date('m/01/Y');

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM attendance WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Attendance deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: attendance?range='.$range_from."-".$range_to);
	
?>