<?php
	//Demare la session
	session_start();
	//connection BDD
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES VARAIBLES
	$ID = $_GET['L_ID'];
	
	if(isset($_GET['ID_CARAC'])){
		//Appelle la fonction pour cr�er une nouvelle ligne de caract�risation pour la mare donn�e
		$ID_CARAC = $_GET['ID_CARAC'];
		//ON VA FAIRE UNE REQUETE POUR RECUPERER LES VALEURS DES LISTES DEROULANTE
		$req_carac = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
		$donnees_carac = pg_fetch_array($req_carac);
	}else{
		$ID_CARAC = ajoutCaracteristique($bdd,$ID);
	}

	//Requete sur la base utilisateur pour connaitre le pr�nom de l'utilisateur
	$req_aut = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION" ='."'".$_SESSION['Identifiant']."'".'');
	$donnees_aut = pg_fetch_array($req_aut);
		
	//FAUT RECUPERER LA LISTE AVEC TOUS LES SALARIES, MAIS UNE SEULE FOIS :)
	$listStructure = array();
	$req = pg_query($bdd, 'SELECT * FROM saisie_observation.structure ORDER BY "STRUCTURE"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listStructure, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listObs = array();
	$req = pg_query($bdd, 'SELECT * FROM saisie_observation.observateur, saisie_observation.structure WHERE structure."STRUCTURE" = observateur."OBS_STRUCTURE" AND structure."S_ID_SESSION"=E'."'".utf8_decode(addslashes($_SESSION['Identifiant']))."'".' ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listObs, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listTypeMare = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_type ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listTypeMare, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listVeget = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_veget ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listVeget, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listAbreuvoir = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_abreuv ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listAbreuvoir, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listHaie = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_haie ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listHaie, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listForm = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_form ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listForm, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listProf = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_prof ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listProf, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listOmbrage = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_ombrage ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listOmbrage, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listBerges = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_berges ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listBerges, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listEmbrou = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_embrous ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listEmbrou, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listEAEE= array();
	$req = pg_query($bdd, 'SELECT "ID", ("NOM_VERNACULAIRE" || '."' / '".' || "TAXON") AS "NOM_TAXON" FROM menu_deroulant.c_eaee ORDER BY "NOM_VERNACULAIRE"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listEAEE, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listEVEE= array();
	$req = pg_query($bdd, 'SELECT "ID", ("NOM_VERNACULAIRE" || '."' / '".' || "TAXON") AS "NOM_TAXON" FROM menu_deroulant.c_evee ORDER BY "NOM_VERNACULAIRE"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listEVEE, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listEVEEpourcent= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_evee_pourcent ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listEVEEpourcent, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listPietinement = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_pietinement ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listPietinement, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listNatFond = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_natfond ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listNatFond, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listBourrelet = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_bourrelet ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listBourrelet, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listTopo = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_topo ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listTopo, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listContext = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_context ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listContext, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listHydro = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_hydrologie ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listHydro, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listLiaison = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_liaison ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listLiaison, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listAlimentation = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_alimentation ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listAlimentation, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listTurbidite = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_turbidite ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listTurbidite, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listTampon = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_tampon ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listTampon, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listCouleur = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_couleur ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listCouleur, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listExutoire = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_exutoire ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listExutoire, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listEvolution = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_evolution ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listEvolution, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	// $listPotentiel = array();
	// $req = $bdd->query('SELECT * FROM pram_c_potentiel ORDER BY ID'); 
	// while($donnees = $req->fetch())
	// {
		// array_push($listPotentiel, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	// }
	
	$listFaune = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_faune ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listFaune, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}

	// $listAutespeces = array();
	// $req = $bdd->query('SELECT * FROM pram_c_autespeces ORDER BY ID'); 
	// while($donnees = $req->fetch())
	// {
		// array_push($listAutespeces, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	// }
	
	// $listExotique = array();
	// $req = $bdd->query('SELECT * FROM pram_c_exotique ORDER BY ID'); 
	// while($donnees = $req->fetch())
	// {
		// array_push($listExotique, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	// }
	
	$listPatrimoine = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_patrimoine ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listPatrimoine, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listDechets = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_dechets ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listDechets, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listCloture = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_cloture ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listCloture, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listUsage= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_usage ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listUsage, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listTravaux= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_travaux ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listTravaux, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
?>
<input style="width:90%;display:none" type="text" id="L_ID" value="<?php echo $ID ?>">
<input style="width:90%;display:none" type="text" id="ID_CARAC" value="<?php echo $ID_CARAC ?>">
<div id="textafficahge_carac_edit">	
<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
<h1>Caractérisation complète de la mare</h1>
<p><b>La caractérisation d'une mare s'effectue sur le terrain à l'aide de la <a href="../doc/Fiche_caracterisation_mare_2016.pdf" target="_bank">fiche de caractérisation</a></b>. Les données générales sont obligatoires (*). Les autres parties sont facultatives.</p>
	<div id="resultat_carac_edit">	
		<table border="0" width="90%">
			<tr height="5"><td colspan="2"><legend><b>Données générales</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<tr align="center">
				<th width="25%">Date de caractérisation* : </th>
				<td width="75%"><input style="width:90%" type="text" id="C_DATE" value="<?php if(isset($_GET['ID_CARAC'])){ echo date('d/m/Y', $donnees_carac['C_DATE']);}?>" placeholder="JJ/MM/AAAA"  tabindex="20"></td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Structure* : </th>
				<td width="75%"><?php echo simpleDisplaySelectDisabled($listStructure, 'C_STRP', 'S_ID', 'STRUCTURE', $donnees_aut['S_ID'], '', 21, 'disabled'); ?></td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<!-- sur le onclick de lobservateur on va creer la ligne dans la table caractérisation car on a beoin de l'identifiant pour enregistretr les prochaine données-->
				<th width="25%">Observateur* : </th>
				<td width="75%">
					<div id="actualise_observateurcarac">
					<?php
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect($listObs, 'C_OBSV', 'ID', 'OBS_NOM_PRENOM', $donnees_carac['C_OBSV'], '', 22); ?>       <img src="../img/observateur_add.png" alt="Ajouter un observateur" title="Ajouter un observateur" width="20" onClick="load_page('observateurs/observateurs_carac.php?ID_STRUCTURE=<?php echo  $donnees_aut['S_ID'];?>', 'observateur', 'observateur')"/> <?php
						}else{
							echo simpleDisplaySelect($listObs, 'C_OBSV', 'ID', 'OBS_NOM_PRENOM', 0, '', 22); ?>       <img src="../img/observateur_add.png" alt="Ajouter un observateur" title="Ajouter un observateur" width="20" onClick="load_page('observateurs/observateurs_carac.php?ID_STRUCTURE=<?php echo  $donnees_aut['S_ID'];?>', 'observateur', 'observateur')"/> <?php
						}
					?>
					</div>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Type de mare* : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listTypeMare, 'C_TYPE', 'ID', 'TYPE', $donnees_carac['C_TYPE'], '', 23);
						}else{
							echo simpleDisplaySelect2($listTypeMare, 'C_TYPE', 'ID', 'TYPE', 0, '', 23);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Groupes faunistiques observé* : </th>
				<td width="75%">
					<form id="form_faune" name="form_faune">
						<div id="faune_resultat">
							<?php 
								if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ 
									echo simpleDisplayCheckBox($listFaune, 'C_FAUNE', 'ID', 'FAUNE', 0, 23, 'TypeTableau', $ID_CARAC, $bdd, 'faune_resultat', 'checkBoxFauneCheck', 'checkBoxFauneOutcheck');
								}else{
									echo simpleDisplayCheckBox($listFaune, 'C_FAUNE', 'ID', 'FAUNE', 0, 23, '', $ID_CARAC, $bdd, 'faune_resultat', 'checkBoxFauneCheck', 'checkBoxFauneOutcheck');
								}
							?>
						</div>
					</form>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td width="50%" colspan="2">
					<?php 
						if(isset($_GET['ID_CARAC'])){
						//ON VA FAIRE UNE REQUETE POUR RECUPERE LES DONNES DES TABLES
						$req_faune = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_faune WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "FAUNE" = 7');
						$donnees_faune = pg_fetch_array($req_faune);
							if($donnees_faune['FAUNE'] == 7){
					?>
					<div id="faunistique_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser autre groupe faunistique* : </th>
								<td width="75%">
									<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
											<input style="width:90%" type="text" id="C_FAUNE_AUTRE" value="<?php echo $donnees_faune['FAUNE_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'faunistique_autre', 'checkBoxFauneAutreOutcheck')" tabindex="26">
									<?php }else{ ?>
											<input style="width:90%" type="text" id="C_FAUNE_AUTRE" value="<?php echo $donnees_faune['FAUNE_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'faunistique_autre', 'checkBoxFauneAutreOutcheck')" tabindex="26">
									<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php
							}else{
								?>
								<div style="display:none" id="faunistique_autre">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser autre groupe faunistique* : </th>
											<td width="75%">
												<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
														<input style="width:90%" type="text" id="C_FAUNE_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'faunistique_autre', 'checkBoxFauneAutreOutcheck')" tabindex="26">
												<?php }else{ ?>
														<input style="width:90%" type="text" id="C_FAUNE_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'faunistique_autre', 'checkBoxFauneAutreOutcheck')" tabindex="26">
												<?php } ?>
											</td>
										</tr>
									</table>
								</div>				
								<?php
							}
						}
						else {					
					?>
					<div style="display:none" id="faunistique_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser autre groupe faunistique* : </th>
								<td width="75%">
									<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
											<input style="width:90%" type="text" id="C_FAUNE_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'faunistique_autre', 'checkBoxFauneAutreOutcheck')" tabindex="26">
									<?php }else{ ?>
											<input style="width:90%" type="text" id="C_FAUNE_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'faunistique_autre', 'checkBoxFauneAutreOutcheck')" tabindex="26">
									<?php } ?>
								</td>
							</tr>
						</table>
					</div>				
					<?php } ?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Végétation aquatique* : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listVeget, 'C_VEGET', 'ID', 'VEGET', $donnees_carac['C_VEGET'], '', 24);
						}else{
							echo simpleDisplaySelect2($listVeget, 'C_VEGET', 'ID', 'VEGET', 0, '', 24);
						}
					?>
				
				<?php ; ?></td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Stade d'évolution* : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listEvolution, 'C_EVOLUTION', 'ID', 'EVOLUTION', $donnees_carac['C_EVOLUTION'], '', 25);
						}else{
							echo simpleDisplaySelect2($listEvolution, 'C_EVOLUTION', 'ID', 'EVOLUTION', 0, '', 25);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="100%" colspan="2" align="center"><img align="center" src="../img/schema_stadeevolution.png"></th>
			</tr>
			<tr align="center">
				
			</tr>
			<tr height="5"><td colspan="4"><legend><b>Usages</b></legend></td></tr>
			<tr height="5"><td colspan="4"><hr></td></tr>
			<tr align="center">
				<th width="25%">Usage principal : </th>
				<td width="75%">
					<div id="usage_resultat">
						<?php 
							if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ 
								echo simpleDisplayCheckBox($listUsage, 'C_USAGE', 'ID', 'USAGE', 0, 27, 'TypeTableau', $ID_CARAC, $bdd, 'usage_resultat', 'checkBoxUsageCheck', 'checkBoxUsageOutcheck');
							}else{
								echo simpleDisplayCheckBox($listUsage, 'C_USAGE', 'ID', 'USAGE', 0, 27, '', $ID_CARAC, $bdd, 'usage_resultat', 'checkBoxUsageCheck', 'checkBoxUsageOutcheck');
							}
						?>
					</div>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Mare équipée d'une pompe à nez : </th>
				<td width="75%">
				<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listAbreuvoir, 'C_ABREUV', 'ID', 'ABREUV', $donnees_carac['C_ABREUV'], '', 28);
						}else{
							echo simpleDisplaySelect2($listAbreuvoir, 'C_ABREUV', 'ID', 'ABREUV', 0, '', 28);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Présence de déchets : </th>
				<td width="75%">
					<form id="form_dechets" name="form_dechets">
					<div id="dechets_resultat">
						<?php 
							if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ 
								echo simpleDisplayCheckBox($listDechets, 'C_DECHETS', 'ID', 'DECHETS', 0, 29, 'TypeTableau', $ID_CARAC, $bdd, 'dechets_resultat', 'checkBoxDechetsCheck', 'checkBoxDechetsOutcheck');
							}else{
								echo simpleDisplayCheckBox($listDechets, 'C_DECHETS', 'ID', 'DECHETS', 0, 29, '', $ID_CARAC, $bdd, 'dechets_resultat', 'checkBoxDechetsCheck', 'checkBoxDechetsOutcheck');
							}
						?>
					</div>
					</form>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr height="5"><td colspan="2"><legend><b>Situation de la mare</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<tr align="center">
				<th width="25%">Topographie : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listTopo, 'C_TOPO', 'ID', 'TOPO', $donnees_carac['C_TOPO'], 'afficher_masquer("topo","")', 30); 
						}else{
							echo simpleDisplaySelect2($listTopo, 'C_TOPO', 'ID', 'TOPO', 0, 'afficher_masquer("topo","")', 30); 
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td width="100%" colspan="2">
					<?php 
					if(isset($_GET['ID_CARAC'])){
							if($donnees_carac['C_TOPO'] == 5){
					?>
								<div id="topo_autre">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Présicer : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_TOPO_AUTRE" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_TOPO_AUTRE'];}?>"  tabindex="31"></td>
										</tr>
									</table>
								</div>
					<?php
							}else{
								?>
								<div style="display:none" id="topo_autre">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Présicer : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_TOPO_AUTRE" value=""  tabindex="31"></td>
										</tr>
									</table>
								</div>			
							<?php
							}
						}else{
					?>
								<div style="display:none" id="topo_autre">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Présicer : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_TOPO_AUTRE" value=""  tabindex="31"></td>
										</tr>
									</table>
								</div>			
					<?php } ?>	
				
				
				
				
					
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Contexte de la mare <br/>(2 choix possibles pour les mares en situation de lisière) : </th>
				<td width="75%">
					<form id="form_mare" name="form_mare">
						<div id="context_resultat">
							<?php 
							if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ 
								echo simpleDisplayCheckBox($listContext, 'L_CONT', 'ID', 'CONTEXT', 0, 32, 'TypeTableau', $ID_CARAC, $bdd, 'context_resultat', 'checkBoxContextCheck', 'checkBoxContextOutcheck'); 
							}else{
								echo simpleDisplayCheckBox($listContext, 'L_CONT', 'ID', 'CONTEXT', 0, 32, '', $ID_CARAC, $bdd, 'context_resultat', 'checkBoxContextCheck', 'checkBoxContextOutcheck'); 
							}
							?>
						</div>
					</form>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Petit patrimoine associé :</th>
				<td width="75%">
					<form id="form_patrimoine" name="form_patrimoine">
						<div id="patrimoine_resultat">
							<?php 
								if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ 
									echo simpleDisplayCheckBox($listPatrimoine, 'C_PATRIMOINE', 'ID', 'PATRIMOINE', 0, 33, 'TypeTableau', $ID_CARAC, $bdd, 'patrimoine_resultat', 'checkBoxPatrimoineCheck', 'checkBoxPatrimoineOutcheck');
								}else{
									echo simpleDisplayCheckBox($listPatrimoine, 'C_PATRIMOINE', 'ID', 'PATRIMOINE', 0, 33, '', $ID_CARAC, $bdd, 'patrimoine_resultat', 'checkBoxPatrimoineCheck', 'checkBoxPatrimoineOutcheck');
								}
							?>
						</div>
					</form>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td width="100%" colspan="2">
					<?php 
						if(isset($_GET['ID_CARAC'])){
						//ON VA FAIRE UNE REQUETE POUR RECUPERE LES DONNES DES TABLES
						$req_patrimoine = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_patrimoine WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
						$donnees_patrimoine = pg_fetch_array($req_patrimoine);
							if($donnees_patrimoine['PATRIMOINE'] == 6){
					?>
					<div id="patrimoine_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser autre patrimoine : </th>
								<td width="75%">
									<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
										<input style="width:90%" type="text" id="C_PATRIMOINE_AUTRE" value="<?php echo $donnees_patrimoine['PATRIMOINE_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'patrimoine_autre', 'checkBoxPatrimoineAutreOutcheck')" tabindex="34">
									<?php }else{ ?>
										<input style="width:90%" type="text" id="C_PATRIMOINE_AUTRE" value="<?php echo $donnees_patrimoine['PATRIMOINE_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'patrimoine_autre', 'checkBoxPatrimoineAutreOutcheck')" tabindex="34">
									<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php
						}else{
					?>	
							<div style="display:none" id="patrimoine_autre">
								<table width="100%">
									<tr align="center"> 
										<th width="25%">Préciser autre patrimoine : </th>
										<td width="75%">
											<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
												<input style="width:90%" type="text" id="C_PATRIMOINE_AUTRE" value="<?php echo $donnees_patrimoine['PATRIMOINE_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'patrimoine_autre', 'checkBoxPatrimoineAutreOutcheck')" tabindex="34">
											<?php }else{ ?>
												<input style="width:90%" type="text" id="C_PATRIMOINE_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'patrimoine_autre', 'checkBoxPatrimoineAutreOutcheck')" tabindex="34">
											<?php } ?>
										</td>
									</tr>
								</table>
							</div>
					<?php	
						}
					}
					else {					
					?>
					<div style="display:none" id="patrimoine_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser autre patrimoine : </th>
								<td width="75%">
									<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
										<input style="width:90%" type="text" id="C_PATRIMOINE_AUTRE" value="<?php echo $donnees_patrimoine['PATRIMOINE_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'patrimoine_autre', 'checkBoxPatrimoineAutreOutcheck')" tabindex="34">
									<?php }else{ ?>
										<input style="width:90%" type="text" id="C_PATRIMOINE_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'patrimoine_autre', 'checkBoxPatrimoineAutreOutcheck')" tabindex="34">
									<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php } ?>			
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Mare clôturée : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listCloture, 'C_CLOTURE', 'ID', 'CLOTURE', $donnees_carac['C_CLOTURE'], '', 35);
						}else{
							echo simpleDisplaySelect2($listCloture, 'C_CLOTURE', 'ID', 'CLOTURE', 0, '', 35);
						}
					?>	
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Présence d'une haie en contact avec la mare: </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listHaie, 'C_HAIE', 'ID', 'HAIE', $donnees_carac['C_HAIE'], '', 36);
						}else{
							echo simpleDisplaySelect2($listHaie, 'C_HAIE', 'ID', 'HAIE', 0, '', 36);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr height="5"><td colspan="2"><legend><b>Caractéristiques abiotique de la mare</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<tr align="center">
				<th width="25%">Forme de la mare : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listForm, 'C_FORM', 'ID', 'FORM', $donnees_carac['C_FORM'], '', 37);
						}else{
							echo simpleDisplaySelect2($listForm, 'C_FORM', 'ID', 'FORM', 0, '', 37);	
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Longueur (m) : </th>
				<td width="75%"><input style="width:90%" type="text" id="C_LONG" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_LONG'];}else{ echo "0";}?>" tabindex="38"></td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Largeur (m) : </th>
				<td width="25%"><input style="width:90%" type="text" id="C_LARG" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_LARG'];}else{ echo "0";}?>" tabindex="39"></td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Hauteur d'eau maximum observée aujourd'hui : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listProf, 'C_PROF', 'ID', 'PROF', $donnees_carac['C_PROF'], '', 40);
						}else{
							echo simpleDisplaySelect2($listProf, 'C_PROF', 'ID', 'PROF', 0, '', 40);	
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Nature du fond de la mare : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listNatFond, 'C_NATFOND', 'ID', 'NATFOND', $donnees_carac['C_NATFOND'], 'afficher_masquer("naturefond","")', 41);
						}else{
							echo simpleDisplaySelect2($listNatFond, 'C_NATFOND', 'ID', 'NATFOND', 0, 'afficher_masquer("naturefond","")', 41);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td width="100%" colspan="2">
					<?php 
					if(isset($_GET['ID_CARAC'])){
							if($donnees_carac['C_NATFOND'] == 5){
					?>
								<div id="naturefond_autre">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser autre nature du fond : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_NATFOND_AUTRE" value="<?php echo $donnees_carac['C_NATFOND_AUTRE'] ?>"  tabindex="42"></td>
										</tr>
									</table>
								</div>
					<?php
							}else{
								?>
								<div style="display:none" id="naturefond_autre">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser autre nature du fond : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_NATFOND_AUTRE" value=""  tabindex="42"></td>
										</tr>
									</table>
								</div>				
								<?php
							}
						}else{
					?>
								<div style="display:none" id="naturefond_autre">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser autre nature du fond : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_NATFOND_AUTRE" value=""  tabindex="42"></td>
										</tr>
									</table>
								</div>				
					<?php } ?>	
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Berges en pente douce (% du périmètre de la mare) : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listBerges, 'C_BERGES', 'ID', 'BERGES', $donnees_carac['C_BERGES'], '', 43);
						}else{
							echo simpleDisplaySelect2($listBerges, 'C_BERGES', 'ID', 'BERGES', 0, '', 43);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Bourrelet de curage : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listBourrelet, 'C_BOURRELET', 'ID', 'BOURRELET', $donnees_carac['C_BOURRELET'], 'afficher_masquer("bourrelet","")', 44);
						}else{
							echo simpleDisplaySelect2($listBourrelet, 'C_BOURRELET', 'ID', 'BOURRELET', 0, 'afficher_masquer("bourrelet","")', 44);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">	
				<td width="100%" colspan="2">
					<?php 
					if(isset($_GET['ID_CARAC'])){
							if($donnees_carac['C_BOURRELET'] == 2){
					?>
								<div id="bouret_pourcetage">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser pourcentage (%) : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_BOURRELET_POURCENTAGE" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_BOURRELET_POURCENTAGE'];}?>"  tabindex="45"></td>
										</tr>
									</table>
								</div>
					<?php
							}else{
								?>
								<div style="display:none" id="bouret_pourcetage">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser pourcentage (%) : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_BOURRELET_POURCENTAGE" value=""  tabindex="45"></td>
										</tr>
									</table>
								</div>			
							<?php
							}
						}else{
					?>
								<div style="display:none" id="bouret_pourcetage">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser pourcentage (%) : </th>
											<td width="75%"><input style="width:90%" type="text" id="C_BOURRELET_POURCENTAGE" value=""  tabindex="45"></td>
										</tr>
									</table>
								</div>			
					<?php } ?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Surpiétinement des abords : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listPietinement, 'C_PIETINEMENT', 'ID', 'PIETINEMENT', $donnees_carac['C_PIETINEMENT'], '', 46);
						}else{
							echo simpleDisplaySelect2($listPietinement, 'C_PIETINEMENT', 'ID', 'PIETINEMENT', 0, '', 46);
						}
					?>	
				</td>
			</tr>
			<tr height="5"></tr>
			<tr height="5"><td colspan="2"><legend><b>Hydrologie</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<tr align="center">
				<th width="25%">Régime hydrologique : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							 echo simpleDisplaySelect2($listHydro, 'C_HYDROLOGIE', 'ID', 'HYDROLOGIE', $donnees_carac['C_HYDROLOGIE'], '', 47); 
						}else{
							 echo simpleDisplaySelect2($listHydro, 'C_HYDROLOGIE', 'ID', 'HYDROLOGIE', 0, '', 47); 
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Liaison(s) avec le réseau hydrographique superficiel : </th>
				<td width="75%">
					<form id="form_liaison" name="form_liaison">
						<div id="liaison_resultat">
							<?php 
								if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ 
									echo simpleDisplayCheckBox($listLiaison, 'C_LIAISON', 'ID', 'LIAISON', 0, 48, 'TypeTableau', $ID_CARAC, $bdd, 'liaison_resultat', 'checkBoxLiaisonCheck', 'checkBoxLiaisonOutcheck');							
								}else{
									echo simpleDisplayCheckBox($listLiaison, 'C_LIAISON', 'ID', 'LIAISON', 0, 48, '', $ID_CARAC, $bdd, 'liaison_resultat', 'checkBoxLiaisonCheck', 'checkBoxLiaisonOutcheck');	
								}
							?>
						</div>
					</form>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">	
				<td width="100%" colspan="2">
					<?php 
						if(isset($_GET['ID_CARAC'])){
						//ON VA FAIRE UNE REQUETE POUR RECUPERE LES DONNES DES TABLES
						$req_liaison = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_liaison WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
						$donnees_liaison = pg_fetch_array($req_liaison);
							if($donnees_liaison['LIAISON'] == 6){
					?>
					<div id="liaison_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser autre liaison : </th>
								<td width="75%">
									<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
										<input style="width:90%" type="text" id="C_LIAISON_AUTRE" value="<?php echo $donnees_liaison['LIAISON_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'liaison_autre', 'checkBoxLiaisonAutreOutcheck')" tabindex="49">
									<?php }else{ ?>
										<input style="width:90%" type="text" id="C_LIAISON_AUTRE" value="<?php echo $donnees_liaison['LIAISON_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'liaison_autre', 'checkBoxLiaisonAutreOutcheck')" tabindex="49">
									<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php
						}else{
					?>	
							<div style="display:none" id="liaison_autre">
								<table width="100%">
									<tr align="center"> 
										<th width="25%">Préciser autre liaison : </th>
										<td width="75%">
											<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
												<input style="width:90%" type="text" id="C_LIAISON_AUTRE" value="<?php echo $donnees_liaison['LIAISON_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'liaison_autre', 'checkBoxLiaisonAutreOutcheck')" tabindex="49">
											<?php }else{ ?>
												<input style="width:90%" type="text" id="C_LIAISON_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'liaison_autre', 'checkBoxLiaisonAutreOutcheck')" tabindex="49">
											<?php } ?>
										</td>
									</tr>
								</table>
							</div>
					<?php	
						}
					}
					else {					
					?>
					<div style="display:none" id="liaison_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser autre liaison : </th>
								<td width="75%">
									<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
										<input style="width:90%" type="text" id="C_LIAISON_AUTRE" value="<?php echo $donnees_liaison['LIAISON_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'liaison_autre', 'checkBoxLiaisonAutreOutcheck')" tabindex="49">
									<?php }else{ ?>
										<input style="width:90%" type="text" id="C_LIAISON_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'liaison_autre', 'checkBoxLiaisonAutreOutcheck')" tabindex="49">
									<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php } ?>
				</td>
			</tr>
			<tr height="20"></tr>
			<tr align="center">
				<th width="25%">Alimentation spécifique : </th>
				<td width="75%">
					<form id="form_alimentation" name="form_alimentation">
						<div id="alimentation_resultat">
							<?php 
								if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ 
									echo simpleDisplayCheckBox($listAlimentation, 'C_ALIMENTATION', 'ID', 'ALIMENTATION', 0, 50, 'TypeTableau', $ID_CARAC, $bdd, 'alimentation_resultat', 'checkBoxAlimentationCheck', 'checkBoxAlimentationOutcheck');
								}else{
									echo simpleDisplayCheckBox($listAlimentation, 'C_ALIMENTATION', 'ID', 'ALIMENTATION', 0, 50, '', $ID_CARAC, $bdd, 'alimentation_resultat', 'checkBoxAlimentationCheck', 'checkBoxAlimentationOutcheck');
								}
							?>
						</div>
					</form>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td width="100%" colspan="2">
					<?php 
						if(isset($_GET['ID_CARAC'])){
						//ON VA FAIRE UNE REQUETE POUR RECUPERE LES DONNES DES TABLES
						$req_alim = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_alimentation WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
						$donnees_alim = pg_fetch_array($req_alim);
							if($donnees_alim['ALIMENTATION'] == 7){
					?>
					<div id="alimentation_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser autre alimentation : </th>
								<td width="75%">
								<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
									<input style="width:90%" type="text" id="C_ALIMENTATION_AUTRE" value="<?php echo $donnees_alim['ALIMENTATION_AUTRE'] ?>"  onChange="RecAttribut('mare/enregmare.php', 'alimentation_autre', 'checkBoxAutreAlimentationOutcheck')" tabindex="51"></td>
								<?php }else{ ?>
									<input style="width:90%" type="text" id="C_ALIMENTATION_AUTRE" value="<?php echo $donnees_alim['ALIMENTATION_AUTRE'] ?>"  onChange="RecAttribut('mare/enregmare.php', 'alimentation_autre', 'checkBoxAutreAlimentationOutcheck')" tabindex="51"></td>
								<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php
						}else{
					?>	
							<div style="display:none" id="alimentation_autre">
								<table width="100%">
									<tr align="center"> 
										<th width="25%">Préciser autre alimentation : </th>
										<td width="75%">
										<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
											<input style="width:90%" type="text" id="C_ALIMENTATION_AUTRE" value="<?php echo $donnees_alim['ALIMENTATION_AUTRE'] ?>"  onChange="RecAttribut('mare/enregmare.php', 'alimentation_autre', 'checkBoxAutreAlimentationOutcheck')" tabindex="51"></td>
										<?php }else{ ?>
											<input style="width:90%" type="text" id="C_ALIMENTATION_AUTRE" value=""  onChange="RecAttribut('mare/enregmare.php', 'alimentation_autre', 'checkBoxAutreAlimentationOutcheck')" tabindex="51"></td>
										<?php } ?>
										</td>
									</tr>
								</table>
							</div>
					<?php	
						}
					}
					else {					
					?>
					<div style="display:none" id="alimentation_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser autre alimentation : </th>
								<td width="75%">
								<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
									<input style="width:90%" type="text" id="C_ALIMENTATION_AUTRE" value="<?php echo $donnees_alim['ALIMENTATION_AUTRE'] ?>"  onChange="RecAttribut('mare/enregmare.php', 'alimentation_autre', 'checkBoxAutreAlimentationOutcheck')" tabindex="51"></td>
								<?php }else{ ?>
									<input style="width:90%" type="text" id="C_ALIMENTATION_AUTRE" value=""  onChange="RecAttribut('mare/enregmare.php', 'alimentation_autre', 'checkBoxAutreAlimentationOutcheck')" tabindex="51"></td>
								<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php } ?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Turbidité de l'eau : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							 echo simpleDisplaySelect2($listTurbidite, 'C_TURBIDITE', 'ID', 'TURBIDITE', $donnees_carac['C_TURBIDITE'], '', 52); 
						}else{
							 echo simpleDisplaySelect2($listTurbidite, 'C_TURBIDITE', 'ID', 'TURBIDITE', 0, '', 52); 
						}
					?>
				</td>
				</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Couleur spécifique de l'eau : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							 echo simpleDisplaySelect2($listCouleur, 'C_COULEUR', 'ID', 'COULEUR', $donnees_carac['C_COULEUR'], 'afficher_masquer("couleur","")', 53); 
						}else{
							 echo simpleDisplaySelect2($listCouleur, 'C_COULEUR', 'ID', 'COULEUR', 0, 'afficher_masquer("couleur","")', 53); 
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td width="100%" colspan="2">
					<?php 
					if(isset($_GET['ID_CARAC'])){
							if($donnees_carac['C_COULEUR'] == 3){
					?>
								<div id="couleur_precision">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser la couleur de l'eau : </th>
											<td width="75%">
												<input style="width:90%" type="text" id="C_COULEUR_PRECISION" value="<?php echo $donnees_carac['C_COULEUR_PRECISION'] ?>"  tabindex="54">
											</td>
										</tr>
									</table>
								</div>
					<?php
							}else{
								?>
								<div style="display:none" id="couleur_precision">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser la couleur de l'eau : </th>
											<td width="75%">
												<input style="width:90%" type="text" id="C_COULEUR_PRECISION" value=""  tabindex="54">
											</td>
										</tr>
									</table>
								</div>			
								<?php							
							}
						}else{
					?>
								<div style="display:none" id="couleur_precision">
									<table width="100%">
										<tr align="center"> 
											<th width="25%">Préciser la couleur de l'eau : </th>
											<td width="75%">
												<input style="width:90%" type="text" id="C_COULEUR_PRECISION" value=""  tabindex="54">
											</td>
										</tr>
									</table>
								</div>			
					<?php } ?>	
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Zone tampon : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							 echo simpleDisplaySelect2($listTampon, 'C_TAMPON', 'ID', 'TAMPON', $donnees_carac['C_TAMPON'], '', 55);
						}else{
							echo simpleDisplaySelect2($listTampon, 'C_TAMPON', 'ID', 'TAMPON', 0, '', 55);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Présence d'éxutoire : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listExutoire, 'C_EXUTOIRE', 'ID', 'EXUTOIRE', $donnees_carac['C_EXUTOIRE'], '', 56);
						}else{
							echo simpleDisplaySelect2($listExutoire, 'C_EXUTOIRE', 'ID', 'EXUTOIRE', 0, '', 56);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr height="5"><td colspan="2"><legend><b>Ecologie</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<tr align="center">
				<th width="25%">Recouvrement (total = <input style="width:15%" type="text" tabindex="63" id="C_RECOU_TOTAL" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_RECOU_TOTAL'];}else{ echo "0";}?>">%) : </th>
				<td width="75%">
					<table border="0" width="100%">
						<tr align="center">
							<th style="width:15%"><input style="width:25" type="text" id="C_RECOU_HELOPHYTE" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_RECOU_HELOPHYTE'];}else{ echo "0";}?>"  onChange="maj_total_recouvrement()" tabindex="57">%</th>
							<th style="width:2%">+</th>
							<th style="width:43%"><input style="width:25" type="text" id="C_RECOU_HYDROPHYTE_E" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_RECOU_HYDROPHYTE_E'];}else{ echo "0";}?>" onChange="maj_total_recouvrement()" tabindex="58">%</th>
							<th style="width:2%">+</th>
							<th style="width:7%"><input style="width:25" type="text" id="C_RECOU_HYDROPHYTE_NE" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_RECOU_HYDROPHYTE_NE'];}else{ echo "0";}?>" onChange="maj_total_recouvrement()" tabindex="59">%</th>
							<th style="width:2%">+</th>
							<th style="width:7%"><input style="width:25" type="text" id="C_RECOU_ALGUE" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_RECOU_ALGUE'];}else{ echo "0";}?>" onChange="maj_total_recouvrement()" tabindex="60">%</th>
							<th style="width:2%">+</th>
							<th style="width:7%"><input style="width:25" type="text" id="C_RECOU_EAU_LIBRE" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_RECOU_EAU_LIBRE'];}else{ echo "0";}?>" onChange="maj_total_recouvrement()" tabindex="61">%</th>
							<th style="width:2%">+</th>
							<th style="width:11%"><input style="width:25" type="text" id="C_RECOU_NON_VEGET" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_RECOU_NON_VEGET'];}else{ echo "0";}?>" onChange="maj_total_recouvrement()" tabindex="62">%</th>
						</tr>
						<tr height="5"></tr>
						<tr align="center">
							<td colspan="11"><img src="../img/recouvrement.png"></td>
							<!--<td><img src="../img/helophytes2.png"></td>
							<td><img src="../img/hydrophytes_enracines2.png"></td>
							<td><img src="../img/hydrophytes_non_enracines2.png"></td>
							<td><img src="../img/algues2.png"></td>
							<td><img src="../img/eau_libre2.png"></td>
							<td><img src="../img/non_veget2.png"></td>-->	
						</tr>
					</table>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Boisement / embroussaillement des abords : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listEmbrou, 'C_EMBROUS', 'ID', 'EMBROUS', $donnees_carac['C_EMBROUS'], '', 64);
						}else{
							echo simpleDisplaySelect2($listEmbrou, 'C_EMBROUS', 'ID', 'EMBROUS', 0, '', 64);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Ombrage sur la surface de la mare par les ligneux (quand soleil au zénith) : </th>
				<td width="75%">
					<?php 
						if(isset($_GET['ID_CARAC'])){
							echo simpleDisplaySelect2($listOmbrage, 'C_OMBRAGE', 'ID', 'OMBRAGE', $donnees_carac['C_OMBRAGE'], '', 65);
						}else{
							echo simpleDisplaySelect2($listOmbrage, 'C_OMBRAGE', 'ID', 'OMBRAGE', 0, '', 65);
						}
					?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td colspan="2">
					<table width="100%">
						<tr align="center">
								<th width="23%">Présence d'espèce animale exotique envahissante : </th>
								<td width="77%">
									<?php echo simpleDisplaySelect($listEAEE, 'C_EAEE', 'ID', 'NOM_TAXON', 0, 'RecAttribut("mare/enregmare.php", "eaee_resultat", "eaee")', 66); ?>
								</td>
							
						</tr>
						<tr align="center">
							<th width="23%"></th>
							<td width="77%" colspan="2">
								<div id="eaee_resultat">
									<?php 
										$TYPE = "eaee";
										$MOD = "MODE";
										$ID_MARE = $ID;
										if(isset($_GET['ID_CARAC'])){
											include 'enregmare.php';
										}							
									?>
								</div>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td colspan="2">
					<table width="100%">
						<tr align="center">
								<th width="23%">Présence d'espèce(s) végétale(s) exotique(s) envahissante(s) et % de surface colonisée par cette plante : </th>
								<td width="61%">
									<?php echo simpleDisplaySelect($listEVEE, 'C_EVEE', 'ID', 'NOM_TAXON', 0, '', 67); ?>
								</td>
								<td width="39%">
									<?php echo simpleDisplaySelect2($listEVEEpourcent, 'C_EVEE_POURCENT', 'ID', 'POURCENTAGE', 0, 'RecAttribut("mare/enregmare.php", "evee_resultat", "evee")', 68); ?>
								</td>
							
						</tr>
						<tr align="center">
							<th width="23%"></th>
							<td width="77%" colspan="2">
								<div id="evee_resultat">
									<?php 
										$TYPE = "evee";
										$MOD = "MODE";
										$ID_MARE = $ID;
										if(isset($_GET['ID_CARAC'])){
											include 'enregmare.php';
										}							
									?>
								</div>
							</td>
						</tr>							
					</table>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr height="5"><td colspan="2"><legend><b>Intervenir en faveur de cette mare...</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<tr align="center">
				<th width="25%">Travaux à envisager : </th>
				<td width="75%">
					<form id="form_travaux" name="form_travaux">
						<div id="travaux_resultat">
							<?php 
								if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ 
									echo simpleDisplayCheckBox($listTravaux, 'C_TRAVAUX', 'ID', 'TRAVAUX', 0, 69, 'TypeTableau', $ID_CARAC, $bdd, 'travaux_resultat', 'checkBoxTravauxCheck', 'checkBoxTravauxOutcheck');
								}else{
									echo simpleDisplayCheckBox($listTravaux, 'C_TRAVAUX', 'ID', 'TRAVAUX', 0, 69, '', $ID_CARAC, $bdd, 'travaux_resultat', 'checkBoxTravauxCheck', 'checkBoxTravauxOutcheck');
								}
							?>
						</div>
					</form>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<td width="100%" colspan="2">
					<?php 
						if(isset($_GET['ID_CARAC'])){
						//ON VA FAIRE UNE REQUETE POUR RECUPERE LES DONNES DES TABLES
						$req_trav = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_travaux WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
						$donnees_trav = pg_fetch_array($req_trav);
							if($donnees_trav['TRAVAUX'] == 13){
					?>
					<div id="travaux_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser : </th>
								<td width="75%">
								<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
									<input style="width:100%" type="text" id="C_TRAVAUX_AUTRE" value="<?php echo $donnees_trav['TRAVAUX_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'travaux_autre', 'checkBoxTravauxAutreOutcheck')" tabindex="70"></td>
								<?php }else{ ?>	
									<input style="width:100%" type="text" id="C_TRAVAUX_AUTRE" value="<?php echo $donnees_trav['TRAVAUX_AUTRE'] ?>" onChange="RecAttribut('mare/enregmare.php', 'travaux_autre', 'checkBoxTravauxAutreOutcheck')" tabindex="70"></td>
								<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php 
						}else{
							?>
							<div style="display:none" id="travaux_autre">
								<table width="100%">
									<tr align="center"> 
										<th width="25%">Préciser : </th>
										<td width="75%">
										<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
											<input style="width:100%" type="text" id="C_TRAVAUX_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'travaux_autre', 'checkBoxTravauxAutreOutcheck')" tabindex="70"></td>
										<?php }else{ ?>	
											<input style="width:100%" type="text" id="C_TRAVAUX_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'travaux_autre', 'checkBoxTravauxAutreOutcheck')" tabindex="70"></td>
										<?php } ?>
										</td>
									</tr>
								</table>
							</div>
							<?php
						}
					}else{ ?>
					<div style="display:none" id="travaux_autre">
						<table width="100%">
							<tr align="center"> 
								<th width="25%">Préciser : </th>
								<td width="75%">
								<?php if(isset($_GET['type']) && $_GET['type'] == "tableau" && isset($_GET['ID_CARAC'])){ ?>
									<input style="width:100%" type="text" id="C_TRAVAUX_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'travaux_autre', 'checkBoxTravauxAutreOutcheck')" tabindex="70"></td>
								<?php }else{ ?>	
									<input style="width:100%" type="text" id="C_TRAVAUX_AUTRE" value="" onChange="RecAttribut('mare/enregmare.php', 'travaux_autre', 'checkBoxTravauxAutreOutcheck')" tabindex="70"></td>
								<?php } ?>
								</td>
							</tr>
						</table>
					</div>
					<?php } ?>
				</td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">	
				<th width="25%">Objectifs des travaux : </th>
				<td width="75%"><input style="width:90%" type="text" id="C_OBJEC_TRAV" value="" tabindex="71"></td>
			</tr>
			<tr height="5"></tr>
			<tr height="5"><td colspan="2"><legend><b>Commentaire</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<tr align="center">
				<th width="25%">Commentaire : </th>
				<td width="50%" colspan="3"><textarea style="width:90%;" rows="5" Title="Commentaire" id="C_COMT_CARAC" tabindex="72"><?php if(isset($_GET['ID_CARAC'])){echo $donnees_carac['C_COMT'];} ?></textarea></td>
			</tr>
			<tr height="5"></tr>
			<tr height="5"><td colspan="2"><legend><b>Photo de caractérisation</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<?php
				if(isset($donnees_carac['ID_CARAC'])){
					//ON VA VOIR SI PHOTO EXISTE
					$mare_photo_carac_exist = pg_query($bdd, 'SELECT * 
																FROM saisie_observation.caracterisation_photo
																WHERE saisie_observation.caracterisation_photo."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
								$count_photo_carac = pg_num_rows($mare_photo_carac_exist);
								
					if(isset($_GET['ID_CARAC']) && $count_photo_carac >= 1){
					
					//ON VA FAIRE UNE REQUETE POUR RECUPERE LES DONNES DES TABLES
					$req_photo_carac = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_photo WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
					$donnees_photo_carac = pg_fetch_array($req_photo_carac);
										
			?>
			<tr align="center">
				<tr align="center">
				<th width="25%">Photo : </th>
				<td>
					<img src="PRAM/<?php echo $donnees_photo_carac['LIEN'];?>" width="50%"/>
				</td>
			</tr>
			<?php 
					}else{ ?>
				<tr align="center">
					<th width="25%">Ajouter une photo de caractérisation : </th>
					<td width="25%">
						<input type="radio" class="Caract" name="Photocaracterisation" id="Photocaracterisation_Non" value="Non" checked alt="Masquer"  tabindex="73" onclick="afficher_masquer('photocaracterisation','')"><font size="2">Non</font>
						<input type="radio" class="Caract" name="Photocaracterisation" id="Photocaracterisation_Oui" value="Oui" alt="Afficher"  tabindex="74" onclick="afficher_masquer('photocaracterisation','');AjaxMare('mare/enregmare.php', '', 'RecMareCaracterisation');"><font size="2">Oui</font>
					</td>
				</tr>
				<tr align="center">
					<td colspan="2" width="25%" height="250px"><iframe style="display:none" id="photocaracterisation" src="mare/iframephoto.php?ID_Mare=<?php echo $ID?>&ID_CARAC=<?php echo $ID_CARAC?>&type=photocaracterisation" width="100%" height="400px" frameborder="0"></iframe></td>
				</tr>
			<?php }
				}else{
			?>
					<tr align="center">
					<th width="25%">Ajouter une photo de caractérisation : </th>
					<td width="25%">
						<input type="radio" class="Caract" name="Photocaracterisation" id="Photocaracterisation_Non" value="Non" checked alt="Masquer"  tabindex="73" onclick="afficher_masquer('photocaracterisation','')"><font size="2">Non</font>
						<input type="radio" class="Caract" name="Photocaracterisation" id="Photocaracterisation_Oui" value="Oui" alt="Afficher"  tabindex="74" onclick="afficher_masquer('photocaracterisation','');AjaxMare('mare/enregmare.php', '', 'RecMareCaracterisation');"><font size="2">Oui</font>
					</td>
				</tr>
				<tr align="center">
					<td colspan="2" width="25%" height="250px"><iframe style="display:none" id="photocaracterisation" src="mare/iframephoto.php?ID_Mare=<?php echo $ID?>&ID_CARAC=<?php echo $ID_CARAC?>&type=photocaracterisation" width="100%" height="400px" frameborder="0"></iframe></td>
				</tr>
				<?php } ?>
				
			<tr height="5"><td colspan="2"><legend><b>Schéma de caractérisation</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<?php
				if(isset($donnees_carac['ID_CARAC'])){
					//ON VA VOIR SI PHOTO EXISTE
					$mare_photo_schema_exist = pg_query($bdd, 'SELECT * 
																FROM saisie_observation.caracterisation_schema
																WHERE saisie_observation.caracterisation_schema."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
								$count_photo_schema = pg_num_rows($mare_photo_schema_exist);
								
					if(isset($_GET['ID_CARAC']) && $count_photo_schema >= 1){
					
					//ON VA FAIRE UNE REQUETE POUR RECUPERE LES DONNES DES TABLES
					$req_photo_schema = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_schema WHERE "ID_CARAC"='."'".$ID_CARAC."'".'');
					$donnees_photo_schema = pg_fetch_array($req_photo_schema);
										
			?>
			<tr align="center">
				<tr align="center">
				<th width="25%">Schéma : </th>
				<td>
					<img src="PRAM/<?php echo $donnees_photo_schema['LIEN'];?>" width="50%"/>
				</td>
			</tr>
			<?php 
					}else{ ?>
						<tr align="center">
							<th width="25%">Ajouter une schéma de caractérisation : </th>
							<td width="25%">
								<input type="radio" class="Caract" name="Schemacaracterisation" id="Schemacaracterisation_Non" value="Non" checked alt="Masquer"  tabindex="75" onclick="afficher_masquer('schemacaracterisation','')"><font size="2">Non</font>
								<input type="radio" class="Caract" name="Schemacaracterisation" id="Schemacaracterisation_Oui" value="Oui" alt="Afficher"  tabindex="75" onclick="afficher_masquer('schemacaracterisation','');AjaxMare('mare/enregmare.php', '', 'RecMareCaracterisation');"><font size="2">Oui</font>
							</td>
						</tr>
						<tr align="center">
							<td colspan="2" width="25%" height="250px"><iframe style="display:none" id="schemacaracterisation" src="mare/iframephoto.php?ID_Mare=<?php echo $ID?>&ID_CARAC=<?php echo $ID_CARAC?>&type=schemacaracterisation" width="100%" height="400px" frameborder="0"></iframe></td>
						</tr>
			<?php }
				}else{		?>
					<tr align="center">
						<th width="25%">Ajouter une schéma de caractérisation : </th>
						<td width="25%">
							<input type="radio" class="Caract" name="Schemacaracterisation" id="Schemacaracterisation_Non" value="Non" checked alt="Masquer"  tabindex="75" onclick="afficher_masquer('schemacaracterisation','')"><font size="2">Non</font>
							<input type="radio" class="Caract" name="Schemacaracterisation" id="Schemacaracterisation_Oui" value="Oui" alt="Afficher"  tabindex="76" onclick="afficher_masquer('schemacaracterisation','');AjaxMare('mare/enregmare.php', '', 'RecMareCaracterisation');"><font size="2">Oui</font>
						</td>
					</tr>
					<tr align="center">
						<td colspan="2" width="25%" height="250px"><iframe style="display:none" id="schemacaracterisation" src="mare/iframephoto.php?ID_Mare=<?php echo $ID?>&ID_CARAC=<?php echo $ID_CARAC?>&type=schemacaracterisation" width="100%" height="400px" frameborder="0"></iframe></td>
					</tr>
				<?php } ?>		
		</table>
	</div>
</div>
<div id="piedaffichage">
	<table align="center" width="100%" border="0">
		<tr>
			<td>
				<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<input width="30" type="image" onclick="verifCaracterisation('mare/error.php', 'erreur', '');actualiseMareAfterMod();" src="../img/enreg.png" Title="Enregistrer">
							</td>
							<!--<td width="30" align="center">
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>-->
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</div>