<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Penjualan_model extends CI_Model {

	var $start = 0;
    var $limit = 10;
    var $page = 0;
	var $found_row = 0;

	function __construct() 
	{
		parent::__construct();        
    }	

    public function get_header_penjualan($from, $to)
	{
		$this->db->where('Tanggal >=', $from);
		$this->db->where('Tanggal <=', $to);
		
		$query = $this->db->get('header_penjualan');
		$result = $query->result();
		return $result;
	}

	public function get_header_penjualan_by_id($id)
	{
		$this->db->where('ID', $id);
		
		$query = $this->db->get('header_penjualan');
		$result = $query->result();
		return $result[0];
	}

	public function get_detail_penjualan($headerid, $id = null)
	{
		if($id != null) 
		{
			$this->db->select('detail_penjualan.ID, detail_penjualan.Nama_Barang, detail_penjualan.Modal, detail_penjualan.Jumlah, detail_penjualan.Harga, detail_penjualan.Barang_ID');
			$this->db->from('detail_penjualan');
			$this->db->where('detail_penjualan.ID', $id);
			$query = $this->db->get();
			$result = $query->result();
			
			if(empty($result))
				return null;
			return $result[0];
		}

		$this->db->select('detail_penjualan.ID, detail_penjualan.Nama_Barang, detail_penjualan.Modal, detail_penjualan.Jumlah, detail_penjualan.Harga, detail_penjualan.Barang_ID');
		$this->db->from('detail_penjualan');
		$this->db->where('detail_penjualan.Header_ID', $headerid);
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}

    public function add_header_penjualan($selldate, $grandTotal) {
    	$param = array(
			'Tanggal' => $selldate,
			'Total' => $grandTotal
			);
		$this->db->insert('header_penjualan', $param);	
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
    }

    public function add_detail_penjualan($id_barang, $jumlah, $harga, $headerid, $modal, $nama) {
    	$param = array(
			'Header_ID' => $headerid,
			'Barang_ID' => $id_barang,
			'Jumlah' => $jumlah,
			'Harga' => $harga,
			'Modal' => $modal,
			'Nama_Barang' => $nama
			);
		$this->db->insert('detail_penjualan', $param);
    }

    public function update_header_penjualan_total($headerid, $grandTotal, $grandModal) {
    	$param = array(
			'Total' => $grandTotal,
			'Modal' => $grandModal
			);
		$this->db->where('ID', $headerid);
		$this->db->update('header_penjualan', $param); 
    }

    public function remove_penjualan($id) {
		$this->db->delete('header_penjualan', array('ID' => $id));
		$this->db->delete('detail_penjualan', array('Header_ID' => $id));
	}

	public function update_detail_penjualan($id, $amount) {
    	$param = array(
			'Jumlah' => $amount
			);
		$this->db->where('ID', $id);
		$this->db->update('detail_penjualan', $param); 
    }

    public function remove_detail_penjualan($id) {
		$this->db->delete('detail_penjualan', array('ID' => $id));
	}
}

?>