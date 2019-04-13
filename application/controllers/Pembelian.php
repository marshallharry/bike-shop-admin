<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends MY_Controller {

	function __construct() {
		parent::__construct();   
		$this->load->model('Pembelian_model');
		$this->load->model('Barang_model');
	}	

	public function view($id = null) {
		if($id === null) {
			if(isset($_POST['dateFrom']) && !empty($_POST['dateFrom']))
			{
				$dateFrom = $_POST['dateFrom'];
				$_SESSION['dateFromPembelian'] = $dateFrom;
			}
			else if( isset($_SESSION['dateFromPembelian']) && !empty($_SESSION['dateFromPembelian']) )
			{
				$dateFrom = $_SESSION['dateFromPembelian'];
			}
			else
			{
				$dateFrom = date('Y-m-d');
			}
			
			if( isset($_POST['dateTo']) && !empty($_POST['dateTo']) )
			{
				$dateTo = $_POST['dateTo'];
				$_SESSION['dateToPembelian'] = $dateTo;
			}
			else if( isset($_SESSION['dateToPembelian']) && !empty($_SESSION['dateToPembelian']) )
			{
				$dateTo = $_SESSION['dateToPembelian'];
			}
			else
			{
				$dateTo = date('Y-m-d');
			}

			$this->data['dateFrom'] = $dateFrom;
			$this->data['dateTo'] = $dateTo;

			$this->data['pembelian'] = $this->Pembelian_model->get_header_pembelian($dateFrom, $dateTo);
			$this->load->view('pembelian/view', $this->data);
		}	
		else {
			if( isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ) {
				$this->data['error_msg'] = $_SESSION['error_msg'];
				unset($_SESSION['error_msg']);
			}

			$this->data['header'] = $this->Pembelian_model->get_header_pembelian_by_id($id);
			$this->data['details'] = $this->Pembelian_model->get_detail_pembelian($id);
			$this->load->view('pembelian/detail', $this->data);
		}
	}

	public function create() {
		if( isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ) {
			$this->data['error_msg'] = $_SESSION['error_msg'];
			unset($_SESSION['error_msg']);

			$this->data['buydate'] = $_SESSION['buydate'];
			unset($_SESSION['buydate']);

			$this->data['supplier'] = $_SESSION['supplier'];
			unset($_SESSION['supplier']);

			$this->data['lunas'] = $_SESSION['lunas'];
			unset($_SESSION['lunas']);

			$this->data['tempo'] = $_SESSION['tempo'];
			unset($_SESSION['tempo']);
		}
		else {
			$this->data['buydate'] = date('Y-m-d');
			$this->data['tempo'] = '';
			$this->data['supplier'] = '';
			$this->data['lunas'] = 'belum';
		}
		
		$this->data['barang'] = $this->Barang_model->get_barang();
		$this->load->view('pembelian/create',$this->data);	
	}

	public function add() {		
		$buydate = $_POST['txDate'];
		$supplier = $_POST['txSupp'];

		if(isset($_POST["cash"]) && $_POST["cash"] == true) {
			$lunas = "lunas";
			$tempo = 0;
			$lunasdate = $buydate;
			$payment = "tunai";
		}
		else {
			$payment = "non";
			$lunas = "belum";
			$lunasdate = null;
			if($_POST['txTempo'] != ""){
				$tempo = $_POST['txTempo'];
			}
			else {
				$_SESSION['error_msg'] = "Jatuh Tempo harus diisi jika pembayaran bukan Cash.";
				$_SESSION['buydate'] = $buydate;
				$_SESSION['tempo'] = "";
				$_SESSION['supplier'] = $supplier;
				$_SESSION['lunas'] = $lunas;
				
				redirect('/pembelian/create', 'refresh');
			}
		}

		if((!isset($_POST['nameCart']) || empty($_POST['nameCart'])))
		{
			$_SESSION['error_msg'] = "Keranjang anda masih kosong.";
			$_SESSION['buydate'] = $buydate;
			$_SESSION['tempo'] = $tempo;
			$_SESSION['supplier'] = $supplier;
			$_SESSION['lunas'] = $lunas;
			
			redirect('/pembelian/create', 'refresh');
		}
		else
		{
			$grandTotal = 0;
			$headerid = $this->Pembelian_model->add_header_pembelian($supplier, $buydate, $tempo, $grandTotal, $lunas, $lunasdate, $payment);

			if($headerid === -1) {
				$_SESSION['error_msg'] = "Database error, Header ID = -1.";
				$_SESSION['buydate'] = $buydate;
				$_SESSION['tempo'] = $tempo;
				$_SESSION['supplier'] = $supplier;
				$_SESSION['lunas'] = $lunas;
				
				redirect('/pembelian/create', 'refresh');
			}
			else {
				if(isset($_POST['nameCart']) && !empty($_POST['nameCart'])) {
					$amount = $_POST['amountCart'];
					$modal = $_POST['modalCart'];
					$name = $_POST['nameCart'];
					$diskon = $_POST['diskonCart'];

					for ($idx = 0; $idx < count($name); $idx++) {
					    $amountbaru = $amount[$idx];
					    $modalbaru = $modal[$idx];
						$namabaru = $name[$idx];
						$diskonbaru = $diskon[$idx];
						
						$temps = $this->Barang_model->check_exist($namabaru, $modalbaru);
						if(!empty($temps)) {
							$temp = $temps[0];
							$idbaru = $temp->ID;
							$this->Barang_model->add_stock_barang($idbaru, $amountbaru);
						}
						else {
							$idbaru = $this->Barang_model->add_barang($namabaru, $modalbaru, $amountbaru);
						}

				    	$this->Pembelian_model->add_detail_pembelian($idbaru, $amountbaru, $headerid, $modalbaru, $namabaru, $diskonbaru);
				    	
				    	$total = $amountbaru * ($modalbaru - $diskonbaru);
				    	$grandTotal = $grandTotal + $total;
					} 
				}

				$this->Pembelian_model->update_header_pembelian_total($headerid, $grandTotal);
				redirect('/pembelian/view', 'refresh');	
			}	
		}
	}

	public function lunas() {
		$id = $_POST['txID'];
		$tanggal = $_POST['txDate'];
		$payment = $_POST['payment'];

		$this->Pembelian_model->paid_off($id, $tanggal, $payment);
		redirect('/pembelian/view/'.$id, 'refresh');
	}

	public function remove($id) {
		$details = $this->Pembelian_model->get_detail_pembelian($id);
		if(!empty($details)) {
			foreach($details as $detail) {
				$barangId = $detail->Barang_ID;
				$jumlah = $detail->Jumlah;

				$this->Barang_model->remove_stock_barang($barangId, $jumlah);
			}
		}

		$this->Pembelian_model->remove_pembelian($id);
		redirect('/pembelian/view', 'refresh');
	}

	public function retur($id) {	
		$this->data['header_id'] = $id;
		$this->data['details'] = $this->Pembelian_model->get_retur($id);
		$this->load->view('pembelian/retur', $this->data);
	}

	public function submit_retur($header_id) {
		$id = $_POST['txIDLama'];
		$rid = $_POST['txIDBaru'];
		$rnama = $_POST['txNamaBaru'];
		$rmodal = $_POST['txModalBaru'];
		$rjumlah = $_POST['txJumlahBaru'];

		$temps = $this->Barang_model->check_exist($rnama, $rmodal);
		if(!empty($temps)) {
			$temp = $temps[0];
			$idbaru = $temp->ID;
		}
		else {
			$idbaru = $this->Barang_model->add_barang($rnama, $rmodal, $rjumlah);
		}

		if($rid == 0) {
			$this->Pembelian_model->insert_retur($id, $idbaru, $rnama, $rmodal, $rjumlah);
		}
		else {
			$this->Pembelian_model->update_retur($rid, $idbaru, $rnama, $rmodal, $rjumlah);
		}

		redirect('/pembelian/retur/'.$header_id, 'refresh');
	}

	public function remove_detail($headerid, $id) {
		$detail = $this->Pembelian_model->get_detail_pembelian($headerid, $id);
		$header = $this->Pembelian_model->get_header_pembelian_by_id($headerid);

		if ($detail != null)
		{
			$idBarang = $detail->Barang_ID;
			$amount = $detail->Jumlah;
			$modal = $detail->Modal_Barang;

			$total = $amount * $modal;
			$grandTotal = $header->Total - $total;

			$this->Pembelian_model->update_header_pembelian_total($headerid, $grandTotal);
			$this->Pembelian_model->remove_detail_pembelian($id);
			$this->Barang_model->remove_stock_barang($idBarang, $amount);

			if($grandTotal === 0) {
				$this->Pembelian_model->remove_pembelian($headerid);
				redirect('/pembelian/view', 'refresh');
			}
		}

		redirect('/pembelian/view/'.$headerid, 'refresh');
	}
}