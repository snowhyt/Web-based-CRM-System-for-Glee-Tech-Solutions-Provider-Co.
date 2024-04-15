<!-- call this to add cash advance -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add Cash Advance</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="cashadvance_add.php">

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
                    <label for="amount" class="col-sm-3 control-label">Amount</label>

                    <div class="col-sm-9">
                      <input type="number" value="0.00" step="0.01" maxlength=10 min=1 class="form-control" id="amount" name="amount" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">  
                <button type="submit" class="btn btn-info" name="add"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- call this to edit cash advance -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="date"></span> - <span class="employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="cashadvance_edit.php">
                    <input type="hidden" class="caid" name="id">
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Amount</label>

                    <div class="col-sm-9">
                      <input type="number" value="0.00" step="0.01" maxlength=10 min=1 class="form-control" id="edit_amount" name="amount" required>
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

<!-- call this to delete cash advance -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="date"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="cashadvance_delete.php">
                    <input type="hidden" class="caid" name="id">
                    <div class="text-center">
                        <p>DELETE CASH ADVANCE</p>
                        <h2 class="employee_name bold"></h2>
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

     