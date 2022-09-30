<?php 

function GetAllUsr(){
	$qry="SELECT * FROM tb_member";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function GetUsrByID($id) {
	$qry="SELECT * FROM tb_member WHERE id_member='$id'";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function InsertUsr($id_member,$nama_member,$jenis_kelamin,$no_hp,$alamat) {
	$qry="INSERT INTO tb_member VALUES('$id_member','$nama_member','$jenis_kelamin','$no_hp','$alamat')";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function UpdateUsr($id_member,$nama_member,$jenis_kelamin,$no_telp,$alamat) {
	$qry="UPDATE tb_member SET nama_member='$nama_member', gender='$jenis_kelamin', no_telp='$no_telp' , alamat='$alamat' WHERE id_member='$id_member'";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}


function DeleteUsr($id) {
	$qry="DELETE FROM `tb_member` WHERE id_member='$id'";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function LastIdUsr() {
	$qry="SELECT MAX(id_member) AS lastid FROM tb_member";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function JumDataUsr() {
    $data="";
    $qry="SELECT count(id_member) as total FROM tb_member";
	$hasil=mysql_query($qry);
	while ($data = mysql_fetch_array ($hasil)){
	$total = $data['total'];
	}
        return $total;
}

?>