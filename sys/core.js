$(document).ready(function(){
	/*$('body').click(function(){
		$('#umenu').remove();
	});*/
	
	$('#menu').click(function(){
		var newMenu = '<div id="umenu"><span onclick="location.replace(\'index.php\');">Dashboard</span><br><span onclick="location.replace(\'sys/logout.php\');">Abmelden</span></div>';
		$('body').append(newMenu);
	});
	
	$('.ditem').click(function(e){
		if(!e.toElement){
			var target = e.target.id;
		}else{
			var target = e.toElement.id;
		}
		console.log(target);
		location.replace('index.php?page=' + target);
	});
});