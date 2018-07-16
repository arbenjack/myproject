<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citezen extends MY_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}
		$this->load->model('Address_model')
			->model('Citezen_model');
	}

	function list() {
		$page_vars = array();
		$this->loadJS('custom/citezen.js');
		/*
			        $list = $this->Citezen_model->CitezenList();
			        $page_vars['list_citezens'] = $list;
		*/
		// print_r($this->Citezen_model->CitezenList());die();
		$this->load->view('template/adminlte', array_merge([
			'page_view' => 'pages/citezen/list',
			'page_tittle' => 'LIST OF CITEZENS',
			'page_webTittle' => 'LIST OF CITEZENS',
		], $page_vars));
	}
	function getListCitezens() {

		$columns = array(
			0 => 'citizen_id',
			1 => 'first_name',
			2 => 'street',
		);
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$totalData = $this->Citezen_model->allposts_count();
		$totalFiltered = $totalData;

		if (empty($this->input->post('search')['value'])) {
			$list = $this->Citezen_model->allposts($limit, $start, $order, $dir);
		} else {
			$search = $this->input->post('search')['value'];

			$list = $this->Citezen_model->posts_search($limit, $start, $search, $order, $dir);

			$totalFiltered = $this->Citezen_model->posts_search_count($search);
		}

		$data = array();
		if (!empty($list)) {
			foreach ($list as $l) {
				$nestedData['id'] = $l->citizen_id;
				$nestedData['name'] = $l->first_name . ' ' . $l->last_name . ', ' . $l->mid_name;
				$nestedData['address'] = $l->street . ', ' . $l->brgyName . ', ' . $l->cityMunName . ', ' . $l->provinceName;
				$nestedData['gender'] = strtoupper($l->gender);
				//	$nestedData['button'] = '<button type="button" class="btn btn-primary">VIEW</button> <a href="' . site_url() . 'citezen/edit/' . md5($l->citizen_id) . '" type="button" class="btn btn-warning">EDIT</a>';
				$nestedData['button'] = '<a href="' . site_url() . 'citezen/edit/' . md5($l->citizen_id) . '" type="button" class="btn btn-warning">VIEW & EDIT</a>';
				$data[] = $nestedData;

			}
		}

		$json_data = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data,
		);

		echo json_encode($json_data);
	}
	function create() {
		$page_vars = array();
		$this->loadJS('custom/citezen.js');

		$province = $this->Address_model->getprovince();
		$province1 = array();
		if (!empty($province)) {
			foreach ($province as $value) {
				$province1[$value->provCode] = $value->provDesc;
			}

		}
		$page_vars['allProvince'] = $province1;

		//  $this->form_validation->set_message('address_error', 'Please provide an acceptable email address.');
		//message('danger', 'Invalid username/password!');
		$this->form_validation->set_rules('fname', 'First Name', 'required')
			->set_rules('lname', 'Last Name', 'required')
			->set_rules('mname', 'Middle Name', 'required')
			->set_rules('datebirth', 'Date of Birth', 'required')
			->set_rules('gender', 'Gender', 'required')
			->set_rules('province1', 'Province', 'required')
			->set_rules('cityMun1', 'City/Municipality', 'required')
			->set_rules('barangay1', 'Barangay', 'required')
			->set_rules('sbh1', 'Street/Building/House no.', 'required');

		if ($this->form_validation->run()) {

			$insert = $this->Common_model->insert('citizens', [
				'first_name' => $this->input->post('fname'),
				'last_name' => $this->input->post('lname'),
				'mid_name' => $this->input->post('mname'),
				'birthday' => $this->input->post('datebirth'),
				'gender' => $this->input->post('gender'),
			]);

			if ($insert) {
				$insert_add = $this->Common_model->insert('citezend_address', [
					'citezen_id' => $insert,
					'street' => $this->input->post('sbh1'),
					'brgy' => $this->input->post('barangay1'),
					'city' => $this->input->post('cityMun1'),
					'province' => $this->input->post('province1'),
				]);
				if ($insert_add) {
					//message('success','Succesfully added citezen.');
				}

				message('success', 'Succesfully added citezen.');
				redirect('citezen/create');
			} else {
				message('danger', 'failed to add citezen.');
				redirect('citezen/create');
			}
		} else {
			;
			/*
				            if(!empty($this->form_validation->error_array())){
				                foreach ($this->form_validation->error_array() as $key => $value) {
				                  //formErrors_message('danger', $key , $value);
				                    formErrors_message('danger', $key , $value);
				                }
				            }
			*/
		}

		$this->load->view('template/adminlte', array_merge([
			'page_view' => 'pages/citezen/create',
			'page_tittle' => 'CREATING OF CITEZENS',
			'page_webTittle' => 'CREATING OF CITEZENS',
		], $page_vars));
	}

	function getCityMun($prov_code = 0) {
		$city = $this->Address_model->getCityMuni($prov_code);
		$city1 = array();
		if (!empty($city)) {
			foreach ($city as $value) {
				$city1[$value->citymunCode] = $value->citymunDesc;
			}
		}

		echo json_encode(['cityMun' => $city1]);
	}

	function getBarangayAll($city_code = 0) {
		$barangay = $this->Address_model->getBarangay($city_code);
		$barangay1 = array();
		if (!empty($barangay)) {
			foreach ($barangay as $value) {
				$barangay1[$value->brgyCode] = $value->brgyDesc;
			}
		}

		echo json_encode(['barangay' => $barangay1]);
	}

	function edit($cit_id = '') {
		$page_vars = array();
		$this->loadJS('custom/citezen.js');
		$province = $this->Address_model->getprovince();
		$province1 = array();
		if (!empty($province)) {
			foreach ($province as $value) {
				$province1[$value->provCode] = $value->provDesc;
			}

		}
		$page_vars['allProvince'] = $province1;

		if ($cit_id != '') {
			$info = $this->Citezen_model->getEditInfo($cit_id);

			if (empty($info)) {
				return false;
			}

			$this->form_validation->set_rules('fname', 'First Name', 'required')
				->set_rules('lname', 'Last Name', 'required')
				->set_rules('mname', 'Middle Name', 'required')
				->set_rules('datebirth', 'Date of Birth', 'required')
				->set_rules('gender', 'Gender', 'required')
				->set_rules('province1', 'Province', 'required')
				->set_rules('cityMun1', 'City/Municipality', 'required')
				->set_rules('barangay1', 'Barangay', 'required')
				->set_rules('sbh1', 'Street/Building/House no.', 'required');

			if ($this->form_validation->run()) {
				$update = $this->Common_model->update('citizens', [
					'first_name' => $this->input->post('fname'),
					'last_name' => $this->input->post('lname'),
					'mid_name' => $this->input->post('mname'),
					'birthday' => $this->input->post('datebirth'),
					'gender' => $this->input->post('gender'),
				], ['citizen_id' => $info->citizen_id]);

				if ($update) {
					$insert_add = $this->Common_model->update('citezend_address', [
						'citezen_id' => $info->citizen_id,
						'street' => $this->input->post('sbh1'),
						'brgy' => $this->input->post('barangay1'),
						'city' => $this->input->post('cityMun1'),
						'province' => $this->input->post('province1'),
					], ['citezen_id' => $info->citizen_id]);
					if ($insert_add) {
						//message('success','Succesfully added citezen.');
					}

					message('success', 'Succesfully added citezen.');
					redirect('citezen/edit/' . $cit_id);
				} else {
					message('danger', 'failed to add citezen.');
					redirect('citezen/edit' . $cit_id);
				}
			}

			$page_vars['cit_info'] = $info;
			$this->load->view('template/adminlte', array_merge([
				'page_view' => 'pages/citezen/edit',
				'page_tittle' => 'EDITING OF CITEZENS',
				'page_webTittle' => 'EDITING OF CITEZENS',
			], $page_vars));
		}
	}

}