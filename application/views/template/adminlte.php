<?php $this->load->view('common/header');?>

<div class="wrapper">
	<?php $this->load->view('widgets/head_nav');?>
	<?php $this->load->view('widgets/side_menu');?>

	 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

	<?php $this->load->view('widgets/side_barOption');?>
</div>

<?php $this->load->view('common/footer');?>