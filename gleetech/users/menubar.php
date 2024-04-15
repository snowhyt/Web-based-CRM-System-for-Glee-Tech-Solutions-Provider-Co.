<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../payroll/images/'.$user['photo'] : '../payroll/images/profile.png'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!--dashboard-->
        <li class="header">HOME</li>
        <li>
          <a href="home">
            <i class="fa fa-dashboard"></i>
            <span> Dashboard</span>
          </a>
        </li>

        <!--manage-->
        <li class="header">MANAGE</li> 
        <!--system users-->
        <li>
          <a href="system_users">
            <i class="fa fa-desktop"></i> 
            <span>System Users</span>
          </a>
        </li>
      
        <!--customer accounts-->
        <li>
          <a href="customer_accounts">
            <i class="fa fa-users"></i> 
            <span>Customer Accounts</span>
          </a>
        </li>

         <!--pending accounts-->
         <li>
          <a href="pending">
            <i class="fa fa-clock-o"></i> 
            <span>Pending Activation</span>
          </a>
        </li>

         <!--banned customers-->
         <li>
          <a href="banned_accounts">
            <i class="fa fa-ban"></i> 
            <span>Banned Accounts</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>