<div class="content">
	<?php
	$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']);
	@mysql_select_db($config['db_name']) OR DIE ("Datenbank nicht gefunden!");
	$max = date("Y")-1;
	@mysql_query("DELETE FROM `et_presence' WHERE `year` < '".$max."'");
	$erg = @mysql_query("SELECT * FROM `et_presence` WHERE `uid` = '{$_SESSION['et_uid']}' AND `year` = '".date("Y")."' AND `month` = '".date("m")."' AND `day` = '".date("d")."'");
	if(@mysql_num_rows($erg) == 0) {
		@mysql_query("INSERT INTO `et_presence` VALUES('{$_SESSION['et_uid']}','".date("Y")."','".date("m")."','".date("d")."')");
		$msg = 'Du bist nun anwesend!';
		$img = 'package-installed-updated';
	} else {
		$msg = 'Du bist bereits anwesend!';
		$img = 'dialog-warning';
	}
	@mysql_close($db);
	?>
    <center>
    	<div class="citem">
      		<img src="img/<?= $img; ?>.png" height="40" /><br />
			<small><?= $msg; ?></small>
        </div>
    </center>
</div>