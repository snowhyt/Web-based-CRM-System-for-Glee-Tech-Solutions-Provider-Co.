<header class="main-header">
    <!-- Logo -->
    <a href="../home" class="logo" style="background-color:#1a2226;">
      <!-- mini logo for sidebar -->
      <span class="logo-mini">
        <b>
          <image src="../payroll/images/icon.png" style="height:35px;width:35px;"></image>
        </b>
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <image src="../payroll/images/icon.png" style="height:35px;width:35px;"></image>
        <b style="font-size:medium;"> Service Request</b>
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color:#1e282c;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!--navigations on the right side-->
      <div class="input-group pull-right navbar-custom-menu">
        <!--administrator menu-->
       <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
              <span class="glyphicon glyphicon-cog"></span><?php echo $user['user_type'];?>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background-color:#1e282c;">
                <img src="<?php echo (!empty($user['photo'])) ? '../payroll/images/'.$user['photo'] : '../payroll/images/profile.png'; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $user['firstname'].' '.$user['lastname']; ?>
                  <small>Member since <?php echo date('M. Y', strtotime($user['created_on'])); ?></small>
                </p>
              </li>
              <li class="user-footer" style="background-color:lightgray;">
                <div class="pull-left">
                  <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">
                    <i class="fa fa-refresh"></i>
                  Update</a>
                </div>
                <div class="pull-right">
                  <a href="../home" class="btn btn-default btn-flat">
                  <i class="fa fa-home"></i>
                    Home
                  </a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
     
    </div>
    </nav>
  </header>
  <?php include 'includes/profile_modal.php'; ?>