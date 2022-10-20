<?php
class Karyawan extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_karyawan');
		if ((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses') == 'admin')) {
			redirect('login', 'refresh');
		}
	}

	function index()
	{
		$data['title'] = "ADMIN Bicara Kopi | Data Karwayan";
		$data['konten'] = $this->Model_karyawan->get();
		$data['autoid'] = $this->autoid();
		$this->template->display_admin('admin/view_akun_karyawan', $data);
	}

	function simpan()
	{
		$id = $this->input->post('id_karyawan', true);
		$nama = $this->input->post('nama', true);
		$gender = $this->input->post('gender', true);
		$alamat = $this->input->post('alamat', true);
		$hp = $this->input->post('hp', true);
		$password = $this->input->post('password', true);
		$no_identitas = $this->input->post('no_identitas', true);
		$tgl_lahir = $this->input->post('tgl_lahir', true);
		$akses = $this->input->post('akses', true);
		$aktif = $this->input->post('aktif', true);
		$this->Model_karyawan->add($id, $nama, $gender, $alamat, $hp, md5($password), $no_identitas, $tgl_lahir, $akses, $aktif);
		redirect('karyawan');
	}

	function ubah()
	{
		$id = $this->input->post('id_karyawan', true);
		$nama = $this->input->post('nama', true);
		$gender = $this->input->post('gender', true);
		$alamat = $this->input->post('alamat', true);
		$hp = $this->input->post('hp', true);
		$password = $this->input->post('password', true);
		$no_identitas = $this->input->post('no_identitas', true);
		$tgl_lahir = $this->input->post('tgl_lahir', true);
		$akses = $this->input->post('akses', true);
		$aktif = $this->input->post('aktif', true);
		if (empty($password)) {
			$data = $this->Model_karyawan->get_byID($id);
			$result = $data->row();
			$kode = $result->password;
		} else {
			$kode = md5($password);
		}
		$this->Model_karyawan->update($id, $nama, $gender, $alamat, $hp, $kode, $no_identitas, $tgl_lahir, $akses, $aktif);
		redirect('karyawan');
	}

	function edit()
	{
		$id = $this->input->post('id_karyawan', true);
		$data = $this->Model_karyawan->get_byID($id);
		$result = $data->row();
		if (!(strcmp($result->aktif, "yes"))) {
			$aktif = "selected";
			$tidak = "";
		} else {
			$aktif = "";
			$tidak = "selected";
		}
		if (!(strcmp($result->akses, "1"))) {
			$kasir = "selected";
			$pramusaji = "";
			$dapur = "";
		} else if (!(strcmp($result->akses, "2"))) {
			$kasir = "";
			$pramusaji = "selected";
			$dapur = "";
		} else {
			$kasir = "";
			$pramusaji = "";
			$dapur = "selected";
		}
		if (!(strcmp($result->gender, "L"))) {
			$laki = "selected";
			$perempuan = "";
		} else {
			$laki = "";
			$perempuan = "selected";
		}
		echo "
				<form action='" . base_url() . "karyawan/ubah' method='POST'  id='modal-content'>
    <div id='modal-content'>
    <label>ID Karyawan</label>
          <input type='text' class='form-control' placeholder='' name='id_karyawan' value='" . $result->id_karyawan . "' readonly>
    <label>Nama Karyawan</label>
          <input type='text' class='form-control' placeholder='' name='nama' value='" . $result->nama . "'>
    <label>No Identitas</label>
          <input type='text' class='form-control' placeholder='' name='no_identitas' value='" . $result->no_identitas . "'>
    <label>Jenis Kelamin</label>
     <div class='form-group'>
                  <select class='form-control' name='gender'>
                    <option value='L' " . $laki . ">L</option>
                    <option value='P' " . $perempuan . ">P</option>
                  </select>
                </div>
    <label>Tanggal Lahir</label>
          <input type='date' class='form-control' placeholder='' name='tgl_lahir' id='datepicker_akhir' data-date-format='yyyy-mm-dd' value='" . $result->tgl_lahir . "'>
    <label>No HP</label>
          <input type='text' class='form-control' placeholder='' name='hp' value='" . $result->hp . "'>
    <label>Alamat</label>
         <textarea class='form-control'  name='alamat'>" . $result->alamat . "</textarea>
    <label>Akses Karyawan</label>
          <div class='form-group'>
                  <select class='form-control' name='akses' >
                    <option value='1' " . $kasir . ">Kasir</option>
                    <option value='2' " . $pramusaji . ">Pramusaji</option>
                    <option value='3' " . $dapur . ">Dapur</option>
                  </select>
                </div>
    <label>Password</label>
          <input type='password' class='form-control' placeholder='Biarkan Kosong jika tidak merubahnya' name='password'>
    </div>
    <label>Status</label>
           <div class='form-group'>
                  <select class='form-control' name='aktif' id='status'>
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

	function set_stat_yes()
	{
		$id = $this->uri->segment(3);
		$status = $this->uri->segment(3);
		$this->Model_karyawan->update_stat_yes($id, $status);
		redirect('karyawan');
	}
	function set_stat_no()
	{
		$id = $this->uri->segment(3);
		$status = $this->uri->segment(3);
		$this->Model_karyawan->update_stat_no($id, $status);
		redirect('karyawan');
	}

	function delete()
	{
		$id = $this->uri->segment(3);
		$this->Model_karyawan->del($id);
		redirect('karyawan');
	}
	function autoid()
	{
		$max = $this->Model_karyawan->maxdata();
		$result = $max->row();
		$lastid = $result->lastid;
		if (empty($lastid)) {
			$id = "00001";
		} else {
			$lastid = $lastid + 1;
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
