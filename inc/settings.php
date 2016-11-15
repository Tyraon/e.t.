<div class="content">
	<div id="dashboard">
		
    	</div>
</div>

<script>
reLoad();

function reLoad(){
	$.ajax({
		url: 'class/settings.class.php?a=rl',
		method: 'GET'
	}).done(function(result){
		$('#dashboard').html(result);
	});
}
</script>