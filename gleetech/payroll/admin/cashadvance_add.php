<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$amount = $_POST['amount'];
		
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee' AND active=1";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Employee is already termed.';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO cashadvance (employee_id, date_advance, amount) VALUES ('$employee_id', NOW(), '$amount')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Cash Advance added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: cashadvance');

?>