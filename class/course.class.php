<?php
@session_start();
@include('../sys/config.php');

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']);
@mysql_select_db($config['db_name']);

if($_GET['a'] == 'rl') {
	echo '<table border="0" class="citem" id="user"><tr><td id="user">
        <img src="img/emblem-people.png" height="40" id="user" /></td></tr>
        <tr><td id="user">Teilnehmer
        </td></tr></table>
		<table border="0" class="citem" id="presence"><tr><td id="presence">
        <img src="img/application-vnd.oasis.opendocument.spreadsheet-template.png" height="40" id="presence" /></td></tr>
        <tr><td id="presence">Anwesend
        </td></tr></table>
		<table border="0" class="citem" id="settings"><tr><td id="settings">
        <img src="img/gnome-panel-workspace-switcher.png" height="40" id="settings" /></td></tr>
        <tr><td id="settings">Einstellung
        </td></tr></table>
		
		<script>
		$(\'.citem\').click(function(e){
			var target = !e.toElement ? e.target.id : e.toElement.id;
			$.ajax({
				url: \'class/course.class.php?a=open&open=\' + target,
				method: \'GET\'
			}).done(function(result){
				$(\'body\').append(result);
			});
		});
		</script>
		';
}

if($_GET['a'] == 'open') {
	if($_GET['open'] == 'user') {
		echo '<span id="range"><div id="readWindow"><div id="mhead"><button id="winClose">x</button></div><img src="img/emblem-draft.png" height="40" id="newuser" /><br /><table border="0" width="100%" style="border-collapse:collapse;">
		<tr style="background:#ddd;"><th align="left">Nachname</th><th align="left">Vorname</th><th align="left">E-Mail</th><th></th></tr>';
		$erg = @mysql_query("SELECT * FROM `et_user` WHERE `course` = '{$_SESSION['et_course']}' AND `id` != '{$_SESSION['et_uid']}' ORDER BY `last_name` ASC");
		while($data = @mysql_fetch_row($erg)) {
			echo '<tr><td>'.utf8_encode($data[7]).'</td><td>'.utf8_encode($data[6]).'</td><td>'.$data[3].'</td><td><img src="img/gtk-missing-image.png" height="20" class="delete" id="'.$data[0].'" /></td></tr>';
		}
		echo '</table></div>
		<script>
		$(\'#winClose\').click(function(){
			$(\'#range\').remove();
		});
		
		$(\'#mhead\').mousedown(function(){
			$(\'#readWindow\').draggable({disabled:false});
		}).mouseup(function(){
			$(\'#readWindow\').draggable({disabled:true});
		});
		
		$(\'.delete\').click(function(e){
			var target = !e.toElement ? e.target.id : e.toElement.id;
			$.ajax({
				url: \'class/course.class.php?a=removeuser\',
				method: \'POST\',
				data: {id: target}
			}).done(function(result){
				$(\'#range\').remove();
			});
		});
		$(\'#newuser\').click(function(){
			$.ajax({
				url: \'class/course.class.php?a=open&open=newuser\',
				method: \'GET\'
			}).done(function(result){
				$(\'#range\').remove();
				$(\'body\').append(result);
			});
		});
		</script></span>
		';
	}
	
	if($_GET['open'] == 'newuser') {
		echo '<span id="range"><div id="readWindow"><div id="mhead"><button id="winClose">x</button></div>
		<input id="filter" class="login" placeholder="Nachnamen eingeben ..." /><br>
		<table border="0" width="100%" style="border-collapse:collapse;">
		<tr style="background:#ddd;"><th align="left">Nachname</th><th align="left">Vorname</th><th align="left">E-Mail</th><th></th></tr>';
		echo '<tbody id="userlist"></tbody>';
		echo '</table></div>
		<script>
		filter();
		
		$(\'#winClose\').click(function(){
			$(\'#range\').remove();
		});
		
		$(\'#mhead\').mousedown(function(){
			$(\'#readWindow\').draggable({disabled:false});
		}).mouseup(function(){
			$(\'#readWindow\').draggable({disabled:true});
		});
		
		$(\'#filter\').keyup(filter);
		
		function filter(){
			$.ajax({
				url: \'class/course.class.php?a=filter&filter=\' + $(\'#filter\').val(),
				method: \'GET\'
			}).done(function(result){
				$(\'#userlist\').html(result);
			});
		}
		
		</script></span>
		';
	}
	
	if($_GET['open'] == 'presence') {
		echo '<span id="range"><div id="readWindow"><div id="mhead"><button id="winClose">x</button></div>
		<input id="filter" class="login" placeholder="Nachnamen eingeben ..." />
		<select id="range" size="1">
			<option value="0">Januar</option>
			<option value="1">Februar</option>
			<option value="2">März</option>
			<option value="3">April</option>
			<option value="4">Mai</option>
			<option value="5">Juni</option>
			<option value="6">Juli</option>
			<option value="7">August</option>
			<option value="8">September</option>
			<option value="9">Oktober</option>
			<option value="10">November</option>
			<option value="11">Dezember</option>
		</select>
		<input id="year" type="number" value="'.date("Y").'" min="1900" max="2500"/>
		<br>
		<table border="0" width="100%" style="border-collapse:collapse;">
		';
		echo '<tbody id="userlist"></tbody>';
		echo '</table></div>
		<script>
		filter();
		
		$(\'#range\').change(range);
		$(\'#year\').change(range);
		
		$(\'#winClose\').click(function(){
			$(\'#range\').remove();
		});
		
		$(\'#mhead\').mousedown(function(){
			$(\'#readWindow\').draggable({disabled:false});
		}).mouseup(function(){
			$(\'#readWindow\').draggable({disabled:true});
		});
		
		$(\'#filter\').keyup(filter);
		
		function filter(){
			$.ajax({
				url: \'class/course.class.php?a=presence&presence=now\',
				method: \'GET\'
			}).done(function(result){
				$(\'#userlist\').html(result);
			});
		}
		function range(){
			$.ajax({
				url: \'class/course.class.php?a=presence&presence=month&month=\' + $(\'#range option:selected\').val() + \'&year=\' + $(\'#year\').val(),
				method: \'GET\'
			}).done(function(result){
				$(\'#userlist\').html(result);
			});
		}
		
		</script></span>
		';

	}
	
	if($_GET['open'] == 'settings') {
		echo '<span id="range"><div id="readWindow"><div id="mhead"><button id="winClose">x</button></div>
		<input id="filter" class="login" placeholder="Nachnamen eingeben ..." /><br>
		<table border="0" width="100%" style="border-collapse:collapse;">
		<tr style="background:#ddd;"><th align="left">Nachname</th><th align="left">Vorname</th><th align="left">E-Mail</th><th></th></tr>';
		echo '<tbody id="userlist"></tbody>';
		echo '</table></div>
		<script>
		filter();
		
		$(\'#winClose\').click(function(){
			$(\'#range\').remove();
		});
		
		$(\'#mhead\').mousedown(function(){
			$(\'#readWindow\').draggable({disabled:false});
		}).mouseup(function(){
			$(\'#readWindow\').draggable({disabled:true});
		});
		
		$(\'#filter\').keyup(filter);
		
		function filter(){
			$.ajax({
				url: \'class/course.class.php?a=filter&filter=\' + $(\'#filter\').val(),
				method: \'GET\'
			}).done(function(result){
				$(\'#userlist\').html(result);
			});
		}
		
		</script></span>
		';

	}
}

if($_GET['a'] == 'removeuser') {
	@mysql_query("UPDATE `et_user` SET `course` = '0' WHERE `id` = '{$_POST['id']}'");
}

if($_GET['a'] == 'filter') {
	$erg = @mysql_query("SELECT * FROM `et_user` WHERE `last_name` LIKE '%{$_GET['filter']}%' AND `course`!= '{$_SESSION['et_course']}' ORDER BY `last_name` ASC");
	while($data = @mysql_fetch_row($erg)) {
		echo '<tr><td>'.$data[7].'</td><td>'.$data[6].'</td><td>'.$data[3].'</td><td><img src="img/contact-new.png" height="20" class="pushuser" id="'.$data[0].'" /></td></tr>';
	}
	/*$erg = @mysql_query("SELECT * FROM `et_user` WHERE `first_name` = '%{$_GET['filter']}%' ORDER BY `last_name` ASC");
	while($data = @mysql_fetch_row($erg)) {
		echo '<tr><td>'.$data[7].'</td><td>'.$data[6].'</td><td>'.$data[3].'</td></tr>';
	}*/
	echo '<script>
	$(\'.pushuser\').click(function(e){
		var target = !e.toElement ? e.target.id : e.toElement.id;
		$.ajax({
			url: \'class/course.class.php?a=pushuser\',
			method: \'POST\',
			data: {id: target}
		}).done(function(result){
			console.log(result);
		});
	});
	</script>';
}

if($_GET['a'] == 'pushuser') {
	@mysql_query("UPDATE `et_user` SET `course` = '{$_SESSION['et_course']}' WHERE `id` = '{$_POST['id']}'");
	echo 'User pushed!';
}

if($_GET['a'] == 'presence') {
	$mdays = array('31','28','31','30','31','30','31','31','30','31','30','31');
	if($_GET['presence'] == 'now') {
		echo '<tr style="background:#ddd;"><th align="left">Benutzer</th><th align="left">Anwesend</th></tr>';
		$erg = @mysql_query("SELECT * FROM `et_user` WHERE `course` = '{$_SESSION['et_course']}' AND `id` != '{$_SESSION['et_uid']}' ORDER BY `last_name` ASC");
		while($data = @mysql_fetch_row($erg)) {
			$anz = @mysql_num_rows(mysql_query("SELECT * FROM `et_presence` WHERE `uid` = '{$data[0]}' AND `year` = '".date("Y")."' AND `month` ='".date("m")."' AND `day` = '".date("d")."'"));
			if($anz == 1) {
				echo '<tr><td>'.utf8_encode($data[7]).', '.$data[6].'</td><td><img src="img/package-installed-updated.png" height="20"></td></tr>';
			} else {
				echo '<tr><td>'.utf8_encode($data[7]).', '.$data[6].'</td><td><img src="img/gtk-missing-image.png" height="20"></td></tr>';
			}
		}
	}
	if($_GET['presence'] == 'month') {
		$month = $_GET['month'];
		$year = $_GET['year'];
		//echo $month;
		echo '<tr style="background:#ddd;"><th align="left">Benutzer</th>';
		$days = $month == "1" && ($year % 4) == 0 ? 29 : $mdays[$month];
		for($i = 0; $i < $days; $i++) {
			echo '<th align="left">'.($i+1).'</th>';
		}
		echo '</tr>';
		$erg = @mysql_query("SELECT * FROM `et_user` WHERE `course` = '{$_SESSION['et_course']}' AND `id` != '{$_SESSION['et_uid']}' ORDER BY `last_name` ASC");
		while($data = @mysql_fetch_row($erg)) {
			echo '<tr><td><small>'.utf8_encode($data[7]).', '.$data[6].'</small></td>';
			for($i = 0; $i < $days; $i++) {
				$d = $i+1;
				$d = $d < 10 ? '0'.$d : $d;
				$anz = @mysql_num_rows(mysql_query("SELECT * FROM `et_presence` WHERE `uid` = '{$data[0]}' AND `year` = '".$year."' AND `month` ='".$month."' AND `day` = '".$d."'"));
				if($anz == 1) {
					echo '<td style="border:1px solid #333;"><img src="img/package-installed-updated.png" height="20"></td>';
				} else {
					echo '<td style="border:1px solid #333;"><img src="img/gtk-missing-image.png" height="20"></td>';
				}
			}
			echo '</tr>';
		}
	}
}



@mysql_close($db);
?>