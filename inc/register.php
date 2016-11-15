<?php

if($_GET['a'] == '1' && $_POST['user'] != '' && $_POST['pass'] != '' && $_POST['pass'] == $_POST['pass2']) {
$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']);
@mysql_select_db($config['db_name']);
	$anz = @mysql_num_rows(mysql_query("SELECT * FROM `et_user` WHERE `username` = '{$_POST['user']}'"));
	if($anz == 0) {
		$pass = sha1(strtoupper($_POST['user']).':'.strtoupper($_POST['pass']));
		@mysql_query("INSERT INTO `et_user` VALUES('','{$_POST['user']}','".$pass."','{$_POST['email']}','0','0000-00-00 00:00:00','{$_POST['firstname']}','{$_POST['lastname']}','0')");
		echo '<script>location.replace("index.php");</script>';
	} else {
		$errmsg = 'Benutzername nicht verfügbar!';
	}
}

?>

<div class="content">
	<div id="dashboard">
		<form action="index.php?page=register&a=1" method="post">
		<?= $errmsg;?>
		<table border="0">
		<tr><th colspan="2">Registrieren</th></tr>
		<tr><td>Benutzer: </td><td><input name="user" class="login" placeholder="Benutzername" pattern="(?=.*[a-z])(?=.*[A-Z]).{5,20}" /></td></tr
		<tr><td>Passwort: </td><td><input name="pass" class="login" type="password" placeholder="Passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" /></td></tr>
		<tr><td>Wiederholen: </td><td><input name="pass2" class="login" type="password" placeholder="Passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" /></td></tr>
		<tr><td>E-Mail: </td><td><input name="email" class="login" placeholder="xxx@yy.zz" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" /></td></tr>
		<tr><td>Vorname: </td><td><input name="firstname" class="login" placeholder="Vorname" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,}" /></td></tr>
		<tr><td>Nachname: </td><td><input name="lastname" class="login" placeholder="Nachname" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,}" /></td></tr>
		<tr><td colspan="2" align="right"><button type="submit" class="login">registrieren</button></td></tr>
		</table>
		</form>
	</div>
</div>