<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('Login'));
		}

		$this->load->model('m_home', 'home');
	}

	public function index()
	{
		$totalexpired = $this->home->getTotalExpired();
		$totalwarning = $this->home->getTotalWarning();
		$totalnonaktif = $this->home->getTotalNonAktif();

		$dataexpired = $this->home->getDataExpired();
		$datawarning = $this->home->getDataWarning();
		$datanonaktif = $this->home->getDataNonAktif();
		$masaexpired = $this->db->query("select masa from tbl_set_expired limit 1")->row_array();

		$data = [
			'totalexpired' => $totalexpired,
			'totalwarning' => $totalwarning,
			'totalnonaktif' => $totalnonaktif,
			'dataexpired' => $dataexpired,
			'datawarning' => $datawarning,
			'datanonaktif' => $datanonaktif,
			'masaexp' => $masaexpired['masa']
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('home/home');
		$this->load->view('templates/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('status');
		redirect('Login');
	}
}
