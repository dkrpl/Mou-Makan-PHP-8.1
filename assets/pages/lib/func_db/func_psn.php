<?php 

function GetAllPsn(){
	$qry="SELECT tb_pesanan.id,tb_pesanan.kode_pembelian,tb_pesanan.jumlah_beli,tb_pesanan.tanggal_pesan,tb_member.nama_member,tb_barang.nama_barang,tb_pesanan.status FROM tb_barang,tb_pesanan,tb_member WHERE tb_pesanan.id_barang = tb_barang.id_barang AND tb_pesanan.id_member = tb_member.id_member order by id DESC";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function GetPsnByID($id) {
	$qry="SELECT tb_pesanan.kode_pembelian,tb_pesanan.jumlah_beli,tb_pesanan.tanggal_pesan,tb_member.nama_member,tb_barang.nama_barang,tb_pesanan.status FROM tb_barang,tb_pesanan,tb_member WHERE tb_pesanan.id_barang = tb_barang.id_barang AND tb_pesanan.id_member = tb_member.id_member id_member='$id'";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function InsertPsn($id_member,$nama_member,$jenis_kelamin,$no_hp,$alamat) {
	$qry="INSERT INTO tb_member VALUES('$id_member','$nama_member','$jenis_kelamin','$no_hp','$alamat')";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function UpdatePsn($id_member,$nama_member,$jenis_kelamin,$no_telp,$alamat) {
	$qry="UPDATE tb_member SET nama_member='$nama_member', gender='$jenis_kelamin', no_telp='$no_telp' , alamat='$alamat' WHERE id_member='$id_member'";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}


function DeletePsn($id) {
	$qry="DELETE FROM `tb_pesanan` WHERE id='$id'";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function LastIdPsn() {
	$qry="SELECT MAX(id_member) AS lastid FROM tb_member";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function JumDataPsn() {
    $data="";
    $qry="SELECT count(id) as total FROM tb_pesanan";
	$hasil=mysql_query($qry);
	while ($data = mysql_fetch_array ($hasil)){
	$total = $data['total'];
	}
        return $total;
}

?>