<?php
class Profil extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_admin');
		$this->load->model('Model_karyawan');
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
		}
	}

	function edit_admin()
	{
		$data['title'] = "ADMIN Bicara Kopi";
		$id_admin = $this->session->userdata('username');
		$data['admin'] = $this->Model_admin->getByID($id_admin);
		$this->template->display_admin('admin/profil_admin', $data);
	}

	function ubah_admin()
	{
		$id = $this->input->post('id_admin', true);
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		if (empty($password)) {
			$data = $this->Model_admin->getByID($id);
			$result = $data->row();
			$kode = $result->password;
		} else {
			$kode = md5($password);
		}
		$this->Model_admin->ubah($id, $username, $kode);
		redirect('profil/edit_admin/sukses');
	}

	function edit_karyawan()
	{
		$data['title'] = "PROFIL KARYAWAN";
		$id_karyawan = $this->session->userdata('username');
		$data['karyawan'] = $this->Model_karyawan->get_byID($id_karyawan);
		$this->template->display_admin('admin/profil_karyawan', $data);
	}

	function ubah_karyawan()
	{
		$id = $this->input->post('id_karyawan', true);
		$nama = $this->input->post('nama', true);
		$gender = $this->input->post('gender', true);
		$alamat = $this->input->post('alamat', true);
		$hp = $this->input->post('hp', true);
		$password = $this->input->post('password', true);
		$no_identitas = $this->input->post('no_identitas', true);
		$tgl_lahir = $this->input->post('tgl_lahir', true);
		$data = $this->Model_karyawan->get_byID($id);
		$result = $data->row();
		$akses = $result->akses;
		$aktif = $result->aktif;
		if (empty($password)) {
			$kode = $result->password;
		} else {
			$kode = md5($password);
		}
		$this->Model_karyawan->update($id, $nama, $gender, $alamat, $hp, $kode, $no_identitas, $tgl_lahir, $akses, $aktif);
		redirect('profil/edit_karyawan/sukses');
	}
}
