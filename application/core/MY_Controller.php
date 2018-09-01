<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

		function loadJS($js_file = '', $vars = array()){
		if($js_file != ''){
			$custom_js = $this->load->get_var('custom_js');
			$js_vars = (array)$this->load->get_var('js_vars');

			if(!empty($vars))
				$js_vars = array_merge($js_vars, $vars);


			$this->load->vars('custom_js',$custom_js ."\n". '<script src="'. assets_url() . $js_file.'"></script>')->vars('js_vars', $js_vars);
		}
	}


}