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
$sql = 'source et.sql';
@mysql_query($sql);
$pass=sha1(strtoupper($_POST['admuser']).':'.strtoupper($_POST['admpass']));
@mysql_query("INSERT INTO `et_user` VALUES('','{$_POST['admuser']}','".$pass."','{$_POST['email']}','5','0000-00-00 00:00:00','-','-','0')");
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <tr>
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
    </tr>
    <tr>
    	<td colspan="2" align="right"><input type="submit" class="login" value="Installieren" /></td>
    </tr>
</table>
</form>
</center>
</div>
</body>
</html>