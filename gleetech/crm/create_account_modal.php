<!-- call this to show modal for customer registration -->
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>
                    <i class="fa fa-user"></i>
                    Create Customer Account</b>
                </h4>
            </div>

            <!--body-->    
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="create_account.php">
                   <!--username-->
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" maxlength="30" id="username" name="username" value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>" placeholder="Enter Username" required></input>
                        </div>
                    </div>

                    <?php unset($_SESSION['username']); ?>

                    <!--password-->
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9"> 
                            <input type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" minlength="8" maxlength="20" id="password" name="password" onkeyup="comparePassword();" placeholder="Enter Password" required></input>
                        </div>
                    </div>

                    <!--re-password-->
                    <div class="form-group">
                        <label for="re-password" class="col-sm-3 control-label">Re-enter Password</label>

                        <div class="col-sm-9"> 
                            <input type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" minlength="8" maxlength="20" id="repassword" name="repassword" onkeyup="comparePassword();" placeholder="Re-enter Password" required></input>
                        </div>
                    </div>

                    <!--message if password matched/not matched-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <span id='message'></span>
                        </div>
                     </div>
                   
                     <!--password requirements-->
                     <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                         <p class="text-muted" style="font-size:0.9em;"><b>Password Requirements</b></p>
                         <p class="text-muted" style="font-size:0.7em;">Atleast 8 characters in length</p>
                         <p class="text-muted" style="font-size:0.7em;">Atleast 1 numeric value</p>
                         <p class="text-muted" style="font-size:0.7em;">Atleast 1 special character ?=.*[!@#$%^&*_=+-</p>
                        </div>
                    </div>

                    <!--email address-->
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" maxlength="100" id="email_add" name="email_add" value="<?php if(isset($_SESSION['email_add'])){echo $_SESSION['email_add'];}?>" placeholder="Enter email address" required>
                        </div>
                    </div>

                    <?php unset($_SESSION['email_add']); ?>

                    <!--firstname-->
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  maxlength="50" id="firstname" name="firstname" value="<?php if(isset($_SESSION['firstname'])){echo $_SESSION['firstname'];}?>" placeholder="Enter firstname" required></input>
                        </div>
                    </div>

                    <?php unset($_SESSION['firstname']); ?>

                    <!--lastname-->
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  maxlength="50" id="lastname" name="lastname" value="<?php if(isset($_SESSION['lastname'])){echo $_SESSION['lastname'];}?>" placeholder="Enter lastname" required></input>
                        </div>
                    </div>

                    <?php unset($_SESSION['lastname']); ?>

                    <!--phone-->
                    <div class="form-group">
                        <label for="contact number" class="col-sm-3 control-label">Contact Number</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control"  id="contact" name="contact" value="<?php if(isset($_SESSION['contact'])){echo $_SESSION['contact'];}?>" placeholder="Enter contact number" required></input>
                        </div>
                    </div>

                    <!--terms and conditions-->
                    <div class="form-group">
                        <div class="col-xs-12" style="padding-left:25px;">
                            <label class="col-sm-3 control-label"></label>
                            <input type="checkbox" required> &nbsp I agree to the terms and conditions below</input>                 
                        </div>
                    </div>

                    <!--privacy statement-->
                    <div class="form-group">
                        <div class="col-xs-12" style="padding-left:25px;">
                            <label class="col-sm-3 control-label"></label>
                            <a href="http://localhost/gleetech/privacystatement" target="_blank">Privacy Statement</a>
                        </div>
                    </div>
              
                    <!--site use policy-->
                    <div class="form-group">
                        <div class="col-xs-12" style="padding-left:25px;">
                            <label class="col-sm-3 control-label"></label>
                            <a href="http://localhost/gleetech/siteusepolicy" target="_blank">Site Use Policy</a>
                        </div>
                    </div>

                    <?php unset($_SESSION['contact']); ?>

                    <!--footer-->
                    <div class="modal-footer">           
                        <button type="submit" class="btn btn-info" name="save" id="save"><i class="fa fa-paper-plane"></i> Submit</button>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //function to compare if the password and repassword matched
    function comparePassword()
    {
        if ($('#password').val()!='') {
          if ($('#password').val() == $('#repassword').val()) {
            $('#message').html('Password matched.').css('color', 'green');
            document.getElementById("save").disabled=false;
          } else{
            $('#message').html('Password did not matched.').css('color', 'red');
            document.getElementById("save").disabled=true;
          }  
        }else{
            $('#message').html('');
              document.getElementById("save").disabled=true;
        }  
    }
</script>