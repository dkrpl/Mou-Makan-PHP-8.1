<?php
class Absensi extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_karyawan');
		$this->load->model('Model_absensi');
		if (!$this->session->userdata('logged_in')) {
			redirect('login', 'refresh');
		}
	}

	function index()
	{
		$id = $this->session->userdata('username');
		$data['id'] = $id;
		$data['title'] = "ADMIN Bicara Kopi | Data Karwayan";
		$data['karyawan'] = $this->Model_karyawan->get_byID($id);
		$data['cek_in'] = $this->Model_absensi->cek_absen($id, 'in');
		$data['cek_out'] = $this->Model_absensi->cek_absen($id, 'out');
		$status = $this->Model_absensi->cek_status($id);
		if ($status == 0) {
			$data['status'] = "BELUM ABSEN";
		} else if ($status % 2 == 1) {
			$data['status'] = "BERHASIL CHECK IN";
		} else if ($status % 2 == 0) {
			$data['status'] = "BERHASIL CHECK OUT";
		}
		$this->template->display_admin('admin/view_absensi', $data);
	}

	function absen_karyawan()
	{
		$id_k = $this->uri->segment(3);
		$status = $this->uri->segment(4);
		$this->Model_absensi->add($id_k, $status);
		redirect('absensi');
	}
	//untuk check out dan sekalian logout
	function checkout()
	{
		$id_k = $this->uri->segment(3);
		$status = $this->uri->segment(4);
		$this->Model_absensi->add($id_k, $status);
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('akses');
		$this->session->unset_userdata('logged_in');
		redirect('login', 'refresh');
	}
}
