<?php
class Kategori extends CI_controller {

		function __construct() {
			parent:: __construct(); 
			$this->load->model('Model_kat');
			$this->load->model('Model_karyawan');
			if((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses')=='admin')) {redirect('login','refresh');}						
		}

		function index(){
			$data['title']="ADMIN PRINGGONDANI RESTO | Data Kategori";
			$data['konten']=$this->Model_kat->get();
			$this->template->display_admin('admin/view_kategori',$data);
		}

		function simpan(){
			$id=$this->autoid();
			$kat=$this->input->post('kategori',true);
			$aktif=$this->input->post('aktif',true);
			$this->Model_kat->add($id,$kat,$aktif);
			redirect('kategori');
		}

		function ubah(){
			$id=$this->input->post('id_kat',true);
			$kat=$this->input->post('kategori',true);
			$aktif=$this->input->post('aktif',true);
			$this->Model_kat->update($id,$kat,$aktif);
			redirect('kategori');
		}

		function edit() {
			$id=$this->input->post('id_kat',true);
			$data=$this->Model_kat->get_byID($id);
			$result=$data->row();
			if (!(strcmp($result->aktif,"yes"))) {
			      $aktif="selected";
			      $tidak="";} 
			    else {  $aktif="";
			      $tidak="selected";}
			echo "
				<form action='".base_url()."kategori/ubah' method='POST' >
				<div id='modal-content'>
			    <label>ID Kategori</label>
			          <input type='text' class='form-control' name='id_kat' value='".$result->id_kat."' readonly>
			    <label>Nama Kategori</label>
			          <input type='text' class='form-control' name='kategori' value='".$result->kategori."'>
			          <label>Status</label>
			           <div class='form-group'>
			                  <select class='form-control' name='aktif'>
			                    <option value='yes' ".$aktif.">Aktif</option>
			                    <option value='no' ".$tidak.">Tidak Aktif</option>
			                  </select> 
			                </div>
					</div>
					</div>
			      <div class='modal-footer'>
			        <button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>
			        <input type='submit' name='submit' class='btn btn-primary' value='Update'>
					 </form>
			";
		}

		function hapus(){
			$id=$this->uri->segment(3);
			$this->Model_kat->del($id);
			redirect('kategori'); 
		}

		function autoid(){
			$max=$this->Model_kat->maxdata();
			$result=$max->row();
			$lastid=$result->lastid;
			if (empty($lastid)) {
				$id="00001"; } 
			else {
			$lastid=$lastid+1;
				if (strlen($lastid)=='1') {
					$id="0000".$lastid;
				} else if (strlen($lastid)=='2') {
					$id="000".$lastid;
				} else if (strlen($lastid)=='3') {
					$id="00".$lastid;
				} else if (strlen($id)=='4') {
					$id="0".$lastid;
				} else {
					$id=$lastid;
				}
			}
			return $id;
		}
}