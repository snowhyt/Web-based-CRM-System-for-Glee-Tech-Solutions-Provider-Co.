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
        Employee List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Manage</a></li>
        <li>Employees</li>
        <li class="active">Employee List</li>
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
               <a href="#addnew" data-toggle="modal" class="btn btn-info"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Photo</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Schedule</th>
                  <th>Hire Date</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT employees.*, employees.id AS empid, schedules.time_in, schedules.time_out, position.description FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN schedules ON schedules.id=employees.schedule_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <!--photo-->
                          <td>
                            <img src="<?php echo (!empty($row['photo']))? '../images/'.$row['photo']:'../images/profile.png'; ?>" width="30px" height="30px"> 
                            <a href="#edit_photo" data-toggle="modal" class="pull-right photo" data-id="<?php echo $row['empid']; ?>">
                              <span class="fa fa-edit"></span>
                            </a>
                          </td>
                          <!--employee id-->
                          <td>
                            <?php echo $row['employee_id']; ?>
                          </td>  
                          <!--employee name-->
                          <td>
                            <?php echo $row['firstname'].' '.$row['lastname']; ?>
                          </td>
                          <!--position-->
                          <td>
                            <?php echo $row['description']; ?>
                          </td>
                          <!--schedule-->
                          <td>
                            <?php 
                              if ($row['time_in']==null) {
                                 echo "no schedule";
                              }
                              else{
                                 echo date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out']));
                              }
                            ?>
                          </td>
                          <!--hire date-->
                          <td>
                            <?php echo date('M d, Y', strtotime($row['created_on'])) ?>
                          </td>
                          <!--active status-->
                          <td>
                            <?php echo ($row['active'])? '<span class="label label-success pull-center">Active</span>':'<span class="label label-danger pull-center">Termed</span>';?>
                          </td>
                          <!--tools (edit, delete)-->   
                          <td>
                            <!--edit-->
                            <button class="btn btn-success btn-sm edit" data-id="<?php echo $row['empid']; ?>">
                              <i class="fa fa-edit"></i> 
                            Edit
                            </button>
                            <!--delete-->
                            <button class="btn btn-danger btn-sm delete" data-id="<?php echo $row['empid']; ?>">
                              <i class="fa fa-trash"></i> 
                            Delete
                            </button>
                          </td>
                        </tr>
                      <?php
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
  <?php include 'includes/employee_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

<script type="text/javascript">
//function to call when edit button has been clicked
$(function(){
  $(document).on('click','.edit',function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

//function to call when delete button has been clicked
  $(document).on('click','.delete',function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

//function to call when edit photo has been clicked
  $(document).on('click','.photo',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

$("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
    $("#success-alert").slideUp(100);
});

$("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
    $("#success-alert").slideUp(100);
});


//ajax call to get employee details
function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.employee_id').html(response.employee_id);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
       $('#edit_email_add').val(response.email_add);
      $('#edit_philhealth').val(response.philhealth);
      $('#edit_sss').val(response.sss);
      $('#edit_pagibig').val(response.pagibig);
      $('#gender_val').val(response.gender).html(response.gender);
      $('#position_val').val(response.position_id).html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
      $('#status_val').val(response.empid).html(response.active==0 ? 'Termed' : 'Active');
      $('#term').val(response.term_date);
      $('#original_hiredate').val(response.created_on);
    }
  });
}
</script>
</body>
</html>
