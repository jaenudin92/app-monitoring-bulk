<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{

	var $table = 'tbl_product';
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->database();
	}

	public function getTotalExpired()
	{
		$records = $this->db->query("
			select * from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product
			) a where statusproduct = 'Expired'
			")->num_rows();

		return $records;
	}

	public function getTotalWarning()
	{
		$records = $this->db->query("
			select * from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product
			) a where statusproduct = 'Warning'
			")->num_rows();

		return $records;
	}

	public function getTotalNonAktif()
	{
		$records = $this->db->query("
			select * from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product
			) a where statusproduct = 'Non Aktif'
			")->num_rows();

		return $records;
	}

	public function getDataExpired()
	{
		$records = $this->db->query("
			select * from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product
			) a where statusproduct = 'Expired'
			")->result();

		return $records;
	}

	public function getDataWarning()
	{
		$records = $this->db->query("
			select * from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product
			) a where statusproduct = 'Warning'
			")->result();

		return $records;
	}

	public function getDataNonAktif()
	{
		$records = $this->db->query("
			select * from (
			select *,
			case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
			when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
			when status = 'Non Aktif' then status
			else status end as statusproduct
			from tbl_product
			) a where statusproduct = 'Non Aktif'
			")->result();

		return $records;
	}
}
