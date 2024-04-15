<?php 
  include 'session.php'; 
  include 'timezone.php'; 
  include 'header.php';

  $today = date('Y-m-d');
  $year = date('Y');

  $range_to = date('m/t/Y');
  $range_from = date('m/01/Y');

  if(!isset($_SESSION['customer'])){
    header('location:../home');
  }
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php 
    include 'includes/navbar.php'; 
    include 'includes/menubar.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <i class="fa fa-cogs"></i>
       Create Request
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cogs"></i> Request</a></li>
        <li class="active">Create Request</li>
      </ol>
    </section>

    <!-- Main Content -->
    <section class="content">
      <!-- Notifications -->
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
               <a href="#new_request" data-toggle="modal" class="btn btn-info"><i class="fa fa-plus"></i> New</a>
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
                  <input  type="text" class="form-control" placeholder="From Date" id="invoiceFromDate" value="<?php 
                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode('-', $range);
                      $from = date('m/d/Y', strtotime($ex[0]));                                          
                      echo $from;
                    }
                    else{
                      echo $range_from;
                    }
                  ?>">
                  <div class="input-group-addon" >
                    <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>

                <!--to date-->
                <div class="input-group date" data-date-format="mm/dd/yyyy">
                  <input  type="text" class="form-control" placeholder="To Date" id="invoiceToDate" value="<?php 
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
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Request ID</th>
                  <th>Service Type</th>
                  <th>Customer Notes</th>
                  <th>Request Date</th>
                  <th>Request Status</th>
                  <th>Staff Notes</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    //set default date
                    $to =date('Y-m-d');
                    $from=date('Y-m-01');
                    $sql = "";
                    $customer_id = $user['id'];

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode('-', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));

                      $sql = "SELECT requests.request_id, services.service_name, requests.customer_notes, requests.request_date, request_status.request_status, requests.staff_notes FROM requests LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE requests.customer_id=$customer_id AND requests.request_date BETWEEN '$from' AND '$to'";
                    } 
                    else{
                      $sql = "SELECT requests.request_id, services.service_name, requests.customer_notes, requests.request_date, request_status.request_status, requests.staff_notes FROM requests LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE requests.customer_id=$customer_id"; 
                    }
                    
                     
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <!--request id-->
                          <td>
                            <?php echo $row['request_id']; ?>
                          </td>  
                          <!--service name-->
                          <td>
                            <?php echo $row['service_name']; ?>
                          </td>
                          <!--customer notes-->
                          <td>
                            <?php echo $row['customer_notes']; ?>
                          </td>  
                          <!--request date-->
                          <td>
                            <?php echo $row['request_date']; ?>
                          </td> 
                          <!--request status-->
                          <td>
                            <?php echo $row['request_status']; ?>
                          </td>
                          <!--staff notes-->
                          <td>
                            <?php echo $row['staff_notes']; ?>
                          </td>                        
                          <!--update/cancel-->
                          <td>
                           <button class="btn btn-warning btn-sm update" data-id="<?php echo $row['request_id'];?>"
                                  <?php if($row['request_status']=='Cancelled' ||
                                           $row['request_status']=='Closed' ||
                                           $row['request_status']==''){?> disabled <?php } ?>>
                              <i class="fa fa-edit"></i>
                              Edit Note
                            </button>
                            <button class="btn btn-danger btn-sm cancel" data-id="<?php echo $row['request_id'];?>"
                            <?php if($row['request_status']=='Cancelled' || 
                                           $row['request_status']=='In Progress' || 
                                           $row['request_status']=='Closed' ||
                                           $row['request_status']==''){?> disabled <?php } ?>>
                              <i class="fa fa-ban"></i>
                              Cancel
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
  <?php include 'includes/request_modal.php'; ?>
</div>
<?php include 'scripts.php'; ?>

<script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
<script type="text/javascript">
  $(function(){
    $('.update').click(function(e){
      e.preventDefault();
      $('#update_request').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

    $('.cancel').click(function(e){
      e.preventDefault();
      $('#cancel_request').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

    $("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
    });

    $("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
    });

    //function to call when apply button has been clicked
    $('#applyFilter').click(function(){
      var fromDate= document.getElementById('invoiceFromDate').value;
      var toDate = document.getElementById('invoiceToDate').value;
      var range=fromDate+"-"+toDate;
      $('#applyFilter').attr('action', 'home?range='+range);
      $('#applyFilter').submit();
    });

    //date picker function
    $('.input-group.date').datepicker({
      format: "mm/dd/yyyy",
      endDate: "today"+1
    }); 
  });


  
  //ajax call to get employee details
  function getRow(id){
    $.ajax({
      type: 'POST',
      url: 'requests_row.php',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        $('#request_id').val(id);

       let address="";
       if(response.street !=""){
          address=response.street;
       }

       if(response.barangay!=""){
          address = address + "," + response.barangay;
       }

       if(response.city!=""){
          address = address + "," + response.city;
       }

       if(response.province!=""){
          address = address + "," + response.province;
       }

       if(response.region!=""){
          address = address + "," + response.region;
       }

       if(response.postal!=""){
          address = address + "," + response.postal;
       }

        $('#edit_address').val(address);
        $('#edit_service_type').val(response.service_name);
        $('#edit_description').val(response.description);
        $('#edit_notes').val(response.customer_notes);
        $('#cancel_request_id').val(id);
        $('#requestor').val(response.firstname + " " + response.lastname);
        $('#requestor_contact').val(response.contact);
        $('#cancelled_service_type').val(response.service_name);
      }
    });
  }

  var my_handlers = {

    fill_provinces:  function(){

        var region_code = $(this).val();
        $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
        
    },

    fill_cities: function(){

        var province_code = $(this).val();
        $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
    },


    fill_barangays: function(){

        var city_code = $(this).val();
        $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
    }
    };

    $(function(){
    $('#region').on('change', my_handlers.fill_provinces);
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);

    $('#region').ph_locations({'location_type': 'regions'});
    $('#province').ph_locations({'location_type': 'provinces'});
    $('#city').ph_locations({'location_type': 'cities'});
    $('#barangay').ph_locations({'location_type': 'barangays'});

    $('#region').ph_locations('fetch_list');
    });

</script>
</body>
</html>
