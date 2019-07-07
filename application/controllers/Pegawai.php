<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends MY_Controller {


	function __construct() {
		parent::__construct();   
		$this->load->model('Pegawai_model');
		$this->load->model('Barang_model');
		$this->load->model('Penjualan_model');
	}	

	public function index($action = NULL) {		
		if($action != NULL)
		{
			if($action == 'insert')
			{
				$nama = $_POST['nama'];
				$telp = $_POST['telp'];
				$gaji = $_POST['gaji'];

				$this->Pegawai_model->add_pegawai($nama, $telp, $gaji);
				redirect('/pegawai/', 'refresh');
			}
		}
		else
		{
			$this->data['result'] = $this->Pegawai_model->get_pegawai();
			$this->load->view('pegawai/view',$this->data);
		}
	}

	public function edit($id) {
		if( isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ) {
			$this->data['error_msg'] = $_SESSION['error_msg'];
			unset($_SESSION['error_msg']);

			$this->data['tanggal'] = $_SESSION['tanggal'];
			unset($_SESSION['tanggal']);

			$this->data['status'] = $_SESSION['status'];
			unset($_SESSION['status']);

			$this->data['keterangan'] = $_SESSION['keterangan'];
			unset($_SESSION['keterangan']);
		}
		else {
			$this->data['tanggal'] = date('Y-m-d');
			$this->data['status'] = 'masuk';
			$this->data['keterangan'] = '';
		}

		if(isset($_POST['dateFromAbsen']) && !empty($_POST['dateFromAbsen']))
		{
			$dateFromAbsen = $_POST['dateFromAbsen'];
			$_SESSION['dateFromAbsen'] = $dateFromAbsen;
		}
		else if( isset($_SESSION['dateFromAbsen']) && !empty($_SESSION['dateFromAbsen']) )
		{
			$dateFromAbsen = $_SESSION['dateFromAbsen'];
		}
		else
		{
			$dateFromAbsen = date('Y-m-d');
		}
		
		if( isset($_POST['dateToAbsen']) && !empty($_POST['dateToAbsen']) )
		{
			$dateToAbsen = $_POST['dateToAbsen'];
			$_SESSION['dateToAbsen'] = $dateToAbsen;
		}
		else if( isset($_SESSION['dateToAbsen']) && !empty($_SESSION['dateToAbsen']) )
		{
			$dateToAbsen = $_SESSION['dateToAbsen'];
		}
		else
		{
			$dateToAbsen = date('Y-m-d');
		}

		$this->data['dateFromAbsen'] = $dateFromAbsen;
		$this->data['dateToAbsen'] = $dateToAbsen;

		$this->data['tanggalHutang'] = date('Y-m-d');
		$this->data['tanggalHutangBarang'] = date('Y-m-d');
		$this->data['result'] = $this->Pegawai_model->get_pegawai($id);
		$this->data['absensi'] = $this->Pegawai_model->get_absensi($id);
		$this->data['hutang'] = $this->Pegawai_model->get_hutang($id);
		$this->data['hutangBarang'] = $this->Pegawai_model->get_hutang_barang($id);
		$total = $this->Pegawai_model->get_total_absen($id, $dateFromAbsen, $dateToAbsen);
		$this->data['totalMasuk'] = $total[0]->Total;

		$hutang = $this->Pegawai_model->get_total_hutang($id);
		$hutang_lunas = $this->Pegawai_model->get_hutang_lunas_per_month($id);
		$hutang_barang = $this->Pegawai_model->get_total_hutang_barang($id);
		$this->data['totalHutang'] = $hutang[0]->Total + $hutang_barang[0]->Total;
		$this->data['totalHutangLunas'] = $hutang_lunas[0]->Total;
		$this->load->view('pegawai/edit',$this->data);
	}

	public function update($id) {
		$nama = $_POST['nama'];
		$telp = $_POST['telp'];
		$gaji = $_POST['gaji'];

		$this->Pegawai_model->update_pegawai($id, $nama, $telp, $gaji);
		redirect('/pegawai/edit/'.$id, 'refresh');
	}

	public function absen($id) {
		$tanggal = $_POST['tanggal'];
		$status = $_POST['status'];
		$keterangan = $_POST['keterangan'];

		$checker = $this->Pegawai_model->check_already_absen($id, $tanggal);
		if (!empty($checker)){
			$_SESSION['error_msg'] = 'Pegawai sudah absen pada tanggal '.$tanggal.'.';
			$_SESSION['tanggal'] = $tanggal;
			$_SESSION['status'] = $status;
			$_SESSION['keterangan'] = $keterangan;
		}
		else {
			$this->Pegawai_model->absen_pegawai($id, $tanggal, $status, $keterangan);	
		}
		
		redirect('/pegawai/edit/'.$id, 'refresh');
	}

	public function add_hutang($id) {
		$tanggal = $_POST['tanggal_hutang'];
		$jumlah = $_POST['jumlah'];
		$keterangan = $_POST['keterangan_hutang'];

		$this->Pegawai_model->add_hutang($id, $tanggal, $jumlah, $keterangan);	
		
		redirect('/pegawai/edit/'.$id, 'refresh');
	}

	public function lunas_hutang($pid, $id) {
		$hutangs = $this->Pegawai_model->get_hutang_by_id($id);
		$hutang = $hutangs[0];

		$this->Pegawai_model->lunas_hutang($id);	
		$this->Pegawai_model->transact_lunas_hutang($id, $hutang->Sisa);
		
		redirect('/pegawai/edit/'.$pid, 'refresh');
	}

	public function lunas_sebagian($pid, $id) {
		$lunas = $_POST['txLunas'.$id];

		$hutangs = $this->Pegawai_model->get_hutang_by_id($id);
		$hutang = $hutangs[0];

		$jumlah = $hutang->Sisa;
		$newjml = $jumlah - $lunas;

		if($newjml == 0) {
			$this->Pegawai_model->lunas_hutang($id);
		}
		else {
			$this->Pegawai_model->lunas_hutang_sebagian($id, $newjml);
			$this->Pegawai_model->transact_lunas_hutang($id, $lunas);
		}

		redirect('/pegawai/edit/'.$pid, 'refresh');
	}

	public function remove_hutang($pid, $id) {
		$this->Pegawai_model->remove_hutang($id);	
		
		redirect('/pegawai/edit/'.$pid, 'refresh');
	}

	public function remove_absen($pid, $id) {
		$this->Pegawai_model->remove_absen($id);	
		
		redirect('/pegawai/edit/'.$pid, 'refresh');
	}

	public function remove($id) {
		$absen = $this->Pegawai_model->get_absensi($id);
		$hutang = $this->Pegawai_model->get_hutang($id);

		foreach($absen as $abs) {
			$absenId = $abs->ID;
			$this->Pegawai_model->remove_absen($absenId);
		}

		foreach($hutang as $hut) {
			$hutangId = $hut->ID;
			$this->Pegawai_model->remove_hutang($hutangId);
		}

		$this->Pegawai_model->remove_pegawai($id);
		redirect('/pegawai/', 'refresh');
	}

	public function add_hutang_barang($id) {
		$tanggal = $_POST['tanggal_hutang_barang'];
		$jumlah = $_POST['txJumlahBaru'];
		$barangId = $_POST['txIDBaru'];
		$nama = $_POST['txNamaBaru'];
		$modal = $_POST['txModalBaru'];
		$harga = $_POST['txJualBaru'];

		$this->Pegawai_model->add_hutang_barang($id, $tanggal, $jumlah, $barangId, $nama, $modal, $harga);
		$this->Barang_model->remove_stock_barang($barangId, $jumlah);
		
		redirect('/pegawai/edit/'.$id, 'refresh');
	}

	public function lunas_hutang_barang($pid, $id) {
		$this->Pegawai_model->lunas_hutang_barang($id);	
		$hutangs = $this->Pegawai_model->get_hutang_barang_by_id($id);
		$hutang = $hutangs[0];
		$grandTotal = $hutang->Jumlah * $hutang->Harga;
		$grandModal = $hutang->Jumlah * $hutang->Modal;

		$headerid = $this->Penjualan_model->add_header_penjualan(date('Y-m-d'), $grandTotal);
		$this->Penjualan_model->add_detail_penjualan($hutang->Barang_ID, $hutang->Jumlah, $hutang->Harga, $headerid, $hutang->Modal, $hutang->Nama_Barang);
		$this->Penjualan_model->update_header_penjualan_total($headerid, $grandTotal, $grandModal);
		
		redirect('/pegawai/edit/'.$pid, 'refresh');
	}

	public function remove_hutang_barang($pid, $id) {
		$hutangs = $this->Pegawai_model->get_hutang_barang_by_id($id);
		$hutang = $hutangs[0];

		$this->Pegawai_model->remove_hutang_barang($id);
		$this->Barang_model->add_stock_barang($hutang->Barang_ID, $hutang->Jumlah);	
		
		redirect('/pegawai/edit/'.$pid, 'refresh');
	}
}