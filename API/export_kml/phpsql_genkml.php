<?php
	$Identifiant_Session =$_GET['Identifiant_Session'];
	
	// require ('phpsqlajax_dbinfo.php'); 
	include '../../bdd.php';
	
	//ON VA FAIRE UNE REQUETE POUR VOIT SI LA STRUCUTRE POSSEDE UN CONTOUR GEOGRAPHIQUE DANS LA TABLE CONTOUR_STRUCTURE
	$req_contour_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "STRUCTURE"='."'".$Identifiant_Session."'".' AND geom is Not Null');
	$count_contour = pg_num_rows($req_contour_structure);
	
	$req_structure_id = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$Identifiant_Session."'".' AND geom is Not Null');
	$donnees_structure_id = pg_fetch_array($req_structure_id);
	$id_structure_connectee = $donnees_structure_id["S_ID"];
	
	//ON VA FAIRE UNE REQUETE POUR DETERMINER LE ROLE DE LA STRUCTURE
	$req_role_structure = pg_query($bdd, 'SELECT "ROLE" FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$Identifiant_Session."'".'');
	$role_structure = pg_fetch_array($req_role_structure);

	//SI role = administrateur alors on a le droit de tout voir
	if($role_structure['ROLE'] == "administrateur"){
		$req = pg_query($bdd, 'SELECT * 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT" = menu_deroulant.l_statut."ID"::text
									AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
									AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
									AND saisie_observation.localisation."L_STRP" = saisie_observation.structure."S_ID"::text 
									ORDER BY saisie_observation.localisation."L_ID"');	
	}elseif($role_structure['ROLE'] == "observateur"){
		if($count_contour == 1){
			$req = pg_query($bdd, 'SELECT * 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT" = menu_deroulant.l_statut."ID"::text
									AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
									AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$Identifiant_Session."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_connectee."'".'))
									ORDER BY saisie_observation.localisation."L_ID"');
		}else{
			//requete sql
			$req = pg_query($bdd, 'SELECT * 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT" = menu_deroulant.l_statut."ID"::text
									AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
									AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
									AND saisie_observation.localisation."L_STRP" = saisie_observation.structure."S_ID"::text 
									AND saisie_observation.structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'
									ORDER BY saisie_observation.localisation."L_ID"');
		}
	}elseif($role_structure['ROLE'] == "utilisateur"){
			$req = pg_query($bdd, 'SELECT * 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT" = menu_deroulant.l_statut."ID"::text
									AND saisie_observation.localisation."L_PROP" = menu_deroulant.l_propr."ID"::text
									AND saisie_observation.localisation."L_OBSV" = saisie_observation.observateur."ID"::text
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"::text
									AND saisie_observation.localisation."L_STRP" = saisie_observation.structure."S_ID"::text 
									AND saisie_observation.structure."S_ID_SESSION" = '."'".$Identifiant_Session."'".'
									ORDER BY saisie_observation.localisation."L_ID"');	
	}

// Creates the Document.
$dom = new DOMDocument('1.0', 'UTF-8');

// Creates the root KML element and appends it to the root document.
$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
$parNode = $dom->appendChild($node);

// Creates a KML Document element and append it to the KML element.
$dnode = $dom->createElement('Document');
$docNode = $parNode->appendChild($dnode);

// Creates the two Style elements, one for restaurant and one for bar, and append the elements to the Document element.
$restStyleNode = $dom->createElement('Style');
$restStyleNode->setAttribute('id', 'restaurantStyle');
$restIconstyleNode = $dom->createElement('IconStyle');
$restIconstyleNode->setAttribute('id', 'restaurantIcon');
$restIconNode = $dom->createElement('Icon');
$restHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/pal2/icon63.png');
$restIconNode->appendChild($restHref);
$restIconstyleNode->appendChild($restIconNode);
$restStyleNode->appendChild($restIconstyleNode);
$docNode->appendChild($restStyleNode);

$barStyleNode = $dom->createElement('Style');
$barStyleNode->setAttribute('id', 'barStyle');
$barIconstyleNode = $dom->createElement('IconStyle');
$barIconstyleNode->setAttribute('id', 'barIcon');
$barIconNode = $dom->createElement('Icon');
$barHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/pal2/icon27.png');
$barIconNode->appendChild($barHref);
$barIconstyleNode->appendChild($barIconNode);
$barStyleNode->appendChild($barIconstyleNode);
$docNode->appendChild($barStyleNode);

// Iterates through the MySQL results, creating one Placemark for each row.
while($row = pg_fetch_array($req))
{
  // Creates a Placemark and append it to the Document.

  $node = $dom->createElement('Placemark');
  $placeNode = $docNode->appendChild($node);

  // Creates an id attribute and assign it the value of id column.
  $placeNode->setAttribute('id', 'placemark' . $row['L_ID']);

  // Create name, and description elements and assigns them the values of the name and address columns from the results.
  $nameNode = $dom->createElement('name',htmlentities($row['L_ID']));
  $placeNode->appendChild($nameNode);
  $descNode = $dom->createElement('description', 'Code INSEE : '.$row['L_ADMIN'].'
																</br>Commune : '.$row['Nom_Commune'].'
																</br>Statut : '.$row['STATUT'].'
																</br>Date de localisation : '.date('d/m/Y', $row['L_DATE']).'
																</br>Observateur : '.$row['OBS_NOM_PRENOM'].'
																</br>Strucutre : '.$row['STRUCTURE'].'
																</br>Propriété '.$row['PROPR'].'
																</br>Commentaire : '.$row['C_COMT']);
  $placeNode->appendChild($descNode);
  $styleUrl = $dom->createElement('styleUrl', '#' . $row['L_STRP'] . 'Style');
  $placeNode->appendChild($styleUrl);

  // Creates a Point element.
  $pointNode = $dom->createElement('Point');
  $placeNode->appendChild($pointNode);

  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
  $coorStr = $row['L_COOX'] . ','  . $row['L_COOY'];
  $coorNode = $dom->createElement('coordinates', $coorStr);
  $pointNode->appendChild($coorNode);
}

$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;
?>
