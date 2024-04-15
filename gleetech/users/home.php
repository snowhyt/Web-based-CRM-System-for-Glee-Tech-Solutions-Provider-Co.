<?php 
  include 'session.php'; 
  include 'header.php';
  include 'functions.php';
  include 'timezone.php'; 

  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }

  $registered_users =0;
  $active_users=0;
  $customers=0;
  $banned_users=0;
  $admin_accounts=0;
  $staff_accounts=0;
  $pending_accounts=0;
  $deactivated_accounts=0;
  
  //get all registered users
  $allusers = getRegisteredUsers($year);
  while($row=$allusers->fetch_assoc()){
    $registered_users ++;

    if($row['active']){
      $active_users++;
    }

    if($row['user_type']=='Customer'){
      $customers++;
    }

    if($row['banned']){
      $banned_users++;
    }

    if($row['user_type']=='Admin'){
      $admin_accounts++;
    }

    if($row['user_type']=='Staff'){
      $staff_accounts++;
    }
    
    if(!$row['active'] && !$row['account_activated']){
      $pending_accounts++;
    }

    if(!$row['active']){
      $deactivated_accounts++;
    }
  }

?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php 
    include 'navbar.php'; 
    include 'menubar.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <li class="fa fa-dashboard"></li>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <!-- Notifications -->
       <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible' id='error-alert'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible' id='success-alert'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
       <!-- Small boxes (Stat box) -->
      <div class="row">

        <!-- number of registered users -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
             <h3><?php echo $registered_users;?></h3>
              <p>Registered Users</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-ios-people"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
     
        <!-- number of active users -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $active_users;?></h3>
              <p>Active Users</p>
            </div>
            <div class="icon">           
              <i class="ionicons ion-person-stalker"></i>
            </div>
            <a href="system_users?id=1" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- number of valid customers -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-purple">
            <div class="inner">
             <h3><?php echo $customers;?></h3>
              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-ios-people-outline"></i>
            </div>
            <a href="customer_accounts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- number of banned accounts -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
             <h3><?php echo $banned_users;?></h3>
              <p>Banned Users</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-android-hand"></i>
            </div>
            <a href="banned_accounts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>

      <div class="row">
        <!-- number of admin accounts -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-blue">
            <div class="inner">
             <h3><?php echo $admin_accounts;?></h3>
             <p>Admin Accounts</p>
            </div>
            <div class="icon">
               <i class="ionicons ion-ios-contact"></i>
            </div>
            <a href="system_users?type=Admin" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- number of staff accounts -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">
             <h3><?php echo $staff_accounts;?></h3>
              <p>Staff Accounts</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-ios-contact-outline"></i>
            </div>
            <a href="system_users?type=Staff"" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- number of pending accounts -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
             <h3><?php echo $pending_accounts;?></h3>
              <p>Pending Activation</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-clock"></i>
            </div>
            <a href="pending" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
     
        <!-- number of deactivated accounts -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $deactivated_accounts;?></h3>
              <p>Deactivated Accounts</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-close-circled"></i>
            </div>
            <a href="system_users?id=0" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

    </div>

      <!--chart-->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Users Dashboard Report</h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                       <option value="<?php echo $year;?>" selected><?php echo $year;?></option>
                       <?php setYearFilter();?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
  	<?php include 'footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php include 'scripts.php'; ?>

<!-- Chart Data -->
<?php
  $and = 'AND YEAR(request_date) = '.$year;
  $months = array();
  $my_registered_users = array();
  $my_active_users =array();
  $my_customers = array();
  $my_banned_users=array();

  for( $m = 1; $m <= 12; $m++ ) {
    //registered users
    $sql = "SELECT id FROM admin WHERE MONTH(created_on)='$m'";
    $oquery = $conn->query($sql);
    array_push($my_registered_users, $oquery->num_rows);

    //active users
    $sql = "SELECT id FROM admin WHERE MONTH(created_on)='$m' AND active=1 AND banned=0";
    $oquery = $conn->query($sql);
    array_push($my_active_users, $oquery->num_rows);

    //customers
    $sql = "SELECT id FROM admin WHERE MONTH(created_on)='$m' AND user_type='Customer'";
    $oquery = $conn->query($sql);
    array_push($my_customers, $oquery->num_rows);

    //banned users
    $sql = "SELECT id FROM admin WHERE MONTH(created_on)='$m' AND banned=1";
    $oquery = $conn->query($sql);
    array_push($my_banned_users, $oquery->num_rows);

    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $my_registered_users = json_encode($my_registered_users);
  $my_active_users = json_encode($my_active_users);
  $my_customers = json_encode($my_customers);
  $my_banned_users = json_encode($my_banned_users);
?>

<script>
  $(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      //registered users
      {
        label               : 'Registered Users',
        fillColor           : 'rgb(6, 154, 228, 1)',
        strokeColor         : 'rgb(6, 154, 228, 1)',
        pointColor          : 'rgb(6, 154, 228, 1)',
        pointStrokeColor    : 'rgb(6, 154, 228, 1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255, 99, 71, 1)',
        data                : <?php echo $my_registered_users; ?>
      },
      //active users
      {
        label               : 'Active Users',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $my_active_users; ?>
      },
      //customers
      {
        label               : 'Customers',
        fillColor           : 'rgb(115, 6, 228, 1)',
        strokeColor         : 'rgb(115, 6, 228, 1)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgb(115, 6, 228, 1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $my_customers; ?>
      },
      //banned users
      {
        label               : 'Banned Users',
        fillColor           : 'rgba(255, 99, 71, 1)',
        strokeColor         : 'rgba(255, 99, 71, 1)',
        pointColor          : 'rgba(255, 99, 71, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255, 99, 71, 1)',
        data                : <?php echo $my_banned_users; ?>
      } 
    ]
  }


  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});

$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home?year='+$(this).val();
  });

  $("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
    });

    $("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
    });
});

    
</script>
</body>
</html>
