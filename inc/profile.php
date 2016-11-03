<?php

if($_GET['a'] == "1") {
	$db = @mysql_connect($config['db_host'],$config['user'],$config['pass']);
	@mysql_select_db($config['db_name']);
	@mysql_query("UPDATE `et_user` SET `username` = '{$_POST['user']}', `last_name` = '{$_POST['lastname']}', `first_name` = '{$_POST['firstname']}', `email` = '{$_POST['email']}' WHERE `id` = '{$_SESSION['et_uid']}'");
	if($_POST['pass'] != "" && $_POST['pass'] == $_POST['pass2']) {
		@mysql_query("UPDATE `et_user`SET `user_pass` = '{$_POST['pass']}' WHERE `id` = '{$_SESSION['et_uid']}'");
	}
	@mysql_close($db);
}

switch($_SESSION['et_lvl']) {
	default:
	$rang='Gast';
	break;
	case "1":
	$rang="Nutzer";
	break;
	case "4":
	$rang="Dozent";
	break;
	case "5":
	$rang="Administrator";
	break;
}
?>

<div class="content">
	<div id="dashboard">
        <table border="0">
        <form action="index.php?page=profile&a=1" method="post">
        	<tr><td rowspan="8" valign="top" style="background-image:url('img/Gast.gif'); background-size:120px 160px; width:120px; height:160px; background-repeat:no-repeat; background-position:center top;"><img src="img/border.png" height="160" /></td>
            <td>Benutzer: </td>
            <td><input name="user" value="<?= $_SESSION['et_user'];?>" class="login" /></td></tr>
            <tr><td>Rang: </td>
            <td><input name="rang" value="<?= $rang;?>" class="login" readonly="readonly" /></td></tr>
            <tr><td>Nachname: </td>
            <td><input name="lastname" value="<?= $_SESSION['et_lastname'];?>" class="login" /></td></tr>
            <tr><td>Vorname: </td>
            <td><input name="firstname" value="<?= $_SESSION['et_firstname'];?>" class="login" /></td></tr>
            <tr><td>E-Mail: </td>
            <td><input name="email" value="<?= $_SESSION['et_email'];?>" class="login" /></td></tr>
            <tr><td>Passwort: </td>
            <td><input name="pass" value="" placeholder="Passwort" class="login" /></td></tr>
            <tr><td>Wiederholen: </td>
            <td><input name="pass2" value="" placehodler="Passwort" class="login" /></td></tr>
            <tr><td colspan="2"><button type="submit">Speichern</button></td></tr>
            </form>
        </table>
	</div>
</div>