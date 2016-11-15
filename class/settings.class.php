<?php
@session_start();
@include('../sys/config.php');

$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) OR DIE("Verbindung konnte nicht aufgebaut werden");
@mysql_select_db($config['db_name']) OR DIE("Datenbank nicht gefunden!");

if($_GET['a'] == 'rl') {
	switch($config['log']) {
		case "0":
		$log = 'Kein Logging';
		break;
		case "1":
		$log = 'Datenbank';
		break;
		case "2":
		$log = 'Logfile';
		break;
	}

	switch($config['register']) {
		case "0":
		$reg = 'Nicht erlauben';
		break;
		case "1":
		$reg = 'erlauben';
		break;
	}
	$blacklist = '';
	for($i = 0; $i < count($config['blacklist']); $i++) {
		$blacklist .= $config['blacklist'][$i].',';
	}
	echo '<table border="0"><tr><td>Name der Seite: </td><td><input id="page_title" value="'.$config['page_title'].'" class="login" /></td><tr>
	<tr><td>Name des Chatbot: </td><td><input id="chatbot" value="'.$config['chatbot'].'" class="login" /></td></tr>
	<tr><td>Blacklist vom Chat: </td><td><input id="blacklist" value="'.substr($blacklist,0,(strlen($blacklist)-1)).'" class="login" /></td></tr>
	<tr><td>Logging: </td><td><select id="log" size="1" class="login">
	<option value="'.$config['log'].'">'.$log.'</option>
	<option value="0">Kein Logging</option>
	<option value="1">Datenbank</option>
	<option value="2">Logfile</option>
	</select></td></tr>
	<tr><td>Registration: </td><td><select id="register" size="1" class="login">
	<option value="'.$config['register'].'">'.$reg.'</option>
	<option value="0">Nicht erlauben</option>
	<option value="1">erlauben</option>
	</select></td></tr>
	<tr><td colspan="2" align="right"><button id="save" class="login">Speichern</button></td></tr></table>
	<script>
		$(\'#save\').click(function(){
			$.ajax({
				url: \'class/settings.class.php?a=upd\',
				method: \'POST\',
				data: {page_title: $(\'#page_title\').val(),chatbot: $(\'#chatbot\').val(),blacklist: $(\'#blacklist\').val(),log:$(\'#log option:selected\').val(),register:$(\'#register option:selected\').val()}
			}).done(function(result){
				console.log(result);
				location.reload();
			});
		});
	</script>';
}

if($_GET['a'] == 'upd') {
	$blacklist = @explode(",",$_POST['blacklist']);
	$bl = 'array(';
	for($i = 0; $i < count($blacklist); $i++) {
		$bl .= "'".$blacklist[$i]."',";
	}
	$bl = substr($bl,0,(strlen($bl)-1));
	$bl .= ')';

	$dsatz = "<?php
\$config=array(
'db_host' => 'localhost',
'db_user' => 'root',
'db_pass' => '',
'db_name' => 'et',
'page_title' => '".$_POST['page_title']."',
'chatbot' => '".$_POST['chatbot']."',
'blacklist' => ".$bl.",
'log' => '".$_POST['log']."',
'register' => '".$_POST['register']."'

);


?>";
	//$dsatz = "1";
	$file = '../sys/config.php';
	if($fp = @fopen($file,'w')) {echo 'open => ';
	if(@fwrite($fp,$dsatz)) {echo 'write => ';
	if(@fclose($fp)) {echo 'close => ';
	echo 'saved';}else{ echo 'NOT saved';}}else{ echo 'NOT write => ';}}else{ echo 'NOT open => ';}
}


@mysql_close($db);
?>