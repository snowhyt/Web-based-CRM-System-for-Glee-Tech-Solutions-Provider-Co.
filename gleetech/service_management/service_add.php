<?php
	include 'session.php';
	if (isset($_POST['add'])) {
		$service_name = $_POST['service_name'];
		$description = $_POST['service_description'];
		$responsible = $user['id'];

		//check if service is already existing
		$sql = "SELECT service_id FROM services WHERE service_name='$service_name'";
		$row = $conn->query($sql);
		
		if ($row->num_rows>0) {
			$_SESSION['error'] = 'Service '.$service_name.' already exists.';
		}
		else{
			$sql = $conn->prepare("INSERT INTO services (service_name, description, added_by) VALUES (?,?,?)");

			$sql->bind_param("ssi",$service_name,$description,$responsible);

			if ($sql->execute()) {
				$_SESSION['success']='Service has been added successfully.';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
			
			$sql->close();
		}
	}

	header('location: services.php');
?>