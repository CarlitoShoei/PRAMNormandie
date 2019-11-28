<?php
include '../../bdd.php';
include '../../function.php';

$ordre = $_GET['ordre'];

if($ordre == 'flore'){
	$listSacq= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.o_sacq WHERE "GP_FAUNE" like '."'%".$ordre."%'".' ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listSacq, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	echo simpleDisplaySelect($listSacq, 'O_SACQ', 'ID', 'SACQ', '', 'verifchampSelect2(this)', 69);
}elseif($ordre == 'odonate'){
	$listSacq= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.o_sacq WHERE "GP_FAUNE" like '."'%".$ordre."%'".' ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listSacq, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	echo simpleDisplaySelect($listSacq, 'O_SACQ', 'ID', 'SACQ', '', 'verifchampSelect2(this)', 69);
}elseif($ordre == 'amphibien'){
	$listSacq= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.o_sacq WHERE "GP_FAUNE" like '."'%".$ordre."%'".' ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listSacq, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	echo simpleDisplaySelect($listSacq, 'O_SACQ', 'ID', 'SACQ', '', 'verifchampSelect2(this)', 69);
}
?>