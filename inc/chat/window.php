<div id="chatWindow">
	<div id="chat_head">
    	<span id="chat_title">Chatroom</span>
    	<button id="winClose">x</button>
    </div>
    
    <div id="chat_top">
    <button id="whois">Online?</button>
    <button id="whisper" title="Oder im Ausgabefenster auf den Namen klicken">Flüstern</button>
    <select id="channel" size="1">
    	<option value="Lobby">Lobby</option>
        <option value="Backstage">Backstage</option>
        <?php
		@session_start();
		@include('../../sys/config.php');
		$db = @mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']);
		@mysql_select_db($config['db_name']);
		$data = @mysql_fetch_row(mysql_query("SELECT * FROM `et_course` WHERE `id` = '{$_SESSION['et_course']}'"));
		echo '<option value="'.$data[2].'">'.$data[2].'</option>';
		@mysql_close($db);

		if($_SESSION['et_lvl'] >= "4") {
			echo '<option value="Kaffeküche">Kaffeküche</option>';
		}
		?>
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
	
	$('#whisper').click(function(){
		$('#text_input').val('/w ');
	});
	
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
			$('#chat_output').scrollTop($('#chat_output')[0].scrollHeight);
			//console.log($('#chat_output')[0].scrollHeight);
		});
	},5000);
</script>