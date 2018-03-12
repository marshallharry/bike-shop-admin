<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends MY_Controller {


	function __construct() {
		parent::__construct();   
		$this->load->model('Pegawai_model');
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
		$this->data['tanggalHutang'] = date('Y-m-d');
		$this->data['result'] = $this->Pegawai_model->get_pegawai($id);
		$this->data['absensi'] = $this->Pegawai_model->get_absensi($id);
		$this->data['hutang'] = $this->Pegawai_model->get_hutang($id);
		$total = $this->Pegawai_model->get_total_absen($id);
		$this->data['totalMasuk'] = $total[0]->Total;

		$hutang = $this->Pegawai_model->get_total_hutang($id);
		$this->data['totalHutang'] = $hutang[0]->Total;
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
		$this->Pegawai_model->lunas_hutang($id);	
		
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
}