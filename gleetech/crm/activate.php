<?php
  /** This module is for the activation page of the customer registration */

  include 'session.php';
  include 'header.php';
  include 'functions.php';
?>
<?php
  //check if the user is admin, staff, or customer, else redirect to home page
  if (isset($_SESSION['admin']) || isset($_SESSION['staff']) || isset($_SESSION['customer'])) {
    header('location: http://localhost/gleetech/home');
  } 
?>

<body class="hold-transition login-page" style="overflow:hidden;">
<div class="login-box">
  <!--notification-->
  <?php
        //for error notification
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
        //for success notification
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

  <!--login body-->
  <form method="POST" action="activate_update.php" enctype="multipart/form-data">
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

            <?php
              //get the token from the url
              $token = $_GET['id'];
              
              echo "<input type='hidden' id='token_id' name='token_id' value='$token'>";

              //check if token is not yet expired
              if(resetLinkExpired($token)){
                //--> output if expired
                echo "<p style='color:red;'>Your activation link is already expired.</p>
                      <p style='font-size: small;'>If you need further assistance, please contact us at admin@gleetechsolutionsproviderco.com.</p>";  
              }
              else{
                //--> output if not expired
                echo "<p><b>Set your account password</b></p>
                      <div class='form-group'>
                        <div>
                          <p class='text-muted' style='font-size:0.8em;font-weight:bold;'>Requirements</p>
                          <p class='text-muted' style='font-size:0.7em;'>Atleast 8 characters in length</p>
                          <p class='text-muted' style='font-size:0.7em;'>Atleast 1 numeric value</p>
                          <p class='text-muted' style='font-size:0.7em;'>Atleast 1 special character ?=.*[!@#$%^&*_=+-</p>
                        </div>
                      </div>
          
                      <!--password-->
                      <div class='input-group input-group-sm margin-bottom'>
                        <span class='input-group-addon'>
                          <li class='fa fa-unlock-alt'></li>
                        </span>
                        <input type='password' class='form-control' id='password' name='password'  placeholder='Enter your new password' pattern='^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$' minlength='8' maxlength='20' autofocus required>          
                      </div>
          
                      <!--re-password-->
                      <div class='input-group input-group-sm margin-bottom'>
                        <span class='input-group-addon'>
                          <li class='fa fa-unlock-alt'></li>
                        </span>
                        <input type='password' class='form-control' id='repassword' name='repassword'  placeholder='Re-enter your new password' pattern='^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$' minlength='8' maxlength='20' autofocus required>          
                      </div>
          
                      
                      <span id='message'></span>
                  
                      <!--submit-->
                      <div class='margin-bottom'>
                        <button type='submit' name='save' id='save' class='btn btn-info pull-right' disabled>
                        <i class='fa fa-paper-plane'></i>
                        Submit
                        </button>
                      </div>";
              }
            ?>
          </div>
          
          <!--footer-->
          <div class="panel-heading" style="border-radius:5px;">
              <p class="no-margin" style="text-align:center;font-size:10px;">Copyright &copy; 2023. <a href="../home">GLEE Tech Solutions Provider Co.</a></p>
          </div>
        </div>
    </div>  
  </form>
 <!--javScripts references--> 
<?php include 'scripts.php';?>

<script>
  //function to close success notification
  $("#success-alert").fadeTo(5000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });

  //function to close error notification
  $("#error-alert").fadeTo(5000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });

  //function to show hide password
  $('#password, #repassword').on('keyup', function () {
    if ($('#password').val()!='') {
      if ($('#password').val() == $('#repassword').val()) {
        $('#message').html('Password matched.').css('color', 'green');
        document.getElementById("save").disabled=false;
      } else{
        $('#message').html('Password did not matched.').css('color', 'red');
        document.getElementById("save").disabled=true;
      }  
    }else{
      $('#message').html('');
      document.getElementById("save").disabled=true;
    }
});
</script>
</body>
</html>