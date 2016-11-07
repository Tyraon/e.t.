<?php
if($_SESSION['et_lvl'] =="5") {
?>
<div class="content">
	<img src="img/emblem-draft.png" height="40" id="newuser" /><br />
	<table border="0" class="manage" style="border:1px outset #999;border-collapse: collapse;border-radius: 3px;box-shadow: 0px 0px 10px 0px #333;">
    	<tr style="background:#ddd;">
        	<th>Username</th>
            <th>E-Mail</th>
            <th>Level</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>LastLogin</th>
            <th></th>
        </tr>
        <tbody id="userlist">
        </tbody>
    </table>
</div>

<script>
	reLoad();
	function reLoad(){
		$.ajax({
			url: 'class/manage.class.php?a=rl',
			method: 'GET'
		}).done(function(result){
			$('#userlist').html(result);
		});
	}
	
	$('#newuser').click(function(){
		$.ajax({
			url: 'class/manage.class.php?a=opennew',
			method: 'GET'
		}).done(function(result){
			$('body').append(result);
		});
	});
</script>
<?php
}
?>