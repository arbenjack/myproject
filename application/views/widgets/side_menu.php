  <?php 
    $sideBarVarClass = $this->router->fetch_class();
    $sideBarVarMethod = $this->router->fetch_method();
  ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <br>
          <!--
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        -->
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
       <li class="treeview <?php if($sideBarVarClass == 'citezen')echo 'active';?>">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Citezens</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($sideBarVarClass.'/'.$sideBarVarMethod == 'citezen/list')echo 'active';?>"><a href="<?= base_url().'citezen/list' ?>"><i class="fa fa-circle-o"></i> List of Citezens </a></li>
            <li class="<?php if($sideBarVarClass.'/'.$sideBarVarMethod == 'citezen/create')echo 'active';?>"><a href="<?= base_url().'citezen/create' ?>"><i class="fa fa-circle-o"></i> Create Citezen </a></li>
          </ul>
        </li>
        <li class="treeview <?php if($sideBarVarClass == 'summons')echo 'active';?>">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Summons</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($sideBarVarClass.'/'.$sideBarVarMethod == 'summons/list')echo 'active';?>"><a href="<?= base_url().'summons/list' ?>"><i class="fa fa-circle-o"></i> List of Summons </a></li>
            <li class="<?php if($sideBarVarClass.'/'.$sideBarVarMethod == 'summons/create')echo 'active';?>"><a href="<?= base_url().'summons/create' ?>"><i class="fa fa-circle-o"></i> Create Summons </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Certificate</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Contributed Certificates </a></li>
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Create Certificate </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href=""><i class="fa fa-circle-o"></i> List of Users </a></li>
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Create Users </a></li>
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Permission </a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>