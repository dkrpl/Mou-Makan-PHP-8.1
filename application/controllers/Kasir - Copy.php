<?php 
class Kasir extends CI_controller {
		
		function __construct() {
			parent:: __construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('Model_menu');
			$this->load->model('Model_transaksi');
			$this->load->model('Model_pesanan');
			$this->load->model('Model_meja');
			$this->load->model('Model_karyawan');
			if((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses')=='1')) {redirect('login','refresh');}
			}

		function index() {
			$data['title']="ADMIN PRINGGONDANI RESTO";
			$this->load->view('admin/login',$data);
		}
		function nama_user(){
			if($this->session->userdata('akses')=='admin') {
  			$user='administrasi';
			} else {
 			 $id=$this->session->userdata('username');
 			 $data=$this->Model_karyawan->get_byID($id);
  			if($data->num_rows() > 0) {
   			 $result=$data->row();
   			 $user=$result->nama;
  			} 
		}
		return $user;
		}

		function transaksi() {
			$data['title']="KASIR PRINGGONDANI RESTO";
			$data['meja']=$this->Model_meja->get_aktif();
			$data['barang']=$this->Model_menu->getBrg();
			$this->template->display_admin('admin/ksr_transaksi',$data);
		}

		function show_order() {
			$no_meja=$this->input->post('no_meja',true);
			$data=$this->Model_pesanan->getByPesanan($no_meja);
			$no=0;
			$total=0;
			foreach ($data->result_array() as $row) {
				$no++;
				echo "
				<tr>
                 <td>".$no."<input type='hidden' id='meja' value='".$no_meja."'></td>
                 <td id='kode' class='primary'>".$row['kode_pesanan']."</td>
                 <td>".$row['menu']."</td>
                 <td align='right'>".number_format($row['harga'],0 ,'','.')."</td>
                 <td align='center'>".$row['qty']."</td>
                 <td align='right' class='subtotal'>".number_format($row['harga']*$row['qty'],0 ,'','.')."</td>
                 <td align='center'><a href='#' onclick='confirmDel($(this))' class='btn btn-danger btn-flat btn-xs'><i class='fa fa-trash'></i></a> <a href='#' class='btn btn-info btn-flat btn-xs' data-toggle='modal' data-target='#myModal' onclick='confirmEdit($(this))'><i class='fa fa-pencil'></i></a> <a href='#' onclick='confirmDel($(this))' class='btn btn-warning btn-flat btn-xs'><i class='fa fa-close'></i>Batalkan Pesanan</a> </td>
               </tr>";
               $total=$total+($row['harga']*$row['qty']);
			}	
			if($total > 0) {
				$jml=$total;
			} else {
				$jml='0';
			}			
		}

		function langsung(){
			$data['title']=$this->autoIDTransaksi();
			$data['barang']=$this->Model_menu->getBrg();			
			$data['cart']=$this->cart->contents();
			$data['total']=$this->cart->total();
			$this->template->display_admin('admin/ksr_langsung',$data);
		}


		function cariBrg() {
			$keyword=$this->input->post('keyword', true);
			$data=$this->Model_menu->cariBrg($keyword);
			foreach ($data->result() as $result) {
			?>
		<div class="col-md-4 col-sm-6 col-xs-12"> 
          <div class="info-box">
            <span class="info-box-icon bg-aqua" style="background-image: url('<?php echo base_url()."assets/menu/".$result->gambar; ?>');background-size: cover;"></span>
            <div class="info-box-content">
              <span class="info-box-text"><?php echo $result->nama_menu; ?></span>
              <span class="info-box-number">Rp. <?php echo number_format($result->harga,2); ?></span>
              <span class="info-box-text"><button class="btn btn-success" onclick="pilihBrg('<?php echo $result->id_menu; ?>')" data-dismiss="modal">Pilih</button></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <?php
			}
		}

		function pilihBrg() {
			$id_menu=$this->input->post('id_menu',true);
			$data=$this->Model_menu->get_byID($id_menu);
			$result=$data->row();
			echo "
			<div class='form-group'>
                 <div class='col-lg-2'>
                  <label class='control-label'>Item</label>
                </div>
                  <div class='input-group col-lg-10'>
                <input class='form-control' type='text' id='nama_menu' readonly='readonly' value='".$result->nama_menu."'>
                </div>
            </div>
            <div class='form-group'>
                 <div class='col-lg-2'>
                  <label class='control-label'>Harga</label>
                </div>
                  <div class='input-group col-lg-6'>
                <input class='form-control' id='harga' type='text' readonly='readonly' value='".number_format($result->harga,0 ,'','.')."' style='text-align:right;'>
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
			$data=array('id'=>$id_menu, 'name'=>$nama_menu, 'qty'=>$qty, 'price'=>$harga, 'option'=>array('disc'=>$disc));
		    $tambah=$this->cart->insert($data);
		    $no=0;
        	foreach ($this->cart->contents() as $items) {
          	$no++;
            echo "
	              <tr>
	               <td>".$no."</td>
	               <td>".$items['name']."</td>
	               <td>".number_format($items['price'],0 ,'','.')."</td>
	               <td>".$items['qty']."</td>";
	            if($this->cart->has_options($items['rowid'])==TRUE) {
	            	foreach ($this->cart->product_options($items['rowid']) as $disc=>$disc_value) {
	            	echo "
	            	<td>".$disc_value."</td>";	            	
	            	}
	            }
	               echo "
	               <td>".number_format($items['subtotal'],0 ,'','.')."</td>
	               <td><a href='".base_url()."/kasir/del_cart/".$items['rowid']."' class='btn btn-danger btn-flat btn-xs' id='del_trans'>Hapus</a></td>
	               </tr>
            ";
		    }
		}

		function del_cart() {
			$rowid=$this->uri->segment(3);
            $del=$this->cart->remove($rowid);
            if($del) {
            	redirect('kasir/langsung');
        	}
		}	

		function clear_cart() {//
			$del=$this->cart->destroy();
			//redirect('kasir/langsung');
		}

		function save_langsung(){//
			$id_transaksi=$this->autoIDTransaksi();
			$meja='none';
			$tgl=date('Y-m-d');
			$jam=date('H:i:s');
			$bayar=$this->input->post('bayar',true);
			$kembali=$this->input->post('kembali',true);
			$id_karyawan=$this->session->userdata('username');
			$nama=$this->input->post('nama',true);
			$total=$this->cart->total();
			$i=1;
			foreach ($this->cart->contents() as $items) {
				$id_pesan=$this->autoIDPesanan();
				$saveDet=$this->Model_transaksi->addDet($id_transaksi,$id_pesan,$items['name'],$items['qty'],'0',$items['subtotal'],'yes');	//simpan di Det Transaksi	
				//$id_pesan=$this->autoIDPesanan();
				
				$saveOrder=$this->Model_transaksi->add($id_pesan,$meja,$nama,$items['name'],$items['qty'],$items['price'],'yes','no','no',$id_karyawan,$tgl);
				$save=$this->Model_transaksi->add($id_transaksi,$id_pesan,$id_karyawan,$tgl,$jam,'0',$total,'yes');	//simpan transaksi
			$i+1;
			}
			
			$this->clear_cart();
			echo $this->print_dot("transaksi",$meja,$id_transaksi,$bayar,$kembali,$nama);
			//redirect('kasir/print_langsung/$id_transaksi/$id_karyawan');	
		}

		function print_langsung(){
			$id_transaksi=$this->uri->segment(3);
			$id_karyawan=$this->uri->segment(4);	
			$data=$this->Model_transaksi->getbyID($id_transaksi);
			echo "
			<body onload='cetak()'>
			<h3><?php echo $this->config->item('header_print');?></h3>
			<hr>
			<tr><td>ID <b>".$id_transaksi."</b></td>
			<td>Kasir <b>".$id_karyawan."</b></td></tr>
			<hr>
			<table>
				<tr>
				<th align='left'>Item</th>
				<th>Harga</th>
				<th>Qty</th>
				<th>Disc</th>
				<th>Sub</th>
				</tr>";
				$jumlah=0;
				foreach ($data->result_array() as $row) {
					$jumlah=$jumlah+$row['total'];
			echo "
				<tr>
				<td>".$row['nama_menu']."</td>
				<td align='right'>".number_format($row['total']/$row['qty'],0 ,'','.')."</th>
				<td align='center'>".$row['qty']."</td>
				<td align='center'>0</td>
				<td align='right'>".number_format($row['total'],0 ,'','.')."</td>
				</tr>";
				}
				echo "
				<tr>
				<th align='left'>Total</th>
				<th></th>
				<th></th>
				<th></th>
				<th align='right'>".number_format($jumlah,0 ,'','.')."</th>
				</tr>
				<tr>
				<th align='left'>Bayar</th>
				<th></th>
				<th></th>
				<th></th>
				<th align='right'>".number_format($jumlah,0 ,'','.')."</th>
				</tr>
				<tr>
				<th align='left'>Kembali</th>
				<th></th>
				<th></th>
				<th></th>
				<th align='right'>0</th>
				</tr>
			</table>
			<hr>
			<p>TERIMA KASIH</p>
			</body>
			 <!-- jQuery 2.2.3 -->
			<script src='".base_url()."assets/plugins/jQuery/jquery-2.2.3.min.js'></script>
			<script>
			function cetak() {
			    window.onafterprint = function(e){
			        $(window).off('mousemove', window.onafterprint);
			        console.log('Print Dialog Closed..');
			    };
			    window.print();
			    setTimeout(function(){
			        $(window).one('mousemove', window.onafterprint);
			    }, 1);
			 }
			</script>
			";
		}



		function save_transaksi() {
			//$id_transaksi=$this->autoid();
			$id_transaksi=$this->autoIDTransaksi();
			$id_pesanan=$this->autoIDPesanan();
			$tgl=date('Y-m-d');
			$jam=date('H:i:s');
			$id_karyawan=$this->session->userdata('username'); //karyawan coba
			$no_meja=$this->input->post('no_meja',true);
			$bayar=$this->input->post('bayar',true);
			$kembali=$this->input->post('kembali',true);
			$kode=$this->input->post('kode',true);
			$nama=$this->Model_pesanan->getPembeli($kode);
			echo $this->print_dot("pesanan",$no_meja,$id_transaksi,$bayar,$kembali,$nama);
			$data=$this->Model_pesanan->getByPesanan($no_meja);
			$result=$data->row();
			$total=0;
			foreach ($data->result_array() as $row) {
				$subtotal=$row['qty']*$row['harga'];
				$save_det=$this->Model_transaksi->addDet($id_transaksi,$row['kode_pesanan'],$row['menu'],$row['qty'],'0',$subtotal,'yes');
				$total=$total+$subtotal;
				$dibayar=$this->Model_pesanan->dibayar($row['kode_pesanan'],'yes');
				$save=$this->Model_transaksi->add($id_transaksi,$row['kode_pesanan'],$id_karyawan,$tgl,$jam,'0',$total,'yes');
			}	
				//simpan transaksi		
		}

		//fungsi del order meja
		function delorder() {
			$no_meja=$this->input->post('no_meja',true);
			$kode_pesanan=$this->input->post('kode_pesanan',true);
			//del pesanan
			$del=$this->Model_pesanan->del($kode_pesanan);
			$data=$this->Model_pesanan->getByPesanan($no_meja);
			$no=0;
			$total=0;
			foreach ($data->result_array() as $row) {
				$no++;
				echo "
				<tr>
                 <td>".$no."<input type='hidden' id='meja' value='".$no_meja."'></td>
                 <td class='primary'>".$row['kode_pesanan']."</td>
                 <td>".$row['menu']."</td>
                 <td align='right'>".number_format($row['harga'],0 ,'','.')."</td>
                 <td align='center'>".$row['qty']."</td>
                 <td align='right' class='subtotal'>".number_format($row['harga']*$row['qty'],0 ,'','.')."</td>
                 <td align='center'><a href='#' onclick='confirmDel($(this))' class='btn btn-danger btn-flat btn-xs'><i class='fa fa-trash'></i></a> <a href='#' class='btn btn-info btn-flat btn-xs' data-toggle='modal' data-target='#myModal' onclick='confirmEdit($(this))'><i class='fa fa-pencil'></i></a></td>
               </tr>";
               $total=$total+($row['harga']*$row['qty']);
			}	
			if($total > 0) {
				$jml=$total;
			} else {
				$jml='0';
			}	

		}
		//fungsi edit order meja
		function editorder() {
			$kode_pesanan=$this->input->post('kode_pesanan',true);
			$subtotal=$this->input->post('subtotal',true);
			$no_meja=$this->input->post('no_meja',true);
			$data=$this->Model_pesanan->getByID($kode_pesanan);
			$result=$data->row();
			echo "
          <div class='form-group'>
                 <div class='col-xs-12'>
                  <label class='control-label'>Kode Pesanan</label>
                </div>
                  <div class='input-group col-xs-12'>
                <input class='form-control' type='text' id='kode_pesanan' readonly='readonly' value='".$result->kode_pesanan."'>
                </div>
          </div>        
          <div class='col-lg-12'>
                  <label class='control-label'>Barang/Item</label>
                </div>
                <div class='input-group'>
                <input class='form-control col-lg-12' type='text' name='id_menu' id='id_menu' placeholder='disi jika ganti menu'>
                    <span class='input-group-btn'>
                      <button type='button' class='btn btn-info btn-flat' data-toggle='modal' data-target='#myBarang'>Cari</button>
                    </span>
                </div>
        <div id='item'>
          <div class='form-group'>
                 <div class='col-xs-12'>
                  <label class='control-label'>Item</label>
                </div>
                  <div class='input-group col-xs-12'>
                <input class='form-control' type='text' id='nama_menu' readonly='readonly' value='".$result->menu."'>
                </div>
          </div>
          <div class='form-group'>
                 <div class='col-xs-12'>
                  <label class='control-label'>Harga</label>
                </div>
                  <div class='input-group col-xs-12'>
                <input class='form-control' id='harga' type='text' readonly='readonly' placeholder='0' value='".$result->harga."'>
                </div>
          </div>
        </div>
          <div class='form-group'>
                 <div class='col-xs-12'>
                  <label class='control-label'>Disc(%)</label>
                </div>
                  <div class='input-group col-xs-12'>
                <input class='form-control' type='number' id='diskon' placeholder='0' onkeyup='disc(this.value)'>
                </div>
            </div>
            <div class='form-group'>
                 <div class='col-xs-12'>
                  <label class='control-label'>Qty</label>
                </div>
                  <div class='input-group col-xs-12'>
                <input class='form-control' type='number' id='qty' placeholder='0' value='".$result->qty."' onkeyup='subTotal(this.value)'>
                </div>
            </div>
            <div class='form-group'>
                 <div class='col-xs-12'>
                  <label class='control-label'>Sub-Total</label>
                </div>
                  <div class='input-group col-xs-12'>
                <input class='form-control' type='text' readonly='readonly' id='sub_total' placeholder='0' value='".$subtotal."'>
                </div>
            </div>
      </div>
      <div class='modal-footer'>
      <input type='hidden' value='".$no_meja."' id='no_meja'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>
        <button type='button' onclick='updateOrder()' class='btn btn-primary' data-dismiss='modal'>Ubah</button>
			";
		}

		//fungsi update order
		function updateorder() {
			$kode_pesanan=$this->input->post('kode_pesanan',true);
			$menu=$this->input->post('menu',true);
			$harga=$this->input->post('harga',true);
			$qty=$this->input->post('qty',true);
			$no_meja=$this->input->post('no_meja',true);
			$updateorder=$this->Model_pesanan->update_order($kode_pesanan,$menu,$qty,$harga);
			if($updateorder==TRUE) {
				$data=$this->Model_pesanan->getByPesanan($no_meja);
				$no=0;
				$total=0;
				foreach ($data->result_array() as $row) {
					$no++;
					echo "
					<tr>
	                 <td>".$no."<input type='hidden' id='meja' value='".$no_meja."'></td>
	                 <td class='primary'>".$row['kode_pesanan']."</td>
	                 <td>".$row['menu']."</td>
	                 <td align='right'>".number_format($row['harga'],0 ,'','.')."</td>
	                 <td align='center'>".$row['qty']."</td>
	                 <td align='right' class='subtotal'>".number_format($row['harga']*$row['qty'],0 ,'','.')."</td>
	                 <td align='center'><a href='#' onclick='confirmDel($(this))' class='btn btn-danger btn-flat btn-xs'><i class='fa fa-trash'></i></a> <a href='#' class='btn btn-info btn-flat btn-xs' data-toggle='modal' data-target='#myModal' onclick='confirmEdit($(this))'><i class='fa fa-pencil'></i></a></td>
	               </tr>";
	               $total=$total+($row['harga']*$row['qty']);
				}	
				if($total > 0) {
					$jml=$total;
				} else {
					$jml='0';
				}	
			}
		}

		function new_transaksi() {
			$this->clear_cart();
			redirect('kasir/langsung');
		}

		function autoid() {
			$today=date('Ymd'); //ambil data tanggal sekarang
			$lastID=$this->Model_pesanan->maxIDTransaksi($today);
			$data=$lastID->row();
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
		function print_dot($data_print,$no_meja,$id_transaksi,$bayar,$kembali,$pembeli)
		{
			//$id_transaksi=$this->autoid();
			//$no_meja=$this->input->post('no_meja',true);
			$data="";
			//$pembeli=$this->Model_pesanan->getPembeli($id_transaksi);
			if($data_print=="pesanan"){
			$data=$this->Model_pesanan->getByPesanan($no_meja);
			}else{
			$data=$this->Model_transaksi->view_print($id_transaksi);
			}
			$no=0;
			$total=0;
			?>
			
			<div class="title">
			<center>
				<?php echo $this->config->item('header_print');?><br>
				<small><?php echo $this->config->item('alamat_print');?></small><hr/>
				
			</center>
		</div>
		<div class="content">
			No : <?php echo $id_transaksi;?><br>
			Pembeli: <?php echo urldecode($pembeli);?></br>
			Tanggal: <?php echo date('d-m-Y');?></br>
			Kasir: <?php echo $this->nama_user();?>
			<!-- tampilkan ketika dalam mode print -->
			<hr/>
			<table class="content"> 
			<tr>
			<td width="50%">Nama</td>
			<td width="15%">Qty</td>
			<td>Harga</td>
			</tr>
			<?php
			foreach ($data->result_array() as $row) {
				$no++;
				?>
			<tr>
			<td><?php echo $row['menu']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td>Rp <?php echo number_format($row['harga']*$row['qty'],0 ,'','.'); ?>,-</td>
			</tr>
			
				<?php
               $total=$total+($row['harga']*$row['qty']);
			}	
			if($total > 0) {
				$jml=$total;
			} else {
				$jml='0';
			}			
		?>
		</table>
			<hr>
			<table>
			<tr>
			<td width="65%">Total</td>
			<td>Rp <?php echo number_format($jml,0 ,'','.'); ?>,-</td>
			</tr>
			<tr>
			<td width="65%">Bayar</td>
			<td>Rp <?php echo number_format($bayar,0 ,'','.'); ?>,-</td>
			</tr>
			<tr>
			<td width="65%">Kembali</td>
			<td>Rp <?php echo $kembali ?>,-</td>
			</tr>
			</table>
			

		</div>
		<br>
		<center class="footer">
		<?php echo $this->config->item('footer_print');?>
		</center>
		<br>
		<br>
		<br>
		<br>
		<hr>
		</div>
		<?php
		}
		function ganti_sift() {
			$this->load->model('Model_report');
			$this->load->model('Model_log_sift');
			$id=$this->session->userdata('username');
			$waktu=date('H')+1; //tambahkan waktu 1 jam untuk report
			$tgl=date('Y-m-d');
			$data=$this->Model_report->lastShift($waktu,$tgl,$id);
			//update data ke log_sift
			$time=date('H:i:s');
			$this->Model_log_sift->add($id,$tgl,$time);
			$modal=$this->Model_report->modal();
			$kasir=$this->nama_user();
			$total=0;
			if(count($data)>0) {
			foreach ($data->result_array() as $row) {
				 $total=$total+$row['total_penjualan'];
			}
			//echo $kasir."<br>".$penghasilan;
				$this->print_sift($kasir,$total,$modal);
			 }
		}
		
		function coba_print(){
		echo "'<br><br><br><br><br><br><br>.''";
		}
		function print_sift($kasir,$total,$modal)
		{?>
		  <!-- ss yang digunakan tampilkan ketika dalam mode print -->
  <link href="<?php echo base_url().'assets/';?>print.css" rel="stylesheet" media="print">
		  <!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/';?>plugins/jQuery/jquery-2.2.3.min.js"></script>
		<div id="print" style="display: none;">
					<div class="title">
					<center>
				<?php echo $this->config->item('header_print');?><br>
				<small><?php echo $this->config->item('alamat_print');?></small><hr/>
				
			</center>
		</div>
		<div class="content">
			Tanggal: <?php echo date('d-m-Y');?></br>
			Waktu: <?php echo date('H:i:s');?></br>
			Kasir: <?php echo $kasir;?>
			<!-- tampilkan ketika dalam mode print -->
			<hr/>
			<table class="content">
			<tr>
			<td width="55%">PENJUALAN</td>
			<td>Rp <?php echo number_format($total,0 ,'','.'); ?>,-</td>
			</tr>
		</table>
			<hr>
			<table class="content">
			<tr>
			<td width="55%">MODAL</td>
			<td>Rp <?php echo number_format($modal,0 ,'','.'); ?>,-</td>
			</tr>
			<tr>
			<td width="55%">PENJUALAN</td>
			<td>Rp <?php echo number_format($total,0 ,'','.'); ?>,-</td>
			</tr>
			<tr>
			<td width="55%">HASIL AKHIR</td>
			<td>Rp <?php echo number_format($modal+$total,0 ,'','.'); ?>,-</td>
			</tr>
			</table>
			<br>
		<br>
		<br>
		<br>
		<hr>

		</div>
		
		</div>

<script>
$('document').ready(function(){
function counter(time, url){
	var interval = setInterval(function(){
		$('#waktu').text(time);
		time = time - 1;

		if(time == 0){
			clearInterval(interval);
			window.location = url;
		}
	}, 500);
}
function printContent(el){
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(el).innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  //document.body.innerHTML = restorepage;
}
printContent('print');
counter(1, '<?php echo site_url('login/logout');?>');
});
</script>
		<?php
		}

		//fungsi autoID pesanan
		function autoIDTransaksi(){
			$today=date('Ymd'); //ambil data tanggal sekarang
			$lastID=$this->Model_transaksi->maxIDTransaksi($today);
			$data=$lastID->row();//ambil data transaksi hari aktif
			if(empty($data->lastID)) {
				$id="TRANS-".$today."00001"; //jika data hari ini kosong
			} else {
				$lasturut=substr($data->lastID,14,5);//ambil data 5 akhir
				$lastid=$lasturut+1; //tambah nilainya
					if (strlen($lastid)=='1') {
						$id="TRANS-".$today."0000".$lastid;
					} else if (strlen($lastid)=='2') {
						$id="TRANS-".$today."000".$lastid;
					} else if (strlen($lastid)=='3') {
						$id="TRANS-".$today."00".$lastid;
					} else if (strlen($lastid)=='4') {
						$id="TRANS-".$today."0".$lastid;
					} else {
						$id="TRANs-".$today.$lastid;
					}
			}
			return $id;
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