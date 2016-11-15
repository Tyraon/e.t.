<?php
$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung nicht möglich!");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");

$erg = @mysql_query("SELECT * FROM `et_announce` WHERE `userid` = '{$_SESSION['et_uid']}' AND `ann_read` = '0' ORDER BY `id` ASC");

echo '<center>';
while($data = @mysql_fetch_row($erg)) {
	echo '<div class="announce" id="ann_'.$data[0].'">
	<p class="ann_title">'.utf8_decode($data[3]).'</p>
	<span class="ann_msg">'.utf8_decode($data[5]).'</span>
	<br><span id="'.$data[0].'" class="ann_close">schlie&szlig;en</span><br>
	</div>';
}
echo '</center>';

@mysql_close($db);
?>