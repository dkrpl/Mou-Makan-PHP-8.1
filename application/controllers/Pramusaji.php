<?php 
class Pramusaji extends CI_controller {
		
		function __construct() {
			parent:: __construct();
			//tambahkan ini
			$this->load->Model('Model_meja'); 
			$this->load->model('Model_menu');	
			$this->load->model('Model_kat');
			$this->load->model('Model_transaksi');
			$this->load->model('Model_pesanan');
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
			$this->template->display_admin('pelayan/transaksi',$data);
		}

		function login() {
			$data['title']="LOGIN INSTA RESTO";
			$this->load->view('admin/login.php',$data);
		}

		function cart(){
			$no_meja=$this->uri->segment(3);
			$data['title']="CART INSTA RESTO";
			$data['cart']=$this->cart->contents();
			$data['total']=$this->cart->total();
			$data['meja']=$this->Model_meja->get_byID($no_meja);
			$this->template->display_admin('pelayan/cart',$data);
		}

		function meja(){
			$data['title']="MEJA PRINGGONDANI RESTO";			
			$data['cart']=$this->cart->contents();
			$data['meja']=$this->Model_meja->get_aktif();
			$this->template->display_admin('pelayan/meja',$data);
		}

		function pilihBrg() {
			$id_menu=$this->input->post('id_menu',true);
			$data=$this->Model_menu->get_byID($id_menu);
			$result=$data->row();
			echo "
			<div class='form-group'>
                 <div class='col-xs-12'>
                  <label class='control-label'>Item</label>
                </div>
                  <div class='input-group col-xs-12'>
                <input class='form-control' type='text' id='nama_menu' readonly='readonly' value='".$result->nama_menu."'>
                </div>
            </div>
            <div class='form-group'>
                 <div class='col-xs-12'>
                  <label class='control-label'>Harga</label>
                </div>
                  <div class='input-group col-xs-12'>
                <input class='form-control' id='harga' type='text' readonly='readonly' value='".number_format($result->harga,0 ,'','.')."'>
                </div>
            </div>
			";
		}

		function add_cart() {
			$id_menu=$this->input->post('id_menu',true);
			$nama_menu=$this->input->post('nama_menu',true);
			$qty=$this->input->post('qty',true);
			$disc=$this->input->post('diskon',true);
			$harga=str_replace('.','',$this->input->post('harga',true));
			$sub_total=str_replace('.','',$this->input->post('sub_total',true));
			$data=array('id'=>$id_menu, 'name'=>$nama_menu, 'qty'=>$qty, 'price'=>$harga, 'disc'=>$disc);
		    $tambah=$this->cart->insert($data);
		}

		function del_cart() {
			$rowid=$this->uri->segment(3);			
			$no_meja=$this->uri->segment(4);
            $del=$this->cart->remove($rowid);
            if($del) {
            	redirect('pramusaji/cart/'.$no_meja);
        	}
		}	

		function clear_cart() {
			$no_meja=$this->uri->segment(3);
			$del=$this->cart->destroy();
			redirect('pramusaji/transaksi/'.$no_meja);
		}

		function save_pesanan() {	
			$no_meja=$this->uri->segment(3);		
			$pelayan=$this->session->userdata('username');
			$user=$this->uri->segment(4);
			$tgl=date('Y-m-d');
			foreach ($this->cart->contents() as $items) {				
				$kode_pesanan=$this->autoIDPesanan();
			 	$save=$this->Model_pesanan->add($kode_pesanan,$no_meja,$user,$items['name'],$items['qty'],$items['price'],'no','no','no',$pelayan,$tgl);
			}
			$this->cart->destroy(); //hapus cart
			redirect('pramusaji/meja');
		}

		function clear_meja() {
			$no_meja=$this->uri->segment(3);
			$bersih=$this->Model_meja->gabung($no_meja,'no','no');
			$this->cart->destroy();
			redirect('pramusaji/meja');			 
		}

		function modal_gabung() {
			$no_meja=$this->input->post('no_meja',true);
			$meja=$this->Model_meja->get_byID($no_meja);
			$result=$meja->row();
			$data=$this->Model_meja->blm_dipesan();
			echo "
			<form role='form' method='POST' action='".base_url()."pramusaji/gabung_meja'>
                <div class='form-group'>
                  <label>Nama Meja</label>
                  <input class='form-control' type='text' name='no_meja' readonly='readonly' value='".$result->no_meja."'>
                </div>
                <div class='form-group'>
                <label>Digabung dengan</label>
                  <select class='form-control' name='gabung'>";
                  foreach ($data->result_array() as $row) {
                  	echo "
                    <option value='".$row['no_meja']."'>".$row['meja']."</option>";
                  } echo "
                  </select>
                </div>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-default pull-left' data-dismiss='modal'>Close</button>
                <button type='submit' class='btn btn-primary'>Gabungkan</button>
              </div>
              </form>
			";
		}

		function gabung_meja() {
			$no_meja=$this->input->post('no_meja',true);
			$gabung=$this->input->post('gabung',true);
			$gabung_meja=$this->Model_meja->gabung($no_meja,'yes',$gabung);
			$pesan_gabung=$this->Model_meja->pesan($gabung,'yes');
			redirect('pramusaji/cart/'.$no_meja.'/sukses');
		}


		//tambah daftar menu 
		function daftar_menu() {			
			$data['title']="MENU INSTA RESTO";
			$data['menu']=$this->Model_menu->get();
			$this->template->display_admin('pelayan/daftar_menu',$data);
		}

		function menubykat() {
			$id_kat=$this->uri->segment(3);
			$data['title']="MENU INSTA RESTO";
			$kategori=$this->Model_kat->get_byID($id_kat);
			$result=$kategori->row();
			$data['kategori']=$result->kategori;
			$data['menu']=$this->Model_menu->getByKat($id_kat);
			$this->template->display_admin('pelayan/daftar_menu',$data);
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