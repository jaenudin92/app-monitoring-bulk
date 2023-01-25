<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->model('m_user','user');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('user/user');
		$this->load->view('templates/footer');
	}

	public function list_user()
	{
		$list = $this->user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->nama_lengkap;
			$row[] = $user->username;
			$row[] = $user->level;
			$row[] = '<img src="'.base_url('assets/img/avatars/'.$user->foto).'" alt="Foto" style="width: 30px;">';

            //add html for action
			$row[] = ($user->level == 'Admin') ? '' : '<div class="dropdown">
			<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
			<i class="bx bx-dots-vertical-rounded"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:void(0);" onclick="editUser('."'".$user->id."'".')">
			<i class="bx bx-edit-alt me-1"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="deleteUser('."'".$user->id."'".')">
			<i class="bx bx-trash me-1"></i> Delete</a>
			</div>
			</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->user->count_all(),
			"recordsFiltered" => $this->user->count_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function add_user()
	{
		$this->_validate();

		$config['upload_path']          = './assets/img/avatars/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto')) {

			$gambar = $this->upload->data();
			$foto = $gambar['file_name'];

			$data = array(
				'nama_lengkap' => ucwords($this->input->post('fullname')),
				'username' => strtolower($this->input->post('username')),
				'password' => md5($this->input->post('password')),
				'level' => $this->input->post('level'),
				'foto' => $foto
			);
			$insert = $this->user->save($data);
		}else{
			$data = array(
				'nama_lengkap' => ucwords($this->input->post('fullname')),
				'username' => strtolower($this->input->post('username')),
				'password' => md5($this->input->post('password')),
				'level' => $this->input->post('level'),
				'foto' => 'default.png'
			);
			$insert = $this->user->save($data);
		}
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function edit_user($id)
	{
		$data = $this->user->get_by_id($id);
	        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function update_user()
	{
		$this->_validateupdate();
		$id = $this->input->post('id');

		if ($this->input->post('password') != '') {
			$config['upload_path']          = './assets/img/avatars/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				$gambar = $this->upload->data();
				$foto = $gambar['file_name'];

				$fotouser = $this->user->get_by_id($id);

		        if ($fotouser->foto != 'default.png') {
		            // hapus
		            unlink(FCPATH.'./assets/img/avatars/'.$fotouser->foto);
		        }

				$data = array(
					'nama_lengkap' => ucwords($this->input->post('fullname')),
					'password' => md5($this->input->post('password')),
					'level' => $this->input->post('level'),
					'foto' => $foto
				);
				$this->user->update(array('id' => $id), $data);
			}else{
				$data = array(
					'nama_lengkap' => ucwords($this->input->post('fullname')),
					'password' => md5($this->input->post('password')),
					'level' => $this->input->post('level')
				);
				$this->user->update(array('id' => $this->input->post('id')), $data);
			}
		}else{
			$config['upload_path']          = './assets/img/avatars/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				$gambar = $this->upload->data();
				$foto = $gambar['file_name'];

				$fotouser = $this->user->get_by_id($id);

		        if ($fotouser->foto != 'default.png') {
		            // hapus
		            unlink(FCPATH.'./assets/img/avatars/'.$fotouser->foto);
		        }

				$data = array(
					'nama_lengkap' => ucwords($this->input->post('fullname')),
					'level' => $this->input->post('level'),
					'foto' => $foto
				);
				$this->user->update(array('id' => $this->input->post('id')), $data);
			}else{
				$data = array(
					'nama_lengkap' => ucwords($this->input->post('fullname')),
					'level' => $this->input->post('level')
				);
				$this->user->update(array('id' => $id), $data);
			}

		}

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function delete_user($id)
	{
		$this->user->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$this->form_validation->set_rules("fullname","Fullname","required|trim|min_length[3]");
		$this->form_validation->set_rules("username","Username","required|trim|min_length[3]|is_unique[tbl_user.username]");
		$this->form_validation->set_rules("password","Password","required|trim|min_length[6]");
		$this->form_validation->set_rules("confirmpassword","Confirmation Password","required|trim|matches[password]|min_length[6]");
		$this->form_validation->set_rules("level","Level","required");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'fullname_error' => form_error('fullname'),
				'username_error' => form_error('username'),
				'password_error' => form_error('password'),
				'confirmpassword_error' => form_error('confirmpassword'),
				'level_error' => form_error('level')
			];

			echo json_encode($response);
			exit();     
		}

	}

	private function _validateupdate()
	{
		$this->form_validation->set_rules("fullname","Fullname","required|trim|min_length[3]");
		$this->form_validation->set_rules("password","Password","trim|min_length[6]");
		$this->form_validation->set_rules("confirmpassword","Confirmation Password","trim|matches[password]|min_length[6]");
		$this->form_validation->set_rules("level","Level","required");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'fullname_error' => form_error('fullname'),
				'password_error' => form_error('password'),
				'confirmpassword_error' => form_error('confirmpassword'),
				'level_error' => form_error('level')
			];

			echo json_encode($response);
			exit();     
		}

	}
}
