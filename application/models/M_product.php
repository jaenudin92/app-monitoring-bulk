<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_product extends CI_Model
{

	var $table = 'tbl_product';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->database();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function listProduct($postData = null)
	{
		$response = array();
		$table_name = 'tbl_product';
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		// $columnIndex = $postData['order'][0]['column']; // Column index
		// $columnName = $postData['columns'][$columnIndex]['data']; // Column name
		// $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		// $searchValue = $postData['search']['value']; // Search value

		$searchItemGroup = $postData['item_group'];
		$searchBrand = $postData['brand'];
		$searchStatus = $postData['status'];
		$searchDateFrom = $postData['datefrom'];
		$searchDateTo = $postData['dateto'];

		## Search 
		$searchQuery1 = "";
		$searchQuery2 = "";
		if ($searchItemGroup != '' && $searchBrand != '' && $searchDateFrom != '' && $searchDateTo != '') {
			$searchQuery1 .= " and (tgl_berlaku_sampai between '" . $searchDateFrom . "' and '" . $searchDateTo . "' ) and item_group = '" . $searchItemGroup . "' and brand = '" . $searchBrand . "' ";
		} else if ($searchItemGroup != '' && $searchBrand != '' && $searchDateFrom == '' && $searchDateTo == '') {
			$searchQuery1 .= " and item_group = '" . $searchItemGroup . "' and brand = '" . $searchBrand . "' ";
		} else if ($searchItemGroup != '' && $searchBrand == '' && $searchDateFrom == '' && $searchDateTo == '') {
			$searchQuery1 .= " and item_group = '" . $searchItemGroup . "' ";
		} else if ($searchItemGroup == '' && $searchBrand != '' && $searchDateFrom == '' && $searchDateTo == '') {
			$searchQuery1 .= " and brand = '" . $searchBrand . "' ";
		} else if ($searchItemGroup != '' && $searchBrand == '' && $searchDateFrom != '' && $searchDateTo != '') {
			$searchQuery1 .= " and (tgl_berlaku_sampai between '" . $searchDateFrom . "' and '" . $searchDateTo . "' ) and item_group = '" . $searchItemGroup . "' ";
		} else if ($searchItemGroup == '' && $searchBrand != '' && $searchDateFrom != '' && $searchDateTo != '') {
			$searchQuery1 .= " and (tgl_berlaku_sampai between '" . $searchDateFrom . "' and '" . $searchDateTo . "' ) and brand = '" . $searchBrand . "' ";
		} else if ($searchItemGroup == '' && $searchBrand == '' && $searchDateFrom != '' && $searchDateTo != '') {
			$searchQuery1 .= " and (tgl_berlaku_sampai between '" . $searchDateFrom . "' and '" . $searchDateTo . "' ) ";
		} else {
			$searchQuery1 .= "";
		}

		if ($searchStatus != '') {
			$searchQuery2 .= " and statusproduct = '" . $searchStatus . "' ";
		} else {
			$searchQuery2 .= "";
		}

		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$records = $this->db->get($table_name)->row();
		$totalRecords = $records->allcount;

		## Total number of record with filtering
		$records = $this->db->query("
			select count(*) as allcount from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product where 1=1 " . $searchQuery1 . "
			) a where 1=1 " . $searchQuery2 . "
			")->row();
		$totalRecordwithFilter = $records->allcount;

		## Fetch records
		$records = $this->db->query("select * from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product where 1=1 " . $searchQuery1 . "
			) a where 1=1 " . $searchQuery2 . " order by id desc limit " . $start . "," . $rowperpage)->result();

		$data = array();

		foreach ($records as $key => $record) {
			$data[] = array(
				'action' => '<div class="dropdown">
							<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
							<i class="bx bx-dots-vertical-rounded" style="font-size:23px"></i>
							</button>
							<div class="dropdown-menu">
							<a class="dropdown-item" href="javascript:void(0);" onclick="editProduct(' . "'" . $record->id . "'" . ')">
							<i class="bx bx-edit-alt me-1"></i> Edit</a>
							<a class="dropdown-item" href="javascript:void(0);" onclick="deleteProduct(' . "'" . $record->id . "'" . ')">
							<i class="bx bx-trash me-1"></i> Delete</a>
							</div>
							</div>',
				'item_group' => $record->item_group,
				'kode_item' => $record->kode_item,
				'kode_standar' => $record->kode_standar,
				'nama_item' => $record->nama_item,
				'brand' => $record->brand,
				'no_batch' => $record->no_batch,
				'formula' => $record->formula,
				'keterangan' => $record->keterangan,
				'alokasi' => $record->alokasi,
				'koordinat' => $record->koordinat,
				'tgl_berlaku_mulai' => $record->tgl_berlaku_mulai,
				'tgl_berlaku_sampai' => $record->tgl_berlaku_sampai,
				'peminjam' => $record->peminjam,
				'perpanjangan_ke' => $record->perpanjangan_ke,
				'packaging' => $record->packaging,
				'jumlah' => $record->jumlah,
				'expired' => $record->expired,
				'status' => $record->statusproduct

			);
		}

		## Response
		$response = array(
			"draw" => intval($draw),
			"recordsTotal" => $totalRecordwithFilter,
			"recordsFiltered" => $totalRecords,
			"data" => $data
		);

		return $response;
	}


	public function getdataproduct($postData)
	{


		$searchItemGroup = $postData['itemgroup'];
		$searchBrand = $postData['brand'];
		$searchStatus = $postData['status'];
		$searchDateFrom = $postData['datefrom'];
		$searchDateTo = $postData['dateto'];

		$searchQuery1 = "";
		$searchQuery2 = "";
		if ($searchItemGroup <> '' && $searchBrand <> '' && $searchDateFrom <> '' && $searchDateTo <> '') {
			$searchQuery1 .= " and (tgl_berlaku_sampai between '" . $searchDateFrom . "' and '" . $searchDateTo . "' ) and item_group = '" . $searchItemGroup . "' and brand = '" . $searchBrand . "' ";
		} else if ($searchItemGroup <> '' && $searchBrand <> '' && $searchDateFrom == '' && $searchDateTo == '') {
			$searchQuery1 .= " and item_group = '" . $searchItemGroup . "' and brand = '" . $searchBrand . "' ";
		} else if ($searchItemGroup <> '' && $searchBrand == '' && $searchDateFrom == '' && $searchDateTo == '') {
			$searchQuery1 .= " and item_group = '" . $searchItemGroup . "' ";
		} else if ($searchItemGroup == '' && $searchBrand != '' && $searchDateFrom == '' && $searchDateTo == '') {
			$searchQuery1 .= " and brand = '" . $searchBrand . "' ";
		} else if ($searchItemGroup <> '' && $searchBrand == '' && $searchDateFrom <> '' && $searchDateTo <> '') {
			$searchQuery1 .= " and (tgl_berlaku_sampai between '" . $searchDateFrom . "' and '" . $searchDateTo . "' ) and item_group = '" . $searchItemGroup . "' ";
		} else if ($searchItemGroup == '' && $searchBrand <> '' && $searchDateFrom <> '' && $searchDateTo <> '') {
			$searchQuery1 .= " and (tgl_berlaku_sampai between '" . $searchDateFrom . "' and '" . $searchDateTo . "' ) and brand = '" . $searchBrand . "' ";
		} else if ($searchItemGroup == '' && $searchBrand == '' && $searchDateFrom <> '' && $searchDateTo <> '') {
			$searchQuery1 .= " and (tgl_berlaku_sampai between '" . $searchDateFrom . "' and '" . $searchDateTo . "' ) ";
		} else {
			$searchQuery1 .= "";
		}

		if ($searchStatus != '') {
			$searchQuery2 .= " and statusproduct = '" . $searchStatus . "' ";
		} else {
			$searchQuery2 .= "";
		}

		$records = $this->db->query("select * from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product where 1=1 " . $searchQuery1 . "
			) a where 1=1 " . $searchQuery2 . " order by id ")->result();

		return $records;
	}

	public function add_batch($data)
	{
		return $this->db->insert_batch($this->table, $data);
	}
}
