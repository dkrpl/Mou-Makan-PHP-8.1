<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kat extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		function get() {
			$data=$this->db->order_by('id_kat','DESC');
			$data=$this->db->get('tb_kategori');
			return $data;
		}

		function get_byID($id) {
			$data=$this->db->where('id_kat',$id);
			$data=$this->db->get('tb_kategori');
			return $data;
		}

		function add($id,$kat,$aktif) {
			$data=array('id_kat'=>$id, 'kategori'=>$kat, 'aktif'=>$aktif);
			$this->db->insert('tb_kategori',$data);
		}

		function update($id,$kat,$aktif) {
			$data=array('kategori'=>$kat, 'aktif'=>$aktif);
			$this->db->where('id_kat',$id);
			$this->db->update('tb_kategori',$data);
		}

		function del($id) {
			$this->db->where('id_kat',$id);
			$this->db->delete('tb_kategori');
		}

		function jumlahdata() {
			$data=$this->db->count_all('tb_kategori');	
			return $data;
		}

		function maxdata(){
			$data=$this->db->select_max('id_kat','lastid');
			$data=$this->db->get('tb_kategori');
			return $data;
		}
}