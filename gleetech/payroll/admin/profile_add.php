<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
		
	}
	else{
		$return = 'home';
	}

	if(isset($_POST['save'])){
		$username = $_POST['newUsername'];
		$password = $_POST['newPassword'];
		$firstname = $_POST['newFirstname'];
		$lastname = $_POST['newLastname'];
		$email_add=$_POST['email_add'];
		$photo = $_FILES['newPhoto']['name'];

        //check if username already exists
        $sql="SELECT username FROM admin WHERE username='$username'";
        $query = $conn->query($sql);
       
        if ($query -> num_rows > 0) {
        	$_SESSION['error'] = 'Username already exists!';
        }
        else{

        	//check if email address already exists
        	$sql = "SELECT email_add FROM admin WHERE email_add='$email_add'";
        	$query =$conn->query($sql);
        	if($query->num_rows>0) {
        		$_SESSION['error'] = $email_add.' already exists.';
        	}
        	else{
        		if(!empty($filename)){
				move_uploaded_file($_FILES['newPhoto']['tmp_name'], '../images/'.$filename);	
				}

				$password = password_hash($password, PASSWORD_DEFAULT);

		        $sql = "INSERT INTO admin (username, password, email_add, firstname, lastname, photo) VALUES ('$username', '$password', '$email_add', '$firstname', '$lastname', '$photo')";
				
				if($conn->query($sql)){
					$_SESSION['success'] = 'New admin profile added successfully';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
        	}
		}	
	}else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location:'.$return);

?>