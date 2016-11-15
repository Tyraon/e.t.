<div class="content" style="text-align:center;">
<span style="display:block;">Bitte achte auf einen freundlichen Umgang mit den anderen Nutzern.</span><br />
<button id="openchat" style="border-radius:7px;"><img src="img/help-faq.png" height="40"  /><br />Open Chat</button>
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