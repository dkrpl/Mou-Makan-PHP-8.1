<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pemesan extends CI_Model {

        function __construct() {
			parent:: __construct(); 						
		}

	function get()
	{
		// Fungsi untuk menampilkan data
		$data=$this->db->query("SELECT tb_meja.meja AS meja, tb_meja.dipesan AS dipesan , tb_meja.no_meja AS no_meja ,tb_booking.tanggal AS tanggal ,tb_booking.jam AS jam ,tb_booking.alamat AS alamat , tb_booking.no_hp AS no_hp , tb_booking.nama AS nama, tb_booking.id AS id FROM tb_meja, tb_booking WHERE tb_booking.kode_meja = tb_meja.no_meja ORDER BY tb_booking.id DESC");
		return $data->result_array();
	}
	function get_meja()
	{
		// Fungsi untuk menampilkan data
		$data=$this->db->query("SELECT * FROM tb_meja WHERE dipesan='no'");
		return $data->result_array();
	}

	function simpan($id, $nama, $tanggal, $jam,$no_meja,$alamat,$no_hp)
	{
		// Fungsi simpan data
		$query="INSERT INTO tb_booking VALUES ('$id', '$nama', '$tanggal', '$jam','$no_meja','$alamat','$no_hp' )";
		$this->db->query($query);
	}

	function edit($id)
	{
		// Tampilkan data untuk di-edit
		$data=$this->db->query("SELECT * FROM tb_booking WHERE id=$id");
		return $data;
	}

	function update($id,$nama,$tanggal,$jam)
	{
		// Ubah data
		$query="UPDATE tb_booking SET nama='$nama', tanggal='$tanggal', jam='$jam', gaji='$gaji' WHERE id='$id'";
		$this->db->query($query);
	}

	function delete($id)
	{
		//hapus data sesuai id
		$data=$this->db->query("DELETE FROM tb_booking WHERE id=$id");
		return $data;
	}
	
		

}