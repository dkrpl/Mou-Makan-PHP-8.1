<?php 
require_once('func_db/func_usr.php');
function autoid(){
$maxid=LastIDUsr();
$row_maxid=mysql_fetch_assoc($maxid);
$lastid_db=$row_maxid['lastid'];
$lastid= substr($lastid_db,1);
if (empty($lastid)) {
	$id="K0001"; } 
else {
	$lastid=$lastid+1;
	if (strlen($lastid)=='1') {
		$id="K000".$lastid;
	} else if (strlen($lastid)=='2') {
		$id="K00".$lastid;
	} else if (strlen($lastid)=='') {
		$id="K0".$lastid;
	} else {
		$id=$lastid;
	}
}
return $id;
}
?>
