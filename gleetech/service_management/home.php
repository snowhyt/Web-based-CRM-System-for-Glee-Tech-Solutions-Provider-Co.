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

  //number of services
  $services = getServiceCount();
  //total request
  $total_request=0;
  //paid request
  $paid_request=0;
  //unpaid request
  $unpaid_request=0;
  //approved request
  $approved_request=0;
  //pending request
  $pending_request=0;
  //in progress request
  $inprogress_request=0;
  //cancelled request
  $cancelled_request=0;
  //get the query result
  $query = getRequestCount(idate("m"), $year);

  while($row=$query->fetch_assoc()){
    
    switch($row["request_status"]){
      case "Approved":
        $approved_request=$row["total"];
        $unpaid_request ++;
        break;
      case "Pending":
        $pending_request=$row["total"];
        $unpaid_request ++;
        break;
      case "Cancelled":
        $cancelled_request=$row["total"];
        break;
      case "In Progress":
        $inprogress_request=$row["total"];
        $unpaid_request ++;
        break;
      case "Closed":
        $paid_request=$row["total"];
        break;
      default:
        $unpaid_request ++;
        break;
    }
    $total_request += $row["total"];
  }
  
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php 
    include 'includes/navbar.php'; 
    include 'includes/menubar.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
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

        <!-- number of services -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
             <h3><?php echo $services;?></h3>
              <p>Number of Services</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-ios-cog"></i>
            </div>
            <a href="services" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
     
        <!-- total requests -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $total_request;?></h3>
              <p>Total Service Request</p>
            </div>
            <div class="icon">
                <i class="ionicons ion-settings"></i>
            </div>
            <a href="requests?status=all" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- paid request -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
             <h3><?php echo $paid_request;?></h3>
              <p>Paid Request</p>
            </div>
            <div class="icon">
             <i class="ionicons ion-cash"></i>
            </div>
            <a href="requests?status=7" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- unpaid request -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
             <h3><?php echo $unpaid_request;?></h3>
              <p>Unpaid Request</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-social-usd"></i>
            </div>
            <a href="requests?status=unpaid" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>

      <div class="row">
        <!-- approved request -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-blue">
            <div class="inner">
             <h3><?php echo $approved_request; ?></h3>
              <p>Approved Request</p>
            </div>
            <div class="icon">
               <i class="ionicons ion-checkmark-circled"></i>
            </div>
            <a href="requests?status=1" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- in-progress request -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">
             <h3><?php echo $inprogress_request; ?></h3>
              <p>In-progress Request</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-load-d"></i>              
            </div>
            <a href="requests?status=6" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- pending request -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
             <h3><?php echo $pending_request; ?></h3>
              <p>Pending Request</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="requests?status=2" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
     
        <!-- cancelled -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $cancelled_request; ?></h3>
              <p>Cancelled Request</p>
            </div>
            <div class="icon">
              <i class="ionicons ion-android-cancel"></i>
            </div>
            <a href="requests?status=3" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

    </div>

      <!--chart-->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Service Request Report</h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
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
  	<?php include 'includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php include 'scripts.php'; ?>

<!-- Chart Data -->
<?php
  $and = 'AND YEAR(request_date) = '.$year;
  $months = array();
  $myTotalRequest = array();
  $myPaidRequest =array();
  $myCancelledRequest = array();
  for( $m = 1; $m <= 12; $m++ ) {
    //total request
    $sql = "SELECT * FROM requests WHERE MONTH(request_date)= '$m' $and";
    $oquery = $conn->query($sql);
    array_push($myTotalRequest, $oquery->num_rows);

    //paid request
    $sql = "SELECT * FROM requests WHERE request_status_id=7 AND MONTH(request_date)= '$m' $and";
    $oquery = $conn->query($sql);
    array_push($myPaidRequest, $oquery->num_rows);

    //cancelled request
    $sql = "SELECT * FROM requests WHERE request_status_id=3 AND MONTH(request_date)= '$m' $and";
    $oquery = $conn->query($sql);
    array_push($myCancelledRequest, $oquery->num_rows);

    //months
    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $myTotalRequest = json_encode($myTotalRequest);
  $myPaidRequest = json_encode($myPaidRequest);
  $myCancelledRequest = json_encode($myCancelledRequest);
?>

<script>
  $(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      //total request
      {
        label               : 'Total Request',
        fillColor           : 'rgba(255, 99, 71, 1)',
        strokeColor         : 'rgba(255, 99, 71, 1)',
        pointColor          : 'rgba(255, 99, 71, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255, 99, 71, 1)',
        data                : <?php echo $myTotalRequest; ?>
      },
      //paid request
      {
        label               : 'Paid Request',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $myPaidRequest; ?>
      },
      //cancelled request
      {
        label               : 'Cancelled Request',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $myCancelledRequest; ?>
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
    window.location.href = 'home.php?year='+$(this).val();
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
