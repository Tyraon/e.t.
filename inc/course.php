<?php
if($_SESSION['et_lvl'] >="4") {
?>
<div class="content">
    <div id="dashboard">
    	
    </div>
</div>

<script>
	reLoad();
	function reLoad(){
		$.ajax({
			url: 'class/course.class.php?a=rl',
			method: 'GET'
		}).done(function(result){
			$('#dashboard').html(result);
		});
	}
	
	$('#newuser').click(function(){
		$.ajax({
			url: 'class/course.class.php?a=opennew',
			method: 'GET'
		}).done(function(result){
			$('body').append(result);
		});
	});
</script>
<?php
}
?>