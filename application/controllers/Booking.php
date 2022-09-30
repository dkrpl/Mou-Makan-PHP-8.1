<?php 
class Booking extends CI_controller {

		function __construct() {
			parent:: __construct();
			//tambahkan ini
			$this->load->Model('Model_meja'); 
			$this->load->model('Model_menu');	
			$this->load->model('Model_pemesan');
			$this->load->model('Model_karyawan');
			if((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses')=='2')) {redirect('login','refresh');}
			}

		function transaksi() {
			$data['title']="PRINGGONDANI RESTO";	
			$no_meja=$this->uri->segment(3);
			$apakahdipesan=$this->Model_meja->getbyIDdipesan($no_meja);
			$result=$apakahdipesan->row(); 
			if(empty($result)) { //jika belum
				$pesan=$this->Model_meja->pesan($no_meja,'yes');
				$meja_dipesan=$no_meja;
				// echo "pesan baru";
			} else { //jika sudah
				$meja_dipesan=$result->no_meja;
				// echo "pesan lagi";
			}				 
			$data['barang']=$this->Model_menu->getBrg();
			$data['jml_item']=$this->cart->total_items();
			$data['meja']=$this->Model_meja->get_byID($meja_dipesan);
			$data['data']=$this->Model_pemesan->get();
			$data['opsi_meja']=$this->Model_pemesan->get_meja();
			$this->template->display_admin('admin/ksr_transaksi_booking',$data);
		}

		function login() {
			$data['title']="LOGIN INSTA RESTO";
			$this->load->view('admin/login.php',$data);
		}

		function meja(){
			$data['title']="MEJA PRINGGONDANI RESTO";			
			$data['cart']=$this->cart->contents();
			$data['meja']=$this->Model_meja->get_aktif();
			$this->template->display_admin('admin/ksr_booking',$data);
		}

		

		function save_pesanan() {	
			$id=$this->input->post('id',true);
			$nama=$this->input->post('nama',true);
			$tanggal=$this->input->post('tanggal',true);
			$jam=$this->input->post('jam',true);
			$meja=$this->input->post('no_meja',true);
			$alamat=$this->input->post('alamat',true);
			$no_hp=$this->input->post('no_hp',true);
			 $data=array(
			 			'id'=>$id,
			 			'nama'=>$nama,
			 			'tanggal'=>$tanggal,
			 			'jam'=>$jam,
			 			'no_meja'=>$meja,
			 			'alamat'=>$alamat,
			 			'no_hp'=>$no_hp);
			$this->Model_pemesan->simpan($id, $nama, $tanggal, $jam,$meja,$alamat,$no_hp); //hapus cart
			//untuk mengubah status meja dipesan
			$this->Model_meja->pesan($meja,'yes');
			redirect('booking/transaksi');
		}

		function clear_meja() {
			$no_meja=$this->uri->segment(3);
			$bersih=$this->Model_meja->gabung($no_meja,'no','no');
			$this->cart->destroy();
			redirect('booking/meja');			 
		}
		function delete()
	{
		$id=$this->uri->segment(3);
		$no_meja=$this->uri->segment(4);
		//ambil data no meja
		// $meja=$this->Model_pemesan->edit($id);
		// $hasil=$meja->result();
		// $no_meja=$hasil->no_meja;
		$this->Model_pemesan->delete($id);
echo $no_meja;
		//mengubah status meja dipesan no
		$this->Model_meja->pesan($no_meja,'no');
		redirect('Booking/transaksi');
	}

		
		//fungsi autoID pesanan
		function autoIDPesanan(){
			$today=date('Ymd'); //ambil data tanggal sekarang
			$lastID=$this->Model_pesanan->maxIDTransaksi($today);
			$data=$lastID->row();//ambil data transaksi hari aktif
			if(empty($data->lastID)) {
				$id=$today."00001"; //jika data hari ini kosong
			} else {
				$lasturut=substr($data->lastID,8,5);//ambil data 5 akhir
				$lastid=$lasturut+1; //tambah nilainya
					if (strlen($lastid)=='1') {
						$id=$today."0000".$lastid;
					} else if (strlen($lastid)=='2') {
						$id=$today."000".$lastid;
					} else if (strlen($lastid)=='3') {
						$id=$today."00".$lastid;
					} else if (strlen($lastid)=='4') {
						$id=$today."0".$lastid;
					} else {
						$id=$today.$lastid;
					}
			}
			return $id;
		}
}