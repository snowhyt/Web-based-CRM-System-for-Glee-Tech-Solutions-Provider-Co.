<?php include 'session.php'; ?>
<?php
  if(isset($_SESSION['admin']) || isset($_SESSION['staff'])){
    header('location:home');
  }
  else{
    header('location:http://localhost/gleetech/crm');
  }
?>