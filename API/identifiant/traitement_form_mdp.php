<?php
	// header( 'content-type: text/html; charset=utf-8' );
	// header('Content-type: text/html; charset=iso8859-1');
	include '../../bdd.php';
	
	//ON RECUPERE LES VARIABLE
	$id_session = $_GET['id_session'];
	$email = $_GET['email'];

	//ON ALLER VERIFIER DANS LA BASE DE DONNER SI L'IDENTIFIANT EXISTE OU PAS
	$structure_exist = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$id_session."'".' AND "S_EMAIL"='."'".$email."'".'');
	$count = pg_num_rows($structure_exist);
	
	if($count == 0){
		$document = "<p>Désolé mais vous n'existez pas dans la base de donnée. Veuillez contacter l'administrateur du PRAM (Charles Bouteiller)</p>";
		$document .= '<fieldset class="pied_popup" align="center">';
		$document .= '<table align="center" border="0">';
		$document .= '<tr>';
		$document .= '<td width="30" align="center">';
		$document .= '<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('."'affichage'".','."''".')">';
		$document .= '</td>';
		$document .= '</tr>';
		$document .= '</table>';
		$document .= '</fieldset>';
		
		echo $document;
	}
	else{
		$sql = 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$id_session."'".' AND "S_EMAIL"='."'".$email."'".'';
		$mdp = pg_query($bdd,$sql);
		$donnees = pg_fetch_array($mdp);	
		
		//PROCEDURE D'ENVOI DE MAIL A STEPHANE ET MOI
		//D�finit les headers pour nous permettre de mettre du HTML dans le mail
		$headers ='From: "PRAM API"<demandeauthentification@pram.com>'."\n";
		$headers .='Reply-To: nepasrepondre@pram.com'."\n";
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit';
		$Objet = "[PRAM]Recupération de votre mot de passe";
		
		$Message = "Bonjour,</br></br>Suite à une demande de votre part veuillez trouver ci-dessous votre mot de passe pour votre authentification sur l'application du PRAM.</br></br>mot de passe : ".$donnees['S_MDP']."</br></br>Cordialement, l'�quipe du PRAM.";
		
		mail($donnees['S_EMAIL'], utf8_decode($Objet), utf8_decode($Message), $headers);
		
		$document = "<p>Un email viens de vous être envoyé avec votre mot de passe.</br></br>Cordialement, l'équipe du PRAM.</p>";
		
		echo $document;
	}
?>