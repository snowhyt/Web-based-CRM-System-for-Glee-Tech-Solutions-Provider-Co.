<?php
  include 'session.php';

  $customer_id="";
  $sql="";

  if(isset($_POST['id'])){
    $customer_id =$_POST['id'];
    $sql = "SELECT requests.request_id, services.service_name, requests.customer_notes, request_status.request_status FROM requests LEFT JOIN services on requests.service_id=services.service_id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE (requests.request_status_id=1 OR requests.request_status_id=6) AND customer_id=$customer_id";     
  }
  else{
    $sql = "SELECT requests.request_id, services.service_name, requests.customer_notes, request_status.request_status FROM requests LEFT JOIN services on requests.service_id=services.service_id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE requests.request_status_id=1 OR requests.request_status_id=6"; 
  }

   $query = $conn->query($sql);
   $row = $query->fetch_assoc();

   echo json_encode($row);
?>