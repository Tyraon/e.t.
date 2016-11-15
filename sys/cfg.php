<?php
@session_start();

if(!file_exists('sys/config.php')) {
	header('Location: install/install.php');
}

$cr='2016 @ Sven K&auml;stel';

?>