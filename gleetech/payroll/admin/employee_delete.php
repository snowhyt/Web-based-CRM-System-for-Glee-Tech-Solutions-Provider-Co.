<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		//check if employee has records to different tables
		$sql="SELECT employee_id FROM attendance WHERE employee_id=$id";
		$row=$conn->query($sql);

		if ($row->num_rows>0) {
			$_SESSION['error']='Unable to delete. Employee has an existing records in attendance. Please remove it first.';	
		}
		else{
			$sql = "DELETE FROM employees WHERE id = '$id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Employee deleted successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: employee');
	
?>