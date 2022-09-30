<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_menu extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		function get() {
			$qry="SELECT tb_menu.id_menu AS id_menu, tb_menu.nama_menu AS nama_menu, tb_kategori.kategori AS kategori, tb_menu.gambar AS gambar, tb_menu.harga AS harga, tb_menu.aktif AS aktif FROM tb_menu, tb_kategori WHERE tb_menu.kategori=tb_kategori.id_kat ORDER BY tb_menu.id_menu DESC";
			$data=$this->db->query($qry);
			return $data;
		}

		function getByKat($id_kat) {
			$qry="SELECT tb_menu.id_menu AS id_menu, tb_menu.nama_menu AS nama_menu, tb_kategori.kategori AS kategori, tb_menu.gambar AS gambar, tb_menu.harga AS harga, tb_menu.aktif AS aktif FROM tb_menu, tb_kategori WHERE tb_menu.kategori=tb_kategori.id_kat AND tb_menu.kategori='$id_kat' ORDER BY tb_menu.id_menu DESC";
			$data=$this->db->query($qry);
			return $data;
		}

		function getBrg() {			
			$data=$this->db->order_by('id_menu', 'DESC');
			$data=$this->db->where('aktif','yes');
			$data=$this->db->get('tb_menu', 3);
			return $data;
		}

		function cariBrg($keyword) {
			$qry="SELECT * FROM tb_menu WHERE nama_menu LIKE '%$keyword%' AND aktif='yes'";
			$data=$this->db->query($qry);
			return $data;
		}

		function get_byID($id_menu) {
			$data=$this->db->where('id_menu',$id_menu);
			$data=$this->db->get('tb_menu');
			return $data;
		}

		function add($id_menu,$kategori,$nama_menu,$gambar,$harga,$aktif) {
			$data=array('id_menu'=>$id_menu, 'kategori'=>$kategori, 'nama_menu'=>$nama_menu, 'gambar'=>$gambar, 'harga'=>$harga, 'aktif'=>$aktif);
			$this->db->insert('tb_menu',$data);
		}

		function update($id_menu,$kategori,$nama_menu,$gambar,$harga,$aktif) {
			$data=array('id_menu'=>$id_menu, 'kategori'=>$kategori, 'nama_menu'=>$nama_menu, 'gambar'=>$gambar, 'harga'=>$harga, 'aktif'=>$aktif);
			$this->db->where('id_menu',$id_menu);
			$this->db->update('tb_menu',$data);
		}

		function updateNoImg($id_menu,$kategori,$nama_menu,$harga,$aktif) {
			$data=array('id_menu'=>$id_menu, 'kategori'=>$kategori, 'nama_menu'=>$nama_menu, 'harga'=>$harga, 'aktif'=>$aktif);
			$this->db->where('id_menu',$id_menu);
			$this->db->update('tb_menu',$data);
		}

		function del($id_menu) {
			$this->db->where('id_menu',$id_menu);
			$this->db->delete('tb_menu');
		}

		function jumlahdata() {
			$data=$this->db->count_all('tb_menu');	
			return $data;
		}

		function maxdata(){
			$data=$this->db->select_max('id_menu','lastid');
			$data=$this->db->get('tb_menu');
			return $data;
		}
}