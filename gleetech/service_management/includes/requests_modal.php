<!--view request-->
<div class="modal fade" id="view_request">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Service Request</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="update_request.php" enctype="multipart/form-data">
              <h4>Request Details</h4>
                <br/>
                 <!--request id--> 
                 <div class="form-group">
                      <label for="request id" class="col-sm-3 control-label">Service Request ID</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="request_id" id="request_id" readonly>
                      </div>
                </div>  

                <!--service type-->
                <div class="form-group">
                    <label for="service_type" class="col-sm-3 control-label">Service Type</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="service_type" id="service_type" readonly>
                    </div>
                </div>    
               
                <!--service description-->
                <div class="form-group">
                    <label for="service_description" class="col-sm-3 control-label">Service Description</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="description" id="description" rows="5" readonly></textarea>
                    </div>
                </div>        

                <!--customer notes-->
                <div class="form-group">
                    <label for="notes" class="col-sm-3 control-label">Customer Notes</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="notes" id="notes" rows="5" maxlength="5000" readonly></textarea>
                    </div>
                </div>  
                <hr> 

                <h4>Customer Details</h4>
                <br/>
  
                <!--Customer Name-->
                <div class="form-group">
                      <label for="customer_name" class="col-sm-3 control-label">Customer Name</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="customer_name" id="customer_name" readonly>
                      </div>
                </div>   

                <!--Address-->
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Customer Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="address" id="address" required readonly></textarea>
                    </div>
                </div>      
                

                <!--Contact Info-->
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="customer_contact" name="customer_contact" readonly>
                    </div>
                </div>    
                
                <!--Email Address-->
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email Address</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email" readonly>
                    </div>
                </div>
                <hr>

                <h4>Service Updates</h4>
                <br/>

                <!--Request Status-->
                <div class="form-group">
                    <label for="request_status" class="col-sm-3 control-label">Request Status</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="request_status" id="request_status" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM request_status";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option id='".$prow['request_status_id']."' value='".$prow['request_status']."'>".$prow['request_status']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>

                    <input type="text" id="request_status_id" name="request_status_id" hidden>
                </div>

                <!--Staff Notes-->
                <div class="form-group">
                    <label for="staff_notes" class="col-sm-3 control-label">Staff Notes</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="staff_notes"  name="staff_notes" rows="5" required></textarea>
                    </div>
                </div> 
                <hr>
            </div>
            <div class="modal-footer">   
              <button type="submit" class="btn btn-primary" name="update_request"><i class="fa fa-save"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!--add requests-->
<div class="modal fade" id="add_request">
  <div class="modal-dialog">
    <div class="modal-content">
      <!--header-->
      <div class="modal-header" style="background-color:#1a2226;color:white;">
        <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><b>New Service Request</b></h4>
      </div>

      <!--body-->
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="save_request" enctype="multipart/form-data">
          <h4>Customer Details</h4>
          <br/>
          <!--existing customer-->
          <div class="form-group">
            <label for="existing customer" class="col-sm-3 control-label">Existing User</label>
            <div class="col-sm-9">
              <select class="form-control" name="existing_customer" id="existing_customer">
                   <option selected value=""> -- Select -- </option> 
                   <?php getCustomerList(); ?>
              </select>
            </div>              
          </div>

          <!--customer id-->
          <input type="text" name="customer_id" id="customer_id" hidden>
    
          <!--firstname-->
          <div class="form-group">
            <label for="firstname" class="col-sm-3 control-label">Firstname</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="add_customer_firstname" id="add_customer_firstname" required>
            </div>              
          </div>

          <!--lastname-->
          <div class="form-group">
            <label for="lastname" class="col-sm-3 control-label">Lastname</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="add_customer_lastname" id="add_customer_lastname" required>
            </div>              
          </div>

          <!--email-->
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" name="add_customer_email" id="add_customer_email" required>
            </div>              
          </div>

            <!--contact-->
          <div class="form-group">
            <label for="contact" class="col-sm-3 control-label">Contact No</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="add_customer_contact" id="add_customer_contact" required>
            </div>              
          </div>
          <hr>

          <h4>Address Details</h4>
          <br>
          <!--region-->
          <div class="form-group">
            <label for="region" class="col-sm-3 control-label">Region</label>
            <div class="col-sm-9">
              <select class="form-control" name="region" id="region" required>
                <option value="" selected>Select</option>
              </select>
            </div>
            <input type="text" id="selected_region" name="selected_region" hidden>
          </div>

            <!--province-->
            <div class="form-group">
              <label for="province" class="col-sm-3 control-label">Province</label>
              <div class="col-sm-9">
                <select class="form-control" name="province" id="province" required>
                  <option value="" selected>Select</option>
                </select>
              </div>
              <input type="text" id="selected_province" name="selected_province" hidden>
            </div>

            <!--city-->
            <div class="form-group">
              <label for="city" class="col-sm-3 control-label">City</label>
              <div class="col-sm-9">
                <select class="form-control" name="city" id="city" required>
                  <option value="" selected>Select</option>
                </select>
              </div>
              <input type="text" id="selected_city" name="selected_city" hidden>
            </div>

            <!--barangay-->
            <div class="form-group">
              <label for="barangay" class="col-sm-3 control-label">Barangay</label>
              <div class="col-sm-9">
                <select class="form-control" name="barangay" id="barangay" required>
                  <option value="" selected>Select</option>
                </select>
              </div>
              <input type="text" id="selected_brgy" name="selected_brgy" hidden>
            </div>

            <!--street-->
            <div class="form-group">
              <label for="street" class="col-sm-3 control-label">House No/Street</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="street"  name="street" placeholder="Put N/A if not applicable" required>
              </div>
            </div>  
                 
            <!--postal-->
            <div class="form-group">
              <label for="postal" class="col-sm-3 control-label">Postal Code</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="postal"  name="postal" placeholder="Put N/A if not applicable" required>
              </div>
            </div>
            <hr>

            <h4>Service Details</h4>
            <br/>
            <!--service type-->
            <div class="form-group">
              <label for="service type" class="col-sm-3 control-label">Service Type</label>
              <div class="col-sm-9">
                <select class="form-control" name="add_service_type" id="add_service_type" required>
                  <option value="" selected>- Select -</option>
                    <?php getServices(); ?>
                </select>
              </div>
              <input type="text" id="add_service_id" name="add_service_id" hidden>
              <input type="text" id="add_service_name" name="add_service_name" hidden>
            </div>

            <!--service description-->
            <div class="form-group">
              <label for="service_description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-9">
                  <textarea class="form-control comment" name="add_description" id="add_description" rows="5" disabled></textarea>
                </div>

                <input type="text" id="add_service_description" name="add_service_description" hidden>
            </div>        

            <!--additional notes-->
            <div class="form-group">
              <label for="notes" class="col-sm-3 control-label">Additional Notes</label>
              <div class="col-sm-9">
                <textarea class="form-control comment" name="notes" id="notes" rows="5" maxlength="5000" placeholder="Put N/A if not applicable" required></textarea>
              </div>
            </div>  
            <hr>                  

          <div class="modal-footer">   
            <button type="submit" class="btn btn-primary" name="save_request"><i class="fa fa-save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    //onchange event when changing request status
    let request_status_list = document.getElementById("request_status");
    request_status_list.onchange = (ev)=>{
      $('#request_status_id').val(request_status_list.options[request_status_list.selectedIndex].id);
    }

    //onchange event when selecting existing customer
    let customer_list = document.getElementById("existing_customer");
    customer_list.onchange = (ev)=>{
        let option_id = customer_list.options[customer_list.selectedIndex].id.split('|');;
        let option_value = customer_list.value.split(',');

       $('#add_customer_firstname').val(option_value[1]);
       $('#add_customer_lastname').val(option_value[0]);
       $('#customer_id').val(option_id[0]);
       $('#add_customer_email').val(option_id[1]);
       $('#add_customer_contact').val(option_id[2]);
    }

    //onchange event when selecting service type
    let service_type_list = document.getElementById("add_service_type");
    service_type_list.onchange = (ev) =>{
      $('#add_description').val(service_type_list.value);
      $('#add_service_description').val(service_type_list.value);
      let serviceArray = service_type_list.options[service_type_list.selectedIndex].id.split('|');
      $('#add_service_id').val(Number(serviceArray[0]));
      $('#add_service_name').val(serviceArray[1]);
    } 

    //onchange event when selected region changed
    let _region = document.getElementById("region");
    _region.onchange = (ev) =>{
      $('#selected_region').val(_region.options[_region.selectedIndex].innerText);   
    }

    //onchange event when selected province changed
    let _province = document.getElementById("province");
    _province.onchange = (ev) =>{
      $('#selected_province').val(_province.options[_province.selectedIndex].innerText);   
    }

    //onchange event when selected city change
    let _city = document.getElementById("city");
    _city.onchange = (ev) =>{
      $('#selected_city').val(_city.options[_city.selectedIndex].innerText);   
    }
  
    //onchange event when selected barangay changed
    let _barangay = document.getElementById("barangay");
    _barangay.onchange = (ev) =>{
      $('#selected_brgy').val(_barangay.options[_barangay.selectedIndex].innerText);   
    }

</script>

        