<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        if ($this->session->userdata('status') ==  "logged") {
            redirect(base_url());
        }
    }

	public function index()
	{
		$this->load->view('login');
	}

	public function process()
	{
        $this->form_validation->set_rules("username","Username","required");
        $this->form_validation->set_rules("password","Password","required");
        if ($this->form_validation->run() == true ) {

            $usr    = strtolower(trim($this->input->post('username')));
            $pwd    = md5($this->input->post('password'));
            $cekusr = $this->db->get_where('tbl_user', ['username' => $usr])->num_rows();
            $cekpwd = $this->db->get_where('tbl_user', ['username' => $usr,'password' => $pwd])->num_rows();

            if ($cekusr < 1 && $cekpwd < 1) {
                $response = array(
                    'error' => true,
                    'errdetail' => 'errup',
                    'msg'      => 'Username dan password salah!',
                );
            }else if ($cekusr < 1) {
                $response = array(
                    'error' => true,
                    'errdetail' => 'erru',
                    'msg'       => 'Username salah!'
                );
            }else if ($cekpwd < 1) {
                $response = [
                    'error' => true,
                    'errdetail' => 'errp',
                    'msg'       => 'Password salah!'
                ];
            }else{
                $datauser = $this->db->get_where('tbl_user', ['username' => $usr,'password' => $pwd])->row_array();
                $data = [
                    'id'        => $datauser['id'],
                    'status'    => 'logged'
                ];
                $this->session->set_userdata($data);
                $response = [
                    'success' => true,
                    'url' => base_url()
                ];
            }
        }else{
            $response = [
                'error' => true,
                'username_error' => form_error('username'),
                'password_error' => form_error('password')
            ];
        }
        echo json_encode($response);
	}
}
