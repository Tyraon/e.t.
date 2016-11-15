<div class="content">
    <div id="dashboard">
    	
    </div>
</div>

<script>
	reLoad();
	function reLoad(){
		$.ajax({
			url: 'class/article.class.php?a=rl',
			method: 'GET'
		}).done(function(result){
			$('#dashboard').html(result);
		});
	}
	
	$('#newuser').click(function(){
		$.ajax({
			url: 'class/article.class.php?a=opennew',
			method: 'GET'
		}).done(function(result){
			$('body').append(result);
		});
	});

<?php
if(@$_GET['link'] != '') {
	echo '$.ajax({
			url: \'class/article.class.php?a=article&art='.$_GET['link'].'\',
			method: \'GET\'
	}).done(function(result){
		$(\'#dashboard\').html(result);
	});';
}

?>
</script>
