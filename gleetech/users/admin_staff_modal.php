<!-- call this to add new system user -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title"><b> <i class="fa fa-desktop"></i>&nbsp Add System User</b></h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="admin_staff_update.php" enctype="multipart/form-data">
                    <!--employee name-->
                    <div class="form-group">
                        <label for="employee name" class="col-sm-3 control-label">Employee Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="selected_employee" name="selected_employee" onchange="getEmployeeID();" required>
                                <option selected hidden></option>
                                <?php
                                    $sql  = "SELECT employee_id, firstname, lastname, email_add FROM employees WHERE active=1";

                                    $query = $conn->query($sql);
                                    while ($row=$query->fetch_assoc()) {
                                        $name = $row['firstname']." ".$row['lastname'];
                                        echo "
                                            <option id=".$row['employee_id']." value=".$row['employee_id']."|".$row['email_add'].">"
                                            .$name."
                                            </option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <!--employee id-->
                    <div class="form-group">
                        <label for="employee id" class="col-sm-3 control-label">Employee ID</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="employee_id" name="employee_id" required readonly></input>
                        </div>
                    </div>

                    <!--username-->
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="username" name="username" required></input>
                        </div>
                    </div>

                    <!--email address-->
                     <div class="form-group">
                        <label for="email address" class="col-sm-3 control-label">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control"  id="add_email" name="add_email" required>
                        </div>
                    </div>

                    <!--access type-->
                     <div class="form-group">
                        <label for="access type" class="col-sm-3 control-label">Access Type</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="user_type" name="user_type" required>
                                <option selected hidden></option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <!--photo-->
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo:</label>

                        <div class="col-sm-9">
                          <input type="file" id="photo" name="photo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="save"><i class="fa fa-check-square-o"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- call this to edit system user details -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title"><b> <i class="fa fa-desktop"></i>&nbsp Update System User</b></h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="admin_staff_update.php" enctype="multipart/form-data">
                    <!--employee name-->
                    <div class="form-group">
                        <label for="employee name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="edit_employee_name" name="edit_employee_name" required readonly>
                            </input>
                        </div>
                    </div>
                    
                    <!--employee id-->
                    <div class="form-group">
                        <label for="employee id" class="col-sm-3 control-label">Employee ID</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="edit_employee_id" name="edit_employee_id" required readonly></input>
                        </div>
                    </div>

                    <!--username-->
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="edit_username" name="edit_username" required readonly></input>
                        </div>
                    </div>

                    <!--email address-->
                     <div class="form-group">
                        <label for="email address" class="col-sm-3 control-label">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" maxlength="100" id="edit_email_add" name="edit_email_add" required>
                        </div>
                    </div>

                    <!--access type-->
                     <div class="form-group">
                        <label for="access type" class="col-sm-3 control-label">Access Type</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="edit_user_type" name="edit_user_type" required>
                                <option selected id="selected_user_type"></option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                    </div>
                      <!--acces status-->
                     <div class="form-group">
                        <label for="access status" class="col-sm-3 control-label">Access Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="edit_status" name="edit_status" required>
                                <option selected id="selected_status"></option>
                                <option id="0" value="Revoke">Revoke</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-pencil-square-o"></i> Update</button>
                     </div>
                </form>
            </div>  
        </div>
    </div>
</div>

<!-- call this to reinstate system user access -->
<div class="modal fade" id="reinstate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Reinstate System User Account</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="admin_staff_update.php">
                    <input type="hidden" id="employee_id_reinstate" name="employee_id_reinstate">
                    <div class="text-center">
                        <p>Reinstate system access for</p>
                        <h2 id="employee_name_reinstate" name="employee_name_reinstate" class="bold"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" name="reinstate"><i class="fa fa-unlock-alt"></i> Reinstate</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- call this to update customer account-->
<div class="modal fade" id="ban_customer_account">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title"><b> <i class="fa fa-user"></i>&nbsp Ban Customer Account</b></h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="update_customer_accounts.php" enctype="multipart/form-data">
                    <!--customer id-->
                    <div class="form-group">
                        <label for="customer id" class="col-sm-3 control-label">Customer ID</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="edit_customer_id" name="edit_customer_id" readonly>
                        </div>
                    </div>
                    <!--customer name-->
                    <div class="form-group">
                        <label for="customer name" class="col-sm-3 control-label">Customer Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="edit_customer_name" name="edit_customer_name" readonly>
                        </div>
                    </div>
                 
                    <!--customer username-->
                    <div class="form-group">
                        <label for="edit customer username" class="col-sm-3 control-label">Username</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="edit_customer_username" name="edit_customer_username" readonly></input>
                        </div>
                    </div>

                    <!--customer email address-->
                     <div class="form-group">
                        <label for="email address" class="col-sm-3 control-label">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" maxlength="100" id="edit_customer_email_add" name="edit_customer_email_add" readonly>
                        </div>
                    </div>
               
                    <!--reason for banning-->
                    <div class="form-group">
                        <label for="reason" class="col-sm-3 control-label">Reason for banning</label>
                        <div class="col-sm-9">
                           <textarea type="text" class="form-control comment" maxlength="5000" id="reason_for_banning" name="reason_for_banning" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="banned"><i class="fa fa-save"></i> Proceed</button>
                     </div>
                </form>
            </div>  
        </div>
    </div>
</div>

<!-- call this to reinstate system user access -->
<div class="modal fade" id="generate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>New Activation Link</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="generate_activation_link.php">
                    <input type="hidden" id="email_add_generate" name="email_add_generate">
                    <div class="text-center">
                        <p>Send new activation link for</p>
                        <h2 id="employee_name_generate" class="bold"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" name="generate"><i class="fa fa-send"></i> Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- call this upload new photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                <b><span class="employee_name_photo"></span></b>
            </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="admin_staff_update.php" enctype="multipart/form-data">
                    <input type="hidden" id="employee_id_photo" name="employee_id_photo">
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- call this to reinstate customer account -->
<div class="modal fade" id="reinstate_customer_account">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Reinstate Customer Account</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="update_customer_accounts.php">
                    <input type="hidden" id="customer_id_reinstate" name="customer_id_reinstate">
                    <input type="hidden" id="customer_email_reinstate" name="customer_email_reinstate">
                    <input type="hidden"  id="customer_name_reinstate_2" name="customer_name_reinstate_2">
                    <div class="text-center">
                        <p>Are you sure do you want to reinstate the customer's account?</p>
                        <h2 id="customer_name_reinstate" name="customer_name_reinstate" class="bold"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" name="unbanned"><i class="fa fa-unlock-alt"></i> Reinstate</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getEmployeeID()
    {
        const id = document.getElementById("selected_employee").value.split('|');
        document.getElementById("employee_id").value=id[0];
        document.getElementById("add_email").value = id[1];
    }


</script>
