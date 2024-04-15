<?php
	include 'session.php';
	include 'timezone.php';
	$date_today = date('Y-m-d');

	if (isset($_POST['edit'])) {
		$id = $_POST['edit_service_id'];
		$service_name = $_POST['edit_service_name'];
		$description = $_POST['edit_service_description'];
		$responsible =$user['id'];
		$status = true;

		if ($_POST['edit_status']=="Inactive") {
			$status=false;
		}	

		$sql=$conn->prepare("UPDATE services SET service_name=?, description=?, added_by=?, active=?, date_added=? WHERE service_id=?");

		$sql->bind_param("sssssi",$service_name, $description, $responsible, $status, $date_today, $id);
		if($sql->execute()){
			$_SESSION['success']='Service has been updated successfully.';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

		
		$sql->close();
	}
	else{
		$_SESSION['error']='Please fill out the required information.';
	}

	header('location: services.php');
?>