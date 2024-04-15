<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/t/Y');
  $range_from = date('m/01/Y');
  //$range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
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
        <li><a href="payroll?range=<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.'-'.$range_to; ?>">Payroll</a></li>
        <li class="active">Print Preview</li>
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
              <!--button to print-->
              <div class="pull-left page-buttons">
               <button type="button" class="btn btn-success btn-sm payroll" id="payroll" onclick="javascript:window.print();"> 
                <span class="glyphicon glyphicon-print"></span> 
              Print
               </button>
              </div>
            </div>
            <!--payroll table-->
            <div class="box-body">
              <table id="tblPayrollPrintPreview" class="table table-bordered">
                <thead>               
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Gross</th>
                  <th>Deductions</th>
                  <th>Cash Advance</th>
                  <th>Net Pay</th>   
                  <th>Date</th>                     
                </thead>
                <tbody>
                  <?php 
                    $sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
                    $query = $conn->query($sql);
                    $drow = $query->fetch_assoc();
                    $deduction = $drow['total_amount'];
  
                    $to =date('m/t/Y');
                    $from=date('m/01/Y');

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode('-', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }

                    echo "
                    <div class='pull-left'>
                      <h4>Employees Payroll</h4>
                    </div>
                    <div class='pull-right'>
                      <h4>Date: ".$from.' - '.$to."</h4>
                    </div>
                    ";

                    $sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid, attendance.date as attdate FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id, attendance.date ORDER BY employees.lastname ASC, employees.firstname ASC";

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
                      $paymonth_to=date('m/t/Y',strtotime($month));
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
</div>
<?php include 'includes/scripts.php'; ?>
<script type="text/javascript">
  $("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
    $("#success-alert").slideUp(100);
  });

  $("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
        $("#success-alert").slideUp(100);
  });

</script>
</body>
</html>
