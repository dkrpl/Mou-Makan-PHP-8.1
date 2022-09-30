<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_report extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		// function showBulan($bln,$thn) {
		// 	$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_det_transaksi.nama_menu AS item, tb_det_transaksi.qty AS qty, tb_det_transaksi.total AS total, tb_det_transaksi.diskon AS diskon, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_karyawan.nama AS kasir FROM tb_det_transaksi, tb_transaksi, tb_karyawan WHERE tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND MONTH(tb_transaksi.tgl)='$bln' AND YEAR(tb_transaksi.tgl)='$thn'";
		// 	$data=$this->db->query($qry);
		// 	return $data;

		// }

		function showBulan($bln,$thn) {
			$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_transaksi.total AS total, tb_transaksi.total_kena_pajak AS total_kena_pajak, tb_karyawan.nama AS kasir FROM tb_transaksi, tb_karyawan WHERE tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND MONTH(tb_transaksi.tgl)='$bln' AND YEAR(tb_transaksi.tgl)='$thn' GROUP BY tb_transaksi.id_transaksi";
			$data=$this->db->query($qry);
			return $data;

		}

		// function showReport_admin($awal,$akhir) {
		// 	$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_det_transaksi.nama_menu AS item, tb_det_transaksi.qty AS qty, tb_menu.harga AS harga, tb_det_transaksi.total AS total, tb_det_transaksi.diskon AS diskon, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_karyawan.nama AS kasir FROM tb_det_transaksi, tb_transaksi, tb_karyawan, tb_menu WHERE tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND tb_det_transaksi.nama_menu=tb_menu.nama_menu AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')<='$akhir'";
		// 	$data=$this->db->query($qry);
		// 	return $data;

		// }

		function showReport_admin($awal,$akhir) {
			$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_transaksi.total AS total, tb_transaksi.total_kena_pajak AS total_kena_pajak, tb_karyawan.nama AS kasir FROM tb_transaksi, tb_karyawan WHERE tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')<='$akhir' GROUP BY id_transaksi";
			$data=$this->db->query($qry);
			return $data;

		}

		// function showReport_user($awal,$akhir,$id_karyawan) {
			
		// 	$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_det_transaksi.nama_menu AS item, tb_det_transaksi.qty AS qty, tb_menu.harga AS harga, tb_det_transaksi.total AS total, tb_det_transaksi.diskon AS diskon, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_karyawan.nama AS kasir FROM tb_det_transaksi, tb_transaksi, tb_karyawan, tb_menu WHERE tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND tb_det_transaksi.nama_menu=tb_menu.nama_menu AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')<='$akhir' AND tb_transaksi.id_karyawan='$id_karyawan'";
		// 	$data=$this->db->query($qry);
		// 	return $data;

		// }

		function showReport_user($awal,$akhir,$id_karyawan) {
			
			$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_transaksi.total AS total, tb_transaksi.total_kena_pajak AS total_kena_pajak, tb_karyawan.nama AS kasir FROM tb_transaksi, tb_karyawan WHERE tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')<='$akhir' AND tb_transaksi.id_karyawan='$id_karyawan' GROUP BY id_transaksi";
			$data=$this->db->query($qry);
			return $data;

		}

		function showReportKat($awal,$akhir,$kat,$id_karyawan) {
			if($this->session->userdata('akses')=='admin'){
				$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_det_transaksi.nama_menu AS item, tb_det_transaksi.qty AS qty, tb_menu.harga AS harga, tb_det_transaksi.total AS total, tb_det_transaksi.diskon AS diskon, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_karyawan.nama AS kasir, tb_kategori.kategori FROM tb_det_transaksi, tb_transaksi, tb_karyawan, tb_kategori, tb_menu WHERE tb_kategori.id_kat=tb_menu.kategori AND tb_menu.nama_menu=tb_det_transaksi.nama_menu AND tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')<='$akhir' AND tb_menu.kategori='$kat'";
			} else {
				$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_det_transaksi.nama_menu AS item, tb_det_transaksi.qty AS qty,tb_menu.harga AS harga, tb_det_transaksi.total AS total, tb_det_transaksi.diskon AS diskon, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_karyawan.nama AS kasir, tb_kategori.kategori FROM tb_det_transaksi, tb_transaksi, tb_karyawan, tb_kategori, tb_menu WHERE tb_kategori.id_kat=tb_menu.kategori AND tb_menu.nama_menu=tb_det_transaksi.nama_menu AND tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')<='$akhir' AND tb_menu.kategori='$kat' AND tb_transaksi.id_karyawan='$id_karyawan'";
			}
			$data=$this->db->query($qry);
			return $data;

		}

		// function lastShift($waktu_ganti,$tgl_ganti,$id_karyawan) {
		// 	$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_transaksi.total AS total, tb_transaksi.total_kena_pajak AS total_penu, tb_karyawan.nama AS kasir FROM tb_transaksi, tb_karyawan WHERE tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND  DATE_FORMAT(tb_transaksi.jam,'%T')<='$waktu_ganti' AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')='$tgl_ganti' AND tb_transaksi.id_karyawan='$id_karyawan'";
		// 	$data=$this->db->query($qry);
		// 	return $data;
		// }

		function lastShift($waktu_ganti,$tgl_ganti,$id_karyawan) {
			$qry="SELECT tb_transaksi.total_kena_pajak AS total_penjualan, tb_karyawan.nama AS kasir FROM tb_transaksi, tb_karyawan WHERE tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND  DATE_FORMAT(tb_transaksi.jam,'%T')<='$waktu_ganti' AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')='$tgl_ganti' AND tb_transaksi.id_karyawan='$id_karyawan' GROUP BY tb_transaksi.id_transaksi";
			$data=$this->db->query($qry);
			return $data;
		}

		// function showToday($today) {
		// 	$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_det_transaksi.nama_menu AS item, tb_det_transaksi.qty AS qty, tb_det_transaksi.total AS total, tb_det_transaksi.diskon AS diskon, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_karyawan.nama AS kasir FROM tb_det_transaksi, tb_transaksi, tb_karyawan WHERE tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')='$today'";
		// 	$data=$this->db->query($qry);
		// 	return $data;
		// }

		function showToday($today) {
			$qry="SELECT tb_transaksi.id_transaksi AS id_transaksi, tb_det_transaksi.nama_menu AS item, tb_det_transaksi.qty AS qty, tb_det_transaksi.total AS total, tb_det_transaksi.diskon AS diskon, tb_transaksi.pajak AS pajak, tb_transaksi.tgl AS tgl, tb_transaksi.jam AS jam, tb_karyawan.nama AS kasir FROM tb_det_transaksi, tb_transaksi, tb_karyawan WHERE tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND DATE_FORMAT(tb_transaksi.tgl,'%Y-%m-%d')='$today'";
			$data=$this->db->query($qry);
			return $data;
		}

		function reportAbsensi($bln,$thn,$id_karyawan) {
			if($id_karyawan!='0') {
				$qry="SELECT tb_karyawan.nama AS karyawan, tb_absensi.tgl AS tanggal, tb_absensi.jam AS jam, tb_absensi.status AS status FROM tb_karyawan, tb_absensi WHERE tb_karyawan.id_karyawan=tb_absensi.id_karyawan AND tb_absensi.id_karyawan='$id_karyawan' AND MONTH(tb_absensi.tgl)='$bln' AND YEAR(tb_absensi.tgl)='$thn'";
			} else {
				$qry="SELECT tb_karyawan.nama AS karyawan, tb_absensi.tgl AS tanggal, tb_absensi.jam AS jam, tb_absensi.status AS status FROM tb_karyawan, tb_absensi WHERE tb_karyawan.id_karyawan=tb_absensi.id_karyawan AND MONTH(tb_absensi.tgl)='$bln' AND YEAR(tb_absensi.tgl)='$thn'";
			}
			$data=$this->db->query($qry);
			return $data;
		}

		function reportPelayanan($awal,$akhir,$pramusaji) {
			if($pramusaji!='0') {
				$qry="SELECT tb_pesanan.kode_pesanan AS id_transaksi, tb_meja.meja AS meja, tb_pesanan.nama_pelanggan AS pelanggan, tb_pesanan.menu AS item, tb_pesanan.qty AS qty, tb_pesanan.harga AS harga, tb_karyawan.nama AS pramusaji, tb_pesanan.tanggal AS tanggal FROM tb_pesanan, tb_meja, tb_karyawan WHERE tb_pesanan.no_meja=tb_meja.no_meja AND tb_karyawan.id_karyawan=tb_pesanan.pelayan AND DATE_FORMAT(tb_pesanan.tanggal,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(tb_pesanan.tanggal,'%Y-%m-%d')<='$akhir' AND tb_pesanan.pelayan='$pramusaji'";
			} else {
				$qry="SELECT tb_pesanan.kode_pesanan AS id_transaksi, tb_meja.meja AS meja, tb_pesanan.nama_pelanggan AS pelanggan, tb_pesanan.menu AS item, tb_pesanan.qty AS qty, tb_pesanan.harga AS harga, tb_karyawan.nama AS pramusaji, tb_pesanan.tanggal AS tanggal FROM tb_pesanan, tb_meja, tb_karyawan WHERE tb_pesanan.no_meja=tb_meja.no_meja AND tb_karyawan.id_karyawan=tb_pesanan.pelayan AND DATE_FORMAT(tb_pesanan.tanggal,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(tb_pesanan.tanggal,'%Y-%m-%d')<='$akhir'";
			} 
			$data=$this->db->query($qry);
			return $data;
		}

		// function grafik_penjualan($thn) {
		// 	$qry="SELECT SUM(tb_det_transaksi.total) AS total_penjualan, DATE_FORMAT(tgl, '%M') AS bulan FROM tb_det_transaksi, tb_transaksi, tb_karyawan WHERE tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND YEAR(tgl)='$thn' GROUP BY bulan ORDER BY bulan DESC";
		// 	$data=$this->db->query($qry);
		// 	return $data;
		// }

		function grafik_penjualan($thn) {
			$qry="SELECT SUM(total) AS total_penjualan, bulan FROM (SELECT tb_transaksi.total_kena_pajak AS total, DATE_FORMAT(tgl, '%M') AS bulan FROM `tb_transaksi` GROUP BY tb_transaksi.id_transaksi) AS penjualan GROUP BY bulan ORDER BY bulan DESC";
			$data=$this->db->query($qry);
			return $data;
		}

		function grafik_barang($bln) {
			$qry="SELECT tb_det_transaksi.nama_menu AS item, SUM(tb_det_transaksi.qty) AS jumlah FROM tb_det_transaksi, tb_transaksi, tb_karyawan WHERE tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND MONTH(tb_transaksi.tgl)='$bln' GROUP BY item ORDER BY jumlah DESC LIMIT 0,5";
			$data=$this->db->query($qry);
			return $data;
		}

		function grafik_kategori($bln) {
			$qry="SELECT  SUM(tb_det_transaksi.qty) AS jumlah, tb_kategori.kategori AS kategori FROM tb_det_transaksi, tb_transaksi, tb_karyawan, tb_kategori, tb_menu WHERE tb_kategori.id_kat=tb_menu.kategori AND tb_menu.nama_menu=tb_det_transaksi.nama_menu AND tb_transaksi.id_pesanan=tb_det_transaksi.id_pesanan AND tb_transaksi.id_karyawan=tb_karyawan.id_karyawan AND MONTH(tb_transaksi.tgl)='$bln' GROUP BY tb_kategori.kategori";
			$data=$this->db->query($qry);
			return $data;
		}
		function modal() {
			$qry="SELECT * FROM `tb_modal_awal`";
			$data=$this->db->query($qry)->row()->modal;
			return $data;
		}

}