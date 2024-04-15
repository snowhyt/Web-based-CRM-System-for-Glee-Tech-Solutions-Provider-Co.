<!-- call this to add new service -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Service</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="service_add.php" enctype="multipart/form-data">  
                <!--Service Name--> 
                <div class="form-group">
                      <label for="service_name" class="col-sm-3 control-label">Service Name</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="50" id="service_name" name="service_name" required>
                      </div>
                </div>   
                <!--Description-->
                <div class="form-group">
                  	<label for="service_description" class="col-sm-3 control-label">Description</label>
                  	<div class="col-sm-9">
                    	 <textarea class="form-control" name="service_description" id="service_description" maxlength="255" required></textarea>
                  	</div>
                </div>  
                  <div class="modal-footer">   
                <button type="submit" class="btn btn-success" name="add"><i class="fa fa-save"></i> Save</button>
            </div>
                </form>            
          	</div>
        </div>
    </div>
</div>

<!-- call this to edit service -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Service</b></h4>
            </div>
        <div class="modal-body">
              <form class="form-horizontal" method="POST" action="service_edit.php" enctype="multipart/form-data">
                 <input type="hidden" id="edit_service_id" name="edit_service_id">
                <!--Service Name--> 
                <div class="form-group">
                      <label for="edit_service_name" class="col-sm-3 control-label">Service Name</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="50" id="edit_service_name" name="edit_service_name" required>
                      </div>
                </div>   
                <!--Description-->
                <div class="form-group">
                    <label for="edit_service_description" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                       <textarea class="form-control" name="edit_service_description" id="edit_service_description" maxlength="255" required></textarea>
                    </div>
                </div>
                <!--Status-->
                <div class="form-group">
                    <label for="edit_status" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="edit_status" id="edit_status" required>
                        <option selected id="status_val"></option>
                        <option id="0" value="Inactive">Inactive</option>
                         <option id="1" value="Active">Active</option>
                      </select>
                    </div>
                </div>
                <div class="modal-footer">   
                 <button type="submit" class="btn btn-info" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<!-- call this to delete service -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span id="del_service_name"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="service_delete.php">
                    <input type="hidden" id="del_service_id" name="del_service_id">
                    <div class="text-center">
                        <p>DELETE SERVICE</p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
