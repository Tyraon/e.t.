<?php
@session_start();
@include('../sys/config.php');

$chatbot = $config['chatbot'];
$bl = $config['blacklist'];

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");

if(@!$_SESSION['jointime']) {
	$_SESSION['jointime'] = date("U");
	$_SESSION['lastcheck'] = $_SESSION['jointime'];
	$_SESSION['channel'] = "Lobby";
}

function setOnline(){
	$zeit = date("U");
	$oldtime = date("U")-9;
	@mysql_query("DELETE FROM `et_online` WHERE `logtime` < '".$oldtime."'");
	$anz = @mysql_num_rows(mysql_query("SELECT * FROM `et_online` WHERE `username` = '{$_SESSION['et_user']}'"));
	if($anz == 1) {
		@mysql_query("UPDATE `et_online` SET `logtime` = '".$zeit."' WHERE `username` = '{$_SESSION['et_user']}'");
	} else {
		@mysql_query("INSERT INTO `et_online`VALUES('{$_SESSION['et_user']}','".$time."')");
	}
}

if($_GET['a'] == "online") {
	$erg = @mysql_query("SELECT * FROM `et_online` ORDER BY username ASC");
	while($data = @mysql_fetch_row($erg)) {
		echo $data[0].'<br>';
	}
}

if($_GET['a'] == "channel") {
	$_SESSION['channel'] = $_GET['channel'];
	echo 'New Channel: '.$_SESSION['channel'];
}

if($_GET['a'] == "out") {
	$generel = @mysql_query("SELECT * FROM `et_chat` WHERE `channel` = '{$_SESSION['channel']}' AND `msgtime` > '{$_SESSION['lastcheck']}'");
	$whisper = @mysql_query("SELECT * FROM `et_chat` WHERE `channel` = 'WHISPER' AND `whisperto` = '{$_SESSION['et_user']}' AND `msgtime` > '{$_SESSION['lastcheck']}'");
	$whisperto = @mysql_query("SELECT * FROM `et_chat`WHERE `channel` = 'WHISPER' AND `username` = '{$_SESSION['et_user']}' AND `msgtime` > '{$_SESSION['lastcheck']}'");
	while($data = @mysql_fetch_row($generel)) {
		echo '<span class="chat_line"><b>'.$data[1].' '.date("H:m:s", (int)$data[2]).':</b> '.$data[5].'</span><br>';
	}
	while($data = @mysql_fetch_row($whisper)) {
		echo '<span class="chat_line"><b>'.$data[1].' '.date("H:m:s", (int)$data[2]).' <i>fl&uuml;stert</i>:</b> '.$data[5].'</span><br>';
	}
	while($data = @mysql_fetch_row($whisperto)) {
		echo '<span class="chat_line"><b>'.$data[1].' '.date("H:m:s", (int)$data[2]).' <i>zu '.$data[4].'</i>:</b> '.$data[5].'</span><br>';
	}
	$_SESSION['lastcheck'] = date("U");
	setOnline();
}

if($_GET['a'] == "in") {
	$_SESSION['channel'] = !$_SESSION['channel'] ? "Lobby" : $_SESSION['channel'];
	$channel = $_SESSION['channel'];
	$whisper = 'NULL';
	$input = $_POST['message'];
	if(@$_SESSION['lastmsg'] == $input) {
		if(@$_SESSION['spam'] == "1") {
			$_SESSION['spam'] = "2";
		} else {
			$_SESSION['spam']  = "1";
		}
	} else {
		$_SESSION['lastmsg'] = $input;
		$_SESSION['spam'] = "0";
	}
		
	if(substr($input,0,3) == "/w ") {
		$block = @explode(" ",substr($input,3));
		$input = $block[1];
		$whisper = $block[0];
		$channel = "WHISPER";
	}
	
	for($i = 0; $i < count($bl); $i++){
		$input = str_replace($bl[$i],"<strike>...upps...</strike>",$input);
	}
	
	if(substr($input,0,5) == "/ann " && $_SESSION['et_lvl'] >= "4") {
		$input = '<font color="#c00"><b>'.substr($input,5).'</b></font>';
	}
	
	if(substr($input,0,16) == "/disconnect -all" && $_SESSION['et_lvl'] == "5") {
		$input = 'SYSTEM :: disconnect all user<script>location.replace("sys/logout.php");</script>';
	}
	//$channel = $_POST['whisper'] != "" ? "WHISPER" : $_SESSION['channel'];
	//$whisper = $_POST['whisper'] != "" ? $_POST['whisper'] : null;
	$time = date("U");
	@mysql_query("INSERT INTO `et_chat` VALUES('','{$_SESSION['et_user']}','".$time."','".$channel."','".$whisper."','".$input."')");
	if($_SESSION['spam'] == "1") {
		@mysql_query("INSERT INTO `et_chat` VALUES('','".$chatbot."','".$time."','WHISPER','{$_SESSION['et_user']}','<b>Bitte achte auf deine Eingabe. Eine weitere Wiederholung wird als Spam eingestuft und wirst aus dem Chat entfernt und von der Plattform abgemeldet.</b>')");
	}
	if($_SESSION['spam'] == "2") {
		@mysql_query("INSERT INTO `et_chat` VALUES('','".$chatbot."','".$time."','".$channel."','".$whisper."','<b>Der Nutzer ".$_SESSION['et_user']." wurde wegen Spam aus dem Chat entfernt!</b>')");
		echo '<script>location.replace("sys/logout.php");</script>';
	}
}

@mysql_close($db);
?>