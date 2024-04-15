<?php include 'includes/session.php'; ?>
<!--call this to get asia/pacific time zone and set default From and To dates-->
<?php
 include '../timezone.php';
  $range_to = date('m/t/Y');
  $range_from = date('m/01/Y');
?>
<!--call this to include header-->
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 
  <!--call this to call navigation (top) and menu (left) bars-->
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="#">
            <i class="fa fa-calendar"></i> 
          Manage
        </a>
      </li>
        <li class="active">Attendance</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!--check if still connected on the session, thrown an error if not-->
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
              <!--new button-->
              <a href="#addnew" data-toggle="modal" class="btn btn-info">
                <i class="fa fa-plus"></i> 
              New
              </a>  

             <!--apply date filter-->    
              <div class="pull-right form-inline">
                <form method="POST" class="form-inline" id="applyFilter">
                  <span>&nbsp</span>
                  <button type="button" class="btn btn-info">Apply</button>           
                </form>              
              </div>
              <div class="pull-right form-inline">
                 <!--from date-->
                  <div class="input-group date" data-date-format="mm/dd/yyyy">
                    <input  type="text" class="form-control" placeholder="From Date" id="attendanceFromDate" 
                    value="<?php 
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
                    <input  type="text" class="form-control" placeholder="To Date" id="attendanceToDate" value="<?php 
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
            <!--attendance table-->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Date</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    //set default date
                    $to =date('Y-m-d');
                    $from=date('Y-m-01');

                    //check if header url has date range
                    //if yes, split the date to get From and To dates
                   if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode('-', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                      $stat=-1;
                    }
                    elseif(isset($_GET['stat'])){
                      $stat= $_GET['stat'];                        
                    }
                    
                    if($stat>=0){
                        $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.date='$to' AND attendance.status=$stat ORDER BY attendance.date DESC, attendance.time_in DESC";
                    }
                    else{
                        $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.date BETWEEN '$from' AND '$to' ORDER BY attendance.date DESC, attendance.time_in DESC";
                    }
                    
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $time_out = $row['time_out']=="00:00:00" ? "00:00:00": date('h:i A', strtotime($row['time_out']));

                      $status = ($row['status'])?'<span class="label label-success pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      echo "
                        <tr>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
                          <td>".$time_out."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit' data-id='".$row['attid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete' data-id='".$row['attid']."'><i class='fa fa-trash'></i> Delete</button>
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
    
  <!--call footer and attendance modal file-->
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/attendance_modal.php'; ?>
</div>

<!--call this to include browser components-->
<?php include 'includes/scripts.php'; ?>

<script type="text/javascript">

//function to call when edit button has been clicked  
$('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

//function to call when delete button has been clicked
  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  
//function to call when apply button has been clicked
$('#applyFilter').click(function(){
    var fromDate= document.getElementById('attendanceFromDate').value;
    var toDate = document.getElementById('attendanceToDate').value;
    var range=fromDate+"-"+toDate;
    $('#applyFilter').attr('action', 'attendance.php?range='+range);
    $('#applyFilter').submit();
  });

//function to call to set date format and disable the future dates
$('.input-group.date').datepicker({
  format: "mm/dd/yyyy",
  endDate: "today"+1
}); 

$("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
    $("#success-alert").slideUp(100);
});

$("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
    $("#success-alert").slideUp(100);
});


//ajax call to get attendance and employee details
function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
