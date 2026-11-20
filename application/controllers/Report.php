<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		// PHPExcel is replaced by PhpOffice\PhpSpreadsheet (loaded via Composer)
		// $this->load->library('Excel/PHPExcel');
		$this->load->model('Model_report');
		$this->load->model('Model_karyawan');
		$this->load->model('Model_kat');
		if ((!$this->session->userdata('logged_in')) && (!$this->session->userdata('akses') == 'admin')) {
			redirect('login', 'refresh');
		}
	}

	function index()
	{
		$data['title'] = "ADMIN Bicara Kopi | Laporan_penjualan" . date('H:i:s');
		$this->template->display_admin('admin/lap_transaksi', $data);
	}

	function rekap()
	{
		$awal = $this->input->post('awal', true);
		$akhir = $this->input->post('akhir', true);
		$id_karyawan = $this->session->userdata('username');
		if ($this->session->userdata('akses') == 'admin') {
			$data = $this->Model_report->showReport_admin($awal, $akhir);
		} else {
			$data = $this->Model_report->showReport_user($awal, $akhir, $id_karyawan);
		}
		echo "
				<div id='print-area'>
				<b class='text'>Waktu Rekap : " . date('d-m-Y H:i:s') . "</b>
				<table id='example2' class='table table-bordered table-striped' style='width:100%;'>
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Transaksi</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Kasir</th> 
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>";
		$no = 0;
		$total = 0;
		$pajak = 0;
		$total_semua = 0;
		foreach ($data->result_array() as $row) {
			$no++;
			echo "
               <tr>
                 <td>" . $no . "</td>
                 <td>" . $row['id_transaksi'] . "</td>
                 <td>" . $row['tgl'] . "</td>
                 <td>" . $row['jam'] . "</td>
                 <td>" . $row['kasir'] . "</td>
                 <td align='right'>" . number_format($row['total_kena_pajak'], 0, '', '.') . "</td>
               </tr> ";
			$total = $total + $row['total_kena_pajak'];
			// $pajak=$pajak+$row['pajak'];
			// $total_semua=$total+$pajak;
		}
		echo " 
               <tr>
                 <td></td><td><b>Total Penjualan</b></td><td></td><td></td>
                 <td align='right'><b></b></td>
                 <td align='right'><b>" . number_format($total, 0, '', '.') . "</b></td>
               </tr>             
                </tbody>
              </table>
			          <div class='box-footer action'>
                <div class='col-xs-12 pull-right'>
                  <button class='btn btn-flat btn-primary'  onclick='print_data();'><i class='fa fa-print' ></i> Cetak</button> <a href='" . base_url() . "report/excel_rekap/" . $awal . "/" . $akhir . "' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-file-excel-o'></i> Excel</a >
                </div>
				";
	}

	function rekap_kat()
	{
		$data['title'] = "ADMIN Bicara Kopi | Laporan Penjualan Per Kategori";
		$data['kat'] = $this->Model_kat->get();
		$this->template->display_admin('admin/lap_kategori', $data);
	}

	function show_rekap_kat()
	{
		$awal = $this->input->post('awal', true);
		$akhir = $this->input->post('akhir', true);
		$kat = $this->input->post('kategori', true);
		$id_karyawan = $this->session->userdata('username');
		$data = $this->Model_report->showReportKat($awal, $akhir, $kat, $id_karyawan);
		echo "
				<div id='print-area'>
				<b class='text'>Waktu Rekap : " . date('d-m-Y H:i:s') . "</b>
				<table id='example2' class='table table-bordered table-striped' style='width:100%;'>
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Transaksi</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Kasir</th>                  
                  <th>Item</th>
                  <th>Qty</th>
                  <th>Harga</th>
                </tr>
                </thead>
                <tbody>";
		$no = 0;
		$total = 0;
		$pajak = 0;
		foreach ($data->result_array() as $row) {
			$no++;
			echo "
               <tr>
                 <td>" . $no . "</td>
                 <td>" . $row['id_transaksi'] . "</td>
                 <td>" . $row['tgl'] . "</td>
                 <td>" . $row['jam'] . "</td>
                 <td>" . $row['kasir'] . "</td>
                 <td>" . $row['item'] . "</td>
                 <td align='center'>" . $row['qty'] . "</td>
                 <td align='right'>" . number_format($row['harga'], 0, '', '.') . "</td>
               </tr> ";
			$total = $total + $row['total'];
			$pajak = $pajak + $row['pajak'];
			$total_semua = $total + $pajak;
		}
		echo "   
                     
                </tbody>
              </table>
			          <div class='box-footer action'>
                <div class='col-xs-12 pull-right'>
                  <button class='btn btn-flat btn-primary' onclick='print_data();'><i class='fa fa-print'></i> Cetak</button> <a href='" . base_url() . "report/excel_rekapPerKat/" . $awal . "/" . $akhir . "/" . $kat . "' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-file-excel-o'></i> Excel</a>
                </div>
				";
	}

	function absensi()
	{
		$data['title'] = "ADMIN Bicaara Kopi | Laporan Absensi Pegawai";
		$data['karyawan'] = $this->Model_karyawan->get();
		$this->template->display_admin('admin/lap_absensi', $data);
	}

	function show_absen()
	{
		$bln = $this->input->post('bulan', true);
		$thn = $this->input->post('tahun', true);
		$id_karyawan = $this->input->post('id_karyawan', true);
		$data = $this->Model_report->reportAbsensi($bln, $thn, $id_karyawan);
		echo "
				<div id='print-area'>
				<b class='text'>Waktu Rekap : " . date('d-m-Y H:i:s') . "</b>
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
		$no = 0;
		foreach ($data->result_array() as $row) {
			$no++;
			echo "
               <tr>
                 <td>" . $no . "</td>
                 <td>" . $row['karyawan'] . "</td>
                 <td>" . $row['tanggal'] . "</td>
                 <td>" . $row['jam'] . "</td>
                 <td>" . $row['status'] . "</td>
               </tr> ";
		}
		echo "
                </tbody>
              </table>
			          <div class='box-footer action'>
                <div class='col-xs-12 pull-right'>
                  <button class='btn btn-flat btn-primary' onclick='print_data();'><i class='fa fa-print'></i> Cetak</button> <a href='" . base_url() . "report/excel_absensi/" . $bln . "/" . $thn . "/" . $id_karyawan . "' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-file-excel-o'></i> Excel</a>
                </div>
				";
	}

	function pelayanan()
	{
		$data['title'] = "ADMIN Bicara Kopi | Laporan Kinerja Pramusaji";
		$data['karyawan'] = $this->Model_karyawan->get();
		$this->template->display_admin('admin/lap_pelayanan', $data);
	}

	function show_kinerja()
	{
		$awal = $this->input->post('awal', true);
		$akhir = $this->input->post('akhir', true);
		$pramusaji = $this->input->post('id_karyawan', true);
		$data = $this->Model_report->reportPelayanan($awal, $akhir, $pramusaji);
		echo "
				<div id='print-area'>
				<b class='text'>Waktu Rekap : " . date('d-m-Y H:i:s') . "</b>
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
		$no = 0;
		foreach ($data->result_array() as $row) {
			$no++;
			echo "
               <tr>
                 <td>" . $no . "</td>
                 <td>" . $row['id_transaksi'] . "</td>
                 <td>" . $row['meja'] . "</td>
                 <td>" . $row['pelanggan'] . "</td>
                 <td>" . $row['item'] . "</td>
                 <td align='center'>" . $row['qty'] . "</td>
                 <td align='right'>" . number_format($row['harga'], 0, '', '.') . "</td>
                 <td>" . $row['pramusaji'] . "</td>
                 <td>" . $row['tanggal'] . "</td>
               </tr> ";
		}
		echo "
                </tbody>
              </table>
			          <div class='box-footer action'>
                <div class='col-xs-12 pull-right'>
                  <button class='btn btn-flat btn-primary' onclick='print_data();'><i class='fa fa-print'></i> Cetak</button> <a href='" . base_url() . "report/excel_kinerja/" . $awal . "/" . $akhir . "/" . $pramusaji . "' class='btn btn-flat btn-success' target='_blank'><i class='fa fa-file-excel-o'></i> Excel</a>
                </div>
				";
	}

	function excel_rekap()
	{
		$awal = $this->uri->segment(3);
		$akhir = $this->uri->segment(4);
		if ($this->session->userdata('akses') == 'admin') {
			$data = $this->Model_report->showReport_admin($awal, $akhir);
		} else {
			$id_karyawan = $this->session->userdata('username');
			$data = $this->Model_report->showReport_user($awal, $akhir, $id_karyawan);
		}
		if (count((array)$data) > 0) {
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$style_col = [
				'font' => ['bold' => true], // Set font nya jadi bold
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				],
				'borders' => [
					'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
					'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
					'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
					'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
				]
			];
			// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
			$style_row = [
				'alignment' => [
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				],
				'borders' => [
					'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
					'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
					'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
					'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
				]
			];
			$sheet->setCellValue('A1', "REKAP PENJUALAN"); // Set kolom A1 
			$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
			$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
			// Buat header tabel nya pada baris ke 3
			$sheet->setCellValue('A3', "NO");
			$sheet->setCellValue('B3', "ID TRANSAKSI");
			$sheet->setCellValue('C3', "TANGGAL");
			$sheet->setCellValue('D3', "JAM");
			$sheet->setCellValue('E3', "KASIR");
			$sheet->setCellValue('F3', "TOTAL");
			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$sheet->getStyle('A3')->applyFromArray($style_col);
			$sheet->getStyle('B3')->applyFromArray($style_col);
			$sheet->getStyle('C3')->applyFromArray($style_col);
			$sheet->getStyle('D3')->applyFromArray($style_col);
			$sheet->getStyle('E3')->applyFromArray($style_col);
			$sheet->getStyle('F3')->applyFromArray($style_col);

			$baris = 4; //isi data mulai baris ke 2
			$nourut = 0;
			$total = 0;
			// $pajak=0;
			foreach ($data->result() as $row) {
				$nourut++;
				$sheet->setCellValue('A' . $baris, $nourut);
				$sheet->setCellValue('B' . $baris, $row->id_transaksi);
				$sheet->setCellValue('C' . $baris, $row->tgl);
				$sheet->setCellValue('D' . $baris, $row->jam);
				$sheet->setCellValue('E' . $baris, $row->kasir);
				$sheet->setCellValue('F' . $baris, $row->total_kena_pajak);

				$sheet->getStyle('A' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('B' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('C' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('D' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('E' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('F' . $baris)->applyFromArray($style_row);
				$baris++;
				$total = $total + $row->total_kena_pajak;
				// // $pajak=$pajak+$row->pajak;
				// $total_semua=$total+$pajak;
			}
			//cetak total bawah sendiri
			// $baris = $baris ;
			// $objset->setCellValue("E" . $baris, "TOTAL PENJUALAN");
			// // $objset->setCellValue("J".$baris, $pajak); 
			// // $objset->setCellValue("K".$baris, $total);
			// $objset->setCellValue("F" . $baris, $total);
			// Set width kolom
			$sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
			$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
			$sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
			$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
			$sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
			$sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F

			// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
			$sheet->getDefaultRowDimension()->setRowHeight(-1);
			// Set orientasi kertas jadi LANDSCAPE
			$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

			$sheet->setCellValue('E' . $baris, "TOTAL PENJUALAN");
			$sheet->setCellValue('F' . $baris, $total);
			$sheet->getStyle('E' . $baris)->applyFromArray($style_row);
			$sheet->getStyle('F' . $baris)->applyFromArray($style_row);
			$sheet->setTitle("Rekap Penjualan");
			$writer = new Xlsx($spreadsheet);
			$filename = 'Rekap_penjualan' . date("Y-m-d");

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		}
	}

	function excel_rekapPerKat()
	{
		$awal = $this->uri->segment(3);
		$akhir = $this->uri->segment(4);
		$kat = $this->uri->segment(5);
		$id_karyawan = $this->session->userdata('username');
		$data = $this->Model_report->showReportKat($awal, $akhir, $kat, $id_karyawan);
		if (count((array)$data) > 0) {
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$style_col = [
				'font' => ['bold' => true], // Set font nya jadi bold
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				],
				'borders' => [
					'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
					'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
					'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
					'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
				]
			];
			// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
			$style_row = [
				'alignment' => [
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				],
				'borders' => [
					'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
					'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
					'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
					'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
				]
			];
			//table header
			$sheet->setCellValue('A1', "REKAP PENJUALAN PERKATEGORI"); // Set kolom A1 
			$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
			$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
			// Buat header tabel nya pada baris ke 3
			$sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan
			$sheet->setCellValue('B3', "ID TRANSAKSI"); // Set kolom B3 
			$sheet->setCellValue('C3', "TANGGAL"); // Set kolom C3 
			$sheet->setCellValue('D3', "JAM"); // Set kolom D3 
			$sheet->setCellValue('E3', "KASIR"); // Set kolom E3 
			$sheet->setCellValue('F3', "ITEM"); // Set kolom F3 
			$sheet->setCellValue('G3', "QTY"); // Set kolom G3 
			$sheet->setCellValue('H3', "HARGA"); // Set kolom H3 
			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$sheet->getStyle('A3')->applyFromArray($style_col);
			$sheet->getStyle('B3')->applyFromArray($style_col);
			$sheet->getStyle('C3')->applyFromArray($style_col);
			$sheet->getStyle('D3')->applyFromArray($style_col);
			$sheet->getStyle('E3')->applyFromArray($style_col);
			$sheet->getStyle('F3')->applyFromArray($style_col);
			$sheet->getStyle('G3')->applyFromArray($style_col);
			$sheet->getStyle('H3')->applyFromArray($style_col);
			$baris = 4; //isi data mulai baris ke 2
			$nourut = 0;
			foreach ($data->result() as $row) {
				$nourut++;
				$sheet->setCellValue("A" . $baris, $nourut);
				$sheet->setCellValue("B" . $baris, $row->id_transaksi);
				$sheet->setCellValue("C" . $baris, $row->tgl);
				$sheet->setCellValue("D" . $baris, $row->jam);
				$sheet->setCellValue("E" . $baris, $row->kasir);
				$sheet->setCellValue("F" . $baris, $row->item);
				$sheet->setCellValue("G" . $baris, $row->qty);
				$sheet->setCellValue("H" . $baris, $row->harga);
				//Set number value
				// $objPHPExcel->getActiveSheet()->getStyle('G1:G' . $baris)->getNumberFormat()->setFormatCode('0');
				// $objPHPExcel->getActiveSheet()->getStyle('H1:H' . $baris)->getNumberFormat()->setFormatCode('0');
				$sheet->getStyle('A' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('B' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('C' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('D' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('E' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('F' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('G1:H' . $baris)->applyFromArray($style_row)->getNumberFormat()->setFormatCode(0);
				$sheet->getStyle('H1:H' . $baris)->applyFromArray($style_row)->getNumberFormat()->setFormatCode(0);
				$baris++;
				// $total=$total+$row->total;
				// $pajak=$pajak+$row->pajak;
				// $total_semua=$total+$pajak;
			}
			$sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
			$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
			$sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
			$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
			$sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
			$sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
			$sheet->getColumnDimension('G')->setWidth(30); // Set width kolom G
			$sheet->getColumnDimension('H')->setWidth(30); // Set width kolom H

			// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
			$sheet->getDefaultRowDimension()->setRowHeight(-1);
			// Set orientasi kertas jadi LANDSCAPE
			$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
			//cetak total bawah sendiri
			// $baris=$baris+1;
			// $objset->setCellValue("K".$baris, "TOTAL PENJUALAN"); 
			// $objset->setCellValue("L".$baris, $total);
			// $objset->setCellValue("M".$baris, $total_semua);

			$sheet->setTitle("Rekap Penjualan Perkategori");
			$writer = new Xlsx($spreadsheet);
			$filename = 'Rekap_penjualan_perkategori' . date("Y-m-d");

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		}
	}

	function excel_absensi()
	{
		$bln = $this->uri->segment(3);
		$thn = $this->uri->segment(4);
		$karyawan = $this->uri->segment(5);
		if (empty($karyawan)) {
			$id_karyawan = '0';
		} else {
			$id_karyawan = $karyawan;
		}
		$data = $this->Model_report->reportAbsensi($bln, $thn, $id_karyawan);
		if (count((array)$data) > 0) {
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$style_col = [
				'font' => ['bold' => true], // Set font nya jadi bold
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				],
				'borders' => [
					'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
					'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
					'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
					'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
				]
			];
			// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
			$style_row = [
				'alignment' => [
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				],
				'borders' => [
					'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
					'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
					'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
					'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
				]
			];

			//table header
			$sheet->setCellValue('A1', "REKAP ABSENSI KARYAWAN"); // Set kolom A1 
			$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
			$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
			// Buat header tabel nya pada baris ke 3
			$sheet->setCellValue('A3', "NO"); // Set kolom A3 
			$sheet->setCellValue('B3', "NAMA PEGAWAI"); // Set kolom 
			$sheet->setCellValue('C3', "TANGGAL"); // Set kolom C3 
			$sheet->setCellValue('D3', "JAM"); // Set kolom D3 
			$sheet->setCellValue('E3', "STATUS"); // Set kolom E3 
			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$sheet->getStyle('A3')->applyFromArray($style_col);
			$sheet->getStyle('B3')->applyFromArray($style_col);
			$sheet->getStyle('C3')->applyFromArray($style_col);
			$sheet->getStyle('D3')->applyFromArray($style_col);
			$sheet->getStyle('E3')->applyFromArray($style_col);

			$baris = 4; //isi data mulai baris ke 2
			$nourut = 0;
			foreach ($data->result() as $row) {
				$nourut++;
				$sheet->setCellValue("A" . $baris, $nourut);
				$sheet->setCellValue("B" . $baris, $row->karyawan);
				$sheet->setCellValue("C" . $baris, $row->tanggal);
				$sheet->setCellValue("D" . $baris, $row->jam);
				$sheet->setCellValue("E" . $baris, $row->status);


				$sheet->getStyle('A' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('B' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('C' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('D' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('E' . $baris)->applyFromArray($style_row);
				$baris++;
			}

			$sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
			$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
			$sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
			$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
			$sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E

			// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
			$sheet->getDefaultRowDimension()->setRowHeight(-1);
			// Set orientasi kertas jadi LANDSCAPE
			$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

			$sheet->setTitle('Rekap Absensi Pegawai');

			$writer = new Xlsx($spreadsheet);
			$filename = 'Rekap_absensi_pegawai' . date("Y-m-d");

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		}
	}

	function excel_kinerja()
	{
		$awal = $this->uri->segment(3);
		$akhir = $this->uri->segment(4);
		$pramusaji = $this->uri->segment(5);
		if (empty($pramusaji)) {
			$id_karyawan = '0';
		} else {
			$id_karyawan = $pramusaji;
		}
		$data = $this->Model_report->reportPelayanan($awal, $akhir, $id_karyawan);
		if (count((array)$data) > 0) {
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$style_col = [
				'font' => ['bold' => true], // Set font nya jadi bold
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				],
				'borders' => [
					'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
					'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
					'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
					'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
				]
			];
			// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
			$style_row = [
				'alignment' => [
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				],
				'borders' => [
					'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
					'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
					'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
					'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
				]
			];
			//table header
			$sheet->setCellValue('A1', "REKAP KINERJA PRAMUSAJI"); // Set kolom A1 
			$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
			$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
			// Buat header tabel nya pada baris ke 3
			$sheet->setCellValue('A3', "NO"); // Set kolom A3 
			$sheet->setCellValue('B3', "ID TRANSAKSI"); // Set kolom B3 
			$sheet->setCellValue('C3', "MEJA"); // Set kolom C3 
			$sheet->setCellValue('D3', "PEMBELI"); // Set kolom D3 
			$sheet->setCellValue('E3', "ITEM"); // Set kolom E3 
			$sheet->setCellValue('F3', "QTY"); // Set kolom F3 
			$sheet->setCellValue('G3', "HARGA"); // Set kolom G3 
			$sheet->setCellValue('H3', "PRAMUSAJI"); // Set kolom H3 
			$sheet->setCellValue('I3', "TANGGAL"); // Set kolom I3 
			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$sheet->getStyle('A3')->applyFromArray($style_col);
			$sheet->getStyle('B3')->applyFromArray($style_col);
			$sheet->getStyle('C3')->applyFromArray($style_col);
			$sheet->getStyle('D3')->applyFromArray($style_col);
			$sheet->getStyle('E3')->applyFromArray($style_col);
			$sheet->getStyle('F3')->applyFromArray($style_col);
			$sheet->getStyle('G3')->applyFromArray($style_col);
			$sheet->getStyle('H3')->applyFromArray($style_col);
			$sheet->getStyle('I3')->applyFromArray($style_col);

			$baris = 4; //isi data mulai baris ke 2
			$nourut = 0;
			foreach ($data->result() as $row) {
				$nourut++;
				$sheet->setCellValue("A" . $baris, $nourut);
				$sheet->setCellValue("B" . $baris, $row->id_transaksi);
				$sheet->setCellValue("C" . $baris, $row->meja);
				$sheet->setCellValue("D" . $baris, $row->pelanggan);
				$sheet->setCellValue("E" . $baris, $row->item);
				$sheet->setCellValue("F" . $baris, $row->qty);
				$sheet->setCellValue("G" . $baris, $row->harga);
				$sheet->setCellValue("H" . $baris, $row->pramusaji);
				$sheet->setCellValue("I" . $baris, $row->tanggal);
				//Set number value
				$sheet->getStyle('A' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('B' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('C' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('D' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('E' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('F' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('G1:G' . $baris)->applyFromArray($style_row)->getNumberFormat()->setFormatCode(0);
				$sheet->getStyle('H' . $baris)->applyFromArray($style_row);
				$sheet->getStyle('I' . $baris)->applyFromArray($style_row);
				$baris++;
			}
			$sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
			$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
			$sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
			$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
			$sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
			$sheet->getColumnDimension('F')->setWidth(30); // Set width kolom E
			$sheet->getColumnDimension('G')->setWidth(30); // Set width kolom E
			$sheet->getColumnDimension('H')->setWidth(30); // Set width kolom E
			$sheet->getColumnDimension('I')->setWidth(30); // Set width kolom E

			// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
			$sheet->getDefaultRowDimension()->setRowHeight(-1);
			// Set orientasi kertas jadi LANDSCAPE
			$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

			$sheet->setTitle("Rekap Kinerja Pramusaji");
			$writer = new Xlsx($spreadsheet);
			$filename = 'Rekap_kinerja_pramusaji' . date("Y-m-d");

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
		}
	}

	function grafik()
	{
		$tahun = date('Y');
		$bulan = date('m');
		$data['title'] = "ADMIN Bicara Kopi | Grafik";
		$data['penjualan'] = $this->Model_report->grafik_penjualan($tahun);
		$data['barang'] = $this->Model_report->grafik_barang($bulan);
		$data['kategori'] = $this->Model_report->grafik_kategori($bulan);
		$this->template->display_admin('admin/grafik', $data);
	}
	function backup()
	{
		$data['title'] = "ADMIN INSTA RESTO | Backup Data";
		$data['log_db'] = file_get_contents('assets/backup/log_db');
		$data['log_file'] = file_get_contents('assets/backup/log_file');
		$this->template->display_admin('admin/admin-backup', $data);
	}
	function backup_file()
	{
		//LOG TANGGAL
		$tanggal = date('d-m-Y H:i:s');
		$log_db = fopen('assets/backup/log_file', 'w');
		fwrite($log_db, $tanggal);
		fclose($log_db);
		//FUNGSI BACKUP DB
		$this->load->library(array('Zip', 'MY_Zip')); // load library zip dan my zip
		$path = 'assets/menu/'; // folder yang ingin kita download
		$folder_in_zip = "assets/backup/";  // tujuan sementara folder zip
		$this->zip->get_files_from_folder($path, $folder_in_zip);
		$this->zip->download('BACKUP-DATA-' . date('m-d-Y') . '.zip');
	}
	function backup_db()
	{
		//LOG TANGGAL
		$tanggal = date('d-m-Y H:i:s');
		$log_db = fopen('assets/backup/log_db', 'w');
		fwrite($log_db, $tanggal);
		fclose($log_db);
		//FUNGSI BACKUP DB
		$this->load->dbutil();
		$backup = $this->dbutil->backup();
		$this->load->helper('file');
		write_file('<?php echo base_url();?>/downloads', $backup);
		$this->load->helper('download');
		force_download('BACKUP-DB-' . date('m-d-Y') . '.zip', $backup);
	}
}
