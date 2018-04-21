<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends MY_Controller {

	function __construct() {
		parent::__construct();   
		$this->load->model('Pengeluaran_model');
		$this->load->model('Barang_model');
	}	

	public function tipe($action = NULL) {		
		if($action != NULL)
		{
			if($action == 'insert')
			{
				$nama = $_POST['nama'];
				$total = $_POST['total'];

				$this->Pengeluaran_model->add_tipe_pengeluaran($nama, $total);
				redirect('/pengeluaran/tipe', 'refresh');
			}
		}
		else
		{
			$this->data['result'] = $this->Pengeluaran_model->get_tipe_pengeluaran();
			$this->load->view('pengeluaran/view_tipe',$this->data);
		}
	}

	public function edit_tipe($id) {
		$this->data['result'] = $this->Pengeluaran_model->get_tipe_pengeluaran($id);
		$this->load->view('pengeluaran/edit_tipe',$this->data);
	}

	public function update_tipe($id) {
		$nama = $_POST['nama'];
		$total = $_POST['total'];

		$this->Pengeluaran_model->update_tipe_pengeluaran($id, $nama, $total);
		redirect('/pengeluaran/edit_tipe/'.$id, 'refresh');
	}

	public function view($action = NULL) {		
		if($action != NULL)
		{
			if($action == 'insert')
			{
				$tanggal = $_POST['tanggal'];
				$keterangan = $_POST['keterangan'];
				$total = $_POST['total'];
				$payment = $_POST['payment'];

				$this->Pengeluaran_model->add_pengeluaran($tanggal, $keterangan, $total, $payment);
				redirect('/pengeluaran/view', 'refresh');
			}
		}
		else
		{
			if(isset($_POST['dateFrom']) && !empty($_POST['dateFrom']))
			{
				$dateFrom = $_POST['dateFrom'];
				$_SESSION['dateFromPengeluaran'] = $dateFrom;
			}
			else if( isset($_SESSION['dateFromPengeluaran']) && !empty($_SESSION['dateFromPengeluaran']) )
			{
				$dateFrom = $_SESSION['dateFromPengeluaran'];
			}
			else
			{
				$dateFrom = date('Y-m-d');
			}
			
			if( isset($_POST['dateTo']) && !empty($_POST['dateTo']) )
			{
				$dateTo = $_POST['dateTo'];
				$_SESSION['dateToPengeluaran'] = $dateTo;
			}
			else if( isset($_SESSION['dateToPengeluaran']) && !empty($_SESSION['dateToPengeluaran']) )
			{
				$dateTo = $_SESSION['dateToPengeluaran'];
			}
			else
			{
				$dateTo = date('Y-m-d');
			}

			$this->data['tanggal'] = date('Y-m-d');

			$this->data['dateFrom'] = $dateFrom;
			$this->data['dateTo'] = $dateTo;

			$this->data['result'] = $this->Pengeluaran_model->get_pengeluaran($dateFrom, $dateTo);
			$this->data['tipe'] = $this->Pengeluaran_model->get_tipe_pengeluaran();
			$this->load->view('pengeluaran/view',$this->data);
		}
	}

	public function remove($id) {
		$this->Pengeluaran_model->remove_pengeluaran($id);
		redirect('/pengeluaran/view', 'refresh');
	}
}