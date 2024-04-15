<?php
    include 'session.php';
    include 'functions.php';

    if(isset($_POST['save_request'])){
         $service_type=$_POST['add_service_name'];
         $service_id=$_POST['add_service_id'];
         $service_description=$_POST['add_service_description'];
         $customer_id=$_POST['customer_id'];
         $modified_by=$user['id'];
         $staff_notes=$_POST['notes'];
         $region=$_POST['selected_region'];
         $province=$_POST['selected_province'];
         $city=$_POST['selected_city'];
         $barangay=$_POST['selected_brgy'];
         $postal=$_POST['postal'];
         $street=$_POST['street'];
         $firstname=$_POST['add_customer_firstname'];
         $lastname=$_POST['add_customer_lastname'];
         $email_add=$_POST['add_customer_email'];
         $contact=$_POST['add_customer_contact'];

         //check if the user is existing
         if($customer_id==''){        
            //check if the user is already existing
            if(emailAddressAlreadyExists($email_add)){
               $_SESSION['error'] = "User with email address ".$email_add." already exists.";
               header('location:requests');
               exit;
            }
            
            //save the user details in the table
            $sql="INSERT INTO admin (username, firstname, lastname, user_type, updated_by, email_add, contact) VALUES ('bot', '$firstname', '$lastname', 'Customer', '$modified_by', '$email_add', '$contact')";
            $query=$conn->query($sql);   

            //get the customer new customer id
            $sql = "SELECT id FROM admin WHERE email_add='$email_add'";
            $query= $conn->query($sql);
            $row = $query->fetch_assoc();
            $customer_id=$row['id'];
         }
            
         //save to request table
         $sql=$conn->prepare("INSERT INTO requests (service_id, customer_id, modified_by, staff_notes, region, province, city, barangay, postal, street) VALUES (?,?,?,?,?,?,?,?,?,?)");
         $sql->bind_param("iiisssssss",$service_id,
                                      $customer_id,
                                      $modified_by,
                                      $staff_notes,
                                      $region,
                                      $province,
                                      $city,
                                      $barangay,
                                      $postal,
                                      $street);

         if($sql->execute()){
            //send an email
            $customer = $firstname." ".$lastname;
            sendEmailForCreatedRequest($customer,
                                       $email_add,
                                       $service_type,
                                       $service_description, 
                                       "", 
                                       $staff_notes, 
                                       "Pending");

            $_SESSION['success'] = "Service request has been submitted.";
         }
         else{
            $_SESSION['error'] = $conn->error;
         }

         $sql->close();

         header('location: requests');
    }


?>