<link rel="stylesheet" href="cenhn_popup.css" type="text/css" />
<link rel="stylesheet" href="calendrier/calendrier.css" type="text/css">
<script src="calendrier/calendrier.js" type="text/javascript"></script>
<script src="js/parametre_popup.js" type="text/javascript"></script>

<?php
	// header( 'content-type: text/html; charset=utf-8' );
	// header('Content-type: text/html; charset=iso8859-1');
	
	//Demare la session
	session_start();
	
	//connection BDD
	include '/../../../bdd.php';
	
?>

<table border="0" width="100%">
	<tr height="30">
		<td>
			<select id="Lecteur" onchange="Fonction_listing('listing.php', 'listing');">
				<option value="../../../img/site/logo">Choix du dossier</option>
				<option value="../../../img/site/logo">Dossier logo partenaire</option>
			</select>
		</td>
		<td width="5"></td>
		<td>
			<img src="img/folder_up.png" width="30" title="Dossier Précédent" onClick="fct_precedent('listing.php', 'listing')"/>
		</td>
	</tr>
	<tr height="5"></tr>
	<tr height="225">
		<td colspan="3">
			<div class="listing" id="listing">
			</div>
		</td>
	</tr>
</table>