<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MY_Controller {


	function __construct() {
		parent::__construct();   
		$this->load->model('Barang_model');
	}	

	public function index($action = NULL) {		
		if($action != NULL)
		{
			if($action == 'insert')
			{
				$nama = $_POST['nama'];
				$modal = $_POST['modal'];
				$jumlah = $_POST['jumlah'];

				$this->Barang_model->add_barang($nama, $modal, $jumlah);
				redirect('/barang/', 'refresh');
			}
		}
		else
		{
			$this->data['result'] = $this->Barang_model->get_barang();
			$this->load->view('barang/view',$this->data);
		}
	}

	public function remove($id) {
		$this->Barang_model->remove_barang($id);
		redirect('/barang/', 'refresh');
	}

	public function edit($id) {
		$this->data['result'] = $this->Barang_model->get_barang($id);
		$this->load->view('barang/edit',$this->data);
	}

	public function update($id) {
		$nama = $_POST['nama'];
		$modal = $_POST['modal'];
		$jumlah = $_POST['jumlah'];

		$this->Barang_model->update_barang($id, $nama, $modal, $jumlah);
		redirect('/barang/edit/'.$id, 'refresh');
	}

	public function auto_complete() {
		$keyword=$this->input->post('keyword');
        $data=$this->Barang_model->search_barang($keyword);        
        echo json_encode($data);
	}

	public function empty() {
		$this->data['result'] = $this->Barang_model->get_empty_stock();
		$this->load->view('barang/empty',$this->data);
	}
}