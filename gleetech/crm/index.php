<?php 
  include 'session.php';
  include 'header.php';
  include 'functions.php';
?>
<?php
  if (isset($_SESSION['admin']) || isset($_SESSION['staff']) || isset($_SESSION['customer'])) {
    header('location: http://localhost/gleetech/home');
  } 

  //check if for account activation
  if(isset($_GET['id'])){
    $date_today  =  date("Y-m-d H:i:s A");
    $token= $_GET['id'];
    
    //check if the token is not yet expired
    expiredToken($token, $date_today);
  }
?>

<body class="hold-transition login-page" style="overflow:hidden;">
<div class="login-box">
  <!--notification-->
  <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible mt20' id='error-alert'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible mt20' id='success-alert'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
  ?>
  <!--modals-->   
  <?php 
    include 'forgot_password_modal.php';
    include 'create_account_modal.php';
  ?>

    <!--login body-->
  <form method="POST" action="login.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
    <div class="box" style="border-radius:5px;color:darkslategrey;">
        <div class="pane panel-default" style="border-radius:5px;">
          <!--header-->
          <div class="panel-heading" style="text-align:center;border-radius:5px 5px 0px 0px;">
            <image src="../payroll/images/icon.png"></image>
              <p class="no-margin" style="font-size: 20px;font-weight:medium;">GLEE Tech Solutions Provider Co.</p>
              <p style="font-size: x-small;">Trust the experts in installation and repair services</p>
          </div>

          <!--content-->
          <div class="panel-body form-group form-group-sm" style="padding:20px 40px 0px;">    
            <p><b>User Login</b></p>
            <!--username-->
            <div class="input-group input-group-sm margin-bottom">
              <span class="input-group-addon">
                <li class="fa fa-user"></li>
              </span>
              <input type="text" class="form-control" id="username" name="username"  placeholder="Enter Username" required>          
            </div>

            <!--password-->
            <div class="input-group input-group-sm margin-bottom">
              <span class="input-group-addon">
                <li class="fa fa-unlock-alt"></li>
              </span>
              <input type="password" class="form-control" id="password" name="password"  placeholder="Enter Password" required>          
            </div>

            <!--forgot password/sign-in-->
            <div class="margin-bottom">
              <a href="#forgot" data-toggle="modal" class="margin-bottom">Forgot Password</a>

              <button type="submit" name="login" class="btn btn-info pull-right">
              <i class="fa fa-sign-in"></i>
              Sign-in
              </button>
            </div>

            <br>
            <div class="no-margin-bottom">
              <span>Not a member yet?</span>
              <a href="#create" data-toggle="modal">Create an account</a>
            </div>  

          </div>
          
          <!--footer-->
          <div class="panel-heading" style="border-radius:5px;">
              <p class="no-margin" style="text-align:center;font-size:10px;">Copyright &copy; 2023. <a href="../home">GLEE Tech Solutions Provider Co.</a></p>
          </div>
        </div>
    </div>  
  </form>
<?php include 'scripts.php';?>
<script>
  $("#success-alert").fadeTo(5000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });

  $("#error-alert").fadeTo(5000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });
</script>
</body>
</html>