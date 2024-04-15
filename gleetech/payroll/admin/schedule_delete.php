<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		//check if schedule was already used
		$sql = "SELECT schedule_id FROM employees WHERE schedule_id=$id";
		$query = $conn->query($sql);
		 if ($query->num_rows>0) {
		 	$_SESSION['error']='Schedule was already used. Please remove it first from the existing employee.';
		 }
		 else{
		 	$sql = "DELETE FROM schedules WHERE id = '$id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Schedule deleted successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		 }
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: schedule');
	
?>