<!-- call this to add new deduction type -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add Deduction</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="deduction_add.php">
                  <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="description" name="description" required>
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

<!-- call this to edit existing deduction type -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Update Deduction</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="deduction_edit.php">
                    <input type="hidden" class="decid" name="id">
                <div class="form-group">
                    <label for="edit_description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_description" name="description">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Amount</label>

                    <div class="col-sm-9">
                      <input type="number" value="0.00" step="0.01" maxlength=10 min=1 class="form-control" id="edit_amount" name="amount">
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

<!-- call this to delete deduction type -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="deduction_delete.php">
                    <input type="hidden" class="decid" name="id">
                    <div class="text-center">
                        <p>DELETE DEDUCTION</p>
                        <h2 id="del_deduction" class="bold"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


     