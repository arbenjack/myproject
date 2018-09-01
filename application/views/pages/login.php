


<div class="col-md-4 col-md-offset-4 col-xs-12">
&nbsp;
</div>
<div class="col-md-4 col-md-offset-4 col-xs-12">
&nbsp;
</div>

<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-xs-12">
	<div class="panel panel-default">
	<?=form_open(current_url(), 'data-toggle="validator" role="form"')?>
	  <div class="panel-heading">
		<div class="col-md-12 col-xs-12 text-center">
			<!--
			<div class="col-md-6 col-md-offset-3 col-xs-12 text-center">
				<img src="<?=site_url('assets/img/logo.png')?>" class="img-responsive">
			</div>
		-->
			<h3>Administrator</h3>
		</div>
		<div class="row"></div>
	  </div>
	  <div class="panel-body">

	   	<div class="form-group">
	   	<label class="control-label">Username</label>
	   	<input type="text" name="username" class="form-control" required>
	   	<?=form_error('username')?>
	   	<div class="help-block with-errors"></div>
	   	</div>

	   	<div class="form-group">
	   	<label class="control-label">Password</label>
	   	<input type="Password" name="pwd" class="form-control" required>
	   	<?=form_error('pwd')?>
	   	<div class="help-block with-errors"></div>
	   	</div>

	   	<div class="form-group">
	   		 <?=show_alerts(@$alert)?>
	   	</div>

	  </div>
	  <div class="panel-footer">
			<div class="form-group text-center">
	   		<button class="btn btn-info"><span class="glyphicon glyphicon-lock"></span> Login</button>
	   	</div>
		</div>
		<?=form_close()?>
	</div>
</div>
