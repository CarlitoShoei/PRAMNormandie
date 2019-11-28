<div id="textafficahge">
<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
<h3>Vue en tableau</h3>
<?php
	session_start();
	include '../../bdd.php';
	include '../../function.php';
	//On recup�re les varaible
	if(isset($_GET['Mare'])){
		$Mare = $_GET['Mare'];
	}
	else{
		$Mare = 0;
	}
	if(isset($_GET['Departement'])){
		$Departement = $_GET['Departement'];
	}else{
		$Departement = 0;
	}
	if(isset($_GET['Commune'])){
		$Commune = $_GET['Commune'];
	}else{
		$Commune = 0;
	}
	if(isset($_GET['id_session'])){
		$Session = $_GET['id_session'];
	}else{
		$Session = "Inactive";
	}
	
	if(isset($_GET['id_session']) && $_GET['id_session'] <> '0'){
			//FAIRE UNE REQUETE POUR RECUPERE L'IDENTIFIANT DE LA STRUCUTURE
			$req_id_session = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			$donnees = pg_fetch_array($req_id_session);
			$id_structure_conectee = $donnees['S_ID'];
			$role = $donnees['ROLE'];
		}else{
			$id_structure_conectee = 0;
			$role = 0;
		}
	
	//ON VA FAIRE UNE REQUETE POUR VOIT SI LA STRUCUTRE POSSEDE UN CONTOUR GEOGRAPHIQUE DANS LA TABLE CONTOUR_STRUCTURE
	$req_contour_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".' AND geom is Not Null');
	$count_contour = pg_num_rows($req_contour_structure);

	//SI role = administrateur alors on a le droit de tout voir
	if($role == "administrateur"){
		//POUR LA GESTION DE L'AFFICAHGE DES DONNEES SUR PLUSIEURS PAGE
			// On met dans une variable le nombre de messages qu'on veut par page
			$nombreDeMessagesParPage = 100;
			// On récupère le nombre total de messages
			if($Mare == 0 && $Departement == 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation');
			}elseif($Mare == 0 && $Departement == 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation
									WHERE "L_ADMIN" ='."'".$Commune."'".'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation
									WHERE left("L_ADMIN"::text,2)='."'".$Departement."'".'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation
									WHERE "L_ID" ='."'".$Mare."'".'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation
									WHERE left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation
									WHERE "L_ID" ='."'".$Mare."'".' AND "L_ADMIN" ='."'".$Commune."'".'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation
									WHERE "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation
									WHERE "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'');
			}
	
	}elseif($role == "observateur"){
		//SI count_contour = 1 alors on filtre les mares comprise dans le perimetre de la strucuture sinon on prend les mares qui posède l'identifiant en plus des filtres
		if($count_contour == 1){
			//POUR LA GESTION DE L'AFFICAHGE DES DONNEES SUR PLUSIEURS PAGE
			// On met dans une variable le nombre de messages qu'on veut par page
			$nombreDeMessagesParPage = 100;
			// On récupère le nombre total de messages
			if($Mare == 0 && $Departement == 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))');
			}elseif($Mare == 0 && $Departement == 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ADMIN" ='."'".$Commune."'".'
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE left("L_ADMIN"::text,2)='."'".$Departement."'".'
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".'
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))');
			}	
		}else{
			//POUR LA GESTION DE L'AFFICAHGE DES DONNEES SUR PLUSIEURS PAGE
			// On met dans une variable le nombre de messages qu'on veut par page
			$nombreDeMessagesParPage = 100;
			// On récupère le nombre total de messages
			if($Mare == 0 && $Departement == 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE localisation."L_STRP" = structure."S_ID"::text::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare == 0 && $Departement == 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ADMIN" ='."'".$Commune."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE left("L_ADMIN"::text,2)='."'".$Departement."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}
		
		}
	}else{
			//POUR LA GESTION DE L'AFFICAHGE DES DONNEES SUR PLUSIEURS PAGE
			// On met dans une variable le nombre de messages qu'on veut par page
			$nombreDeMessagesParPage = 100;
			// On récupère le nombre total de messages
			if($Mare == 0 && $Departement == 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE localisation."L_STRP" = structure."S_ID"::text::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare == 0 && $Departement == 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ADMIN" ='."'".$Commune."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE left("L_ADMIN"::text,2)='."'".$Departement."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune == 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune <> 0){
				$retour = pg_query($bdd, 'SELECT COUNT(*) AS nb_messages
									FROM saisie_observation.localisation, saisie_observation.structure
									WHERE "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									AND localisation."L_STRP" = structure."S_ID"::text
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'');
			}	
	}
	
	
	$donnees = pg_fetch_array($retour);
	$totalDesMessages = $donnees['nb_messages'];
	// On calcule le nombre de pages à créer
	$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
	// Puis on fait une boucle pour écrire les liens vers chacune des pages
	echo '<p>Page : ';
	for ($i = 1 ; $i <= $nombreDePages ; $i++)
	{
		if(isset($_GET['page']) AND $_GET['page'] == $i){
			$Color = 'red';
		}else{
			$Color = 'black';
		}
		echo "<a style=cursor:pointer;font-size:14px;color:".$Color."; onClick=Page('tableau/tableau.php?page=".$i."','affichage')>".$i."     </a>";
	}
	echo '<p>';
	
	if (isset($_GET['page']) && $_GET['page']<>0){
	$page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
	}else // La variable n'existe pas, c'est la première fois qu'on charge la page
	{
		$page = 1; // On se met sur la page 1 (par défaut)
	}
	// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
	$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
	
	
	//REQUET SQL
	//SI count_contour = 1 alors on filtre les mares comprise dans le perimetre de la strucuture sinon on prend les mares qui posède l'identifiant en plus des filtres
	if($role == "administrateur"){
		if($Mare == 0 && $Departement == 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID"
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement == 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "L_ID" ='."'".$Mare."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "L_ID" ='."'".$Mare."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation.""L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}	
	}elseif($role == "observateur"){
		if($count_contour == 1){
			if($Mare == 0 && $Departement == 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID"
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement == 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))						
									AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))	
									AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))
									AND "L_ID" ='."'".$Mare."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))							
									AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))
									AND "L_ID" ='."'".$Mare."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))								
									AND "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND ((st_intersects(structure.geom, st_transform(localisation.geom,2154))
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".') OR (saisie_observation.localisation."L_STRP"::text = structure."S_ID"::text AND structure."S_ID" = '."'".$id_structure_conectee."'".'))
									AND "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}
		}else{
			if($Mare == 0 && $Departement == 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID"
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement == 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ID" ='."'".$Mare."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ID" ='."'".$Mare."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation.""L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}	
		}
	}else{
			if($Mare == 0 && $Departement == 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID"
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement == 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ID" ='."'".$Mare."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare == 0 && $Departement <> 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement == 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ID" ='."'".$Mare."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune == 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation.""L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}elseif($Mare <> 0 && $Departement <> 0 && $Commune <> 0){
				$rq = pg_query($bdd, 'SELECT  saisie_observation.localisation."ID" AS "ID", "L_ID", "L_STRP", "L_NOM", "STATUT", "L_ADMIN", "L_DATE", "L_OBSV", "L_PROP", "L_COOX93", "L_COOY93", "L_COOX", "L_COOY", "S_ID", (SELECT "STRUCTURE" FROM saisie_observation.structure WHERE structure."S_ID"::text = "L_STRP"), "Nom_Commune", "OBS_PRENOM", "OBS_NOM", "PROPR", "L_VALID" 
									FROM saisie_observation.localisation, menu_deroulant.l_statut, saisie_observation.structure, ign_bd_topo.commune, saisie_observation.observateur, menu_deroulant.l_propr
									WHERE saisie_observation.localisation."L_STATUT"::bigint = menu_deroulant.l_statut."ID"
									AND saisie_observation.localisation."L_PROP"::bigint = menu_deroulant.l_propr."ID"
									AND saisie_observation.localisation."L_OBSV"::bigint = saisie_observation.observateur."ID"
									AND saisie_observation.localisation."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
									AND saisie_observation.localisation."L_STRP"::bigint = saisie_observation.structure."S_ID"
									AND "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".'
									AND "L_ID" ='."'".$Mare."'".' AND left("L_ADMIN"::text,2)='."'".$Departement."'".' AND "L_ADMIN" ='."'".$Commune."'".'
									ORDER BY "L_ID" LIMIT '.$nombreDeMessagesParPage.' OFFSET '.$premierMessageAafficher.'');
			}	
	}

?>
		<table align="center" width="100%">
			<tr class="entete">
				<th width="9%" colspan="2">ID mare</th>
				<th width="10%">Nom usuel</th>
				<th width="13%">Commune</th>
				<th width="8%">Statut</th>
				<th width="10%">Date localisation</th>
				<th width="10%">Observateur</th>
				<th width="10%">Structure</th>
				<th width="10%">Propriété</th>
				<th width="10%">X</th>
				<th width="10%">Y</th>
			</tr>
		</table>
		<div id="resultat">
			<table>
			<?php
			
			$i=1;
			while ($result = pg_fetch_array($rq))
			{
			
			$style = ($i%2) ? "stryleattribut" : "stryleattribut2";							
			?>
				
					<tr class="<?php echo $style ?>" align="left" height="20" onclick="zoom_entity_tableau('<?php echo stripslashes($result['L_COOX']);?>', '<?php echo stripslashes($result['L_COOY']);?>');afficher_masquer('affichage','')">
						<td width="1%" align="center">
							<?php 
								if($result['L_VALID'] == 'A Valider'){ 
									echo "<img src='../img/pin_red.png' width='15' title='Mare à valider'/>";
								}else{
									echo "<img src='../img/pin_green.png' width='15' title='Mare validée'/>";
								};?>
						</td>
						<td align="center" width="8%"><?php echo stripslashes($result['L_ID']);?></td>
						<td align="center" width="10%"><?php echo stripslashes($result['L_NOM']);?></td>
						<td align="center" width="13%"><?php echo stripslashes($result['Nom_Commune']);?></td>
						<td align="center" width="8%"><?php echo stripslashes($result['STATUT']);?></td>
						<td align="center" width="10%"><?php echo date('d/m/Y', $result['L_DATE']);?></td>
						<td align="center" width="10%"><?php echo stripslashes($result['OBS_PRENOM']." ".$result['OBS_NOM']);?></td>
						<td align="center" width="10%"><?php echo stripslashes($result['STRUCTURE']);?></td>
						<td align="center" width="10%"><?php echo stripslashes($result['PROPR']);?></td>
						<td align="center" width="10%"><?php echo stripslashes($result['L_COOX93']);?></td>
						<td align="center" width="10%"><?php echo stripslashes($result['L_COOY93']);?></td>
					</tr>
				
			<?php	
			$i++;
			}
			
			?>
			</table>
		</div>
		</div>
		<div id="piedaffichage">
			<table align="center" width="100%" border="0">
				<tr>
					<td colspan="11">
						<fieldset class="pied_popup" align="center">
							<table align="center" border="0">
								<tr>
									<td width="30" align="center">
										<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
									</td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
			</table>
		</div>