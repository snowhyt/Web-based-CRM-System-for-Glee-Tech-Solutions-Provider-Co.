<?php
	include 'session.php';
	
	if (isset($_POST['delete'])) {
		 $service_id = $_POST['del_service_id'];

		 $sql = $conn->prepare("DELETE FROM services WHERE service_id=?");
		 $sql->bind_param("i",$service_id);
		 if ($sql->execute()) {
		  	$_SESSION['success']='Service has been deleted successfully.';
		 }
		 else{
		  	$_SESSION['error'] = $conn->error;
		 }

		$sql->close();
	}

	header('location: services.php');
?>