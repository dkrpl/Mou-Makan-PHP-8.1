<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_log_sift extends CI_Model {

		function __construct() {
			parent:: __construct(); 						
		}

		function get() {
			$data=$this->db->order_by('tgl','DESC');
			$data=$this->db->get('tb_log_sift');
			return $data;
		}

		function add($id_karyawan,$tgl,$waktu) {
			$data=array(
				'id_karyawan'=>$id_karyawan, 'tgl'=>$tgl, 'time'=>$waktu
				);
			$this->db->insert('tb_log_sift',$data);
		}

		function getbyIDKar($id_karyawan) {
			$data=$this->db->where('id_karyawan',$id_karyawan);
			$data=$this->db->get('tb_log_sift');
			return $data;
		}

		function del($id_karyawan) {
			$this->db->where('id_karyawan',$id_karyawan);
			$this->db->delete('tb_log_sift');
		}

		function jumlahdata() {
			$data=$this->db->count_all('tb_log_sift');	
			return $data;
		}

}
