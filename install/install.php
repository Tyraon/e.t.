<?php
if(@$_GET['a'] == "1") {
$dsatz = "<?php
\$config=array(
'db_host' => '".$_POST['dbhost']."',
'db_user' => '".$_POST['dbuser']."',
'db_pass' => '".$_POST['dbpass']."',
'db_name' => '".$_POST['dbname']."',
'page_title' => '".$_POST['page_title']."',
'chatbot' => 'Wächter',
'blacklist' => array('arsch','sex','fick','nutte','hure','fotze','cs','penis'),
'log' => '2',
'register' => '1'

);


?>";
$file = '../sys/config.php';
$fp = @fopen($file,'w');
@fwrite($fp,$dsatz);
@fclose($fp);	
$sql = 'sql/et.sql';
$db = @mysql_connect($_POST['dbhost'],$_POST['dbuser'],$_POST['dbpass']) OR DIE("Verbindung nicht aufgebaut!");
@mysql_select_db($_POST['dbname']) OR DIE("Datenbank nicht gefunden!");
//$file = 'et.sql';
$fp = fopen($sql,"r");
$input = fread($fp,filesize($sql));
fclose($fp);
//echo fstat('install.php');
$cmds = explode(';', $input); 
foreach($cmds as $cmd){ 
    mysql_query($cmd) || die("Error: " . mysql_error() . "<br />Cmd: ".$cmd."<br />"); 
}  
$pass=sha1(strtoupper($_POST['admuser']).':'.strtoupper($_POST['admpass']));
@mysql_close($db);
echo '<script>location.replace("../index.php");</script>';
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link type="text/css" rel="stylesheet" href="../inc/style/main.css" />
<title>Install @ E.T.</title>
</head>

<body>
<div id="dashboard">
<center>
<h3>Installation</h3>
<form action="install.php?a=1" method="post">
<table border="0">
	<tr>
    	<td>Name der Seite: </td>
        <td><input name="page_title" class="login" /></td>
    </tr>
    <tr>
    	<td colspan="2"><b>Datenbank</b><hr></td>
    </tr>
    <tr>
    	<td>Host: </td><td><input name="dbhost" class="login" /></td>
    </tr>
    <tr>
    	<td>Benutzer: </td><td><input name="dbuser" class="login" /></td>
    </tr>
    <tr>
    	<td>Passwort: </td><td><input name="dbpass" class="login" /></td>
    </tr>
    <tr>
    	<td>Datenbank: </td><td><input name="dbname" class="login" /></td>
    </tr>
<!--    <tr>
    	<td colspan="2"><b>Administrator</b><hr></td>
    </tr>
    <tr>
    	<td>Benutzername: </td><td><input name="admuser" class="login" /></td>
    </tr>
    <tr>
    	<td>Passwort: </td><td><input name="admpass" class="login" /></td>
    </tr>
    <tr>
    	<td>E-Mail: </td><td><input name="admemail" class="login" /></td>
    </tr>-->
    <tr>
    	<td colspan="2">Die Anmeldedaten für den Administrator lauten:<br>Benutzer: <i>Admin</i><br>Passwort: <i>admin</i></td>
    </tr>
    <tr>
    	<td colspan="2" align="right"><button type="submit" id="inst" class="login" onClick="install();">Installieren</button></td>
    </tr>
</table>
</form>
</center>
</div>
<script>
function install(){
	$('#inst').html('<img src="47.gif" />');
}
</script>
</body>
</html>