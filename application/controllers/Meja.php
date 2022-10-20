<?php
class Meja extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_meja');
		$this->load->model('Model_karyawan');
		if ((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses') == 'admin')) {
			redirect('login', 'refresh');
		}
	}

	function index()
	{
		$data['title'] = "ADMIN Bicara Kopi | Data Meja";
		$data['konten'] = $this->Model_meja->get();
		$data['autoid'] = $this->autoid();
		$this->template->display_admin('admin/view_meja', $data);
	}

	function simpan()
	{
		$no_meja = $this->autoid();
		$meja = $this->input->post('meja', true);
		$aktif = $this->input->post('aktif', true);
		$this->Model_meja->add($no_meja, $meja, 'no', 'no', $aktif);
		redirect('meja');
	}

	function ubah()
	{
		$no_meja = $this->input->post('no_meja', true);
		$meja = $this->input->post('meja', true);
		$aktif = $this->input->post('aktif', true);
		$this->Model_meja->update($no_meja, $meja, $aktif);
		redirect('meja');
	}

	function edit()
	{
		$id = $this->input->post('no_meja', true);
		$data = $this->Model_meja->get_byID($id);
		$result = $data->row();
		if (!(strcmp($result->aktif, "yes"))) {
			$aktif = "selected";
			$tidak = "";
		} else {
			$aktif = "";
			$tidak = "selected";
		}
		echo "
				<form action='" . base_url() . "meja/ubah' method='POST' enctype='multipart/form-data'>
			<input type='hidden' name='no_meja' value='" . $result->no_meja . "'>
           <label>Nama Meja</label>
          <input type='text' class='form-control' placeholder='' name='meja' value='" . $result->meja . "'>
          <label>Status</label>
           <div class='form-group'>
                  <select class='form-control' name='aktif'>
                    <option value='yes' " . $aktif . ">Aktif</option>
                    <option value='no' " . $tidak . ">Tidak Aktif</option>
                  </select>
                </div>
          
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>
        <input type='submit' name='submit' class='btn btn-primary' value='Simpan'>
        </form>
			";
	}

	function hapus()
	{
		$id = $this->uri->segment(3);
		$this->Model_meja->del($id);
		redirect('meja');
	}

	function autoid()
	{
		$max = $this->Model_meja->maxdata();
		$result = $max->row();
		$lastid = $result->lastid;
		if (empty($lastid)) {
			$id = "00001";
		} else {
			$lastid = (int)$lastid + 1;
			if (strlen($lastid) == '1') {
				$id = "0000" . $lastid;
			} else if (strlen($lastid) == '2') {
				$id = "000" . $lastid;
			} else if (strlen($lastid) == '3') {
				$id = "00" . $lastid;
			} else if (strlen($lastid) == '4') {
				$id = "0" . $lastid;
			} else {
				$id = $lastid;
			}
		}
		return $id;
	}
}
