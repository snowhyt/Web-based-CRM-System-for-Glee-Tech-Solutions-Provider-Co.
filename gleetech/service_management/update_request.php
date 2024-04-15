<?php
    include 'session.php';
    include 'timezone.php';
    include 'functions.php';

    $date_now = date('Y-m-d');

    if(isset($_POST['update_request'])){

        $request_status_id = $_POST['request_status_id'];
        $my_request_id=$_POST['request_id'];

        if($request_status_id==7){
            if(hasInvoice($my_request_id)==false){
                $_SESSION['error'] ="Please create an invoice first, before closing the request.";
                header('location:requests');
                exit;
            }
        }
 
        $customer = $_POST['customer_name'];
        $email_add=$_POST['email'];
        $service_type = $_POST['service_type'];
        $service_description=$_POST['description'];
        $customer_notes=$_POST['notes'];
        $request_status=$_POST['request_status'];    
        $staff_notes = $_POST['staff_notes'];
        $modified_by =$user['id'];
        $paid = $request_status_id ==7 ? 1:0;
        
        $sql = "UPDATE requests SET request_status_id=$request_status_id, modified_by=$modified_by, staff_notes='$staff_notes', paid=$paid WHERE request_id=$my_request_id";
        if($conn->query($sql)){

           //send an email
           sendEmailForUpdatedRequest($customer,
                                      $my_request_id,
                                      $email_add,
                                      $service_type,
                                      $service_description,
                                      $customer_notes,
                                      $staff_notes,
                                      $request_status);


           $_SESSION['success'] = "Service request has been updated.";
        }
        else{
            $_SESSION['error']= $conn->error;
        }
    }

    header('location:requests');
?>
