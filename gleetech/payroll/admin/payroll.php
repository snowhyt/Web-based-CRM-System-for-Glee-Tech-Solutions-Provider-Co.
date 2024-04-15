<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/01/Y');
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Printables</a></li>
        <li class="active">Payroll</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box"> 
            <div class="box-header with-border">
              <div class="pull-left page-buttons">
                <!--button for Print Preview-->
               <!--<button class="btn btn-success payroll" data-id=<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>" id="payroll"> 
                <span class="glyphicon glyphicon-print"></span> 
              Print Preview
              </button>-->
              </div>
              <!--apply button-->
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payrollFilter">
                  <span>&nbsp</span>
                  <button type="button" class="btn btn-info">Apply</button> 
                </form>
              </div>
              <!--calendar-->
              <div class="pull-right form-inline">
                 <!--from date-->
                  <div class="input-group date" data-date-format="mm/dd/yyyy">
                    <input  type="text" class="form-control" placeholder="From Date" id="payrollFromDate"value="<?php 
                       if(isset($_GET['range'])){
                          $range = $_GET['range'];
                          $ex = explode('-', $range);
                          $from = date('m/d/Y', strtotime($ex[0]));                       
                          echo $from;
                        }  
                        else
                        {
                          echo $range_from;
                        }
                        ?>">
                    <div class="input-group-addon" >
                     <span class="glyphicon glyphicon-th"></span>
                    </div>
                  </div>
                  <!--to date-->       
                  <div class="input-group date" data-date-format="mm/dd/yyyy">
                    <input  type="text" class="form-control" placeholder="To Date" id="payrollToDate" value="<?php 
                       if(isset($_GET['range'])){
                          $range = $_GET['range'];
                          $ex = explode('-', $range);
                          $to = date('m/d/Y', strtotime($ex[1]));                       
                          echo $to;
                        }  
                        else
                        {
                          echo $range_to;
                        }
                        ?>">
                    <div class="input-group-addon" >
                     <span class="glyphicon glyphicon-th"></span>
                    </div>
                  </div>
              </div> 
            </div>
            <!--payroll table-->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>               
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Gross</th>
                  <th>Deductions</th>
                  <th>Cash Advance</th>
                  <th>Net Pay</th>   
                  <th>Date</th>    
                  <th>View</th>
                </thead>
                <tbody>
                  <?php
                    //get deductions
                    $sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
                    $query = $conn->query($sql);
                    $drow = $query->fetch_assoc();
                    $deduction = $drow['total_amount'];

                    //set default from and to dates
                    $to =date('Y-m-d');
                    $from=date('Y-m-01');
                    
                    //check if header url has date range
                    //if yes, split it to get from and to dates
                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode('-', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }

                    //select query to get payroll details
                    $sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid, attendance.date as attdate FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id, date_format(attendance.date,'%m-%Y') ORDER BY employees.lastname ASC, employees.firstname ASC";

                    $query = $conn->query($sql);
                    $total = 0;
                    while($row = $query->fetch_assoc()){
                      $empid = $row['empid'];
                      $month = date('F,Y', strtotime($row['attdate']));
                      $casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
                     
                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $cashadvance = $carow['cashamount'];

                      $gross = round($row['rate'] * $row['total_hr']);
                      $total_deduction = round($deduction + $cashadvance);
                      $net = round($gross - $total_deduction);
                      $paymonth_from = date('m/01/Y',strtotime($month));
                      $paymonth_to=date('m/d/Y',strtotime($month));
                      $param = $row['employee_id']."_".$paymonth_from."-".$paymonth_to;

                      echo "
                        <tr>
                          <td>".$row['lastname'].", ".$row['firstname']."</td>
                          <td>".$row['employee_id']."</td>
                          <td>".number_format($gross, 2)."</td>
                          <td>".number_format($deduction, 2)."</td>
                          <td>".number_format($cashadvance, 2)."</td>                         
                          <td>".number_format($net, 2)."</td>
                          <td>".$month."</td>
                          <td>     
                            <button class='btn btn-info btn-sm view' data-id='".$param."'>Payslip</button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?> 

<script type="text/javascript">
//function to call when payslip button has been clicked
  $(document).on('click','.view',function(e){
    e.preventDefault();  
    var id = $(this).data('id');
    window.location = 'payslip_view?id='+id;
  });

//function to call when payroll print preview has been clicked
 $(document).on('click','.payroll',function(e){
    e.preventDefault();  
    var range = $(this).data('id');
    window.location = 'payroll_print_preview?range='+range;
  });

//function to call when apply button has been clicked
 $('#payrollFilter').click(function(){
    var fromDate= document.getElementById('payrollFromDate').value;
    var toDate = document.getElementById('payrollToDate').value;
    var range=fromDate+"-"+toDate;
    $('#payrollFilter').attr('action', 'payroll?range='+range);
    $('#payrollFilter').submit();
  });

//function to call to format the date in date picker and disable future dates
$('.input-group.date').datepicker({
  format: "mm/dd/yyyy",
  endDate: "today"+1
}); 

//function to call when searching
  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'payroll?range='+range;
  });

$("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
    $("#success-alert").slideUp(100);
});

$("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
    $("#success-alert").slideUp(100);
});

</script>
</body>
</html>
