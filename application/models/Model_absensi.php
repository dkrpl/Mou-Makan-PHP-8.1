<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_absensi extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

		function get() {
			$data=$this->db->order_by('nama','ASC');
			$data=$this->db->get('tb_karyawan');
			return $data;
		}

		function cek_absen($id,$status)
		{
			$tanggal=date('Y-m-d');
			$qry="SELECT COUNT(*) as jumlah FROM `tb_absensi` WHERE id_karyawan='$id' AND tgl='$tanggal' AND status='$status'";
			$data=$this->db->query($qry)->row();
			return $data->jumlah;
		}

		function cek_status($id)
		{
			$tanggal=date('Y-m-d');
			$qry="SELECT COUNT(*) as jumlah FROM `tb_absensi` WHERE id_karyawan='$id' AND tgl='$tanggal'";
			$data=$this->db->query($qry)->row();
			return $data->jumlah;
		}

		function add($id_karyawan,$status) {
			$tanggal=date('Y-m-d');
			$jam=date('H:i:s');
			$data=array('id_karyawan'=>$id_karyawan,'tgl'=>$tanggal,'jam'=>$jam,'status'=>$status);
			$this->db->insert('tb_absensi',$data);
		}

		function jumlahdata() {
			$data=$this->db->count_all('tb_karyawan');	
			return $data;
		}

		function maxdata(){
			$data=$this->db->select_max('id_karyawan','lastid');
			$data=$this->db->get('tb_karyawan');
			return $data;
		}
		//NEW UPDATE
		function auto_absen($tanggal)
		{
			$data=array('jam'=>"23:00:00",'status'=>'out');
			$this->db->where('tgl',$tanggal);
			$this->db->update('tb_absensi',$data);
		}
}