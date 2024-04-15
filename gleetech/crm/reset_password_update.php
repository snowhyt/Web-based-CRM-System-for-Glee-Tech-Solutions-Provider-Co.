<?php
	include 'session.php';
	if (isset($_POST['save'])) {
			$token = $_POST['token_id'];
			$new_password =password_hash($_POST['password'], PASSWORD_DEFAULT);
		   
		    $sql = "UPDATE admin SET password='$new_password', token=null WHERE token='$token'";	   

		   if ($conn->query($sql)) {
		    	$_SESSION['success']='Password has been reset. You may now login to your account.';
		    }
		    else{
		    	$_SESSION['error']='Failed to reset your password. Please contact system administrator at admin@gleetechsolutionsproviderco.com.';
		    }
	}

	header('location: index');


?>