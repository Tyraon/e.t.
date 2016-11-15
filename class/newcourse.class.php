<?php
@session_start();
@include('../sys/config.php');

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");

if($_GET['a'] == 'rl') {
	echo '<span id="list"><img src="img/user-group-new.png" height="40" id="newcourse" title="Create new Course" /><br>
	<table border="0" width="100%" style="border-collapse:collapse;"><tr><th align="left">ID</th><th align="left">Trainer</th><th align="left">Coursename</th>';
	$erg = @mysql_query("SELECT * FROM `et_course` ORDER BY `id` ASC");
	while($data = @mysql_fetch_row($erg)) {
		$coach = @mysql_fetch_row(mysql_query("SELECT * FROM `et_user` WHERE `id` = '{$data[1]}'"));
		echo '<tr><td>'.$data[0].'</td><td>'.utf8_encode($coach[7]).', '.$coach[6].'</td><td>'.$data[2].'</td><td><img src="img/gtk-missing-image.png" height="20" class="delete" id="'.$data[0].'" /></td></tr>';
	}
	echo '</table>

	<script>
		$(\'.delete\').click(function(e){
			var target = !e.toElement ? e.target.id : e.toElement.id;
			$.ajax({
				url: \'class/newcourse.class.php?a=delete\',
				method: \'POST\',
				data: {cid: target}
			}).done(function(result){
				console.log(result);
				location.reload();
			});
		});

		$(\'#newcourse\').click(function(){
			$.ajax({
				url: \'class/newcourse.class.php?a=open&open=newcourse\',
				method: \'GET\'
			}).done(function(result){
				$(\'body\').append(result);
			});
		});
	</script></span>';
}

if($_GET['a'] == 'open') {
	if($_GET['open'] == 'newcourse') {
		echo '<span id="window"><div id="readWindow"><div id="mhead"><button id="winClose">x</button></div><table border="0">
		<tr><td>Trainer: </td><td><select size="1" id="trainer">';
		$erg = @mysql_query("SELECT * FROM `et_user` WHERE `lvl` >= '4' ORDER BY `id`ASC");
		while($data = @mysql_fetch_row($erg)) {
			echo '<option value="'.$data[0].'">'.utf8_encode($data[7]).', '.$data[6].'</option>';
		}
		echo '</select></td></tr>
		<tr><td>Coursename: </td><td><input id="cname" class="login"></td><tr>
		<tr><td valign="top">Description: </td><td><textarea id="cdescript" class="descript" style="border: 1px solid #aaa; border-radius: 5px; padding-left: 5px; padding-right: 5px; background: none; color: #333; font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; width: 400px; height: 100px;">'.$data[3].'</textarea></td><tr>
		<tr><td align="right"><button type="submit" class="login" id="save">Save</button></td><tr>
		</table>
		</div>
		<script>
			$(\'#winClose\').click(function(){
				$(\'#readWindow\').remove();
			});
		
			$(\'#mhead\').mousedown(function(){
				$(\'#readWindow\').draggable({disabled:false});
			}).mouseup(function(){
				$(\'#readWindow\').draggable({disabled:true});
			});
			$(\'#save\').click(function(){
				$.ajax({
					url: \'class/newcourse.class.php?a=newcourse\',
					method: \'POST\',
					data: {course_trainer: $(\'#trainer option:selected\').val(), course_name: $(\'#cname\').val(), course_descript: $(\'#cdescript\').val()}
				}).done(function(result){
					console.log(result);
					$(\'#window\').remove();
					location.reload();
				});
			});
		</script>
		</span>';
	}
}

if($_GET['a'] == 'newcourse') {
	if(@mysql_query("INSERT INTO `et_course` VALUES('0','{$_POST['course_trainer']}','{$_POST['course_name']}','{$_POST['course_descript']}')")) {
		$data = @mysql_fetch_row(mysql_query("SELECT * FROM `et_course` WHERE `teacher` = '{$_POST['course_trainer']}'"));
		@mysql_query("UPDATE `et_user` SET `course` = '{$data[0]}' WHERE `id` = '{$_POST['course_trainer']}'");
		echo 'saved';
	}
}

if($_GET['a'] == 'delete') {
	if(@mysql_query("DELETE FROM `et_course` WHERE `id` = '{$_POST['cid']}'")) {
		echo 'deleted';
	}
}

@mysql_close($db);
?>