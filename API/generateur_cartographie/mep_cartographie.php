<?php
	ini_set('max_execution_time', 100000);
	ini_set('upload_max_filesize', '30M');
	ini_set("display_errors",1);
		
	include '../../bdd.php';
	include_once '../../function.php';
	
	function dataMare($Identifiant_Session,$Mare,$bdd){
		$listemare = array();
	
	
	
	//ON VA FAIRE UNE REQUETE POUR VOIT SI LA STRUCUTRE POSSEDE UN CONTOUR GEOGRAPHIQUE DANS LA TABLE CONTOUR_STRUCTURE
	$req_contour_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$Identifiant_Session."'".' AND geom is Not Null');
	$count_contour = pg_num_rows($req_contour_structure);
	
	$req_structure_id = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$Identifiant_Session."'".' AND geom is Not Null');
	$donnees_structure_id = pg_fetch_array($req_structure_id);
	$id_structure_connectee = $donnees_structure_id["S_ID"];
	
	
	$req_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$Identifiant_Session."'".' AND geom is Not Null');
	$donnees_structure = pg_fetch_array($req_structure);
	$data["INFO_STRUCTURE"] = $donnees_structure;
	//SI count_contour = 1 alors on affiche sur la carte le perimetre de la structure et on zoom dessus
	if($count_contour == 1){
		if($Mare == 0){
			
			$req_mare = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "LOGO_STRUCTURE", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX", "L_COOY", "L_COOX93", "L_COOY93", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
								FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
								WHERE saisie_observation.localisation."L_STATUT" = menu_deroulant.l_statut."ID"::text
								AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
								AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
								AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
								AND st_intersects(structure.geom, st_transform(localisation.geom,2154))
								AND saisie_observation.structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'');
		}elseif($Mare <> 0){
			$req_mare = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "LOGO_STRUCTURE", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX", "L_COOY", "L_COOX93", "L_COOY93", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID"  
								FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
								WHERE saisie_observation.localisation."L_STATUT" = menu_deroulant.l_statut."ID"::text
								AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
								AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
								AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
								AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
								AND "S_ID_SESSION"='."'".$Identifiant_Session."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_connectee."'".'))
								AND "L_ID" ='."'".$Mare."'".'');
		}	
	}else{
		if($Mare == 0){
			$req_mare = pg_query($bdd, 'SELECT * 
								FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
								WHERE saisie_observation.localisation."L_STATUT" = menu_deroulant.l_statut."ID"::text
								AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
								AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
								AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
								AND saisie_observation.localisation."L_STRP" = saisie_observation.structure."S_ID"::text 
								AND saisie_observation.structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'');
		}elseif($Mare <> 0){
			$req_mare = pg_query($bdd, 'SELECT  *  
								FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
								WHERE saisie_observation.localisation."L_STATUT" = menu_deroulant.l_statut."ID"::text
								AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
								AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
								AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
								AND saisie_observation.localisation."L_STRP" = saisie_observation.structure."S_ID"::text								
								AND saisie_observation.structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'
								AND "L_ID" ='."'".$Mare."'".'');
		}
	}
		while($donnees_mare = pg_fetch_array($req_mare)){
			array_push($listemare, $donnees_mare); 
		}
		$data["INFO_MARE"] = $listemare;
		
		return $data;
	}
	// echo $_GET['Identifiant_Session'];
	//Permet de r�cuperer la valeur de ID_Projet et de $bdd
	$infos = dataMare($_GET['Identifiant_Session'],$_GET['Mare'],$bdd);	
	
	//ON COMMENCE A GENERER LE DOCUMENT

	//PERMET DE GENERER L'IMAGE POUR LOCALISER LES MARES
	$URLMarker = "";
	//POUR CHACUNE DES MARE ON VA GENERER UNE CARTE ORTHO A GRANDE ECHELLE ET UNE HYBRIDE A PETITE ECHELLE
	foreach($infos["INFO_MARE"] as $mare){	
		// Permet de g�n�rer les markers pour l'url
		$URLMarker = "&markers=icon:http://www.pramnormandie.com/img/docs/".stripAccents(utf8_decode(strtolower($mare['STATUT']))).".png|".$mare['L_COOY'].",".$mare['L_COOX'];
		//GENERE LA CARTE ORTHO
		copy('http://maps.googleapis.com/maps/api/staticmap?center='.$mare['L_COOY'].','.$mare['L_COOX'].'&zoom=18&size=1150x700&maptype=satellite'.$URLMarker.'', 'cartographie/'.$mare['L_ID'].'_Ortho.jpg');
		//GENERE LA CARTE EN HYBRIDE
		copy('http://maps.googleapis.com/maps/api/staticmap?center='.$mare['L_COOY'].','.$mare['L_COOX'].'&zoom=14&size=1150x700&maptype=hybride'.$URLMarker.'', 'cartographie/'.$mare['L_ID'].'_Hybride.jpg');
		//ON GENERE UNE PAGE DE L'ATLAS POUR CHAQUE MARE
		$document = "
		<page>
			<fieldset style='height:4%;text-align:left;vertical-align:middle;background-color:#e4b285;color:#ffffff;border:0px;font-size:16px;'>
				<table style='width:100%;'> 
					<tr>
						<td style='width:75%;text-align:left;font-size:16px;'>
							<b>Localisation de la mare : ".$mare['L_ID']."</b><br/><br/>
							<em><b>Orthophotoplan à grande échelle et vue hybride à petite échelle</b></em><br/>
						</td>
						<td style='width:25%;text-align:right;font-size:14px;'>";
							if($mare["LOGO_STRUCTURE"] <> ""){
									$document .= "<img src='".substr($mare['LOGO_STRUCTURE'], 3)."' style='height:60px'/>";
							}else{
									$document .= "<img src='../../img/site/pram.jpg' style='height:60px'/>";
							};
							$document .= "</td>
					</tr>
				</table>
			</fieldset>
			<br/>
			<table style='width:100%;'> 
				<tr>
					<td style='width:50%;text-align:center;font-size:14px;'>
						<img src='cartographie/".$mare['L_ID']."_Ortho.jpg' style='width:100%'>
					</td>
					<td style='width:50%;text-align:center;font-size:14px;'>
						<img src='cartographie/".$mare['L_ID']."_Hybride.jpg' style='width:100%'>
					</td>
				</tr>
				<tr height='30'><td></td></tr>
				<tr>
					<td colspan='2' style='width:100%;text-align:center;font-size:14px;'>
						<table align='center' style='width:100%;'> 
							<tr style='background-color:#e4b285;' height='30'>
								<th style='width:10%;text-align:center;font-size:14px;'>
									Département
								</th>
								<th style='width:22%;text-align:center;font-size:14px;'>
									Commune
								</th>
								<th style='width:10%;text-align:center;font-size:14px;'>
									Statut
								</th>
								<th style='width:10%;text-align:center;font-size:14px;'>
									Date de localisation
								</th>
								<th style='width:12%;text-align:center;font-size:14px;'>
									Observateur
								</th>
								<th style='width:8%;text-align:center;font-size:14px;'>
									Structure
								</th>
								<th style='width:8%;text-align:center;font-size:14px;'>
									Propriété
								</th>
								<th style='width:10%;text-align:center;font-size:14px;'>
									X (RGF93)
								</th>
								<th style='width:10%;text-align:center;font-size:14px;'>
									Y (RGF93)
								</th>
							</tr>
							<tr style='background-color:#dce2e8;' height='30'>
								<td style='width:10%;text-align:center;font-size:14px;'>
									".substr($mare['L_ADMIN'], 0, -3)."
								</td>
								<td style='width:22%;text-align:center;font-size:14px;'>
									".$mare['Nom_Commune']."
								</td>
								<td style='width:10%;text-align:center;font-size:14px;'>
									".$mare['STATUT']."
								</td>
								<td style='width:10%;text-align:center;font-size:14px;'>
									".date('d/m/Y', $mare['L_DATE'])."
								</td>
								<td style='width:12%;text-align:center;font-size:14px;'>
									".$mare['OBS_PRENOM']." ".$mare['OBS_NOM']."
								</td>
								<td style='width:8%;text-align:center;font-size:14px;'>
									".$mare['STRUCTURE']."
								</td>
								<td style='width:8%;text-align:center;font-size:14px;'>
									".$mare['PROPR']."
								</td>
								<td style='width:10%;text-align:center;font-size:14px;'>
									".$mare['L_COOX93']."
								</td>
								<td style='width:10%;text-align:center;font-size:14px;'>
									".$mare['L_COOY93']."
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</page>
		<page_footer>
			<p style='text-align:right;font-size:10px'>Document généré partir du site du Programme régional d'actions en faveur des mares de Normandie (www.pramnormandie.com/API)</p>
		</page_footer>";		
	}

	$accent = array("ö", "ç", "€","à","ë","é","è","ê","î","ô","û","°","â","Â");
	$accentTrans = array("&ouml;", "&ccedil;", "&#128;","&agrave;", "&euml;", "&eacute;","&egrave;","&ecirc;","&icirc;","&ocirc;","&ucirc;","&deg;","&acirc;","&Acirc;");
		
	$document = 	str_replace($accent,$accentTrans,$document);
	
	
	// echo $document;
	
	// ATTENTION A OU SE TROUVE LA LIBRAIRIE PAR RAPPORT A TON FICHIER :)
	
	require_once('../../html2pdf/html2pdf.class.php');
	$marges = array(10, 10, 10, 10);
	$html2pdf = new HTML2PDF('L', 'A4', 'fr', true, 'UTF-8', $marges);
	$html2pdf->WriteHTML($document);
	ob_end_clean();
	$html2pdf->Output('Atlas_Cartographique_PRAM.pdf');	
	

?>