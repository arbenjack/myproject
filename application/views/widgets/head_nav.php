<?php /*
<header class="main-header">
<!-- Logo -->
<a href="../../index2.html" class="logo">
<!-- mini logo for sidebar mini 50x50 pixels -->
<span class="logo-mini"><b>B</b>S</span>
<!-- logo for regular state and mobile devices -->
<span class="logo-lg"><b>Barangay</b> System</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>

<div class="navbar-custom-menu">

</div>
</nav>
</header>
 */?>
    <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
     
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>L</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>L</b>oan <b>S</b>ystem</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->


          <!-- User Account: style can be found in dropdown.less -->
         
          <li class="dropdown user user-menu">

             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              

                <!--
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            -->
              <span class="hidden-xs"><?= $this->session->userdata('my_auth')['username'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <?php /*
<li class="user-header">
<!--
<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
-->
<p>
Alexander Pierce - Web Developer
<small>Member since Nov. 2012</small>
</p>
</li>
 */?>
              <!-- Menu Body -->

              <!-- Menu Footer-->

              <li class="user-footer" >
                <?php /*
<div class="pull-left">
<a href="#" class="btn btn-default btn-flat">Profile</a>
</div>
 */?>
                <div class="pull-right">


                  <a href="<?=base_url() . 'app/logout'?>" class="btn btn-default btn-flat">Sign out</a>
               

                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>