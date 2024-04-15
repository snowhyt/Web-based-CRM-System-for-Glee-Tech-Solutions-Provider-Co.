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
        Schedule
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-clock-o"></i> Printables</li>
        <li><a href="schedule_employee">Schedule</a></li>
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
            <div class="box-header with-border page-buttons">
              <button class="btn btn-success btn-sm" onclick="javascript:window.print();"><span class="glyphicon glyphicon-print"></span> Print</button>
            </div>
            <div class="box-body">
              <table id="tblSchedulesPrintPreview" class="table table-bordered">
                <thead>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Schedule</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out']))."</td>                        
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
