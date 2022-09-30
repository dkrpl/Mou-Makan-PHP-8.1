<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transaksi extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		function getbyID($id_transaksi) {
			$data=$this->db->where('id_transaksi',$id_transaksi);
			$data=$this->db->get('tb_det_transaksi');
			return $data;
		}

		function addDet($id_transaksi,$id_pesanan,$nama_menu,$qty,$diskon,$total,$status) {
			$data=array(
				'id_transaksi'=>$id_transaksi, 'id_pesanan'=>$id_pesanan, 'nama_menu'=>$nama_menu, 'qty'=>$qty, 'diskon'=>$diskon, 'total'=>$total, 'status'=>$status
				);
			$add=$this->db->insert('tb_det_transaksi',$data);
			if($add) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function add($id_transaksi,$id_pesanan,$id_karyawan,$tgl,$jam,$diskon,$pajak,$total,$total_kena_pajak,$status) {
			$data=array(
				'id_transaksi'=>$id_transaksi, 'id_pesanan'=>$id_pesanan, 'id_karyawan'=>$id_karyawan, 'tgl'=>$tgl, 'jam'=>$jam, 'diskon'=>$diskon, 'pajak'=>$pajak, 'total'=>$total, 'total_kena_pajak'=>$total_kena_pajak, 'status'=>$status
				);
			$add=$this->db->insert('tb_transaksi',$data);
			if($add) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function view_print($id_transaksi) {
			$qry="SELECT tb_transaksi.id_transaksi,tb_transaksi.id_pesanan,tb_transaksi.id_karyawan,tb_transaksi.tgl,tb_transaksi.jam,tb_transaksi.diskon,tb_transaksi.total,tb_transaksi.status,tb_pesanan.kode_pesanan,tb_pesanan.no_meja,tb_pesanan.nama_pelanggan,tb_pesanan.menu,tb_pesanan.qty,tb_pesanan.harga,tb_pesanan.dibayar,tb_pesanan.dimasak,tb_pesanan.selesai,tb_pesanan.pelayan,tb_pesanan.tanggal FROM tb_transaksi ,tb_pesanan WHERE tb_transaksi.id_pesanan = tb_pesanan.kode_pesanan AND tb_transaksi.id_transaksi = '$id_transaksi'";
			$data=$this->db->query($qry);
			return $data;
		}

		function maxIDTransaksi($today) {
			$qry="SELECT MAX(id_transaksi) AS lastID from tb_det_transaksi WHERE id_transaksi LIKE '%INSTA-$today%'";
			$data=$this->db->query($qry);
			return $data;
		}


		function jumlahdata() {
			$data=$this->db->count_all('tb_transaksi');	
			return $data;
		}

		function jumlahdataDet() {
			$data=$this->db->count_all('tb_det_transaksi');	
			return $data;
		}

		function clearAllDet() {
			$qry="TRUNCATE TABLE tb_det_transaksi";
			$this->db->query($qry);
		}

		function clearAll() {
			$qry="TRUNCATE TABLE tb_transaksi";
			$this->db->query($qry);
		}
		function clearAllPes() {
			$qry="TRUNCATE TABLE tb_pesanan";
			$this->db->query($qry);
		}
}