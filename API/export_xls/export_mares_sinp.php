<?php 
date_default_timezone_set('Europe/Paris');
ini_set('max_execution_time', 72000000);
ini_set("display_errors",0);
error_reporting(E_ALL ^ E_DEPRECATED);

// header('Content-type: text/html; charset=UTF-8'); 
// header('Content-type: text/html; charset=iso8859-1'); 
//on rÍ§µpÍ≥• les varaible
$Identifiant_Session = $_GET['Identifiant_Session'];
// On se connecte ‡ la base de donnÈes
include '../../bdd.php';
require_once "../../php_writeexcel/class.writeexcel_workbook.inc.php";
require_once "../../php_writeexcel/class.writeexcel_worksheet.inc.php";

//REQUETE POUR RECUPERER IDENTIFIANT DE LA STRUCTURE
$req_structure_id = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$Identifiant_Session."'".'');
$donnees_structure_id = pg_fetch_array($req_structure_id);
$id_structure_connectee = $donnees_structure_id['S_ID'];

//ON VA FAIRE UNE REQUETE POUR VOIT SI LA STRUCUTRE POSSEDE UN CONTOUR GEOGRAPHIQUE DANS LA TABLE CONTOUR_STRUCTURE
$req_contour_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$Identifiant_Session."'".' AND geom is Not Null');
$count_contour = pg_num_rows($req_contour_structure);

//ON VA FAIRE UNE REQUETE POUR DETERMINER LE ROLE DE LA STRUCTURE
$req_role_structure = pg_query($bdd, 'SELECT "ROLE" FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$Identifiant_Session."'".'');
$role_structure = pg_fetch_array($req_role_structure);

//////////////////////////////////////////////POUR CREER LE FICHIER OBSERVATION////////////////////////////////////////////////////////////
//On indique ensuite un emplacement sur le serveur, l‡ o˘ sera stockÈ le fichier
$fname = "OBHN-".date('ymd')."-SINPHNv2.2-OBSERVATION.xls";
$workbook = new writeexcel_workbook($fname); // on lui passe en paramËtre le chemin de notre fichier


/////////////////////////////POUR GENERER LONGLET OBSERVATIONS/////////////////////////////////
$worksheet =& $workbook->addworksheet('OBSERVATION'); //le paramËtre ici est le nom de la feuille
$worksheet->set_column('A:O', 50); // le 30 reprÈsente la largeur de chaque colonne
$heading  =& $workbook->addformat(array('bold' => 1, // on met le texte en gras
										'color' => 'black', // de couleur noire
									    'size' => 12, // de taille 12
										'merge' => 1)); // avec une marge
									 // 'fg_color' => 0x66));// coloration du fond des cellules

$headings = array('O_REID', 'O_REFE', 'O_REI2', 'O_REF2', 'O_NBRE', 'O_NBRT', 'O_ADMI', 'O_SITU', 'O_DATE', 'O_OBSV', 'O_STRP', 'O_SACQ', 'O_ID', 'O_DCNP'); //dÈfinition du texte pour chaque cellules
$worksheet->write_row('A1', $headings, $heading); //On intËgre notre texte et les le format de cellule.
// le premier paramËtre correspond ‡ la cellule o˘ l'on souhaite commencer ‡ intÈgrer les diffÈrent paramËtre.




if($role_structure['ROLE'] == "administrateur"){
	$req_filtre = pg_query($bdd, 'SELECT observation."O_ID_UNIQUE", observation."L_ID",  observation."O_DATE", observation."O_REFE", observation."O_NLAT", observation."O_REID", observation."O_NVER", 
								   observation."O_REF2", observation."O_NLA2", observation."O_REI2", observation."O_NBRE", observation."O_NBRT", o_sacq."SACQ", structure."DCNP",
								   observation."O_ID", observateur."OBS_NOM_PRENOM", "O_STRP", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "O_STRP"::text), o_styp."STYP", localisation."L_ADMIN"
								   FROM saisie_observation.observation, menu_deroulant.o_sacq, saisie_observation.observateur, saisie_observation.structure, menu_deroulant.o_styp, saisie_observation.localisation
							WHERE observation."O_SACQ" = o_sacq."ID"
							AND observation."O_OBSV" = observateur."ID"
							AND observation."O_STYP" = o_styp."ID"
							AND observation."O_STRP" = structure."S_ID"
							AND observation."L_ID" = localisation."L_ID"
							ORDER BY observation."L_ID"');
}elseif($role_structure['ROLE'] == "observateur"){
	if($count_contour == 1){
		$req_filtre = pg_query($bdd, 'SELECT observation."O_ID_UNIQUE", observation."L_ID",  observation."O_DATE", observation."O_REFE", observation."O_NLAT", observation."O_REID", observation."O_NVER", 
								   observation."O_REF2", observation."O_NLA2", observation."O_REI2", observation."O_NBRE", observation."O_NBRT", o_sacq."SACQ", structure."DCNP",
								   observation."O_ID", observateur."OBS_NOM_PRENOM", "O_STRP", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "O_STRP"::text), o_styp."STYP", localisation."L_ADMIN"
								   FROM saisie_observation.observation, menu_deroulant.o_sacq, saisie_observation.observateur, saisie_observation.structure, menu_deroulant.o_styp, saisie_observation.localisation
							WHERE observation."O_SACQ" = o_sacq."ID"
							AND observation."O_OBSV" = observateur."ID"
							AND observation."O_STYP" = o_styp."ID"
							AND observation."L_ID" = localisation."L_ID"
							AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
							AND "S_ID_SESSION"='."'".$Identifiant_Session."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID"::text = '."'".$id_structure_connectee."'".'))
							ORDER BY observation."L_ID"');

	}else{
		$req_filtre = pg_query($bdd, 'SELECT observation."O_ID_UNIQUE", observation."L_ID",  observation."O_DATE", observation."O_REFE", observation."O_NLAT", observation."O_REID", observation."O_NVER", 
								   observation."O_REF2", observation."O_NLA2", observation."O_REI2", observation."O_NBRE", observation."O_NBRT", o_sacq."SACQ", structure."DCNP", 
								   observation."O_ID", observateur."OBS_NOM_PRENOM", "O_STRP", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "O_STRP"::text), o_styp."STYP", localisation."L_ADMIN"
								   FROM saisie_observation.observation, menu_deroulant.o_sacq, saisie_observation.observateur, saisie_observation.structure, menu_deroulant.o_styp, saisie_observation.localisation
							WHERE observation."O_SACQ" = o_sacq."ID"
							AND observation."O_OBSV" = observateur."ID"
							AND observation."O_STYP" = o_styp."ID"
							AND observation."L_ID" = localisation."L_ID"
							AND observation."O_STRP" = saisie_observation.structure."S_ID"
							AND structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'
							ORDER BY observation."L_ID"');
	}
}elseif($role_structure['ROLE'] == "utilisateur"){
	$req_filtre = pg_query($bdd, 'SELECT observation."O_ID_UNIQUE", observation."L_ID",  observation."O_DATE", observation."O_REFE", observation."O_NLAT", observation."O_REID", observation."O_NVER", 
								   observation."O_REF2", observation."O_NLA2", observation."O_REI2", observation."O_NBRE", observation."O_NBRT", o_sacq."SACQ", structure."DCNP", 
								   observation."O_ID", observateur."OBS_NOM_PRENOM", "O_STRP", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "O_STRP"::text), o_styp."STYP", localisation."L_ADMIN"
								   FROM saisie_observation.observation, menu_deroulant.o_sacq, saisie_observation.observateur, saisie_observation.structure, menu_deroulant.o_styp, saisie_observation.localisation
							WHERE observation."O_SACQ" = o_sacq."ID"
							AND observation."O_OBSV" = observateur."ID"
							AND observation."O_STYP" = o_styp."ID"
							AND observation."L_ID" = localisation."L_ID"
							AND observation."O_STRP" = saisie_observation.structure."S_ID"
							AND structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'
							ORDER BY observation."L_ID"');
}

$x=2;
while($resultat = pg_fetch_array($req_filtre)){
	$worksheet->write("A".$x,$resultat['O_REID']); // ici on va Ècrire une cellules bien dÈfinie
	$worksheet->write("B".$x,$resultat['O_REFE']);
	$worksheet->write("C".$x,$resultat['O_REI2']);
	$worksheet->write("D".$x,$resultat['O_REF2']);
	$worksheet->write("E".$x,$resultat['O_NBRE']);
	$worksheet->write("F".$x,utf8_decode($resultat['O_NBRT']));
	$worksheet->write("G".$x,$resultat['L_ADMIN']);
	// $worksheet->write("H".$x,$resultat['L_COOX93']);
	// $worksheet->write("I".$x,$resultat['L_COOY93']);
	$worksheet->write("H".$x,"IDS-SINPHN-CENHN-".$resultat['L_ID']);
	$worksheet->write("I".$x,date('d/m/Y',$resultat['O_DATE']));
	$worksheet->write("J".$x,utf8_decode($resultat['OBS_NOM_PRENOM']));
	$worksheet->write("K".$x,utf8_decode($resultat['STRUCTURE']));
	$worksheet->write("L".$x,utf8_decode($resultat['SACQ']));
	$worksheet->write("M".$x,$resultat['O_ID']."-".$resultat['O_ID_UNIQUE']);
	$worksheet->write("N".$x,$resultat['DCNP']);
	$x++;
}




$workbook->close(); // on ferme le fichier Excel crÈer










//////////////////////////////////////////////POUR CREER LE FICHIER SITUATION////////////////////////////////////////////////////////////
//On indique ensuite un emplacement sur le serveur, l‡°ØÒ†≥•ra stockÈ°¨e fichier
$fnamesit = "OBHN-".date('ymd')."-SINPHNv2.2-SITUATION.xls";
$workbooksit = new writeexcel_workbook($fnamesit); // on lui passe en paramÈµ≤e le chemin de notre fichier


/////////////////////////////POUR GENERER LONGLET OBSERVATIONS/////////////////////////////////
$worksheetsit =& $workbooksit->addworksheet('OBSERVATION'); //le paramÈµ≤e ici est le nom de la feuille
$worksheetsit->set_column('A:O', 50); // le 30 reprÍ¥•nte la largeur de chaque colonne
$headingsit  =& $workbooksit->addformat(array('bold' => 1, // on met le texte en gras
										'color' => 'black', // de couleur noire
									    'size' => 12, // de taille 12
										'merge' => 1)); // avec une marge
									 // 'fg_color' => 0x66));// coloration du fond des cellules

$headingssit = array('S_ID', 'S_STYP', 'S_PREC', 'S_COOX', 'S_COOY'); //dÍß©nition du texte pour chaque cellules
$worksheetsit->write_row('A1', $headingssit, $headingsit); //On intÈ®≤e notre texte et les le format de cellule.
// le premier paramÈµ≤e correspond ‡°¨a cellule oÒ†¨ßon souhaite commencer ‡°©ntÍ®≤er les diffÍ≥•nt paramÈµ≤e.




if($role_structure['ROLE'] == "administrateur"){
	$req_filtresit = pg_query($bdd, 'SELECT localisation."L_STYP", localisation."L_COOX93", localisation."L_COOY93", localisation."L_PREC", localisation."L_ID"
							FROM saisie_observation.observation, menu_deroulant.o_sacq, saisie_observation.observateur, saisie_observation.structure, menu_deroulant.o_styp, saisie_observation.localisation
							WHERE observation."O_SACQ" = o_sacq."ID"
							AND observation."O_OBSV" = observateur."ID"
							AND observation."O_STYP" = o_styp."ID"
							AND observation."O_STRP" = structure."S_ID"
							AND observation."L_ID" = localisation."L_ID"
							ORDER BY observation."L_ID"');
}elseif($role_structure['ROLE'] == "observateur"){
	if($count_contour == 1){
		$req_filtresit = pg_query($bdd, 'SELECT localisation."L_STYP", localisation."L_COOX93", localisation."L_COOY93", localisation."L_PREC", localisation."L_ID"
							FROM saisie_observation.observation, menu_deroulant.o_sacq, saisie_observation.observateur, saisie_observation.structure, menu_deroulant.o_styp, saisie_observation.localisation
							WHERE observation."O_SACQ" = o_sacq."ID"
							AND observation."O_OBSV" = observateur."ID"
							AND observation."O_STYP" = o_styp."ID"
							AND observation."L_ID" = localisation."L_ID"
							AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
							AND "S_ID_SESSION"='."'".$Identifiant_Session."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID"::text = '."'".$id_structure_connectee."'".'))
							ORDER BY observation."L_ID"');

	}else{
		$req_filtresit = pg_query($bdd, 'SELECT localisation."L_STYP", localisation."L_COOX93", localisation."L_COOY93", localisation."L_PREC", localisation."L_ID"
							FROM saisie_observation.observation, menu_deroulant.o_sacq, saisie_observation.observateur, saisie_observation.structure, menu_deroulant.o_styp, saisie_observation.localisation
							WHERE observation."O_SACQ" = o_sacq."ID"
							AND observation."O_OBSV" = observateur."ID"
							AND observation."O_STYP" = o_styp."ID"
							AND observation."L_ID" = localisation."L_ID"
							AND observation."O_STRP" = saisie_observation.structure."S_ID"
							AND structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'
							ORDER BY observation."L_ID"');
	}
}elseif($role_structure['ROLE'] == "utilisateur"){
	$req_filtresit = pg_query($bdd, 'SELECT localisation."L_STYP", localisation."L_COOX93", localisation."L_COOY93", localisation."L_PREC", localisation."L_ID"
							FROM saisie_observation.observation, menu_deroulant.o_sacq, saisie_observation.observateur, saisie_observation.structure, menu_deroulant.o_styp, saisie_observation.localisation
							WHERE observation."O_SACQ" = o_sacq."ID"
							AND observation."O_OBSV" = observateur."ID"
							AND observation."O_STYP" = o_styp."ID"
							AND observation."L_ID" = localisation."L_ID"
							AND observation."O_STRP" = saisie_observation.structure."S_ID"
							AND structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'
							ORDER BY observation."L_ID"');
}

$x=2;
while($resultatsit = pg_fetch_array($req_filtresit)){
	$worksheetsit->write("A".$x,"IDS-SINPHN-CENHN-".$resultatsit['L_ID']);; // ici on va Í§≤ire une cellules bien dÍß©nie
	$worksheetsit->write("B".$x,utf8_decode($resultatsit['L_STYP']));
	$worksheetsit->write("C".$x,utf8_decode($resultatsit['L_PREC']));
	$worksheetsit->write("D".$x,number_format($resultatsit['L_COOX93']/1000, 3));
	$worksheetsit->write("E".$x,number_format($resultatsit['L_COOY93']/1000, 3));
	
	$x++;
}




$workbooksit->close(); // on ferme le fichier Excel crÍ¶≤

?>

<a href=<?php echo "OBHN-".date('ymd')."-SINPHNv2.2-OBSERVATION.xls" ?>>T√©l√©charger le fichier des observations</a><br/><br/><br/>
<a href=<?php echo "OBHN-".date('ymd')."-SINPHNv2.2-SITUATION.xls" ?>>T√©l√©charger le fichier des situations</a>