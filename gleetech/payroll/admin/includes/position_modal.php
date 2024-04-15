<!-- call this to add position -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add Position</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="position_add.php">
                  <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Position Title</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Rate per Hr</label>

                    <div class="col-sm-9">
                      <input type="number" value="0.00" step="0.01" maxlength=10 min=1 class="form-control" id="rate" name="rate" required>
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

<!-- call this to edit position -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Update Position</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="position_edit.php">
                    <input type="hidden" id="posid" name="id">
                <div class="form-group">
                    <label for="edit_title" class="col-sm-3 control-label">Position Title</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_title" name="title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_rate" class="col-sm-3 control-label">Rate per Hr</label>

                    <div class="col-sm-9">
                      <input type="number" value="0.00" step="0.01" maxlength=10 min=1 class="form-control" id="edit_rate" name="rate">
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

<!-- call this to delete position -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="position_delete.php">
                    <input type="hidden" id="del_posid" name="id">
                    <div class="text-center">
                        <p>DELETE POSITION</p>
                        <h2 id="del_position" class="bold"></h2>
                    </div>
            </div>
            <div class="modal-footer">           
                <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


     