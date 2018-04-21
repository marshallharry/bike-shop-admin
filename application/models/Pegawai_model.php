<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Pegawai_model extends CI_Model {

	var $start = 0;
    var $limit = 10;
    var $page = 0;
	var $found_row = 0;

	function __construct() 
	{
		parent::__construct();        
    }	

	public function get_pegawai($id = NULL)
	{
		if( $id != NULL ) {
			$query = $this->db->get_where('pegawai', array('ID' => $id));
			$result = $query->result();
		}
		else {
			$query = $this->db->get('pegawai');
			$result = $query->result();
		}
		
		return $result;
	}

	public function add_pegawai($nama, $telp, $gaji)
	{
		$param = array(
			'Nama' => $nama,
			'Telp' => $telp,
			'Gaji' => $gaji
			);
		$this->db->insert('pegawai',	$param);	
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	public function update_pegawai($id, $nama, $telp, $gaji)
	{
		$param = array(
			'Nama' => $nama,
			'Telp' => $telp,
			'Gaji' => $gaji
			);
		$this->db->where('ID', $id);
		$this->db->update('pegawai', $param); 
	}

	public function remove_pegawai($id) {
		$this->db->delete('pegawai', array('ID' => $id));
	}

	public function absen_pegawai($id, $tanggal, $status, $keterangan)
	{
		$param = array(
			'Pegawai_ID' => $id,
			'Tanggal' => $tanggal,
			'Status' => $status,
			'Keterangan' => $keterangan
			);
		$this->db->insert('absensi', $param);
	}

	public function get_absensi($id)
	{
		$query = $this->db->get_where('absensi', array('Pegawai_ID' => $id));
		$result = $query->result();		
		
		return $result;
	}

	public function check_already_absen($id, $tanggal)
	{
		$query = $this->db->get_where('absensi', array('Pegawai_ID' => $id, 'Tanggal' => $tanggal));
		$result = $query->result();		
		
		return $result;
	}

	public function remove_absen($id) {
		$this->db->delete('absensi', array('ID' => $id));
	}

	public function add_hutang($id, $tanggal, $jumlah, $keterangan)
	{
		$param = array(
			'Pegawai_ID' => $id,
			'Tanggal' => $tanggal,
			'Jumlah' => $jumlah,
			'Status' => 'belum',
			'Sisa' => 0,
			'Keterangan' => $keterangan
			);
		$this->db->insert('hutang', $param);
	}

	public function get_hutang($id)
	{
		$query = $this->db->get_where('hutang', array('Pegawai_ID' => $id));
		$result = $query->result();		
		
		return $result;
	}

	public function get_hutang_by_id($id)
	{
		$query = $this->db->get_where('hutang', array('ID' => $id));
		$result = $query->result();		
		
		return $result;
	}

	public function lunas_hutang($id)
	{
		$param = array(
			'Status' => 'lunas',
			'Sisa' => 0
			);
		$this->db->where('ID', $id);
		$this->db->update('hutang', $param); 
	}

	public function lunas_hutang_sebagian($id, $jumlah)
	{
		$param = array(
			'Sisa' => $jumlah
			);
		$this->db->where('ID', $id);
		$this->db->update('hutang', $param); 
	}

	public function get_total_absen($id)
	{
		$sql = "SELECT COUNT(a.ID) AS Total FROM absensi a ".
				"WHERE a.Pegawai_ID = ".$id." AND MONTH(a.Tanggal) = MONTH(NOW()) ".
				"AND YEAR(a.Tanggal) = YEAR(NOW()) ".
				"AND a.Status = 'masuk' ";

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_total_hutang($id)
	{
		$sql = " SELECT SUM(h.Jumlah) AS Total FROM `hutang` h WHERE h.Pegawai_ID = ".$id." AND h.Status = 'belum' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function remove_hutang($id) {
		$this->db->delete('hutang', array('ID' => $id));
	}

	public function add_hutang_barang($id, $tanggal, $jumlah, $barangId, $nama, $modal, $harga)
	{
		$param = array(
			'Pegawai_ID' => $id,
			'Tanggal' => $tanggal,
			'Jumlah' => $jumlah,
			'Status' => 'belum',
			'Barang_ID' => $barangId,
			'Nama_Barang' => $nama,
			'Modal' => $modal,
			'Harga' => $harga
			);
		$this->db->insert('hutang_barang', $param);
	}

	public function get_hutang_barang($id)
	{
		$query = $this->db->get_where('hutang_barang', array('Pegawai_ID' => $id));
		$result = $query->result();		
		
		return $result;
	}

	public function get_hutang_barang_by_id($id)
	{
		$query = $this->db->get_where('hutang_barang', array('ID' => $id));
		$result = $query->result();		
		
		return $result;
	}

	public function lunas_hutang_barang($id)
	{
		$param = array(
			'Status' => 'lunas'
			);
		$this->db->where('ID', $id);
		$this->db->update('hutang_barang', $param); 
	}

	public function get_total_hutang_barang($id)
	{
		$sql = " SELECT SUM(h.Harga) AS Total FROM `hutang_barang` h WHERE h.Pegawai_ID = ".$id." AND h.Status = 'belum' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function remove_hutang_barang($id) {
		$this->db->delete('hutang_barang', array('ID' => $id));
	}
}

?>