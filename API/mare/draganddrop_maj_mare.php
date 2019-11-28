<?php
	// header('Content-type: text/html; charset=iso8859-1');
	// header('Content-type: text/html; charset=utf-8');
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES VARAIBLE
			$newlongitude = $_GET['newlongitude'];
			$newlatitude = $_GET['newlatitude'];
			$lid = $_GET['lid'];
			$L_COOX93 = number_format(ConvertCoord(floatval($newlongitude), floatval($newlatitude), 'X'), 2, '.', '');
			$L_COOY93 = number_format(ConvertCoord(floatval($newlongitude), floatval($newlatitude), 'Y'), 2, '.', '');
			
			//SEUL LA STRUCTURE CONNECTER PEUT DEPLACER CES MARE DONC ON VA ALLER VERIFIER SI LA STRUCUTURE CONNECTER = STRUCUTRE DE LA LOCALISATION DE LA MARE
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE "L_ID"='."'".$lid."'".''); 
			$donnees = pg_fetch_array($req);
			
			//SI LA MARE EST DANS LA MEME COMMUNE ALORS ON NE CHANGE PAS LIDENTIFIANT SINON OUI
			if($donnees['L_ADMIN'] == insseCommune($bdd, floatval($newlongitude), floatval($newlatitude))){
				$L_ID = $donnees['L_ID'];
			}else{
				//REQUETE POUR GENRER IDENTIFIANT UNIQUE
				$L_ID = generatorIdentifiantMare(insseCommune($bdd, floatval($newlongitude), floatval($newlatitude)),$bdd);
			}
			// requete mysql pour la mise a jour :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rq = pg_query($bdd, 'UPDATE saisie_observation.localisation SET
														"L_ID" = '."'".$L_ID."'".',
														"L_COOX" = '."'".floatval($newlongitude)."'".',
														"L_COOY" = '."'".floatval($newlatitude)."'".',
														"L_COOX93" = '."'".floatval($L_COOX93)."'".',
														"L_COOY93" = '."'".floatval($L_COOY93)."'".',
														"L_ADMIN" = '."'".insseCommune($bdd, floatval($newlongitude), floatval($newlatitude))."'".',
														"geom" = ST_SetSRID(ST_MakePoint('."'".$newlongitude."'".', '."'".$newlatitude."'".'),4326)
														WHERE "L_ID"='."'".$lid."'".'');
			
			$rq_loca_photo = pg_query($bdd, 'UPDATE saisie_observation.localisation_photo SET
														"L_ID" = '."'".$L_ID."'".'
														WHERE "L_ID"='."'".$lid."'".'');
														
			$rq_carac = pg_query($bdd, 'UPDATE saisie_observation.caracterisation SET
														"L_ID" = '."'".$L_ID."'".'
														WHERE "L_ID"='."'".$lid."'".'');
			
			$rq_carac_photo = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_photo SET
														"L_ID" = '."'".$L_ID."'".'
														WHERE "L_ID"='."'".$lid."'".'');
			
			$rq_carac_schema = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_schema SET
														"L_ID" = '."'".$L_ID."'".'
														WHERE "L_ID"='."'".$lid."'".'');
														
			$rq_observation = pg_query($bdd, 'UPDATE saisie_observation.observation SET
														"L_ID" = '."'".$L_ID."'".'
														WHERE "L_ID"='."'".$lid."'".'');
?>