<?php
    include 'session.php';
    include 'timezone.php';
    include 'functions.php';
    
    if(isset($_POST['banned'])){
       $customer_id=$_POST['edit_customer_id'];
       $modified_by = $user['id'];
       $modified_date = date('Y-m-d');
       $reason=$_POST['reason_for_banning'];
       $customer_name = $_POST['edit_customer_username'];
       $customer_email= $_POST['edit_customer_email_add'];

       $sql = "UPDATE admin SET updated_by=$modified_by, date_updated='$modified_date',  banned=1, reason_for_banning='$reason' WHERE id=$customer_id";
       if($conn->query($sql)){
            //create an email
            sendBannedAccountNotification($customer_name, $reason, $customer_email);

            $_SESSION['success'] = "Customer account has been banned.";
       }else{
            $_SESSION['error'] = $conn->error; 
       }

       header('location: customer_accounts');
    }
    elseif(isset($_POST['unbanned'])){
        $customer_id=$_POST['customer_id_reinstate'];
        $modified_by = $user['id'];
        $modified_date = date('Y-m-d');
        $customer_email= $_POST['customer_email_reinstate'];
        $customer_name = $_POST['customer_name_reinstate_2'];

        $sql = "UPDATE admin SET updated_by=$modified_by, date_updated='$modified_date',  banned=0 WHERE id=$customer_id";
        if($conn->query($sql)){
            //send an email notification
            sendUnbannedAccountNotification($customer_name, $customer_email);

            $_SESSION['success']="Customer account has been reinstated.";
        }
        else{
            $_SESSION['error']=$conn->error;
        }

        header('location: banned_accounts');
    }

  
?>