<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		//sanitize  username and password to prevent from sql injection
		$sanitized_username = mysqli_escape_string($conn, $username);
		$sanitized_password= mysqli_escape_string($conn, $password);

		$sql = "SELECT * FROM admin WHERE username = '$sanitized_username'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the username';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($sanitized_password, $row['password'])){
				$_SESSION['admin'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
	}

	header('location: index');

?>