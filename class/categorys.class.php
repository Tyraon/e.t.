<?php
@session_start();
@include('../sys/config.php');

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");

if($_GET['a'] == 'rl') {
	echo '<img src="img/document-edit.png" height="40" id="newcat" /><br>';
	echo '<table border="0" width="100%"><tr><th align="left">Name</th><th align="left">Description</th><th></th></tr>';
	$erg = @mysql_query("SELECT * FROM `et_category`");
	while($data = @mysql_fetch_row($erg)) {
		echo '<tr><td>'.$data[1].'</td><td><small>'.$data[2].'</small></td><td><img src="img/gtk-missing-image.png" height="16" class="remove" id="'.$data[0].'" /></td></tr>';
	}
	echo '</table>';
	echo '<script>
	$(\'.remove\').click(function(e){
		var target = !e.toElement ? e.target.id : e.toElement.id;
		var recur = confirm(\'Sollen ALLE Artikel in der Kategorie ebenfalls gelöscht werden?\');
		recur = recur == true ? 1 : 0;
		$.ajax({
			url: \'class/categorys.class.php?a=remove&del=\' + target + \'&recur=\' + recur,
			method: \'GET\'
		}).done(function(result){
			reLoad();
		});
	});
	
	$(\'#newcat\').click(function(e){
		$.ajax({
			url: \'class/categorys.class.php?a=newcat\',
			method: \'GET\'
		}).done(function(result){
			$(\'body\').append(result);
		});
	});
	</script>';
}

if($_GET['a'] == 'remove') {
	@mysql_query("DELETE FROM `et_category` WHERE `id` = '{$_GET['del']}'");
	if($_GET['recur'] == "1") {
		@mysql_query("DELETE FROM `et_article` WHERE `cat` = '{$_GET['del']}'");
	}
}

if($_GET['a'] == 'newcat') {
			echo '<span id="range"><div id="readWindow"><div id="mhead"><button id="winClose">x</button></div><table border="0" style="border-collapse:collapse;">
			<tr><td>Category: </td><td><input id="cat_name" class="login" style="width:400px;" /></td></tr>
			<tr><td valign="top">Description: </td><td><textarea id="cat_desc" class="login" style="width:400px; height:50px;"></textarea></td></tr>
			<tr><td colspan="2" align="right"><button id="save" class="login">Create</button></td></tr>
			</table></div></span>';
			echo '<script>
		$(\'#winClose\').click(function(){
			$(\'#range\').remove();
		});
		
		$(\'#mhead\').mousedown(function(){
			$(\'#readWindow\').draggable({disabled:false});
		}).mouseup(function(){
			$(\'#readWindow\').draggable({disabled:true});
		});

		$(\'#save\').click(function(){
			$.ajax({
				url: \'class/categorys.class.php?a=insert\',
				method: \'POST\',
				data: {cat_name: $(\'#cat_name\').val(), cat_desc: $(\'#cat_desc\').val()}
			}).done(function(result){
				$(\'#range\').remove();
				reLoad();
				//console.log(result);
			});
		});

		</script>';
}

if($_GET['a'] == 'insert') {
	@mysql_query("INSERT INTO `et_category` VALUES('','{$_POST['cat_name']}','{$_POST['cat_desc']}')") || die(mysql_error());
}

@mysql_close($db);
?>