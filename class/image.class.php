<?php
@session_start();
@include('../sys/config.php');

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");
$user = @!$_GET['user'] ? $_SESSION['et_uid'] : $_GET['user'];
$erg = @mysql_query("SELECT * FROM `et_avatars` WHERE `uid` = '".$user."'");
if(@mysql_num_rows($erg) == 1) {
	$data = @mysql_fetch_row($erg);
	if($_GET['img'] == 'data') {
		header("Content-type: {$data[3]}");
		echo $data[2];
	}
	else {
		$width = (160/$data[5])*100;
		/*if((($data[4]*$width)/100) >= 120) {
			$width = ($data[4]*$width)/100;
			$height = 160;
		} else {
			$width = 120;
			$height = ($data[5]*((120/$data[4])*100))/100;
		}*/
		$width = ($data[4]*$width)/100;
		$height = 160;
		echo $width.'px '.$height.'px';
	}
} else {
	$file = '../img/Gast.gif';
	if($_GET['img'] == 'data') {
		$fp = @fopen($file,'r');
		$data = fread($fp,filesize($file));
		@fclose($fp);
		header("Content-type: image/gif");
		echo $data;
	}
	else {
		echo '120px 160px';
	}
}

@mysql_close($db);
?>