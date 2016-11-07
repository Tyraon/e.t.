<?php

if(!$_SESSION['et_uid']) {
	switch($_GET['page']) {
		default:
		@include('sys/login.php');
		break;
	}	
} else {
	@include('inc/menu.php');
	switch($_GET['page']) {
		default:
		@include('inc/dashboard.php');
		break;
		case "profile":
		@include('inc/profile.php');
		break;
		case "settings":
		@include('inc/settings.php');
		break;
		case "mail":
		@include('inc/mail.php');
		break;
		case "chat":
		@include('inc/chat.php');
		break;
		case "course":
		@include('inc/course.php');
		break;
		case "manage":
		@include('inc/manage.php');
		break;
		case "presence":
		@include('inc/presence.php');
		break;
	}
}

?>