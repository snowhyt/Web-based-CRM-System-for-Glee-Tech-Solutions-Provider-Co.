<?php
	include 'session.php';
	include 'timezone.php';
	require '../vendor/autoload.php';
	use PHPMailer\PHPMailer\PHPMailer;

    $date_now = date('Y-m-d');
    $admin = $user['id'];

	if(isset($_POST['save'])){
		$employee_id = $_POST['employee_id'];
		$username = $_POST['username'];
		$photo = $_FILES['photo']['name'];
		$email_add = $_POST['add_email'];
		$user_type = $_POST['user_type'];

		if(!empty($photo)){
		move_uploaded_file($_FILES['photo']['tmp_name'], '../payroll/images/'.$photo);
		$filename = $photo;	
		}
		else{
			$filename = 'admin.png';
		}

		//check if the admin/staff is already existing
		$sql = "SELECT username, email_add FROM admin WHERE  username='$username' OR email_add='$email_add'";
		$query = $conn->query($sql);
		if ($query->num_rows>0) {
			$row = $query->fetch_assoc();
		   if ($row['username']!=null && $row['username']==$username){
		   	 $_SESSION['error'] ='Username '.$username.' already taken.';
		   }
		   elseif($row['email_add']==$email_add){
		   	$_SESSION['error'] ='Email Address '. $email_add.' already exists.';	
		   }	
		}
		else{
			//get other details from employees table
			$sql = "SELECT firstname, lastname FROM employees WHERE employee_id='$employee_id'";
			$query = $conn->query($sql);
			if ($query->num_rows>0) {
				$row = $query->fetch_assoc();
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];

				$sql = $conn->prepare("INSERT INTO admin (username, firstname, lastname, photo, user_type, updated_by, email_add, employee_id) VALUES (?,?,?,?,?,?,?,?)");
				$sql->bind_param("sssssiss",$username, $firstname, $lastname, $filename, $user_type, $_SESSION['admin'], $email_add, $employee_id);

				if($sql->execute()) {
					$token = bin2hex(openssl_random_pseudo_bytes(16));

				    //create message template and send email
				   	$message = "<div>
                             	<p><b>Hi ".$username.",</b></p>
                             	<p>Your account is almost ready.</p>
                             	<p>To activate and set your account's password, please click the link below.</p>
                             	<br>
                             	<a href='http://localhost/gleetech/crm/activate?id=".$token."'>
                             	http://localhost/gleetech/crm/activate?id=".$token."
                             	</a>
                             	<br>
                             	<p>This link will be valid until ".date('Y-m-d H:i:s A', strtotime('+48 hours'))
                        		."</p>
                             	<br>
                             	<p>If you need further assistance, please contact us at admin@gleetechsolutionsproviderco.com</p>
                             	<br>
                             	<p><b>Thank You,</b></p>
                             	<p>Administrator</p>
                             	<p>".$user['firstname']." ".$user['lastname']."</p>
                            	</div>";

				   $mail = new PHPMailer;
				   $mail->isSMTP();
				   $mail->SMTPDebug = 0;
				   $mail->Host = 'smtp.hostinger.com';
				   $mail->Port = 587;
				   $mail->SMTPAuth = true;
				   $mail->Username = 'admin@gleetechsolutionsproviderco.com';
				   $mail->Password = 'Gleetechsolutionsproviderco.com1';
				   $mail->setFrom('admin@gleetechsolutionsproviderco.com', 'GLEE Tech Admin');
				   $mail->addReplyTo('admin@gleetechsolutionsproviderco.com', 'GLEE Tech Admin');
				   $mail->addAddress($email_add, '');
				   $mail->Subject = 'Account Activation';
				   $mail->isHTML(true);
				   $mail->Body = $message;
			 
					//send the email
					if ($mail->send()) {
						$_SESSION['success'] =$user_type.' '.$username.' has been added successfully. Activation link has been sent to your email address '.$email_add.'.';
					}
					else{
						$_SESSION['error']=$mail->ErrorInfo;	
					}

				//update database for the token and expiration
			    $expiration = date("Y-m-d H:i:s", strtotime('+48 hours'));

			    $sql=$conn->prepare("UPDATE admin SET token=?, valid_until=? WHERE email_add=?");
			    $sql->bind_param("sss",$token,$expiration,$email_add);
			    $sql->execute();
			    $sql->close();

				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}
			else{
				$_SESSION['error'] = 'Employee not found.';
			}
		}

		header('location: system_users');
		exit;
	}
	elseif (isset($_POST['edit'])) {
		$employee_id = $_POST['edit_employee_id'];
		$username= $_POST['edit_username'];
		 
		if($employee_id==0 && $username!=$user['username']){
		    $_SESSION['error'] ='This account is restricted for unauthorized update.';
			header('location: system_users');
		}
		else{
    		$email_add = $_POST['edit_email_add'];
    		$user_type = $_POST['edit_user_type'];
    		$access_status = $_POST['edit_status']=="Revoke" ? false : true;

		//check if email address already exist from other users
		$sql  = "SELECT email_add FROM admin WHERE email_add='$email_add' AND employee_id!='$employee_id'";
		$query = $conn->query($sql);
		if ($query->num_rows>0) {
		 	$_SESSION['error']='Email Address '.$email_add.' already taken.';
		}
		else{
			$sql = $conn->prepare("UPDATE admin SET email_add=?, user_type=?, active=?, updated_by=?, date_updated=? WHERE employee_id=?");
			$sql->bind_param("ssiiss",$email_add, $user_type, $access_status, $admin, $date_now, $employee_id);
			if ($sql->execute()) {
				if ($username==$user['username'] && ($access_status==false || $user_type=="Staff")) {
				  session_destroy();
				  header('location: ../crm');
				}
				else{
					$_SESSION['success'] = "Account has been updated.";
				}					
			}
			else{
			   $_SESSION['error'] = $conn->error;					
			}
			$sql->close();
		}
			header('location: system_users');
		}
	}
	elseif (isset($_POST['upload'])) {
		$employee_id = $_POST['employee_id_photo'];
		$photo = $_FILES['photo']['name'];
		if(!empty($photo)){
		move_uploaded_file($_FILES['photo']['tmp_name'], '../payroll/images/'.$photo);
		$filename = $photo;	
		}
		else{
			$filename = 'admin.png';
		}

		$sql = $conn->prepare("UPDATE admin SET photo=? WHERE employee_id=?");
		$sql->bind_param("ss",$filename, $employee_id);
		if ($sql->execute()) {
			$_SESSION['success']='Photo has been updated.';
		}
		else{
			$_SESSION['error']=$conn->error;
		}
		$sql->close();

  	   header('location: system_users');
	}
	elseif (isset($_POST['reinstate'])) {
		$employee_id=$_POST['employee_id_reinstate'];
		$sql = "UPDATE admin SET active=1, updated_by=$admin, date_updated='$date_now' WHERE employee_id='$employee_id'";
		if ($conn->query($sql)) {
			$_SESSION['success']='Account with Employee ID: '.$employee_id. ' has been reinstated.';
		}
		else{
			$_SESSION['error']=$conn->error;
		}

		header('location: system_users');
	}
?>