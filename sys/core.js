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

	$('#default_logo').click(function(){
		location.replace('index.php');
	});
	
	$('.ann_close').click(function(e){
		var target = !e.toElement ? e.target.id : e.toElement.id;
		$.ajax({
			url: 'class/main.class.php?a=annread&ann=' + target,
			method: 'GET'
		}).done(function(result){
			$('#ann_' + target).remove();
		});
	});
});