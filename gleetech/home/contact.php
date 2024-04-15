<?php
  include 'session.php';
  require '../vendor/autoload.php';
  use PHPMailer\PHPMailer\PHPMailer;
   
  if(!isset($_POST['send']))
  {
  //This page should not be accessed directly. Need to submit the form.
  echo "error; you need to submit the form!";
  }

  //get the form field values
  $name = $_POST['name'];
  $visitor_email = $_POST['email_add'];
  $phone = $_POST['phone'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  if(IsInjected($visitor_email))
  {
    echo "Invalid Email Value!";
    exit;
  }
      $message = "<div>
      <p>Hello there,</p>
      <p>I'm ".$name.". I have an inquiry for you.</p>
      <br>
      <p>Inquiry: ".$message."</p>
      <br>
      <p>Please contact me at</p>
      <p>Phone No: ".$phone."</p>
      <p>Email: ".$visitor_email."</p>  
      <br>
      <p><b>Thank You,</b></p>
      </div>";

      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->SMTPDebug = 0;
      $mail->Host = 'smtp.hostinger.com';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->Username = 'contact-us@gleetechsolutionsproviderco.com';
      $mail->Password = 'Gleetechsolutionsproviderco.com1';
      $mail->setFrom('contact-us@gleetechsolutionsproviderco.com', 'Contact-Us Mailer');
      $mail->addReplyTo($visitor_email, '');
      $mail->addAddress('contact-us@gleetechsolutionsproviderco.com', '');
      $mail->Subject = $subject;
      $mail->isHTML(true);
      $mail->Body = $message;
    
    //send the email
    if ($mail->send()) {
      $_SESSION['success'] ='Message has been sent.'; 
    }
    else{
      $_SESSION['error']=$mail->ErrorInfo;       
    }

    header("location:http://localhost/gleetech/home");


  // Function to validate against any email injection attempts
  function IsInjected($str)
  {
    $injections = array('(\n+)',
                '(\r+)',
                '(\t+)',
                '(%0A+)',
                '(%0D+)',
                '(%08+)',
                '(%09+)'
                );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str))
      {
      return true;
    }
    else
      {
      return false;
    }
  }
?>
