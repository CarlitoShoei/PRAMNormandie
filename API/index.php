<head>
    <title>PRAM-Normandie</title>
	<meta name="description" content="Programme Régional d'Actions en faveur des mares de Normandie" />
	<meta NAME="Author" CONTENT="©CENHN - 2015" >
	<meta HTTP-EQUIV="content-Language" CONTENT="fr" >
	<meta name="robots" content="INDEX, FOLLOW, NOYDIR, NOODP, ALL" >
	<meta name="audience" content="all" >
	<meta name="identifier-url" content="http://www.pramnormandie.fr/" >
	<link rel="stylesheet" href="../css/newpram.css" type="text/css" />
	<script src="../js/getXhr.js" type="text/javascript"></script>
	<script src="../js/newpram.js" type="text/javascript"></script>
	<script type='text/javascript' src='../js/jquery-1.7.2.min.js'></script>
	<script type='text/javascript' src='../js/jquery.form.js'></script>
</head>
</body>
	<?php
	ini_set('max_execution_time', 72000000);
	ini_set("display_errors",1);

	include '../bdd.php';
	include '../function.php';
	
	if(isset($_GET['error_connexion'])){
		$error_connexion = $_GET['error_connexion'];
	}else{
		$error_connexion = "Non";
	}
	
	//APPEL LA FONCTION VISITE POUR LE COMPTEUR DE VISITE
	compter_visite($bdd);
	
	//FAUT RECUPERER LA LISTE AVEC TOUS LES SALARIES, MAIS UNE SEULE FOIS :)	
	$listeDepartement = array();
	$req = pg_query($bdd, 'SELECT "Num_Dep" FROM ign_bd_topo.commune GROUP BY "Num_Dep" ORDER BY "Num_Dep"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listeDepartement, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listeInterco = array();
	$req = pg_query($bdd, 'SELECT "Num_fiscalite", "Intercommunalite" FROM layer.intercommunalite GROUP BY "Num_fiscalite", "Intercommunalite" ORDER BY "Intercommunalite" LIMIT 0'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listeInterco, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listeCommune = array();
	$req = pg_query($bdd, 'SELECT "Nom_Commune", "Num_INSEE" FROM ign_bd_topo.commune ORDER BY "Nom_Commune" LIMIT 0'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listeCommune, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listeMare = array();
	$req = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE "L_ID" <> '."'NEW'".' ORDER BY "L_ID" LIMIT 0'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listeMare, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	//POUR LE COMPTEUR DE VISITE
	//CALCUL DU NOMBRE TOTAL DE VISITEUR
	$req_visite_total = pg_query($bdd, 'SELECT "IP" FROM saisie_observation.stats_visites GROUP BY "IP"');
	$nb_total_visite = pg_num_rows($req_visite_total);
	//CALCUL POUR LE NOMBRE DE VISITE AUJOURDHUI
	//ON TERMINE LE MKTIME DE DEBUT DE JOURNER ET LE MKTIME DE FIN DE JOURNER
	$mktime_debut = mktime(0,0,0,date('m'),date('j'),date('Y')); 
	$mktime_fin = mktime(23,59,59,date('m'),date('j'),date('Y')); 
	//REQUETE
	$req_visite_days = pg_query($bdd, 'SELECT "IP" FROM saisie_observation.stats_visites WHERE "DATE_VISITE" >= '."'".$mktime_debut."'".' AND "DATE_VISITE" <= '."'".$mktime_fin."'".' GROUP BY "IP"');
	$nb_visite_day = pg_num_rows($req_visite_days);
	
	
	//////REQUETE POUR STATISTIQUE EN TEMPS REEL
	//Nb mare localiser
	$rqnbmare = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE localisation."L_ID" <> '."'NEW'".'');
	$nbmare = pg_num_rows($rqnbmare);
	//Nb mare caractérisé
	$rqnbmarecarac = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation WHERE "C_DATE" <> '."'943920000'".' AND "C_DATE" is not Null');
	$nbmarecarac = pg_num_rows($rqnbmarecarac);
	//Nb observation faune flore
	$rqnbobs= pg_query($bdd, 'SELECT * FROM saisie_observation.observation');
	$nbobs = pg_num_rows($rqnbobs);
	//Nb observation faune
	// $rqnbobsfaune= pg_query($bdd, 'SELECT * FROM saisie_observation.observation WHERE "O_REFE" = '."'TAXREF v8.0'".' AND "O_REF2" <> '."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".'');
	// $nbobsfaune = pg_num_rows($rqnbobsfaune);
	//Nb observation flore
	// $rqnbobsflore= pg_query($bdd, 'SELECT * FROM saisie_observation.observation WHERE "O_REF2" = '."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".'');
	// $nbobsflore = pg_num_rows($rqnbobsflore);
	?>
	<div id="bodypage">
		<div id="affichageacceuil">
			<input style="width:100%;display:none" type="text" id="ID_INTERCO_ACCEUIL" value="">
			<table border="0" width="100%" height="100%">
				<tr height="5%">
					<th width="66%" colspan="2"><h3><b>Bienvenue sur l'application cartographique du Programme régional d'actions en faveur des mares (PRAM) de Normandie</b></h3><hr></th>
					<td width="2%"></td>
					<td width="32%" colspan="2" align="center"><h3>Visites totales : <?php echo $nb_total_visite ?> </br></br> Visites aujourd'hui : <?php echo $nb_visite_day ?></h3></td>
				</tr>
				<tr height="85%">
					<td rowspan="3" colspan="2">
						<p>
							Cet outil de saisie en ligne des mares de Normandie a été conçu par les Conservatoires d’espaces naturels de Normandie, avec le soutien financier l'Agence de l'eau Seine-Normandie et de la Région Normandie, 
							dans le cadre de la mise en œuvre du Programme régional d’actions en faveur des mares de Normandie (<a href="http://www.pramnormandie.com" alt="recensement des mares de Normandie" title="Site du PRAM Normandie" target="_bank">PRAM Normandie</a>). 
							Il s’adresse à tout type de public (particuliers, professionnels, collectivités…) et permet de recenser des mares de Normandie, de décrire leurs principales caractéristiques à partir de la fiche de caractérisation (<a href="../doc/Fiche_caracterisation_simplifiee.pdf" target="_bank">simplifiée</a> ou <a href="../doc/Fiche_caracterisation_mare_2016.pdf" target="_bank">complète</a>) et de saisir les espèces de la faune et de la flore qui y vivent.</br></br>
							
							N'hésitez pas à consulter <a href="../doc/Manuel_Utilisation_PRAM.pdf" target='_bank'>la documentation utilisateur</a>.</br>
							
							Pour toute autre demande, <a href='' target='_bank'>contacter l'équipe du PRAM Normandie</a>.</br></br>
						</p>
					</td>
					<td rowspan="3" width="2%"></td>
					<td colspan="2" align="center">
						<p>
							<b>Nombre de mares localisées : <?php echo $nbmare ?></b></br>
							<b>Nombre de mares caractérisées : <?php echo $nbmarecarac ?></b></br>
							<b>Nombre d'observations faune/flore : <?php echo $nbobs ?></b>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<a href="http://www.pramnormandie.com" target='_bank'><img src="../img/pram.jpg" width="60%"></a>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="" target='_bank'><img src="../img/financeur_1.jpg"></a>
					</td>
					<td align="center">
						<a href="" target='_bank'><img src="../img/financeur_2.png"></a>
					</td>
				</tr>
				<tr height="10%">
					<td colspan="5" align="center">
							<img id="button" src="../img/displaymare.png" title="Afficher toutes les mares de Normandie" alt="Afficher toutes les mares de Normandie" value="Afficher toutes les mares de Normandie" onClick="load_page('cartographie/cartographie.php', 'allmare', 'allmare')">
							<img id="button" src="../img/drawmare.png" title="Consulter ou saisir des mares sur la Normandie" alt="Consulter ou saisir des mares sur la Normandie" value="Consulter ou saisir des mares sur la Normandie" onClick="if(confirm('Pour saisir des mares, vous devrez vous identifier.')){afficher_masquer('bodypage','')};">
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div id="erreur_connexion" style="display:none"></div>
	<div id="erreur" style="display:none"></div>
	<div id="valider" style="display:none"></div>
	<div id="connexion">
		<table class="tableconnexion" height="100%">
			<tr>
				<td id="hover" onClick="afficher_masquer('connexion','connexion_ajax.php')">
					<table class="tableconnexion"  height="100%">
						<tr>
							<td align="right" width="15%"><img src="../img/door2.png"></td>
							<th align="left" width="35%">M'identifier</th>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="hautpage">
		<div id="imgpram"></div>
		<div id="menu">
			<input style="width:90%;display:none" type="text" id="Session" value="Inactive">
			<table width="100%" border="0">
				<tr><td colspan="5"><b style="font-size:20px">Programme régional d'actions en faveur des mares de Normandie</b></td></tr>
				<tr>
					<td><img src="../img/menu_nc.png"></td>
					<td><img src="../img/edit_nc.png"></td>
					<td><img src="../img/folder_into_nc.png"></td>
					<td id="hover3" onClick="afficher_masquer('exporthorsconnexion','');setTimeout('afficher_masquer(\'exporthorsconnexion\',\'\')',5000);"><img src="../img/folder_out.png" title="Exportation" alt="Exportation"></td>
				</tr>
			</table>
		</div>
	</div>
	
	<div id="search">
		<table width="100%">
			<tr><th>FILTRE ET RECHERCHE MARE</th></tr>
			<tr>
				<td width="100%" align="center" colspan="2">
					<div id="Nom_Departement" style="display:inline">
						<?php echo simpleDisplayDepartement($listeDepartement, 'ID_DEPARTEMENT', 'Num_Dep', 'Num_Dep', 0, 'Nom_Commune();Interco_Dep();Mare_Dep();recherchedepartement();', '', 'map.scrollWheelZoom.disable();map.dragging.disable()'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center" colspan="2">
					<div id="Nom_Interco" style="display:inline">
						<?php echo simpleDisplayIntercommunalite($listeInterco, 'ID_INTERCO', 'Num_fiscalite', 'Intercommunalite', 0, '', 'map.scrollWheelZoom.disable();map.dragging.disable()'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center" colspan="2">
					<div id="Nom_Commune" style="display:inline">
						<?php echo simpleDisplayCommune($listeCommune, 'ID_COMMUNE', 'Num_INSEE', 'Nom_Commune', 0, 'Mare();recherchecommune()', 'map.scrollWheelZoom.disable();map.dragging.disable()'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center" colspan="2">
					<div id="Num_Mare" style="display:inline">
						<?php echo simpleDisplayMare($listeMare, 'ID_MARE', 'L_ID', 'L_ID', 'Tous', 'recherchemare();map.scrollWheelZoom.disable();', 'map.scrollWheelZoom.disable();map.dragging.disable()'); ?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	
			
			
			
			
	
	<div id="map">
		<!--<div id="optionzoom">
			<table width="99%" height="100%">
				<tr><th>OUTILS DE ZOOM</th></tr>
			</table>
		</div>
		
		<div id="ctrllayer">
			<table width="99%" height="100%">
				<tr><th>CONTROLE DES COUCHES</th></tr>
			</table>
		</div>-->
				
		<div id="outildessin" style="display:none">
			<table width="99%" height="100%">
				<tr><th>SAISIE D'UNE MARE</th></tr>
			</table>
		</div>
		<div id="searchcoord">
			<table width="100%" border="0">
				<tr><th colspan="3">RECHERCHE COORDONNEES</th></tr>
				<tr>
					<td align="center">
						<input type="text" value="" title="Longitude" id="Longitude_search" placeholder="Longitude">
					</td>
					<td align="center">
						<input type="text" value="" title="Latitude" id="Latitude_search" placeholder="Latitude" onkeypress = "if(event.keyCode == 13){recherchecoordlatlng('error_coord.php?typecoord=latlng','erreur')}">
					</td>
					<td align="center">
						<img src="../img/search.png" onClick="recherchecoordlatlng('error_coord.php?typecoord=latlng','erreur')" title="Recherche" width="20">
					</td>
				</tr>
				<tr>
					<td align="center">
						<input type="text" value="" title="X Lambert93" id="xl93_search" placeholder="X Lambert93">
					</td>
					<td align="center">
						<input type="text" value="" title="Y Lambert93" id="yl93_search" placeholder="Y Lambert93" onkeypress = "if(event.keyCode == 13){recherchecoordlambert93('error_coord.php?typecoord=lambert93','erreur','transfocoord.php','transform')}">
					</td>
					<td align="center">
						<img src="../img/search.png" onClick="recherchecoordlambert93('error_coord.php?typecoord=lambert93','erreur','transfocoord.php','transform')" title="Recherche" width="20">
					</td>
				</tr>
			</table>
		</div>
		<div id="legend">
			<table width="100%" border="0">
				<tr><th colspan="3">LEGENDE</tr>
				<tr>
					<td width="2%" align="center">
						<img src="../img/docs/mare_caracterisee_legende.png" OnClick="afficher_masquer('legendedetaillee','')">
					</td>
					<th width="10%" align="left" OnClick="afficher_masquer('legendedetaillee','')">
						Mare caractérisée |?|
					</th>
				</tr>
				<tr>
					<td width="2%" align="center">
						<img src="../img/docs/mare_vue_legende.png" OnClick="afficher_masquer('legendedetaillee','')">
					</td>
					<th width="10%" align="left" OnClick="afficher_masquer('legendedetaillee','')">
						Mare vue |?|
					</th>
				</tr>
				<tr>
					<td width="2%" align="center">
						<img src="../img/docs/mare_potentiel_legende.png" OnClick="afficher_masquer('legendedetaillee','')">
					</td>
					<th width="10%" align="left" OnClick="afficher_masquer('legendedetaillee','')">
						Mare potentielle |?|
					</th>
				</tr>
				<tr>
					<td width="2%" align="center">
						<img src="../img/docs/mare_disparue_legende.png" OnClick="afficher_masquer('legendedetaillee','')">
					</td>
					<th width="10%" align="left" OnClick="afficher_masquer('legendedetaillee','')">
						Mare disparue |?|
					</th>
				</tr>
				<tr></tr>
				<tr></tr>
				<tr>
					<th width="10%" align="center">
						Echelle
					</th>
				</tr>
			</table>
		</div>
	
		
			<div id="legendedetaillee">
				<div id="textafficahge">
					<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('legendedetaillee','affichage_vide.php')"/>
					<h3>Légende détaillée</h3>
					<div id="resultat_leg">
						<table width="100%" border="0">
							<tr>
								<th width="2%" align="center">
									<img src="../img/docs/mare_caracterisee_legende.png">
								</th>
								<td width="10%" align="left">
									Mare caractérisée : Mare qui a fait l’objet d’une description de ses caractéristiques via la fiche de caractérisation (<a href="../doc/Fiche_caracterisation_simplifiee.pdf" target="_bank">simplifiée</a> ou <a href="../doc/Fiche_caracterisation_mare_2016.pdf" target="_bank">complète</a>). Les caractéristiques doivent être saisies sur l’application pour que la mare soit considérée comme caractérisée.
								</td>
							</tr>
							<tr>
								<th width="2%" align="center">
									<img src="../img/docs/mare_vue_legende.png">
								</th>
								<td width="10%" align="left">
									Mare vue : Mare vue sur le terrain.
								</td>
							</tr>
							<tr>
								<th width="2%" align="center">
									<img src="../img/docs/mare_potentiel_legende.png">
								</th>
								<td width="10%" align="left">
									Mare potentielle : Mare détectée sur photo aérienne, scan 25… mais dont sa présence effective n’a pas été vérifiée sur le terrain.
								</td>
							</tr>
							
							<tr>
								<th width="2%" align="center">
									<img src="../img/docs/mare_disparue_legende.png">
								</th>
								<td width="10%" align="left">
									Mare disparue : Mare dont on a connaissance de son existence passée (par exemple, au travers d’un témoignage, d’une photo aérienne ancienne, d’un PLU…), mais qui n’est plus visible sur le terrain (mare totalement boisée, comblée, sous un lotissement…).
								</td>
							</tr>	
						</table>
					</div>
				</div>
				<div id="piedaffichage">
					<table align="center" width="100%" border="0">
						<tr>
							<td colspan="11">
								<!--<fieldset class="pied_popup" align="center">
									<table align="center" border="0">
										<tr>
											<td width="30" align="center">
												<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('legendedetaillee','affichage_vide.php')">
											</td>
										</tr>
									</table>
								</fieldset>-->
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div id="formconnexion" style="display:none">
				<table width="100%" align="center" class="connexion_tableau">
					<tr>
						<td width="35%"><img src="../img/observateur.png"></td>
						<td width="60%"><input style="width:90%;" name="Identifiant" id="Identifiant" tabindex="1" type="text" value=""></td>
					</tr>
					<tr>
						<td width="35%"><img src="../img/lock.png"></td>
						<td width="60%"><input style="width:90%;" name="Password" id="Password" tabindex="2" type="password" value="" onkeypress = "if(event.keyCode == 13){EnvoieReqConnexion('connexion_traitement.php', 'connexion_session');affichermenu('affichermenuconnexion.php','majconnexion')}"></td>
					</tr>
					<tr>
						<td id="hover2" onClick="load_page('identifiant/mdp_perdu.php', 'affichage', 'affichage')" width="35%">Mot de passe oublié ?</td>
						<td id="hover2" width="60%" align="center"><input width="20" type="image" tabindex="3" onClick="EnvoieReqConnexion('connexion_traitement.php', 'connexion_session');affichermenu('affichermenuconnexion.php','majconnexion')" src="../img/check.png" Title="Valider"></td>
					</tr>
					<tr>
						<td id="hover" onClick="load_page('identifiant/identifiant.php', 'affichage', 'affichage')" colspan="2">Inscription</td><tr>
					</tr>
				</table>
			</div>
			
			<div id="connexion_session">
				<input type="text"  id="session" value="Inactive">
				<input type="text"  id="idstructureconnectee" value="test"></br>
				<input type="text"  id="rolestructure" value="test"></br>
				<input type="text"  id="latitudemap" value=""></br>
				<input type="text"  id="longitudemap" value=""></br>
			</div>
			
			<div id="transform"></div>	
	</div>
	<div id="allmare"></div>
	<div id="observateur"></div>
	<div id="affichage"></div>
	
	<div id="baspage">
		<table height="10%" border="0">
			<tr>
				<td width="1%"></td>
				<td align="center" width="5%">
					<a href="http://www.cen-normandie.fr/" target="_bank"><img src="../img/logo_cen1_api.jpg"/></a>
				</td>
				<td align="center" width="5%">
					<a href="http://www.cen-normandie.fr/" target="_bank"><img src="../img/logo_cen2_api.png"/></a>
				</td>
				<td width="5%" id="hover3"><a href="../doc/Manuel_Utilisation_PRAM.pdf" target="_bank">Documentation utilisateur</a></td>
				<td width="5%" id="hover3"><a href="../doc/mentions_legales_pram.pdf" target="_bank">Mentions légales</a></td>
				<td width="5%" id="hover3" onClick="load_page('credits.php', 'affichage', 'affichage')">Crédits</td>
		</table>
	</div>
	
	<div id="exporthorsconnexion">
		<table width="100%">
			<tr>
				<td width="100%" align="center">
					<h2 onClick="load_page('export_xls/demandeaccesmare.php?ID_STRUCTURE=0', 'affichage', 'tableau')">Demande d'extraction de données</h2>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="majconnexion"></div>
	
	<script type="text/javascript" src="js/leaflet/leaflet.js"></script>
	<!-- Leaflet Plugins -->
	<link rel="stylesheet" href="js/src/Control.MiniMap.css" />
	<link rel="stylesheet" href="js/draw/leaflet.css" />
	<link rel="stylesheet" href="js/dist/leaflet.draw.css" />
	<script src="js/src/Control.MiniMap.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

	<script src="js/leafletlabel/Label.js"></script>
	<script src="js/leafletlabel/BaseMarkerMethods.js"></script>
	<script src="js/leafletlabel/Marker.Label.js"></script>
	<script src="js/leafletlabel/CircleMarker.Label.js"></script>
	<script src="js/leafletlabel/Path.Label.js"></script>
	<script src="js/leafletlabel/Map.Label.js"></script>
	<script src="js/leafletlabel/FeatureGroup.Label.js"></script>

	<script src="js/draw/leaflet-src.js"></script>
	<script src="js/Leaflet.draw.js"></script>
	<script src="js/Toolbar.js"></script>
	<script src="js/Tooltip.js"></script>
	<script src="js/ext/GeometryUtil.js"></script>
	<script src="js/ext/LatLngUtil.js"></script>
	<script src="js/ext/LineUtil.Intersect.js"></script>
	<script src="js/ext/Polygon.Intersect.js"></script>
	<script src="js/ext/Polyline.Intersect.js"></script>
	<script src="js/ext/TouchEvents.js"></script>
	<script src="js/draw/DrawToolbar.js"></script>
	<script src="js/draw/handler/Draw.Feature.js"></script>
	<script src="js/draw/handler/Draw.SimpleShape.js"></script>
	<script src="js/draw/handler/Draw.Polyline.js"></script>
	<script src="js/draw/handler/Draw.Circle.js"></script>
	<script src="js/draw/handler/Draw.Marker.js"></script>
	<script src="js/draw/handler/Draw.Polygon.js"></script>
	<script src="js/draw/handler/Draw.Rectangle.js"></script>
	<script src="js/edit/EditToolbar.js"></script>
	<script src="js/edit/handler/EditToolbar.Edit.js"></script>
	<script src="js/edit/handler/EditToolbar.Delete.js"></script>
	<script src="js/Control.Draw.js"></script>
	<script src="js/edit/handler/Edit.Poly.js"></script>
	<script src="js/edit/handler/Edit.SimpleShape.js"></script>
	<script src="js/edit/handler/Edit.Circle.js"></script>
	<script src="js/edit/handler/Edit.Rectangle.js"></script>
	<script src="js/edit/handler/Edit.Marker.js"></script>
	<script type="text/javascript" src="js/init_leaflet.js"></script>
</body>