<?php
	include 'session.php';
	include 'timezone.php';
	require '../vendor/autoload.php';
	use PHPMailer\PHPMailer\PHPMailer;

	if (isset($_POST['generate'])) {
		$email_add = $_POST['email_add_generate'];	
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		
		//create message template and send email
		$message = "<div>
     	<p><b>Hi ".$username.",</b></p>
     	<p>Your account is almost ready.</p>
     	<p>To activate and set your account password, please click the link below.</p>
     	<br>
     	<a href='http://localhost/gleetech/crm/activate?id=".$token."'>
     	http://localhost/gleetech/crm/activate?id=".$token."
     	</a>
     	<br>
     	<p>This link will be valid until ".date('Y-m-d H:i:s A', strtotime('+48 hours'))
		."</p>
     	<br>
     	<p>If you need further assistance, please contact us at admin@gleetechsolutionsproviderco.com</a></p>
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
			$_SESSION['success'] ='New activation link has been sent to '. $email_add;
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

	header('location: pending');
?>