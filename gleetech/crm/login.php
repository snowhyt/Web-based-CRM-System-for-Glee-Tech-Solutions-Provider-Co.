<?php
	include 'session.php';
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//sanitize  username and password to prevent from sql injection
		$sanitized_username = mysqli_escape_string($conn, $username);
		$sanitized_password= mysqli_escape_string($conn, $password);

		$sql = "SELECT * FROM admin WHERE (username = '$sanitized_username' OR email_add='$sanitized_username') AND active=1 AND account_activated=1";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the username/email address '. $sanitized_username;
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($sanitized_password, $row['password'])){
				switch ($row['user_type']) {
					case 'Admin':
						$_SESSION['admin']=$row['id'];		
						//header('location: http://localhost/gleetech/home/admin');			
						break;
					case 'Staff':
						$_SESSION['staff']=$row['id'];		
						//header('location: http://localhost/gleetech/home/staff');							
						break;
					case 'Customer':
						$_SESSION['customer']=$row['id'];	
						//header('location: http://localhost/gleetech/home/customer');						
						break;
				}
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
				//header('location: http://localhost/gleetech/crm');
			}
		}	
	}
	
	header('location: http://localhost/gleetech/crm');
?>