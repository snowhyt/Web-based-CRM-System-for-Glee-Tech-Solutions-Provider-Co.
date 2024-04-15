<?php include 'session.php'; ?>
<?php include 'header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'navbar.php'; ?>
  <?php include 'menubar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <i class="fa fa-desktop"></i>
       System Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-desktop"></i> Manage</a></li>
        <li class="active">System Users</li>
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
               <a href="#add" data-toggle="modal" class="btn btn-info"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Photo</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Access Type</th>
                  <th>Updated By</th>
                  <th>Created On</th>
                  <th>Date Updated</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    
                    if(isset($_GET['id'])){    
                      $id = $_GET['id'];
                      $sql = "SELECT id, username, firstname, lastname, photo, created_on, user_type, active, updated_by, active, employee_id, date_updated FROM admin WHERE account_activated=1 AND user_type!='Customer' AND active=$id";
                    }
                    else if(isset($_GET['type'])){
                      $type=$_GET['type'];
                      $sql = "SELECT id, username, firstname, lastname, photo, created_on, user_type, active, updated_by, active, employee_id, date_updated FROM admin WHERE account_activated=1 AND user_type='$type'";

                    }else{
                      $sql = "SELECT id, username, firstname, lastname, photo, created_on, user_type, active, updated_by, active, employee_id, date_updated FROM admin WHERE account_activated=1 AND user_type!='Customer'";
                    }
                    
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <!--photo-->
                          <td>
                            <img src="<?php echo (!empty($row['photo']))? '../payroll/images/'.$row['photo']:'../payroll/images/profile.png'; ?>" width="30px" height="30px"> 
                            <a href="#edit_photo" data-toggle="modal" class="pull-right photo" data-id="<?php echo $row['id']; ?>">
                              <span class="fa fa-edit"></span>
                            </a>
                          </td>
                          <!--employee id-->
                          <td>
                            <?php echo $row['employee_id']; ?>
                          </td>  
                          <!--name-->
                          <td>
                            <?php echo $row['firstname'].' '.$row['lastname']; ?>
                          </td>
                          <!--username-->
                          <td>
                            <?php echo $row['username']; ?>
                          </td>  
                          <!--access type-->
                          <td>
                            <?php echo $row['user_type']; ?>
                        </td> 
                          <!--updated by-->
                          <td>
                            <?php
                             $id=$row['updated_by'];
                             $usql = "SELECT username FROM admin WHERE id=$id";
                             $uquery = $conn->query($usql);
                             $urow = $uquery->fetch_assoc();
                             echo $urow==null? "secret" : $urow['username']; 
                             ?>
                          </td>
                          <!--updated by-->
                          <td>
                            <?php echo date('Y-m-d',strtotime($row['created_on'])); ?>
                          </td>
                          <!--date updated-->
                          <td>
                            <?php echo date('Y-m-d',strtotime($row['date_updated'])); ?>
                          </td>
                          <!--status-->
                          <td>
                            <?php echo $row['active'] ? "Active" : "Inactive";?>
                          </td>
                          <!--edit-->
                          <td>
                           <?php
                            $user_id = $row['id'];
                            if($row['active']){
                                echo "<button class='btn btn-success btn-sm edit' data-id='$user_id'>
                                        <i class='fa fa-edit'></i>
                                        Update &nbsp&nbsp
                                      </button>";
                            }else{
                                echo "<button class='btn btn-warning btn-sm reinstate' data-id='$user_id'>
                                        <i class='fa fa-undo'></i>
                                        Reisntate
                                      </button>"; 
                            }
                           ?>
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
  <?php include 'footer.php'; ?>
  <?php include 'admin_staff_modal.php'; ?>
</div>
<?php include 'scripts.php'; ?>
<script type="text/javascript">
$(function(){
   $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.reinstate').click(function(e){
    e.preventDefault();
    $('#reinstate').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  //function to call when edit photo has been clicked
  $(document).on('click','.photo',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });

  $("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });
  
});

  
//ajax call to get employee details
function getRow(id){
   $.ajax({
    type: 'POST',
    url: 'admin_staff_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#edit_employee_name').val(response.firstname + " " + response.lastname);
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_username').val(response.username);
      $('#edit_email_add').val(response.email_add);
      $('#selected_user_type').html(response.user_type);
      $('#selected_status').html(response.active==0 ? 'Inactive' : 'Active');
      $('.employee_name_photo').html(response.firstname + " " + response.lastname);
      $('#employee_id_photo').val(response.employee_id);     
      $('#employee_name_reinstate').html(response.firstname + " " + response.lastname);     
      $('#employee_id_reinstate').val(response.employee_id);    
    }
  });
}
</script>
</body>
</html>
