<?php
    include 'session.php';	
    include 'functions.php';

    if(isset($_POST['cancel_request']))
    {   
       $request_id = $_POST['cancel_request_id'];
       $cancellation_notes = $_POST['cancellation_notes'];
       $customer_name =$_POST['requestor'];
       $service_type = $_POST['cancelled_service_type'];
       $contact=$_POST['requestor_contact'];
       $email = $user['email_add'];
         
       //check if service request status is not yet approved
       $sql = "SELECT * FROM requests WHERE request_id='$request_id' AND request_status_id=2";
       $query = $conn->query($sql);
        
       if ($query->num_rows==0) {
            $_SESSION['error'] = "Request cannot be cancelled. Please contact customer service for assistance.";
       }
       else{
            $sql="UPDATE requests SET customer_notes='$cancellation_notes', request_status_id=3 WHERE request_id=$request_id";
            
            if ($conn->query($sql)) {
                //send email
                sendEmailForCancellation($request_id, 
                                         $customer_name, 
                                         $contact, 
                                         $service_type, 
                                         $cancellation_notes, 
                                         $email);

                $_SESSION['success']='Service Request has been cancelled.';
            }
            else{
                    $_SESSION['error'] = $conn->error;
            }   
       }
    }

    header('location: home');

?>