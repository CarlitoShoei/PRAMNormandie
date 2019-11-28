<?php 
	// session_start();
	$Session = "Active";
	$idstructureconnecter;
	
	//REQUETE POUR ALLER CHERCHER LE ROLE DE LA STRUCTURE CONNECTER
	//ON VA FAIRE UNE REQUETE POUR DETERMINER LE ROLE DE LA STRUCTURE
	$req_role_structure = pg_query($bdd, 'SELECT "ROLE" FROM saisie_observation.structure WHERE "S_ID_SESSION"::text='."'".$idstructureconnecter."'".'');
	$role_structure = pg_fetch_array($req_role_structure);
	$rolestructure = $role_structure['ROLE'];
?>
<input type="text"  id="session" value="<?php echo $Session?>"></br>
<input type="text"  id="idstructureconnectee" value="<?php echo $idstructureconnecter?>"></br>
<input type="text"  id="rolestructure" value="<?php echo $rolestructure?>"></br>
<input type="text"  id="latitudemap" value=""></br>
<input type="text"  id="longitudemap" value=""></br>

<iframe onload="afficher_masquer('bienvenue','connexion_ajax.php');afficher_masquer('menu','connexion_menu.php');load_page('baspage.php', 'legend', '');AfficherMareStructure('<?php echo $idstructureconnecter ?>','<?php echo $rolestructure ?>');affichercontourstructure('<?php echo $idstructureconnecter ?>');" frameborder="1" height="1%" width="10%"></iframe>

