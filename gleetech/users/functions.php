<?php
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;   

    //set year filters
    function setYearFilter(){       
        for($i=2023; $i<=2065; $i++){
          //$selected = ($i==2023)?'selected':'';
          echo "
            <option value='".$i."'>".$i."</option>
          ";
        }
    }

    //get all users
    function getRegisteredUsers($year){
        include 'session.php';

        $sql = "SELECT id, created_on, user_type, active, account_activated, banned  from admin WHERE YEAR(created_on)='$year'";
        $query = $conn->query($sql);

        return $query;
    }

    //send an email for banning customer account
    function sendBannedAccountNotification($customer_name, $reason, $customer_email){
        //email body
        $message = "<div>
        <p><b>Hi, $customer_name</b></p>
        <p>Your account has been banned for below reason.</p>
        <h4>Reason For Banning</h4> 
        <p>$reason</p>
        <p>For any questions or clarifications, please contact us at admin@gleetechsolutionsproviderco.com.</p>
        <br>
        <p><b>Thank You,</b></p>
        <p>GLEE Tech Solutions Provider Co.</p>
       </div>";

        //php mailer
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
        $mail->addAddress($customer_email, '');
        $mail->Subject = 'Account Banned';
        $mail->isHTML(true);
        $mail->Body = $message;	 
        $mail->send();
    }

    function sendUnbannedAccountNotification($customer_name, $customer_email){
      //email body
      $message = "<div>
      <p><b>Hi, $customer_name</b></p>
      <p>We are happy to say that your account has been reinstated. You may now login and use your account again.</p>
      <p>For any questions or clarifications, please contact us at admin@gleetechsolutionsproviderco.com.</p>
      <br>
      <p><b>Thank You,</b></p>
      <p>GLEE Tech Solutions Provider Co.</p>
     </div>";

      //php mailer
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
      $mail->addAddress($customer_email, '');
      $mail->Subject = 'Account Reinstated';
      $mail->isHTML(true);
      $mail->Body = $message;	 
      $mail->send();
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