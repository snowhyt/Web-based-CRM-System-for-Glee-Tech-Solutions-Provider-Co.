<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['admin'])){
    header('location:home');
  }
  else{
    header('location:http://localhost/gleetech/home');
  }
?>