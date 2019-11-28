<?php
	//Demare la session
	session_start();
	//connection BDD
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES VARAIBLES
	$ID = $_GET['ID'];
	$Session = $_GET['Session'];
	$role = $_GET['role'];
	$id_structure_conectee = $_GET['id_structure_conectee'];
	
	//REQUETE POUR ALLER CHERCHER L'IDENDIFIANT DE LA STRUCTURE
	$idstructure = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.structure
										WHERE saisie_observation.structure."S_ID_SESSION"='."'".$id_structure_conectee."'".''); 
	$donnees_idstructure = pg_fetch_array($idstructure);
	
	//REQUETE SQL POUR CHERCHER LA MARE EN QUESTION
	$mare_localisation = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.localisation, saisie_observation.localisation_photo
										WHERE saisie_observation.localisation."L_ID" = saisie_observation.localisation_photo."L_ID"
										AND saisie_observation.localisation_photo."ID"='."'".$ID."'".''); 
	$donnees_loca = pg_fetch_array($mare_localisation);
	

	if($role == 'administrateur' || ($donnees_idstructure['S_ID'] == $donnees_loca['L_STRP'])){
		$rep_sup = pg_query($bdd, 'DELETE FROM saisie_observation.localisation_photo WHERE "ID"='."'".$ID."'".'');		
	}

?>