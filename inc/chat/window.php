<div id="chatWindow">
	<div id="chat_head">
    	<span id="chat_title">Chatroom</span>
    	<button id="winClose">x</button>
    </div>
    
    <div id="chat_top">
    <button id="whois">Online?</button>
    <select id="channel" size="1">
    	<option value="Lobby">Lobby</option>
        <option value="Backstage">Backstage</option>
    </select>
    </div>
    
    <div id="chat_output">
    </div>
    
    <div id="chat_input">
    <input id="text_input" class="login" style="width:700px; margin-left:5px;" placeholder="Deine Nachricht ..." />
    <button id="senden" type="button">senden</button>
    </div>
</div>

<div id="aktion" style="visibility:hidden;"></div>

<script>
	$('#text_input').focus();

	$('#chat_head').mousedown(function(){
		$('#chatWindow').draggable({disabled:false});
	}).mouseup(function(){
		$('#chatWindow').draggable({disabled:true});
	});
	
	$('#winClose').click(function(){
		$('#chatWindow').remove();
	});
	
	$(document).keydown(function(e){
		if(e.which == 13 && $('#text_input').focus()){
			sendMessage();
		}
	});
	
	$('#whois').click(whoIs);
	
	$('#channel').on('change', function(){
		$.ajax({
			url: 'class/chat.class.php?a=channel&channel=' + $('#channel option:selected').val(),
			mehtod: 'GET'
		}).done(function(result){
			console.log(result);
		});
	});
	
	$('#senden').click(sendMessage);
	
	function sendMessage(){
		$.ajax({
			url: 'class/chat.class.php?a=in',
			method: 'POST',
			data:{message: $('#text_input').val()}
		}).done(function(result){
			$('#text_input').val('');
			$('#text_input').focus();
			//console.log(result);
			$('#aktion').append(result);
		});
	}
	
	function whoIs(){
		$.ajax({
			url: 'class/chat.class.php?a=online',
			method: 'GET'
		}).done(function(result){
			var online = '<div id="onlinelist">' + result + '</div>';
			$('body').append(online);
			$(document).click(function(){
				$('#onlinelist').remove();
			});
		});
	}
	
	setInterval(function(){
		$.ajax({
			url: 'class/chat.class.php?a=out',
			mehtod: 'GET'
		}).done(function(result){
			$('#chat_output').append(result);
		});
	},5000);
</script>