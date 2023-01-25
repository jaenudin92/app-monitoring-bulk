<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koordinat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->model('m_koordinat','koordinat');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('koordinat/koordinat');
		$this->load->view('templates/footer');
	}

	public function list_koordinat()
	{
		$list = $this->koordinat->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $koordinat) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $koordinat->koordinat;
            //add html for action
			$row[] = '<div class="dropdown">
			<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
			<i class="bx bx-dots-vertical-rounded"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:void(0);" onclick="editKoordinat('."'".$koordinat->id."'".')">
			<i class="bx bx-edit-alt me-1"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="deleteKoordinat('."'".$koordinat->id."'".')">
			<i class="bx bx-trash me-1"></i> Delete</a>
			</div>
			</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->koordinat->count_all(),
			"recordsFiltered" => $this->koordinat->count_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function add_koordinat()
	{
		$this->_validate();
		$data = array(
			'koordinat' => ucwords($this->input->post('koordinat')),
		);
		$insert = $this->koordinat->save($data);
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function edit_koordinat($id)
	{
		$data = $this->koordinat->get_by_id($id);
		echo json_encode($data);
	}

	public function update_koordinat()
	{
		$this->_validate();
		$data = array(
			'koordinat' => ucwords($this->input->post('koordinat')),
		);
		$this->koordinat->update(array('id' => $this->input->post('id')), $data);
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function delete_koordinat($id)
	{
		$this->koordinat->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$this->form_validation->set_rules("koordinat","Koornidat","required|trim|min_length[2]|is_unique[tbl_koordinat.koordinat]");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'koordinat_error' => form_error('koordinat'),
			];

			echo json_encode($response);
			exit();     
		}

	}
}
