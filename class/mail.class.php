<?php
//@include('../sys/cfg.php');
@include('../sys/config.php');

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']);
@mysql_select_db($config['db_name']) OR DIE('Datenbank nicht gefunden!');

if($_GET['a'] == "inbox") {
	$erg = @mysql_query("SELECT * FROM et_mail WHERE to_user LIKE '{$_GET['user']}' AND inbox LIKE '1' ORDER BY id DESC") OR DIE('Keine Nachrichten vorhanden!');
	while($data = @mysql_fetch_row($erg)) {
		$style = $data[6] == "1" ? "0" : "bold";
		echo '<tr><td id="'.$data[0].'" class="mlist" style="font-weight:'.$style.';">'.$data[3].'</td><td id="'.$data[0].'" class="mlist" style="font-weight:'.$style.';">'.$data[1].'</td><td id="'.$data[0].'" class="mlist" style="font-weight:'.$style.';">'.$data[4].'</td><td><button id="'.$data[0].'" class="deleteInbox"></button></td></tr>';
	}
}

if($_GET['a'] == "outbox") {
	$erg = @mysql_query("SELECT * FROM et_mail WHERE from_user LIKE '{$_GET['user']}' AND outbox LIKE '1' ORDER BY id DESC") OR DIE('Keine Nachrichten vorhanden!');
	while($data = @mysql_fetch_row($erg)) {
		$style = $data[6] == "1" ? "0" : "bold";
		echo '<tr><td id="'.$data[0].'" class="mlist" style="font-weight:'.$style.';">'.$data[3].'</td><td id="'.$data[0].'" class="mlist" style="font-weight:'.$style.';">'.$data[2].'</td><td id="'.$data[0].'" class="mlist" style="font-weight:'.$style.';">'.$data[4].'</td><td><button id="'.$data[0].'" class="deleteOutbox"></button></td></tr>';
	}
}

if($_GET['a'] == "read") {
	$data = @mysql_fetch_row(mysql_query("SELECT * FROM et_mail WHERE id LIKE '{$_GET['mail']}'"));
	if($data[2] == $_GET['check'] && $data[6] == "0") {
		$update = @mysql_query("UPDATE `et_mail` SET `read` = '1' WHERE `et_mail`.`id` = '{$_GET['mail']}'") OR DIE('Nachricht konnte nicht gelesen werden!');
	}
	echo '<div id="mailHeader">Absender: <span id="sender">'.$data[1].'</span><br>Empf&auml;nger: '.$data[2].'<br>Datum: '.$data[4].'<br><b>Betreff: <span id="r_rcp">'.$data[3].'</span></b>&nbsp;<img src="img/old-edit-undo.png" id="answer" height="20" class="mhakt" />&nbsp;<img src="img/old-edit-redo.png" id="forward" height="20" class="mhakt" /></div>';
	echo '<textarea id="mailcontent" readonly>'.$data[5].'</textarea>';
}

if($_GET['a'] == "lfu") {
	$output = '<div id="lfu">';
	$erg = @mysql_query("SELECT `username` FROM et_user WHERE username LIKE '%{$_GET['look']}%' AND username NOT LIKE '{$_GET['check']}'");
	while($data = @mysql_fetch_row($erg)) {
	$output .= '<span id="'.$data[0].'" class="selectuser">'.$data[0].'</span>';
	}
	$output .= '</div>';
	echo $output;
}

if($_GET['a'] == "sendmail") {
	if(@mysql_query("INSERT INTO et_mail VALUES('0','{$_POST['from']}','{$_POST['sendto']}','{$_POST['rcp']}','".date("Y-m-d H:i:s")."','{$_POST['message']}','0','1','1')")) {
		echo 'sended';
	} else {
		echo 'Nachricht konnte nicht an '.$_POST['sendto'].' gesendet werden!';
	}
}

if($_GET['a'] == "deleteinbox") {
	if(@mysql_query("UPDATE `et_mail` SET `inbox` = '0' WHERE `et_mail`.`id` = '{$_GET['mail']}'")) {
		echo 'Nachricht gel&ouml;scht!';
	} else {
		echo '<font color="#c00">Nachricht konnte nicht gel&ouml;scht werden!</font>';
	}
}

if($_GET['a'] == "deleteoutbox") {
	if(@mysql_query("UPDATE `et_mail` SET `outbox` = '0' WHERE `et_mail`.`id` = '{$_GET['mail']}'")) {
		echo 'Nachricht gel&ouml;scht!';
	} else {
		echo '<font color="#c00">Nachricht konnte nicht gel&ouml;scht werden!</font>';
	}
}


@mysql_close($db);
//echo 'Nutzer: '.$_SESSION['et_user'];
?>
