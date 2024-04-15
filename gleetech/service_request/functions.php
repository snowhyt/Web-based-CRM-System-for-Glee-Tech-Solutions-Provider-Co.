<?php
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;       

    //send email for creating request
    function sendEmailForRequest($customer_name, 
                                 $customer_address, 
                                 $customer_contact, 
                                 $service_type, 
                                 $service_description, 
                                 $customer_notes,
                                 $customer_email){
         //email body
         $message = "<div>
         <p><b>Good Day,</b></p>
         <p>Service request has been received.</p>
         <p>Please review the details below.</p> 
         <p><b>Customer Name:</b> $customer_name</p>
         <p><b>Customer Address:</b> $customer_address</p>
         <p><b>Customer Contact:</b> $customer_contact</p>
         <p><b>Requested Service Type:</b> $service_type</p>
         <p><b>Service Description:</b> $service_description</p>
         <p><b>Customer Notes:</b> $customer_notes</p>
         <br>
         <p>To see more details, please check it on your service management page.</p>
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
         $mail->Username = 'customer-request@gleetechsolutionsproviderco.com';
         $mail->Password = 'Gleetechsolutionsproviderco.com1';
         $mail->setFrom('customer-request@gleetechsolutionsproviderco.com', 'Customer Generated Request');
         $mail->addReplyTo($customer_email, $customer_name);
         $mail->addAddress('contact-us@gleetechsolutionsproviderco.com', '');
         $mail->Subject = '[Action Required] GLEE Tech Service Request';
         $mail->isHTML(true);
         $mail->Body = $message;	 
         $mail->send();

    }

    //send email for creating request
    function sendEmailForCancellation($request_id,
                                      $customer_name,
                                      $customer_contact, 
                                      $service_type, 
                                      $customer_notes,
                                      $customer_email){
         //email body
         $message = "<div>
         <p><b>Good Day,</b></p>
         <p>Service request has been cancelled.</p>
         <p>Please review the details below.</p> 
         <p><b>Request ID:</b> $request_id</p>
         <p><b>Customer Name:</b> $customer_name</p>
         <p><b>Contact No:</b> $customer_contact</p>
         <p><b>Requested Service Type:</b> $service_type</p>
         <p><b>Reason for cancellation:</b> $customer_notes</p>
         <br>
         <p>To see more details, please check it on your service management page.</p>
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
         $mail->Username = 'customer-request@gleetechsolutionsproviderco.com';
         $mail->Password = 'Gleetechsolutionsproviderco.com1';
         $mail->setFrom('customer-request@gleetechsolutionsproviderco.com', 'System Generated Request');
         $mail->addReplyTo($customer_email, $customer_name);
         $mail->addAddress('contact-us@gleetechsolutionsproviderco.com', '');
         $mail->Subject = '[Cancelled Request] GLEE Tech Service Request';
         $mail->isHTML(true);
         $mail->Body = $message;	 
         $mail->send();

    }

?>