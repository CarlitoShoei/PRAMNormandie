<?php 
include '../../bdd.php';
if(!isset($_SESSION['Identifiant'])){
	session_start(); 
}

if(isset($_SESSION['Identifiant'])){
	//On va aller chercher le type de strucuture si particulier alors on masque des menu
	$req_type_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".''); 
	$donnees_type_structure = pg_fetch_array($req_type_structure);
	
	//Requete sur la base utilisateur pour connaitre le pr꯯m de l'utilisateur
	$req_aut = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION" ='."'".$_SESSION['Identifiant']."'".'');
	$donnees_aut = pg_fetch_array($req_aut);
}
	
$type = $_GET['type'];

if($_GET['type'] == 'active'){
	if($donnees_type_structure['TYPE_STRUCTURE'] <> "2"){?> 
			<table width="100%">
				<tr>
					<td width="100%" align="center">
						<h2 onClick="desactive_saisie();afficher_masquer('outildessin','');">Désactiver la saisie</h2>
					</td>
				</tr>
				<tr>
					<td width="100%" align="center">
						<h2 onClick="load_page('observateurs/observateurs.php?ID_STRUCTURE=<?php echo  $donnees_aut['S_ID'];?>', 'affichage', 'affichage')">Ajouter un observateur</h2>
					</td>
				</tr>
			</table>
			<?php }else{?>
			<table width="100%">
				<tr>
					<td width="100%" align="center">
						<h2 onClick="desactive_saisie();afficher_masquer('outildessin','');">Désactiver la saisie</h2>
					</td>
				</tr>
				<tr>
					<td width="100%" align="center">
						<h2 onClick="confirmecoordonneeGPS('mare/saisie_mare.php?Longitude=&Latitude=&Commune=&Type=GPS&STRUCTURE_SESSION=<?php echo $_SESSION['Identifiant'] ?>')">Ajouter une mare par coordonnées GPS</h2>
					</td>
				</tr>
			</table>
	<?php } ?>
<?php }elseif($_GET['type'] == 'desactive'){ ?>
	<?php if($donnees_type_structure['TYPE_STRUCTURE'] <> "2"){?> 
		<table width="100%">
			<tr>
				<td width="100%" align="center">
					<h2 onClick="active_saisie();afficher_masquer('outildessin','');">Activer la saisie</h2>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('observateurs/observateurs.php?ID_STRUCTURE=<?php echo  $donnees_aut['S_ID'];?>', 'affichage', 'affichage')">Ajouter un observateur</h2>
				</td>
			</tr>
		</table>
		<?php }else{?>
		<table width="100%">
			<tr>
				<td width="100%" align="center">
					<h2 onClick="active_saisie();afficher_masquer('outildessin','');">Activer la saisie</h2>
				</td>
			</tr>
		</table>
		<?php } ?>
<?php } ?>