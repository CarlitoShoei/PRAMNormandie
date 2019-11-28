<script src="../../js/newpram.js" type="text/javascript"></script>
<?php
	// header( 'content-type: text/html; charset=utf-8' );
	// header('Content-type: text/html; charset=iso8859-1');
	include '../../bdd.php';
	ini_set("display_errors",1);
	//ON RECUPERE LES VARIABLE
	if(isset($_GET['nom_structure'])){
		$nom_structure = $_GET['nom_structure'];
		$logo_structure = $_GET['logo_structure'];
	}
	if(isset($_GET['prenom_particulier'])){
		$prenom_particulier = $_GET['prenom_particulier'];
	}
	if(isset($_GET['nom_particulier'])){
		$nom_particulier = $_GET['nom_particulier'];
	}
	// $num_fiscalite = $_GET['num_fiscalite'];
	// $id_sinp = $_GET['id_sinp'];
	$id_typestrucuture = $_GET['id_typestrucuture'];
	$id_session = $_GET['id_session'];
	$email = $_GET['email'];
	$departement = $_GET['departement'];
	$adresse = $_GET['adresse'];
	$telephone = $_GET['telephone'];
	$mdp = $_GET['mdp'];
	$condition = $_GET['condition'];
	
	//SI PARTICULIER
	if($id_typestrucuture == "2"){
		//REQUETE POUR ALLER CHERCHER LE TYPE DE LA STRUCTURE
		$strucuture = pg_query($bdd, 'SELECT "TYPE" FROM menu_deroulant.type_structure WHERE "ID"='."'".$id_typestrucuture."'".''); 
		$donnees_strucuture = pg_fetch_array($strucuture);
		
		//ETANT DONNER QUE LES FORMULAIRE A 2T2 VERIFIER EN JAVASCRIPT ON EXECUTE DIRECTEMENT LES INSTRUCTIONS
		//ON VA DABORD ECRIRE LINSCRIPTION DANS UNE TABLE
		$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.structure("STRUCTURE", "S_ID_SESSION", "S_MDP", "S_EMAIL", "S_DEPARTEMENT", "S_ADRESSE", "S_TELEPHONE", "S_CONDITION", "TYPE_STRUCTURE", "S_VALIDATION", "ROLE") 
									VALUES(CONCAT(E'."'".addslashes($nom_particulier)."'".', '."' '".', E'."'".addslashes($prenom_particulier)."'".'), E'."'".utf8_decode(addslashes($id_session))."'".', '."'".utf8_decode(addslashes($mdp))."'".', '."'".$email."'".', '."'".$departement."'".', E'."'".addslashes($adresse)."'".', '."'".$telephone."'".', '."'".$condition."'".','."'".$id_typestrucuture."'".','."'1'".','."'observateur'".')');
					
		
		//ON CREER UN OBSERVATEUR PAR DEFAUT APRES
		$req_insert_obs = pg_query($bdd, 'INSERT INTO saisie_observation.observateur("OBS_PRENOM", "OBS_NOM", "OBS_NOM_PRENOM", "OBS_STRUCTURE") 
									VALUES(E'."'".addslashes($prenom_particulier)."'".', E'."'".addslashes($nom_particulier)."'".', CONCAT(E'."'".addslashes($nom_particulier)."'".', '."' '".', E'."'".addslashes($prenom_particulier)."'".'), CONCAT(E'."'".addslashes($nom_particulier)."'".', '."' '".', E'."'".addslashes($prenom_particulier)."'".'))');
		
		//PROCEDURE D'ENVOI DE MAIL A STEPHANE ET MOI
		//Dꧩnit les headers pour nous permettre de mettre du HTML dans le mail
		
		
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui présentent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "Bonjour, Votre demande d'inscription a été effectuée avec succès. <br/><br/><br/>Vous pouvez désormais vous connecter et saisir des mares.</br></br/><b>En pièce jointe, vous trouverez un guide de première utilisation</b></br></br>Restant à votre disposition,<br/><br/>Cordialement l'équipe du PRAM.";
		$message_html = "<html><head></head><body>Bonjour, Votre demande d'inscription a été effectuée avec succès. <br/><br/><br/>Vous pouvez désormais vous connecter et saisir des mares.</br></br/><b>En pièce jointe, vous trouverez un guide de première utilisation</b></br></br>Restant à votre disposition,<br/><br/>Cordialement l'équipe du PRAM.</body></html>";
		//==========
		 
		//=====Lecture et mise en forme de la pièce jointe.
		$fichier   = fopen("../../doc/notice_api_pram_particulier.pdf", "r");
		$attachement = fread($fichier, filesize("../../doc/notice_api_pram_particulier.pdf"));
		$attachement = chunk_split(base64_encode($attachement));
		fclose($fichier);
		//==========
		 
		//=====Création de la boundary.
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========
		 
		//=====Définition du sujet.
		$Objet1 = "[PRAM Validation] Confirmation de votre inscription";
		//=========
		 
		//=====Création du header de l'e-mail.
		$header ="From: 'PRAM API'<".$maildemandeidentification.">".$passage_ligne;
		$header .="Reply-To: ".$mailnepasrepondre.$passage_ligne;
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
		mail($email, $Objet1, utf8_decode($message), $header);
		
		//////////////////////////////////EMAIL ENVOYER A ADMINISTRATEUR PRAM//////////////////////////////////////////////////////
		$headers ='From: "PRAM API"<'.$maildemandeidentification.'>'."\n";
		$headers .='Cc: '.$maildestinataireidentification."\n";
		$headers .='Reply-To: '.$mailnepasrepondre."\n";
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit';
		$Objet = "[PRAM] Validation d'une demande d'identifiant pour un particulier sur l'application PRAM";
		
		$Message = "Ce particulier : ".$nom_particulier." ".$prenom_particulier." a demandé un identifiant de connexion pour utiliser l'application en ligne du PRAM. La demande a été validée automatiquement</br></br>
					Nom : ".$nom_particulier."</br>
					Prénom : ".$prenom_particulier."</br>
					Type Structure : ".$donnees_strucuture['TYPE']."</br>
					Identifiant Strucuture : ".$id_session."</br>
					Email : ".$email."</br>
					Departement : ".$departement."</br>
					Adresse : ".$adresse."</br>
					Téléphone : ".$telephone."</br></br>";
		
		mail($mailadministrateur, $Objet, utf8_decode($Message), $headers);
		
		$document = "<p>Votre demande d'inscription a été effectuée avec succés. <br/><br/><br/>Vous pouvez désormais vous connecter et saisir des mares. <br/><br/><br/>Un email de confirmation vous a été envoyé. En pièce jointe, vous trouverez une notice d'utilisation de l'application<br/><br/><br/>L'équipe du PRAM vous remercie</p></br>";
	
	
	}
	//SI CPN
	else if($id_typestrucuture == "9"){
		//REQUETE POUR ALLER CHERCHER LE TYPE DE LA STRUCTURE
		$strucuture = pg_query($bdd, 'SELECT "TYPE" FROM menu_deroulant.type_structure WHERE "ID"='."'".$id_typestrucuture."'".''); 
		$donnees_strucuture = pg_fetch_array($strucuture);
		
		//ETANT DONNER QUE LES FORMULAIRE A 2T2 VERIFIER EN JAVASCRIPT ON EXECUTE DIRECTEMENT LES INSTRUCTIONS
		//ON VA DABORD ECRIRE LINSCRIPTION DANS UNE TABLE
		$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.structure("STRUCTURE", "S_ID_SESSION", "S_MDP", "S_EMAIL", "S_DEPARTEMENT", "S_ADRESSE", "S_TELEPHONE", "S_CONDITION", "TYPE_STRUCTURE", "LOGO_STRUCTURE") 
									VALUES(E'."'".addslashes($nom_structure)."'".', E'."'".utf8_decode(addslashes($id_session))."'".', '."'".utf8_decode(addslashes($mdp))."'".', '."'".$email."'".', '."'".$departement."'".', E'."'".addslashes($adresse)."'".', '."'".$telephone."'".', '."'".$condition."'".','."'".$id_typestrucuture."'".', E'."'".addslashes($logo_structure)."'".')');
					
		
		//ON CREER UN OBSERVATEUR PAR DEFAUT APRES
		$req_insert_obs = pg_query($bdd, 'INSERT INTO saisie_observation.observateur("OBS_PRENOM", "OBS_NOM", "OBS_NOM_PRENOM", "OBS_STRUCTURE") 
									VALUES('."'Observateur'".', '."'".$id_session."'".', CONCAT('."'".$id_session."'".', '."' Observateur'".'), E'."'".addslashes($nom_structure)."'".')');
		
		
		
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui présentent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "Bonjour, Votre demande d'inscription a été effectuée avec succès. <br/><br/><br/>Vous pouvez désormais vous connecter et saisir des mares.</br></br/><b>En pièce jointe, vous trouverez un guide de première utilisation</b></br></br>Restant à votre disposition,<br/><br/>Cordialement l'équipe du PRAM.";
		$message_html = "<html><head></head><body>Bonjour, Votre demande d'inscription a été effectuée avec succès. <br/><br/><br/>Vous pouvez désormais vous connecter et saisir des mares.</br></br/><b>En pièce jointe, vous trouverez un guide de première utilisation</b></br></br>Restant à votre disposition,<br/><br/>Cordialement l'équipe du PRAM.</body></html>";
		//==========
		 
		//=====Lecture et mise en forme de la pièce jointe.
		$fichier   = fopen("../../doc/notice_api_pram_particulier.pdf", "r");
		$attachement = fread($fichier, filesize("../../doc/notice_api_pram_particulier.pdf"));
		$attachement = chunk_split(base64_encode($attachement));
		fclose($fichier);
		//==========
		 
		//=====Création de la boundary.
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========
		 
		//=====Définition du sujet.
		$Objet1 = "[PRAM Validation] Confirmation de votre inscription";
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
		mail($email, $Objet1, utf8_decode($message), $header);
		
		//////////////////////////////////EMAIL ENVOYER A ADMINISTRATEUR PRAM//////////////////////////////////////////////////////
		
		$headers ='From: "PRAM API"<'.$maildemandeidentification.'>'."\n";
		$headers .='Cc: '.$maildestinataireidentification."\n";
		$headers .='Reply-To: '.$mailnepasrepondre."\n";
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit';
		$Objet = "[PRAM] Validation d'une demande d'identifiant pour un particulier sur l'application PRAM";
		
		$Message = "Ce club CPN : ".$nom_structure." a demandé un identifiant de connexion pour utiliser l'application en ligne du PRAM. La demande a été validée automatiquement</br></br>
					Nom : ".$nom_structure."</br>
					Type Structure : ".$donnees_strucuture['TYPE']."</br>
					Identifiant Strucuture : ".$id_session."</br>
					Email : ".$email."</br>
					Departement : ".$departement."</br>
					Adresse : ".$adresse."</br>
					Téléphone : ".$telephone."</br></br>";
		
		mail($mailadministrateur, $Objet, utf8_decode($Message), $headers);
		
		$document = "<p>Votre demande d'inscription a été effectuée avec succés. <br/><br/><br/>Vous pouvez désormais vous connecter et saisir des mares. <br/><br/><br/>Un email de confirmation vous a été envoyé. En pièce jointe, vous trouverez une notice d'utilisation de l'application<br/><br/><br/>L'équipe du PRAM vous remercie</p></br>";
	
	
	}else{
		//REQUETE POUR ALLER CHERCHER LE TYPE DE LA STRUCTURE
		$strucuture = pg_query($bdd, 'SELECT "TYPE" FROM menu_deroulant.type_structure WHERE "ID"='."'".$id_typestrucuture."'".''); 
		$donnees_strucuture = pg_fetch_array($strucuture);
		
		//ETANT DONNER QUE LES FORMULAIRE A 2T2 VERIFIER EN JAVASCRIPT ON EXECUTE DIRECTEMENT LES INSTRUCTIONS
		//ON VA DABORD ECRIRE LINSCRIPTION DANS UNE TABLE
		$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.structure("STRUCTURE", "S_ID_SESSION", "S_MDP", "S_EMAIL", "S_DEPARTEMENT", "S_ADRESSE", "S_TELEPHONE", "S_CONDITION", "TYPE_STRUCTURE", "LOGO_STRUCTURE") 
									VALUES(E'."'".addslashes($nom_structure)."'".', E'."'".utf8_decode(addslashes($id_session))."'".', '."'".utf8_decode(addslashes($mdp))."'".', '."'".$email."'".', '."'".$departement."'".', E'."'".addslashes($adresse)."'".', '."'".$telephone."'".', '."'".$condition."'".','."'".$id_typestrucuture."'".', E'."'".addslashes($logo_structure)."'".')');
					
		
		//ON CREER UN OBSERVATEUR PAR DEFAUT APRES
		$req_insert_obs = pg_query($bdd, 'INSERT INTO saisie_observation.observateur("OBS_PRENOM", "OBS_NOM", "OBS_NOM_PRENOM", "OBS_STRUCTURE") 
									VALUES('."'Observateur'".', '."'".$id_session."'".', CONCAT('."'".$id_session."'".', '."' Observateur'".'), E'."'".addslashes($nom_structure)."'".')');
		
		//PROCEDURE D'ENVOI DE MAIL A STEPHANE ET MOI
		//Dꧩnit les headers pour nous permettre de mettre du HTML dans le mail
		$headers ='From: "PRAM API"<'.$maildemandeidentification.'>'."\n";
		$headers .='Cc: '.$maildestinataireidentification."\n";
		$headers .='Reply-To: '.$mailnepasrepondre."\n";
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit';
		$Objet = "[PRAM] Demande d'identifiant pour l'application PRAM";
		
		$Message = "Cette structure : ".$nom_structure." vous demande un identifiant de connexion pour utiliser l'application en ligne du PRAM</br></br>
					Nom strucutre : ".$nom_structure."</br>
					Type Structure : ".$donnees_strucuture['TYPE']."</br>
					Identifiant Strucuture : ".$id_session."</br>
					Email : ".$email."</br>
					Departement : ".$departement."</br>
					Adresse : ".$adresse."</br>
					Téléphone : ".$telephone."</br></br>
					<a href='www.pramnormandie.com/API/identifiant/prevalidation.php?valide=oui&email=".$email."&id_session=".$id_session."&mdp=".$mdp."'>Valider la demande</a></br></br>
					<a href='www.pramnormandie.com/API/identifiant/validation.php?valide=non&email=".$email."&id_session=".$id_session."&mdp=".$mdp."'>Refuser la demande</a>";
		
		mail($mailadministrateur, $Objet, utf8_decode($Message), $headers);
		
		
		//////////////////////////////////EMAIL ENVOYER A LA PERSONNE QUI CEST INSCRITE//////////////////////////////////////////////////////
		
		$headers2 ='From: "PRAM API"<'.$maildemandeidentification.'>'."\n";
		$headers2 .='Reply-To: '.$mailnepasrepondre."\n";
		$headers2 .='Content-Type: text/html; charset="iso-8859-1"'."\n";
		$headers2 .='Content-Transfer-Encoding: 8bit';
		$Objet2 = "[PRAM] Demande d'information complémentaire sur votre inscription";
		
		$Message2 = "Bonjour,</br></br>
					Nous avons bien reçu votre demande d'identification. Pour procéder à sa validation, merci de nous renvoyer les élèments suivants à cette adresse : ".$mailadministrateur."</br></br>
						- Si votre structure possède un contour administratif, merci de nous envoyer celui-ci en fichier SIG Shape ESRI projection RGF Lambert 93.</br></br>
						- Si votre structure possède un identifiant SINP auprès de l'Observatoire de la Biodiversité de Haute-Normandie (OBHN), merci de nous le transmettre.</br></br>
						- Si votre structure possède un identifiant IDCNP (Inventaire des Dispositifs de Collecte - INPN) propre à la collecte des données sur les mares, merci de nous le transmettre.</br></br>
					Une fois ces informations retournées, nous procèderons à la validation de votre compte PRAM Normandie.</br></br>
					Restant à votre dispotion,</br></br>
					Cordialement,</br></br>
					L'équipe du PRAM Normandie.</br></br>";
		
		mail($email, utf8_decode($Objet2), utf8_decode($Message2), $headers2);
		
		$document = "<p>Votre demande d'inscription a été effectuée avec succés. <br/><br/><br/>Vous recevrez un mail de confirmation lors de la validation de votre compte. <br/><br/><br/>L'équipe du PRAM vous remercie</p></br>";
	}
								
	
	
	echo $document;
?>