<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LS | <?=@$page_webTittle?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- styles -->
  	<script type="text/javascript">
  		var App = <?= json_encode(array_merge(['siteurl' => site_url()], 
        (isset($js_vars)? $js_vars : array())
    ,['smsurl' => $this->config->item('sms_url')])); ?>;
    
  	</script>
	<?php $this->load->view('common/style');?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
