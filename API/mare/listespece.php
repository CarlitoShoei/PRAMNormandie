<?php
include '../../bdd.php';
include '../../function.php';

$ordre = $_GET['ordre'];

if($ordre == 'flore'){
	$listflore = array();
	$req = pg_query($bdd, 'SELECT "Nom_Complet" AS "TAXON" FROM menu_deroulant.referentiel_flore'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listflore, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	echo simpleDisplaySelectOnBlur($listflore, 'O_NLAT', 'TAXON', 'TAXON', '', '', 81, 'verifchampSelect2(this)');
}elseif($ordre == 'odonate'){
	$listeodonate = array();
	$req = pg_query($bdd, 'SELECT "TAXON" AS "TAXON" FROM menu_deroulant.referentiel_faune WHERE "ORDRE" = '."'Odonata'".''); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listeodonate, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	echo simpleDisplaySelectOnBlur($listeodonate, 'O_NLAT', 'TAXON', 'TAXON', '', '', 81, 'verifchampSelect2(this)');
}elseif($ordre == 'amphibien'){
	$listeamphibien = array();
	$req = pg_query($bdd, 'SELECT "TAXON" AS "TAXON" FROM menu_deroulant.referentiel_faune WHERE "ORDRE" = '."'Amphibia'".''); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listeamphibien, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	echo simpleDisplaySelectOnBlur($listeamphibien, 'O_NLAT', 'TAXON', 'TAXON', '', '', 81, 'verifchampSelect2(this)');
}
?>