<!-- call this to add new employee -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add Employee</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_add.php" enctype="multipart/form-data">
                <h4>Personal Information</h4>
                <!--First Name--> 
                <div class="form-group">
                      <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                      </div>
                </div>   
                <!--Last Name-->
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>
                <!--Gender-->
                <div class="form-group">
                    <label for="gender" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="gender" id="gender" required>
                        <option value="" selected>- Select -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                </div>
                <!--Address-->
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="address" id="address"></textarea>
                    </div>
                </div>
                <!--Birth Date-->
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Birthdate</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="birthdate">
                      </div>
                    </div>
                </div>
                <!--Contact Info-->
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="11" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="contact" name="contact">
                    </div>
                </div>
                 <!--Email Address-->
                <div class="form-group">
                    <label for="email_add" class="col-sm-3 control-label">Email Address</label>

                    <div class="col-sm-9">
                      <input type="email_add" maxlength="100" class="form-control" id="email_add" name="email_add" placeholder="optional">
                    </div>
                </div>
                <hr>
                <h4>Goverment Details</h4>
                <!--PHILHEALTH-->
                <div class="form-group">
                    <label for="philhealth" class="col-sm-3 control-label">PHILHEALTH</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="12" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="philhealth" name="philhealth" required>
                    </div>
                </div>
                  <!--SSS-->
                  <div class="form-group">
                    <label for="sss" class="col-sm-3 control-label">SSS</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="sss" name="sss" required>
                    </div>
                </div>
                <!--PAGIBIG-->
                <div class="form-group">
                    <label for="pagibig" class="col-sm-3 control-label">PAG-IBIG</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="12" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="pagibig" name="pagibig" required>
                    </div>
                </div>
                <hr>
                <h4>Employee Details</h4>
                <!--Position-->
                <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Position</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="position" id="position" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <!--Schedule-->
                <div class="form-group">
                    <label for="schedule" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="schedule" name="schedule" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <hr>
                <!--Photo-->
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" name="photo" id="photo">
                    </div>
                </div>
            </div>
          
            <div class="modal-footer">   
              <button type="submit" class="btn btn-primary" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- call this to edit employee details -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_edit.php">
                <input type="hidden" class="empid" name="id">
                <input type="hidden" id="original_hiredate" name="original_hiredate">
                <h4>Personal Information</h4>
                <!--First Name-->
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
                    </div>
                </div>
                <!--Last Name-->
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                    </div>
                </div>
                <!--Gender-->
                <div class="form-group">
                    <label for="edit_gender" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="gender" id="edit_gender" required>
                        <option selected id="gender_val"></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                </div>
                <!--Address-->
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="address" id="edit_address"></textarea>
                    </div>
                </div>
                <!--Birth Date-->
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Birthdate</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="birthdate">
                      </div>
                    </div>
                </div>
                <!--Contact Info-->
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="11" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="edit_contact" name="contact">
                    </div>
                </div>
                 <!--Email Address-->
                <div class="form-group">
                    <label for="email_add" class="col-sm-3 control-label">Email Address</label>

                    <div class="col-sm-9">
                      <input type="email_add" maxlength="100" class="form-control" id="edit_email_add" name="email_add" placeholder="optional">
                    </div>
                </div>
                <hr>
                <h4>Government Details</h4>
                <!--PHILHEALTH-->
                <div class="form-group">
                    <label for="edit_philhealth" class="col-sm-3 control-label">PHILHEALTH</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="12" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="edit_philhealth" name="philhealth" required>
                    </div>
                </div>
                  <!--SSS-->
                  <div class="form-group">
                    <label for="edit_sss" class="col-sm-3 control-label">SSS</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="edit_sss" name="sss" required>
                    </div>
                </div>
                <!--PAGIBIG-->
                <div class="form-group">
                    <label for="edit_pagibig" class="col-sm-3 control-label">PAG-IBIG</label>

                    <div class="col-sm-9">
                      <input type="number" data-maxlength="12" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" class="form-control" id="edit_pagibig" name="pagibig" required>
                    </div>
                </div>
                <hr>
                <h4>Employee Details</h4>
                <div class="form-group">
                    <label for="edit_position" class="col-sm-3 control-label">Position</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="position" id="edit_position" required>
                        <option selected id="position_val"></option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <!--Schedules-->
                <div class="form-group">
                    <label for="edit_schedule" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="edit_schedule" name="schedule" required>
                        <option selected id="schedule_val"></option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <!--Status-->
                <div class="form-group">
                    <label for="edit_status" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="activestate" id="edit_activestate" required>
                        <option selected id="status_val"></option>
                        <option id="0" value="Termed">Termed</option>
                        <option id="1" value="Active">Active</option>
                      </select>
                    </div>
                </div>
                <!--Term Date-->
                <div class="form-group">
                 <label for="term_date" class="col-sm-3 control-label">Term Date</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="term" name="term_date" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">            
              <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- call this to delete employee -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_delete.php">
                <input type="hidden" class="empid" name="id">
                <div class="text-center">
                    <p>DELETE EMPLOYEE</p>
                    <h2 class="bold del_employee_name"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- call this upload new photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
             <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>    