<?php
    include 'session.php';
    include 'functions.php';
    include 'timezone.php';
    
    if(isset($_POST['create'])){
        //get last invoice number
        $sql = "SELECT invoice_id FROM invoice ORDER BY generated_date DESC LIMIT 1";
        $query=$conn->query($sql);

        //new invoice number
        $invoice_id="";

        if($query->num_rows>0){
            $row = $query->fetch_assoc();
            $invoice_id = (int)$row['invoice_id']+1;

            $invoice_id =(string)$invoice_id;
            $invoice_id_length = strlen($invoice_id);


            if($invoice_id_length<5){
               for($x=$invoice_id_length;$x<5;$x++){
                $invoice_id = "0".$invoice_id;
               }
            }
        }
        else{
           $invoice_id = "00001";
        }
       
        $customer_name = $_POST['customer_firstname']." ".$_POST['customer_lastname'];
        $customer_id = $_POST['existing_customer_id'];
        $region = $_POST['region'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $barangay= $_POST['barangay'];
        $street = $_POST['street'];
        $postal = $_POST['postal'];
        $request_id = $_POST['customer_request_id'];
        $service_amount = $_POST['service_amount'];
        $service_discount =  $_POST['service_discount'];   
        $sub_total =  $_POST['subtotal'];
        $total =  $_POST['total'];
        $tax_rate =  $_POST['tax_rate'];
        $tax =  $_POST['tax'];
        $service_details =  $_POST['service_details'];
        $issued_by = $user['id'];
        $issued_date = date('m/t/Y');
        $email_add = $_POST['customer_email'];
        $service_type=$_POST['myServiceType'];
        //insert the invoice details
        $sql = $conn->prepare("INSERT INTO invoice (invoice_id, customer_id, customer_region, customer_province, customer_city, customer_barangay,  customer_street, customer_postal, request_id, service_amount, service_discount, sub_total, total, service_details, tax_rate, tax_amount, issued_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql ->bind_param("sissssssiddddssds",
                          $invoice_id,
                          $customer_id,
                          $region,
                          $province,
                          $city, 
                          $barangay, 
                          $street, 
                          $postal, 
                          $request_id,
                          $service_amount,
                          $service_discount,
                          $sub_total,
                          $total,
                          $service_details,
                          $tax_rate,
                          $tax,
                          $issued_by); 
        if($sql->execute()){          
            //send an email
            sendEmailForCreatedInvoice($request_id,
                                        $customer_name,
                                        $invoice_id, 
                                        $issued_date,
                                        $myServiceType,
                                        $service_details,
                                        $service_amount,
                                        $service_discount, 
                                        $tax_rate."%", 
                                        $tax, 
                                        $total, 
                                        $email_add);

            $_SESSION['success'] = "Invoice has been created.";
        }
        else{
            $_SESSION['error'] = $conn->error;
        }

        $sql->close();
    }

    header('location: generate_invoice');
?>