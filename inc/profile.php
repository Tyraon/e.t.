<?php
switch($_SESSION['et_lvl']) {
	default:
	$rang='Gast';
	break;
	case "1":
	$rang="Nutzer";
	break;
	case "5":
	$rang="Administrator";
	break;
}
?>

<div class="content">
	<div id="dashboard">
        <table border="0">
        	<tr><td rowspan="5" style="background-image:url('img/Gast.gif'); background-size:120px 160px; width:120px; height:160px; background-repeat:no-repeat; background-position:center;"><img src="img/border.png" height="160" /></td>
            <td>Benutzer: </td>
            <td><input name="user" value="<?= $_SESSION['et_user'];?>" class="login" /></td></tr>
            <tr><td>Rang: </td>
            <td><input name="rang" value="<?= $rang;?>" class="login" /></td></tr>
            <tr><td>Nachname: </td>
            <td><input name="lastname" value="<?= $_SESSION['et_lastname'];?>" class="login" /></td></tr>
            <tr><td>Vorname: </td>
            <td><input name="firstname" value="<?= $_SESSION['et_firstname'];?>" class="login" /></td></tr>
            <tr><td>E-Mail: </td>
            <td><input name="email" value="<?= $_SESSION['et_email'];?>" class="login" /></td></tr>
        </table>
	</div>
</div>