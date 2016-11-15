<?php
if($_SESSION['et_lvl'] == "5") {
?>
<div class="content">
    <div id="dashboard">
    	
    </div>
</div>

<script>
	reLoad();
	function reLoad(){
		$.ajax({
			url: 'class/newcourse.class.php?a=rl',
			method: 'GET'
		}).done(function(result){
			$('#dashboard').html(result);
		});
	}
	
	$('#newuser').click(function(){
		$.ajax({
			url: 'class/newcourse.class.php?a=opennew',
			method: 'GET'
		}).done(function(result){
			$('body').append(result);
		});
	});
</script>
<?php
}
?>