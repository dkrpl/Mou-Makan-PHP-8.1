<?php
class Modal extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_modal');
		$this->load->model('Model_karyawan');
		if ((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses') == '1')) {
			redirect('login', 'refresh');
		}
	}

	function index()
	{
		$data['title'] = "ADMIN Bicara Kopi";
		$data['modal_awal'] = $this->Model_modal->get();
		$this->template->display_admin('admin/modal_awal', $data);
	}

	function ubah()
	{
		$tgl = date('Ymd');
		$jam = date('H:i:s');
		$id_karyawan = $this->session->userdata('username');
		$id = $this->input->post('id_modal', true);
		$modal = $this->input->post('modal', true);
		$ubah_modal = str_replace(".", "", $modal);
		$ubah = $this->Model_modal->ubah($id, $ubah_modal);
		if ($ubah == TRUE) {
			$saveLog = $this->Model_modal->addLogModal($id_karyawan, $tgl, $jam, $modal);
			redirect('modal');
		}
	}
}
