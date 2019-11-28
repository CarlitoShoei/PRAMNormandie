<?php
	ini_set("display_errors",1);
	error_reporting(E_ALL ^ E_DEPRECATED);
	
	//Demare la session
	session_start();
	//connection BDD
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES VARAIBLE
	// $Commune = mb_strtoupper($_GET['Commune'], 'UTF-8');
	$Longitude = $_GET['Longitude'];
	$Latitude = $_GET['Latitude'];
	$Commune = $_GET['Commune'];
	$STRUCTURE_SESSION = $_GET['STRUCTURE_SESSION'];
	if(isset($_GET['Type'])){
		$Type = $_GET['Type'];
	}else{
		$Type = "Carto";
	}
	//REQUETE POUR REGARDER SI IL Y A UNE AUTRE MARE DANS LES 50m A LA RONDE
	$req_verif_doublon = pg_query($bdd, 'SELECT "L_ID", st_distance(st_transform(st_setsrid(st_makepoint('."'".$Longitude."'".','."'".$Latitude."'".'),4326),2154),st_transform(geom,2154)) as distance
										FROM saisie_observation.localisation 
										WHERE "L_ADMIN" = '."'".$Commune."'".'
										ORDER BY distance
										LIMIT 1'); 
	$donnees_verif_doublon = pg_fetch_array($req_verif_doublon);
	
	
	
	//REQUETE POUR REGARDER SI LE POINT SAISIE EST DANS LE CONTOUR DE LA COMMUNE CHOISIE
	//DONC REQUETE POUR SAVOIR QUELLE COMMUEN OU LE POINT EST
	$req_verif_commune = pg_query($bdd, 'SELECT * FROM ign_bd_topo.commune WHERE st_intersects(st_setsrid(st_transform(geom,4326),4326),st_setsrid(st_makepoint('."'".$Longitude."'".','."'".$Latitude."'".'),4326))ORDER BY "Nom_Commune"'); 
	$donnees_verif_commune = pg_fetch_array($req_verif_commune);
	
	if($Commune == $donnees_verif_commune['Num_INSEE']){
		///Requete sur la base utilisateur pour connaitre le pr�nom de l'utilisateur
		$req_aut = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION" ='."'".$_SESSION['Identifiant']."'".'');
		$donnees_aut = pg_fetch_array($req_aut);

		//FAUT RECUPERER LA LISTE AVEC TOUS LES SALARIES, MAIS UNE SEULE FOIS :)
		$listStructure = array();
		$req = pg_query($bdd, 'SELECT * FROM saisie_observation.structure ORDER BY "STRUCTURE"'); 
		while($donnees = pg_fetch_array($req))
		{
			array_push($listStructure, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
		}
		
		$listObs = array();
		$req = pg_query($bdd, 'SELECT * FROM saisie_observation.observateur, saisie_observation.structure WHERE structure."STRUCTURE" = observateur."OBS_STRUCTURE" AND structure."S_ID_SESSION"=E'."'".utf8_decode(addslashes($_SESSION['Identifiant']))."'".' ORDER BY "ID"'); 
		while($donnees = pg_fetch_array($req))
		{
			array_push($listObs, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
		}
		
		$listLien = array();
		$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.l_lien ORDER BY "ID"'); 
		while($donnees = pg_fetch_array($req))
		{
			array_push($listLien, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
		}
		
		$listComm = array();
		$req = pg_query($bdd, 'SELECT * FROM ign_bd_topo.commune WHERE st_intersects(st_setsrid(st_transform(geom,4326),4326),st_setsrid(st_makepoint('."'".$Longitude."'".','."'".$Latitude."'".'),4326)) AND "Num_Dep" = '."'".substr($Commune, 0, -3)."'".' ORDER BY "Nom_Commune"'); 
		// $req = pg_query($bdd, 'SELECT * FROM ign_bd_topo.commune ORDER BY "Nom_Commune"'); 
		while($donnees = pg_fetch_array($req))
		{
			array_push($listComm, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
		}				
		
		
		$listStatut = array();
		$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.l_statut WHERE "ID" <> 4  ORDER BY "ID"'); 
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
		
		$listPrec = array();
		$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.l_prec ORDER BY "ID"'); 
		while($donnees = pg_fetch_array($req))
		{
			array_push($listPrec, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
		}
		
		$listAnon = array();
		$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.l_anon ORDER BY "ID"'); 
		while($donnees = pg_fetch_array($req))
		{
			array_push($listAnon, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
		}
		
		//Appelle la fonction pour cr�er la mare et un identifiant pour l'appeller par la suite
		$ID = createMare($bdd);
	}
?>
<body>
	<?php if($Commune == $donnees_verif_commune['Num_INSEE']){ ?>
	<div id="textafficahge_carac_edit">
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<input style="width:100%;display:none" type="text" id="ID_Mare" value="<?php if(isset($ID_Consultation)){echo $ID_Consultation;}else{ echo $ID; }?>">
	<input style="width:100%;display:none" type="text" id="Type" value="<?php echo $Type; ?>">
	<h1><b>DONNEES GENERALES DE LOCALISATION</b></h1>
	<p>Après avoir rempli les champs ci-dessous (* données obligatoires), vous pouvez saisir une caractérisation ou des observations faune/flore en cliquant sur la mare.</p>
	<div id="resultat_loca">
	<?php if($donnees_verif_doublon['distance'] <= 50 && isset($donnees_verif_doublon['distance'])){ ?>
		<p style="color:red"><b>ATTENTION, une autre mare est présente à moins de 50 mètres, vérifiez qu'il ne s'agit pas de la même mare.</b></p>
	<?php } ?>
	<table border="0" width="100%">
		<tr align="center">
			<th width="25%">Date d'observation* : </th>
			<td width="25%"><input style="width:90%" type="text" id="L_DATE" value="" tabindex="1" placeholder="JJ/MM/AAAA" onBlur="verifchampVide(this)"></td>
			<td width="25%" rowspan="14">
				<?php if($Type == "Carto"){ ?>
					<iframe id="mapframe" frameborder="0" width="100%" height="250px" src="map_miniature_saisie.php?longitude=<?php echo $Longitude ?>&latitude=<?php echo $Latitude ?>"></iframe>
				<?php } ?>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Identifiant PRAM de la mare* : </th>
			<td width="25%">
				<?php if($Type == "GPS"){ ?>
					<div id="generatorIdentifiant">
						<input style="width:90%" disabled='disabled' type="text" id="L_ID" value="" tabindex="2">
					</div>
				<?php }else{ ?>
					<input style="width:90%" disabled='disabled' type="text" id="L_ID" value="<?php echo generatorIdentifiantMare(insseCommune($bdd, $Longitude, $Latitude),$bdd) ?>" tabindex="2">
				<?php } ?>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Identifiant donné par votre structure : </th>
			<td width="25%">
				<input style="width:90%" type="text" id="L_IDSTRP" value="" tabindex="3">
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Structure* : </th>
			<td width="25%"><?php echo simpleDisplaySelectDisabled($listStructure, 'L_STRP', 'S_ID', 'STRUCTURE', $donnees_aut['S_ID'], '', 4, 'disabled'); ?></td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Observateur* : </th>
			<td width="25%">
				<div id="actualiser_observateur">
					<?php echo simpleDisplaySelectOnBlur($listObs, 'L_OBSV', 'ID', 'OBS_NOM_PRENOM', 0, '', 5, 'verifchampSelect2(this)'); ?>             <img src="../img/observateur_add.png" alt="Ajouter un observateur" title="Ajouter un observateur" width="20" onClick="load_page('observateurs/observateurs_localisation.php?ID_STRUCTURE=<?php echo  $donnees_aut['S_ID'];?>', 'observateur', 'observateur')"/>
				</div>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Je suis : </th>
			<td width="25%"><?php echo simpleDisplaySelect2($listLien, 'L_LIEN', 'ID', 'LIEN', 0, 'afficher_masquer("lien","")', 5); ?></td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<td colspan="2" width="100%">
				<div style="display:none" id="lien_autre">
					<table width="100%">
						<tr align="center"> 
							<th width="25%">Précision autre : </th>
							<td width="25%"><input style="width:90%" type="text" id="L_LIEN_AUTRE" value="" tabindex="5"></td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Nom usuel de la mare : </th>
			<td width="25%"><input style="width:90%" type="text" id="L_NOM" value="" tabindex="6"></td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Commune* : </th>
			<td width="25%">
				<?php 
					if($Type == "GPS"){
						echo simpleDisplaySelect($listComm, 'L_ADMIN', 'Num_INSEE', 'Nom_Commune', '', 'RecAttribut("mare/identifiant.php","generatorIdentifiant","Identifiant")', 7);
					}else{
						echo simpleDisplaySelectDisabled($listComm, 'L_ADMIN', 'Num_INSEE', 'Nom_Commune', insseCommune($bdd, $Longitude, $Latitude), '', 7, 'disabled');
					}
				?>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Statut de la mare* : </th>
			<td width="25%"><?php echo simpleDisplaySelect2OnBlur($listStatut, 'L_STATUT', 'ID', 'STATUT', 0, '', 8, 'verifchampStatut(this)'); ?></td>
			
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Type de propriété* : </th>
			<td width="25%"><?php echo simpleDisplaySelect2OnBlur($listPropr, 'L_PROPR', 'ID', 'PROPR', 0, '', 9, 'verifchampSelect(this)'); ?></td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Longitude (WGS84) : </th>
			<td width="25%">
				<?php 
					if($Type == "GPS"){
				?>	
						<input style="width:90%" type="text" id="L_COOX" value="<?php echo $Longitude; ?>"  tabindex="10"></td>
				<?php
					}else{
				?>
						<input style="width:90%" type="text" id="L_COOX" value="<?php echo $Longitude; ?>"  tabindex="10" disabled="disabled"></td>
				<?php	} ?>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Latitude (WGS84) : </th>
			<td width="25%">
				<?php 
					if($Type == "GPS"){
				?>	
						<input style="width:90%" type="text" id="L_COOY" value="<?php echo $Latitude; ?>" tabindex="11" onBlur="RecAttribut('mare/verifcoordcom.php','test_coord_comm_latlng','VerifCoordComm')">
				<?php
					}else{
				?>
						<input style="width:90%" type="text" id="L_COOY" value="<?php echo $Latitude; ?>" tabindex="11" disabled="disabled" onBlur="RecAttribut('mare/verifcoordcom.php','test_coord_comm_latlng','VerifCoordComm')">
				<?php	} ?>
			</td>
			<td width="25%" rowspan="2">
				<?php if($Type == "GPS"){ ?>
					<div id="test_coord_comm_latlng">
					
					</div>
				<?php } ?>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">X (Lambert 93)* : </th>
			<td width="25%">
				<?php 
					if($Type == "GPS"){
				?>	
						<input style="width:90%" type="text" id="L_COOX93" value="<?php if($Type == "Carto"){echo number_format(ConvertCoord($Longitude, $Latitude, 'X'), 2, '.', '');}?>" tabindex="12">
				<?php
					}else{
				?>
						<input style="width:90%" type="text" id="L_COOX93" disabled="disabled" value="<?php if($Type == "Carto"){echo number_format(ConvertCoord($Longitude, $Latitude, 'X'), 2, '.', '');}?>" tabindex="12">
				<?php	} ?>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Y (Lambert 93)* : </th>
			<td width="25%">
				<?php 
					if($Type == "GPS"){
				?>	
						<input style="width:90%" type="text" id="L_COOY93" value="<?php if($Type == "Carto"){echo number_format(ConvertCoord($Longitude, $Latitude, 'Y'), 2, '.', '');}?>" tabindex="13" onBlur="RecAttribut('mare/verifcoordcom.php','test_coord_comm_latlng','VerifCoordComm')">
				<?php
					}else{
				?>
						<input style="width:90%" type="text" id="L_COOY93" disabled="disabled" value="<?php if($Type == "Carto"){echo number_format(ConvertCoord($Longitude, $Latitude, 'Y'), 2, '.', '');}?>" tabindex="13" onBlur="RecAttribut('mare/verifcoordcom.php','test_coord_comm_latlng','VerifCoordComm')">
				<?php	} ?>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Mode de localisation : </th>
				<?php 
					if($Type == "GPS"){
				?>	
						<td width="25%"><?php echo simpleDisplaySelect($listPrec, 'L_PREC', 'ID', 'PREC', 'mesuré', '', 14); ?></td>
				<?php
					}else{
				?>
						<td width="25%"><?php echo simpleDisplaySelect($listPrec, 'L_PREC', 'ID', 'PREC', '1.5', '', 14); ?></td>
				<?php	} ?>
			
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Anonymiser la mare : </th>
			<td width="25%"><?php echo simpleDisplaySelect2($listAnon, 'L_ANON', 'ID', 'ANON', 0, '', 14); ?></td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Commentaire : </th>
			<td width="25%"><textarea style="width:90%;" rows="5" Title="Commentaire" id="C_COMT" tabindex="15"></textarea></td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<th width="25%">Ajouter une photo de localisation : </th>
			<td width="25%">
				<input type="radio" class="Caract" name="Photolocalisation" id="Photolocalisation_Non" value="Non" checked alt="Masquer"  tabindex="16" onclick="afficher_masquer('photolocalisation','')"><font size="2">Non</font>
				<input type="radio" class="Caract" name="Photolocalisation" id="Photolocalisation_Oui" value="Oui" alt="Afficher"  tabindex="17" onclick="afficher_masquer('photolocalisation','');AjaxMare('mare/enregmare.php', '', 'RecMareLoc');"><font size="2">Oui</font>
			</td>
		</tr>
		<tr height="5"></tr>
		<tr align="center">
			<td width="100%" height="250px" colspan="4"><iframe style="display:none" id="photolocalisation" src="mare/iframephoto.php?ID_Mare=<?php echo $ID?>&type=photolocalisation" width="100%" height="380px" frameborder="0"></iframe></td>
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
									<input width="30" type="image" onclick="verifLocalisation('mare/error.php', 'erreur', '');actualiseMareAfterMod();" src="../img/enreg.png" Title="Enregistrer">
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
	<div id="textafficahge_carac_edit">
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<h1><b>DONNEES GENERALES DE LOCALISATION</b></h1>
	<div id="resultat_loca">
		<p>La mare que vous souhaitez localiser ne se situe pas dans la commune sélectionnée. Merci de fermer la fenêtre et de saisie une mare se situant dans la commune sélectionnée.</p>
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
</body>