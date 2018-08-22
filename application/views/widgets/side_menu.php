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
          <p><?= $this->session->userdata('my_auth')['username'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class=" <?php if($sideBarVarClass == 'dasboard')echo 'active';?>">
          <a href="<?= base_url() ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
     
        <li class="treeview <?php if($sideBarVarClass == 'client')echo 'active';?>">
          <a href="#">
            <i class="fa fa-envelope-open "></i> <span>Clients</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($sideBarVarClass.'/'.$sideBarVarMethod == 'client/listClient')echo 'active';?>"><a href="<?= base_url().'citezen/list' ?>"><a href="<?= base_url().'client/listClient' ?>"><i class="fa fa-circle-o"></i> Clients List </a></li>
            <li class="<?php if($sideBarVarClass.'/'.$sideBarVarMethod == 'client/create')echo 'active';?>"><a href="<?= base_url().'client/create' ?>"><i class="fa fa-circle-o"></i> Create Client </a></li>
          </ul>
        </li>

           <li class="treeview <?php if($sideBarVarClass == 'loan')echo 'active';?>">
          <a href="#">
            <i class="fa fa-envelope-open "></i> <span>Loans</span>
            
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
           
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($sideBarVarClass.'/'.$sideBarVarMethod == 'loan/loanApplication')echo 'active';?>"><a href="<?= base_url().'loan/loanApplication' ?>"><i class="fa fa-circle-o"></i> Loan Application </a></li>
            <li class="<?php if($sideBarVarClass.'/'.$sideBarVarMethod == 'loan/loanRelease')echo 'active';?>"><a href="<?= base_url().'loan/loanRelease' ?>"><i class="fa fa-circle-o"></i> Loan Release </a></li>
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Loan Payment </a></li>
            <!--
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Loan Product </a></li>
            -->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope-open "></i> <span>Journal List</span>
            <!--
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
             -->
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>