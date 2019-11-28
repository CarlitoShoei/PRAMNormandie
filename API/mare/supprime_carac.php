<!-- On se connecte à la base de données -->
<?php
	include '../../bdd.php';

	$ID_CARAC = $_GET['ID_CARAC'];
	$Session = $_GET['Session'];
	
	//ETANT DONNER QUE ON SUPPRIME UNE CARACTERISATION A UNE MARE IL FAUT QUE ON PASSE SON STAUT EN MARE VUE
	//ON VA RECHERCHER L'IDENTIFIANT DE LA MARE PAR REQUETE
	$req_l_id = pg_query($bdd, 'SELECT "L_ID" FROM saisie_observation.caracterisation WHERE "ID_CARAC" = '."'".$ID_CARAC."'".''); 
	$donnees_l_id = pg_fetch_array($req_l_id);
	$L_ID = $donnees_l_id['L_ID'];
	
	$rep_sup = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
	$rep_sup2 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_alimentation WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
	$rep_sup3 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_context WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
	$rep_sup4 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_dechets WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
	$rep_sup5 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_eaee WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
	$rep_sup6 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_evee WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
	$rep_sup7 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_faune WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');	
	$rep_sup8 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_liaison WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');	
	$rep_sup10 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_photo WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');	
	$rep_sup11 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_schema WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');	
	$rep_sup12 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_travaux WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');	
	$rep_sup13 = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_usage WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');	
	
	
	//ON FAIT UNE VERIFICATION SI LA MARE POSSEDE ENCORE UNE CARACTERISATION ALORS ON LAISSE LE STATUT A CARACTERISER SINON ON LE MET EN VU
	$req_count_carac = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation WHERE "L_ID" = '."'".$L_ID."'".' AND "C_DATE" <> '."'943920000'".' AND "C_DATE" is not Null'); 
	$count = pg_num_rows($req_count_carac);
	//SI COUNT == 0 ALORS ON FAIT LA MISE A JOUR DU STATUT EN VU
	if($count == 0){
		//MISE A JOUR DE LA TABLE LOCALISATION AVEC LE STATUT DE VUE
		$rq = pg_query($bdd, 'UPDATE saisie_observation.localisation SET 
					"L_STATUT" = '."'3'".'
					WHERE "L_ID" = '."'".$L_ID."'".'');
	}
?>