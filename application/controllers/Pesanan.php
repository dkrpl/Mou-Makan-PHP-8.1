<?php
class Pesanan extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Model_menu');
		$this->load->model('Model_transaksi');
		$this->load->model('Model_pesanan');
		$this->load->model('Model_meja');
		$this->load->model('Model_karyawan');
		if ((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses') == '1')) {
			redirect('login', 'refresh');
		}
	}

	function index()
	{
		$data['title'] = "ADMIN Bicara Kopi";
		$this->load->view('admin/login', $data);
	}
	function nama_user()
	{
		if ($this->session->userdata('akses') == 'admin') {
			$user = 'administrasi';
		} else {
			$id = $this->session->userdata('username');
			$data = $this->Model_karyawan->get_byID($id);
			if ($data->num_rows() > 0) {
				$result = $data->row();
				$user = $result->nama;
			}
		}
		return $user;
	}

	function transaksi()
	{
		$data['title'] = "KASIR PRINGGONDANI RESTO";
		$data['meja'] = $this->Model_meja->get_aktif();
		$data['barang'] = $this->Model_menu->getBrg();
		$this->template->display_admin('admin/ksr_pesanan', $data);
	}
}
