<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->model('m_product','product');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('product/product');
		$this->load->view('templates/footer');
	}

	public function Inputproduct()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('product/Inputproduct');
		$this->load->view('templates/footer');
	}

	public function get_list_item_group()
	{
		$list = $this->db->query("select * from tbl_item_group")->result();
		echo json_encode($list);

	}

	public function get_list_brand()
	{
		$list = $this->db->query("select * from tbl_brand")->result();
		echo json_encode($list);

	}

	public function get_list_koordinat()
	{
		$list = $this->db->query("select * from tbl_koordinat")->result();
		echo json_encode($list);

	}

	public function getlistProduct()
	{
		$postData = $this->input->post();
		$result = $this->product->listProduct($postData);
		echo json_encode($result);
	}

	function beda_waktu($date1, $date2, $format = false) 
	{
		$diff = date_diff( date_create($date1), date_create($date2) );
		if ($format)
			return $diff->format($format);

		return array('y' => $diff->y,
			'm' => $diff->m,
			'd' => $diff->d,
			'h' => $diff->h,
			'i' => $diff->i,
			's' => $diff->s
		);
	}

	function hitungexpired($date1, $date2, $format = false) 
	{
		$diff = date_diff( date_create($date1), date_create($date2) );
		if ($format)
			return $diff->format($format);

		return array('y' => $diff->format("%R%y"),
			'm' => $diff->format("%R%m"),
			'd' => $diff->format("%R%d"),
			'h' => $diff->format("%R%h"),
			'i' => $diff->format("%R%i"),
			's' => $diff->format("%R%s")
		);
	}

	public function add_product()
	{
		$this->_validate();

		$tgl_m = $this->input->post('tgl_berlaku_mulai');
		$tgl_s = $this->input->post('tgl_berlaku_sampai');

		$selisihwaktu = $this->beda_waktu($tgl_m,$tgl_s);

		$tahun = $selisihwaktu['y'];
		$bulan = $selisihwaktu['m'];
		$hari = $selisihwaktu['d'];

		if ($tahun > 0 && $bulan > 0 && $hari > 0) {
			$expirednew = $tahun.' Thn '.$bulan.' Bln '.$hari.' Hari';
		}else if ($tahun > 0 && $bulan > 0 && $hari == 0) {
			$expirednew = $tahun.' Thn '.$bulan.' Bln';
		}else if ($tahun > 0 && $bulan == 0 && $hari == 0) {
			$expirednew = $tahun.' Thn';
		}else if ($tahun == 0 && $bulan > 0 && $hari == 0) {
			$expirednew = $bulan.' Bln';
		}else if ($tahun == 0 && $bulan > 0 && $hari > 0) {
			$expirednew = $bulan.' Bln '. $hari.' Hari';
		}else{
			$expirednew = $hari.' Hari';
		}

		$data = array(
			'item_group' => $this->input->post('item_group'),
			'kode_item' => strtoupper($this->input->post('kode_item')),
			'kode_standar' => strtoupper($this->input->post('kode_standar')),
			'nama_item' => ucwords($this->input->post('nama_item')),
			'brand' => $this->input->post('brand'),
			'no_batch' => strtoupper($this->input->post('no_batch')),
			'formula' => strtoupper($this->input->post('formula')),
			'keterangan' => $this->input->post('keterangan'),
			'alokasi' => strtoupper($this->input->post('alokasi')),
			'koordinat' => $this->input->post('koordinat'),
			'tgl_berlaku_mulai' => $this->input->post('tgl_berlaku_mulai'),
			'tgl_berlaku_sampai' => $this->input->post('tgl_berlaku_sampai'),
			'peminjam' => ucwords($this->input->post('peminjam')),
			'perpanjangan_ke' => $this->input->post('perpanjangan_ke'),
			'packaging' => $this->input->post('packaging'),
			'jumlah' => $this->input->post('jumlah'),
			'expired' => $expirednew,
			'status' => 'Aktif'
		);

		// var_dump($data);
		// die();

		$insert = $this->product->save($data);
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function edit_product($id)
	{
		$data = $this->product->get_by_id($id);
		echo json_encode($data);
	}

	public function update_product()
	{
		$this->_validateupdate();
		$selisihwaktu = $this->beda_waktu($this->input->post('tglmulai'),$this->input->post('tglsampai'));

		$tahun = $selisihwaktu['y'];
		$bulan = $selisihwaktu['m'];
		$hari = $selisihwaktu['d'];

		if ($tahun > 0 && $bulan > 0 && $hari > 0) {
			$expirednew = $tahun.' Thn '.$bulan.' Bln '.$hari.' Hari';
		}else if ($tahun > 0 && $bulan > 0 && $hari == 0) {
			$expirednew = $tahun.' Thn '.$bulan.' Bln';
		}else if ($tahun > 0 && $bulan == 0 && $hari == 0) {
			$expirednew = $tahun.' Thn';
		}else if ($tahun == 0 && $bulan > 0 && $hari == 0) {
			$expirednew = $bulan.' Bln';
		}else if ($tahun == 0 && $bulan > 0 && $hari > 0) {
			$expirednew = $bulan.' Bln '. $hari.' Hari';
		}else{
			$expirednew = $hari.' Hari';
		}

		$data = array(
			'tgl_berlaku_mulai' => $this->input->post('tglmulai'),
			'tgl_berlaku_sampai' => $this->input->post('tglsampai'),
			'perpanjangan_ke' => $this->input->post('perpanjangan'),
			'jumlah' => $this->input->post('jmlh'),
			'status' => $this->input->post('statusproduct'),
			'expired' => $expirednew
		);
		$this->product->update(array('id' => $this->input->post('id')), $data);
		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function delete_product($id)
	{
		$this->product->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$this->form_validation->set_rules("item_group","Item Group","required");
		$this->form_validation->set_rules("kode_item","Kode Item","required|trim|min_length[2]");
		$this->form_validation->set_rules("kode_standar","Kode Standart","required|trim|min_length[2]");
		$this->form_validation->set_rules("nama_item","Nama Item","required|trim|min_length[2]");
		$this->form_validation->set_rules("brand","Brand","required");
		$this->form_validation->set_rules("no_batch","No Batch","required|trim|min_length[2]");
		$this->form_validation->set_rules("formula","Formula","required|trim|min_length[2]");
		$this->form_validation->set_rules("keterangan","Keterangan","required|trim|min_length[2]");
		$this->form_validation->set_rules("alokasi","Aloksi","required|trim|min_length[1]");
		$this->form_validation->set_rules("koordinat","Koornidat","required");
		$this->form_validation->set_rules("tgl_berlaku_mulai","Tanggal Berlaku Mulai","required|trim");
		$this->form_validation->set_rules("tgl_berlaku_sampai","Tanggal Berlaku Sampai","required|trim");
		$this->form_validation->set_rules("packaging","Packaging","required");
		$this->form_validation->set_rules("jumlah","Jumlah","required");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'item_group_error' => form_error('item_group'),
				'kode_item_error' => form_error('kode_item'),
				'kode_standar_error' => form_error('kode_standar'),
				'nama_item_error' => form_error('nama_item'),
				'brand_error' => form_error('brand'),
				'no_batch_error' => form_error('no_batch'),
				'formula_error' => form_error('formula'),
				'keterangan_error' => form_error('keterangan'),
				'alokasi_error' => form_error('alokasi'),
				'koordinat_error' => form_error('koordinat'),
				'tgl_berlaku_mulai_error' => form_error('tgl_berlaku_mulai'),
				'tgl_berlaku_sampai_error' => form_error('tgl_berlaku_sampai'),
				'packaging_error' => form_error('packaging'),
				'jumlah_error' => form_error('jumlah')
			];

			echo json_encode($response);
			exit();     
		}

	}

	private function _validateupdate()
	{
		$this->form_validation->set_rules("tglmulai","Tanggal Berlaku Mulai","required|trim");
		$this->form_validation->set_rules("tglsampai","Tanggal Berlaku Sampai","required|trim");
		$this->form_validation->set_rules("perpanjangan","Perpanjangan","required");
		$this->form_validation->set_rules("jmlh","Jumlah","required");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'tglmulai_error' => form_error('tglmulai'),
				'tglsampai_error' => form_error('tglsampai'),
				'perpanjangan_error' => form_error('perpanjangan'),
				'jmlh_error' => form_error('jmlh')
			];

			echo json_encode($response);
			exit();     
		}

	}

	public function exportProduct(){
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel

		$postData = [
			'itemgroup' => $this->input->get('item_group'),
			'brand' => $this->input->get('brand'),
			'status' => $this->input->get('status'),
			'datefrom' => $this->input->get('datefrom'),
			'dateto' => $this->input->get('dateto')
		];

		$dataproducts = $this->product->getdataproduct($postData);

		// var_dump($dataproducts);
		// die();

		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];
		$sheet->setCellValue('A1', "LAPORAN DATA BULK RND"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A1:R1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('B3', "ITEM GROUP"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('C3', "KODE ITEM"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('D3', "KODE STANDART"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('E3', "NAMA ITEM"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('F3', "BRAND"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('G3', "NO BATCH"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('H3', "FORMULA"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('I3', "KETERANGAN"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('J3', "ALOKASI"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('K3', "KOORDINAT"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('L3', "TGL BERLAKU MULAI"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('M3', "TGL BERLAKU SAMPAI"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('N3', "PEMINJAM"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('O3', "PERPANJANGAN KE"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('P3', "PACKAGING"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('Q3', "JUMLAH"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('R3', "EXPIRED"); // Set kolom E3 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);
		$sheet->getStyle('I3')->applyFromArray($style_col);
		$sheet->getStyle('J3')->applyFromArray($style_col);
		$sheet->getStyle('K3')->applyFromArray($style_col);
		$sheet->getStyle('L3')->applyFromArray($style_col);
		$sheet->getStyle('M3')->applyFromArray($style_col);
		$sheet->getStyle('N3')->applyFromArray($style_col);
		$sheet->getStyle('O3')->applyFromArray($style_col);
		$sheet->getStyle('P3')->applyFromArray($style_col);
		$sheet->getStyle('Q3')->applyFromArray($style_col);
		$sheet->getStyle('R3')->applyFromArray($style_col);
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($dataproducts as $data){ // Lakukan looping pada variabel siswa
			$sheet->setCellValue('A'.$numrow, $no);
			$sheet->setCellValue('B'.$numrow, $data->item_group);
			$sheet->setCellValue('C'.$numrow, $data->kode_item);
			$sheet->setCellValue('D'.$numrow, $data->kode_standar);
			$sheet->setCellValue('E'.$numrow, $data->nama_item);
			$sheet->setCellValue('F'.$numrow, $data->brand);
			$sheet->setCellValue('G'.$numrow, $data->no_batch);
			$sheet->setCellValue('H'.$numrow, $data->formula);
			$sheet->setCellValue('I'.$numrow, $data->keterangan);
			$sheet->setCellValue('J'.$numrow, $data->alokasi);
			$sheet->setCellValue('K'.$numrow, $data->koordinat);
			$sheet->setCellValue('L'.$numrow, $data->tgl_berlaku_mulai);
			$sheet->setCellValue('M'.$numrow, $data->tgl_berlaku_sampai);
			$sheet->setCellValue('N'.$numrow, $data->peminjam);
			$sheet->setCellValue('O'.$numrow, $data->perpanjangan_ke);
			$sheet->setCellValue('P'.$numrow, $data->packaging);
			$sheet->setCellValue('Q'.$numrow, $data->jumlah);
			$sheet->setCellValue('R'.$numrow, $data->expired);
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			if ($data->statusproduct == 'Warning') {
				$sheet->getStyle('A'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('B'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('C'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('D'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('E'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('F'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('G'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('H'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('I'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('J'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('K'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('L'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('M'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('N'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('O'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('P'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('Q'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
				$sheet->getStyle('R'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFAB00');
			}else if ($data->statusproduct == 'Expired'){
				$sheet->getStyle('A'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('B'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('C'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('D'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('E'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('F'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('G'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('H'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('I'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('J'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('K'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('L'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('M'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('N'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('O'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('P'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('Q'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
				$sheet->getStyle('R'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF3E1D');
			}else if ($data->statusproduct == 'Non Aktif'){
				$sheet->getStyle('A'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('B'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('C'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('D'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('E'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('F'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('G'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('H'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('I'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('J'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('K'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('L'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('M'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('N'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('O'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('P'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('Q'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
				$sheet->getStyle('R'.$numrow)->applyFromArray($style_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C1C1C1');
			}else{
				$sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('K'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('L'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('M'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('N'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('O'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('P'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('Q'.$numrow)->applyFromArray($style_row);
				$sheet->getStyle('R'.$numrow)->applyFromArray($style_row);

			}
			

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
	    $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
	    $sheet->getColumnDimension('B')->setAutoSize(true); // Set width kolom B
	    $sheet->getColumnDimension('C')->setAutoSize(true); // Set width kolom C
	    $sheet->getColumnDimension('D')->setAutoSize(true); // Set width kolom D
	    $sheet->getColumnDimension('E')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('F')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('G')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('H')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('I')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('J')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('K')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('L')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('M')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('N')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('O')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('P')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('Q')->setAutoSize(true); // Set width kolom E
	    $sheet->getColumnDimension('R')->setAutoSize(true); // Set width kolom E

	    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	    $sheet->getDefaultRowDimension()->setRowHeight(-1);
	    // Set orientasi kertas jadi LANDSCAPE
	    $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
	    // Set judul file excel nya
	    $sheet->setTitle("Laporan Data Bulk");
	    // Proses file excel
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment; filename="DATA BULK RND"'.date("Y-m-d").'".xlsx"'); // Set nama file excel nya
	    header('Cache-Control: max-age=0');
	    $writer = new Xlsx($spreadsheet);
	    $writer->save('php://output');

	    set_time_limit(30);
        exit;

	}


	public function uploadproduct()
	{
		$path 		= './assets/fileupload/';
		$response 	= [];
		$error = false;
		$this->upload_config($path);
		if (!$this->upload->do_upload('fileupload')) {
			$response = [
				'error' => true,
				'message' => $this->upload->display_errors()
			];
		} else {
			$file_data 	= $this->upload->data();
			$file_name 	= $path.$file_data['file_name'];
			$arr_file 	= explode('.', $file_name);
			$extension 	= end($arr_file);
			if('csv' == $extension) {
				$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet 	= $reader->load($file_name);
			$sheet_data 	= $spreadsheet->getActiveSheet()->toArray();
			$list 			= [];
			foreach($sheet_data as $key => $val) {
				if($key != 0) {

					$checkitemgroup = $this->db->query("select * from tbl_item_group where item_group = '$val[1]' ")->num_rows();
					$checkbrand = $this->db->query("select * from tbl_brand where brand = '$val[5]' ")->num_rows();
					$checkkoordinat = $this->db->query("select * from tbl_koordinat where koordinat = '$val[10]' ")->num_rows();

					if ($checkitemgroup < 1 || $checkbrand < 1 || $checkkoordinat < 1) {
						$error = true;
					}else{
						$selisihwaktu = $this->beda_waktu($val[11],$val[12]);

						$tahun = $selisihwaktu['y'];
						$bulan = $selisihwaktu['m'];
						$hari = $selisihwaktu['d'];

						if ($tahun > 0 && $bulan > 0 && $hari > 0) {
							$expired = $tahun.' Thn '.$bulan.' Bln '.$hari.' Hari';
						}else if ($tahun > 0 && $bulan > 0 && $hari == 0) {
							$expired = $tahun.' Thn '.$bulan.' Bln';
						}else if ($tahun > 0 && $bulan == 0 && $hari == 0) {
							$expired = $tahun.' Thn';
						}else if ($tahun == 0 && $bulan > 0 && $hari == 0) {
							$expired = $bulan.' Bln';
						}else if ($tahun == 0 && $bulan > 0 && $hari > 0) {
							$expired = $bulan.' Bln '. $hari.' Hari';
						}else{
							$expired = $hari.' Hari';
						}
						
						$list [] = [
								'item_group' => strtoupper(trim($val[1])),
								'kode_item' => strtoupper(trim($val[2])),
								'kode_standar' => strtoupper(trim($val[3])),
								'nama_item' => ucwords(trim($val[4])),
								'brand' => trim($val[5]),
								'no_batch' => strtoupper(trim($val[6])),
								'formula' => strtoupper(trim($val[7])),
								'keterangan' => $val[8],
								'alokasi' => strtoupper(trim($val[9])),
								'koordinat' => $val[10],
								'tgl_berlaku_mulai' => $val[11],
								'tgl_berlaku_sampai' => $val[12],
								'peminjam' => $val[13],
								'perpanjangan_ke' => $val[14],
								'packaging' => $val[15],
								'jumlah' => $val[16],
								'expired' => $expired,
								'status' => 'Aktif'
							];
					}

				}
			}
			// var_dump($list);

			if(file_exists($file_name))
				unlink($file_name);
			if ($error) {
				$response = [
							'error' => true,
							'message' => "Please check your data upload no match on masterdata."
						];
			}else{
				if(count($list) > 0) {
					$result 	= $this->product->add_batch($list);
					if($result) {
						$response = [
							'success' 	=> True
						];
					} else {
						$response = [
							'error' 	=> true,
							'message' 	=> "Something went wrong. Please try again."
						];
					}
				} else {
					$response = [
						'error' => true,
						'message' => "No new record is found."
					];
				}
			}
		}
		echo json_encode($response);

	}

	public function upload_config($path) {
		if (!is_dir($path)) 
			mkdir($path, 0777, TRUE);		
		$config['upload_path'] 		= './'.$path;		
		$config['allowed_types'] 	= 'csv|CSV|xlsx|XLSX|xls|XLS';
		$config['max_filename']	 	= '255';
		$config['encrypt_name'] 	= TRUE;
		$config['max_size'] 		= 4096; 
		$this->load->library('upload', $config);
	}
}
