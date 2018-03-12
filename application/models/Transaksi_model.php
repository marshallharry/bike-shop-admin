<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Transaksi_model extends CI_Model {

	var $start = 0;
    var $limit = 10;
    var $page = 0;
	var $found_row = 0;

	function __construct() 
	{
		parent::__construct();        
    }	

	public function get_non_tunai($from, $to) {
    	$this->db->where('Tanggal >=', $from);
		$this->db->where('Tanggal <=', $to);
		
		$query = $this->db->get('transaksi_non_tunai');
		$result = $query->result();
		return $result;
    }

    public function add_non_tunai($tanggal, $status, $jumlah, $saldo)
	{
		$param = array(
			'Tanggal' => $tanggal,
			'Status' => $status,
			'Jumlah' => $jumlah,
			'Saldo' => $saldo
			);
		$this->db->insert('transaksi_non_tunai',	$param);	
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	public function get_last_saldo() {
		$this->db->order_by('ID', 'desc');
		$this->db->limit(1);
     	$result = $this->db->get('transaksi_non_tunai')->result();
     	if(empty($result)) {
     		return 0;
     	}
     	else {
     		return $result[0]->Saldo;
     	}
	}

    public function get_tunai($from, $to) {
    	$this->db->where('Tanggal >=', $from);
		$this->db->where('Tanggal <=', $to);
		
		$query = $this->db->get('transaksi_tunai');
		$result = $query->result();
		return $result;
    }

    public function add_tunai($tanggal, $status, $jumlah, $saldo)
	{
		$param = array(
			'Tanggal' => $tanggal,
			'Status' => $status,
			'Jumlah' => $jumlah,
			'Saldo' => $saldo
			);
		$this->db->insert('transaksi_tunai',	$param);	
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	public function get_last_saldo_tunai() {
		$this->db->order_by('Tanggal', 'desc');
		$this->db->order_by('Status', 'desc');
		$this->db->limit(1);
     	$result = $this->db->get('transaksi_tunai')->result();
     	if(empty($result)) {
     		return 0;
     	}
     	else {
     		return $result[0]->Saldo;
     	}
	}
}

?>