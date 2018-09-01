<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

    function __construct(){
        parent::__construct();
        
        if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}
		$this->load->model('Address_model')
		->model('Settings_model');
	}

	function mainSettings(){
		  $page_vars = array();
		  $this->loadJS('custom/citezen.js');

		  $settings = $this->Settings_model->getAllsettings();
		  $settings1 = array();
        if(!empty($settings)){
            foreach ($settings as $value) {
                  $settings1[$value->setings_id] = $value->settings_name;
            }
          
        }
		  $page_vars['allSettings'] = $settings1;

		  $province = $this->Address_model->getprovince();
        $province1 = array();
        if(!empty($province)){
            foreach ($province as $value) {
                  $province1[$value->provCode] = $value->provDesc;
            }
          
        }
        $page_vars['allProvince'] = $province1;
		  $this->form_validation->set_rules('captain', 'Brangay Captain', 'required')
              ->set_rules('province1', 'Province', 'required')
              ->set_rules('cityMun1', 'City/Municipality', 'required')
              ->set_rules('barangay1', 'Barangay', 'required')
              ->set_rules('sbh1', 'District', 'required');
            
        if($this->form_validation->run()){
        	$this->isExist(1,'Brangay Chairman Name',$this->input->post('captain'));
        	$this->isExist(2,'Province',$this->input->post('province1'));
        	$this->isExist(3,'City/Municipality',$this->input->post('cityMun1'));
        	$this->isExist(4,'Barangay',$this->input->post('barangay1'));
        	$this->isExist(5,'District',$this->input->post('sbh1'));
                message('success','Succesfully to saved settings.');
                //redirect('Settings/mainSettings');
           }else{
               // message('danger','failed to saved settings.');
                 //redirect('Settings/mainSettings');
           }


        $this->load->view('template/adminlte',array_merge([
           'page_view' => 'pages/settings/mainsetting',
            'page_tittle' => 'MAIN SETTINGS',
            'page_webTittle' => 'MAIN SETTINGS',
             ], $page_vars ));

	}
		    /**
     * this is for dynamic shorting of code
     * @param
     * @setting_id
     * @settingName
     * @settingValue
     */
    function isExist($id = 0, $settingName = '', $settingValue = ''){
        if($id > 0){
           // $dormant = MainSetting::find($id);
        	$isSaved = $this->Settings_model->getSettings($id);
            if(empty($isSaved)){
               $this->Common_model->insert('settings',[
               			'setings_id' => $id,
               			'settings_name' => $settingName,
               			'value' => $settingValue 
               	]);
            }else{
              	$this->Common_model->update('settings',[
               			'settings_name' => $settingName,
               			'value' => $settingValue 
               	],[
               		'setings_id' => $id
               	]);   
            }
        }
    }
}