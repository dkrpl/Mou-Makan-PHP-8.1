<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pajak extends CI_Model {

		function __construct() {
			parent:: __construct(); 						
		}

		function get(){
			$data=$this->db->get('tb_pajak');
			return $data;
		}

		function getLog(){
			$data=$this->db->get('tb_log_pajak');
			return $data;
		}

		function ubah($id_pajak,$pajak) {
			$data=array('pajak'=>$pajak);
			$ubah=$this->db->where('id_pajak',$id_pajak);
			$ubah=$this->db->update('tb_pajak',$data);
			if ($ubah) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function addpajak($pajak) {
			$data=array('pajak'=>$pajak);
			$add=$this->db->insert('tb_pajak',$data);
			if ($add) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function addLogpajak($user,$tgl,$jam,$pajak) {
			$data=array('user'=>$user, 'tgl'=>$tgl, 'jam'=>$jam, 'pajak'=>$pajak);
			$add=$this->db->insert('tb_log_pajak',$data);
			if ($add) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

}