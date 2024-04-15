<?php
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    
    //get customer list with request
    function getCustomerListWithRequest(){
        include 'session.php';
        $sql = "SELECT admin.id, admin.firstname, admin.lastname, requests.request_id FROM admin LEFT JOIN requests ON admin.id=requests.customer_id WHERE admin.user_type='Customer' AND admin.banned=0 AND (requests.request_status_id=1 OR requests.request_status_id=6) AND requests.paid=0";
        $query = $conn->query($sql);
        while($prow = $query->fetch_assoc()){
            echo "<option value='".$prow['request_id']."'>".$prow['firstname']." ".$prow['lastname']."</option>";
        }
    }

    //get customer list
    function getCustomerList(){
        include 'session.php';
        $sql ="SELECT admin.id, admin.firstname, admin.lastname, admin.email_add, admin.contact FROM admin WHERE admin.user_type='Customer' AND admin.banned=0";
        $query=$conn->query($sql);

        while($row=$query->fetch_assoc()){
            echo "<option id='".$row['id']."|".$row['email_add']."|".$row['contact']."' value='".$row['lastname'].",".$row['firstname']."'>".$row['lastname'].",".$row['firstname']."</option>";
        }
    }
    
    //update request status
    function updateRequestStatus($request_id){
       include 'session.php';
       
       $sql = "UPDATE requests SET  paid=1 WHERE request_id=$request_id";
       $conn->query($sql);
    }

    //get services
    function getServices(){
        include 'session.php';
        $sql = "SELECT * FROM services WHERE active=1";
        $query = $conn->query($sql);
        while($prow = $query->fetch_assoc()){
          echo "
            <option id='".$prow['service_id']."|".$prow['service_name']."' value='".$prow['description']."'>".$prow['service_name']."</option>
          ";
        }
    }

    //get service count
    function getServiceCount(){
        include 'session.php';
        $sql = "SELECT COUNT(*) 'service_count' FROM services WHERE active=1";
        $query = $conn->query($sql);
        $services = $query->fetch_assoc();
        return $services['service_count'];
    }

    //get request details
    function getRequestCount($month, $year){
        include 'session.php';
        $sql="SELECT request_status.request_status, COUNT(requests.request_status_id) as 'total' FROM requests LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE MONTH(requests.request_date)='$month' AND YEAR(requests.request_date)='$year' GROUP BY requests.request_status_id";
        $query=$conn->query($sql);

        return $query;
    }

    //set year filters
    function setYearFilter(){       
        for($i=2023; $i<=2065; $i++){
          $selected = ($i==2023)?'selected':'';
          echo "
            <option value='".$i."' ".$selected.">".$i."</option>
          ";
        }
    }

    //send email notification for creating request
    function sendEmailForCreatedRequest($customer,
                                        $email_add,
                                        $service_type,
                                        $service_description,
                                        $customer_notes,
                                        $staff_notes,
                                        $status){     
         //email body
         $message = "<div>
         <p><b>Hi ".$customer.",</b></p>
         <p>Thank you for reaching out.</p>
         <p>Below are the details of your request.</p> 
         <p><b>Request Status:</b> $status</p>
         <p><b>Service Type:</b> $service_type</p>
         <p><b>Service Description:</b> $service_description</p>
         <p><b>Customer Notes:</b>$customer_notes</p>
         <p><b>Staff Notes:</b>$staff_notes</p>
         <br>
         <p>For any questions or clarifications, you may contact us at <b>contact-us@gleetechsolutionsproviderco.com</b> or</p>
         <p>visit us at https://gleetechsolutionsproviderco.com</p>
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
         $mail->Username = 'contact-us@gleetechsolutionsproviderco.com';
         $mail->Password = 'Gleetechsolutionsproviderco.com1';
         $mail->setFrom('contact-us@gleetechsolutionsproviderco.com', 'GLEE Tech Customer Service');
         $mail->addReplyTo('contact-us@gleetechsolutionsproviderco.com', 'Contact-Us');
         $mail->addAddress($email_add, '');
         $mail->Subject = 'GLEE Tech Service Request | '.$status;
         $mail->isHTML(true);
         $mail->Body = $message;	 
         $mail->send();
    }

    
    //send email notification for updating request
    function sendEmailForUpdatedRequest($customer,
                                        $request_id,
                                        $email_add,
                                        $service_type,
                                        $service_description,
                                        $customer_notes,
                                        $staff_notes,
                                        $status){
      
	 
        //email body
        $message = "<div>
        <p><b>Hi ".$customer.",</b></p>
        <p>Your request has been updated.</p>
        <p>Below are the details of your request.</p>   
        <p><b>Request ID:</b> $request_id</p>
        <p><b>Request Status:</b> $status</p>   
        <p><b>Service Type:</b> $service_type</p>
        <p><b>Service Description:</b> $service_description</p>
        <p><b>Customer Notes:</b>$customer_notes</p>
        <p><b>Staff Notes:</b>$staff_notes</p>
        <br>
        <p>For any questions or clarifications, you may contact us at <b>contact-us@gleetechsolutionsproviderco.com</b> or</p>
        <p>visit us at https://gleetechsolutionsproviderco.com</p>
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
		$mail->Username = 'contact-us@gleetechsolutionsproviderco.com';
		$mail->Password = 'Gleetechsolutionsproviderco.com1';
		$mail->setFrom('contact-us@gleetechsolutionsproviderco.com', 'GLEE Tech Customer Service');
	    $mail->addReplyTo('contact-us@gleetechsolutionsproviderco.com', 'Contact-Us');
		$mail->addAddress($email_add, '');
		$mail->Subject = 'GLEE Tech Service Request | '.$status;
	    $mail->isHTML(true);
		$mail->Body = $message;	 
	    $mail->send();
    }

    //check if the invoice was already created
    function hasInvoice($request_id){
       include 'session.php';
       $sql = "SELECT * FROM invoice WHERE request_id=$request_id";
       $query=$conn->query($sql);
       while($query->fetch_assoc()){
         return true;
         exit;
       }
       
       return false;
    }

    //check if the user with the given email address already exists
    function emailAddressAlreadyExists($email_add){
        include 'session.php';
            $sql = "SELECT * FROM admin WHERE email_add='$email_add'";
            $query = $conn->query($sql);
            while($row=$query->fetch_assoc()){
                 if($row['email_add']==$email_add){
                  return true;
                  exit;
                 } 
            }
            return false;
    }

    //send an email notification after creating invoice
    function sendEmailForCreatedInvoice($request_id,
                                        $customer,
                                        $invoice_id,
                                        $issued_date,
                                        $service_type,
                                        $service_description,
                                        $service_amount,
                                        $discount,
                                        $tax_rate,
                                        $tax_amount,
                                        $total, 
                                        $email_add){
         
        //email body
         $message = "<div>
         <p><b>Hi ".$customer.",</b></p>
         <p>Invoice for the requested service is now available. You may also print or download a copy of your invoice from your service request page at https://gleetechsolutionsproviderco.com/home/customer.</p>
         <br>
         <p>-----------------------------------------------------------------------------</p>
         <p><b>Request ID:</b> $request_id</p>
         <p><b>Invoice Number:</b> $invoice_id</p>
         <p><b>Issued Date:</b> $issued_date</p>
         <h2><b>Service Details</b></h2>
         <p><b>Service Type:</b> $service_type</p>
         <p><b>Service Description:</b> $service_description</p>
         <p><b>Service Amount:</b> $service_amount</p>
         <p><b>Discount:</b> $discount</p>
         <p><b>Tax Rate:</b> $tax_rate</p>
         <p><b>Tax Amount:</b> $tax_amount</p>        
         <h2><b>Total:</b> $total</h2>
         <p>-----------------------------------------------------------------------------</p>
         <br>
         <p>For any questions or clarifications, you may contact us at <b>contact-us@gleetechsolutionsproviderco.com</b> or</p>
         <p>visit us at https://gleetechsolutionsproviderco.com</p>
         <br>
         <p><b>Thank You,</b></p>
         <p>GLEE Tech Solutions Provider Co.</p>
        </div>";
   

          //php mailer
          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->SMTPDebug = 0;
          $mail->Host = 'smtp.hostinger.com';
          $mail->Port = 587;
          $mail->SMTPAuth = true;
          $mail->Username = 'contact-us@gleetechsolutionsproviderco.com';
          $mail->Password = 'Gleetechsolutionsproviderco.com1';
          $mail->setFrom('contact-us@gleetechsolutionsproviderco.com', 'GLEE Tech Customer Service');
          $mail->addReplyTo('contact-us@gleetechsolutionsproviderco.com', 'Contact-Us');
          $mail->addAddress($email_add, '');
          $mail->Subject = 'GLEE Tech Service Request Invoice';
          $mail->isHTML(true);
          $mail->Body=$message; 
          $mail->send();
    }
?>