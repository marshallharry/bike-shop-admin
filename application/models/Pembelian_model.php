<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Pembelian_model extends CI_Model {

	var $start = 0;
    var $limit = 10;
    var $page = 0;
	var $found_row = 0;

	function __construct() 
	{
		parent::__construct();        
    }	

    public function get_header_pembelian($from, $to)
	{
		$this->db->where('Tanggal_Beli >=', $from);
		$this->db->where('Tanggal_Beli <=', $to);
		
		$query = $this->db->get('header_pembelian');
		$result = $query->result();
		return $result;
	}

	public function get_header_pembelian_by_id($id)
	{
		$this->db->where('ID', $id);
		
		$query = $this->db->get('header_pembelian');
		$result = $query->result();
		if(empty($result))
			return null;
		return $result[0];
	}

	public function get_detail_pembelian($headerid, $id = null)
	{
		if($id != null) 
		{
			$this->db->select('detail_pembelian.ID, detail_pembelian.Nama_Barang, detail_pembelian.Modal_Barang, detail_pembelian.Jumlah, detail_pembelian.Barang_ID');
			$this->db->from('detail_pembelian');
			$this->db->where('detail_pembelian.ID', $id);
			$query = $this->db->get();
			$result = $query->result();
			
			if(empty($result))
				return null;
			return $result[0];
		}

		$this->db->select('detail_pembelian.ID, detail_pembelian.Nama_Barang, detail_pembelian.Modal_Barang, detail_pembelian.Jumlah, detail_pembelian.Barang_ID');
		$this->db->from('detail_pembelian');
		$this->db->where('detail_pembelian.Header_ID', $headerid);
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}

    public function add_header_pembelian($supplier, $buydate, $tempo, $grandTotal, $lunas, $lunasdate, $payment) {
    	$param = array(
			'Nama_Supplier' => $supplier,
			'Tanggal_Beli' => $buydate,
			'Jatuh_Tempo' => $tempo,
			'Total' => $grandTotal,
			'Status' => $lunas,
			'Tanggal_Lunas' => $lunasdate,
			'Payment' => $payment
			);
		$this->db->insert('header_pembelian', $param);	
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
    }

    public function add_detail_pembelian($id_barang, $jumlah, $headerid, $modal, $nama) {
    	$param = array(
			'Header_ID' => $headerid,
			'Barang_ID' => $id_barang,
			'Jumlah' => $jumlah,
			'Modal_Barang' => $modal,
			'Nama_Barang' => $nama
			);
		$this->db->insert('detail_pembelian', $param);
    }

    public function update_header_pembelian_total($headerid, $grandTotal) {
    	$param = array(
			'Total' => $grandTotal
			);
		$this->db->where('ID', $headerid);
		$this->db->update('header_pembelian', $param); 
    }

    public function paid_off($id, $tanggal, $payment) {
    	$param = array(
			'Tanggal_Lunas' => $tanggal,
			'Status' => 'lunas',
			'Payment' => $payment
			);
		$this->db->where('ID', $id);
		$this->db->update('header_pembelian', $param); 
    }

    public function remove_pembelian($id) {
		$this->db->delete('header_pembelian', array('ID' => $id));
		$this->db->delete('detail_pembelian', array('Header_ID' => $id));
	}

	public function update_detail_pembelian($id, $amount) {
    	$param = array(
			'Jumlah' => $amount
			);
		$this->db->where('ID', $id);
		$this->db->update('detail_pembelian', $param); 
    }

    public function remove_detail_pembelian($id) {
		$this->db->delete('detail_pembelian', array('ID' => $id));
	}
}

?>