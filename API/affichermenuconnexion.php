<?php 
	include '../bdd.php';
	include '../function.php';
	
	if(isset($_GET['Identifiant'])){
		session_start(); 
		$SESSION['Identifiant'] = $_GET['Identifiant'];
	}
	
	if(isset($_SESSION['Identifiant'])){
		//POUR RECUPERER LE ROLE ADMIN OU OBSERVATEUR
		//Requete pour savoir is la mare appartient a l'identifiant
		$req_role = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".''); 
		$donnees_role = pg_fetch_array($req_role);
		
		//On va aller chercher le type de strucuture si particulier alors on masque des menu
		$req_type_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_SESSION['Identifiant']."'".''); 
		$donnees_type_structure = pg_fetch_array($req_type_structure);
		
		//Requete sur la base utilisateur pour connaitre le pr꯯m de l'utilisateur
		$req_aut = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION" ='."'".$_SESSION['Identifiant']."'".'');
		$donnees_aut = pg_fetch_array($req_aut);
	}
	?>
	<!-- POUR LA SESSION -->
	<?php if(isset($_SESSION['Identifiant'])){ ?>
		<input style="width:90%;display:none" type="text" id="Session" value="Active">
	<?php }else{ ?>
		<input style="width:90%;display:none" type="text" id="Session" value="Inactive">
	<?php } ?>	
	
	<?php if(isset($_SESSION['Identifiant'])){ ?>
	<input style="display:none" name="STRUCTURE_SESSION" id="STRUCTURE_SESSION" value="<?php echo $_SESSION['Identifiant']?>">
	<?php } ?>
	
	<div id="menupram">
		<?php if(isset($_SESSION['Identifiant']) AND $donnees_aut['ROLE'] == "administrateur"){ ?>
		<table width="100%">
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('tableau/tableau.php?page=1', 'affichage', 'tableau')">Vue en tableau</h2>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('fiche_depot/fiche_depot.php?identifiant=<?php echo $_SESSION['Identifiant']?>', 'affichage', 'tableau')">Fiche de dépôt</h2>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('validation/validation.php?page=1&identifiant=<?php echo $_SESSION['Identifiant']?>', 'affichage', 'validation')">Validation des données</h2>
				</td>
			</tr>
		</table>
		<?php }else{?>
		<table width="100%">
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('tableau/tableau.php?page=1', 'affichage', 'tableau')">Vue en tableau</h2>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('fiche_depot/fiche_depot.php?identifiant=<?php echo $_SESSION['Identifiant']?>', 'affichage', 'tableau')">Fiche de saisie</h2>
				</td>
			</tr>
		</table>
		<?php } ?>
	</div>
	
	<div id="edit">
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
	</div>
	
	<div id="import">
		<table width="100%">
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('import_excel/import.php?ID_STRUCTURE=<?php echo $donnees_aut['S_ID']?>', 'affichage', 'tableau')">Importation</h2>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="export">
		<table width="100%">
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('export_xls/demandeaccesmare.php?ID_STRUCTURE=0', 'affichage', 'tableau')">Demande d'extraction de données</h2>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<h2 onClick="test_active_atlas()">Cartographie PDF d'une mare</h2>
				</td>
			</tr>
			<!--<tr>
				<td width="100%" align="center">
					<h2 onClick="Export('export_kml/phpsql_genkml.php?Identifiant_Session=<?php // echo $_SESSION['Identifiant'] ?>')">Export Google Earth (kml)</h2>
				</td>
			</tr>-->
			<tr>
				<td width="100%" align="center">
					<h2 onClick="Export('export_xls/export_mares.php?Identifiant_Session=<?php echo $_SESSION['Identifiant'] ?>')">Export Excel des mares (localisation, caractérisation et observations faune / flore)</h2>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<h2 onClick="Export('export_shp/export_mares_shapefile.php?Identifiant_Session=<?php echo $_SESSION['Identifiant'] ?>')">Export Shape des mares</h2>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<h2 onClick="Export('export_xls/export_mares_sinp.php?Identifiant_Session=<?php echo $_SESSION['Identifiant'] ?>')">Export SINP des données faune / flore des mares de votre territoire</h2>
				</td>
			</tr>
		</table>
	</div>