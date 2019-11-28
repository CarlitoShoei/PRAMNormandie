<?php
	date_default_timezone_set('Europe/Paris');
	ini_set("display_errors",1);
	// On se connecte ࡬a base de donn꦳
	include '../../bdd.php';
	//On transforme les date en seconde
	function dateSeconde($Date){
		$temp = array();
		$temp = explode("/", $Date);
		$Date_Seconde = mktime(0,0,0,$temp[1],$temp[0],$temp[2]);
		return $Date_Seconde;
	}
	
	
	function dataProjet($id_structure_conectee,$date_debut,$date_fin,$bdd){
		$data = array();
		
		$req_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$id_structure_conectee."'".' AND geom is Not Null');
		$donnees_structure = pg_fetch_array($req_structure);
		$data["INFO_STRUCTURE"] = $donnees_structure;
		
		//REQUETE POUR VOIR SI IL EXISTE UNE PHOTO OU PAS
		$count_loca = pg_query($bdd, 'SELECT COUNT(*) AS "SOMME" FROM saisie_observation.localisation, saisie_observation.structure
										WHERE localisation."L_STRP"::text = structure."S_ID"::text 
										AND structure."S_ID_SESSION"='."'".$id_structure_conectee."'".' 
										AND "L_DATE" >= '."'".dateSeconde($date_debut)."'".'
										AND "L_DATE" <= '."'".dateSeconde($date_fin)."'".'
										AND "L_DATE" is not Null');
		$donnees_count = pg_fetch_array($count_loca);
		$data["INFO_COUNT"] = $donnees_count;
		
		//LISTE LES INFOS STRUCUTRUE
		$req_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure 
								WHERE structure."S_ID_SESSION"='."'".$id_structure_conectee."'".'');
		$donnees_structure = pg_fetch_array($req_structure);
		$data["INFO_STRUCTURE"] = $donnees_structure;
		
		
		//LISTE LES INFOS FAUNE
		$liste = array();
		$req = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation, saisie_observation.structure, ign_bd_topo.commune, menu_deroulant.l_statut
								WHERE localisation."L_STRP"::text = structure."S_ID"::text 
								AND localisation."L_STATUT"::text = l_statut."ID"::text
								AND localisation."L_ADMIN"::text = commune."Num_INSEE"::text
								AND structure."S_ID_SESSION"='."'".$id_structure_conectee."'".' 
								AND "L_DATE" >= '."'".dateSeconde($date_debut)."'".'
								AND "L_DATE" <= '."'".dateSeconde($date_fin)."'".'
								AND "L_DATE" is not Null 
								ORDER BY "L_DATE"');
		while ($donnees = pg_fetch_array($req)){
			array_push($liste, $donnees); 
		}
		$data["INFO_LOCALISATION"] = $liste;
		
		return $data;	
	}
	
	//Permet de rꤵperer la valeur de ID_Projet et de $bdd
	$infos = dataProjet($_GET['S_ID_SESSION'],$_GET['Date_Debut'],$_GET['Date_Fin'],$bdd);	
	
	//Permet la gestion des informations par rapport ࡬a fiche
	$document = "
			<page>
			<table style='width:100%;height:10%'> 
					<tr style='height:10%'>				
						<td style='width:50%;text-text-align:left;font-size:14px;'>";
							if($infos["INFO_STRUCTURE"]["LOGO_STRUCTURE"] <> ""){
									$document .= "<img src='".substr($infos["INFO_STRUCTURE"]["LOGO_STRUCTURE"], 3)."' style='height:80px'>";
								};
							$document .= "</td>
						<td style='width:50%;text-align:right;font-size:14px;'>
							<img src='../../img/pram.jpg' style='height:80px'>
						</td>
					</tr>
				</table>
			<br>
			<table style='width:100%;'> 
				<tr>				
					<td style='width:100%;font-size:17px;'>
						<fieldset style='height:8%;text-align:center;vertical-align:middle;background-color:#8bb0d9;color:#ffffff;border:0px;font-size:22px;'>
							<b>FICHE DE SAISIE</b>
						</fieldset>
					</td>
				</tr>
			</table>
			<br>
			<p><b>Date d'édition de la fiche de saisie : </b>".date('d/m/Y')."</p>
			<table style='width:100%;border:1px solid black;border-collapse:collapse'> 
				<tr>				
					<td style='width:100%;font-size:17px;border:1px solid black;background-color:#8bb0d9;color:#ffffff;text-align:center;vertical-align:middle;font-size:13px;height:3%' colspan='2'>
						<b>INFORMATIONS STRUCTURE</b>
					</td>
				</tr>
				<tr>
					<td style='width:15%;font-size:12px;border:1px solid black;height:3%;text-align:center'>
						<b>Nom</b>
					</td>
					<td style='width:85%;font-size:12px;border:1px solid black;height:3%'>
						".$infos["INFO_STRUCTURE"]["STRUCTURE"]."
					</td>
				</tr>
				<tr>
					<td style='width:15%;font-size:12px;border:1px solid black;height:3%;text-align:center'>
						<b>Adresse</b>
					</td>
					<td style='width:85%;font-size:12px;border:1px solid black;height:3%'>
						".$infos["INFO_STRUCTURE"]["S_ADRESSE"]."
					</td>
				</tr>
			</table>
			<br>
			<br>
			<p><b>Période de saisie sélectionnée : </b>du ".$_GET['Date_Debut']." au ".$_GET['Date_Fin']."</p>
			<table style='width:100%;border:1px solid black;border-collapse:collapse'> 
				<tr>				
					<td style='width:100%;font-size:17px;border:1px solid black;background-color:#8bb0d9;color:#ffffff;text-align:center;vertical-align:middle;font-size:13px;height:3%' colspan='6'>
						<b>DONNEES SAISIES</b>
					</td>
				</tr>
				<tr>
					<td style='width:13%;font-size:12px;border:1px solid black;height:3%;text-align:center'>
						<b>id_PRAM_Mare</b>
					</td>
					<td style='width:35%;font-size:12px;border:1px solid black;height:3%;text-align:center'>
						<b>Commune</b>
					</td>
					<td style='width:12%;font-size:12px;border:1px solid black;height:3%;text-align:center'>
						<b>X (L93)</b>
					</td>
					<td style='width:12%;font-size:12px;border:1px solid black;height:3%;text-align:center'>
						<b>Y (L93)</b>
					</td>
					<td style='width:15%;font-size:12px;border:1px solid black;height:3%;text-align:center'>
						<b>Statut de la mare</b>
					</td>
					<td style='width:13%;font-size:12px;border:1px solid black;height:3%;text-align:center'>
						<b>Champs obligatoires renseignés (9 champs)</b>
					</td>
				</tr>";
				foreach($infos["INFO_LOCALISATION"] as $localisation){
					
					$document.="<tr>
									<td style='width:13%;height:2%;text-align:center;font-size:9px;border:1px solid black'>
										".$localisation["L_ID"]."
									</td>
									<td style='width:35%;height:2%;text-align:center;font-size:9px;border:1px solid black'>
										".$localisation["Nom_Commune"]."
									</td>
									<td style='width:12%;height:2%;text-align:center;font-size:9px;border:1px solid black'>
										".$localisation["L_COOX93"]."
									</td>
									<td style='width:12%;height:2%;text-align:center;font-size:9px;border:1px solid black'>
										".$localisation["L_COOY93"]."
									</td>
									<td style='width:15%;height:2%;text-align:center;font-size:9px;border:1px solid black'>
										".$localisation["STATUT"]."
									</td>
									<td style='width:13%;height:2%;text-align:center;font-size:9px;border:1px solid black'>
										Oui
									</td>
								</tr>";
								
				}
				$document.="	
			</table>
			<br>
			<br>
			<p><b>Nombre total de mares saisies entre le ".$_GET['Date_Debut']." et le ".$_GET['Date_Fin']." : </b>".$infos["INFO_COUNT"]["SOMME"]."</p>
			</page>";
	

	// $accent = array("򢬠"碬 "","ࢬ"뢬"颬"袬"ꢬ""𢬢󢬢Т,"⢬"¢,"񢬢+");
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