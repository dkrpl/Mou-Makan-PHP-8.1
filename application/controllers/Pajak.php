<?php
class Pajak extends CI_controller {
		
		function __construct() {
			parent:: __construct();
			$this->load->model('Model_pajak');
			if(!$this->session->userdata('logged_in')) {redirect('login','refresh');}
		}

		function index() {
			$data['title']="ADMIN PRINGGONDANI RESTO";
			$data['pajak']=$this->Model_pajak->get();
			$this->template->display_admin('admin/pajak',$data);
		}

		function ubah() {
			$tgl=date('Y-m-d');
			$jam=date('H:i:s');
			$user=$this->session->userdata('username');
			$id_pajak=$this->input->post('id_pajak',true);
			$pajak=$this->input->post('pajak',true);
			$ubah_pajak=str_replace(".", "", $pajak);
			$ubah=$this->Model_pajak->ubah($id_pajak,$ubah_pajak);
			if($ubah==TRUE) {
				$saveLog=$this->Model_pajak->addLogpajak($user,$tgl,$jam,$pajak);
				redirect('pajak');
			}

		}
}