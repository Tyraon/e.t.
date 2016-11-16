<?php
@session_start();
@include('../sys/config.php');

$origin = array('<ul>','</ul>','<li>','<small>','</small>','<em>','</em>','<h1>','</h1>','<h2>','</h2>','<h3>','</h3>','<h4>','</h4>','<br />','<p>','</p>','<b>','</b>','<i>','</i>','<u>','</u>','<s>','</s>');
$conv = array('[list]','[/list]','*- ','[small]','[/small]','[code]','[/code]','[h1]','[/h1]','[h2]','[/h2]','[h3]','[/h3]','[h4]','[/h4]','[br]','[p]','[/p]','[b]','[/b]','[i]','[/i]','[u]','[/u]','[s]','[/s]');
	


$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");

if($_GET['a'] == 'rl') {
	echo '<img src="img/Start-Menu-Search-icon.png" height="20" style="float:right;" class="search" /><input id="filter" class="login" placeholder="Suche . . ." style="float:right;" /><br>';
	echo '<table border="0" style="border-collapse:collapse;">';
	$erg = @mysql_query("SELECT * FROM `et_category` ORDER BY `cat_name` ASC");
	while($data = @mysql_fetch_row($erg)) {
		echo '<tr><td class="go" id="'.$data[0].'" style="cursor:default;"><b id="'.$data[0].'">'.$data[1].'</b><br><small id="'.$data[0].'">'.$data[2].'</small><br><br></td></tr>';
	}
	echo '</table>
	<script>
		$(\'.go\').click(function(e){
		var target = !e.toElement ? e.target.id : e.toElement.id; 
		$.ajax({
			url: \'class/article.class.php?a=category&cat=\' + target,
			method: \'GET\'
		}).done(function(result){
			$(\'#dashboard\').html(result);
		});
		});
		
		$(\'.search\').click(function(e){
			$.ajax({
				url: \'class/article.class.php?a=search&filter=\' + $(\'#filter\').val(),
				method: \'GET\'
			}).done(function(result){
				$(\'#dashboard\').html(result);
			});
		});
	</script>';
}

if($_GET['a'] == 'search') {
	$erg = @mysql_query("SELECT * FROM `et_article` WHERE `content` LIKE '%{$_GET['filter']}%'");
	while($data = @mysql_fetch_row($erg)) {
		$user = @mysql_fetch_row(mysql_query("SELECT * FROM `et_user` WHERE `id` = '{$data[3]}'"));
		echo '<table border="0" width="100%" class="article" id="'.$data[0].'"  style="cursor:default;"><tr><th align="left" id="'.$data[0].'">'.utf8_encode($data[2]).'</th></tr><tr><td id="'.$data[0].'"><small id="'.$data[0].'">'.substr(utf8_encode($data[5]),0,255).' . . .</small></td></tr><tr><td align="right" id="'.$data[0].'"><small><small id="'.$data[0].'"><a href="index.php?page=view&user='.$user[0].'">'.utf8_encode($user[7].', '.$user[6]).'</a> :: '.$data[4].'</small></small></td></tr></table><br>';
	}
	echo '<script>
	$(\'.article\').click(function(e){
			var target = !e.toElement ? e.target.id : e.toElement.id;
			$.ajax({
				url: \'class/article.class.php?a=article&art=\' + target,
				method: \'GET\'
			}).done(function(result){
				$(\'#dashboard\').html(result);
			});
		});
		</script>';
}

if($_GET['a'] == 'category') {
	/*echo $_GET['cat'];
	echo 'OK';
	echo $_GET['a'];*/
	echo '<img src="img/gtk-convert.png" height="40" class="back" title="Zurück" /><img src="img/document-edit.png" height="40" id="newarticle" style="float:right;" /><br>';
	$erg = @mysql_query("SELECT * FROM `et_article` WHERE `cat` = '{$_GET['cat']}' ORDER BY `id` DESC LIMIT 0,50");
	while($data = @mysql_fetch_row($erg)) {
		$user = @mysql_fetch_row(mysql_query("SELECT * FROM `et_user` WHERE `id` = '{$data[3]}'"));
		echo '<table border="0" width="100%" class="article" id="'.$data[0].'"  style="cursor:default;"><tr><th align="left" id="'.$data[0].'">'.utf8_encode($data[2]).'</th></tr><tr><td id="'.$data[0].'"><small id="'.$data[0].'">'.substr(utf8_encode($data[5]),0,255).' . . .</small></td></tr><tr><td align="right" id="'.$data[0].'"><small><small id="'.$data[0].'"><a href="index.php?page=view&user='.$user[0].'">'.utf8_encode($user[7].', '.$user[6]).'</a> :: '.$data[4].'</small></small></td></tr></table><br>';
	}
	echo '<script>
		$(\'.article\').click(function(e){
			var target = !e.toElement ? e.target.id : e.toElement.id;
			$.ajax({
				url: \'class/article.class.php?a=article&art=\' + target,
				method: \'GET\'
			}).done(function(result){
				$(\'#dashboard\').html(result);
			});
		});
		
		$(\'#newarticle\').click(function(){
			$.ajax({
				url: \'class/article.class.php?a=newarticle&cat='.$_GET['cat'].'\',
				method: \'GET\'
			}).done(function(result){
				$(\'#dashboard\').html(result);
			});
		});
		
		$(\'.back\').click(function(e){
			location.reload();
		});
	</script>';
}

if($_GET['a'] == 'article') {
	$from = $conv;
	$to = $origin;
	$data = @mysql_fetch_row(mysql_query("SELECT * FROM `et_article` WHERE `id` = '{$_GET['art']}'"));
	$content = utf8_encode($data[5]);
	echo '<img src="img/gtk-convert.png" height="40" class="back" title="Zurück" />
	<table border="0"><tr><th align="left">'.utf8_encode($data[2]).'</th></tr><tr><td><small>';
	//for($i = 0; $i < count($from); $i++) {
		$content = str_replace($from,$to,$content);
	//}
	echo $content;
	echo '</small></td></tr><tr><td align="right">';
	if($_SESSION['et_lvl'] >= '4') {
		echo '<img src="img/sticky-notes.png" height="20" class="ann" title="Nachricht" />';
	}
	if($_SESSION['et_lvl'] == '5' || $data[2] == $_SESSION['et_uid']) {
		echo '<img src="img/format-text-direction-ltr.png" height="20" class="edit" title="edit" />';
	}
	if($_SESSION['et_lvl'] == '5') {
		echo '&nbsp;<img src="img/gtk-missing-image.png" height="20" class="delete" title="delete" />';
	}
	echo '</td></tr></table>
	<script>
		$(\'.edit\').click(function(){
			$.ajax({
				url: \'class/article.class.php?a=edit&edit='.$_GET['art'].'\',
				method: \'GET\'
			}).done(function(result){
				$(\'#dashboard\').html(result);
			});
		});

		$(\'.delete\').click(function(){
			$.ajax({
				url: \'class/article.class.php?a=delete&delete='.$_GET['art'].'\',
				method: \'GET\'
			}).done(function(result){
				console.log(result);
				reLoad();
			});
		});
		
		$(\'.ann\').click(function(){
			$.ajax({
				url: \'class/course.class.php?a=open&open=newann&link='.$_GET['art'].'\',
				method: \'GET\'
			}).done(function(result){
				$(\'body\').append(result);
			});
		});
		
		$(\'.back\').click(function(e){
		var target = '.$data[1].'; 
		$.ajax({
			url: \'class/article.class.php?a=category&cat=\' + target,
			method: \'GET\'
		}).done(function(result){
			$(\'#dashboard\').html(result);
		});
		});

	</script>';
}

if($_GET['a'] == 'newarticle') {
	echo '<table border="0"><tr><td>Titel: </td><td><input id="art_title" class="login" style="width:700px;" placeholder="Titel des Artikels" /></td></tr>
	<tr><td valign="top">Artikel: </td><td><textarea id="art_text" class="descript" style="border: 1px solid #aaa; border-radius: 5px; padding-left: 5px; padding-right: 5px; background: none; color: #333; font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; width: 700px; height: 300px;" placeholder="Artikeltext"></textarea></td></tr>
	<tr><td colspan="2" align="right"><button id="save" class="login">Speichern</button></td></tr></table>
	<script>
		$(\'#save\').click(function(){
			$.ajax({
				url: \'class/article.class.php?a=insert&cat='.$_GET['cat'].'\',
				method: \'POST\',
				data: {art_title: $(\'#art_title\').val(), art_content: $(\'#art_text\').val()}
			}).done(function(result){
				console.log(result);
				reLoad();
			});
		});
	</script>';
}

if($_GET['a'] == 'insert') {
	$from = origin;
	$to = $conv;
	$content = str_replace($from,$to,$_POST['art_content']);

	if(@mysql_query("INSERT INTO `et_article` VALUES('','{$_GET['cat']}','{$_POST['art_title']}','{$_SESSION['et_uid']}','".date("Y-m-d H:i:s")."','".strip_tags($content)."')")) {
		echo 'saved';
	}
		$logging = "2,User ".$_SESSION['et_user']." article :: create (".$_POST['art_title']." - ".$_GET['cat'].")";
		@include('../sys/log.php');
}

if($_GET['a'] == 'delete') {
	if(@mysql_query("DELETE FROM `et_article` WHERE `id` = '{$_GET['delete']}'")) {
		echo "deleted";
	}
	echo '<script>
		reLoad();
	</script>';
		$logging = "2,User ".$_SESSION['et_user']." article :: delete (".$_GET['delete'].")";
		@include('../sys/log.php');
}

if($_GET['a'] == 'edit') {
	$from = $conv;
	$to = $origin;
	$data = @mysql_fetch_row(mysql_query("SELECT * FROM `et_article` WHERE `id` = '{$_GET['edit']}'"));
	$content = utf8_encode($data[5]);
	echo '<table border="0"><tr><th align="left"><input id="art_title" class="login" style="width:700px;" placeholder="Titel des Artikels" value="'.utf8_encode($data[2]).'" /></th></tr><tr><td><textarea id="art_text" class="descript" style="border: 1px solid #aaa; border-radius: 5px; padding-left: 5px; padding-right: 5px; background: none; color: #333; font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; width: 700px; height: 300px;" placeholder="Artikeltext">';
	//for($i = 0; $i < count($from); $i++) {
		$content = str_replace($from,$to,$content);
	//}
	echo $content;
	echo '</textarea></td></tr>';
	echo '<tr><td align="right"><button id="save" class="login">Speichern</button></td></tr>';
	echo '</table>
	<script>
		$(\'#save\').click(function(){
			$.ajax({
				url: \'class/article.class.php?a=update&update='.$_GET['edit'].'\',
				method: \'POST\',
				data: {art_name: $(\'#art_title\').val(), art_content: $(\'#art_text\').val()}
			}).done(function(result){
				console.log(result);
				reLoad();
			});
		});
	</script>';	
}

if($_GET['a'] == 'update') {
	$from = $origin;
	$to = $conv;
	$content = str_replace($from,$to,$_POST['art_content']);

	if(@mysql_query("UPDATE `et_article` SET `art_title` = '{$_POST['art_name']}', `content` = '".strip_tags($content)."' WHERE `id` = '{$_GET['update']}'")) {
		echo "updated";
	}
		$logging = "2,User ".$_SESSION['et_user']." article :: update (".$_POST['art_name'].")";
		@include('../sys/log.php');
}


@mysql_close($db);
?>