<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Laporan_model extends CI_Model {

	var $start = 0;
    var $limit = 10;
    var $page = 0;
	var $found_row = 0;

	function __construct() 
	{
		parent::__construct();        
    }	

    public function get_laba_bersih($dateFrom, $dateTo)
	{
		$sql = "SELECT ".
				"Result.Tanggal, ".
				"SUM(Result.Penjualan_Kotor) AS Penjualan_Kotor, ".
				"SUM(Result.Modal_Barang) AS Modal_Barang, ".
				"SUM(Result.Pengeluaran) AS Pengeluaran ".
				"FROM ".
				"( ".
				"SELECT ".
				"hp.Tanggal, ".
				"SUM(dp.Harga * dp.Jumlah) AS Penjualan_Kotor, ".
				"SUM(b.Modal * dp.Jumlah) AS Modal_Barang, ".
				"0 AS Pengeluaran ".
				"FROM header_penjualan hp ".
				"JOIN detail_penjualan dp ON dp.Header_ID = hp.ID ".
				"JOIN barang b on dp.Barang_ID = b.ID WHERE 1 ";

		if($dateFrom != null)
		{
			$sql = $sql." AND hp.Tanggal >= '$dateFrom' ";
		}	

		if($dateTo != null)
		{
			$sql = $sql." AND hp.Tanggal <= '$dateTo' ";
		}	

		$sql = $sql." GROUP BY hp.Tanggal ";

		$sql = $sql."UNION ".
					"SELECT ".
					"p.Tanggal, ".
					"0 AS Penjualan_Kotor, ".
					"0 AS Modal_Barang, ".
					"SUM(p.Total) AS Pengeluaran ".
					"FROM ".
					"pengeluaran p WHERE 1 ";

		if($dateFrom != null)
		{
			$sql = $sql." AND p.Tanggal >= '$dateFrom' ";
		}	

		if($dateTo != null)
		{
			$sql = $sql." AND p.Tanggal <= '$dateTo' ";
		}	

		$sql = $sql." GROUP BY p.Tanggal ";

		$sql = $sql.") AS Result ".
					"GROUP BY Result.Tanggal ".
					"ORDER BY Result.Tanggal ";

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_omset($month, $year)
	{
		if($month == null) {
			$month = "MONTH(NOW())";
		}

		if($year == null) {
			$year = "YEAR(NOW())";
		}

		$sql = "SELECT ".
				"Result.Tanggal, ".
				"SUM(Result.Penjualan) AS Jual, ".
				"SUM(Result.Pembayaran) AS Bayar, ".
				"SUM(Result.Setor) AS Setor, ".
				"SUM(Result.Biaya) AS Biaya ".
				"FROM ".
				"( ".
				"SELECT ".
				"hp.Tanggal, ".
				"SUM(hp.Total) AS Penjualan, 0 AS Pembayaran, 0 AS Setor, 0 AS Biaya ".
				"FROM header_penjualan hp ".
				"WHERE MONTH(hp.Tanggal) = ".$month." AND YEAR(hp.Tanggal) = ".$year." ".
				"GROUP BY hp.Tanggal ";	

		$sql = $sql."UNION ".
					"SELECT ".
					"tnt.Tanggal, 0 AS Penjualan, ".
					"SUM(IF(tnt.Status = 'Tarik/Transfer', tnt.Jumlah, 0)) AS Pembayaran, ".
					"SUM(IF(tnt.Status = 'Setor/Debit', tnt.Jumlah, 0)) AS Setor, 0 AS Biaya ".
					"FROM transaksi_non_tunai tnt ".
					"WHERE MONTH(tnt.Tanggal) = ".$month." AND YEAR(tnt.Tanggal) = ".$year." ".
					"GROUP BY tnt.Tanggal ";

		$sql = $sql."UNION ".
					"SELECT ".
					"hp.Tanggal_Lunas, 0 AS Penjualan, ".
					"SUM(IF(hp.Status = 'lunas', hp.Total, 0)) AS Pembayaran, ".
					"0 AS Setor, 0 AS Biaya ".
					"FROM header_pembelian hp ".
					"WHERE MONTH(hp.Tanggal_Lunas) = ".$month." AND YEAR(hp.Tanggal_Lunas) = ".$year." ".
					"GROUP BY hp.Tanggal_Lunas ";

		$sql = $sql."UNION ".
					"SELECT ".
					"p.Tanggal, 0 AS Penjualan, 0 AS Pembayaran, 0 AS Setor, SUM(p.Total) AS Biaya ".
					"FROM pengeluaran p ".
					"WHERE MONTH(p.Tanggal) = ".$month." AND YEAR(p.Tanggal) = ".$year." ".
					"GROUP BY p.Tanggal ";

		$sql = $sql.") AS Result ".
					"GROUP BY Result.Tanggal ".
					"ORDER BY Result.Tanggal ";

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_penjualan_harian($date)
	{
		$sql = 	" SELECT dp.Nama_Barang, dp.Modal, dp.Harga, SUM(dp.Jumlah) AS Jumlah FROM detail_penjualan dp ".
				" JOIN header_penjualan hp ON hp.ID = dp.Header_ID ";

		if($date != null)
		{
			$sql = $sql." WHERE hp.Tanggal = '$date' ";
		}	

		$sql = $sql." GROUP BY dp.Nama_Barang, dp.Modal, dp.Harga ";

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_pengeluaran_bulanan($year)
	{
		$sql = " SELECT MONTHNAME(p.Tanggal) AS Bulan, SUM(p.Total) AS Total ".
				" FROM pengeluaran p ".
				" WHERE YEAR(p.Tanggal) = ".$year.
				" GROUP BY MONTHNAME(p.Tanggal) ".
				" ORDER BY MONTH(p.Tanggal) ASC ";

		$query = $this->db->query($sql);
		return $query->result();
	}

}