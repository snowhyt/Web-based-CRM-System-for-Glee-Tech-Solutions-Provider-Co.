<?php
	/**MySQL query to save the customer registration */

	//includes
	include 'session.php';	
	include 'functions.php';

	//get the current date
	$date_now = date('Y-m-d');
   
	//check if the post caller is from save
    if(isset($_POST['save'])){
		//get the fields values to be save on the database
         $username = $_POST['username'];
         $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
         $email_add = $_POST['email_add'];
         $firstname= $_POST['firstname'];
         $lastname = $_POST['lastname'];
         $contact = $_POST['contact'];
		 $token = bin2hex(openssl_random_pseudo_bytes(16));
		 $expiration = date('Y-m-d H:i:s A', strtotime('+48 hours'));


		 //check if the username or email address already exists
		 $sql = "SELECT username, email_add FROM admin WHERE  username='$username' OR email_add='$email_add'";
		 $query = $conn->query($sql);
		 
		 if (userExists($username, $email_add)) {
			//--> user already exists

			//check if username is bot (meaning this customer has been registered by the admin or staff)
		    if($_SESSION['bot']){
				//update customer details
			    $sql = "UPDATE admin SET username='$username', password='$password', firstname='$firstname', lastname='$lastname', token='$token', valid_until='$expiration', contact='$contact' WHERE email_add='$email_add'";
				if($conn->query($sql)){
				   sendActivationLink($username, $token, $email_add);	
				}

				unset($_SESSION['bot']);
			}
			else{
				//save values to session variables
				$_SESSION['username']= $username;
				$_SESSION['email_add']=$email_add;
				$_SESSION['firstname'] = $firstname;  
				$_SESSION['lastname'] = $lastname;
				$_SESSION['contact'] = $contact;
			}
		}
		else{
			//insert the user details
			$sql = "INSERT INTO admin (username,password,firstname,lastname,created_on,user_type,email_add,token,valid_until,contact) VALUES ('$username','$password','$firstname','$lastname','$date_now','Customer','$email_add','$token','$expiration','$contact')";

			if ($conn->query($sql)) {
				//create email for activation link
				sendActivationLink($username, $token, $email_add);
			}
   		}
	}

    header('location: index');
?>