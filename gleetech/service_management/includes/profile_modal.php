<!-- call this to update user profile -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header" style="background-color:#1a2226;color:white;">
                <button type="button" style="color: white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Update Profile</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="30" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" minlength="8" maxlength="12" id="password" name="password"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                     <p class="text-muted" style="font-size:0.9em;"><b>Password Requirements</b></p>
                     <p class="text-muted" style="font-size:0.7em;">Atleast 8 characters in length</p>
                     <p class="text-muted" style="font-size:0.7em;">Atleast 1 numeric value</p>
                     <p class="text-muted" style="font-size:0.7em;">Atleast 1 special character ?=.*[!@#$%^&*_=+-</p>
                 </div>
                </div>
                <hr>
                 <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Email Address</label>
                    <div class="col-sm-9">
                        <input type="email" maxlength="100" class="form-control" id="email_add" name="email_add" value="<?php echo $user['email_add'];?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="50" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" maxlength="50" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>
                    </div>
                </div>
               
                <hr>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo:</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="curr_password" class="col-sm-3 control-label">Current Password:</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" minlength="8" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="save"><i class="fa fa-check-square-o"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
