<?php
$errmsg;
if($_GET['a'] == "1") {
	if($_POST['pass'] != "" && $_POST['pass'] == $_POST['pass2']) {
		$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE ("Verbindung nicht möglich!");
		@mysql_select_db($config['db_name']) OR DIE ("Datenbank nicht gefunden!".mysql_error());
		$pass = sha1(strtoupper($_POST['user']).':'.strtoupper($_POST['pass']));
		@mysql_query("UPDATE `et_user` SET `username` = '{$_POST['user']}', `last_name` = '{$_POST['lastname']}', `first_name` = '{$_POST['firstname']}', `email` = '{$_POST['email']}', `userpass` = '".$pass."' WHERE `id` = '{$_SESSION['et_uid']}'");
		if(array_key_exists('avatar',$_FILES)) {
			$tempname = $_FILES['avatar']['tmp_name'];
			$typ = $_FILES['avatar']['type'];
			$fp = fopen($tempname,'r');
			$data = addslashes(fread($fp,filesize($tempname)));
			@fclose($fp);
			$info = getimagesize($tempname);
			$anz = @mysql_num_rows(mysql_query("SELECT * FROM `et_avatars` WHERE `uid` = '{$_SESSION['et_uid']}'"));
			if($anz == 0) {
				@mysql_query("INSERT INTO `et_avatars` VALUES('','{$_SESSION['et_uid']}','".$data."','".$typ."','{$info[0]}','{$info[1]}')") || die(mysql_error());
			} else {
				@mysql_query("UPDATE `et_avatars` SET `image_data` = '".$data."', `image_type` = '".$typ."', `width` = '{$info[0]}', `height` = '{$info[1]}' WHERE `uid` = '{$_SESSION['et_uid']}'") || die(mysql_error());
			}
		}
		$_SESSION['et_user'] = $_POST['user'];
		$_SESSION['et_lastname'] = $_POST['lastname'];
		$_SESSION['et_firstname'] = $_POST['firstname'];
		$_SESSION['et_email'] = $_POST['email'];
		@mysql_close($db);
	} else {
		$errmsg = '<font color="#c00">Die Passw&ouml;rter m&uuml;ssem identisch sein!</font>';
	}
}

switch($_SESSION['et_lvl']) {
	default:
	$rang='Gast';
	break;
	case "1":
	$rang="Teilnehmer";
	break;
	case "4":
	$rang="Dozent";
	break;
	case "5":
	$rang="Administrator";
	break;
}

$image = 'class/image.class.php?img=data';
?>

<div class="content">
	<div id="dashboard"><?= $errmsg;?>
        <table border="0">
        <form action="index.php?page=profile&a=1" method="post" enctype="multipart/form-data">
        	<tr><td rowspan="8" valign="top" style="background-image:url('<?= $image;?>'); background-size:<?php @include('class/image.class.php');?>; width:120px; height:160px; background-repeat:no-repeat; background-position:center top;"><img src="img/border.png" height="160" /><br /><input name="avatar" type="file" accept="image/x-png" style="width:120px;" /></td>
            <td>Benutzer: </td>
            <td><input name="user" value="<?= $_SESSION['et_user'];?>" class="login" readonly /></td></tr>
            <tr><td>Rang: </td>
            <td><input name="rang" value="<?= $rang;?>" class="login" readonly="readonly" /></td></tr>
            <tr><td>Nachname: </td>
            <td><input name="lastname" value="<?= $_SESSION['et_lastname'];?>" class="login" /></td></tr>
            <tr><td>Vorname: </td>
            <td><input name="firstname" value="<?= $_SESSION['et_firstname'];?>" class="login" /></td></tr>
            <tr><td>E-Mail: </td>
            <td><input name="email" value="<?= $_SESSION['et_email'];?>" class="login" /></td></tr>
            <tr><td>Passwort:* </td>
            <td><input name="pass" type="password" value="" placeholder="Passwort" class="login" /></td></tr>
            <tr><td>Wiederholen:* </td>
            <td><input name="pass2" type="password" value="" placehodler="Passwort" class="login" /></td></tr>
            <tr><td colspan="2"><button type="submit">Speichern</button></td></tr>
            </form>
        </table>
	</div>
</div>