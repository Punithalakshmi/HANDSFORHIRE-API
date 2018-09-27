<div class="page-container">
  <div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
  <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="<?=site_url('dashboard');?>">
        <h3 style="color: white;">HandzforHire</h3>
      </a>
      <div class="menu-toggler sidebar-toggler hide">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
      </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
       
        <?php
          $profile = get_user_profile();
          $access = get_role_access($this->session->userdata('user_data')['usertype']);
          $menu = json_decode($access['menu_id']);
        ?>
        <li class="dropdown dropdown-user">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <img alt="" class="img-circle" src="<?=base_url().$profile['photo'];?>"/>
          <span class="username username-hide-on-mobile">
          <?=$profile['firstname'];?> </span>
          <i class="fa fa-angle-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-default">
            <li>
              <a href="<?=site_url('profile');?>">
              <i class="icon-user"></i> My Profile </a>
            </li>
            <li>
              <a href="<?=site_url('login/logout');?>">
              <i class="icon-key"></i> Log Out </a>
            </li>
          </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-quick-sidebar-toggler">
          <a href="<?=site_url('login/logout');?>" class="dropdown-toggle">
          <i class="fa fa-power-off"></i>
          </a>
        </li>
        <!-- END QUICK SIDEBAR TOGGLER -->
      </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  </div>
  <div class="page-sidebar-wrapper">
    <?php 
      $uri = $this->uri->segment(1);
      $uri1 = $this->uri->segment(2);
    ?>
    <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="sidebar-toggler-wrapper">
          <div class="sidebar-toggler">
          </div>
        </li>
        <li class="start <?=($uri=='dashboard')?'active':'';?>">
          <a href="<?=site_url('dashboard');?>">
          <i class="fa fa-home"></i>
          <span class="title">Dashboard</span>
          <?=($uri=='dashboard')?"<span class='selected'>":"";?>
          </a>
        </li>
        <?php if(isset($menu->employers) && $menu->employers=="1"){?>
        <li class="<?=($uri1=='employers' || $uri1=='add_employer')?'active':'';?>">
          <a href="<?=site_url('user/employers');?>">
          <i class="fa fa-user"></i>
          <span class="title">Employers</span>
          <?=($uri1=='employers')?"<span class='selected'>":"";?>
          </a>
        </li>
        <?php }?>
        <?php if(isset($menu->employees) && $menu->employees=="1"){?>
        <li class="<?=($uri1=='employees' || $uri1=='add_employee')?'active':'';?>">
          <a href="<?=site_url('user/employees');?>">
          <i class="fa fa-users"></i>
          <span class="title">Employees</span>
          <?=($uri1=='employees')?"<span class='selected'>":"";?>
          </a>
        </li>
        <?php }?>
        <?php if(isset($menu->jobs) && $menu->jobs=="1"){?>
        <li class="start <?=($uri=='jobs')?'active':'';?>">
          <a href="<?=site_url('jobs');?>">
          <i class="fa fa-anchor"></i>
          <span class="title">Jobs</span>
            <?=($uri=='jobs')?"<span class='selected'>":"";?>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu">
            <?php if(isset($menu->list) && $menu->list=="1"){?>
            <li class="<?=($uri1=='job_list' || $uri1=='add_job')?'active':'';?>">
              <a href="<?=site_url('jobs/job_list');?>">
              <i class="fa fa-calendar"></i>
              Jobs List</a>
            </li>
            <?php }?>
            <?php if(isset($menu->posted) && $menu->posted=="1"){?>
            <li class="<?=($uri1=='posted_jobs' || $uri1=='add_employee')?'active':'';?>">
              <a href="<?=site_url('jobs/posted_jobs');?>">
              <i class="fa fa-line-chart"></i>
              Posted Jobs</a>
            </li>
            <?php }?>
            <?php if(isset($menu->category) && $menu->category=="1"){?>
             <li class="<?=($uri1=='category' || $uri1=='add_category')?'active':'';?>">
              <a href="<?=site_url('jobs/category');?>">
              <i class="fa fa-sitemap"></i>
              Category</a>
            </li>
            <?php }?>
          </ul>
        </li>
        <?php }?>
        <?php if(isset($menu->payment_methods) && $menu->payment_methods=="1"){?>
        <li class="start <?=($uri=='payment' && $uri1!='payment_history')?'active':'';?>">
          <a href="<?=site_url('payment');?>">
            <i class="fa fa-money"></i>
            <span class="title">Payment Methods</span>
            <span class="arrow"></span>
              <?=($uri=='payment')?"<span class='selected'>":"";?>
          </a>
          <ul class="sub-menu">
            <?php if(isset($menu->card) && $menu->card=="1"){?>
            <li class="<?=($uri1=='credit_card' || $uri1=='add_card')?'active':'';?>">
              <a href="<?=site_url('payment/credit_card');?>">
              <i class="fa fa-credit-card"></i>
              Credit or Debit Card</a>
            </li>
            <?php }?>
            <?php if(isset($menu->account) && $menu->account=="1"){?>
            <li class="<?=($uri1=='checking_account' || $uri1=='add_account')?'active':'';?>">
              <a href="<?=site_url('payment/checking_account');?>">
              <i class="fa fa-bank"></i>
              Checking Account</a>
            </li>
            <?php }?>
            <?php if(isset($menu->paypal) && $menu->paypal=="1"){?>
            <li class="<?=($uri1=='paypal')?'active':'';?>">
              <a href="<?=site_url('payment/paypal_listing');?>">
              <i class="fa fa-paypal"></i>
              Paypal</a>
            </li>
            <?php }?>     
          </ul>
        </li>
        <?php }?>
        <?php if(isset($menu->payment_history) && $menu->payment_history=="1"){?>
        <li class="start <?=($uri=='payment' && $uri1=='payment_history')?'active':'';?>">
          <a href="<?=site_url('payment/payment_history');?>">
          <i class="fa fa-table"></i>
          <span class="title">Payment History</span>
            <?=($uri=='payment')?"<span class='selected'>":"";?>
          </a>
        </li>
         <?php }?>
        <?php if(isset($menu->roles) && $menu->roles=="1"){?>
        <li class="start <?=($uri=='roles')?'active':'';?>">
          <a href="<?=site_url('roles');?>">
          <i class="fa fa-sitemap"></i>
          <span class="title">Roles</span>
            <?=($uri=='roles')?"<span class='selected'>":"";?>
          </a>
        </li>
         <?php }?>
        <?php if(isset($menu->reports) && $menu->reports!="1"){?>
        <li class="start <?=($uri=='reports')?'active':'';?>">
          <a href="<?=site_url('reports');?>">
          <i class="fa fa-table"></i>
          <span class="title">Reports</span>
            <?=($uri=='reports')?"<span class='selected'>":"";?>
          </a>
        </li>
         <?php }?>
        <?php if(isset($menu->email) && $menu->email=="1"){?>
        <li class="<?=($uri=='email_notifications')?'active':'';?>">
          <a href="<?=site_url('email_notifications');?>">
            <i class="fa fa-envelope"></i>
            <span class="title">Email Notifications</span>
            <?=($uri=='email_notifications')?"<span class='selected'>":"";?>
          </a>
        </li>
         <?php }?>
      </ul>
    </div>
  </div>