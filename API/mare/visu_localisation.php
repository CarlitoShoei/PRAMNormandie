<?php
	date_default_timezone_set('Europe/Paris');
	// ini_set("display_errors",1);
	include '../../bdd.php';
	$L_ID = $_GET['L_ID'];
	$Session = $_GET['Session'];
	$role = $_GET['role'];
	$id_structure_conectee = $_GET['id_structure_conectee'];
	

	//REQUETE LA MEME POUR TOUS LES ROLES CAR TOUS LE MONDE A ACCES AUX INFORMATION DE LOCALISATION DE MARE
	$mare_localisation = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
										WHERE saisie_observation.localisation."L_STATUT"=menu_deroulant.l_statut."ID"::text
										AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
										AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
										AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
										AND saisie_observation.localisation."L_STRP"::text = saisie_observation.structure."S_ID"::text
										AND saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
										ORDER BY saisie_observation.localisation."L_ID"'); 
	$donnees = pg_fetch_array($mare_localisation);
	
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

?>
<div id="textafficahge_carac_edit">	
<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
<h3>Description de la mare</h3>
	<div id="resultat_carac">
		<table class="description" border="0" width="100%">
			<tr align="left">
				<td width="100%" colspan="3">
					<hr><legend><b>Information de localisation de la mare</b></legend><hr>
				</td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Date d'observation : </th>
				<td width="35%"><?php echo date('d/m/Y', $donnees['L_DATE'])?></td>
				<td width="30%" rowspan="8">
					<iframe id="mapframe" frameborder="0" width="100%" height="250px" src="map_miniature.php?L_ID=<?php echo $L_ID ?>"></iframe>
				</td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Identifiant PRAM : </th>
				<td width="35%"><?php echo $donnees['L_ID']?></td>
				
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Identifiant mare structure : </th>
				<td width="35%"><?php echo $donnees['L_IDSTRP']?></td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Structure : </th>
				<td width="35%"><?php echo $donnees['STRUCTURE']?></td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Observateur : </th>
				<td width="35%"><?php echo $donnees['OBS_NOM_PRENOM']?></td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Nom usuel de la mare : </th>
				<td width="35%"><?php echo $donnees['L_NOM']?></td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Commune : </th>
				<td width="35%"><?php echo $donnees['Nom_Commune']?></td>
				
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Statut de la mare : </th>
				<td width="35%"><?php echo $donnees['STATUT']?></td>
				
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Type de propriété : </th>
				<td width="35%"><?php echo $donnees['PROPR']?></td>
				<td width="30%" rowspan="7">
					<?php 		if($count >= 1){?>
									<iframe width="100%" align="center" frameborder="0" src="mare/photo_localisation_visu.php?l_id=<?php echo $donnees['L_ID'] ?>"></iframe>
					<?php 		}else{ ?>
									<img src="../img/photo/no_picture.jpg" width="100%">
					<?php		} ?>
				</td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Longitude (WGS84) : </th>
				<td width="35%"><?php echo round($donnees['L_COOX'],5)?></td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Latitude (WGS84) : </th>
				<td width="35%"><?php echo round($donnees['L_COOY'],5)?></td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">X (Lambert 93) : </th>
				<td width="35%"><?php echo round($donnees['L_COOX93'],0)?></td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Y (Lambert 93) : </th>
				<td width="35%"><?php echo round($donnees['L_COOY93'],0)?></td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Mode de localisation : </th>
				<td width="35%">
					 <?php 
						if($donnees['L_PREC'] == "1.5"){
							echo "Photo aérienne";
						}elseif($donnees['L_PREC'] == "7.5"){
							echo "Carte IGN SCAN25";
						}elseif($donnees['L_PREC'] == "mesuré"){
							echo "GPS";
						}
					 ?>
				</td>
			</tr>
			<tr>
				<th width="35%" class="ligne_v">Commentaire : </th>
				<td width="35%"><?php echo $donnees['C_COMT']?></td>
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
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</div>