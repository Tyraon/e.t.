<?php
@include('../sys/config.php');

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']);
@mysql_select_db($config['db_name']);

if($_GET['a'] == 'rl') {
	$erg = @mysql_query("SELECT * FROM `et_user`");
	while($data = @mysql_fetch_row($erg)) {
		echo '<tr><td>'.$data[1].'</td><td>'.$data[3].'</td><td>'.$data[4].'</td><td>'.$data[6].'</td><td>'.$data[7].'</td><td>'.$data[5].'</td><td><img src="img/document-edit.png" height="20" class="edit" id="'.$data[0].'" />&nbsp;<img src="img/gtk-missing-image.png" height="20" class="delete" id="'.$data[0].'" /></td></tr>';
	}
	echo '<script>
		$(\'.edit\').click(function(e){
			var target = !e.toElement ? e.target.id : e.toElement.id;
			$.ajax({
				url: \'class/manage.class.php?a=open\',
				method: \'POST\',
				data: {id: target}
			}).done(function(result){
				$(\'body\').append(result);
			});
		});
		$(\'.delete\').click(function(e){
			var target = !e.toElement ? e.target.id : e.toElement.id;
			$.ajax({
				url: \'class/manage.class.php?a=delete\',
				method: \'POST\',
				data: {id: target}
			}).done(function(result){
				reLoad();
			});
		});
		</script>';
}

if($_GET['a'] == 'upd') {
	@mysql_query("UPDATE `et_user` SET `username` = '{$_POST['user']}', `email` = '{$_POST['email']}', `lvl` = '{$_POST['lvl']}', `first_name` ='{$_POST['firstname']}', `last_name` = '{$_POST['lastname']}' WHERE `id` = '{$_POST['id']}'");
}

if($_GET['a'] == 'open') {
	$data = @mysql_fetch_row(mysql_query("SELECT * FROM `et_user` WHERE `id` = '{$_POST['id']}'"));
	echo '<div id="readWindow"><div id="mhead"><button id="winClose">x</button></div><table border="0">
	<tr><td>Username: </td><td><input id="user" value="'.$data[1].'"></td><tr>
	<tr><td>E-Mail: </td><td><input id="email" value="'.$data[3].'"></td><tr>
	<tr><td>Level: </td><td><input id="lvl" type="number" min="0" max="5" value="'.$data[4].'"></td><tr>
	<tr><td>First Name: </td><td><input id="firstname" value="'.$data[6].'"></td><tr>
	<tr><td>Last Name: </td><td><input id="lastname" value="'.$data[7].'"></td><tr>
	<tr><td>Course: </td><td><input id="course" type="number" min="0" max="1000" value="'.$data[8].'"></td><tr>
	<tr><td colspan="2" align="right"><button id="save">Save</button></td><tr>
	</table><input id="id" value="'.$data[0].'" type="hidden">
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
			url: \'class/manage.class.php?a=upd\',
			method: \'POST\',
			data: {id: $(\'#id\').val(), user: $(\'#user\').val(), email: $(\'#email\').val(), lvl: $(\'#lvl\').val(), firstname: $(\'#firstname\').val(), lastname: $(\'#lastname\').val()}
		}).done(function(result){
			$(\'#readWindow\').remove();
			reLoad();
		});
	});
	</script>';
}

if($_GET['a'] == 'opennew') {
	echo '<div id="readWindow"><div id="mhead"><button id="winClose">x</button></div><table border="0">
	<tr><td>Username: </td><td><input id="user"></td><tr>
	<tr><td>Password: </td><td><input id="pass"></td><tr>
	<tr><td>Repeat: </td><td><input id="pass2"></td><tr>
	<tr><td>E-Mail: </td><td><input id="email"></td><tr>
	<tr><td>Level: </td><td><input id="lvl" type="number" min="0" max="5" value="0"></td><tr>
	<tr><td>First Name: </td><td><input id="firstname"></td><tr>
	<tr><td>Last Name: </td><td><input id="lastname"></td><tr>
	<tr><td colspan="2" align="right"><button id="save">Save</button></td><tr>
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
			url: \'class/manage.class.php?a=setnew\',
			method: \'POST\',
			data: {id: $(\'#id\').val(), user: $(\'#user\').val(), pass: $(\'#pass\').val(), pass2: $(\'#pass2\').val(), email: $(\'#email\').val(), lvl: $(\'#lvl\').val(), firstname: $(\'#firstname\').val(), lastname: $(\'#lastname\').val()}
		}).done(function(result){
			if(result == "1"){
				$(\'#readWindow\').remove();
				reLoad();
			}
		});
	});
	</script>';
}

if($_GET['a'] == 'setnew') {
	if($_POST['pass'] == $_POST['pass2'] && $_POST['pass'] != "") {
		$pass = sha1(strtoupper($_POST['user']).':'.strtoupper($_POST['pass']));
		$time = date("Y-m-d H:i:s");
		@mysql_query("INSERT INTO `et_user` VALUES('','{$_POST['user']}','".$pass."','{$_POST['email']}','{$_POST['lvl']}','".$time."','{$_POST['firstname']}','{$_POST['lastname']}','0')");
		echo '1';
	} else {
		echo '0';
	}
}

if($_GET['a'] == 'delete') {
	@mysql_query("DELETE FROM `et_user` WHERE `id` = '{$_POST['id']}'");
}

@mysql_close($db);
?>
