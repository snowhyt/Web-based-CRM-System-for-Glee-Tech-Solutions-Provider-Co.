<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payslip
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-files-o"></i> Printables</li>
        <li><a href="payroll?range=<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.'-'.$range_to; ?>">Payroll</a></li>
        <li class="active">Payslip</li>
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
            <div class="box-header with-border page-buttons">
             <button type="button" class="btn btn-success" id="printpayslip" onclick="javascript:window.print()"><span class="glyphicon glyphicon-print"></span> Print</button>
            </div>
            <div class="box-body">   
             
                <!--payslip details-->
               <?php
                 
                    $urlid=$_GET['id'];
                    $params = explode("_",$urlid);
                    $id=$params[0];
                    $from=date('Y-m-d',strtotime(explode("-",$params[1])[0]));
                    $to=date('Y-m-d',strtotime(explode("-",$params[1])[1]));

                echo
                "<div class='pull-left'>
                    <h4>Employee Details</h4>
                </div>
                <div class='pull-right'>
                    <h4 class='pull-right'>".'Date: '.$from.' - '.$to."</h4>
                </div>
                  <table id='tblEmployeeDetails' class='table table-bordered'>
                    <thead>               
                      <th>Name</th>
                      <th>Employee ID</th>
                      <th>Position Title</th>
                      <th>Rate Per Hour</th>                
                    </thead>
                    <tbody>"; 

                    $sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
                    $query = $conn->query($sql);
                    $drow = $query->fetch_assoc();
                    $deduction = $drow['total_amount'];
                  

                    $sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid, attendance.date as attdate, employees.id as identifier FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE employees.employee_id='$id' AND date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

                    $query = $conn->query($sql);
                    $total = 0;
                      $row = $query->fetch_assoc();                
                      $empid = $row['identifier'];
                      $casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";                   
                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      if ($carow['cashamount']==0) {
                         $cashadvance = 0;
                      }else{
                        $cashadvance= $carow['cashamount'];
                      }
                     
                      $total_hour =$row['total_hr'];
                      $rate=$row['rate'];
                      $gross = round(($rate * $total_hour));
                      $total_deduction = round($deduction + $cashadvance);
                      $net = round($gross - $total_deduction);
                      
                      echo " 
                          <tr>
                          <td>".$row['lastname'].", ".$row['firstname']."</td>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['description']."</td>
                          <td>".$row['rate']."</td>       
                        </tr>
                      "; 
                    
                     echo "</tbody></table>";

                      $philhealth=0;
                      $pagibig=0;
                      $sss=0;

                      $sql="SELECT * FROM deductions";
                      $query = $conn->query($sql);
                      while($row=$query->fetch_assoc()){
                        switch ($row['description']) {
                          case 'SSS':
                            $sss=$row['amount'];
                            break;
                          case 'Pagibig':
                            $pagibig=$row['amount'];
                            break;
                          case 'PhilHealth':
                            $philhealth=$row['amount'];
                            break;
                        }            
                      }

                      $sql = "SELECT count(*) as count FROM attendance LEFT JOIN employees ON attendance.employee_id=employees.id Where employees.employee_id='$id' AND attendance.date BETWEEN '$from' AND '$to'";
                      $query=$conn->query($sql);
                      $row1=$query->fetch_assoc();

                      if (($row1['count']*8)>$total_hour) {
                        $late_deduction= round((($row1['count']*8)-$total_hour) * $rate);
                      }else{
                        $late_deduction=0;
                      }
                      
                      echo "<br/><h4>Salary Details</h4>
                        <table id='tblDeductions' class='table table-bordered'>
                          <thead>
                            <th>PHILHEALTH</th>                 
                            <th>PAGIBIG</th>
                            <th>SSS</th>
                            <th>Short Hrs. Deduction</th>              
                            <th>Cash Advance</th>     
                            <th>Gross Pay</th>              
                            <th>Net Pay</th>              
                          </thead>
                          <tbody>
                            <tr>
                            <td>".$philhealth."</td>
                            <td>".$pagibig."</td>
                            <td>".$sss."</td>
                            <td>".$late_deduction."</td>
                            <td>".$cashadvance."</td>
                            <td>".$gross."</td>
                            <td>".$net."</td>
                            </tr>                           
                          </tbody>
                        </table>       
                      ";
                    ?>
       
              <!--attendance details-->
              <br/>                 
                  <?php
                    echo "<h4>Attendance Details</h4>
                          <table id='tblAttendance' class='table table-bordered'>
                             <thead>
                              <th class='hidden'></th>             
                              <th>Date</th>
                              <th>Time In</th>
                              <th>Time Out</th>    
                              <th>Status</th>              
                            </thead>
                            <tbody>";

                    $urlid=$_GET['id'];
                    $params = explode("_",$urlid);
                    $id=$params[0];
                    $from=date('Y-m-d',strtotime(explode("-",$params[1])[0]));
                    $to=date('Y-m-d',strtotime(explode("-",$params[1])[1]));

                    $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id Where employees.employee_id='$id' AND attendance.date BETWEEN '$from' AND '$to' ORDER BY attendance.date DESC, attendance.time_in DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $status = ($row['status'])?'<span class="label label-success pull-center">ontime</span>':'<span class="label label-danger pull-center">late</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>                            
                           <td>".date('M d, Y', strtotime($row['date']))."</td>                  
                          <td>".date('h:i A', strtotime($row['time_in']))."</td>
                          <td>".date('h:i A', strtotime($row['time_out']))."</td>
                          <td>".$status."</td>
                          </td>                                                     
                        </tr>
                      ";
                    }
                    echo "</tbody></table>";
                  ?>
              
           
            </div>
          </div>
        </div>
      </div>
        </div>
    </section>  

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
