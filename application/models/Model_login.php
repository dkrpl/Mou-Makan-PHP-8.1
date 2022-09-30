<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		function cek_admin($username,$password) {
			$this->db->where('username',$username);
			$this->db->where('password',$password);
			$this->db->where('password',$password);
			$data=$this->db->get('tb_admin');
			if ($data->num_rows() > 0) {
				return TRUE;		
			} else {
				return FALSE;	 	
			}			
		}

		function cek_karyawan($username,$password) {
			$this->db->where('id_karyawan',$username);
			$this->db->where('password',$password);			
			$this->db->where('aktif','yes');
			$data=$this->db->get('tb_karyawan');
			if ($data->num_rows() > 0) {
				return TRUE;		
			} else {
				return FALSE;	 	
			}
		}

}