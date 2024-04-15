<?php
	/** This module will be use to update the account activation details*/
	include 'session.php';
	if (isset($_POST['save'])) {
			//get the token for identifier
			$token = $_POST['token_id'];
			//encrypt the password string
			$new_password =password_hash($_POST['password'], PASSWORD_DEFAULT);
	
			//update the table
		    $sql = "UPDATE admin SET password='$new_password', active=1, account_activated=1, token=null WHERE token='$token'";	   
		   if ($conn->query($sql)) {
		    	$_SESSION['success']='Your account has been activated. You may now login your acccount.';
				header('location: http://localhost/gleetech/crm');
		    }
		    else{
		    	$_SESSION['error']=$conn->error;
				header('location: http://localhost/gleetech/crm/activate');
		    }
	}

	
?>