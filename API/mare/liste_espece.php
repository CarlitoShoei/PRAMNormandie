<?php 
ini_set('max_execution_time', 72000000);
ini_set("display_errors",0);
// error_reporting(E_ALL ^ E_DEPRECATED);

// header('Content-type: text/html; charset=UTF-8'); 
// header('Content-type: text/html; charset=iso8859-1'); 
// On se connecte ࡬a base de donn꦳
include '../../bdd.php';

require "../../php_writeexcel/class.writeexcel_workbook.inc.php";
require "../../php_writeexcel/class.writeexcel_worksheet.inc.php";

//ON RECUPERE LA VARAIBLE
$L_ID = $_GET['L_ID'];
$role = $_GET['role'];
$id_structure_conectee = $_GET['id_structure_conectee'];

//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE EST PROPRIETAIRE DES DONNEES
$observation_obs_ss_contour = pg_query($bdd, 'SELECT "CD_NOM", "TAXON", "NOM_VERNACULAIRE", "ORDRE", "RARETE_HN", "DETERMINANT_ZNIEFF", "PROTECT_NAT", "DE_92_43_CEE_AII", "PATRIMONIALITE", "STENOECIE", "TENDANCE_HN", "CONV_BERNE", "DH_FAUNE_FLORE", "LR_NAT", "NIV_CONNAISSANCE" 
								FROM saisie_observation.observation, saisie_observation.structure, menu_deroulant.referentiel_faune
								WHERE observation."O_STRP"::text = structure."S_ID"::text
								AND saisie_observation.observation."O_REID" = menu_deroulant.referentiel_faune."CD_NOM"
								AND saisie_observation.observation."L_ID"='."'".$L_ID."'".'
								AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
								AND saisie_observation.observation."O_REFE" = '."'TAXREF v8.0'".'
								GROUP BY saisie_observation.observation."O_NLAT", "CD_NOM"
								ORDER BY saisie_observation.observation."O_NLAT"');

//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
$observation_util_ac_contour = pg_query($bdd, 'SELECT "CD_NOM", "TAXON", "NOM_VERNACULAIRE", "ORDRE", "RARETE_HN", "DETERMINANT_ZNIEFF", "PROTECT_NAT", "DE_92_43_CEE_AII", "PATRIMONIALITE", "STENOECIE", "TENDANCE_HN", "CONV_BERNE", "DH_FAUNE_FLORE", "LR_NAT", "NIV_CONNAISSANCE" 
								FROM saisie_observation.observation, saisie_observation.structure, menu_deroulant.referentiel_faune
								WHERE observation."O_STRP"::text = structure."S_ID"::text
								AND saisie_observation.observation."O_REID" = menu_deroulant.referentiel_faune."CD_NOM"
								AND saisie_observation.observation."L_ID"='."'".$L_ID."'".'
								AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
								AND saisie_observation.observation."O_REFE" = '."'TAXREF v8.0'".'
								GROUP BY saisie_observation.observation."O_NLAT", "CD_NOM"
								ORDER BY saisie_observation.observation."O_NLAT"');

//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR								
$observation_obs_ac_contour = pg_query($bdd, 'SELECT "CD_NOM", "TAXON", "NOM_VERNACULAIRE", "ORDRE", "RARETE_HN", "DETERMINANT_ZNIEFF", "PROTECT_NAT", "DE_92_43_CEE_AII", "PATRIMONIALITE", "STENOECIE", "TENDANCE_HN", "CONV_BERNE", "DH_FAUNE_FLORE", "LR_NAT", "NIV_CONNAISSANCE"
								FROM(
									SELECT "CD_NOM", "TAXON", "NOM_VERNACULAIRE", "ORDRE", "RARETE_HN", "DETERMINANT_ZNIEFF", "PROTECT_NAT", "DE_92_43_CEE_AII", "PATRIMONIALITE", "STENOECIE", "TENDANCE_HN", "CONV_BERNE", "DH_FAUNE_FLORE", "LR_NAT", "NIV_CONNAISSANCE"
									FROM saisie_observation.observation, saisie_observation.structure, saisie_observation.localisation, menu_deroulant.referentiel_faune 
									WHERE observation."L_ID"::text = localisation."L_ID"::text
									AND st_contains(st_transform(structure.geom,4326),localisation.geom)
									AND saisie_observation.observation."O_REID" = menu_deroulant.referentiel_faune."CD_NOM"
									AND saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
									AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
									AND saisie_observation.observation."O_REFE" = '."'TAXREF v8.0'".'
									UNION ALL
									SELECT "CD_NOM", "TAXON", "NOM_VERNACULAIRE", "ORDRE", "RARETE_HN", "DETERMINANT_ZNIEFF", "PROTECT_NAT", "DE_92_43_CEE_AII", "PATRIMONIALITE", "STENOECIE", "TENDANCE_HN", "CONV_BERNE", "DH_FAUNE_FLORE", "LR_NAT", "NIV_CONNAISSANCE"
									FROM saisie_observation.observation, saisie_observation.structure, menu_deroulant.referentiel_faune 
									WHERE observation."O_STRP"::text = structure."S_ID"::text
									AND saisie_observation.observation."O_REID" = menu_deroulant.referentiel_faune."CD_NOM"
									AND saisie_observation.observation."L_ID"='."'".$L_ID."'".'
									AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
									AND saisie_observation.observation."O_REFE" = '."'TAXREF v8.0'".'
									) as obs
								GROUP BY "CD_NOM", "TAXON", "NOM_VERNACULAIRE", "ORDRE", "RARETE_HN", "DETERMINANT_ZNIEFF", "PROTECT_NAT", "DE_92_43_CEE_AII", "PATRIMONIALITE", "STENOECIE", "TENDANCE_HN", "CONV_BERNE", "DH_FAUNE_FLORE", "LR_NAT", "NIV_CONNAISSANCE"');
							
							
//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
$observation_admin = pg_query($bdd, 'SELECT "CD_NOM", "TAXON", "NOM_VERNACULAIRE", "ORDRE", "RARETE_HN", "DETERMINANT_ZNIEFF", "PROTECT_NAT", "DE_92_43_CEE_AII", "PATRIMONIALITE", "STENOECIE", "TENDANCE_HN", "CONV_BERNE", "DH_FAUNE_FLORE", "LR_NAT", "NIV_CONNAISSANCE" 
								FROM saisie_observation.observation, menu_deroulant.referentiel_faune
								WHERE saisie_observation.observation."O_REID" = menu_deroulant.referentiel_faune."CD_NOM"
								AND saisie_observation.observation."L_ID"='."'".$L_ID."'".'
								AND saisie_observation.observation."O_REFE" = '."'TAXREF v8.0'".'
								GROUP BY saisie_observation.observation."O_NLAT", "CD_NOM"
								ORDER BY saisie_observation.observation."O_NLAT"');

//REQUETE POUR REGARDER SI LA STRUCTURE CONNECTER POSSEDE UN CONTOUR
$req_contour_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure
										WHERE "S_ID_SESSION"::text='."'".$id_structure_conectee."'".' 
										AND structure.geom is Not Null');
$count_contour = pg_num_rows($req_contour_structure);




//On indique ensuite un emplacement sur le serveur, l� o� sera stock� le fichier
$fname = "pram_liste_espece.xls";
$workbook = new writeexcel_workbook($fname); // on lui passe en param�tre le chemin de notre fichier

//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////POUR GENERER LONGLET POUR LA LISTE FAUNE/////////////////////////////////
$worksheet =& $workbook->addworksheet('PRAM_Liste_Faune'); //le param�tre ici est le nom de la feuille
$worksheet->set_column('A:O', 50); // le 30 repr�sente la largeur de chaque colonne
$heading  =& $workbook->addformat(array('bold' => 1, // on met le texte en gras
										'color' => 'black', // de couleur noire
									    'size' => 12, // de taille 12
										'merge' => 1)); // avec une marge
									 // 'fg_color' => 0x66));// coloration du fond des cellules

$headings = array('ID Taxref', 'Taxon', 'Nom vernaculaire', 'Ordre', 'Rarete HN', 'Determinant ZNEFF', 'Protection National', 'DE 92/43 CEE', 'Patrimonialite', 'Stenoecie', 'Tendance HN', 'Convention Berne', 'Directive Faune Flore', 'Liste Rouge Nationale', 'Niveau Connaissance'); //d�finition du texte pour chaque cellules
$worksheet->write_row('A1', $headings, $heading); //On int�gre notre texte et les le format de cellule.
// le premier param�tre correspond � la cellule o� l'on souhaite commencer � int�grer les diff�rent param�tre.


$x=2;
if($role == "administrateur"){
	while($resultat = pg_fetch_array($observation_admin)){
		$worksheet->write("A".$x,utf8_decode($resultat['CD_NOM'])); // ici on va ꤲire une cellules bien dꧩnie
		$worksheet->write("B".$x,utf8_decode($resultat['TAXON']));
		$worksheet->write("C".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));
		$worksheet->write("D".$x,utf8_decode($resultat['ORDRE']));
		$worksheet->write("E".$x,utf8_decode($resultat['RARETE_HN']));
		$worksheet->write("F".$x,utf8_decode($resultat['DETERMINANT_ZNIEFF']));
		$worksheet->write("G".$x,utf8_decode($resultat['PROTECT_NAT']));
		$worksheet->write("H".$x,utf8_decode($resultat['DE_92_43_CEE_AII']));
		$worksheet->write("I".$x,utf8_decode($resultat['PATRIMONIALITE']));
		$worksheet->write("J".$x,utf8_decode($resultat['STENOECIE']));
		$worksheet->write("K".$x,utf8_decode($resultat['TENDANCE_HN']));
		$worksheet->write("L".$x,utf8_decode($resultat['CONV_BERNE']));
		$worksheet->write("M".$x,utf8_decode($resultat['DH_FAUNE_FLORE']));
		$worksheet->write("N".$x,utf8_decode($resultat['LR_NAT']));
		$worksheet->write("O".$x,utf8_decode($resultat['NIV_CONNAISSANCE']));
		$x++;
	}
}elseif($role == "observateur"){
	 if($count_contour >= 1){
		while($resultat = pg_fetch_array($observation_obs_ac_contour)){
			$worksheet->write("A".$x,utf8_decode($resultat['CD_NOM'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['TAXON']));
			$worksheet->write("C".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));
			$worksheet->write("D".$x,utf8_decode($resultat['ORDRE']));
			$worksheet->write("E".$x,utf8_decode($resultat['RARETE_HN']));
			$worksheet->write("F".$x,utf8_decode($resultat['DETERMINANT_ZNIEFF']));
			$worksheet->write("G".$x,utf8_decode($resultat['PROTECT_NAT']));
			$worksheet->write("H".$x,utf8_decode($resultat['DE_92_43_CEE_AII']));
			$worksheet->write("I".$x,utf8_decode($resultat['PATRIMONIALITE']));
			$worksheet->write("J".$x,utf8_decode($resultat['STENOECIE']));
			$worksheet->write("K".$x,utf8_decode($resultat['TENDANCE_HN']));
			$worksheet->write("L".$x,utf8_decode($resultat['CONV_BERNE']));
			$worksheet->write("M".$x,utf8_decode($resultat['DH_FAUNE_FLORE']));
			$worksheet->write("N".$x,utf8_decode($resultat['LR_NAT']));
			$worksheet->write("O".$x,utf8_decode($resultat['NIV_CONNAISSANCE']));
			$x++;
		}
	 }else{
		while($resultat = pg_fetch_array($observation_obs_ss_contour)){
			$worksheet->write("A".$x,utf8_decode($resultat['CD_NOM'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['TAXON']));
			$worksheet->write("C".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));
			$worksheet->write("D".$x,utf8_decode($resultat['ORDRE']));
			$worksheet->write("E".$x,utf8_decode($resultat['RARETE_HN']));
			$worksheet->write("F".$x,utf8_decode($resultat['DETERMINANT_ZNIEFF']));
			$worksheet->write("G".$x,utf8_decode($resultat['PROTECT_NAT']));
			$worksheet->write("H".$x,utf8_decode($resultat['DE_92_43_CEE_AII']));
			$worksheet->write("I".$x,utf8_decode($resultat['PATRIMONIALITE']));
			$worksheet->write("J".$x,utf8_decode($resultat['STENOECIE']));
			$worksheet->write("K".$x,utf8_decode($resultat['TENDANCE_HN']));
			$worksheet->write("L".$x,utf8_decode($resultat['CONV_BERNE']));
			$worksheet->write("M".$x,utf8_decode($resultat['DH_FAUNE_FLORE']));
			$worksheet->write("N".$x,utf8_decode($resultat['LR_NAT']));
			$worksheet->write("O".$x,utf8_decode($resultat['NIV_CONNAISSANCE']));
			$x++;
		}
	 }
}elseif($role == "utilisateur"){
	while($resultat = pg_fetch_array($observation_util_ac_contour)){
			$worksheet->write("A".$x,utf8_decode($resultat['CD_NOM'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['TAXON']));
			$worksheet->write("C".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));
			$worksheet->write("D".$x,utf8_decode($resultat['ORDRE']));
			$worksheet->write("E".$x,utf8_decode($resultat['RARETE_HN']));
			$worksheet->write("F".$x,utf8_decode($resultat['DETERMINANT_ZNIEFF']));
			$worksheet->write("G".$x,utf8_decode($resultat['PROTECT_NAT']));
			$worksheet->write("H".$x,utf8_decode($resultat['DE_92_43_CEE_AII']));
			$worksheet->write("I".$x,utf8_decode($resultat['PATRIMONIALITE']));
			$worksheet->write("J".$x,utf8_decode($resultat['STENOECIE']));
			$worksheet->write("K".$x,utf8_decode($resultat['TENDANCE_HN']));
			$worksheet->write("L".$x,utf8_decode($resultat['CONV_BERNE']));
			$worksheet->write("M".$x,utf8_decode($resultat['DH_FAUNE_FLORE']));
			$worksheet->write("N".$x,utf8_decode($resultat['LR_NAT']));
			$worksheet->write("O".$x,utf8_decode($resultat['NIV_CONNAISSANCE']));
			$x++;
		}
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////POUR GENERER LONGLET POUR LA LISTE FLORE/////////////////////////////////
$worksheet =& $workbook->addworksheet('PRAM_Liste_Flore'); //le param�tre ici est le nom de la feuille
$worksheet->set_column('A:T', 50); // le 50 repr�sente la largeur de chaque colonne
$heading  =& $workbook->addformat(array('bold' => 1, // on met le texte en gras
										'color' => 'black', // de couleur noire
									    'size' => 12, // de taille 12
										'merge' => 1)); // avec une marge
									 // 'fg_color' => 0x66));// coloration du fond des cellules
									 
$headings = array('ID Taxon', 'Taxon', 'Nom vernaculaire', 'Statut Presence', 'Statut Indigenat Principal', 'Statut Indigenat Secondaire', 'Rarete', 'Menace', 'Justification Cotation Menace', 'Usage Cultural Principal', 'Usage Cultural Secondaire', 'Frequence Cultural', 'Protection Nationale A1', 'Protection Nationale A2', 'Protection Regionale', 'Interêt Patrimonial', 'Liste Rouge Regionale', 'ZNIEFF', 'Indicateur ZH', 'Exotique/Envahissante'); //d�finition du texte pour chaque cellules
$worksheet->write_row('A1', $headings, $heading); //On int�gre notre texte et les le format de cellule.
// le premier param�tre correspond � la cellule o� l'on souhaite commencer � int�grer les diff�rent param�tre.

//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE EST PROPRIETAIRE DES DONNEES
$observation_obs_ss_contour = pg_query($bdd, 'SELECT "O_REID", "O_NLA2", "O_NVER", "Statut_Presence", "Statut_Indigenat_Principal", "Statut_Indigenat_Secondaire", "Rarete", "Menace", "Justification_Cotation_Menace", 
										"Usage_Cultural_Principal", "Usage_Cultural_Secondaire", "Frequence_Cultural", "Protection_National_A1", "Protection_National_A2", "Protection_Regional", "Interet_Patrimonial", 
										"LR_Regional", "ZNIEFF", "Indicateur_ZH", "Exotique_Envahissante"
								FROM saisie_observation.observation
								LEFT JOIN menu_deroulant.referentiel_flore ON observation."O_REID" = referentiel_flore."ID_Taxon"
								LEFT JOIN saisie_observation.structure ON observation."O_STRP"::text = structure."S_ID"::text
								WHERE saisie_observation.observation."L_ID"='."'".$L_ID."'".'
								AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
								AND saisie_observation.observation."O_REF2" = '."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".'
								GROUP BY saisie_observation.observation."O_NLAT", "ID_Taxon"
								ORDER BY saisie_observation.observation."O_NLAT"');

//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
$observation_util_ac_contour = pg_query($bdd, 'SELECT "O_REID", "O_NLA2", "O_NVER", "Statut_Presence", "Statut_Indigenat_Principal", "Statut_Indigenat_Secondaire", "Rarete", "Menace", "Justification_Cotation_Menace", 
										"Usage_Cultural_Principal", "Usage_Cultural_Secondaire", "Frequence_Cultural", "Protection_National_A1", "Protection_National_A2", "Protection_Regional", "Interet_Patrimonial", 
										"LR_Regional", "ZNIEFF", "Indicateur_ZH", "Exotique_Envahissante"
								FROM saisie_observation.observation
								LEFT JOIN menu_deroulant.referentiel_flore ON observation."O_REID" = referentiel_flore."ID_Taxon"
								LEFT JOIN saisie_observation.structure ON observation."O_STRP"::text = structure."S_ID"::text
								WHERE saisie_observation.observation."L_ID"='."'".$L_ID."'".'
								AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
								AND saisie_observation.observation."O_REF2" = '."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".'
								GROUP BY saisie_observation.observation."O_NLAT", "ID_Taxon"
								ORDER BY saisie_observation.observation."O_NLAT"');

//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR								
$observation_obs_ac_contour = pg_query($bdd, 'SELECT "O_REID", "O_NLA2", "O_NVER", "Statut_Presence", "Statut_Indigenat_Principal", "Statut_Indigenat_Secondaire", "Rarete", "Menace", "Justification_Cotation_Menace", 
										"Usage_Cultural_Principal", "Usage_Cultural_Secondaire", "Frequence_Cultural", "Protection_National_A1", "Protection_National_A2", "Protection_Regional", "Interet_Patrimonial", 
										"LR_Regional", "ZNIEFF", "Indicateur_ZH", "Exotique_Envahissante"
									FROM(
										SELECT "O_REID", "O_NLA2", "O_NVER", "Statut_Presence", "Statut_Indigenat_Principal", "Statut_Indigenat_Secondaire", "Rarete", "Menace", "Justification_Cotation_Menace", 
											"Usage_Cultural_Principal", "Usage_Cultural_Secondaire", "Frequence_Cultural", "Protection_National_A1", "Protection_National_A2", "Protection_Regional", "Interet_Patrimonial", 
											"LR_Regional", "ZNIEFF", "Indicateur_ZH", "Exotique_Envahissante"
										FROM saisie_observation.observation
										LEFT JOIN menu_deroulant.referentiel_flore ON observation."O_REID" = referentiel_flore."ID_Taxon"
										LEFT JOIN saisie_observation.localisation ON observation."L_ID"::text = localisation."L_ID"::text
										LEFT JOIN saisie_observation.structure ON st_contains(st_transform(structure.geom,4326),localisation.geom)
										WHERE saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
										AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
										AND saisie_observation.observation."O_REF2" = '."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".'
										UNION ALL
										SELECT "O_REID", "O_NLA2", "O_NVER", "Statut_Presence", "Statut_Indigenat_Principal", "Statut_Indigenat_Secondaire", "Rarete", "Menace", "Justification_Cotation_Menace", 
											"Usage_Cultural_Principal", "Usage_Cultural_Secondaire", "Frequence_Cultural", "Protection_National_A1", "Protection_National_A2", "Protection_Regional", "Interet_Patrimonial", 
											"LR_Regional", "ZNIEFF", "Indicateur_ZH", "Exotique_Envahissante"
										FROM saisie_observation.observation
										LEFT JOIN menu_deroulant.referentiel_flore ON observation."O_REID" = referentiel_flore."ID_Taxon"
										LEFT JOIN saisie_observation.localisation ON observation."O_STRP"::text = localisation."L_STRP"::text
										LEFT JOIN saisie_observation.structure ON observation."O_STRP"::text = structure."S_ID"::text
										WHERE saisie_observation.observation."L_ID"='."'".$L_ID."'".'
										AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
										AND saisie_observation.observation."O_REF2" = '."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".'
									) as obs
								GROUP BY "O_REID", "O_NLA2", "O_NVER", "Statut_Presence", "Statut_Indigenat_Principal", "Statut_Indigenat_Secondaire", "Rarete", "Menace", "Justification_Cotation_Menace", 
										"Usage_Cultural_Principal", "Usage_Cultural_Secondaire", "Frequence_Cultural", "Protection_National_A1", "Protection_National_A2", "Protection_Regional", "Interet_Patrimonial", 
										"LR_Regional", "ZNIEFF", "Indicateur_ZH", "Exotique_Envahissante"');
								
//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
$observation_admin = pg_query($bdd, 'SELECT "O_REID", "O_NLA2", "O_NVER", "Statut_Presence", "Statut_Indigenat_Principal", "Statut_Indigenat_Secondaire", "Rarete", "Menace", "Justification_Cotation_Menace", 
										"Usage_Cultural_Principal", "Usage_Cultural_Secondaire", "Frequence_Cultural", "Protection_National_A1", "Protection_National_A2", "Protection_Regional", "Interet_Patrimonial", 
										"LR_Regional", "ZNIEFF", "Indicateur_ZH", "Exotique_Envahissante"
								FROM saisie_observation.observation
								LEFT JOIN menu_deroulant.referentiel_flore ON observation."O_REID" = referentiel_flore."ID_Taxon"
								LEFT JOIN saisie_observation.localisation ON observation."O_STRP"::text = localisation."L_STRP"::text
								WHERE saisie_observation.observation."L_ID"='."'".$L_ID."'".'
								AND saisie_observation.observation."O_REF2" = '."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".'
								GROUP BY saisie_observation.observation."O_NLAT", "ID_Taxon"
								ORDER BY saisie_observation.observation."O_NLAT"');



$x=2;
if($role == "administrateur"){
	while($resultat = pg_fetch_array($observation_admin)){
		$worksheet->write("A".$x,utf8_decode($resultat['O_REID'])); // ici on va ꤲire une cellules bien dꧩnie
		$worksheet->write("B".$x,utf8_decode($resultat['O_NLA2']));
		$worksheet->write("C".$x,utf8_decode($resultat['O_NVER']));
		$worksheet->write("D".$x,utf8_decode($resultat['Statut_Presence']));
		$worksheet->write("E".$x,utf8_decode($resultat['Statut_Indigenat_Principal']));
		$worksheet->write("F".$x,utf8_decode($resultat['Statut_Indigenat_Secondaire']));
		$worksheet->write("G".$x,utf8_decode($resultat['Rarete']));
		$worksheet->write("H".$x,utf8_decode($resultat['Menace']));
		$worksheet->write("I".$x,utf8_decode($resultat['Justification_Cotation_Menace']));
		$worksheet->write("J".$x,utf8_decode($resultat['Usage_Cultural_Principal']));
		$worksheet->write("K".$x,utf8_decode($resultat['Usage_Cultural_Secondaire']));
		$worksheet->write("L".$x,utf8_decode($resultat['Frequence_Cultural']));
		$worksheet->write("M".$x,utf8_decode($resultat['Protection_National_A1']));
		$worksheet->write("N".$x,utf8_decode($resultat['Protection_National_A2']));
		$worksheet->write("O".$x,utf8_decode($resultat['Protection_Regional']));
		$worksheet->write("P".$x,utf8_decode($resultat['Interet_Patrimonial']));
		$worksheet->write("Q".$x,utf8_decode($resultat['LR_Regional']));
		$worksheet->write("R".$x,utf8_decode($resultat['ZNIEFF']));
		$worksheet->write("S".$x,utf8_decode($resultat['Indicateur_ZH']));
		$worksheet->write("T".$x,utf8_decode($resultat['Exotique_Envahissante']));
		$x++;
	}
}elseif($role == "observateur"){
	 if($count_contour >= 1){
		while($resultat = pg_fetch_array($observation_obs_ac_contour)){
			$worksheet->write("A".$x,utf8_decode($resultat['O_REID'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['O_NLA2']));
			$worksheet->write("C".$x,utf8_decode($resultat['O_NVER']));
			$worksheet->write("D".$x,utf8_decode($resultat['Statut_Presence']));
			$worksheet->write("E".$x,utf8_decode($resultat['Statut_Indigenat_Principal']));
			$worksheet->write("F".$x,utf8_decode($resultat['Statut_Indigenat_Secondaire']));
			$worksheet->write("G".$x,utf8_decode($resultat['Rarete']));
			$worksheet->write("H".$x,utf8_decode($resultat['Menace']));
			$worksheet->write("I".$x,utf8_decode($resultat['Justification_Cotation_Menace']));
			$worksheet->write("J".$x,utf8_decode($resultat['Usage_Cultural_Principal']));
			$worksheet->write("K".$x,utf8_decode($resultat['Usage_Cultural_Secondaire']));
			$worksheet->write("L".$x,utf8_decode($resultat['Frequence_Cultural']));
			$worksheet->write("M".$x,utf8_decode($resultat['Protection_National_A1']));
			$worksheet->write("N".$x,utf8_decode($resultat['Protection_National_A2']));
			$worksheet->write("O".$x,utf8_decode($resultat['Protection_Regional']));
			$worksheet->write("P".$x,utf8_decode($resultat['Interet_Patrimonial']));
			$worksheet->write("Q".$x,utf8_decode($resultat['LR_Regional']));
			$worksheet->write("R".$x,utf8_decode($resultat['ZNIEFF']));
			$worksheet->write("S".$x,utf8_decode($resultat['Indicateur_ZH']));
			$worksheet->write("T".$x,utf8_decode($resultat['Exotique_Envahissante']));
			$x++;
		}
	 }else{
		while($resultat = pg_fetch_array($observation_obs_ss_contour)){
			$worksheet->write("A".$x,utf8_decode($resultat['O_REID'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['O_NLA2']));
			$worksheet->write("C".$x,utf8_decode($resultat['O_NVER']));
			$worksheet->write("D".$x,utf8_decode($resultat['Statut_Presence']));
			$worksheet->write("E".$x,utf8_decode($resultat['Statut_Indigenat_Principal']));
			$worksheet->write("F".$x,utf8_decode($resultat['Statut_Indigenat_Secondaire']));
			$worksheet->write("G".$x,utf8_decode($resultat['Rarete']));
			$worksheet->write("H".$x,utf8_decode($resultat['Menace']));
			$worksheet->write("I".$x,utf8_decode($resultat['Justification_Cotation_Menace']));
			$worksheet->write("J".$x,utf8_decode($resultat['Usage_Cultural_Principal']));
			$worksheet->write("K".$x,utf8_decode($resultat['Usage_Cultural_Secondaire']));
			$worksheet->write("L".$x,utf8_decode($resultat['Frequence_Cultural']));
			$worksheet->write("M".$x,utf8_decode($resultat['Protection_National_A1']));
			$worksheet->write("N".$x,utf8_decode($resultat['Protection_National_A2']));
			$worksheet->write("O".$x,utf8_decode($resultat['Protection_Regional']));
			$worksheet->write("P".$x,utf8_decode($resultat['Interet_Patrimonial']));
			$worksheet->write("Q".$x,utf8_decode($resultat['LR_Regional']));
			$worksheet->write("R".$x,utf8_decode($resultat['ZNIEFF']));
			$worksheet->write("S".$x,utf8_decode($resultat['Indicateur_ZH']));
			$worksheet->write("T".$x,utf8_decode($resultat['Exotique_Envahissante']));
			$x++;
		}
	 }
}elseif($role == "utilisateur"){
	while($resultat = pg_fetch_array($observation_util_ac_contour)){
		$worksheet->write("A".$x,utf8_decode($resultat['O_REID'])); // ici on va ꤲire une cellules bien dꧩnie
		$worksheet->write("B".$x,utf8_decode($resultat['O_NLA2']));
		$worksheet->write("C".$x,utf8_decode($resultat['O_NVER']));
		$worksheet->write("D".$x,utf8_decode($resultat['Statut_Presence']));
		$worksheet->write("E".$x,utf8_decode($resultat['Statut_Indigenat_Principal']));
		$worksheet->write("F".$x,utf8_decode($resultat['Statut_Indigenat_Secondaire']));
		$worksheet->write("G".$x,utf8_decode($resultat['Rarete']));
		$worksheet->write("H".$x,utf8_decode($resultat['Menace']));
		$worksheet->write("I".$x,utf8_decode($resultat['Justification_Cotation_Menace']));
		$worksheet->write("J".$x,utf8_decode($resultat['Usage_Cultural_Principal']));
		$worksheet->write("K".$x,utf8_decode($resultat['Usage_Cultural_Secondaire']));
		$worksheet->write("L".$x,utf8_decode($resultat['Frequence_Cultural']));
		$worksheet->write("M".$x,utf8_decode($resultat['Protection_National_A1']));
		$worksheet->write("N".$x,utf8_decode($resultat['Protection_National_A2']));
		$worksheet->write("O".$x,utf8_decode($resultat['Protection_Regional']));
		$worksheet->write("P".$x,utf8_decode($resultat['Interet_Patrimonial']));
		$worksheet->write("Q".$x,utf8_decode($resultat['LR_Regional']));
		$worksheet->write("R".$x,utf8_decode($resultat['ZNIEFF']));
		$worksheet->write("S".$x,utf8_decode($resultat['Indicateur_ZH']));
		$worksheet->write("T".$x,utf8_decode($resultat['Exotique_Envahissante']));
		$x++;
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////POUR GENERER LONGLET POUR LA LISTE DES ESPECES EAEE/////////////////////
$worksheet =& $workbook->addworksheet('PRAM_Liste_EAEE'); //le param鵲e ici est le nom de la feuille
$worksheet->set_column('A:B', 50); // le 50 repr괥nte la largeur de chaque colonne
$heading  =& $workbook->addformat(array('bold' => 1, // on met le texte en gras
										'color' => 'black', // de couleur noire
									    'size' => 12, // de taille 12
										'merge' => 1)); // avec une marge
									 // 'fg_color' => 0x66));// coloration du fond des cellules
									 
$headings = array('Taxon', 'Nom vernaculaire'); //dꧩnition du texte pour chaque cellules
$worksheet->write_row('A1', $headings, $heading); //On int騲e notre texte et les le format de cellule.
// le premier param鵲e correspond ࡬a cellule o񠬧on souhaite commencer ࡩntꨲer les diff곥nt param鵲e.

//REQUETE POUR RECUPERER LES DONNEES EAEE OU LA STRUCTURE CONNECTEE EST PROPRIETAIRE DES DONNEES
$observation_obs_ss_contour_eaee = pg_query($bdd, 'SELECT "TAXON", "NOM_VERNACULAIRE" 
								FROM saisie_observation.caracterisation, saisie_observation.structure, menu_deroulant.c_eaee, saisie_observation.caracterisation_eaee
								WHERE caracterisation_eaee."EAEE" = c_eaee."ID"
								AND caracterisation_eaee."ID_CARAC" =  caracterisation."ID_CARAC"
								AND caracterisation."C_STRP"::text = structure."S_ID"::text
								AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
								AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
								GROUP BY menu_deroulant.c_eaee."TAXON", "NOM_VERNACULAIRE"
								ORDER BY menu_deroulant.c_eaee."TAXON"');

//REQUETE POUR RECUPERER LES DONNEES EAEE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
$observation_util_ac_contour_eaee = pg_query($bdd, 'SELECT "TAXON", "NOM_VERNACULAIRE" 
								FROM saisie_observation.caracterisation, saisie_observation.structure, menu_deroulant.c_eaee, saisie_observation.caracterisation_eaee
								WHERE caracterisation_eaee."EAEE" = c_eaee."ID"
								AND caracterisation_eaee."ID_CARAC" =  caracterisation."ID_CARAC"
								AND caracterisation."C_STRP"::text = structure."S_ID"::text
								AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
								AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
								GROUP BY menu_deroulant.c_eaee"TAXON", "NOM_VERNACULAIRE"
								ORDER BY menu_deroulant.c_eaee."TAXON"');


//REQUETE POUR RECUPERER LES DONNEES EAEE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR								
$observation_obs_ac_contour_eaee = pg_query($bdd, 'SELECT "TAXON", "NOM_VERNACULAIRE" 
								FROM(
									SELECT "TAXON", "NOM_VERNACULAIRE" 
									FROM saisie_observation.caracterisation, saisie_observation.structure, menu_deroulant.c_eaee, saisie_observation.caracterisation_eaee, saisie_observation.localisation
									WHERE caracterisation_eaee."EAEE" = c_eaee."ID"
									AND caracterisation_eaee."ID_CARAC" =  caracterisation."ID_CARAC"
									AND caracterisation."L_ID" = localisation."L_ID"::text
									AND st_contains(st_transform(structure.geom,4326),localisation.geom)
									AND saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
									AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
									UNION ALL
									SELECT "TAXON", "NOM_VERNACULAIRE" 
									FROM saisie_observation.caracterisation, saisie_observation.structure, menu_deroulant.c_eaee, saisie_observation.caracterisation_eaee
									WHERE caracterisation_eaee."EAEE" = c_eaee."ID"
									AND caracterisation_eaee."ID_CARAC" =  caracterisation."ID_CARAC"
									AND caracterisation."C_STRP"::text = structure."S_ID"::text
									AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
									AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
									) as obs
								GROUP BY "TAXON", "NOM_VERNACULAIRE" ');

//REQUETE POUR RECUPERER LES DONNEES EAEE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
$observation_admin_eaee = pg_query($bdd, 'SELECT "TAXON", "NOM_VERNACULAIRE" 
								FROM saisie_observation.caracterisation, menu_deroulant.c_eaee, saisie_observation.caracterisation_eaee
								WHERE caracterisation_eaee."EAEE" = c_eaee."ID"
								AND caracterisation_eaee."ID_CARAC" =  caracterisation."ID_CARAC"
								AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
								GROUP BY menu_deroulant.c_eaee."TAXON", "NOM_VERNACULAIRE"
								ORDER BY menu_deroulant.c_eaee."TAXON"');

								
$x=2;
if($role == "administrateur"){
	while($resultat = pg_fetch_array($observation_admin_eaee)){
		$worksheet->write("A".$x,utf8_decode($resultat['TAXON'])); // ici on va ꤲire une cellules bien dꧩnie
		$worksheet->write("B".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));
		$x++;
	}
}elseif($role == "observateur"){
	 if($count_contour >= 1){
		while($resultat = pg_fetch_array($observation_obs_ac_contour_eaee)){
			$worksheet->write("A".$x,utf8_decode($resultat['TAXON'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));	
			$x++;
		}
	 }else{
		while($resultat = pg_fetch_array($observation_obs_ss_contour_eaee)){
			$worksheet->write("A".$x,utf8_decode($resultat['TAXON'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));	
			$x++;
		}
	}
}elseif($role == "utilisateur"){
	while($resultat = pg_fetch_array($observation_util_ac_contour_eaee)){
		$worksheet->write("A".$x,utf8_decode($resultat['TAXON'])); // ici on va ꤲire une cellules bien dꧩnie
		$worksheet->write("B".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));	
		$x++;
	}
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////POUR GENERER LONGLET POUR LA LISTE DES ESPECES EVEE/////////////////////
$worksheet =& $workbook->addworksheet('PRAM_Liste_EVEE'); //le param鵲e ici est le nom de la feuille
$worksheet->set_column('A:C', 50); // le 50 repr괥nte la largeur de chaque colonne
$heading  =& $workbook->addformat(array('bold' => 1, // on met le texte en gras
										'color' => 'black', // de couleur noire
									    'size' => 12, // de taille 12
										'merge' => 1)); // avec une marge
									 // 'fg_color' => 0x66));// coloration du fond des cellules
									 
$headings = array('Taxon', 'Nom vernaculaire', 'Pourcentage'); //dꧩnition du texte pour chaque cellules
$worksheet->write_row('A1', $headings, $heading); //On int騲e notre texte et les le format de cellule.
// le premier param鵲e correspond ࡬a cellule o񠬧on souhaite commencer ࡩntꨲer les diff곥nt param鵲e.

//REQUETE POUR RECUPERER LES DONNEES EVEE OU LA STRUCTURE CONNECTEE EST PROPRIETAIRE DES DONNEES
$observation_obs_ss_contour_evee = pg_query($bdd, 'SELECT "TAXON", "NOM_VERNACULAIRE", "POURCENTAGE"
								FROM saisie_observation.caracterisation, saisie_observation.structure, menu_deroulant.c_evee, saisie_observation.caracterisation_evee, menu_deroulant.c_evee_pourcent
								WHERE caracterisation_evee."EVEE" = c_evee."ID"
								AND caracterisation_evee."EVEE_POURCENT" = c_evee_pourcent."ID"
								AND caracterisation_evee."ID_CARAC" =  caracterisation."ID_CARAC"
								AND caracterisation."C_STRP"::text = structure."S_ID"::text
								AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
								AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
								GROUP BY menu_deroulant.c_evee."TAXON", "NOM_VERNACULAIRE", "POURCENTAGE"
								ORDER BY menu_deroulant.c_evee."TAXON"');

//REQUETE POUR RECUPERER LES DONNEES EVEE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
$observation_util_ac_contour_evee = pg_query($bdd, 'SELECT "TAXON", "NOM_VERNACULAIRE", "POURCENTAGE" 
								FROM saisie_observation.caracterisation, saisie_observation.structure, menu_deroulant.c_evee, saisie_observation.caracterisation_evee, menu_deroulant.c_evee_pourcent
								WHERE caracterisation_evee."EVEE" = c_evee."ID"
								AND caracterisation_evee."EVEE_POURCENT" = c_evee_pourcent."ID"
								AND caracterisation_evee."ID_CARAC" =  caracterisation."ID_CARAC"
								AND caracterisation."C_STRP"::text = structure."S_ID"::text
								AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
								AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
								GROUP BY menu_deroulant.c_evee"TAXON", "NOM_VERNACULAIRE", "POURCENTAGE"
								ORDER BY menu_deroulant.c_evee."TAXON"');


//REQUETE POUR RECUPERER LES DONNEES EVEE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR								
$observation_obs_ac_contour_evee = pg_query($bdd, 'SELECT "TAXON", "NOM_VERNACULAIRE", "POURCENTAGE" 
								FROM(
									SELECT "TAXON", "NOM_VERNACULAIRE", "POURCENTAGE" 
									FROM saisie_observation.caracterisation, saisie_observation.structure, menu_deroulant.c_evee, saisie_observation.caracterisation_evee, saisie_observation.localisation, menu_deroulant.c_evee_pourcent
									WHERE caracterisation_evee."EVEE" = c_evee."ID"
									AND caracterisation_evee."EVEE_POURCENT" = c_evee_pourcent."ID"
									AND caracterisation_evee."ID_CARAC" =  caracterisation."ID_CARAC"
									AND caracterisation."L_ID" = localisation."L_ID"::text
									AND st_contains(st_transform(structure.geom,4326),localisation.geom)
									AND saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
									AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
									UNION ALL
									SELECT "TAXON", "NOM_VERNACULAIRE", "POURCENTAGE" 
									FROM saisie_observation.caracterisation, saisie_observation.structure, menu_deroulant.c_evee, saisie_observation.caracterisation_evee, menu_deroulant.c_evee_pourcent
									WHERE caracterisation_evee."EVEE" = c_evee."ID"
									AND caracterisation_evee."EVEE_POURCENT" = c_evee_pourcent."ID"
									AND caracterisation_evee."ID_CARAC" =  caracterisation."ID_CARAC"
									AND caracterisation."C_STRP"::text = structure."S_ID"::text
									AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
									AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
									) as obs
								GROUP BY "TAXON", "NOM_VERNACULAIRE", "POURCENTAGE" ');

//REQUETE POUR RECUPERER LES DONNEES EVEE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
$observation_admin_evee = pg_query($bdd, 'SELECT "TAXON", "NOM_VERNACULAIRE", "POURCENTAGE" 
								FROM saisie_observation.caracterisation, menu_deroulant.c_evee, saisie_observation.caracterisation_evee, menu_deroulant.c_evee_pourcent
								WHERE caracterisation_evee."EVEE" = c_evee."ID"
								AND caracterisation_evee."EVEE_POURCENT" = c_evee_pourcent."ID"
								AND caracterisation_evee."ID_CARAC" =  caracterisation."ID_CARAC"
								AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
								GROUP BY menu_deroulant.c_evee."TAXON", "NOM_VERNACULAIRE", "POURCENTAGE"
								ORDER BY menu_deroulant.c_evee."TAXON"');

								
$x=2;
if($role == "administrateur"){
	while($resultat = pg_fetch_array($observation_admin_evee)){
		$worksheet->write("A".$x,utf8_decode($resultat['TAXON'])); // ici on va ꤲire une cellules bien dꧩnie
		$worksheet->write("B".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));
		$worksheet->write("C".$x,utf8_decode($resultat['POURCENTAGE']));	
		$x++;
	}
}elseif($role == "observateur"){
	 if($count_contour >= 1){
		while($resultat = pg_fetch_array($observation_obs_ac_contour_evee)){
			$worksheet->write("A".$x,utf8_decode($resultat['TAXON'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));	
			$worksheet->write("C".$x,utf8_decode($resultat['POURCENTAGE']));	
			$x++;
		}
	 }else{
		while($resultat = pg_fetch_array($observation_obs_ss_contour_evee)){
			$worksheet->write("A".$x,utf8_decode($resultat['TAXON'])); // ici on va ꤲire une cellules bien dꧩnie
			$worksheet->write("B".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));	
			$worksheet->write("C".$x,utf8_decode($resultat['POURCENTAGE']));	
			$x++;
		}
	 }
}elseif($role == "utilisateur"){
	while($resultat = pg_fetch_array($observation_util_ac_contour_evee)){
		$worksheet->write("A".$x,utf8_decode($resultat['TAXON'])); // ici on va ꤲire une cellules bien dꧩnie
		$worksheet->write("B".$x,utf8_decode($resultat['NOM_VERNACULAIRE']));	
		$worksheet->write("C".$x,utf8_decode($resultat['POURCENTAGE']));	
		$x++;
	}
}


$workbook->close(); // on ferme le fichier Excel cr�er

?>
<div id="textafficahge">
<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>	
<h3>Liste espèce faune / flore : </h3>
	<?php if(isset($droitbloquee)){ ?>
		<div id="resultat">
			<?php echo $droitbloquee; ?>
		</div>
	<?php }else{ ?>
		<div id="resultat">
		<p><b><a href="mare/pram_liste_espece.xls">Télécharger le fichier</a></b><p>
		</div>
	<?php } ?>
</div>
<div id="piedaffichage">
	<table align="center" width="100%" border="0">
		<tr>
			<td>
				<!--<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>
						</tr>
					</table>
				</fieldset>-->
			</td>
		</tr>
	</table>
</div>