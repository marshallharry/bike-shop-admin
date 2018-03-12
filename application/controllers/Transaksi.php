<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {

	function __construct() {
		parent::__construct();   
		$this->load->model('Transaksi_model');
		$this->load->model('Barang_model');
	}	

	public function non_tunai($action = NULL) {		
		if($action != NULL)
		{
			if($action == 'insert')
			{
				$tanggal = $_POST['tanggal'];
				$status = $_POST['status'];
				$jumlah = $_POST['jumlah'];
				$saldo = $_POST['saldo'];

				if($status === 'Setor/Debit') {
					$newSaldo = $saldo + $jumlah;
				}
				else {
					$newSaldo = $saldo - $jumlah;
				}

				$this->Transaksi_model->add_non_tunai($tanggal, $status, $jumlah, $newSaldo);
				redirect('/transaksi/non_tunai', 'refresh');
			}
		}
		else
		{
			if(isset($_POST['dateFrom']) && !empty($_POST['dateFrom']))
			{
				$dateFrom = $_POST['dateFrom'];
				$_SESSION['dateFromNonTunai'] = $dateFrom;
			}
			else if( isset($_SESSION['dateFromNonTunai']) && !empty($_SESSION['dateFromNonTunai']) )
			{
				$dateFrom = $_SESSION['dateFromNonTunai'];
			}
			else
			{
				$dateFrom = date('Y-m-d');
			}
			
			if( isset($_POST['dateTo']) && !empty($_POST['dateTo']) )
			{
				$dateTo = $_POST['dateTo'];
				$_SESSION['dateToNonTunai'] = $dateTo;
			}
			else if( isset($_SESSION['dateToNonTunai']) && !empty($_SESSION['dateToNonTunai']) )
			{
				$dateTo = $_SESSION['dateToNonTunai'];
			}
			else
			{
				$dateTo = date('Y-m-d');
			}

			$this->data['tanggal'] = date('Y-m-d');

			$this->data['dateFrom'] = $dateFrom;
			$this->data['dateTo'] = $dateTo;

			$this->data['result'] = $this->Transaksi_model->get_non_tunai($dateFrom, $dateTo);
			$this->data['saldo'] = $this->Transaksi_model->get_last_saldo();
			$this->load->view('transaksi/non_tunai',$this->data);
		}
	}

	public function tunai($action = NULL) {		
		if($action != NULL)
		{
			if($action == 'insert')
			{
				$tanggal = $_POST['tanggal'];
				$status = $_POST['status'];
				$jumlah = $_POST['jumlah'];
				$saldo = $_POST['saldo'];

				if($status === 'Setor') {
					$newSaldo = $saldo + $jumlah;
				}
				else {
					$newSaldo = $saldo - $jumlah;
				}

				$this->Transaksi_model->add_tunai($tanggal, $status, $jumlah, $newSaldo);
				redirect('/transaksi/tunai', 'refresh');
			}
		}
		else
		{
			if(isset($_POST['dateFrom']) && !empty($_POST['dateFrom']))
			{
				$dateFrom = $_POST['dateFrom'];
				$_SESSION['dateFromTunai'] = $dateFrom;
			}
			else if( isset($_SESSION['dateFromTunai']) && !empty($_SESSION['dateFromTunai']) )
			{
				$dateFrom = $_SESSION['dateFromTunai'];
			}
			else
			{
				$dateFrom = date('Y-m-d');
			}
			
			if( isset($_POST['dateTo']) && !empty($_POST['dateTo']) )
			{
				$dateTo = $_POST['dateTo'];
				$_SESSION['dateToTunai'] = $dateTo;
			}
			else if( isset($_SESSION['dateToTunai']) && !empty($_SESSION['dateToTunai']) )
			{
				$dateTo = $_SESSION['dateToTunai'];
			}
			else
			{
				$dateTo = date('Y-m-d');
			}

			$this->data['tanggal'] = date('Y-m-d');

			$this->data['dateFrom'] = $dateFrom;
			$this->data['dateTo'] = $dateTo;

			$this->data['result'] = $this->Transaksi_model->get_tunai($dateFrom, $dateTo);
			$this->data['saldo'] = $this->Transaksi_model->get_last_saldo_tunai();
			$this->load->view('transaksi/tunai',$this->data);
		}
	}
}