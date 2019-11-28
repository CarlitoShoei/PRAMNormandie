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
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_type_simplifie ORDER BY "ID"'); 
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
	
	$listEvolution = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_evolution ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listEvolution, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	
	$listFaune = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_faune ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listFaune, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listDechets = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_dechets ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listDechets, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listProf = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_prof ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listProf, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}

?>
<input style="width:90%;display:none" type="text" id="L_ID" value="<?php echo $ID ?>">
<input style="width:90%;display:none" type="text" id="ID_CARAC" value="<?php echo $ID_CARAC ?>">
<div id="textafficahge_carac_edit">	
<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
<h1>Caractérisation simplifiée de la mare</h1>
<p><b>La caractérisation d'une mare s'effectue sur le terrain à l'aide de la <a href="../doc/Fiche_caracterisation_simplifiee.pdf" target="_bank">fiche de caractérisation simplifiée</a></b>. Les champs obligatoires sont suivis d’un astérisque (*).</p>
	<div id="resultat_carac_edit">	
		<table border="0" width="90%">
			<tr height="5"><td colspan="2"><legend><b>Caractérisation simplifiée</b></legend></td></tr>
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
				<th width="25%">Où se situe la mare ?</br>(choisir l'environnement majoritaire)* : </th>
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
				<th width="25%">Animaux observés* : </th>
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
								<th width="25%">Préciser autres animaux observés* : </th>
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
											<th width="25%">Préciser autres animaux observés* : </th>
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
								<th width="25%">Préciser autres animaux observés* : </th>
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
				<th width="25%">Plante aquatique* : </th>
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
			<tr align="center">
				<th width="25%">Longueur (m) : </th>
				<td width="75%"><input style="width:90%" type="text" id="C_LONG" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_LONG'];}else{ echo "0";}?>" tabindex="39"></td>
			</tr>
			<tr height="5"></tr>
			<tr align="center">
				<th width="25%">Largeur (m) : </th>
				<td width="25%"><input style="width:90%" type="text" id="C_LARG" value="<?php if(isset($_GET['ID_CARAC'])){ echo $donnees_carac['C_LARG'];}else{ echo "0";}?>" tabindex="40"></td>
			</tr>
	
			<tr height="5"></tr>
			<tr height="5"><td colspan="2"><legend><b>Commentaire</b></legend></td></tr>
			<tr height="5"><td colspan="2"><hr></td></tr>
			<tr align="center">
				<th width="25%">Commentaire : </th>
				<td width="50%" colspan="3"><textarea style="width:90%;" rows="5" Title="Commentaire" id="C_COMT_CARAC" tabindex="71"><?php if(isset($_GET['ID_CARAC'])){echo $donnees_carac['C_COMT'];} ?></textarea></td>
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
						<input type="radio" class="Caract" name="Photocaracterisation" id="Photocaracterisation_Non" tabindex="72" value="Non" checked alt="Masquer"  tabindex="16" onclick="afficher_masquer('photocaracterisation','')"><font size="2">Non</font>
						<input type="radio" class="Caract" name="Photocaracterisation" id="Photocaracterisation_Oui" tabindex="73" value="Oui" alt="Afficher"  tabindex="17" onclick="afficher_masquer('photocaracterisation','');AjaxMare('mare/enregmare.php', '', 'RecMareCaracterisation');"><font size="2">Oui</font>
					</td>
				</tr>
				<tr align="center">
					<td width="25%" colspan="2" height="250px"><iframe style="display:none" id="photocaracterisation" src="mare/iframephoto.php?ID_Mare=<?php echo $ID?>&ID_CARAC=<?php echo $ID_CARAC?>&type=photocaracterisation" width="100%" height="100%" frameborder="0"></iframe></td>
				</tr>
			<?php }
				}else{
			?>
					<tr align="center">
					<th width="25%">Ajouter une photo de caractérisation : </th>
					<td width="25%">
						<input type="radio" class="Caract" name="Photocaracterisation" id="Photocaracterisation_Non" tabindex="72" value="Non" checked alt="Masquer"  tabindex="16" onclick="afficher_masquer('photocaracterisation','')"><font size="2">Non</font>
						<input type="radio" class="Caract" name="Photocaracterisation" id="Photocaracterisation_Oui" tabindex="73" value="Oui" alt="Afficher"  tabindex="17" onclick="afficher_masquer('photocaracterisation','');AjaxMare('mare/enregmare.php', '', 'RecMareCaracterisation');"><font size="2">Oui</font>
					</td>
				</tr>
				<tr align="left">
					<td colspan="2" width="25%" height="250px"><iframe style="display:none" id="photocaracterisation" src="mare/iframephoto.php?ID_Mare=<?php echo $ID?>&ID_CARAC=<?php echo $ID_CARAC?>&type=photocaracterisation" width="100%" height="100%" frameborder="0"></iframe></td>
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
								<input width="30" type="image" onclick="verifCaracterisationsimplifiee('mare/error.php', 'erreur', '');actualiseMareAfterMod();" src="../img/enreg.png" Title="Enregistrer">
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