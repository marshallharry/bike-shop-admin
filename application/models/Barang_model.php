<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Barang_model extends CI_Model {

	var $start = 0;
    var $limit = 10;
    var $page = 0;
	var $found_row = 0;

	function __construct() 
	{
		parent::__construct();        
    }	

	public function get_barang($id = NULL)
	{
		if( $id != NULL ) {
			$query = $this->db->get_where('barang', array('ID' => $id));
			$result = $query->result();
		}
		else {
			$query = $this->db->get('barang');
			$result = $query->result();
		}
		
		return $result;
	}

	public function add_barang($nama, $modal, $jumlah)
	{
		$param = array(
			'Nama' => $nama,
			'Modal' => $modal,
			'Jumlah' => $jumlah
			);
		$this->db->insert('barang',	$param);	
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	public function update_barang($id, $nama, $modal, $jumlah)
	{
		$param = array(
			'Nama' => $nama,
			'Modal' => $modal,
			'Jumlah' => $jumlah
			);
		$this->db->where('ID', $id);
		$this->db->update('barang', $param); 
	}

	public function add_stock_barang($id, $amount) {
		$sql = "UPDATE barang SET Jumlah = Jumlah + $amount WHERE ID=$id ";
		$this->db->query($sql);
	}

	public function remove_stock_barang($id, $amount) {
		$sql = "UPDATE barang SET Jumlah = Jumlah - $amount WHERE ID=$id ";
		$this->db->query($sql);
	}

	public function remove_barang($id) {
		$this->db->delete('barang', array('ID' => $id));
	}

	public function search_barang($keyword) {
		$this->db->order_by('ID', 'DESC');
        $this->db->like("Nama", $keyword);
        return $this->db->get('barang')->result_array();
	}

	public function check_exist($nama, $modal) {
		$this->db->where("Nama", $nama);
		$this->db->where("Modal", $modal);
        return $this->db->get('barang')->result();
	}
}

?>