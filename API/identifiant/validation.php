<?php
	// header( 'content-type: text/html; charset=utf-8' );
	// header('Content-type: text/html; charset=iso8859-1');
	include '../../bdd.php';
	//ON RECUPERE LES VARIABLE
	$valide = $_GET['valide'];
	$email = $_GET['email'];
	$id_session = $_GET['id_session'];
	$mdp = $_GET['mdp'];
		
		
	//SI valide �gale oui
	if($valide == 'oui'){
		//ON RECUPERE LES VARAIBLE EN POST
		$role = $_POST['role'];
		$identifiant_sinp = $_POST['identifiant_sinp'];
		$dcnp = $_POST['dcnp'];
		//REQUET DE MISE 0 JOUR SUR LA TABLE
		//CREER LA REQUETE DANS UNE VARIABLE A PART
		$rq = pg_query($bdd, 'UPDATE saisie_observation.structure SET "S_VALIDATION" = '."'1'".', "ROLE"='."'".$role."'".', "ID_SINP"='."'".$identifiant_sinp."'".', "DCNP"='."'".$dcnp."'".' WHERE "S_EMAIL"='."'".$email."'".' AND "S_ID_SESSION"='."'".$id_session."'".' AND "S_MDP"='."'".$mdp."'".'');
		
		
		
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui présentent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "Bonjour votre compte en ligne sur l'application PRAM Normandie a été validé.</br></br/>Vous pouvez désormais vous connecter et saisir des mares.</br></br/><b>En pièce jointe, vous trouvererez un manuel d'utilisation</b></br></br>Restant à votre disposition,<br/><br/>Cordialement l'équipe du PRAM.";
		$message_html = "<html><head></head><body>Bonjour votre compte en ligne sur l'application PRAM Normandie a été validé.</br></br/>Vous pouvez désormais vous connecter et saisir des mares.</br></br/><b>En pièce jointe, vous trouvererez un manuel d'utilisation</b></br></br>Restant à votre disposition,<br/><br/>Cordialement l'équipe du PRAM.</body></html>";
		//==========
		
		if($role == "observateur"){		
			//=====Lecture et mise en forme de la pièce jointe.
			$fichier   = fopen("../../doc/Manuel_Utilisation_PRAM.pdf", "r");
			$attachement = fread($fichier, filesize("../../doc/Manuel_Utilisation_PRAM.pdf"));
			$attachement = chunk_split(base64_encode($attachement));
			fclose($fichier);
			//==========
		}else if($role == "utilisateur"){
			//=====Lecture et mise en forme de la pièce jointe.
			$fichier   = fopen("../../doc/Manuel_Utilisation_PRAM.pdf", "r");
			$attachement = fread($fichier, filesize("../../doc/Manuel_Utilisation_PRAM.pdf"));
			$attachement = chunk_split(base64_encode($attachement));
			fclose($fichier);		
		}else if($role == "administrateur"){
			//=====Lecture et mise en forme de la pièce jointe.
			$fichier   = fopen("../../doc/Manuel_Utilisation_PRAM.pdf", "r");
			$attachement = fread($fichier, filesize("../../doc/Manuel_Utilisation_PRAM.pdf"));
			$attachement = chunk_split(base64_encode($attachement));
			fclose($fichier);		
		}
		 
		//=====Création de la boundary.
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========
		 
		//=====Définition du sujet.
		$Objet = "[PRAM Validation] Demande d'identifiant pour l'application PRAM";
		//=========
		 
		//=====Création du header de l'e-mail.
		$header = "From: 'PRAM API'<".$maildemandeidentification.">".$passage_ligne;
		$header.= "Reply-To: ".$mailnepasrepondre.$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		 
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========
		 
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		 
		//=====Ajout du message au format HTML.
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========
		 
		//=====On ferme la boundary alternative.
		$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		//==========
		 
		 
		 
		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		
		
		//=====Ajout de la pièce jointe.
		$message.= "Content-Type: pdf/pdf; name=\"guide_utilisation.pdf\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
		$message.= "Content-Disposition: attachment; filename=\"guide_utilisation.pdf\"".$passage_ligne;
		$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
		//========== 
		//=====Envoi de l'e-mail.
		mail($email, $Objet, utf8_decode($message), $header);
		
		echo "<h3>Validation effectuée</h3>";
		
	}else{
		
		
		//ON ENVOIE UN MAIL A LA STRUCTURE POUR L'INFOERMER QUE SON COMPTE EST REFUSER
		$headers ='From: "PRAM API"<'.$maildemandeidentification.'>'."\n";
		$headers .='Reply-To: '.$mailnepasrepondre."\n";
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit';
		$Objet = "[PRAM REFUS] Demande d'identifiant pour l'application PRAM";
		
		$Message = "Bonjour votre compte en ligne sur l'application PRAM Normandie n'a pas été validé.<br/><br/>Restant à votre disposition pour plus d'information,<br/><br/>Cordialement l'équipe du PRAM.";
		
		mail($email, $Objet, utf8_decode($Message), $headers);
	
		echo "<h3>Validation refusée</h3>";
	}
	
?>