<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_admin extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		function get() {
			$data=$this->db->get('tb_admin');
			return $data;
		}

		function getByID($id) {
			$data=$this->db->where('id_admin',$id);
			$data=$this->db->get('tb_admin');
			return $data;
		}

		function getByUsername($username) {
			$data=$this->db->where('username',$username);
			$data=$this->db->get('tb_admin');
			return $data;
		}

		function add($username,$password) {
			$data=array('username'=>$username,'password'=>$password);
			$add=$this->db->insert('tb_admin',$data);
			if($add) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function ubah($id,$username,$password) {
			$data=array('username'=>$username,'password'=>$password);
			$ubah=$this->db->where('id_admin',$id);
			$ubah=$this->db->update('tb_admin',$data);
			if($ubah) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function del($id) {
			$del=$this->db->where('id_admin',$id);
			$del=$this->db->delete('tb_admin');
			if($del) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
}