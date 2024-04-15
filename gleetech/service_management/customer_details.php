<?php
    include 'session.php';
    if(isset($_POST['id'])){
       $request_id=$_POST['id'];
       $sql = "SELECT admin.firstname, admin.lastname, admin.contact, admin.email_add, requests.customer_id, requests.region, requests.province, requests.city, requests.barangay, requests.street, requests.postal, requests.service_id, services.service_name, requests.customer_notes, requests.staff_notes, request_status.request_status  FROM admin LEFT JOIN requests ON admin.id=requests.customer_id LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE (requests.request_status_id=1 OR requests.request_status_id=6) AND requests.request_id=$request_id";    
       $query = $conn->query($sql);
       $row=$query->fetch_assoc();

       echo json_encode($row);
    }
?>