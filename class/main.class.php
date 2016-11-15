<?php
@session_start();
@include('../sys/config.php');

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");

if($_GET['a'] == 'annread') {
	@mysql_query("UPDATE `et_announce` SET `ann_read` = '1' WHERE `id` = '{$_GET['ann']}'");
}

@mysql_close($db);

?>