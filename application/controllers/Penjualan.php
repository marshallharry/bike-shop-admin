<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends MY_Controller {

	function __construct() {
		parent::__construct();   
		$this->load->model('Penjualan_model');
		$this->load->model('Barang_model');
	}	

	public function view($id = null) {
		if($id === null) {
			if(isset($_POST['dateFrom']) && !empty($_POST['dateFrom']))
			{
				$dateFrom = $_POST['dateFrom'];
				$_SESSION['dateFromPenjualan'] = $dateFrom;
			}
			else if( isset($_SESSION['dateFromPenjualan']) && !empty($_SESSION['dateFromPenjualan']) )
			{
				$dateFrom = $_SESSION['dateFromPenjualan'];
			}
			else
			{
				$dateFrom = date('Y-m-d');
			}
			
			if( isset($_POST['dateTo']) && !empty($_POST['dateTo']) )
			{
				$dateTo = $_POST['dateTo'];
				$_SESSION['dateToPenjualan'] = $dateTo;
			}
			else if( isset($_SESSION['dateToPenjualan']) && !empty($_SESSION['dateToPenjualan']) )
			{
				$dateTo = $_SESSION['dateToPenjualan'];
			}
			else
			{
				$dateTo = date('Y-m-d');
			}

			$this->data['dateFrom'] = $dateFrom;
			$this->data['dateTo'] = $dateTo;

			$this->data['penjualan'] = $this->Penjualan_model->get_header_penjualan($dateFrom, $dateTo);
			$this->load->view('penjualan/view', $this->data);
		}	
		else {
			if( isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ) {
				$this->data['error_msg'] = $_SESSION['error_msg'];
				unset($_SESSION['error_msg']);
			}

			$this->data['header'] = $this->Penjualan_model->get_header_penjualan_by_id($id);
			$this->data['details'] = $this->Penjualan_model->get_detail_penjualan($id);
			$this->load->view('penjualan/detail', $this->data);
		}
	}

	public function create() {
		if( isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ) {
			$this->data['error_msg'] = $_SESSION['error_msg'];
			unset($_SESSION['error_msg']);

			$this->data['selldate'] = $_SESSION['selldate'];
			unset($_SESSION['selldate']);
		}
		else {
			$this->data['selldate'] = date('Y-m-d');
		}
		
		$this->data['barang'] = $this->Barang_model->get_barang();
		$this->load->view('penjualan/create',$this->data);	
	}

	public function add() {		
		$selldate = $_POST['txDate'];

		if((!isset($_POST['nameCart']) || empty($_POST['nameCart'])))
		{
			$_SESSION['error_msg'] = "Keranjang anda masih kosong.";
			$_SESSION['selldate'] = $selldate;
			
			redirect('/penjualan/create', 'refresh');
		}
		else
		{
			$grandTotal = 0;
			$grandModal = 0;
			$headerid = $this->Penjualan_model->add_header_penjualan($selldate, $grandTotal);

			if($headerid === -1) {
				$_SESSION['error_msg'] = "Database error, Header ID = -1.";
				$_SESSION['selldate'] = $selldate;
				
				redirect('/penjualan/create', 'refresh');
			}
			else {
				if(isset($_POST['nameCart']) && !empty($_POST['nameCart'])) {
					$amount = $_POST['amountCart'];
					$modal = $_POST['modalCart'];
					$harga = $_POST['hargaCart'];
					$name = $_POST['nameCart'];
					$stock = $_POST['stockCart'];

					for ($idx = 0; $idx < count($name); $idx++) {
					    $amountbaru = $amount[$idx];
					    $modalbaru = $modal[$idx];
					    $hargabaru = $harga[$idx];
					    $namabaru = $name[$idx];
						$stockbaru = $stock[$idx];
						
						$temps = $this->Barang_model->check_exist($namabaru, $modalbaru);
						if(!empty($temps)) {
							$temp = $temps[0];
							$idbaru = $temp->ID;
							$this->Barang_model->remove_stock_barang($idbaru, $amountbaru);
						}
						else {
							$stockbaru -= $amountbaru;
							$idbaru = $this->Barang_model->add_barang($namabaru, $modalbaru, $stockbaru);
						}
					    
					    $this->Penjualan_model->add_detail_penjualan($idbaru, $amountbaru, $hargabaru, $headerid, $modalbaru, $namabaru);

				    	$total = $amountbaru * $hargabaru;
				    	$totalModal = $amountbaru * $modalbaru;
				    	$grandTotal = $grandTotal + $total;
				    	$grandModal = $grandModal + $totalModal;
					} 
				}

				$this->Penjualan_model->update_header_penjualan_total($headerid, $grandTotal, $grandModal);
				redirect('/penjualan/view', 'refresh');	
			}	
		}
	}

	public function remove($id) {
		$details = $this->Penjualan_model->get_detail_penjualan($id);
		if(!empty($details)) {
			foreach($details as $detail) {
				$barangId = $detail->Barang_ID;
				$jumlah = $detail->Jumlah;

				$this->Barang_model->add_stock_barang($barangId, $jumlah);
			}
		}
		
		$this->Penjualan_model->remove_penjualan($id);
		redirect('/penjualan/view', 'refresh');
	}

	public function retur() {	
		$headerid = $_POST['txID'];
		$grandTotal = $_POST['txTotal'];
		$grandModal = $_POST['txModal'];

		if(!isset($_POST['idCart']) || empty($_POST['idCart']))
		{
			$_SESSION['error_msg'] = "Daftar Retur anda masih kosong.";
			
			redirect('/penjualan/view/'.$headerid, 'refresh');
		}
		else
		{
			if(isset($_POST['idCart']) && !empty($_POST['idCart'])) {
				$id = $_POST['idCart'];
				$amount = $_POST['amountCart'];

				for ($idx = 0; $idx < count($id); $idx++) {
					$detail = $this->Penjualan_model->get_detail_penjualan($headerid, $id[$idx]);
					$returAmt = $amount[$idx];

					if ($detail != null)
					{
						$idBarang = $detail->Barang_ID;
						$modal = $detail->Modal;
						$harga = $detail->Harga;
						$newAmt = $detail->Jumlah - $returAmt;
						$this->Penjualan_model->update_detail_penjualan($id[$idx], $newAmt);
			    		$this->Barang_model->add_stock_barang($idBarang, $returAmt);

			    		$totalModal = $returAmt * $modal;
			    		$total = $returAmt * $harga;
			    		$grandTotal = $grandTotal - $total;
			    		$grandModal = $grandModal - $totalModal;
					}
				} 
			}

			$this->Penjualan_model->update_header_penjualan_total($headerid, $grandTotal, $grandModal);

			if($grandTotal === 0 && $grandModal === 0) {
				$this->Penjualan_model->remove_penjualan($headerid);
				redirect('/penjualan/view', 'refresh');
			}

			redirect('/penjualan/view/'.$headerid, 'refresh');		
		}
	}

	public function remove_detail($headerid, $id) {
		$detail = $this->Penjualan_model->get_detail_penjualan($headerid, $id);
		$header = $this->Penjualan_model->get_header_penjualan_by_id($headerid);

		if ($detail != null)
		{
			$idBarang = $detail->Barang_ID;
			$amount = $detail->Jumlah;
			$modal = $detail->Modal;
			$harga = $detail->Harga;

			$totalModal = $amount * $modal;
			$total = $amount * $harga;
			$grandTotal = $header->Total - $total;
			$grandModal = $header->Modal - $totalModal;

			$this->Penjualan_model->update_header_penjualan_total($headerid, $grandTotal, $grandModal);
			$this->Penjualan_model->remove_detail_penjualan($id);
			$this->Barang_model->add_stock_barang($idBarang, $amount);

			if($grandTotal === 0 && $grandModal === 0) {
				$this->Penjualan_model->remove_penjualan($headerid);
				redirect('/penjualan/view', 'refresh');
			}
		}

		redirect('/penjualan/view/'.$headerid, 'refresh');
	}
}