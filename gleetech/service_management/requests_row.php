<?php
  include 'session.php';
  if(isset($_POST['id'])){
     $request_id = $_POST['id'];

     $sql = "SELECT requests.request_id, services.service_name, services.description, requests.customer_notes, admin.firstname, admin.lastname, requests.region, requests.province, requests.city, requests.barangay, requests.postal, requests.street, admin.contact, admin.email_add, requests.staff_notes FROM requests LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN admin ON requests.customer_id=admin.id WHERE request_id=$request_id";
     $query = $conn->query($sql);
     $row = $query->fetch_assoc();

     echo json_encode($row);
  }
?>