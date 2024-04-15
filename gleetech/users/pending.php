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
      <i class="fa fa-clock-o"></i>
       Pending Accounts
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-clock-o"></i> Manage</a></li>
        <li class="active">Pending Accounts</li>
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
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Access Type</th>
                  <th>Email Address</th>
                  <th>Provisioned By</th>
                  <th>Provisioned On</th>
                  <th>Token Valid Until</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT id, username, firstname, lastname, created_on, user_type, active, updated_by, email_add, employee_id, valid_until FROM admin WHERE account_activated=0 AND username!='bot'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <!--id-->
                          <td>
                            <?php echo $row['id']; ?>
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
                          <!--email address-->
                          <td>
                            <?php echo $row['email_add']; ?>
                          </td>
                          <!--provisioned by-->
                          <td>
                            <?php
                             $id=$row['updated_by'];
                             $usql = "SELECT username FROM admin WHERE id=$id";
                             $uquery = $conn->query($usql);
                             $urow = $uquery->fetch_assoc();
                             echo $urow==null? "secret" : $urow['username']; 
                             ?>
                          </td>
                          <!--provisioned on-->
                          <td>
                            <?php echo date('Y-m-d',strtotime($row['created_on'])); ?>
                          </td>
                           <!--token valid until-->
                          <td>
                            <?php echo $row['valid_until']; ?>
                          </td>
                          <!--edit-->
                          <td>  
                           <button class="btn btn-warning btn-sm edit" data-id="<?php echo $row['id'];?>">
                              <i class="fa fa-envelope-o"></i>
                              Send New Activation Link
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
  <?php include 'footer.php'; ?>
  <?php include 'admin_staff_modal.php'; ?>
</div>
<?php include 'scripts.php'; ?>
<script type="text/javascript">
$(function(){
   $('.edit').click(function(e){
    e.preventDefault();
    $('#generate').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#success-alert").fadeTo(5000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });

  $("#error-alert").fadeTo(5000, 500).slideUp(100, function(){
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
     $('#email_add_generate').val(response.email_add);
     $('#employee_name_generate').html(response.firstname + " " + response.lastname);
    }
  });
}
</script>
</body>
</html>
