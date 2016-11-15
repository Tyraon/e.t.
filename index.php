<?php
@include('sys/cfg.php');
@include('sys/config.php');
?>

<html>
<head>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="sys/core.js"></script>
    <link type="text/css" rel="stylesheet" href="inc/style/main.css" />
    <title><?= $config['page_title'];?> @ E.T.</title>
</head>

<body>
<?php
@include('inc/style/header.php');
@include('inc/announce.php');
@include('inc/route.php');
?>


<?php
@include('inc/style/footer.php');
?>
</body>
</html>