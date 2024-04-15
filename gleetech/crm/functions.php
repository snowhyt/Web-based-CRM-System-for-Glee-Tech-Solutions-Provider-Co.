<?php
    include 'timezone.php';
    require '../vendor/autoload.php';
	use PHPMailer\PHPMailer\PHPMailer;

    //check if the user is already existing
    function userExists($username, $email_add){
        include 'session.php';

        $sql = "SELECT username, email_add FROM admin WHERE username='$username' OR email_add='$email_add'";
        $query = $conn->query($sql);

        if ($query->num_rows>0) {
		    $row = $query->fetch_assoc();
		    if ($row['username']!=null && $row['username']==$username){
		   	    $_SESSION['error'] ='Username '.$username.' already taken.';
		    }
		    elseif($row['email_add']==$email_add){

                if($row['username']=='bot'){
                    $_SESSION['bot']=true;
                }else{
                    $_SESSION['error'] ='Email Address '. $email_add.' already exists.';
                }
	        }	
            return true;
        }
        return false;
    }

    //generate email for activation link
    function sendActivationLink($username, $token, $email_add){
        //email body
        $message = "<div>
        <p><b>Hi ".$username.",</b></p>
        <p>Your account is almost ready.</p>
        <p>To activate your account, please click the link below.</p>
        <br>
        <a href='http://localhost/gleetech/crm?id=".$token."'>
        http://localhost/gleetech/crm?id=".$token."
        </a>
        <br>
        <p>This link will be valid until ".date('Y-m-d H:i:s A', strtotime('+48 hours'))."</p>
        <br>
        <p>If you need further assistance, please contact us at admin@gleetechsolutionsproviderco.com</a></p>
        <br>
        <p><b>Thank You,</b></p>
        <p>GLEE Tech Admin</p>
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
        $mail->addReplyTo('contact-us@gleetechsolutionsproviderco.com', 'GLEE Tech Admin');
        $mail->addAddress($email_add, '');
        $mail->Subject = 'Account Activation';
        $mail->isHTML(true);
        $mail->Body = $message;
  
         //send the email
         if ($mail->send()) {
             $_SESSION['success'] =$username.' has been registered. Activation link has been sent to your email address '.$email_add.'.';
         }
         else{
             $_SESSION['error']=$mail->ErrorInfo;	
         }
    }

    //check if the user is pre-registered in the system
    function preRegistered($username, $email_add){
        include 'session.php';

        $sql = "SELECT username FROM admin WHERE username='$username'";
        $query = $conn->query($sql);
    }

    //check if the activation link is not yet expired
    function expiredToken($token, $date_today){
        include 'session.php';
        
        $sql = "SELECT token, valid_until FROM admin WHERE token='$token' AND account_activated=0";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        if ($query->num_rows>0) {    
            $expiration = $row['valid_until'];
      
            //check if token was already expired
            if ($date_today>$expiration) {
                $_SESSION['error'] = "This activation link is already expired. For further assistance contact us at admin@gleetechsolutionsproviderco.com.";
            }
            else{
                $sql = "UPDATE admin SET date_updated='$date_today', active=1, account_activated=1 WHERE token='$token'";
                $conn->query($sql);
                $_SESSION['success'] = "Your account has been activated. You may login your account now.";
            }
        }else{
            $_SESSION['error'] = "Your account is already activated.";
        }
    }

    //check if the reset password link is already expired
    function resetLinkExpired($token){
        include 'session.php';

        $sql = "SELECT token, valid_until FROM admin WHERE token='$token'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $date_today  =  date("Y-m-d H:i:s A");
    
        if ($query->num_rows>0) {
            $expiration = date("Y-m-d H:i:s A", strtotime($row['valid_until']));
      
            //check if the account is already activated
            if($row['token']==null) return true;

            //check if token was already expired
            return $date_today>$expiration;
        }
        
        return true;
    }
?>