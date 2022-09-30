<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_modal extends CI_Model {

		function __construct() {
			parent:: __construct(); 						
		}

		function get(){
			$data=$this->db->get('tb_modal_awal');
			return $data;
		}

		function getLog(){
			$qry="SELECT tb_karyawan.nama AS karyawan, tb_log_modal_awal.tgl AS tgl, tb_log_modal_awal.jam AS jam, tb_log_modal_awal.modal AS modal FROM tb_log_modal_awal, tb_karyawan WHERE tb_log_modal_awal.id_karyawan=tb_karyawan.id_karyawan";
			$data=$this->db->query($qry);
			return $data;
		}

		function ubah($id_modal,$modal) {
			$data=array('modal'=>$modal);
			$ubah=$this->db->where('id_modal',$id_modal);
			$ubah=$this->db->update('tb_modal_awal',$data);
			if ($ubah) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function addModal($modal) {
			$data=array('modal'=>$modal);
			$add=$this->db->insert('tb_modal_awal',$data);
			if ($add) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function addLogModal($id_karyawan,$tgl,$jam,$modal) {
			$data=array('id_karyawan'=>$id_karyawan, 'tgl'=>$tgl, 'jam'=>$jam, 'modal'=>$modal);
			$add=$this->db->insert('tb_log_modal_awal',$data);
			if ($add) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

}