<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_karyawan extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get()
	{
		$data = $this->db->order_by('nama', 'ASC');
		$data = $this->db->get('tb_karyawan');
		return $data;
	}

	function get_byID($id)
	{
		$data = $this->db->where('id_karyawan', $id);
		$data = $this->db->get('tb_karyawan');
		return $data;
	}

	function add($id_karyawan, $nama, $gender, $alamat, $hp, $password, $no_identitas, $tgl_lahir, $akses, $aktif)
	{
		$data = array('id_karyawan' => $id_karyawan, 'nama' => $nama, 'gender' => $gender, 'alamat' => $alamat, 'hp' => $hp, 'password' => $password, 'no_identitas' => $no_identitas, 'tgl_lahir' => $tgl_lahir, 'akses' => $akses, 'aktif' => $aktif);
		$this->db->insert('tb_karyawan', $data);
	}

	function update($id_karyawan, $nama, $gender, $alamat, $hp, $password, $no_identitas, $tgl_lahir, $akses, $aktif)
	{
		$data = array('nama' => $nama, 'gender' => $gender, 'alamat' => $alamat, 'hp' => $hp, 'password' => $password, 'no_identitas' => $no_identitas, 'tgl_lahir' => $tgl_lahir, 'akses' => $akses, 'aktif' => $aktif);
		$this->db->where('id_karyawan', $id_karyawan);
		$this->db->update('tb_karyawan', $data);
	}

	function update_stat_yes($id_karyawan)
	{
		$data = array('aktif' => 'yes');
		$this->db->where('id_karyawan', $id_karyawan);
		$this->db->update('tb_karyawan', $data);
	}
	function update_stat_no($id_karyawan)
	{
		$data = array('aktif' => 'no');
		$this->db->where('id_karyawan', $id_karyawan);
		$this->db->update('tb_karyawan', $data);
	}

	function del($id)
	{
		$this->db->where('id_karyawan', $id);
		$this->db->delete('tb_karyawan');
	}

	function jumlahdata()
	{
		$data = $this->db->count_all('tb_karyawan');
		return $data;
	}

	function maxdata()
	{
		$data = $this->db->select_max('id_karyawan', 'lastid');
		$data = $this->db->get('tb_karyawan');
		return $data;
	}
}
