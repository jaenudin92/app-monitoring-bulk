<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->model('m_brand', 'brand');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('brand/brand');
		$this->load->view('templates/footer');
	}

	public function list_brand()
	{
		$list = $this->brand->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $brand) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $brand->brand;
			//add html for action
			$row[] = '<div class="dropdown">
			<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
			<i class="bx bx-dots-vertical-rounded"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:void(0);" onclick="editBrand(' . "'" . $brand->id . "'" . ')">
			<i class="bx bx-edit-alt me-1"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="deleteBrand(' . "'" . $brand->id . "'" . ')">
			<i class="bx bx-trash me-1"></i> Delete</a>
			</div>
			</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->brand->count_all(),
			"recordsFiltered" => $this->brand->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function add_brand()
	{
		$this->_validate();
		$data = array(
			'brand' => ucwords($this->input->post('brand')),
		);
		$insert = $this->brand->save($data);
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function edit_brand($id)
	{
		$data = $this->brand->get_by_id($id);
		echo json_encode($data);
	}

	public function update_brand()
	{
		$this->_validate();
		$data = array(
			'brand' => ucwords($this->input->post('brand')),
		);
		$this->brand->update(array('id' => $this->input->post('id')), $data);
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function delete_brand($id)
	{
		$this->brand->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$this->form_validation->set_rules("brand", "Brand", "required|trim|min_length[2]|is_unique[tbl_brand.brand]");
		if ($this->form_validation->run() == false) {
			$response = [
				'error' => true,
				'brand_error' => form_error('brand'),
			];

			echo json_encode($response);
			exit();
		}
	}
}
