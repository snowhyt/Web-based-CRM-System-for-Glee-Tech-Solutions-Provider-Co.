<?php
  include 'timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/01/Y');
;?>

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
        <!--home-->
        <li class="header">Requests</li>
        <li>
          <a href="home">
            <i class="fa fa-cogs"></i> 
            <span>My Requests</span>
          </a>
        </li>
        <li>
        <a href="invoice">
            <i class="fa fa-files-o"></i> 
            <span>My Invoices</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>