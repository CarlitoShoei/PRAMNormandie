<?php
	
	//Demare la session
	session_start();
	//connection BDD
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES VARAIBLES
	$L_ID = $_GET['L_ID'];
	$Session = $_GET['Session'];
	$role = $_GET['role'];
	$id_structure_conectee = $_GET['id_structure_conectee'];
	
	//REQUETE POUR ALLER CHERCHER L'IDENDIFIANT DE LA STRUCTURE
	$idstructure = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.structure
										WHERE saisie_observation.structure."S_ID_SESSION"='."'".$id_structure_conectee."'".''); 
	$donnees_idstructure = pg_fetch_array($idstructure);
	
	
	//REQUETE SQL POUR CHERCHER LA MARE EN QUESTION
	$mare_localisation = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
										WHERE saisie_observation.localisation."L_STATUT"=menu_deroulant.l_statut."ID"::text
										AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
										AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
										AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
										AND saisie_observation.localisation."L_STRP"::text = saisie_observation.structure."S_ID"::text
										AND saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
										ORDER BY saisie_observation.localisation."L_ID"'); 
	$donnees_loca = pg_fetch_array($mare_localisation);
	
	//REQUETE POUR VOIR SI IL EXISTE UNE PHOTO OU PAS
	$event_exist = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.localisation_photo
										WHERE saisie_observation.localisation_photo."L_ID"='."'".$L_ID."'".'');
	$count = pg_num_rows($event_exist);
	//SI IL EXISTE UNE PHOTO
	if($count >= 1){
		//REQUETE SQL POUR ALLER CHERCHER LA PHOTO
		$mare_photo = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.localisation_photo
										WHERE saisie_observation.localisation_photo."L_ID"='."'".$L_ID."'".''); 
		$donnees_photo = pg_fetch_array($mare_photo);
	}
	
	$listLien = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.l_lien ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listLien, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listStatut = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.l_statut ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listStatut, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listPropr = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.l_propr ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listPropr, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listAnon = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.l_anon ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listAnon, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
?>

<?php if($role == 'administrateur' OR ($donnees_idstructure['S_ID'] == $donnees_loca['L_STRP'])){ ?>
	<input style="width:90%;display:none" type="text" id="L_ID" value="<?php echo $L_ID ?>">
	<div id="textafficahge_carac_edit">	
		<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
		<h1>Localisation de la mare</h1>
		<p>Après avoir rempli les champs ci-dessous (* données obligatoires), vous pouvez saisir une caractérisation ou des observations faune/flore en cliquant sur la mare.</p>
		<div id="resultat_loca">
			<table border="0" width="100%">
				<tr align="left">
					<td width="100%" colspan="3">
						<hr><legend><b>Information de localisation de la mare</b></legend><hr>
					</td>
				</tr>
				<tr align="center">
					<th width="35%">Date d'observation* : </th>
					<td width="35%"><input style="width:90%" disabled='disabled' type="text" id="L_DATE" value="<?php echo date('d/m/Y',$donnees_loca['L_DATE'])?>" tabindex="1"></td>
					<td width="30%" rowspan="8">
						<iframe id="mapframe" frameborder="0" width="100%" height="250px" src="map_miniature.php?L_ID=<?php echo $L_ID ?>"></iframe>
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Identifiant PRAM de la mare* : </th>
					<td width="35%">
						<input style="width:90%" disabled='disabled' type="text" id="L_ID" value="<?php echo $L_ID ?>" tabindex="2">
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Identifiant donné par votre structure : </th>
					<td width="35%">
						<input style="width:90%" type="text" id="L_IDSTRP" value="<?php echo $donnees_loca['L_IDSTRP']?>" tabindex="3">
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Structure* : </th>
					<td width="35%"><input style="width:90%" disabled='disabled' type="text" id="L_STRP" value="<?php echo $donnees_loca['STRUCTURE']?>" tabindex="4"></td>
				</tr>
				
				<tr align="center">
					<th width="35%">Observateur* : </th>
					<td width="35%"><input style="width:90%" disabled='disabled' type="text" id="L_OBSV" value="<?php echo $donnees_loca['OBS_NOM_PRENOM']?>" tabindex="5"></td>
				</tr>
				
				<tr align="center">
					<th width="35%">Je suis : </th>
					<td width="35%"><?php echo simpleDisplaySelect2($listLien, 'L_LIEN', 'ID', 'LIEN', $donnees_loca['L_LIEN'], 'afficher_masquer("lien","")', 6); ?></td>
				</tr>
				
				<tr align="center">
					<td colspan="2" width="100%">
						<div style="display:none" id="lien_autre">
							<table width="100%">
								<tr align="center"> 
									<th width="35%">Précision autre : </th>
									<td width="35%"><input style="width:90%" type="text" id="L_LIEN_AUTRE" value="<?php echo $donnees_loca['L_LIEN_AUTRE']?>" tabindex="7"></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Nom usuel de la mare : </th>
					<td width="35%"><input style="width:90%" type="text" id="L_NOM" value="<?php echo $donnees_loca['L_NOM']?>" tabindex="8"></td>
				</tr>
				
				<tr align="center">
					<th width="35%">Commune* : </th>
					<td width="35%">
						<input style="width:90%" disabled='disabled' type="text" id="L_ADMIN" value="<?php echo $donnees_loca['Nom_Commune']?>" tabindex="9">
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Statut de la mare* : </th>
					<td width="35%"><?php echo simpleDisplaySelect2OnBlur($listStatut, 'L_STATUT', 'ID', 'STATUT', $donnees_loca['L_STATUT'], '', 10, 'AjaxMare("mare/enregmare.php", "erreur", "changer_statut")'); ?></td>
					
				</tr>
				
				<tr align="center">
					<th width="35%">Type de propriété* : </th>
					<td width="35%"><?php echo simpleDisplaySelect2OnBlur($listPropr, 'L_PROPR', 'ID', 'PROPR', $donnees_loca['L_PROP'], '', 11, 'verifchampSelect(this)'); ?></td>
					<td width="30%" rowspan="7">
						<?php 		if($count >= 1){?>
										<iframe width="100%" align="center" frameborder="0" src="mare/photo_localisation_visu.php?l_id=<?php echo $L_ID ?>"></iframe>
						<?php 		}else{ ?>
										<img src="../img/photo/no_picture.jpg" width="100%">
						<?php		} ?>
						
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Longitude (WGS84) : </th>
					<td width="35%">
						<input style="width:90%" disabled='disabled' type="text" id="L_COOX" value="<?php echo $donnees_loca['L_COOX']?>" tabindex="12">
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Latitude (WGS84) : </th>
					<td width="35%">
						<input style="width:90%" disabled='disabled' type="text" id="L_COOY" value="<?php echo $donnees_loca['L_COOY']?>" tabindex="13">
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">X (Lambert 93)* : </th>
					<td width="35%">
						<input style="width:90%" disabled='disabled' type="text" id="L_COOX93" value="<?php echo $donnees_loca['L_COOX93']?>" tabindex="14">
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Y (Lambert 93)* : </th>
					<td width="35%">
						<input style="width:90%" disabled='disabled' type="text" id="L_COOY93" value="<?php echo $donnees_loca['L_COOY93']?>" tabindex="15">
					</td>
				</tr>
				<tr align="center">
					<th width="35%">Mode de localisation : </th>
					<td width="35%">
						<input style="width:90%" disabled='disabled' type="text" id="L_PREC" value="<?php echo $donnees_loca['L_PREC']?>" tabindex="16">
					</td>
				</tr>
				
				<tr align="center">
					<th width="35%">Anonymiser la mare : </th>
					<td width="35%"><?php echo simpleDisplaySelect2($listAnon, 'L_ANON', 'ID', 'ANON', $donnees_loca['L_ANON'], '', 17); ?></td>
				</tr>
				
				<tr align="center">
					<th width="35%">Commentaire : </th>
					<td width="35%"><textarea style="width:90%;" rows="5" Title="Commentaire" id="C_COMT" tabindex="15"><?php echo $donnees_loca['C_COMT']?></textarea></td>
				</tr>
			</table>
		</div>
	</div>
	<div id="piedaffichage">
	<table align="center" width="100%" border="0">
		<tr>
			<td>
				<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<input width="30" type="image" onclick="verifLocalisationMod('mare/error.php', 'erreur', '');actualiseMareAfterMod()" src="../img/enreg.png" Title="Enregistrer">
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
</div>
<?php }else{ ?>
<input style="width:90%;display:none" type="text" id="L_ID" value="<?php echo $L_ID ?>">
<div id="textafficahge_carac_edit">	
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<h1>Localisation de la mare</h1>
	<div id="resultat_loca">
		<p>
		Les droits qui vous ont été affectés ne vous permettent pas de modifier les informations de localisation de cette mare.
		Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a>
		</p>
	</div>
</div>
<div id="piedaffichage">
	<table align="center" width="100%" border="0">
		<tr>
			<td>
				<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</div>
<?php } ?>
