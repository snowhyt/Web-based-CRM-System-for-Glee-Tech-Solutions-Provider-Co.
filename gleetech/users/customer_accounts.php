<?php 
    include 'session.php'; 
    include 'header.php';
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
      <i class="fa fa-users"></i>   
       Customer Accounts
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Manage</a></li>
        <li class="active">Customer Accounts</li>
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
                  <th>Customer ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email Address</th>
                  <th>Created On</th>
                  <th>Modified Date</th>
                  <th>Modified By</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT id, username, firstname, lastname, photo, created_on, email_add, active, updated_by, active, date_updated FROM admin WHERE (active=1 AND account_activated=1 AND user_type='Customer' AND banned=0) OR username='bot'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <!--customer id-->
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
                          <!--email address-->
                          <td>
                            <?php echo $row['email_add']; ?>
                          </td> 
                          <!--created on-->
                          <td>
                            <?php echo date('Y-m-d',strtotime($row['created_on'])); ?>
                          </td>
                          <!--modified date-->
                          <td>
                            <?php echo date('Y-m-d',strtotime($row['date_updated'])); ?>
                          </td>
                          <!--modified by-->
                          <td>
                            <?php
                             $id=$row['updated_by'];
                             $usql = "SELECT username FROM admin WHERE id=$id";
                             $uquery = $conn->query($usql);
                             $urow = $uquery->fetch_assoc();
                             echo $urow==null? "secret" : $urow['username']; 
                             ?>
                          </td>
                          <!--edit-->
                          <td>
                            <button class="btn btn-danger btn-sm edit" data-id="<?php echo $row['id']; ?>">
                                <i class='fa fa-ban'></i>
                                Ban Account
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
    $('#ban_customer_account').modal('show');
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
      $('#edit_customer_id').val(id);
      $('#edit_customer_name').val(response.firstname + " " + response.lastname);
      $('#edit_customer_username').val(response.username);
      $('#edit_customer_email_add').val(response.email_add);
    }
  });
}
</script>
</body>
</html>
