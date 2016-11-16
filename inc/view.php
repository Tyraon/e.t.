<?php
$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");

$prof = mysql_fetch_assoc(mysql_query("SELECT * FROM `et_user` WHERE `id` = '{$_GET['user']}'"));
switch($prof['lvl']) {
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
echo $size;
echo '<div class="content">
	<div id="dashboard">
		        <table border="0">
        	<tr><td rowspan="4" valign="top" style="background-image:url(\'class/image.class.php?img=data&user='.$_GET['user'].'\'); background-size:';
include('class/image.class.php');			
			echo '; width:120px; height:160px; background-repeat:no-repeat; background-position:center top;"><img src="img/border.png" height="160" /></td>
            <td>Benutzer: </td>
            <td><input name="user" value="'.$prof['username'].'" class="login" readonly="readonly" /></td></tr>
            <tr><td>Rang: </td>
            <td><input name="rang" value="'.$rang.'" class="login" readonly="readonly" /></td></tr>
            <tr><td>Nachname: </td>
            <td><input name="lastname" value="'.$prof['last_name'].'" class="login" readonly="readonly" /></td></tr>
            <tr><td>Vorname: </td>
            <td><input name="firstname" value="'.$prof['first_name'].'" class="login" readonly="readonly" /></td></tr>
        </table>
	</div></div>';

@mysql_close($db);
?>