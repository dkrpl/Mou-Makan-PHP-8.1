<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pesanan extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		function get() {
			$data=$this->db->get('tb_pesanan');
			return $data;
		}

		function getByMeja($no_meja) {
			$data=$this->db->where('no_meja',$no_meja);
			$data=$this->db->get('tb_pesanan');
			return $data;
		}

		function getByPesanan($no_meja) {
			$data=$this->db->where('no_meja',$no_meja);
			$data=$this->db->where('dibayar','no');
			$data=$this->db->where('dimasak','no');			
			$data=$this->db->where('selesai','no');
			$data=$this->db->get('tb_pesanan');
			return $data;
		}

		function getByID($kode_pesanan) {
			$data=$this->db->where('kode_pesanan',$kode_pesanan);
			$data=$this->db->get('tb_pesanan');
			return $data;
		}

		function getDibayar() {
			$qry="SELECT tb_pesanan.kode_pesanan AS kode_pesanan, tb_meja.meja AS meja, tb_karyawan.nama as pramusaji, tb_pesanan.menu AS menu, tb_pesanan.qty AS qty, tb_pesanan.dimasak AS dimasak, tb_pesanan.selesai AS selesai FROM tb_pesanan, tb_karyawan, tb_meja WHERE tb_karyawan.id_karyawan=tb_pesanan.pelayan AND tb_meja.no_meja = tb_pesanan.no_meja AND tb_pesanan.dibayar='yes' AND tb_pesanan.selesai='no' ORDER BY tb_pesanan.tanggal DESC";
			$data=$this->db->query($qry);
			return $data;
		}

		function add($kode_pesanan,$no_meja,$nama_pelanggan,$menu,$qty,$harga,$dibayar,$dimasak,$selesai,$pelayan,$tanggal) {
			$data=array('kode_pesanan'=>$kode_pesanan, 'no_meja'=>$no_meja, 'nama_pelanggan'=>$nama_pelanggan, 'menu'=>$menu, 'qty'=>$qty, 'harga'=>$harga, 'dibayar'=>$dibayar, 'dimasak'=>$dimasak, 'selesai'=>$selesai, 'pelayan'=>$pelayan, 'tanggal'=>$tanggal);
			$add=$this->db->insert('tb_pesanan',$data);
			if($add) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function ubah($kode_pesanan,$no_meja,$nama_pelanggan,$menu,$qty,$harga,$dibayar,$dimasak,$selesai,$pelayan,$tanggal) {
			$data=array('no_meja'=>$no_meja, 'nama_pelanggan'=>$nama_pelanggan, 'menu'=>$menu, 'qty'=>$qty, 'harga'=>$harga, 'dibayar'=>$dibayar, 'dimasak'=>$dimasak, 'selesai'=>$selesai, 'pelayan'=>$pelayan, 'tanggal'=>$tanggal);
			$ubah=$this->db->where('kode_pesanan',$kode_pesanan);
			$ubah=$this->db->update('tb_pesanan',$data);
			if($ubah) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function update_order($kode_pesanan,$menu,$qty,$harga) {
			$data=array('menu'=>$menu, 'qty'=>$qty, 'harga'=>$harga);
			$ubah=$this->db->where('kode_pesanan',$kode_pesanan);
			$ubah=$this->db->update('tb_pesanan',$data);
			if($ubah) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function del($kode_pesanan) {
			$this->db->where('kode_pesanan',$kode_pesanan);
			$this->db->delete('tb_pesanan');
		}

		function delByMeja($no_meja) {
			$this->db->where('no_meja',$no_meja);
			$this->db->delete('tb_pesanan');
		}

		function dibayar($kode_pesanan,$status) {
			$data=array('dibayar'=>$status);
			$dibayar=$this->db->where('kode_pesanan',$kode_pesanan);
			$dibayar=$this->db->update('tb_pesanan',$data);
			if($dibayar) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function dimasak($id,$status) {
			$data=array('dimasak'=>$status);
			$dimasak=$this->db->where('kode_pesanan',$id);
			$dimasak=$this->db->update('tb_pesanan',$data);
			if($dimasak) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
 
		function selesai($id,$status) {
			$data=array('selesai'=>$status);
			$selesai=$this->db->where('kode_pesanan',$id);
			$selesai=$this->db->update('tb_pesanan',$data);
			if($selesai) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function maxIDTransaksi($today) {
			$qry="SELECT MAX(kode_pesanan) AS lastID from tb_pesanan WHERE kode_pesanan LIKE '%$today%'";
			$data=$this->db->query($qry);
			return $data;
		}

		//tampil nama pembeli
		function getPembeli($kode_pesanan) {
			$qry="SELECT DISTINCT nama_pelanggan FROM tb_pesanan WHERE kode_pesanan='$kode_pesanan'";
			$data=$this->db->query($qry);
			$result=$data->row();
			return $result->nama_pelanggan;
		}

		//pilah perkategori
		function orderByKat($id_kat) {
			$qry="SELECT tb_pesanan.kode_pesanan AS kode_pesanan, tb_meja.meja AS meja, tb_karyawan.nama as pramusaji, tb_pesanan.menu AS menu, tb_pesanan.qty AS qty, tb_pesanan.dimasak AS dimasak, tb_pesanan.selesai AS selesai, tb_kategori.kategori FROM tb_pesanan, tb_karyawan, tb_meja, tb_menu, tb_kategori WHERE tb_karyawan.id_karyawan=tb_pesanan.pelayan AND tb_meja.no_meja = tb_pesanan.no_meja AND tb_pesanan.dibayar='yes' AND tb_pesanan.selesai='no' AND tb_kategori.id_kat=tb_menu.kategori AND tb_menu.nama_menu=tb_pesanan.menu AND tb_kategori.id_kat='$id_kat' ORDER BY tb_pesanan.tanggal DESC";
			
			$data=$this->db->query($qry);
			return $data;
		}

}