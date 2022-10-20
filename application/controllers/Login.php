<?php
class Login extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		//tambahkan ini
		$this->load->Model('Model_login');
		$this->load->model('Model_karyawan');
		$this->load->model('Model_admin');
	}

	function index()
	{
		$data['title'] = "LOGIN Bicara Kopi";
		$this->load->view('admin/login', $data);
	}

	function cek()
	{
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		$akses = $this->input->post('akses', true);
		if ($akses == 'karyawan') {
			$cek = $this->Model_login->cek_karyawan($username, md5($password));
			if ($cek == TRUE) {
				$karyawan = $this->Model_karyawan->get_byID($username);
				$result = $karyawan->row();
				$data = array('username' => $username, 'nama' => $result->nama, 'akses' => $result->akses, 'logged_in' => TRUE);
				$this->session->set_userdata($data);
				redirect('absensi');
			} else {
				redirect('login', 'refresh');
			}
		} else {
			$cek = $this->Model_login->cek_admin($username, md5($password));
			if ($cek == TRUE) {
				$admin = $this->Model_admin->getByUsername($username);
				$result = $admin->row();
				$data = array('username' => $result->id_admin, 'akses' => 'admin', 'logged_in' => TRUE);
				$this->session->set_userdata($data);
				redirect('report/grafik');
			} else {
				redirect('login', 'refresh');
			}
		}
	}

	//NEW  UPDATE
	function auto_out()
	{
		$tgl1 = date('Y-m-d'); // pendefinisian tanggal awal
		$tgl2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
		//echo $tgl2; //print tanggal
		$this->Model_absensi->auto_absen($tgl2);
	}

	function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('akses');
		$this->session->unset_userdata('logged_in');
		redirect('login', 'refresh');
	}
}
