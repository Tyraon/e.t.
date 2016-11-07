<div class="content">
    <div class="dtitle">
    Willkommen <?= $_SESSION['et_user'];?>
    </div>
    <br>
    <div id="dashboard">
        <table border="0" class="ditem" id="profile"><tr><td id="profile">
        <img src="img/-profile-edit-account-edit-profile-edit-user-sign-icon--icon-32.png" height="40" id="profile" /></td></tr>
        <tr><td id="profile">Profil
        </td></tr></table>
        <table border="0" class="ditem" id="mail"><tr><td id="mail">
        <img src="img/enquiry-icon-png-2.png" height="40" id="mail" /></td></tr>
        <tr><td id="mail">Nachrichten
        </td></tr></table>
        <table border="0" class="ditem"><tr><td id="chat">
        <img src="img/help-faq.png" height="40" id="chat" /></td></tr>
        <tr><td id="chat">Chat
        </td></tr></table>
        <table border="0" class="ditem" style="opacity: 0.5;" title="Funktion noch nicht aktiv!"><tr><td>
        <img src="img/checklist-icon--e-commerce-iconset--ebiene-11.png" height="40" /></td></tr>
        <tr><td>Tests
        </td></tr></table>
		<table border="0" class="ditem" style="opacity: 0.5;" title="Funktion noch nicht aktiv!"><tr><td>
        <img src="img/default-document-2.png" height="40" /></td></tr>
        <tr><td>Artikel
        </td></tr></table>
		<table border="0" class="ditem" id="presence" style="opacity: 0.5;" title="Funktion noch nicht aktiv!"><tr><td id="presence">
        <img src="img/preferences-calendar-and-tasks.png" height="40" id="chat" /></td></tr>
        <tr><td id="presence">Anwesend
        </td></tr></table>
        <table border="0" class="ditem" style="opacity: 0.5;" title="Funktion noch nicht aktiv!"><tr><td>
        <img src="img/settings-icon-25.png" height="40" /></td></tr>
        <tr><td>Einstellung
        </td></tr></table>
        <?php
		if($_SESSION['et_lvl'] >= "4") {
		?>        
        <table border="0" class="ditem" id="course"><tr><td id="course">
        <img src="img/config-users.png" height="40" id="course" /></td></tr>
        <tr><td id="course">Kurs/Klasse
        </td></tr></table>
			
        <?php
		}
		if($_SESSION['et_lvl'] == "5") {
		?>
        <table border="0" class="ditem" id="manage" style="opacity: 0.5;" title="Funktion noch nicht aktiv!"><tr><td id="manage">
        <img src="img/preferences-contact-list.png" height="40" id="manage" /></td></tr>
        <tr><td id="manage">Benutzer
        </td></tr></table>

        <?php
		}
		?>
    </div>
</div>