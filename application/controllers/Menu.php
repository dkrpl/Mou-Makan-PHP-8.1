<?php
class Menu extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_menu');
		$this->load->model('Model_kat');
		$this->load->model('Model_karyawan');
		if ((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses') == 'admin')) {
			redirect('login', 'refresh');
		}
	}

	function index()
	{
		$data['title'] = "ADMIN PRINGGONDANI RESTO | Data Menu";
		$data['kategori'] = $this->Model_kat->get();
		$data['konten'] = $this->Model_menu->get();
		$data['autoid'] = $this->autoid();
		$this->template->display_admin('admin/view_menu', $data);
	}

	public function _uploadImg($id_menu, $jenis, $gambar)
	{
		$config['upload_path'] = './assets/' . $jenis . '/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 5120;
		$config['overwrite'] = true;
		$config['file_name'] = date('dmYHis') . '_' . $id_menu;
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($gambar)) {
			return false;
			// var_dump($this->upload->display_errors());
		} else {
			return $this->upload->data('file_name');
		}
	}

	function simpan()
	{
		$id_menu = $this->autoid();
		$kategori = $this->input->post('kategori', true);
		$menu = $this->input->post('nama_menu', true);
		$harga = $this->input->post('harga', true);
		$aktif = $this->input->post('aktif', true);
		$uploadFoto = $this->_uploadImg($id_menu, 'menu', 'gambar');
		if ($uploadFoto) {	//jika file telah di upload		
			//menyimpan data ke Database
			$gambar = $uploadFoto;
		} else {
			$gambar = 'no-image.png';
		}
		$this->Model_menu->add($id_menu, $kategori, $menu, $gambar, $harga, $aktif);
		redirect('menu');
	}

	function ubah()
	{
		$id_menu = $this->input->post('id_menu', true);
		$kategori = $this->input->post('kategori', true);
		$menu = $this->input->post('nama_menu', true);
		// $gambar = $id_menu . ".jpg";
		$harga = $this->input->post('harga', true);
		$aktif = $this->input->post('aktif', true);
		//jika update tanpa gambar
		if (!empty($_FILES['gambar']['name'])) {
			$data = $this->Model_menu->get_byID($id_menu);
			$result = $data->row();
			$image = $result->gambar;
			if ($image != 'no-image.png') {
				unlink('./assets/menu/' . $image);
			}
			$uploadFoto = $this->_uploadImg($id_menu, 'menu', 'gambar');
			if ($uploadFoto) {
				$gambar = $uploadFoto;
				$this->Model_menu->update($id_menu, $kategori, $menu, $gambar, $harga, $aktif);
				redirect('menu');
				// var_dump($simpan);
			} else {
				$error = $this->upload->display_errors();
				echo $error;
			}
		}
		$this->Model_menu->updateNoImg($id_menu, $kategori, $menu, $harga, $aktif);
		redirect('menu');
	}

	// function simpan()
	// {
	// 	$id_menu = $this->autoid();
	// 	$kategori = $this->input->post('kategori', true);
	// 	$menu = $this->input->post('nama_menu', true);
	// 	$gambar = $id_menu . ".jpg";
	// 	$harga = $this->input->post('harga', true);
	// 	$aktif = $this->input->post('aktif', true);
	// 	//config untuk upload file			
	// 	$config = array(
	// 		'allowed_types' => 'jpg|jpeg', 'upload_path' => './assets/menu/', 'max_size' => '1024', 'file_name' => $id_menu
	// 	);
	// 	$this->upload->initialize($config);
	// 	if ($this->upload->do_upload('gambar')) {	//jika file telah di upload		
	// 		//menyimpan data ke Database
	// 		$this->Model_menu->add($id_menu, $kategori, $menu, $gambar, $harga, $aktif);
	// 		redirect('menu');
	// 	} else {
	// 		$error = $this->upload->display_errors();
	// 		echo $error;
	// 	}
	// }



	// function ubah()
	// {
	// 	$id_menu = $this->input->post('id_menu', true);
	// 	$kategori = $this->input->post('kategori', true);
	// 	$menu = $this->input->post('nama_menu', true);
	// 	$gambar = $id_menu . ".jpg";
	// 	$harga = $this->input->post('harga', true);
	// 	$aktif = $this->input->post('aktif', true);
	// 	//config untuk upload file			
	// 	$config = array(
	// 		'allowed_types' => 'jpg|jpeg', 'upload_path' => './assets/menu/', 'max_size' => '1024', 'file_name' => $id_menu
	// 	);
	// 	//jika update tanpa gambar
	// 	if (empty($_FILES['gambar']['tmp_name'])) {
	// 		$this->Model_menu->updateNoImg($id_menu, $kategori, $menu, $harga, $aktif);
	// 		redirect('menu');
	// 	} else { //upload dengan gambar
	// 		//hapus gambar lama
	// 		$data = $this->Model_menu->get_byID($id_menu);
	// 		$result = $data->row();
	// 		if (!empty($result->gambar)) {
	// 			$path = (APPPATH . '../assets/menu/');
	// 			$hapus = unlink($path . $result->gambar);
	// 			if ($hapus) {
	// 				//$this->Model_menu->del($id_menu);
	// 				$this->upload->initialize($config);
	// 				if ($this->upload->do_upload('gambar')) {
	// 					$this->Model_menu->update($id_menu, $kategori, $menu, $gambar, $harga, $aktif);
	// 					redirect('menu');
	// 				} else {
	// 					$error = $this->upload->display_errors();
	// 					echo $error;
	// 				}
	// 			}
	// 		}
	// 	}
	// }

	function edit()
	{
		$id = $this->input->post('id_menu', true);
		$data = $this->Model_menu->get_byID($id);
		$kategori = $this->Model_kat->get();
		$result = $data->row();
		if (!(strcmp($result->aktif, "yes"))) {
			$aktif = "selected";
			$tidak = "";
		} else {
			$aktif = "";
			$tidak = "selected";
		}
		echo "
			<form action='" . base_url() . "menu/ubah' method='POST' enctype='multipart/form-data'>
			<input type='hidden' name='id_menu' value='" . $result->id_menu . "'>
           <label>Nama Menu</label>
          <input type='text' class='form-control' placeholder='' name='nama_menu' value='" . $result->nama_menu . "'>
          <label>Kategori Menu</label>
           <div class='form-group'>
                  <select class='form-control' name='kategori'>
                  <option>--Pilih Kategori--</option>";
		foreach ($kategori->result_array() as $row) {
			$data = $this->Model_kat->get_byID($row['id_kat']);
			$pilihkat = $data->row();
			if (!(strcmp($result->kategori, $pilihkat->id_kat))) {
				$selected = "selected";
			} else {
				$selected = "";
			}
			echo "<option value='" . $row['id_kat'] . "' " . $selected . ">" . $row['kategori'] . "</option>";
		}
		echo "</select>
                </div>
           <label>Harga Menu</label>
          <input type='text' class='form-control' placeholder='' name='harga' value='" . $result->harga . "'>
          <label>Upload Gambar</label>
          <div class='form-group'>                
                <input type='file' name='gambar'>
              </div>  
          <label>Status Menu</label>
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
		$data = $this->Model_menu->get_byID($id);
		$result = $data->row();
		if ($result->gambar != 'no-image.png') {
			$path = (APPPATH . '../assets/menu/');
			$hapus = unlink($path . $result->gambar);
			$this->Model_menu->del($id);
			redirect('menu');
		} else if ($result->gambar == 'no-image.png') {
			//hapus di database saja
			$this->Model_menu->del($id);
			redirect('menu');
		}

		// if (!empty($result->gambar)) {
		// 	$path = (APPPATH . '../assets/menu/');
		// 	$hapus = unlink($path . $result->gambar);
		// 	if ($hapus) {
		// 		$this->Model_menu->del($id);
		// 		redirect('menu');
		// 	}
		// }
	}

	function autoid()
	{
		$max = $this->Model_menu->maxdata();
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
