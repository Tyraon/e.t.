<?php
@include('config.php');

$dsatz = "1";



switch(strtok($logging,',')) {
	case "1":
	$file = 'log/logfile.log';
	break;
	case "2":
	$file = '../log/logfile.log';
	break;
}

$dsatz = substr(strstr($logging,','),1);

//echo '<script>alert("log");</script>';

if($config['log'] == "1") {
	$db1 = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
	if(@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!")) { }
	if(@mysql_query("INSERT INTO `et_log` VALUES('','".date("Y-m-d H:i:s")."','".$dsatz."')")) { }
	@mysql_close($db1);
}

if($config['log'] == "2") {
	$dsatz = '
'.date("Y-m-d H:i:s").': '.$dsatz;
	//$file = 'log/logfile.log';

	if(!file_exists($file)) { echo '';
		@copy('logout.php',$file);
		$fp = @fopen($file,'w');
	} else {
		$fp = @fopen($file,'a');
	}
	@fwrite($fp,$dsatz);
	@fclose($fp);
}



?>