<div class="content">
	<div id="dashboard">
    	<table border="0" id="mboxheader" style="background:#ccc; border:1px inset #aaa;">
        <tr>
        <td><img src="img/stock_mail-import.png" height="40" class="mailnav" id="inbox" /></td>
        <td><img src="img/mail-outbox.png" height="40" class="mailnav" id="outbox" /></td>
        <td><img src="img/emblem-draft.png" height="40" class="mailnav" id="newmail" /></td>
        <td><!--<img src="img/mac-trashcan_full-new.png" height="40" class="mailnav" id="inbox" />--></td>
        </tr>
        </table>
    	<table border="0" id="mailbox" cellpadding="3px" style="width:100%; border-collapse:collapse;">
        <tr id="thead" style="borde:1px solid #999;"></tr>
        <tbody id="mails"></tbody>
        </table>
    </div>
</div>
<script>
	$('.mailnav').click(function(e){
		var aktion = !e.toElement ? e.target.id : e.toElement.id;
		if(aktion == "newmail"){
			writeMail();
		}else{
			listMail(aktion);
		}
	});
	
	listMail('inbox');
	function listMail(aktion){
		switch(aktion){
			default:
			var header = '<th class="mboxhead">Betreff</th><th class="mboxhead">Absender</th><th class="mboxhead">Datum</th><th class="mboxhead">Aktion</th>';
			break;
			case "outbox":
			var header = '<th class="mboxhead">Betreff</th><th class="mboxhead">Empf&auml;nger</th><th class="mboxhead">Datum</th><th class="mboxhead">Aktion</th>';
			break;
		}
			$('#thead').html(header);
		
		$('#mails').remove();
		$.ajax({
			url: 'class/mail.class.php?a=' + aktion + '&user=<?= $_SESSION['et_user'];?>',
			method: 'GET'
		}).done(function(result){
			$('#mailbox').append('<tbody id="mails">' + result + '</tbody>');
			$('.mlist').click(function(e){
				var mailId = !e.toElement ? e.target.id : e.toElement.id;
				readMail(mailId);
				listMail(aktion);
			});
			$('.deleteOutbox').click(function(e){
				var target = !e.toElement ? e.target.id : e.toElement.id;
				deletemail('outbox',target);
			});
			$('.deleteInbox').click(function(e){
				var target = !e.toElement ? e.target.id : e.toElement.id;
				deletemail('inbox',target);
			});
		});
	}
	
	function readMail(idx){
		$('#readWindow').remove();
		$.ajax({
			url: 'class/mail.class.php?a=read&check=<?= $_SESSION['et_user'];?>&mail=' + idx,
			method: 'GET'
		}).done(function(result){
			var readWindow = '<div id="readWindow"><div id="mhead"><button id="winClose">x</button></div>' + result + '</div>';
			$('body').append(readWindow);
			$('#mhead').mousedown(function(){
				$('#readWindow').draggable({disabled:false});
			}).mouseup(function(){
				$('#readWindow').draggable({disabled:true});
			});
			$('#winClose').click(function(){
				$('#readWindow').remove();
			});
			$('#forward').click(function(){
				var newrcp = 'FW: ' + $('#r_rcp').html();
				var message = $('#mailcontent').text();
				writeMail(newrcp,message);
			});
			$('#answer').click(function(){
				var sender = $('#sender').html();
				var newrcp = 'RE: ' + $('#r_rcp').html();
				var message = '\n\n-------------\n' + sender + ' hat geschrieben:\n\n' + $('#mailcontent').text();
				console.log(newrcp,message,sender);
				writeMail(newrcp,message,sender);
			});

		});
	}
	
	function writeMail(rcp,msg,sendto){
		$('#newWindow').remove();
		var newWindow = '<div id="newWindow"><div id="mhead"><button id="newWinClose">x</button></div><div id="mailHeader">Empf&auml;nger: <input name="touser" id="touser" class="login" /><br>Betreff: <input name="rcp" id="rcp" class="login" style="width:600px;" />&nbsp;<img src="img/mail-replied.png" height="20" id="sendmail" class="mhakt" /></div><textarea name="message" id="message" placeholder="Deine Nachricht ..."></textarea></div>';
		$('body').append(newWindow);
		$('#mhead').mousedown(function(){
			$('#newWindow').draggable({disabled:false});
		}).mouseup(function(){
			$('#newWindow').draggable({disabled:true});
		});
		$('#newWinClose').click(function(){
			$('#newWindow').remove();
		});
		if(rcp && msg){
			$('#rcp').val(rcp);
			$('#message').val(msg);
			if(sendto){
				$('#touser').val(sendto);
				$('#touser').attr('readonly',true);
			}
		}
		$('#touser').keyup(function(e){
			var lookingfor = $('#touser').val();
			$.ajax({
				url: 'class/mail.class.php?a=lfu&check=<?= $_SESSION['et_user'];?>&look=' + lookingfor,
				method: 'GET'
			}).done(function(result){
				$('#lfu').remove();
				$('#mailHeader').append(result);
				$('#lfu').css({"top":"40px","left":"80px"});
				$('.selectuser').click(function(e){
					var label = !e.toElement ? e.target.id : e.toElement.id;
					$('#touser').val($('#' + label).html());
					$('#lfu').remove();
				});
			});
		});
		$('#rcp').focus(function(){
			$('#lfu').remove();
		});
		$('#message').focus(function(){
			$('#lfu').remove();
		});
		$('#sendmail').click(sendMail);
	}
	
	function sendMail(){
		$.ajax({
			url: 'class/mail.class.php?a=sendmail',
			method: 'POST',
			data: {from: '<?= $_SESSION['et_user'];?>',
					sendto: $('#touser').val(),
					rcp: $('#rcp').val(),
					message: $('#message').val()}
		}).done(function(result){
			if(result == "sended"){
				$('#newWindow').remove();
			}else{
				$('#mhead').append('<font color="#c00">' + result + '</font>');
			}
		});
	}
	
	function deletemail(box,idx){
		$.ajax({
			url: 'class/mail.class.php?a=delete' + box + '&mail=' + idx,
			method: 'GET'
		}).done(function(result){
			$('#errsucc').remove();
			$('#mboxheader').append('<tr id="errsucc"><td colspan="4"><small>' + result + '</small></td></tr>');
			listMail(box);
		});
	}
</script>