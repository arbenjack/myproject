<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citezen extends MY_Controller {

    function __construct(){
        parent::__construct();
        
        if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}
    }

    function list(){
        echo test_method('Hello World');
        
        $page_vars = array();
       // $page_vars['sideBarVarClass'] = $this->router->fetch_class();
       // $page_vars['sideBarVarMethod'] = $this->router->fetch_method();
		$this->load->view('template/adminlte', [
			'page_view' => 'pages/citezen/list',
			'page_tittle' => 'LIST OF CITEZENS',
            'page_webTittle' => 'LIST OF CITEZENS',
            'variables' => $page_vars,
		]);
    }

    function create(){
        $page_vars = array();

        //message('danger', 'Invalid username/password!');
        $this->form_validation->set_rules('fname', 'First Name', 'required')
              ->set_rules('lname', 'Last Name', 'required')
              ->set_rules('mname', 'Middle Name', 'required')
              ->set_rules('datebirth', 'Date of Birth', 'required')
              ->set_rules('Female', 'Gender', 'required');

        if($this->form_validation->run()){

        }else{
            /*
            if(!empty($this->form_validation->error_array())){
                foreach ($this->form_validation->error_array() as $key => $value) {
                  //formErrors_message('danger', $key , $value);
                    formErrors_message('danger', $key , $value);
                }
            }
            */
        }
       

		$this->load->view('template/adminlte', [
			'page_view' => 'pages/citezen/create',
			'page_tittle' => 'CREATING OF CITEZENS',
            'page_webTittle' => 'CREATING OF CITEZENS',
            'variables' => $page_vars
		]);
    }
}