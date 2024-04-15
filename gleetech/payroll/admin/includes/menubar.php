<?php
  //get asia/pacific time zone and set the default From and To dates
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/01/Y');
;?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.png'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!--home-->
        <li class="header">REPORT</li>
        <li>
          <a href="home">
            <i class="fa fa-dashboard"></i> 
            <span>Dashboard</span>
          </a>
        </li>
        <!--manage-->
        <li class="header">MANAGE</li> 
        <!--attendance-->
        <li>
          <a href="attendance?range=<?php echo $range_from.'-'.$range_to; ?>">
            <i class="fa fa-calendar"></i> 
            <span>Attendance</span>
          </a>
        </li>
        <!--employees-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Employees</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--employee list-->
            <li>
              <a href="employee">
                <i class="fa fa-circle-o"></i> 
              Employee List</a>
            </li>
            <!--<li><a href="overtime.php"><i class="fa fa-circle-o"></i> Overtime</a></li>-->
            <!--cash advance-->
            <li>
              <a href="cashadvance">
                <i class="fa fa-circle-o"></i> 
              Cash Advance
            </a>     
          </li>
           <!--schedules-->
            <li>
              <a href="schedule">
                <i class="fa fa-circle-o"></i> 
              Schedules
            </a>
          </li>
          </ul>
        </li>
        <!--deductions-->
        <li>
          <a href="deduction">
            <i class="fa fa-money"></i> 
            <span>Deductions</span>
          </a>
        </li>
        <!--positions-->
        <li>
          <a href="position">
            <i class="fa fa-suitcase"></i> 
            <span>Positions</span>
          </a>
        </li>
        <!--printables-->
        <li class="header">PRINTABLES</li>
        <!--payroll-->
        <li>
          <a href="payroll?range=<?php echo $range_from.'-'.$range_to; ?>">
            <i class="fa fa-files-o"></i> 
            <span>Payroll</span>
          </a>
        </li>
        <!--schedule-->
        <li>
          <a href="schedule_employee">
            <i class="fa fa-clock-o"></i> 
            <span>Schedule</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>