<div class="content">
<button id="openchat">Open Chat</button>
</div>
<script>
	$('#openchat').click(function(){
		openChat();
	});
	function openChat(channel){
		$.ajax({
			url: 'inc/chat/window.php?channel=channel',
			method: 'GET'
		}).done(function(result){
			$('body').append(result);
		});
	}
</script>