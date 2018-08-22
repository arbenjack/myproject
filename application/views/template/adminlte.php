<?php $this->load->view('common/header');?>

<div class="wrapper">
	<?php $this->load->view('widgets/head_nav');?>
	<?php $this->load->view('widgets/side_menu');?>

	 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          <?=@$page_tittle?>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

              <?php $this->load->view($page_view);?>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php // $this->load->view('widgets/side_barOption');?>

</div>

<?php $this->load->view('common/footer');?>