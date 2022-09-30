<?php 
require_once('func_db/func_barang.php');
function autoid(){
$maxid=LastID();
$row_maxid=mysql_fetch_assoc($maxid);
$lastid_db=$row_maxid['lastid'];
$lastid= substr($lastid_db,1);
if (empty($lastid)) {
	$id="B001"; } 
else {
	$lastid=$lastid+1;
	if (strlen($lastid)=='1') {
		$id="B00".$lastid;
	} else if (strlen($lastid)=='2') {
		$id="B0".$lastid;
	} else {
		$id=$lastid;
	}
}
return $id;
}
?>
