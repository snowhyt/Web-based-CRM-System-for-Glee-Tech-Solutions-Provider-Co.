<?php
	include 'session.php';
	include '../payroll/timezone.php';
	require '../vendor/autoload.php';
	use PHPMailer\PHPMailer\PHPMailer;

	if(isset($_POST['send'])){
		$email_add = $_POST['email_add'];
		//check if email address exist and if it's active
		$sql = "SELECT email_add, active, account_activated FROM admin WHERE email_add='$email_add'";
		$query = $conn->query($sql);
		if ($query->num_rows>0) {
			//check if user still active
			$row = $query->fetch_assoc();
			if ($row['active']==false || $row['account_activated']==false) {
			   $_SESSION['error']='No active user found with this email.';
			}
			else{
				$token = bin2hex(openssl_random_pseudo_bytes(16));

				//create message template and send email
				$message = '<div>
     							<p><b>Hello!</b></p>
     							<p>You are recieving this email because we received a password reset request for your account.</p>
     							<br>
     							<p>
     								<button class="btn btn-primary">
     									<a href="http://localhost/gleetech/crm/reset_password?id='.$token.'">Reset Password
     									</a>
     								</button></p>
     							<br>
     							<p>If you did not request a password reset, no further action is required.
     							</p>
    						</div>';

				   
				   $mail = new PHPMailer;
				   $mail->isSMTP();
				   $mail->SMTPDebug = 0;
				   $mail->Host = 'smtp.hostinger.com';
				   $mail->Port = 587;
				   $mail->SMTPAuth = true;
				   $mail->Username = 'admin@gleetechsolutionsproviderco.com';
				   $mail->Password = 'Gleetechsolutionsproviderco.com1';
				   $mail->setFrom('admin@gleetechsolutionsproviderco.com', 'GLEE Tech Admin');
				   $mail->addReplyTo('contact-us@gleetechsolutionsproviderco.com', 'GLEE Tech Admin');
				   $mail->addAddress($email_add, '');
				   $mail->Subject = 'Reset Password';
				   $mail->isHTML(true);
				   $mail->Body = $message;
			 
					//send the email
					if ($mail->send()) {
						$_SESSION['success']='Password reset link has been sent to '.$email_add;
					}
					else{
						$_SESSION['error']=$mail->ErrorInfo;	
					}

				//update database for the token and expiration
			    $expiration = date("Y-m-d H:i:s", strtotime('+24 hours'));

			    $sql=$conn->prepare("UPDATE admin SET token=?, valid_until=? WHERE email_add=?");
			    $sql->bind_param("sss",$token,$expiration,$email_add);
			    $sql->execute();
			    $sql->close();
			}
		}
		else{
			$_SESSION['error']='Email address not found.';
		}

		 header('location: index');
	}
?>