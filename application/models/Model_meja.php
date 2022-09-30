<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_meja extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		function get() {
			$data=$this->db->order_by('no_meja','ASC');
			$data=$this->db->get('tb_meja');
			return $data;
		}

		function get_aktif() {
			$data=$this->db->where('aktif','yes');
			$data=$this->db->get('tb_meja');
			return $data;
		}

		function getbyIDdipesan($no_meja) {
			$qry="SELECT * FROM tb_meja WHERE no_meja='$no_meja' AND dipesan='yes'";
			$data=$this->db->query($qry);
			return $data;
		}

		function digabung() {
			$data=$this->db->where('aktif','yes');
			$data=$this->db->where('digabung','yes');
			$data=$this->db->get('tb_meja');
			return $data;
		}

		function blm_dipesan() {
			$data=$this->db->where('aktif','yes');
			$data=$this->db->where('dipesan','no');
			$data=$this->db->get('tb_meja');
			return $data;
		}

		function pesan($no_meja,$dipesan) {
			$data=array('dipesan'=>$dipesan);			
			$this->db->where('no_meja',$no_meja);
			$this->db->update('tb_meja',$data);
		}

		function gabung($no_meja,$dipesan,$meja_gabung) {
			$data=array('dipesan'=>$dipesan, 'digabung'=>$meja_gabung);		
			$this->db->where('no_meja',$no_meja);
			$this->db->update('tb_meja',$data);
		}

		function get_byID($no_meja) {
			$data=$this->db->where('no_meja',$no_meja);
			$data=$this->db->get('tb_meja');
			return $data;
		}

		function add($no_meja,$meja,$dipesan,$digabung,$aktif) {
			$data=array('no_meja'=>$no_meja, 'meja'=>$meja, 'dipesan'=>$dipesan, 'digabung'=>$digabung, 'aktif'=>$aktif);
			$this->db->insert('tb_meja',$data);
		}

		function update($no_meja,$meja,$aktif) {
			$data=array('meja'=>$meja, 'aktif'=>$aktif);
			$this->db->where('no_meja',$no_meja);
			$this->db->update('tb_meja',$data);
		}

		function del($no_meja) {
			$this->db->where('no_meja',$no_meja);
			$this->db->delete('tb_meja');
		}

		function jumlahdata() {
			$data=$this->db->count_all('tb_meja');	
			return $data;
		}

		function maxdata(){
			$data=$this->db->select_max('no_meja','lastid');
			$data=$this->db->get('tb_meja');
			return $data;
		}
}