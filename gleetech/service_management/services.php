<?php include 'session.php'; ?>
<?php include 'header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-cogs"></i>
        Services
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cogs"></i> Manage</a></li>
        <li class="active">Services</li>
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
                  <th>Service Name</th>
                  <th>Description</th>
                  <th>Date Updated</th>
                  <th>Updated By</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
               <tbody>
                 <?php
                  $sql = "SELECT services.*, services.active as status, admin.firstname, admin.lastname FROM services LEFT JOIN admin on services.added_by=admin.id ORDER BY services.date_added";

                    $query = $conn->query($sql);
                    while ($row=$query->fetch_assoc()) {
                      ?>
                      <tr>                         
                          <!--service name-->
                          <td>
                            <?php echo $row['service_name']; ?>
                          </td>
                          <!--description-->
                          <td>
                            <?php echo $row['description']; ?>
                          </td>
                          <!--date updated-->
                          <td>
                            <?php echo $row['date_added']; ?>
                          </td>
                          <!--responsible-->
                          <td>
                           <?php echo $row['firstname']." ".$row['lastname']; ?>
                          </td>
                          <!--status-->
                          <td>
                            <?php echo ($row['status'])? '<span class="label label-success pull-center">Active</span>':'<span class="label label-danger pull-center">Inactive</span>';?>
                          </td>
                          <!--tools (edit, delete)-->   
                          <td style="width:70px;">
                            <!--edit-->
                            <button class="btn btn-success btn-sm edit" data-id="<?php echo $row['service_id']; ?>">
                              <i class="fa fa-edit"></i> 
                            </button>
                            <!--delete-->
                            <button class="btn btn-danger btn-sm delete" data-id="<?php echo $row['service_id']; ?>">
                              <i class="fa fa-trash"></i> 
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
  <?php include 'includes/services_modal.php'; ?>
</div>
<?php include 'scripts.php'; ?>

<script type="text/javascript">
//call this when edit button has been clicked
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

    $('#edit').on('hidden.bs.modal', function (e) {
  e.preventDefault();
  location.reload();
  });

  //call this when delete button has been clicked
  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });

  $("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });


//ajax call to pass details in the modal dialog
  function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'services_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#edit_service_id').val(response.service_id); 
      $('#edit_service_name').val(response.service_name);
      $('#edit_service_description').html(response.description);
      $('#status_val').html(response.active==0 ? 'Inactive' : 'Active');
      $('#del_service_id').val(response.service_id);
      $('#del_service_name').html(response.service_name);
    }
  });
}

</script>
</body>
</html>

