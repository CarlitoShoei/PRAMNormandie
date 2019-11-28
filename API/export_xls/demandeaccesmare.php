<div id="textafficahge">
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<h3>Demande d'accès aux données mare</h3>
	<p>
		Grâce à cette interface, vous pouvez effectuer une demande d'accès aux données mares.</br>
		Dans un premier temps, remplir le formulaire et dans un second temps cartographier sur la carte le secteur au sein duquel vous souhaitez avoir accès aux données.</br>
		Pour toutes informations complémentaires, l'équipe du PRAM se tient à votre disposition. <a href="http://pramnormandie.com/contacts-pram-normandie.php" target="_bank">Contactez-nous</a>.
	</p>
	<div id="resultat">
		<h3>1 - Formulaire de contact</h3>
		<table width="100%" border="0">
			<tr>
				<th width="30%">Structure : </th>
				<td align="center" colspan="3"><input style="width:90%" type="text" id="STRUCTURE" value="" tabindex="1"  onBlur="verifchampVide(this)"></td>
			</tr>
			<tr>
				<th width="30%">Nom et prénom : </th>
				<td align="center" colspan="3"><input style="width:90%" type="text" id="PERSONNE" value="" tabindex="2"  onBlur="verifchampVide(this)"></td>
			</tr>
			<tr>
				<th width="30%">Email : </th>
				<td align="center" colspan="3"><input style="width:90%" type="text" id="EMAIL" value="" tabindex="3"  onBlur="verifchampVide(this)"></td>
			</tr>
			<tr>
				<th width="30%">Context et objectifs de la demande : </th>
				<td align="center" colspan="3"><textarea style="width:90%;" rows="5" Title="Objectif et but de la demande" id="OBJECTIF" tabindex="4"  onBlur="verifchampVide(this)"></textarea></td>
			</tr>
			<tr>
				<th width="30%">Type de données dont vous souhaitez l'accès : </th>
				<td align="center">
					<input type="checkbox" class="Caract" name="CheckDonnees" id="Localisation" value="oui" checked alt="Masquer"  tabindex="5"><font size="2">Localisation</font>
				</td>
				<td align="center">
					<input type="checkbox" class="Caract" name="CheckDonnees" id="Caracterisation" value="oui" alt="Masquer"  tabindex="5"><font size="2">Caractérisation</font>
				</td>
				<td align="center">
					<input type="checkbox" class="Caract" name="CheckDonnees" id="Observations" value="oui" alt="Masquer"  tabindex="5"><font size="2">Observations faune/flore</font>
				</td>
			</tr>
		</table>	
		<h3>2 - Cartographier le secteur concerné par la demande</h3>
		<table width="95%" border="0" align="center">
			<tr>
				<td align="center" height="600px" width="100%">
					<iframe id="leaflet" src="export_xls/carto_leaflet.php" width="100%" height="95%" frameborder="0"></iframe>
				</td>
			</tr>
			<tr style="display:none">
				<td align="center" width="100%">
					<textarea id="geojson" value="" cols="50"></textarea>
				</td>
			</tr>
		</table>
	</div>
</div>
<div id="piedaffichage">
	<table align="center" width="100%" border="0">
		<tr>
			<td width="100%">
				<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<input width="90" type="image" onclick="verifformdemandeaccess('mare/error.php', 'erreur', '');" src="../img/envoyer.png" Title="Envoyer la demande">
							</td>
							<!--<td width="30" align="center">
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>-->
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
	<br/>
</div>

