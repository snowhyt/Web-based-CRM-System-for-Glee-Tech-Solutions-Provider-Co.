<?php
	include 'includes/session.php';
	include '../../timezone.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
	    $email_add = $_POST['email_add'];
		$gender = $_POST['gender'];
		$position = $_POST['position'];
		$schedule = $_POST['schedule'];
		$philhealth = $_POST['philhealth'];
		$sss = $_POST['sss'];
		$pagibig = $_POST['pagibig'];
		
		if ($_POST['activestate'] =='Termed') {
			$status=false;
			$termdate=date('Y-m-d');
			$newhiredate=$_POST['original_hiredate'];
		}
		else{
			$status =true;
			$termdate=null;
			$newhiredate=date('Y-m-d');
		}

	$sql = "UPDATE employees SET firstname = '$firstname', lastname = '$lastname', address = '$address', birthdate = '$birthdate', contact_info = '$contact', gender = '$gender', position_id = '$position', schedule_id = '$schedule', created_on='$newhiredate', philhealth = '$philhealth', sss = '$sss', pagibig = '$pagibig', active=b'$status', term_date='$termdate', email_add='$email_add' WHERE id = '$empid'";
		
	if($conn->query($sql)){
		$_SESSION['success'] = 'Employee updated successfully';
	 	}
	 	else{
	 		$_SESSION['error'] = $conn->error;
	 	}

	 }
	 else{
	 	$_SESSION['error'] = 'Select employee to edit first';
	 }

	header('location: employee');
?>