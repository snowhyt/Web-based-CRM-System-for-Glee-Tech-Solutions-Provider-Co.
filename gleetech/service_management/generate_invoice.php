<?php include 'session.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions.php';?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          <i class="fa fa-files-o"></i>
          Generate Invoice
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-files-o"></i> Invoices</a></li>
          <li class="active">Generate Invoice</li>
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
      <form method="POST" action="save_invoice.php">       
       <div class="row"> 
            <!--customer details-->
            <div class="col-xs-12">           
              <div class="box" style="display:inline-block">               
                <br/>              
                <div class="col-sm-4 pull-right" style="margin-top: -12px; margin-right:-5px;">
                  <div class="form-group  no-margin-bottom">
                    <div class="col-sm-12 input-group input-group-sm">
                      <span class="input-group-addon" style="background-color:whitesmoke;">Customer</i></span>
                      <select class="form-control" name="existing_customer" id="existing_customer">
                        <option value="" selected>Select from exisiting requests</option>
                        <?php getCustomerListWithRequest();?>
                      </select>
                    </div>
                    <input type="text" name="existing_customer_id" id="existing_customer_id" hidden>
                  </div>
                </div>
                <div class="col-sm-4" style="margin-top: -12px; margin-left:-5px;">
                  <div class="form-group  no-margin-bottom">
                    <div class="col-sm-8 input-group input-group-sm">
                      <span class="input-group-addon" style="background-color:whitesmoke;">Request ID</span>
                        <input type="text" class="form-control" id="customer_request_id" name="customer_request_id" readonly>
                    </div>
                  </div>
                </div>
                <br/>     
                <div class="box-body">                  
                  <div class="pane panel-default">
                    <div class="panel-heading">
                      <h4 class="float-left">Customer Details</h4>
                    </div>
                  </div>
                  <div class="panel-body form-group form-group-sm" style="border:1px solid whitesmoke;">                   
                    <div class="row">
                      <!--personal information-->
                      <div class="col-xs-4">
                        <!--firstname-->
                        <div class="form-group">
                          <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                   class="form-control margin-bottom" 
                                   name="customer_firstname" 
                                   id="customer_firstname" 
                                   placeholder="Firstame" 
                                   required>
                          </div>
                        </div>
                        
                        <!--lastname-->
                        <div class="form-group">
                          <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                    class="form-control margin-bottom" 
                                    name="customer_lastname" 
                                    id="customer_lastname" 
                                    placeholder="Lastname" 
                                    required>	
                          </div>
                        </div>

                        <!--phone number-->
                        <div class="form-group">
                          <label for="phone number" class="col-sm-3 control-label">Contact</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                    class="form-control margin-bottom"
                                    name="customer_contact" 
                                    id="customer_contact" 
                                    placeholder="Phone Number"
                                    required>		
                          </div>
                        </div>

                        <!--email address-->
                        <div class="form-group">
                          <label for="email address" class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" 
                                    class="form-control" 
                                    name="customer_email" 
                                    id="customer_email" 
                                    placeholder="E-mail Address" 
                                    required>
                          </div>
                        </div>
                      </div>

                      <!--address details-->
                      <div class="col-xs-4">
                        <!--region-->
                        <div class="form-group">
                          <label for="region" class="col-sm-3 control-label">Region</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                    class="form-control margin-bottom" 
                                    name="region" 
                                    id="region" 
                                    placeholder="Region"
                                    required>		
                          </div>
                        </div>

                        <!--province-->
                        <div class="form-group">
                          <label for="province" class="col-sm-3 control-label">Province</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                    class="form-control margin-bottom" 
                                    name="province" 
                                    id="province"
                                    placeholder="Province" 
                                    required>		
                          </div>
                        </div>

                        <!--city-->
                        <div class="form-group">
                          <label for="City" class="col-sm-3 control-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                    class="form-control margin-bottom" 
                                    name="city" 
                                    id="city" 
                                    placeholder="City"
                                    required>		
                          </div>
                        </div>

                        <!--barangay-->
                        <div class="form-group">
                          <label for="barangay" class="col-sm-3 control-label">Barangay</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                    class="form-control" 
                                    name="barangay" 
                                    id="barangay"
                                    placeholder="Barangay"
                                    required> 		
                          </div>
                        </div>
                      </div>
                       
                      <div class="col-xs-4">
                         <!--street--> 
                         <div class="form-group">
                          <label for="street" class="col-sm-3 control-label">Street</label>
                          <div class="col-sm-9">
                            <textarea class="form-control margin-bottom comment" 
                                      name="street" 
                                      id="street" 
                                      placeholder="House No./Street" 
                                      required></textarea>
                          </div>
                        </div>

                        <!--postal-->
                        <div class="form-group">
                          <label for="postal" class="col-sm-3 control-label">Postal</label>
                          <div class="col-sm-9">
                            <input type="text" 
                                    class="form-control" 
                                    name="postal" 
                                    id="postal" 
                                    placeholder="Postal Code" 
                                    required>		
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div> 
              </div>
            </div>   
              
            <!--service info-->
            <div class="col-xs-12">
              <div class="box" style="display:inline-block">
                <div class="box-body">
                  <div class="m-3">
                    <table id="add_table" class="table" data-toggle="table" data-mobile-responsive="true">               
                      <thead>
                        <tr>
                          <th>Service Type</th>
                          <!--<th></th>-->
                          <th>Service Amount</th>
                          <th>Discount</th>
                          <th>Tax Rate</th>
                          <!--<th>
                            <button class="btn btn-success add" id="add_row">
                            <i class="fa fa-plus"></i> 
                            </button>
                          </th>-->
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <!--service type-->
                          <td>
                            <div class="input-group input-group-sm no-margin-bottom col-sm-12">
                              <input type="text" class="form-control margin-bottom" name="myServiceType" id="myServiceType" readonly>		
                            </div>
                          </td>
                          
                          <!--search service type-->
                          <!--<td>
                            <div class="input-group input-group-sm no-margin-bottom">
                              <a href="#" id="search_service">
                                <i class="fa fa-search"></i> 
                              </a>
                              </button>         
                            </div>
                          </td>-->

                          <!--amount-->
                          <td>
                            <div class="input-group input-group-sm  no-margin-bottom">
                              <span class="input-group-addon">&#8369;</span>
                              <input type="number" class="form-control"  aria-describedby="sizing-addon1" placeholder="0.00" name="service_amount" id="service_amount" onchange="computeTotal(this.value);" required>
                          </td>

                          <!--discount-->
                          <td>
                            <div class="input-group input-group-sm no-margin-bottom">
                                <span class="input-group-addon">&#8369;</span>
                                <input type="number" class="form-control"  aria-describedby="sizing-addon1" placeholder="0.00" value="0.00" name="service_discount" id="service_discount" onchange="applyDiscount();" required>
                              </div>
                          </td>

                          <!--tax rate-->
                          <td>
                            <div class="input-group input-group-sm col-xs-12  no-margin-bottom">
                              <select class="form-control" name="tax_rate" id="tax_rate" onchange="applyTax(this.value);">
                                <option selected value="0">0%</option>
                                <option value="1">1%</option>
                                <option value="2">2%</option>
                                <option value="3">3%</option>
                                <option value="4">4%</option>
                                <option value="5">5%</option>
                                <option value="6">6%</option>
                                <option value="7">7%</option>
                                <option value="8">8%</option>
                                <option value="9">9%</option>
                                <option value="10">10%</option>
                                <option value="11">11%</option>
                                <option value="12">12%</option>   
                              </select>    
                            </div>
                          </td>
                          
                          <!--delete row-->
                          <!--<td>
                            <button class="btn btn-danger delete_row">
                            <i class="fa fa-trash"></i> 
                            </button>
                          </td>-->
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!--notes-->
            <div class="col-xs-8">
              <div class="box" style="display:inline-block">
                <div class="box-body">
                
                  <!--customer notes-->
                  <div class="col-sm-12">
                    <label for="customer notes">Customer Notes</label>
                    <textarea class="form-control comment" 
                              name="customer_notes" 
                              id="customer_notes" 
                              readonly> </textarea>
                    <br/>
                  </div>
                    
                  <!--service details-->
                  <div class="col-sm-12">
                    <label for="service details">Service Details</label>
                    <textarea class="form-control comment" 
                              name="service_details" 
                              id="service_details" 
                              rows="5" 
                              placeholder="Details of the service rendered (e.g. materials used on the service, etc.)" 
                              required></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!--totals breakdown-->
            <div class="col-xs-4">
              <div class="box" style="display:inline-block">
                <div class="box-body">                  
                  <!--sub total-->
                  <div class="form-group  margin-bottom" style="margin-right:10px;">
                    <label for="sub total" class="col-sm-4 control-label">Sub Total:</label>
                    <div class="col-sm-8 input-group input-group-sm">
                      <span class="input-group-addon">&#8369;</span>
                      <input type="number" 
                              class="form-control" 
                              id="subtotal" 
                              name="subtotal" 
                              value="0.00"
                              placeholder="0.00" 
                              readonly required>
                    </div>
                  </div>

                  <!--discount-->
                  <div class="form-group  no-margin-bottom" style="margin-right:10px;">
                    <label for="discount" class="col-sm-4 control-label">Discount:</label>
                    <div class="col-sm-8 input-group input-group-sm">
                      <span class="input-group-addon">&#8369;</span>
                      <input type="number" 
                              class="form-control" id="discount" 
                              name="discount" 
                              value="0.00"
                              placeholder="0.00" 
                              readonly>
                    </div>
                  </div>

                
                  <!--tax-->
                  <div class="form-group  no-margin-bottom" style="margin-right:10px;">
                    <label for="tax" class="col-sm-4 control-label">Tax</label>
                    <div class="col-sm-8 input-group input-group-sm">
                      <span class="input-group-addon">&#8369;</span>
                      <input type="number" 
                              class="form-control" 
                              id="tax" name="tax" 
                              placeholder="0.00" 
                              value="0.00"
                              readonly>
                    </div>
                  </div>

                   <!--total-->
                   <div class="form-group  no-margin-bottom" style="margin-right:10px;">
                    <label for="total" class="col-sm-4 control-label">Total:</label>
                    <div class="col-sm-8 input-group input-group-sm">
                      <span class="input-group-addon">&#8369;</span>
                      <input type="number" 
                              class="form-control" 
                              id="total"
                              name="total" 
                              value="0.00"
                              placeholder="0.00" 
                              readonly>
                    </div>
                  </div>

                  <!--submit-->
                  <div class="form-group  no-margin-bottom pull-right" style="margin-right:10px;">
                    <div class="col-sm-8 input-group input-group-sm">
                      <button type="submit" class="btn btn-success" name="create">Create Invoice</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
        </div>
      </form>
    </section>
  </div>
<?php include 'includes/footer.php'; ?> 
<?php include 'scripts.php'; ?>
</div>
<script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
<script type="text/javascript">


//functions for computations
function computeTotal(myTotal){
  $('#total').val(Number(myTotal).toFixed(2));
  $('#subtotal').val(Number(myTotal).toFixed(2));
  $('#service_amount').val(Number(myTotal).toFixed(2));

  applyDiscount();
}

//function for apply discounts
function applyDiscount(){
  if(Number(service_discount.value)>Number(service_amount.value)){
    alert("Discount cannot be greater than service amount.");
    return;
  }

  $('#service_discount').val(Number(service_discount.value).toFixed(2));
  $('#discount').val(Number(service_discount.value).toFixed(2));
  $('#total').val((Number(service_amount.value)  - Number(service_discount.value)).toFixed(2));

}

$("#success-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
  });

  $("#error-alert").fadeTo(3000, 500).slideUp(100, function(){
      $("#success-alert").slideUp(100);
});

//function when paying cash
function applyTax(myTaxRate){
   let rate =Number(myTaxRate)/100;
   let amount = Number(service_amount.value);
   document.getElementById("tax").value=rate*amount
}

//function for adding and deleting rows, searching service type
/*$(document).ready(function(e) {

                $('#add_row').click(function() {
                  //Add row
                  row = '';
                  row += '<tr>';
                  
                  //service type
                  row += '<td>';
                  row += '<div class="input-group input-group-sm  no-margin-bottom col-xs-12">';
                  row += '<input type="text" class="form-control">';
                  row += '</div>';
                  row += '</td>';

                  //search service type-->
                  row += '<td>';
                  row += '<div class="input-group input-group-sm no-margin-bottom">';
                  row += '<a href="#">';
                  row += '<i class="fa fa-search"></i>';
                  row += '</a>';
                  row += '</button>';
                  row += '</div>';
                  row += '</td>';

                  //amount-->
                  row += '<td>';
                  row += '<div class="input-group input-group-sm  no-margin-bottom">';
                  row += '<span class="input-group-addon">&#8369;</span>';
                  row += '<input type="number" class="form-control"  aria-describedby="sizing-addon1" placeholder="0.00">';
                  row += '</div>';
                  row += '</td>';

                  //discount-->
                  row += '<td>';
                  row += '<div class="input-group input-group-sm  no-margin-bottom">';
                  row += '<span class="input-group-addon">&#8369;</span>';
                  row += '<input type="number" class="form-control"  aria-describedby="sizing-addon1" placeholder="0.00">';
                  row += '</div>';
                  row += '</td>';

                  //sub total-->
                  row += '<td>';
                  row += '<div class="input-group input-group-sm  no-margin-bottom">';
                  row += '<span class="input-group-addon">&#8369;</span>';
                  row += '<input type="number" class="form-control" name="invoice_product_price[]" aria-describedby="sizing-addon1" placeholder="0.00">';
                  row += '</div>';
                  row += '</td>';
                        
                  //delete row-->
                  row += '<td>';
                  row += '<button class="btn btn-danger delete_row">';
                  row += '<i class="fa fa-trash"></i>';
                  row += '</button>';
                  row += '</td>';

                  row += '</tr>';
                  $("tbody").append(row);
                })

                $("#add_table").on('click', '.delete_row', function() {
                  $(this).closest('tr').remove();
                });
});
*/

//function when customer has been selected
let customer_list =  document.getElementById("existing_customer");
customer_list.onchange = (ev)=>{
  let request_id = customer_list.value;
  getCustomerDetails(request_id);
}

//ajax function to get the customer details
function getCustomerDetails(id){
  $.ajax({
    type: 'POST',
    url: 'customer_details.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){     
      $('#customer_request_id').val(id);   
      $('#existing_customer_id').val(response.customer_id);   
      $('#customer_firstname').val(response.firstname);   
      $('#customer_lastname').val(response.lastname);  
      $('#customer_email').val(response.email_add);   
      $('#customer_contact').val(response.contact);  
      $('#myServiceType').val(response.service_name);  
      $('#customer_notes').val(response.customer_notes);  
      $('#service_details').val(response.staff_notes);  
      $('#region').val(response.region);
      $('#province').val(response.province);  
      $('#city').val(response.city);   
      $('#barangay').val(response.barangay);  
      $('#street').val(response.street);   
      $('#postal').val(response.postal); 
    }
  });
}

</script>


</body>
</html>

