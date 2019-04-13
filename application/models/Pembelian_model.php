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
			$this->db->select('detail_pembelian.ID, detail_pembelian.Nama_Barang, detail_pembelian.Modal_Barang, detail_pembelian.Jumlah, detail_pembelian.Barang_ID, detail_pembelian.Diskon');
			$this->db->from('detail_pembelian');
			$this->db->where('detail_pembelian.ID', $id);
			$query = $this->db->get();
			$result = $query->result();
			
			if(empty($result))
				return null;
			return $result[0];
		}

		$this->db->select('detail_pembelian.ID, detail_pembelian.Nama_Barang, detail_pembelian.Modal_Barang, detail_pembelian.Jumlah, detail_pembelian.Barang_ID, detail_pembelian.Diskon');
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

    public function add_detail_pembelian($id_barang, $jumlah, $headerid, $modal, $nama, $diskon) {
    	$param = array(
			'Header_ID' => $headerid,
			'Barang_ID' => $id_barang,
			'Jumlah' => $jumlah,
			'Modal_Barang' => $modal,
			'Nama_Barang' => $nama,
			'Diskon' => $diskon
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

	public function get_retur($headerid)
	{
		$sql = " SELECT dp.ID AS 'Detail_ID', dp.Nama_Barang AS 'Detail_Nama', dp.Modal_Barang AS 'Detail_Modal', dp.Jumlah AS 'Detail_Jumlah', ".
				" rp.ID AS 'Retur_ID', rp.Nama AS 'Retur_Nama', rp.Modal AS 'Retur_Modal', rp.Jumlah AS 'Retur_Jumlah' ".
				" FROM detail_pembelian dp  ".
				" LEFT JOIN retur_pembelian rp ON dp.ID = rp.Detail_ID ".
				" WHERE dp.Header_ID = ".$headerid;

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function insert_retur($detail_id, $barang_id, $rnama, $rmodal, $rjumlah)
	{
		$param = array(
			'Detail_ID' => $detail_id,
			'Barang_ID' => $barang_id,
			'Jumlah' => $rjumlah,
			'Modal' => $rmodal,
			'Nama' => $rnama
			);
		$this->db->insert('retur_pembelian', $param);
	}

	public function update_retur($rid, $barang_id, $rnama, $rmodal, $rjumlah) {
    	$param = array(
			'Barang_ID' => $barang_id,
			'Jumlah' => $rjumlah,
			'Modal' => $rmodal,
			'Nama' => $rnama
			);
		$this->db->where('ID', $rid);
		$this->db->update('retur_pembelian', $param); 
    }
}

?>