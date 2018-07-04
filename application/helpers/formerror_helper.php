<?php


if ( ! function_exists('formErrorh'))
{
    function formErrorh($errorType = '',$message = '')
    {
    if(!empty($message))
       if (!empty($errorType)) {
		$icon = '';
		switch ($errorType) {
		case 'warning':$icon = 'warning-sign';
			break;
		case 'danger':$icon = 'remove-sign';
			break;
		case 'success':$icon = 'ok-sign';
			break;
		case 'info':$icon = 'info-sign';
			break;
		}
		/*
		echo '<script type="text/javascript">LB_Admin.showAlert = {
			type : "' . $alert['type'] . '",
			message : \'' . $alert['message'] . '\'
			' . ($icon != '' ? ', icon : \'glyphicon glyphicon-' . $icon . '\'' : ',icon:""') . '
		}</script>';
			*/
		return '<div style="padding: 5px;" class="alert alert-'.$errorType.'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> '.$message.'</div>';
    }   
}
}