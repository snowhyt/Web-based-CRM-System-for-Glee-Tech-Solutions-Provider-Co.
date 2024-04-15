<?php 
    include 'session.php'; 
    include 'header.php';
    include 'timezone.php'; 

    $today = date('Y-m-d');
    $year = date('Y');
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
        <i class="fa fa-files-o"></i>
        My Invoices
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Requests</a></li>
        <li class="active">My Invoices</li>
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
                  <th>Invoice No</th>
                  <th>Customer Name</th>
                  <th>Service Type</th>
                  <th>Service Amount</th>
                  <th>Payment Status</th>
                  <th>Issued By</th>
                  <th>Issued Date</th>
                  <th>Tools</th>
                </thead>
               <tbody>
                 <?php
                    //set default date
                    $to =date('Y-m-d');
                    $from=date('Y-m-01');

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode('-', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }
                    
                    $customer_id = $user['id'];

                    $sql = "SELECT requests.request_id, invoice.invoice_id, invoice.service_amount,  CONCAT(admin.firstname,' ',admin.lastname) 'customer_name', services.service_name, requests.paid, (SELECT CONCAT(firstname,' ',lastname) FROM admin WHERE id=invoice.issued_by) 'issued_by', invoice.issued_date FROM invoice LEFT JOIN admin ON invoice.customer_id=admin.id LEFT JOIN requests ON invoice.request_id=requests.request_id LEFT JOIN services ON requests.service_id=services.service_id WHERE invoice.customer_id='$customer_id' AND invoice.issued_date BETWEEN '$from' AND '$to'";

                    $query = $conn->query($sql);
                    while ($row=$query->fetch_assoc()) {
                  ?>
                      <tr>  
                          <!--request id-->
                          <td>
                            <?php echo $row['request_id']; ?>
                          </td>

                          <!--invoice no-->
                          <td>
                            <?php echo $row['invoice_id']; ?>
                          </td>

                           <!--customer name-->
                          <td>
                            <?php echo $row['customer_name']; ?>
                           </td>

                          <!--service name-->
                          <td>
                            <?php echo $row['service_name']; ?>
                          </td>

                           <!--service amount-->
                           <td>
                            <?php echo bcadd($row['service_amount'],'0',2); ?>
                          </td>

                          <!--payment status-->
                          <td>
                           <?php echo $row['paid']=='0'?"Unpaid":"Paid"; ?>
                          </td>
                         
                          <!--issued by-->
                          <td>
                            <?php echo $row['issued_by'];?>
                          </td>

                          <!--issued date-->
                          <td>
                            <?php echo $row['issued_date'];?>
                          </td>
                    
                          <!--tools-->   
                          <td>
                           <button class="btn btn-info btn-sm print" name="<?php echo $row['request_id'];?>" data-id="<?php echo $row['invoice_id'];?>">
                              <i class="fa fa-print"></i>
                              Print
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
  
</div>
<?php include 'scripts.php'; ?>
<script type="text/javascript">
  //call this when edit button has been clicked
  $('.print').click(function(e){
      e.preventDefault();
      var id = $(this).data('id');
      var request_id = $(this).attr('name');
      var params = id + "-" + request_id;
      window.open("generated_invoice?id="+ params, "_blank");
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
    $('#applyFilter').attr('action', 'invoice?range='+range);
    $('#applyFilter').submit();
  });

  //date picker function
  $('.input-group.date').datepicker({
    format: "mm/dd/yyyy",
    endDate: "today"+1
  }); 
</script>
</body>
</html>
