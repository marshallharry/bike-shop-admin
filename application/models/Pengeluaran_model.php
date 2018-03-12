<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Pengeluaran_model extends CI_Model {

	var $start = 0;
    var $limit = 10;
    var $page = 0;
	var $found_row = 0;

	function __construct() 
	{
		parent::__construct();        
    }	

    public function get_pengeluaran($from, $to) {
    	$this->db->where('Tanggal >=', $from);
		$this->db->where('Tanggal <=', $to);
		
		$query = $this->db->get('pengeluaran');
		$result = $query->result();
		return $result;
    }

    public function get_tipe_pengeluaran($id = NULL)
	{
		if( $id != NULL ) {
			$query = $this->db->get_where('tipe_pengeluaran', array('ID' => $id));
			$result = $query->result();
		}
		else {
			$query = $this->db->get('tipe_pengeluaran');
			$result = $query->result();
		}
		
		return $result;
	}

    public function add_tipe_pengeluaran($nama, $total)
	{
		$param = array(
			'Nama' => $nama,
			'Total' => $total
			);
		$this->db->insert('tipe_pengeluaran',	$param);	
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	public function update_tipe_pengeluaran($id, $nama, $total)
	{
		$param = array(
			'Nama' => $nama,
			'Total' => $total
			);
		$this->db->where('ID', $id);
		$this->db->update('tipe_pengeluaran', $param); 
	}

	public function add_pengeluaran($tanggal, $keterangan, $total)
	{
		$param = array(
			'Tanggal' => $tanggal,
			'Keterangan' => $keterangan,
			'Total' => $total
			);
		$this->db->insert('pengeluaran',	$param);	
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	public function remove_pengeluaran($id) {
		$this->db->delete('pengeluaran', array('ID' => $id));
	}
}

?>