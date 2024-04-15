<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$email_add = $_POST['email_add'];
		$gender = $_POST['gender'];
		$position = $_POST['position'];
		$schedule = $_POST['schedule'];
		$filename = $_FILES['photo']['name'];
		$philhealth = $_POST['philhealth'];
		$sss = $_POST['sss'];
		$pagibig = $_POST['pagibig'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//creating employee id
		$prefix = date('Y');
		$numbers = '';
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$employee_id = $prefix."-".substr(str_shuffle($numbers), 0, 5);
		
		//insert query
		$sql = "INSERT INTO employees (employee_id, firstname, lastname, address, birthdate, contact_info, gender, position_id, schedule_id, photo, created_on, philhealth, sss, pagibig, email_add) VALUES ('$employee_id', '$firstname', '$lastname', '$address', '$birthdate', '$contact', '$gender', '$position', '$schedule', '$filename', NOW(), '$philhealth','$sss','$pagibig', '$email_add')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee');
?>