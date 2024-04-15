<!-- call this to add new attendance-->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add Attendance</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="attendance_add.php">
                    <div class="form-group">
                    <label for="employee_name" class="col-sm-3 control-label">Employee Name</label>
                    <div class="col-sm-9">
                       <select class="form-control" id="selected_employee" onchange="getEmployeeID()">
                        <option selected hidden></option>
                    <?php 
                       $sql="SELECT * FROM employees";
                       $query=$conn->query($sql);
                       while ($row=$query->fetch_assoc()) {
                            $employee=$row['firstname'] . " " . $row['lastname'];
                        echo "
                            <option value='".$row['employee_id']."'>".$employee."</option>
                        ";
                       }
                    ?>
                       </select>
                    </div>
                </div>
                  <div class="form-group">
                    <label for="employee" class="col-sm-3 control-label">Employee ID</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="employee" name="employee" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">  
                     <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="time_in" class="col-sm-3 control-label">Time In</label>

                    <div class="col-sm-9">
                        <div class="bootstrap-timepicker">
                            <input type="text" class="form-control timepicker" id="time_in" name="time_in" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="time_out" class="col-sm-3 control-label">Time Out</label>

                    <div class="col-sm-9">
                        <div class="bootstrap-timepicker">
                            <input type="text" class="form-control timepicker" id="time_out" name="time_out" required>
                        </div>
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

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span></button>
                <h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="attendance_edit.php">
                    <input type="hidden" id="attid" name="id">
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="edit_date" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_time_in" class="col-sm-3 control-label">Time In</label>

                    <div class="col-sm-9">
                        <div class="bootstrap-timepicker">
                            <input type="text" class="form-control timepicker" id="edit_time_in" name="edit_time_in" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_time_out" class="col-sm-3 control-label">Time Out</label>

                    <div class="col-sm-9">
                        <div class="bootstrap-timepicker">
                            <input type="text" class="form-control timepicker" id="edit_time_out" name="edit_time_out" required>
                        </div>
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

<!-- call this to delete attendance -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span id="attendance_date"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="attendance_delete.php">
                    <input type="hidden" id="del_attid" name="id">
                    <div class="text-center">
                        <p>DELETE ATTENDANCE</p>
                        <h2 id="del_employee_name" class="bold"></h2>
                    </div>
            </div>
            <div class="modal-footer">           
                <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
     function getEmployeeID() {
         var id = document.getElementById('selected_employee').value;
         document.getElementById('employee').value=id;
     }


</script>


     
