<?php

$errmsg;

if($_GET['a'] == "1") {
	$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']);
	@mysql_select_db($config['db_name']);
	$data = @mysql_fetch_row(mysql_query("SELECT * FROM et_user WHERE username LIKE '{$_POST['user']}'"));
	$pass = sha1(strtoupper($_POST['user']).':'.strtoupper($_POST['pass']));
	if($_POST['user'] != "" && $pass == $data[2]) {
		$_SESSION['et_uid'] = $data[0];
		$_SESSION['et_user'] = $data[1];
		$_SESSION['et_lvl'] = $data[4];
		$_SESSION['et_last_login'] = $data[5];
		$_SESSION['et_lastname'] = $data[7];
		$_SESSION['et_firstname'] = $data[6];
		$_SESSION['et_email'] = $data[3];
		$_SESSION['et_course'] = $data[8];
		$newtime = date("Y-m-d H:i:s");
		@mysql_query("UPDATE et_user SET last_login='".$newtime."' WHERE username LIKE '{$_POST['user']}");
		echo '<script>location.replace("index.php");</script>';
        //echo session_id();
		//echo $newtime;
	} else {
		$errmsg = 'Anmeldedaten nicht korrekt!';
	}
	@mysql_close($db);
}

?>

<div id="login">
<form action="index.php?a=1" method="post">
<small><font color="#CC0000"><?= $errmsg;?></font></small>
<h4 style="margin-top:0px;">Anmelden</h4>
<input name="user" class="login" placeholder="Benutzer" /><br />
<input name="pass" type="password" class="login" placeholder="Passwort" /><br />
<button type="submit" class="login" style="margin-top: 5px;">Anmelden</button>
</form>
</div>