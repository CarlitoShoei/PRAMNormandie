<?php
	date_default_timezone_set('Europe/Paris');
	// ini_set("display_errors",1);
	// On se connecte ‡ la base de donnÈes
	include '../../bdd.php';
	include_once '../../function.php';
	
	//REQUETE POUR VOIR SI IL EXISTE UNE PHOTO OU PAS
	$event_exist = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation_photo WHERE saisie_observation.localisation_photo."L_ID"='."'".$_GET['L_ID']."'".'');
	$count = pg_num_rows($event_exist);
	
	//REQUETE POUR VOIR SI IL EXISTE UNE PHOTO OU PAS
	$event_exist_carac = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_photo 
											WHERE saisie_observation.caracterisation_photo."L_ID"='."'".$_GET['L_ID']."'".'');
	$count_carac = pg_num_rows($event_exist_carac);
	
	function dataProjet($L_ID,$bdd){
		$data = array();
		
		//LISTE LES INFOS LOCALISATION MARE
		$req_localisation = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
										WHERE saisie_observation.localisation."L_STATUT"=menu_deroulant.l_statut."ID"::text
										AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
										AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
										AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
										AND saisie_observation.localisation."L_STRP"::text = saisie_observation.structure."S_ID"::text
										AND saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
										ORDER BY saisie_observation.localisation."L_ID"');
		$donnees_localisation = pg_fetch_array($req_localisation);
		$data["INFO_LOCALISATION"] = $donnees_localisation;
		
		//LISTE LES INFOS POUR PHOTO DE MARE
		$listephoto = array();
		$req_photo = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation_photo
								  WHERE saisie_observation.localisation_photo."L_ID"='."'".$L_ID."'".'');
		while ($donnees_photo = pg_fetch_array($req_photo)){
			array_push($listephoto, $donnees_photo); 
		}
		$data["INFO_PHOTO"] = $listephoto;
		
		return $data;	
	}
	
	//Permet de rÈcuperer la valeur de ID_Projet et de $bdd
	$infos = dataProjet($_GET['L_ID'],$bdd);	
	
	
	// Permet de gÍØ©rer les markers pour l'url
		$URLMarker = "&markers=icon:http://www.pramnormandie.com/img/docs/".stripAccents(utf8_decode(strtolower($infos["INFO_LOCALISATION"]["STATUT"]))).".png|".$infos["INFO_LOCALISATION"]["L_COOY"].",".$infos["INFO_LOCALISATION"]["L_COOX"];
		//GENERE LA CARTE ORTHO
		copy('http://maps.googleapis.com/maps/api/staticmap?center='.$infos["INFO_LOCALISATION"]["L_COOY"].','.$infos["INFO_LOCALISATION"]["L_COOX"].'&zoom=18&size=1150x700&maptype=satellite'.$URLMarker.'', 'imagegoogle.jpg');
	
	//Permet la gestion des informations par rapport ‡ la fiche
	$document = "
			<page>
			<page_header>
				<table style='width:100%;'> 
					<tr>				
						<td style='width:20%;text-align:left;font-size:14px;'>
							<img src='../../img/pram.jpg' style='width:50%'>
						</td>
						<td style='width:60%;text-align:center;font-size:14px;'>
						</td>
						<td style='width:20%;text-align:right;font-size:14px;'>";
							if($infos["INFO_LOCALISATION"]["LOGO_STRUCTURE"] <> ""){
								// echo "<img src='".substr($infos["INFO_LOCALISATION"]["LOGO_STRUCTURE"], 3)."' style='width:35%'/>";
								$document .= "<img src='".substr($infos["INFO_LOCALISATION"]["LOGO_STRUCTURE"], 3)."' style='width:15%'/>";
							}else{
									$document .= "<img src='../../img/pram.jpg' style='width:50%'>";
							};
						$document .= "</td>
					</tr>
				</table>
			</page_header>
			<br>
			<br>
			<br>
			<br>
			<table style='width:100%;'> 
				<tr>				

					<td style='width:100%;font-size:17px;'>
						<fieldset style='height:8%;text-align:center;vertical-align:middle;background-color:#d79c5f;color:#ffffff;border:0px;font-size:22px;'>
							<b>FICHE DE LOCALISATION DE LA MARE ".$infos["INFO_LOCALISATION"]["L_ID"]."</b><br>
							<b>COMMUNE DE : ".$infos["INFO_LOCALISATION"]["Nom_Commune"]."</b>
						</fieldset>
					</td>
				</tr>
			</table>
			<br>
		
			<fieldset style='color:#ffffff;font-size:15px;border:0px;border-color:#aabcd6;background-color:#d79c5f'><b>&nbsp;&nbsp;DONNEES GENERALES</b></fieldset>
			<fieldset style='text-align:left;vertical-align:middle;border:1px;border-color:#aabcd6'>
				<br>
				<table border='0' style='width:100%;'> 
					<tr>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Date de la localisation : </b> ".date('d/m/Y', $infos["INFO_LOCALISATION"]["L_DATE"])."
						</td>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Nom de la mare : </b> ".$infos["INFO_LOCALISATION"]["L_NOM"]."
						</td>
					</tr>
					<tr><td style='height:1%;'></td></tr>
					<tr>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Structure : </b> ".$infos["INFO_LOCALISATION"]["STRUCTURE"]."
						</td>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Observateur : </b> ".$infos["INFO_LOCALISATION"]["OBS_NOM_PRENOM"]."
						</td>
					</tr>
					<tr><td style='height:1%;'></td></tr>
					<tr>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Commune : </b> ".$infos["INFO_LOCALISATION"]["Nom_Commune"]."
						</td>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Num√©ro INSEE : </b> ".$infos["INFO_LOCALISATION"]["L_ADMIN"]."
						</td>
					</tr>
					<tr><td style='height:1%;'></td></tr>
					<tr>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Nom usuel de la mare : </b> ".$infos["INFO_LOCALISATION"]["L_NOM"]."
						</td>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Type de propri√©t√© : </b> ".$infos["INFO_LOCALISATION"]["PROPR"]."
						</td>
					</tr>
					<tr><td style='height:1%;'></td></tr>
					<tr>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Longitude (WGS84) : </b> ".$infos["INFO_LOCALISATION"]["L_COOX"]."
						</td>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Latitude (WGS84) : </b> ".$infos["INFO_LOCALISATION"]["L_COOY"]."
						</td>
					</tr>
					<tr><td style='height:1%;'></td></tr>
					<tr>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>X (Lambert 93) : </b> ".$infos["INFO_LOCALISATION"]["L_COOX93"]."
						</td>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Y (Lambert 93) : </b> ".$infos["INFO_LOCALISATION"]["L_COOY93"]."
						</td>
					</tr>
					<tr><td style='height:1%;'></td></tr>
					<tr>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Mode de localisation : </b>";
								if($infos["INFO_LOCALISATION"]["L_PREC"] == "1.5"){
									$document.="Photo a√©rienne";
								}else if($infos["INFO_LOCALISATION"]["L_PREC"] == "7.5"){
									$document.="Carte IGN SCAN 25";
								}else if($infos["INFO_LOCALISATION"]["L_PREC"] == "mesur√©"){
									$document.="GPS";
								};
						$document.="
						</td>
						<td style='width:50%;text-align:left;font-size:14px;'>
							<b>Commentaire : </b> ".$infos["INFO_LOCALISATION"]["C_COMT"]."
						</td>
					</tr>
					<tr><td style='height:1%;'></td></tr>
					<tr>
						<td colspan='2' style='width:100%;text-align:center;font-size:14px;'>";
							foreach($infos["INFO_PHOTO"] as $photo){
									$document.="<img src='".$photo["LIEN"]."' style='width:20%'>";
							}
							$document.="
						</td>
					</tr>
				</table>
			</fieldset>
			<br>
			<br>
			<fieldset style='color:#ffffff;font-size:15px;border:0px;border-color:#aabcd6;background-color:#d79c5f'><b>&nbsp;&nbsp;CARTE DE LOCALISATION</b></fieldset>
			<fieldset style='text-align:left;vertical-align:middle;border:1px;border-color:#aabcd6'>
				<br>
				<table border='0' style='width:100%;'> 
					<tr>
						<td style='width:100%;text-align:center;font-size:14px;'>
							<img src='imagegoogle.jpg' style='width:50%'>
						</td>
					</tr>
					
				</table>
			</fieldset>
		<page_footer>
			<p style='text-align:right;font-size:10px'>Document g√©n√©r√© partir du site du Programme r√©gional d'actions en faveur des mares de Normandie (www.pramnormandie.com/API)</p>
		</page_footer>
		</page>";
	

	// $accent = array("ˆ", "Á", "Ä","‡","Î","È","Ë","Í","Ó","Ù","˚","∞","‚","¬","˘","+");
	// $accentTrans = array("&ouml;", "&ccedil;", "&#128;","&agrave;", "&euml;", "&eacute;","&egrave;","&ecirc;","&icirc;","&ocirc;","&ucirc;","&deg;","&acirc;","&Acirc;","&uuml;","&#134;");
		
	// $document = 	str_replace($accent,$accentTrans,$document);
	
	
	// echo $document;
	
	//ATTENTION A OU SE TROUVE LA LIBRAIRIE PAR RAPPORT A TON FICHIER :)
	
	require_once('../../html2pdf/html2pdf.class.php');
	$marges = array(10, 10, 10, 10);
    $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', $marges);
    $html2pdf->WriteHTML($document);
	ob_end_clean();
	$html2pdf->Output('monFichier.pdf');	
	

?>