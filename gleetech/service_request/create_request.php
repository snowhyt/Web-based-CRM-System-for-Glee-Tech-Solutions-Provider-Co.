<?php
    include 'session.php';	
    include 'functions.php';

    if(isset($_POST['create_request']))
    {   
       $service_id = $_POST['service_id'];
       $customer_id = $user["id"];
       $customer_notes = $_POST["notes"];
       $region = $_POST['selected_region'];
       $province = $_POST['selected_province'];
       $city = $_POST['selected_city'];
       $barangay = $_POST['selected_brgy'];
       $street = $_POST['street'];
       $postal = $_POST['postal'];
       $customer_name = $user['firstname']." ".$user['lastname'];
       $customer_address= $street.",".$barangay.",".$city.",".$province.",".$region." ".$postal;
       $customer_contact= $user['contact'];
       $service_type = $_POST['selected_service_type'];
       $service_description = $_POST['service_description'];
       $customer_email=$_POST['email'];
       
       $sql = $conn->prepare("INSERT INTO requests (service_id, customer_id, customer_notes, region, province, city, barangay, street, postal) VALUES (?,?,?,?,?,?,?,?,?)");
       $sql->bind_param("iisssssss",$service_id, $customer_id, $customer_notes, $region, $province, $city, $barangay, $street, $postal);

       if ($sql->execute()) {
            //send an email
            sendEmailForRequest($customer_name,
                                $customer_address, 
                                $customer_contact, 
                                $service_type, 
                                $service_description,
                                $customer_notes,
                                $customer_email);

            $_SESSION['success']='Service Request has been submitted.';
       }
       else{
            $_SESSION['error'] = $conn->error;
       }
        
        $sql->close();
    }

    header('location: home');

?>