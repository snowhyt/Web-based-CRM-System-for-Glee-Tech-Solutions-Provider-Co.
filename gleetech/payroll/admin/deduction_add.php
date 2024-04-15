<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
		$amount = $_POST['amount'];

		//check if deduction already exist
		$sql = "SELECT id FROM deductions WHERE description='$description'";
		$query = $conn->query($sql);
		if ($query->num_rows>0) {
			$_SESSION['error']=$description.' already exists.';
		}
		else{
			$sql = "INSERT INTO deductions (description, amount) VALUES ('$description', '$amount')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Deduction added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: deduction');

?>