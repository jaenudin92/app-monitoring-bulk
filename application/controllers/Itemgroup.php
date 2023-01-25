<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemgroup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->model('m_itemgroup','itemgroup');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('itemgroup/itemgroup');
		$this->load->view('templates/footer');
	}

	public function list_itemgroup()
	{
		$list = $this->itemgroup->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $itemgroup) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $itemgroup->item_group;
            //add html for action
			$row[] = '<div class="dropdown">
			<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
			<i class="bx bx-dots-vertical-rounded"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:void(0);" onclick="editItemgroup('."'".$itemgroup->id."'".')">
			<i class="bx bx-edit-alt me-1"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="deleteItemgroup('."'".$itemgroup->id."'".')">
			<i class="bx bx-trash me-1"></i> Delete</a>
			</div>
			</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->itemgroup->count_all(),
			"recordsFiltered" => $this->itemgroup->count_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function add_itemgroup()
	{
		$this->_validate();
		$data = array(
			'item_group' => ucwords($this->input->post('itemgroup')),
		);
		$insert = $this->itemgroup->save($data);
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function edit_itemgroup($id)
	{
		$data = $this->itemgroup->get_by_id($id);
		echo json_encode($data);
	}

	public function update_itemgroup()
	{
		$this->_validate();
		$data = array(
			'item_group' => ucwords($this->input->post('itemgroup')),
		);
		$this->itemgroup->update(array('id' => $this->input->post('id')), $data);
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function delete_itemgroup($id)
	{
		$this->itemgroup->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$this->form_validation->set_rules("itemgroup","Item Group","required|trim|min_length[2]|is_unique[tbl_item_group.item_group]");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'itemgroup_error' => form_error('itemgroup'),
			];

			echo json_encode($response);
			exit();     
		}

	}
}
