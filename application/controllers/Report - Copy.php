<?php
class Report extends CI_controller {
		
		function __construct() {
			parent:: __construct();
			date_default_timezone_set('Asia/Jakarta');
			//load library PHPExcel
			$this->load->library('Excel/PHPExcel');
			$this->load->model('Model_report');
			$this->load->model('Model_karyawan');
			$this->load->model('Model_kat');
			if((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses')=='admin')) {redirect('login','refresh');}
		}

		function index() {
			$data['title']="ADMIN PRINGGONDANI RESTO | Laporan_penjualan".date('H:i:s');
			$this->template->display_admin('admin/lap_transaksi',$data);
		}

		function rekap() {
			$awal=$this->input->post('awal',true);
			$akhir=$this->input->post('akhir',true);
			$id_karyawan=$this->session->userdata('username');
			if($this->session->userdata('akses')=='admin'){
			$data=$this->Model_report->showReport_admin($awal,$akhir);
			}else{
			$data=$this->Model_report->showReport_user($awal,$akhir,$id_karyawan);	
			}			
				echo "
				<div id='print-area'>
				<b class='text'>Waktu Rekap : ".date('d-m-Y H:i:s')."</b>
				<table id='example2' class='table table-bordered table-striped' style='width:100%;'>
                <thead>
                <tr>
                  <th>No</th>
                  <th style='width:10px;'>ID Transaksi</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Kasir</th>                  
                  <th>Item</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Diskon</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>";
                $no=0;
                $total=0;
                $pajak=0;
                $total_semua=0;
                foreach ($data->result_array() as $row) {
                	$no++;
                echo "
               <tr>
                 <td>".$no."</td>
                 <td>".$row['id_transaksi']."</td>
                 <td>".$row['tgl']."</td>
                 <td>".$row['jam']."</td>
                 <td>".$row['kasir']."</td>
                 <td>".$row['item']."</td>
                 <td align='right'>".number_format($row['harga'],0 ,'','.')."</td>
                 <td align='center'>".$row['qty']."</td>
                 <td align='center'>".$row['diskon']."</td>
                 <td align='right'>".number_format($row['total'],0 ,'','.')."</td>
               </tr> ";
               $total=$total+$row['total'];
               $pajak=$pajak+$row['pajak'];
               $total_semua=$total+$pajak;
               }
               echo " 
               <tr>
                 <td></td><td><b>Total Penjualan</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                 <td align='right'><b></b></td>
                 <td align='right'><b>".number_format($total,0 ,'','.')."</b></td>
                 <td align='right'><b>".number_format($total_semua,0 ,'','.')."</b></td>
               </tr>             
                </tbody>
              </table>
			          <div class='box-footer action'>
                <div class='col-xs-12 pull-right'>
                  <button class='btn btn-flat btn-primary'  onclick='print_data();'><i class='fa fa-print' ></i> Cetak</button> <a href='".base_url()."report/excel_rekap/".$awal."/".$akhir."' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-file-excel-o'></i> Excel</a >
                </div>
				";			
		}

		function rekap_kat() {
			$data['title']="ADMIN INSTA RESTO | Laporan Penjualan Per Kategori";
			$data['kat']=$this->Model_kat->get();
			$this->template->display_admin('admin/lap_kategori',$data);
		}

		function show_rekap_kat() {
			$awal=$this->input->post('awal',true);
			$akhir=$this->input->post('akhir',true);
			$kat=$this->input->post('kategori',true);
			$id_karyawan=$this->session->userdata('username');
			$data=$this->Model_report->showReportKat($awal,$akhir,$kat,$id_karyawan);	
				echo "
				<div id='print-area'>
				<b class='text'>Waktu Rekap : ".date('d-m-Y H:i:s')."</b>
				<table id='example2' class='table table-bordered table-striped' style='width:100%;'>
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Transaksi</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Kasir</th>                  
                  <th>Item</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Diskon</th>                  
                  <th>Pajak</th>                  
                  <th>Kategori</th>
                  <th>Total</th>
                  <th>Total Kena Pajak</th>
                </tr>
                </thead>
                <tbody>";
                $no=0;
                $total=0;
                $pajak=0;
                foreach ($data->result_array() as $row) {
                	$no++;
                echo "
               <tr>
                 <td>".$no."</td>
                 <td>".$row['id_transaksi']."</td>
                 <td>".$row['tgl']."</td>
                 <td>".$row['jam']."</td>
                 <td>".$row['kasir']."</td>
                 <td>".$row['item']."</td>
                 <td align='right'>".number_format($row['harga'],0 ,'','.')."</td>
                 <td align='center'>".$row['qty']."</td>
                 <td align='center'>".$row['diskon']."</td>                
                 <td align='center'>".number_format($row['pajak'],0 ,'','.')."</td>                
                 <td>".$row['kategori']."</td>
                 <td align='right'>".number_format($row['total'],0 ,'','.')."</td>
                 <td align='right'>".number_format($row['total']+$row['pajak'],0 ,'','.')."</td>
               </tr> ";
               $total=$total+$row['total'];
               $pajak=$pajak+$row['pajak'];
               $total_semua=$total+$pajak;
               
               }
               echo "   
               <tr>
                 <td></td><td><b>Total Penjualan</b></td><td></td><td></td><td></td><td></td>
                 <td></td><td></td><td></td><td></td><td></td>
                 <td align='right'><b>".number_format($total,0 ,'','.')."</b></td>
                 <td align='right'><b>".number_format($total_semua,0 ,'','.')."</b></td>
               </tr>          
                </tbody>
              </table>
			          <div class='box-footer action'>
                <div class='col-xs-12 pull-right'>
                  <button class='btn btn-flat btn-primary' onclick='print_data();'><i class='fa fa-print'></i> Cetak</button> <a href='".base_url()."report/excel_rekapPerKat/".$awal."/".$akhir."/".$kat."' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-file-excel-o'></i> Excel</a>
                </div>
				";
		}

		function absensi() {
			$data['title']="ADMIN PRINGGONDANI RESTO | Laporan Absensi Pegawai";
			$data['karyawan']=$this->Model_karyawan->get();
			$this->template->display_admin('admin/lap_absensi',$data);
		}

		function show_absen() {
			$bln=$rekapthis->input->post('bulan',true);
			$thn=$this->input->post('tahun',true);
			$id_karyawan=$this->input->post('id_karyawan',true);
			$data=$this->Model_report->reportAbsensi($bln,$thn,$id_karyawan);
			echo "
				<div id='print-area'>
				<b class='text'>Waktu Rekap : ".date('d-m-Y H:i:s')."</b>
				<table id='example2' class='table table-bordered table-striped' style='width:100%;'>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pegawai</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>";
                $no=0;
                foreach ($data->result_array() as $row) {
                	$no++;
                echo "
               <tr>
                 <td>".$no."</td>
                 <td>".$row['karyawan']."</td>
                 <td>".$row['tanggal']."</td>
                 <td>".$row['jam']."</td>
                 <td>".$row['status']."</td>
               </tr> ";
               }
               echo "
                </tbody>
              </table>
			          <div class='box-footer action'>
                <div class='col-xs-12 pull-right'>
                  <button class='btn btn-flat btn-primary' onclick='print_data();'><i class='fa fa-print'></i> Cetak</button> <a href='".base_url()."report/excel_absensi/".$bln."/".$thn."/".$id_karyawan."' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-file-excel-o'></i> Excel</a>
                </div>
				";
		}

		function pelayanan() {
			$data['title']="ADMIN INSTA RESTO | Laporan Kinerja Pramusaji";
			$data['karyawan']=$this->Model_karyawan->get();
			$this->template->display_admin('admin/lap_pelayanan',$data);
		}

		function show_kinerja() {
			$awal=$this->input->post('awal',true);
			$akhir=$this->input->post('akhir',true);
			$pramusaji=$this->input->post('id_karyawan',true);
			$data=$this->Model_report->reportPelayanan($awal,$akhir,$pramusaji);
			echo "
				<div id='print-area'>
				<b class='text'>Waktu Rekap : ".date('d-m-Y H:i:s')."</b>
				<table id='example2' class='table table-bordered table-striped' style='width:100%;'>
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Transaksi</th>                 
                  <th>Meja</th>                 
                  <th>Pembeli</th>                 
                  <th>Item</th>                 
                  <th>Qty</th>                 
                  <th>Harga</th>                 
                  <th>Pramusaji</th>                 
                  <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>";
                $no=0;
                foreach ($data->result_array() as $row) {
                	$no++;
                echo "
               <tr>
                 <td>".$no."</td>
                 <td>".$row['id_transaksi']."</td>
                 <td>".$row['meja']."</td>
                 <td>".$row['pelanggan']."</td>
                 <td>".$row['item']."</td>
                 <td align='center'>".$row['qty']."</td>
                 <td align='right'>".number_format($row['harga'],0 ,'','.')."</td>
                 <td>".$row['pramusaji']."</td>
                 <td>".$row['tanggal']."</td>
               </tr> ";
               }
               echo "
                </tbody>
              </table>
			          <div class='box-footer action'>
                <div class='col-xs-12 pull-right'>
                  <button class='btn btn-flat btn-primary' onclick='print_data();'><i class='fa fa-print'></i> Cetak</button> <a href='".base_url()."report/excel_kinerja/".$awal."/".$akhir."/".$pramusaji."' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-file-excel-o'></i> Excel</a>
                </div>
				";
		}

		function excel_rekap() {
			$awal=$this->uri->segment(3);
			$akhir=$this->uri->segment(4);
			if($this->session->userdata('akses')=='admin'){
			$data=$this->Model_report->showReport_admin($awal,$akhir);
			}else{
			$id_karyawan=$this->session->userdata('username');
			$data=$this->Model_report->showReport_user($awal,$akhir,$id_karyawan);
			}	
			if(count($data)>0) { 
				$objPHPExcel = new PHPExcel();
				$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
				$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
				$objget->setTitle('Sample Sheet'); //sheet title
				//Warna header tabel
				$objget->getStyle("A1:L1")->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'dd4b39')
						),
						'font' => array(
							'color' => array('rgb' => 'ffffff')
						)
					)
				);
				//table header
				$cols = array("A","B","C","D","E","F","G","H","I","J","K","L");
				$val = array("NO","ID TRANSAKSI","TANGGAL","JAM","KASIR","ITEM","HARGA","QTY","DISKON","PAJAK","TOTAL","SEMUA");
				for ($a=0;$a<count($cols);$a++) { //style baris 1
					//berikan judul kolom
					$objset->setCellValue($cols[$a].'1', $val[$a]);
					//setting lebar
					$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setWidth(25);
					$style = array(
	                    'alignment' => array(
	                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	                    )
	                );
	                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
				}
				$baris=2; //isi data mulai baris ke 2
				$nourut=0;
				$total=0;
				$pajak=0;
				foreach ($data->result() as $row){ 
					$nourut++;
					$objset->setCellValue("A".$baris, $nourut); 
					$objset->setCellValue("B".$baris, $row->id_transaksi);
					$objset->setCellValue("C".$baris, $row->tgl);
					$objset->setCellValue("D".$baris, $row->jam); 
					$objset->setCellValue("E".$baris, $row->kasir); 
					$objset->setCellValue("F".$baris, $row->item); 
					$objset->setCellValue("G".$baris, $row->harga);  
					$objset->setCellValue("H".$baris, $row->qty); 
					$objset->setCellValue("I".$baris, $row->diskon);
					$objset->setCellValue("J".$baris, $row->pajak); 
					$objset->setCellValue("K".$baris, $row->total);
					$objset->setCellValue("L".$baris, $row->total+$row->pajak);
					$objPHPExcel->getActiveSheet()->getStyle('G1:G'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('H1:H'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('I1:I'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('J1:J'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('K1:K'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('L1:L'.$baris)->getNumberFormat()->setFormatCode('0');
                	$baris++;
                	$total=$total+$row->total;
                	$pajak=$pajak+$row->pajak;
                	$total_semua=$total+$pajak;
				}
				//cetak total bawah sendiri
				$baris=$baris+1;
				$objset->setCellValue("I".$baris, "TOTAL PENJUALAN");
				// $objset->setCellValue("J".$baris, $pajak); 
				$objset->setCellValue("K".$baris, $total);
				$objset->setCellValue("L".$baris, $total_semua);

				$objPHPExcel->getActiveSheet()->setTitle('Rekap Penjualan');
 
				$objPHPExcel->setActiveSheetIndex(0);  
				$filename = urlencode("Rekap_penjualan_".date("Y-m-d").".xls");
               
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache  
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
		}

		function excel_rekapPerKat() {
			$awal=$this->uri->segment(3);
			$akhir=$this->uri->segment(4);		
			$kat=$this->uri->segment(5);
			$id_karyawan=$this->session->userdata('username');
			$data=$this->Model_report->showReportKat($awal,$akhir,$kat,$id_karyawan);
			if(count($data)>0) { 
				$objPHPExcel = new PHPExcel();
				$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
				$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
				$objget->setTitle('Sample Sheet'); //sheet title
				//Warna header tabel
				$objget->getStyle("A1:M1")->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'dd4b39')
						),
						'font' => array(
							'color' => array('rgb' => 'ffffff')
						)
					)
				);
				//table header
				$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M");
				$val = array("NO","ID TRANSAKSI","TANGGAL","JAM","KASIR","ITEM","HARGA","QTY","DISKON","PAJAK","KATEGORI","TOTAL","SEMUA");
				for ($a=0;$a<count($cols);$a++) { //style baris 1
					//berikan judul kolom
					$objset->setCellValue($cols[$a].'1', $val[$a]);
					//setting lebar
					$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setWidth(25);
					$style = array(
	                    'alignment' => array(
	                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	                    )
	                );
	                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
				}
				$baris=2; //isi data mulai baris ke 2
				$nourut=0;
				$total=0;
				$pajak=0;
				foreach ($data->result() as $row){ 
					$nourut++;
					$objset->setCellValue("A".$baris, $nourut); 
					$objset->setCellValue("B".$baris, $row->id_transaksi);
					$objset->setCellValue("C".$baris, $row->tgl);
					$objset->setCellValue("D".$baris, $row->jam); 
					$objset->setCellValue("E".$baris, $row->kasir); 
					$objset->setCellValue("F".$baris, $row->item); 
					$objset->setCellValue("G".$baris, $row->harga);  
					$objset->setCellValue("H".$baris, $row->qty); 
					$objset->setCellValue("I".$baris, $row->diskon);
					$objset->setCellValue("J".$baris, $row->pajak); 
					$objset->setCellValue("K".$baris, $row->kategori); 
					$objset->setCellValue("L".$baris, $row->total);
					$objset->setCellValue("M".$baris, $row->total+$row->pajak);
					//Set number value
					$objPHPExcel->getActiveSheet()->getStyle('G1:G'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('H1:H'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('I1:I'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('J1:J'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('L1:L'.$baris)->getNumberFormat()->setFormatCode('0');
					$objPHPExcel->getActiveSheet()->getStyle('M1:M'.$baris)->getNumberFormat()->setFormatCode('0');
                	$baris++;
                	$total=$total+$row->total;
                	$pajak=$pajak+$row->pajak;
                	$total_semua=$total+$pajak;
				}
				//cetak total bawah sendiri
				$baris=$baris+1;
				$objset->setCellValue("K".$baris, "TOTAL PENJUALAN"); 
				$objset->setCellValue("L".$baris, $total);
				$objset->setCellValue("M".$baris, $total_semua);

				$objPHPExcel->getActiveSheet()->setTitle('Rekap Penjualan Per Kategori');
 
				$objPHPExcel->setActiveSheetIndex(0);  
				$filename = urlencode("Rekap_penjualan_PerKat_".date("Y-m-d").".xls");
               
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache  
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
		}

		function excel_absensi() {
			$bln=$this->uri->segment(3);
			$thn=$this->uri->segment(4);		
			$karyawan=$this->uri->segment(5);
			if(empty($karyawan)) {
				$id_karyawan='0';
			} else {
				$id_karyawan=$karyawan;
			}
			$data=$this->Model_report->reportAbsensi($bln,$thn,$id_karyawan);
			if(count($data)>0) { 
				$objPHPExcel = new PHPExcel();
				$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
				$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
				$objget->setTitle('Sample Sheet'); //sheet title
				//Warna header tabel
				$objget->getStyle("A1:E1")->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'dd4b39')
						),
						'font' => array(
							'color' => array('rgb' => 'ffffff')
						)
					)
				);
				//table header
				$cols = array("A","B","C","D","E");
				$val = array("NO","NAMA PEGAWAI","TANGGAL","JAM","STATUS");
				for ($a=0;$a<count($cols);$a++) { //style baris 1
					//berikan judul kolom
					$objset->setCellValue($cols[$a].'1', $val[$a]);
					//setting lebar
					$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setWidth(25);
					$style = array(
	                    'alignment' => array(
	                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	                    )
	                );
	                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
				}
				$baris=2; //isi data mulai baris ke 2
				$nourut=0;
				foreach ($data->result() as $row){ 
					$nourut++;
					$objset->setCellValue("A".$baris, $nourut); 
					$objset->setCellValue("B".$baris, $row->karyawan);
					$objset->setCellValue("C".$baris, $row->tanggal);
					$objset->setCellValue("D".$baris, $row->jam); 
					$objset->setCellValue("E".$baris, $row->status);
                	$baris++;
				}
				$objPHPExcel->getActiveSheet()->setTitle('Rekap Absensi Pegawai');
 
				$objPHPExcel->setActiveSheetIndex(0);  
				$filename = urlencode("Rekap_Absensi_".date("Y-m-d").".xls");
               
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache  
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
		}

		function excel_kinerja() {
			$awal=$this->uri->segment(3);
			$akhir=$this->uri->segment(4);		
			$pramusaji=$this->uri->segment(5);
			if(empty($pramusaji)) {
				$id_karyawan='0';
			} else {
				$id_karyawan=$pramusaji;
			}
			$data=$this->Model_report->reportPelayanan($awal,$akhir,$id_karyawan);
			if(count($data)>0) { 
				$objPHPExcel = new PHPExcel();
				$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
				$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
				$objget->setTitle('Sample Sheet'); //sheet title
				//Warna header tabel
				$objget->getStyle("A1:I1")->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'dd4b39')
						),
						'font' => array(
							'color' => array('rgb' => 'ffffff')
						)
					)
				);
				//table header
				$cols = array("A","B","C","D","E","F","G","H","I");
				$val = array("NO","ID TRANSAKSI","MEJA","PEMBELI","ITEM","QTY","HARGA","PRAMUSAJI","TANGGAL");
				for ($a=0;$a<count($cols);$a++) { //style baris 1
					//berikan judul kolom
					$objset->setCellValue($cols[$a].'1', $val[$a]);
					//setting lebar
					$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setWidth(25);
					$style = array(
	                    'alignment' => array(
	                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	                    )
	                );
	                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
				}
				$baris=2; //isi data mulai baris ke 2
				$nourut=0;
				foreach ($data->result() as $row){ 
					$nourut++;
					$objset->setCellValue("A".$baris, $nourut); 
					$objset->setCellValue("B".$baris, $row->id_transaksi);
					$objset->setCellValue("C".$baris, $row->meja);
					$objset->setCellValue("D".$baris, $row->pelanggan); 
					$objset->setCellValue("E".$baris, $row->item); 
					$objset->setCellValue("F".$baris, $row->qty); 
					$objset->setCellValue("G".$baris, $row->harga); 
					$objset->setCellValue("H".$baris, $row->pramusaji); 
					$objset->setCellValue("I".$baris, $row->tanggal);
					//Set number value
					$objPHPExcel->getActiveSheet()->getStyle('G1:G'.$baris)->getNumberFormat()->setFormatCode('0');
                	$baris++;                	
				}
				$objPHPExcel->getActiveSheet()->setTitle('Rekap Kinerja Pramusaji');
 
				$objPHPExcel->setActiveSheetIndex(0);  
				$filename = urlencode("Kinerja_Pramusaji_".date("Y-m-d").".xls");
               
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache  
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
		}

	function grafik() {
		$tahun=date('Y');
		$bulan=date('m');
		$data['title']="ADMIN INSTA RESTO | Grafik";
		$data['penjualan']=$this->Model_report->grafik_penjualan($tahun);
		$data['barang']=$this->Model_report->grafik_barang($bulan);
		$data['kategori']=$this->Model_report->grafik_kategori($bulan);
		$this->template->display_admin('admin/grafik',$data);
	}
	function backup(){
	$data['title']="ADMIN INSTA RESTO | Backup Data";
	$data['log_db']=file_get_contents('assets/backup/log_db');
	$data['log_file']=file_get_contents('assets/backup/log_file');
	$this->template->display_admin('admin/admin-backup',$data);	
	}
	function backup_file(){
		//LOG TANGGAL
	$tanggal= date('d-m-Y H:i:s');
	$log_db = fopen('assets/backup/log_file', 'w');
	fwrite($log_db, $tanggal);
    fclose($log_db);
    //FUNGSI BACKUP DB
		$this->load->library(array('Zip', 'MY_Zip')); // load library zip dan my zip
        $path = 'assets/menu/'; // folder yang ingin kita download
        $folder_in_zip = "assets/backup/";  // tujuan sementara folder zip
        $this->zip->get_files_from_folder($path, $folder_in_zip);
        $this->zip->download('BACKUP-DATA-'.date('m-d-Y').'.zip');
	}
	function backup_db()
	{
		//LOG TANGGAL
	$tanggal= date('d-m-Y H:i:s');
	$log_db = fopen('assets/backup/log_db', 'w');
	fwrite($log_db, $tanggal);
    fclose($log_db);
    //FUNGSI BACKUP DB
    $this->load->dbutil();   
    $backup =$this->dbutil->backup();  
    $this->load->helper('file');
    write_file('<?php echo base_url();?>/downloads', $backup);
    $this->load->helper('download');
    force_download('BACKUP-DB-'.date('m-d-Y').'.zip', $backup);
	}

}