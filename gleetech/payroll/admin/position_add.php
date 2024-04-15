<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		$rate = $_POST['rate'];

		//check if position already exist
		$sql = "SELECT id FROM position WHERE description='$title'";
		$query=$conn->query($sql);
		if ($query->num_rows>0) {
			$_SESSION['error']=$title.' already exist';
		}
		else{
			$sql = "INSERT INTO position (description, rate) VALUES ('$title', '$rate')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Position added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}	
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: position');

?>