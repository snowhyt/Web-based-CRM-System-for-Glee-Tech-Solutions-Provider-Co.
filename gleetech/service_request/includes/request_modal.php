<!-- call this to create new request -->
<div class="modal fade" id="new_request">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Service Request</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="create_request.php" enctype="multipart/form-data">
              <h4>Customer Details</h4>            
                <!--First Name--> 
                <div class="form-group">
                      <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="firstname" value="<?php  echo $user['firstname'];?>" name="firstname" disabled>
                      </div>
                </div>   
                
                <!--Last Name-->
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname"  name="lastname" value="<?php  echo $user['lastname'];?>" disabled>
                    </div>
                </div>     

                <!--Contact Info-->
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text"  class="form-control" id="contact" name="contact" value="<?php  echo $user['contact'];?>" disabled>
                    </div>
                </div>    
                
                <!--Email Address-->
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email Address</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email" value="<?php  echo $user['email_add'];?>" disabled>
                    </div>
                </div>   
                <hr>

                <h4>Address Details</h4>
                <br/> 
                <!--region-->
                <div class="form-group">
                    <label for="region" class="col-sm-3 control-label">Region</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="region" id="region" required>
                        <option value="" selected>Select</option>
                      </select>
                    </div>
                    <input type="hidden" id="selected_region" name="selected_region">
                </div>

                <!--province-->
                <div class="form-group">
                    <label for="province" class="col-sm-3 control-label">Province</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="province" id="province" required>
                        <option value="" selected>Select</option>
                      </select>
                    </div>
                    <input type="hidden" id="selected_province" name="selected_province">
                </div>

                 <!--city-->
                 <div class="form-group">
                    <label for="city" class="col-sm-3 control-label">City</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="city" id="city" required>
                        <option value="" selected>Select</option>
                      </select>
                    </div>

                    <input type="hidden" id="selected_city" name="selected_city">
                </div>

                <!--barangay-->
                <div class="form-group">
                    <label for="barangay" class="col-sm-3 control-label">Barangay</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="barangay" id="barangay" required>
                        <option value="" selected>Select</option>
                      </select>
                    </div>

                    <input type="hidden" id="selected_brgy" name="selected_brgy">
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
                    <label for="service_type" class="col-sm-3 control-label">Service Type</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="service_type" id="service_type" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM services WHERE active=1";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option id='".$prow['service_id']."' value='".$prow['description']."|".$prow['service_name']."'>".$prow['service_name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>

                    <input type="hidden" id="service_id" name="service_id">
                    <input type="hidden" id="selected_service_type" name="selected_service_type">
                </div>

                <!--service description-->
                <div class="form-group">
                    <label for="service_description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <textarea class="form-control comment" name="description" id="description" rows="5" disabled></textarea>
                    </div>

                     <input type="hidden" name="service_description" id="service_description">
                </div>        

                <!--additional notes-->
                <div class="form-group">
                    <label for="notes" class="col-sm-3 control-label">Additional Notes</label>

                    <div class="col-sm-9">
                      <textarea class="form-control comment" name="notes" id="notes" rows="5" maxlength="5000" placeholder="Put N/A if not applicable" required></textarea>
                    </div>
                </div>  
                <hr>  
            </div>
          
            <div class="modal-footer">   
              <button type="submit" class="btn btn-primary" name="create_request"><i class="fa fa-save"></i> Submit</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- call this to update notes -->
<div class="modal fade" id="update_request">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Update Notes</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="update_request.php" enctype="multipart/form-data">
                <h4>Customer Information</h4>
                <br/>

                <!--Request ID-->
                <input type="text" id="request_id" name="request_id" hidden>

                <!--First Name--> 
                <div class="form-group">
                      <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_firstname" value="<?php  echo $user['firstname'];?>" name="edit_firstname" disabled>
                      </div>
                </div>   
                
                <!--Last Name-->
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname"  name="edit_lastname" value="<?php  echo $user['lastname'];?>" disabled>
                    </div>
                </div>     
 
               
               <!--Contact Info-->
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="11" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="edit_contact" name="edit_contact" value="<?php  echo $user['contact'];?>" disabled>
                    </div>
                </div>    
                
                <!--Email Address-->
                <div class="form-group">
                    <label for="edit_email" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="edit_email" name="edit_email" value="<?php  echo $user['email_add'];?>" disabled>
                    </div>
                </div>  
                
                 <!--Address-->
                 <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Full Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="edit_address" id="edit_address" disabled></textarea>
                    </div>
                </div>      
                

                <hr>
                <h4>Requesting For</h4>
                <br/>
                <!--service type-->
                <div class="form-group">
                    <label for="edit_service_type" class="col-sm-3 control-label">Service Type</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_service_type" name="edit_service_type" disabled>
                    </div>
                </div>   

                <!--service description-->
                <div class="form-group">
                    <label for="edit_service_description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="edit_description" id="edit_description" rows="5" disabled></textarea>
                    </div>
                </div>        

                <!--additional notes-->
                <div class="form-group">
                    <label for="edit_notes" class="col-sm-3 control-label">Additional Notes</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="edit_notes" id="edit_notes" rows="5" maxlength="5000"></textarea>
                    </div>
                </div>  
                <hr>  
            </div>
          
            <div class="modal-footer">   
              <button type="submit" class="btn btn-warning" name="update_request"><i class="fa fa-edit"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- call this to cancel request -->
<div class="modal fade" id="cancel_request">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Cancel Service Request</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="cancel_request.php">
                    <input type="hidden" id="cancel_request_id" name="cancel_request_id">
                    <input type="hidden" id="requestor" name="requestor">
                    <input type="hidden" id="cancelled_service_type" name="cancelled_service_type">
                    <input type="hidden" id="requestor_contact" name="requestor_contact">

                    <div class="text-center">
                        <b><p class="form-control">Are you sure do you want to cancel the service request?</p></b>
                    </div>

                    <!--cancellation notes-->
                    <div class="text-center">
                         <textarea class="form-control" name="cancellation_notes" id="cancellation_notes" 
                                    rows="5" maxlength="5000" placeholder="Add reason for cancellation" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" name="cancel_request"><i class="fa fa-paper-plane"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let service_type_list = document.getElementById("service_type");
    service_type_list.onchange = (ev) =>{
        let val_array = service_type_list.value.split('|');
        document.getElementById("description").value = val_array[0];
        document.getElementById("service_description").value = val_array[0];
        document.getElementById("selected_service_type").value=val_array[1];
        document.getElementById("service_id").value = Number(service_type_list.options[service_type_list.selectedIndex].id);
    } 

    let _region = document.getElementById("region");
    _region.onchange = (ev) =>{
      document.getElementById("selected_region").value = _region.options[_region.selectedIndex].innerText;   
    }

    let _province = document.getElementById("province");
    _province.onchange = (ev) =>{
      document.getElementById("selected_province").value = _province.options[_province.selectedIndex].innerText;   
    }

    let _city = document.getElementById("city");
    _city.onchange = (ev) =>{
      document.getElementById("selected_city").value = _city.options[_city.selectedIndex].innerText;   
    }
  
    let _barangay = document.getElementById("barangay");
    _barangay.onchange = (ev) =>{
      document.getElementById("selected_brgy").value = _barangay.options[_barangay.selectedIndex].innerText;   
    }
</script>

