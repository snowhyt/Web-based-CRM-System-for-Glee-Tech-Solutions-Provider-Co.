<!-- call this to show modal for forgot password -->
<div class="modal fade" id="forgot">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>              
                <h4 class="modal-title"><b><i class="fa fa-lock"></i> Forgot Password</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="send_reset_link.php">
                  <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Email Address</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email_add" name="email_add" placeholder="Enter your registered email address" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">           
                <button type="submit" class="btn btn-info" name="send"><i class="fa fa-paper-plane"></i> Submit</button>  
            </div>
            </form>
        </div>
    </div>
</div>