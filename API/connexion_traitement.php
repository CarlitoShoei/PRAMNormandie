<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<script src="../js/newpram.js" type="text/javascript"></script>
<?php
	session_start();
	
	function phpAlert($msg) {
		echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	
	//On se connecte � la base de donn�es
	include '../bdd.php';

//On r�cup�re les donn�es
$_SESSION['Identifiant'] = $_GET['Identifiant'];
$_SESSION['Mot_Passe'] = $_GET['Password'];
$idstructureconnecter = $_SESSION['Identifiant'];

if(!isset($_GET['type'])){
	// On r�cup�re tout les identifiants de la table utilisateurs
	$reponse = pg_query($bdd, 'SELECT "S_MDP" FROM saisie_observation.structure WHERE "S_ID_SESSION" = '."'".$_SESSION['Identifiant']."'".' AND "S_VALIDATION" = 1');
	$donnees = pg_fetch_array($reponse);

		if ($_SESSION['Mot_Passe'] =="" or $_SESSION['Identifiant'] == ""){ // Si aucun mot de passe ou identifiant n'est rentr�
			header("location:index.php");
		}elseif ($_SESSION['Mot_Passe'] == $donnees["S_MDP"]){ // Si le mot de passe est bon et restraint a des identifiants pr�cis
			include "connexion.php";// On affiche les codes ou bien une page
		}else{
			include "connexion_nv.php";// On affiche les codes ou bien une page
		}
}else{
	// On r�cup�re tout les identifiants de la table utilisateurs
	$reponse = pg_query($bdd, 'SELECT "S_MDP" FROM saisie_observation.structure WHERE "S_ID_SESSION" = '."'".$_SESSION['Identifiant']."'".' AND "S_VALIDATION" = 1');
	$donnees = pg_fetch_array($reponse);

		if ($_SESSION['Mot_Passe'] =="" or $_SESSION['Identifiant'] == ""){ // Si aucun mot de passe ou identifiant n'est rentr�
			header("location:module/index.php");
		}elseif ($_SESSION['Mot_Passe'] == $donnees["S_MDP"]){ // Si le mot de passe est bon et restraint a des identifiants pr�cis
			include "module/listemodule.php";// On affiche les codes ou bien une page
		}else{
			header("location:module/index.php?error_connexion=Oui");
		}
}

?>		