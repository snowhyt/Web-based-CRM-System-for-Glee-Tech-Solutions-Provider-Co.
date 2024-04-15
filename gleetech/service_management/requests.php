<?php 
  include 'session.php'; 
  include 'header.php';
  include 'functions.php';
  include 'timezone.php';
  $range_to = date('m/t/Y');
  $range_from = date('m/01/Y');
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-wrench"></i>
        Service Requests
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-wrench"></i> Services</a></li>
        <li class="active">Service Requests</li>
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
              <!--add new request-->        
              <a href="#add_request" data-toggle="modal" class="btn btn-info"><i class="fa fa-plus"></i> New</a>               
                  
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
                  <input  type="text" class="form-control" placeholder="From Date" id="requestFromDate" value="<?php 
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
                  <input  type="text" class="form-control" placeholder="To Date" id="requestToDate" value="<?php 
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
                  <th>Request Type</th>
                  <th>Customer ID</th>
                  <th>Customer Name</th>
                  <th>Request Date</th>
                  <th>Request Status</th>
                  <th>Modified By</th>
                  <th>Last Modified</th>
                  <th>Tools</th>
                </thead>
               <tbody>
              <?php
                 //set default date
                 $to =date('Y-m-d');
                 $from=date('Y-m-01');

                 $sql="";

                 if(isset($_GET['range'])){
                    $range = $_GET['range'];
                    $ex = explode('-', $range);
                    $from = date('Y-m-d', strtotime($ex[0]));
                    $to = date('Y-m-d', strtotime($ex[1]));
                    $sql= "SELECT requests.request_id, requests.customer_id, services.service_name, admin.firstname, admin.lastname, requests.request_date, requests.customer_notes, request_status.request_status, (SELECT username FROM admin WHERE id=requests.modified_by) AS 'username', requests.modified_date, requests.staff_notes FROM requests LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN admin ON requests.customer_id=admin.id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE requests.request_date BETWEEN '$from' AND '$to'";
                 }else{
                 
                  if(isset($_GET['status'])){
                      $status = $_GET['status'];
                      
                      if($status=="all"){
                        $sql = "SELECT requests.request_id, requests.customer_id, services.service_name, admin.firstname, admin.lastname, requests.request_date, requests.customer_notes, request_status.request_status, (SELECT username FROM admin WHERE id=requests.modified_by) AS 'username', requests.modified_date, requests.staff_notes FROM requests LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN admin ON requests.customer_id=admin.id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE requests.request_date BETWEEN '$from' AND '$to'";
                      }else if($status=="unpaid"){
                        $sql = "SELECT requests.request_id, requests.customer_id, services.service_name, admin.firstname, admin.lastname, requests.request_date, requests.customer_notes, request_status.request_status, (SELECT username FROM admin WHERE id=requests.modified_by) AS 'username', requests.modified_date, requests.staff_notes FROM requests LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN admin ON requests.customer_id=admin.id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE requests.request_date BETWEEN '$from' AND '$to' AND requests.request_status_id!=3 AND requests.request_status_id!=7";  
                      }else{
                        $sql = "SELECT requests.request_id, requests.customer_id, services.service_name, admin.firstname, admin.lastname, requests.request_date, requests.customer_notes, request_status.request_status, (SELECT username FROM admin WHERE id=requests.modified_by) AS 'username', requests.modified_date, requests.staff_notes FROM requests LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN admin ON requests.customer_id=admin.id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE requests.request_date BETWEEN '$from' AND '$to' AND requests.request_status_id=$status";  
                      }
                  }
                  else{
                      $sql= "SELECT requests.request_id, requests.customer_id, services.service_name, admin.firstname, admin.lastname, requests.request_date, requests.customer_notes, request_status.request_status, (SELECT username FROM admin WHERE id=requests.modified_by) AS 'username', requests.modified_date, requests.staff_notes FROM requests LEFT JOIN services ON requests.service_id=services.service_id LEFT JOIN admin ON requests.customer_id=admin.id LEFT JOIN request_status ON requests.request_status_id=request_status.request_status_id WHERE requests.request_date BETWEEN '$from' AND '$to' OR (requests.request_status_id!=7 AND requests.request_status_id!=3)";
                  }
                } 
                  
                  $query = $conn->query($sql);
                  while ($row=$query->fetch_assoc()) {
                  ?>
                      <tr>                         
                          <!--request id-->
                          <td>
                            <?php echo $row['request_id']; ?>
                          </td>

                           <!--service type-->
                           <td>
                            <?php echo $row['service_name']; ?>
                          </td>

                          <!--customer id-->
                          <td>
                            <?php echo $row['customer_id']; ?>
                          </td>

                          <!--customer name-->
                          <td>
                           <?php echo $row['firstname']." ".$row['lastname']; ?>
                          </td>
                         
                          <!--request date-->
                          <td>
                            <?php echo $row['request_date'];?>
                          </td>

                          <!--request status-->
                          <td>
                            <?php echo $row['request_status'];?>
                          </td>

                          <!--modified by-->
                          <td>
                            <?php echo $row['username'];?>
                          </td>

                          <!--last modified-->
                          <td>
                            <?php echo $row['modified_date'];?>
                          </td>

                          <!--view-->   
                          <td>
                           <button class="btn btn-warning btn-sm update" data-id="<?php echo $row['request_id'];?>" >
                              <i class="fa fa-edit"></i>
                              Update
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
  <?php include 'includes/requests_modal.php'; ?>
</div>
<?php include 'scripts.php'; ?>

<script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
<script type="text/javascript">

  //function to call when apply button has been clicked
  $('#applyFilter').click(function(){
    var fromDate= document.getElementById('requestFromDate').value;
    var toDate = document.getElementById('requestToDate').value;
    var range=fromDate+"-"+toDate;
    $('#applyFilter').attr('action', 'requests?range='+range);
    $('#applyFilter').submit();
  });

  //date picker function
  $('.input-group.date').datepicker({
    format: "mm/dd/yyyy",
    endDate: "today"+1
  }); 

  //call this when edit button has been clicked
  $('.update').click(function(e){
      e.preventDefault();
      $('#view_request').modal('show');
      var id = $(this).data('id');
        getRow(id);
  });

  $("#success-alert").fadeTo(5000, 500).slideUp(1000, function(){
      $("#success-alert").slideUp(1000);
  });

  $("#error-alert").fadeTo(5000, 500).slideUp(1000, function(){
      $("#success-alert").slideUp(1000);
  });

  //ajax call to pass details in the modal dialog
  function getRow(id){
    $.ajax({
      type: 'POST',
      url: 'requests_row.php',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        $('#request_id').val(id); 
        $('#service_type').val(response.service_name);
        $('#description').val(response.description);
        $('#notes').val(response.customer_notes);
        $('#customer_name').val(response.firstname + " " + response.lastname);
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

        $('#address').val(address); 
        $('#customer_contact').val(response.contact);
        $('#email').val(response.email_add);
        $('#staff_notes').val(response.staff_notes);
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

