<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct() 
	{
		parent::__construct();   
		$this->load->model('Laporan_model');
		session_start();
    }	

    public function laba_bersih()
	{
		if(isset($_POST['dateFrom']) && !empty($_POST['dateFrom']))
		{
			$dateFrom = $_POST['dateFrom'];
			$_SESSION['dateFromLabaBersih'] = $dateFrom;
		}
		else if( isset($_SESSION['dateFromLabaBersih']) && !empty($_SESSION['dateFromLabaBersih']) )
		{
			$dateFrom = $_SESSION['dateFromLabaBersih'];
		}
		else
		{
			$dateFrom = date('Y-m-d');
		}
		
		if( isset($_POST['dateTo']) && !empty($_POST['dateTo']) )
		{
			$dateTo = $_POST['dateTo'];
			$_SESSION['dateToLabaBersih'] = $dateTo;
		}
		else if( isset($_SESSION['dateToLabaBersih']) && !empty($_SESSION['dateToLabaBersih']) )
		{
			$dateTo = $_SESSION['dateToLabaBersih'];
		}
		else
		{
			$dateTo = date('Y-m-d');
		}

		$this->data['dateFrom'] = $dateFrom;
		$this->data['dateTo'] = $dateTo;

		$this->data['result'] = $this->Laporan_model->get_laba_bersih($dateFrom, $dateTo);
		$this->load->view('laporan/laba_bersih',$this->data);
	}

	public function omset() {
		if(isset($_POST['bulan']) && !empty($_POST['bulan'])) {
			$month = $_POST['bulan'];
			$_SESSION['bulanOmset'] = $month;
		}
		else if( isset($_SESSION['bulanOmset']) && !empty($_SESSION['bulanOmset']) )
		{
			$month = $_SESSION['bulanOmset'];
		}
		else {
			$month = date('n');
		}
		
		if(isset($_POST['tahun']) && !empty($_POST['tahun'])) {
			$year = $_POST['tahun'];
			$_SESSION['tahunOmset'] = $year;
		}
		else if( isset($_SESSION['tahunOmset']) && !empty($_SESSION['tahunOmset']) )
		{
			$year = $_SESSION['tahunOmset'];
		}
		else {
			$year = date('Y');
		}

		$this->data['month'] = $month;
		$this->data['year'] = $year;
		$this->data['result'] = $this->Laporan_model->get_omset($month, $year);
		$this->load->view('laporan/omset',$this->data);
	}

	public function penjualan_harian()
	{
		if(isset($_POST['datePicked']) && !empty($_POST['datePicked']))
		{
			$datePicked = $_POST['datePicked'];
			$_SESSION['datePenjualanHarian'] = $datePicked;
		}
		else if( isset($_SESSION['datePenjualanHarian']) && !empty($_SESSION['datePenjualanHarian']) )
		{
			$datePicked = $_SESSION['datePenjualanHarian'];
		}
		else
		{
			$datePicked = date('Y-m-d');
		}

		$this->data['datePicked'] = $datePicked;

		$this->data['result'] = $this->Laporan_model->get_penjualan_harian($datePicked);
		$this->load->view('laporan/penjualan_harian',$this->data);
	}

	public function pengeluaran_bulanan() {		
		if(isset($_POST['tahun']) && !empty($_POST['tahun'])) {
			$year = $_POST['tahun'];
			$_SESSION['tahunpb'] = $year;
		}
		else if( isset($_SESSION['tahunpb']) && !empty($_SESSION['tahunpb']) )
		{
			$year = $_SESSION['tahunpb'];
		}
		else {
			$year = date('Y');
		}

		$this->data['year'] = $year;
		$this->data['result'] = $this->Laporan_model->get_pengeluaran_bulanan($year);
		$this->load->view('laporan/pengeluaran_bulanan',$this->data);
	}
}
