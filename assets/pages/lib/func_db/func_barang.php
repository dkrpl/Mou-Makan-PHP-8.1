<?php 

function GetAllBarang(){
	$qry="SELECT * FROM tb_barang";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function GetBrgByID($id) {
	$qry="SELECT * FROM tb_barang WHERE id_barang='$id'";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function InsertBrg($id_barang,$nama_barang,$harga_barang,$qty,$foto) {
	$qry="INSERT INTO tb_barang VALUES('$id_barang','$nama_barang','$harga_barang','$qty','$foto')";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function UpdateUniv($id_barang,$nama_barang,$harga_barang,$qty,$foto) {
	$qry="UPDATE tb_barang SET nama_barang='$nama_barang', harga_barang='$harga_barang', qty='$qty', foto='$foto' WHERE id_barang='$id_barang'";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function UpdateUnivNoImg($id_barang,$nama_barang,$harga_barang,$qty) {
	$qry="UPDATE tb_barang SET nama_barang='$nama_barang', harga_barang='$harga_barang', qty='$qty' WHERE id_barang='$id_barang'";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function DeleteBrg($id) {
	$qry="DELETE FROM `tb_barang` WHERE id_barang='$id'";
	$data=mysql_query($qry) or die(mysql_error());
	if($data) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function LastID() {
	$qry="SELECT MAX(id_barang) AS lastid FROM tb_barang";
	$data=mysql_query($qry) or die(mysql_error());
	return $data;
}

function JumData() {
    $data="";
    $qry="SELECT count(id_barang) as total FROM tb_barang";
	$hasil=mysql_query($qry);
	while ($data = mysql_fetch_array ($hasil)){
	$total = $data['total'];
	}
        return $total;
}

?>