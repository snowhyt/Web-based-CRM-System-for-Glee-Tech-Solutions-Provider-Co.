<?php 
  include 'session.php';
  include 'header.php';

  //prevent non admin and non staff users from accessing attendance page monitoring page
  if(!isset($_SESSION['admin']) && !isset($_SESSION['staff'])){
    //return to home page
    header('location:../home');
 }
?>

<body class="hold-transition login-page" style="overflow:hidden;">
<div class="login-box">
  <!--notification panel-->
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
 
  <!--login body-->
  <form method="POST" action="attendance_update.php" enctype="multipart/form-data">
    <div class="box" style="border-radius:5px;color:darkslategrey;">
        <div class="pane panel-default" style="border-radius:5px;">
          <!--header-->
          <div class="panel-heading" style="text-align:center;border-radius:5px 5px 0px 0px;">
            <image src="../payroll/images/icon.png"></image>
              <p class="no-margin" style="font-size: 20px;font-weight:medium;">GLEE Tech Solutions Provider Co.</p>
              <p style="font-size: x-small;">Trust the experts in installation and repair services</p>
          </div>

          <!--content-->
          <div class="panel-body form-group form-group-sm" style="padding:10px 40px 0px;">    
            <h4 style="text-align: center;"><b>Attendance Monitoring</b></h4>
            
            <!--date-->
            <i class="fa fa-calendar"></i>&nbsp   
            <span id="date"></span>
            
            <!--time-->
            <div class="pull-right">
              <i class="fa fa-clock-o"></i>
              <span id="time"></span>
            </div>

            <br><br>

            <!--employee id-->
            <div class="input-group input-group-sm margin-bottom">
              <span class="input-group-addon">
                <li class="fa fa-id-badge"></li>
              </span>
              <input type="text" class="form-control" id="employee" name="employee"  placeholder="Enter Employee ID" autofocus required>          
            </div>

            <!--timein/timeout-->
            <div class="input-group input-group-sm margin-bottom">
              <span class="input-group-addon">
                <li class="fa fa-clock-o"></li>
              </span>
              <select class="form-control input-lg" name="status" required>
                <option value="in">Time In</option>
                <option value="out">Time Out</option>
              </select>
            </div>

            <!--forgot password/submit-->
            <div class="margin-bottom">
              <button type="submit" name="signin" class="btn btn-info pull-right">
              <i class="fa fa-sign-in"></i>
              Submit
              </button>
            </div>

          </div>
          
          <!--footer-->
          <div class="panel-heading" style="border-radius:5px;">
              <p class="no-margin" style="text-align:center;font-size:10px;">Copyright &copy; 2023. <a href="../home">GLEE Tech Solutions Provider Co.</a></p>
          </div>
        </div>
    </div>  
  </form>

<!--scripts-->
<?php include 'scripts.php';?>

<script>
 $(function() {

    //function for running time
    var interval = setInterval(function() {
    var momentNow = moment();
      $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
      $('#time').html(momentNow.format('hh:mm:ss A'));
    }, 100);  
    
    //function to automatically close success notification
    $("#success-alert").fadeTo(5000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
    });

    //function to automatically close error notification
    $("#error-alert").fadeTo(5000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
    });

  });
</script>
</body>
</html>