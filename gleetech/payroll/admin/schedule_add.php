<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

	    //check if schedule already exist
	    $sql = "SELECT id FROM schedules WHERE time_in='$time_in' AND time_out='$time_out'";
	    $query =$conn->query($sql);
	    if ($query->num_rows>0) {
	    	$_SESSION['error']='Schedule '.$time_in.'-'.$time_out.' already exists.';
	    }
	    else{
	    	$sql = "INSERT INTO schedules (time_in, time_out) VALUES ('$time_in', '$time_out')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Schedule added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
	    }
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: schedule');

?>