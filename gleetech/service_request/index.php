<?php include 'session.php'; ?>
<?php
  if(isset($_SESSION['customer'])){
    header('location:home');
  }
  else{
    header('location:../home');
  }
?>