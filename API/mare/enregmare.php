<?php
	header('Content-type: text/html; charset=utf-8');
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES DONNES POUR LES SELECT
	// $listNatberges = array();
	// $req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_natberges ORDER BY "ID"'); 
	// while($donnees = pg_fetch_array($req))
	// {
		// array_push($listNatberges, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	// }
	
	$listContext = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_context ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listContext, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listPatrimoine = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_patrimoine ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listPatrimoine, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
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
	
	$listFaune = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_faune ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listFaune, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	// $listAutespeces = array();
	// $req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_autespeces ORDER BY "ID"'); 
	// while($donnees = pg_fetch_array($req))
	// {
		// array_push($listAutespeces, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	// }
	
	$listDechets = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.c_dechets ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listDechets, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
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
	
	$listSacq= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.o_sacq ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listSacq, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listStyp= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.o_styp ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listStyp, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
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
	
	$listSymptome = array();
	$req = pg_query($bdd, 'SELECT * FROM module_pram.smbvpc_mod1_list_symptome ORDER BY id'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listSymptome, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listContexteAmont = array();
	$req = pg_query($bdd, 'SELECT * FROM module_pram.smbvpc_mod1_list_context_amont ORDER BY id'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listContexteAmont, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listContexteRapproche = array();
	$req = pg_query($bdd, 'SELECT * FROM module_pram.smbvpc_mod1_list_context_rapproche ORDER BY id'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listContexteRapproche, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
	
	$listContexteAval = array();
	$req = pg_query($bdd, 'SELECT * FROM module_pram.smbvpc_mod1_list_context_aval ORDER BY id'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listContexteAval, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
		
	//SI ERROR EXISTE ALORS ON FAIT RIEN DU TOUT
	if(isset($_GET['ERROR'])){
	
	}
	else{	
		//On recupere la variable TYPE
		if(isset($_GET['TYPE'])){
			$TYPE = $_GET['TYPE'];
		}
		if($TYPE == "id_caracterisation"){
			$ID_MARE = $_GET['ID_MARE'];
			$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation("L_ID") VALUES('."'".$ID_MARE."'".')'); 
						
			$req_ID = pg_query($bdd, 'SELECT max("ID_CARAC") AS "ID_CARAC" FROM saisie_observation.caracterisation');
			$donnees_ID = pg_fetch_array($req_ID);
			$ID_CARAC = $donnees_ID['ID_CARAC'];
			echo "$"."ID_CARAC=".$ID_CARAC
			?>
				<input style="width:90%" type="text" name="ID_CARAC" id="ID_CARAC" value="<?php echo $ID_CARAC;?>">
			<?php
		
		}
		elseif($TYPE == "eaee"){
			if(!isset($MOD)){
				//ON RECUPERE LES VARAIBLE
				$C_EAEE = $_GET['C_EAEE'];
				$ID_MARE = $_GET['ID_MARE'];
				$ID_CARAC = $_GET['ID_CARAC'];
				
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_eaee("ID_CARAC", "EAEE") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_EAEE."'".')'); 
			};
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_eaee WHERE "ID_CARAC"='."'".$ID_CARAC."'".' ORDER BY "ID"');
			
			?>
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td width="90%" colspan="2">
							<?php echo simpleDisplaySelectAffichage2($listEAEE, 'C_EAEE', 'ID', 'NOM_TAXON', $donnees['EAEE'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "eaee_resultat", "modifieeaee")', '', $donnees['ID']); ?>
						</td>
						<td width="10%">
							<?php if(isset($_GET['TypeTableau']) && isset($_GET['ID_CARAC'])){ ?>
								<!--<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php //echo $donnees['ID'] ?>&ID_CARAC=<?php //echo $ID_CARAC ?>', 'berge_resultat', 'modifieberge')">
								<img src="../img/enreg.png" width="25">
								</a>-->
								<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['ID'] ?>&ID_CARAC=<?php echo $ID_CARAC ?>', 'eaee_resultat', 'supprimeeaee')">
									<?php 
										if(isset($_GET['ID_CARAC'])){
											if(isset($_GET['type']) && $_GET['type'] == "cartoprec"){ ?>
												<img src="mare/img/sup.png" width="25">
									<?php 	}else if(isset($_GET['type']) && $_GET['type'] == "tableau"){ ?>
												<img src="mare/img/sup.png" width="25">
									<?php 	}else if(isset($_GET['type']) && $_GET['type'] == "lien"){ ?>
												<img src="../img/sup.png" width="25">
									<?php	}else{ ?>
												<img src="../img/sup.png" width="25">
									<?php	}
										}else{ ?>


									<?php } ?>
									
									
								</a>
							<?php }else{ ?>
								<!--<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php //echo $donnees['ID'] ?>&ID_CARAC=<?php //echo $ID_CARAC ?>', 'berge_resultat', 'modifieberge')">
								<img src="../img/enreg.png" width="25">
								</a>-->
								<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['ID'] ?>&ID_CARAC=<?php echo $ID_CARAC ?>', 'eaee_resultat', 'supprimeeaee')">
									<?php 
										if(isset($_GET['ID_CARAC'])){
											if(isset($_GET['type']) && $_GET['type'] == "cartoprec"){ ?>
												<img src="mare/img/sup.png" width="25">
									<?php 	}else if(isset($_GET['type']) && $_GET['type'] == "tableau"){ ?>
												<img src="mare/img/sup.png" width="25">
									<?php 	}else if(isset($_GET['type']) && $_GET['type'] == "lien"){ ?>
												<img src="../img/sup.png" width="25">
									<?php	}else{ ?>
												<img src="../img/sup.png" width="25">
									<?php	}
										}else{ ?>


									<?php } ?>
								</a>							
							<?php } ?>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "modifieeaee"){
			//ON RECUPERE LES VARAIBLE
			$C_EAEE = $_GET['C_EAEE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$ID = $_GET['ID'];
			
			$req_insert = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_eaee SET "EAEE" = '."'".$C_EAEE."'".' WHERE "ID"='."'".$ID."'".'');
			
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_eaee WHERE "ID_CARAC"='."'".$ID_CARAC."'".' ORDER BY "ID"');
			?>
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td width="90%" colspan="2">
							<?php echo simpleDisplaySelectAffichage2($listEAEE, 'C_EAEE', 'ID', 'NOM_TAXON', $donnees['EAEE'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "eaee_resultat", "modifieeaee")', '', $donnees['ID']); ?>
						</td>
						<td width="10%">
							<!--<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php // echo $donnees['ID'] ?>&ID_CARAC=<?php // echo $ID_CARAC ?>', 'berge_resultat', 'modifieberge')">
							<img src="../img/enreg.png" width="25">
							</a>-->
							<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['ID'] ?>&ID_CARAC=<?php echo $ID_CARAC ?>', 'eaee_resultat', 'supprimeeaee')">
								<img src="../img/sup.png" width="25">
							</a>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "supprimeeaee"){
			//ON RECUPERE LES VARAIBLE
			$ID_MARE = $_GET['ID_MARE'];
			$ID = $_GET['ID'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_eaee WHERE "ID"='."'".$ID."'".'');
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_eaee WHERE "ID_CARAC"='."'".$ID_CARAC."'".' ORDER BY "ID"');
			?>
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td width="90%" colspan="2">
							<?php echo simpleDisplaySelectAffichage2($listEAEE, 'C_EAEE', 'ID', 'NOM_TAXON', $donnees['EAEE'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "eaee_resultat", "modifieeaee")', '', $donnees['ID']); ?>
						</td>
						<td width="10%">
							<!--<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php //echo $donnees['ID'] ?>&ID_CARAC=<?php //echo $ID_CARAC ?>', 'berge_resultat', 'modifieberge')">
							<img src="../img/enreg.png" width="25">
							</a>-->
							<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['ID'] ?>&ID_CARAC=<?php echo $ID_CARAC ?>', 'eaee_resultat', 'supprimeeaee')">
								<img src="../img/sup.png" width="25">
							</a>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "evee"){
			if(!isset($MOD)){
				//ON RECUPERE LES VARAIBLE
				$C_EVEE = $_GET['C_EVEE'];
				$C_EVEE_POURCENT = $_GET['C_EVEE_POURCENT'];
				$ID_MARE = $_GET['ID_MARE'];
				$ID_CARAC = $_GET['ID_CARAC'];
				
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_evee("ID_CARAC", "EVEE", "EVEE_POURCENT") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_EVEE."'".', '."'".$C_EVEE_POURCENT."'".')'); 
			};
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_evee WHERE "ID_CARAC"='."'".$ID_CARAC."'".' ORDER BY "ID"');
			
			?>
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>">
						<td width="70%">
							<?php echo simpleDisplaySelectAffichage2($listEVEE, 'C_EVEE', 'ID', 'NOM_TAXON', $donnees['EVEE'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "evee_resultat", "modifieevee")', '', $donnees['ID']); ?>
						</td>
						<td width="20%">
							<?php echo simpleDisplaySelectAffichage($listEVEEpourcent, 'C_EVEE_POURCENT', 'ID', 'POURCENTAGE', $donnees['EVEE_POURCENT'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "evee_resultat", "modifieevee")', '', 'POURCENT'.$donnees['ID']); ?>
						</td>
						<td width="10%">
							<?php if(isset($_GET['TypeTableau']) && isset($_GET['ID_CARAC'])){ ?>
								<!--<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php //echo $donnees['ID'] ?>&ID_CARAC=<?php //echo $ID_CARAC ?>', 'berge_resultat', 'modifieberge')">
								<img src="../img/enreg.png" width="25">
								</a>-->
								<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['ID'] ?>&ID_CARAC=<?php echo $ID_CARAC ?>', 'evee_resultat', 'supprimeevee')">
									<?php 
										if(isset($_GET['ID_CARAC'])){
											if(isset($_GET['type']) && $_GET['type'] == "cartoprec"){ ?>
												<img src="mare/img/sup.png" width="25">
									<?php 	}else if(isset($_GET['type']) && $_GET['type'] == "tableau"){ ?>
												<img src="mare/img/sup.png" width="25">
									<?php 	}else if(isset($_GET['type']) && $_GET['type'] == "lien"){ ?>
												<img src="../img/sup.png" width="25">
									<?php	}else{ ?>
												<img src="../img/sup.png" width="25">
									<?php	}
										}else{ ?>


									<?php } ?>
								</a>
							<?php }else{ ?>
								<!--<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php //echo $donnees['ID'] ?>&ID_CARAC=<?php //echo $ID_CARAC ?>', 'berge_resultat', 'modifieberge')">
								<img src="../img/enreg.png" width="25">
								</a>-->
								<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['ID'] ?>&ID_CARAC=<?php echo $ID_CARAC ?>', 'evee_resultat', 'supprimeevee')">
									<?php 
										if(isset($_GET['ID_CARAC'])){
											if(isset($_GET['type']) && $_GET['type'] == "cartoprec"){ ?>
												<img src="mare/img/sup.png" width="25">
									<?php 	}else if(isset($_GET['type']) && $_GET['type'] == "tableau"){ ?>
												<img src="mare/img/sup.png" width="25">
									<?php 	}else if(isset($_GET['type']) && $_GET['type'] == "lien"){ ?>
												<img src="../img/sup.png" width="25">
									<?php	}else{ ?>
												<img src="../img/sup.png" width="25">
									<?php	}
										}else{ ?>


									<?php } ?>
								</a>							
							<?php } ?>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "modifieevee"){
			//ON RECUPERE LES VARAIBLE
			$C_EVEE = $_GET['C_EVEE'];
			$C_EVEE_POURCENT = $_GET['C_EVEE_POURCENT'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$ID = $_GET['ID'];
			
			$req_insert = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_evee SET "EVEE" = '."'".$C_EVEE."'".', "EVEE_POURCENT" = '."'".$C_EVEE_POURCENT."'".' WHERE "ID"='."'".$ID."'".'');
			
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_evee WHERE "ID_CARAC"='."'".$ID_CARAC."'".' ORDER BY "ID"');
			?>
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td width="70%">
							<?php echo simpleDisplaySelectAffichage2($listEVEE, 'C_EVEE', 'ID', 'NOM_TAXON', $donnees['EVEE'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "evee_resultat", "modifieevee")', '', $donnees['ID']); ?>
						</td>
						<td width="20%">
							<?php echo simpleDisplaySelectAffichage($listEVEEpourcent, 'C_EVEE_POURCENT', 'ID', 'POURCENTAGE', $donnees['EVEE_POURCENT'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "evee_resultat", "modifieevee")', '', 'POURCENT'.$donnees['ID']); ?>
						</td>
						<td width="10%">
							<!--<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php // echo $donnees['ID'] ?>&ID_CARAC=<?php // echo $ID_CARAC ?>', 'berge_resultat', 'modifieberge')">
							<img src="../img/enreg.png" width="25">
							</a>-->
							<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['ID'] ?>&ID_CARAC=<?php echo $ID_CARAC ?>', 'evee_resultat', 'supprimeevee')">
								<img src="../img/sup.png" width="25">
							</a>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "supprimeevee"){
			//ON RECUPERE LES VARAIBLE
			$ID_MARE = $_GET['ID_MARE'];
			$ID = $_GET['ID'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_evee WHERE "ID"='."'".$ID."'".'');
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_evee WHERE "ID_CARAC"='."'".$ID_CARAC."'".' ORDER BY "ID"');
			?>
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td width="70%">
							<?php echo simpleDisplaySelectAffichage2($listEVEE, 'C_EVEE', 'ID', 'NOM_TAXON', $donnees['EVEE'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "evee_resultat", "modifieevee")', '', $donnees['ID']); ?>
						</td>
						<td width="20%">
							<?php echo simpleDisplaySelectAffichage($listEVEEpourcent, 'C_EVEE_POURCENT', 'ID', 'POURCENTAGE', $donnees['EVEE_POURCENT'], 'RecAttribut("mare/enregmare.php?ID='.$donnees['ID'].'&ID_CARAC='.$ID_CARAC.'", "evee_resultat", "modifieevee")', '', 'POURCENT'.$donnees['ID']); ?>
						</td>
						<td width="10%">
							<!--<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php //echo $donnees['ID'] ?>&ID_CARAC=<?php //echo $ID_CARAC ?>', 'berge_resultat', 'modifieberge')">
							<img src="../img/enreg.png" width="25">
							</a>-->
							<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['ID'] ?>&ID_CARAC=<?php echo $ID_CARAC ?>', 'evee_resultat', 'supprimeevee')">
								<img src="../img/sup.png" width="25">
							</a>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "checkBoxContextOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONT = $_GET['L_CONT'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_context("ID_CARAC", "CONTEXT") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$L_CONT."'".')'); 
			}
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listContext, 'L_CONT', 'ID', 'CONTEXT', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'context_resultat', 'checkBoxContextCheck', 'checkBoxContextOutcheck');
			}else{
				echo simpleDisplayCheckBox($listContext, 'L_CONT', 'ID', 'CONTEXT', 0, 38, '', $ID_CARAC, $bdd, 'context_resultat', 'checkBoxContextCheck', 'checkBoxContextOutcheck');
			}
		}
		elseif($TYPE == "checkBoxContextCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONT = $_GET['L_CONT'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_context WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "CONTEXT"='."'".$L_CONT."'".'');
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listContext, 'L_CONT', 'ID', 'CONTEXT', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'context_resultat', 'checkBoxContextCheck', 'checkBoxContextOutcheck');
			}else{
				echo simpleDisplayCheckBox($listContext, 'L_CONT', 'ID', 'CONTEXT', 0, 38, '', $ID_CARAC, $bdd, 'context_resultat', 'checkBoxContextCheck', 'checkBoxContextOutcheck');
			}
		}
		
		
		
		
		
		elseif($TYPE == "checkBoxPatrimoineOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_PATRIMOINE = $_GET['C_PATRIMOINE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_patrimoine("ID_CARAC", "PATRIMOINE") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_PATRIMOINE."'".')'); 
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listPatrimoine, 'C_PATRIMOINE', 'ID', 'PATRIMOINE', 0, 33, 'TypeTableau', $ID_CARAC, $bdd, 'patrimoine_resultat', 'checkBoxPatrimoineCheck', 'checkBoxPatrimoineOutcheck');
			}else{
				echo simpleDisplayCheckBox($listPatrimoine, 'C_PATRIMOINE', 'ID', 'PATRIMOINE', 0, 33, '', $ID_CARAC, $bdd, 'patrimoine_resultat', 'checkBoxPatrimoineCheck', 'checkBoxPatrimoineOutcheck');
			}
		}
		elseif($TYPE == "checkBoxPatrimoineAutreOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_PATRIMOINE = $_GET['C_PATRIMOINE'];
			$C_PATRIMOINE_AUTRE = $_GET['C_PATRIMOINE_AUTRE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];

			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_patrimoine SET "PATRIMOINE_AUTRE" = E'."'".utf8_encode(addslashes($C_PATRIMOINE_AUTRE))."'".' WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "PATRIMOINE" = '."'".$C_PATRIMOINE."'".''); 
			
			?>
				<table width="100%">
					<tr align="center"> 
						<th width="50%">Préciser autre patrimoine : </th>
						<td width="50%"><input style="width:90%" type="text" id="C_LIAISON_AUTRE" value="<?php echo $C_PATRIMOINE_AUTRE ?>" onChange="RecAttribut('mare/enregmare.php', 'liaison_autre', 'checkBoxPatrimoineAutreOutcheck')" tabindex="34"></td>
					</tr>
				</table>
			<?php
		}
		elseif($TYPE == "checkBoxPatrimoineCheck"){
			//ON RECUPERE LES VARAIBLE
			$C_PATRIMOINE = $_GET['C_PATRIMOINE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_patrimoine WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "PATRIMOINE"='."'".$C_PATRIMOINE."'".'');
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listPatrimoine, 'C_PATRIMOINE', 'ID', 'PATRIMOINE', 0, 33, 'TypeTableau', $ID_CARAC, $bdd, 'patrimoine_resultat', 'checkBoxPatrimoineCheck', 'checkBoxPatrimoineOutcheck');
			}else{
				echo simpleDisplayCheckBox($listPatrimoine, 'C_PATRIMOINE', 'ID', 'PATRIMOINE', 0, 33, '', $ID_CARAC, $bdd, 'patrimoine_resultat', 'checkBoxPatrimoineCheck', 'checkBoxPatrimoineOutcheck');
			}
		}
		elseif($TYPE == "checkBoxLiaisonOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_LIAISON = $_GET['C_LIAISON'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_liaison("ID_CARAC", "LIAISON") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_LIAISON."'".')'); 
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listLiaison, 'C_LIAISON', 'ID', 'LIAISON', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'liaison_resultat', 'checkBoxLiaisonCheck', 'checkBoxLiaisonOutcheck');
			}else{
				echo simpleDisplayCheckBox($listLiaison, 'C_LIAISON', 'ID', 'LIAISON', 0, 38, '', $ID_CARAC, $bdd, 'liaison_resultat', 'checkBoxLiaisonCheck', 'checkBoxLiaisonOutcheck');
			}
		}
		elseif($TYPE == "checkBoxLiaisonAutreOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_LIAISON = $_GET['C_LIAISON'];
			$C_LIAISON_AUTRE = $_GET['C_LIAISON_AUTRE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];

			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_liaison SET "LIAISON_AUTRE" = E'."'".utf8_encode(addslashes($C_LIAISON_AUTRE))."'".' WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "LIAISON" = '."'".$C_LIAISON."'".''); 
			
			?>
				<table width="100%">
					<tr align="center"> 
						<th width="50%">Préciser autre liaison : </th>
						<td width="50%"><input style="width:90%" type="text" id="C_LIAISON_AUTRE" value="<?php echo $C_LIAISON_AUTRE ?>" onChange="RecAttribut('mare/enregmare.php', 'liaison_autre', 'checkBoxLiaisonAutreOutcheck')" tabindex="49"></td>
					</tr>
				</table>
			<?php
		}
		elseif($TYPE == "checkBoxLiaisonCheck"){
			//ON RECUPERE LES VARAIBLE
			$C_LIAISON = $_GET['C_LIAISON'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_liaison WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "LIAISON"='."'".$C_LIAISON."'".'');
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listLiaison, 'C_LIAISON', 'ID', 'LIAISON', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'liaison_resultat', 'checkBoxLiaisonCheck', 'checkBoxLiaisonOutcheck');
			}else{
				echo simpleDisplayCheckBox($listLiaison, 'C_LIAISON', 'ID', 'LIAISON', 0, 38, '', $ID_CARAC, $bdd, 'liaison_resultat', 'checkBoxLiaisonCheck', 'checkBoxLiaisonOutcheck');
			}
		}
		elseif($TYPE == "checkBoxAlimentationOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_ALIMENTATION = $_GET['C_ALIMENTATION'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_alimentation("ID_CARAC", "ALIMENTATION") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_ALIMENTATION."'".')'); 
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listAlimentation, 'C_ALIMENTATION', 'ID', 'ALIMENTATION', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'alimentation_resultat', 'checkBoxAlimentationCheck', 'checkBoxAlimentationOutcheck');
			}else{
				echo simpleDisplayCheckBox($listAlimentation, 'C_ALIMENTATION', 'ID', 'ALIMENTATION', 0, 38, '', $ID_CARAC, $bdd, 'alimentation_resultat', 'checkBoxAlimentationCheck', 'checkBoxAlimentationOutcheck');
			}
		}
		elseif($TYPE == "checkBoxAutreAlimentationOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_ALIMENTATION = $_GET['C_ALIMENTATION'];
			$C_ALIMENTATION_AUTRE = $_GET['C_ALIMENTATION_AUTRE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];

			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_alimentation SET "ALIMENTATION_AUTRE" = E'."'".utf8_encode(addslashes($C_ALIMENTATION_AUTRE))."'".' WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "ALIMENTATION" = '."'".$C_ALIMENTATION."'".''); 
					
			?>
				<table width="100%">
					<tr align="center"> 
						<th width="50%">Préciser autre alimentation : </th>
						<td width="50%"><input style="width:90%" type="text" id="C_ALIMENTATION_AUTRE" value="<?php echo $C_ALIMENTATION_AUTRE ?>"  onChange="RecAttribut('mare/enregmare.php', 'alimentation_autre', 'checkBoxAutreAlimentationOutcheck')" tabindex="51"></td>
					</tr>
				</table>
			<?php

		}
		elseif($TYPE == "checkBoxAlimentationCheck"){
			//ON RECUPERE LES VARAIBLE
			$C_ALIMENTATION = $_GET['C_ALIMENTATION'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_alimentation WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "ALIMENTATION"='."'".$C_ALIMENTATION."'".'');
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listAlimentation, 'C_ALIMENTATION', 'ID', 'ALIMENTATION', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'alimentation_resultat', 'checkBoxAlimentationCheck', 'checkBoxAlimentationOutcheck');
			}else{
				echo simpleDisplayCheckBox($listAlimentation, 'C_ALIMENTATION', 'ID', 'ALIMENTATION', 0, 38, '', $ID_CARAC, $bdd, 'alimentation_resultat', 'checkBoxAlimentationCheck', 'checkBoxAlimentationOutcheck');
			}
		}
		elseif($TYPE == "checkBoxFauneOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_FAUNE = $_GET['C_FAUNE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_faune("ID_CARAC", "FAUNE") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_FAUNE."'".')'); 
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listFaune, 'C_FAUNE', 'ID', 'FAUNE', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'faune_resultat', 'checkBoxFauneCheck', 'checkBoxFauneOutcheck');
			}else{
				echo simpleDisplayCheckBox($listFaune, 'C_FAUNE', 'ID', 'FAUNE', 0, 38, '', $ID_CARAC, $bdd, 'faune_resultat', 'checkBoxFauneCheck', 'checkBoxFauneOutcheck');
			}
		}
		elseif($TYPE == "checkBoxFauneCheck"){
			//ON RECUPERE LES VARAIBLE
			$C_FAUNE = $_GET['C_FAUNE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_faune WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "FAUNE"='."'".$C_FAUNE."'".'');
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listFaune, 'C_FAUNE', 'ID', 'FAUNE', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'faune_resultat', 'checkBoxFauneCheck', 'checkBoxFauneOutcheck');
			}else{
				echo simpleDisplayCheckBox($listFaune, 'C_FAUNE', 'ID', 'FAUNE', 0, 38, '', $ID_CARAC, $bdd, 'faune_resultat', 'checkBoxFauneCheck', 'checkBoxFauneOutcheck');
			}
		}
		elseif($TYPE == "checkBoxFauneAutreOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_FAUNE = $_GET['C_FAUNE'];
			$C_FAUNE_AUTRE = $_GET['C_FAUNE_AUTRE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];

			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_faune SET "FAUNE_AUTRE" = E'."'".utf8_encode(addslashes($C_FAUNE_AUTRE))."'".' WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "FAUNE" ='."'".$C_FAUNE."'".'');
			
			?>
				<table width="100%">
					<tr align="center"> 
						<th width="50%">Préciser autre groupe faunistique : </th>
						<td width="50%"><input style="width:90%" type="text" id="C_FAUNE_AUTRE" value="<?php echo $C_FAUNE_AUTRE?>" onChange="RecAttribut('mare/enregmare.php', 'faunistique_autre', 'checkBoxFauneAutreOutcheck')" tabindex="26"></td>
					</tr>
				</table>
			<?php
		}
		elseif($TYPE == "checkBoxAutespecesOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_AUTESPECES = $_GET['C_AUTESPECES'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rq= "INSERT INTO menu_deroulant.caracterisation_autespeces(ID_CARAC, AUTESPECES) VALUES(:ID_CARAC, :AUTESPECES)";
			$req_insert = $bdd->prepare($rq);
			$req_insert->execute(array(
						"ID_CARAC" => stripslashes($ID_CARAC),
						"AUTESPECES" => $C_AUTESPECES,
			));

			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listAutespeces, 'C_AUTESPECES', 'ID', 'AUTESPECES', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'autespeces_resultat', 'checkBoxAutespecesCheck', 'checkBoxAutespecesOutcheck');
			}else{
				echo simpleDisplayCheckBox($listAutespeces, 'C_AUTESPECES', 'ID', 'AUTESPECES', 0, 38, '', $ID_CARAC, $bdd, 'autespeces_resultat', 'checkBoxAutespecesCheck', 'checkBoxAutespecesOutcheck');
			}
		}
		elseif($TYPE == "checkBoxAutespecesAutreOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_AUTESPECES = $_GET['C_AUTESPECES'];
			$C_AUTESPECES_AUTRE = $_GET['C_AUTESPECES_AUTRE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];

			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rq= 'UPDATE menu_deroulant.caracterisation_autespeces SET AUTESPECES_AUTRE = :AUTESPECES_AUTRE WHERE ID_CARAC='."'".$ID_CARAC."'".' AND AUTESPECES = '."'".$C_AUTESPECES."'".'';
			$req_insert = $bdd->prepare($rq);
			$req_insert->execute(array(
						"AUTESPECES_AUTRE" => $C_AUTESPECES_AUTRE,
			));
			
			?>
				<table width="100%">
							<tr align="center"> 
								<th width="50%">Préciser : </th>
								<td width="50%"><input style="width:90%" type="text" id="C_AUTESPECES_AUTRE" value="<?php echo $C_AUTESPECES_AUTRE ?>"  onChange="RecAttribut('mare/enregmare.php', 'autespeces_autre', 'checkBoxAutespecesAutreOutcheck')" tabindex="53"></td>
							</tr>
						</table>
			<?php
		}
		elseif($TYPE == "checkBoxAutespecesCheck"){
			//ON RECUPERE LES VARAIBLE
			$C_AUTESPECES = $_GET['C_AUTESPECES'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rep = pg_query($bdd, 'DELETE FROM menu_deroulant.caracterisation_autespeces WHERE ID_CARAC='."'".$ID_CARAC."'".' AND AUTESPECES='."'".$C_AUTESPECES."'".'');

			if($TypeLien == "TypeTableau"){
				echo simpleDisplayCheckBox($listAutespeces, 'C_AUTESPECES', 'ID', 'AUTESPECES', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'autespeces_resultat', 'checkBoxAutespecesCheck', 'checkBoxAutespecesOutcheck');
			}else{
				echo simpleDisplayCheckBox($listAutespeces, 'C_AUTESPECES', 'ID', 'AUTESPECES', 0, 38, '', $ID_CARAC, $bdd, 'autespeces_resultat', 'checkBoxAutespecesCheck', 'checkBoxAutespecesOutcheck');
			}
		}
		elseif($TYPE == "checkBoxDechetsOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_DECHETS = $_GET['C_DECHETS'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_dechets("ID_CARAC", "DECHETS") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_DECHETS."'".')'); 
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listDechets, 'C_DECHETS', 'ID', 'DECHETS', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'dechets_resultat', 'checkBoxDechetsCheck', 'checkBoxDechetsOutcheck');
			}else{
				echo simpleDisplayCheckBox($listDechets, 'C_DECHETS', 'ID', 'DECHETS', 0, 38, '', $ID_CARAC, $bdd, 'dechets_resultat', 'checkBoxDechetsCheck', 'checkBoxDechetsOutcheck');
			}
		}
		elseif($TYPE == "checkBoxDechetsCheck"){
			//ON RECUPERE LES VARAIBLE
			$C_DECHETS = $_GET['C_DECHETS'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_dechets WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "DECHETS"='."'".$C_DECHETS."'".'');
			}

			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listDechets, 'C_DECHETS', 'ID', 'DECHETS', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'dechets_resultat', 'checkBoxDechetsCheck', 'checkBoxDechetsOutcheck');
			}else{
				echo simpleDisplayCheckBox($listDechets, 'C_DECHETS', 'ID', 'DECHETS', 0, 38, '', $ID_CARAC, $bdd, 'dechets_resultat', 'checkBoxDechetsCheck', 'checkBoxDechetsOutcheck');
			}
		}
		elseif($TYPE == "checkBoxUsageOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_USAGE = $_GET['C_USAGE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_usage("ID_CARAC", "C_USAGE") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_USAGE."'".')'); 
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listUsage, 'C_USAGE', 'ID', 'USAGE', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'usage_resultat', 'checkBoxUsageCheck', 'checkBoxUsageOutcheck');
			}else{
				echo simpleDisplayCheckBox($listUsage, 'C_USAGE', 'ID', 'USAGE', 0, 38, '', $ID_CARAC, $bdd, 'usage_resultat', 'checkBoxUsageCheck', 'checkBoxUsageOutcheck');
			}
		}
		elseif($TYPE == "checkBoxUsageCheck"){
			//ON RECUPERE LES VARAIBLE
			$C_USAGE = $_GET['C_USAGE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_usage WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "C_USAGE"='."'".$C_USAGE."'".'');

			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listUsage, 'C_USAGE', 'ID', 'USAGE', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'usage_resultat', 'checkBoxUsageCheck', 'checkBoxUsageOutcheck');
			}else{
				echo simpleDisplayCheckBox($listUsage, 'C_USAGE', 'ID', 'USAGE', 0, 38, '', $ID_CARAC, $bdd, 'usage_resultat', 'checkBoxUsageCheck', 'checkBoxUsageOutcheck');
			}
		}
		elseif($TYPE == "checkBoxTravauxOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_TRAVAUX = $_GET['C_TRAVAUX'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_travaux("ID_CARAC", "TRAVAUX") VALUES('."'".stripslashes($ID_CARAC)."'".', '."'".$C_TRAVAUX."'".')'); 
			}
			
			if($TypeLien == "TypeTableau"){ 
				echo simpleDisplayCheckBox($listTravaux, 'C_TRAVAUX', 'ID', 'TRAVAUX', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'travaux_resultat', 'checkBoxTravauxCheck', 'checkBoxTravauxOutcheck');
			}else{
				echo simpleDisplayCheckBox($listTravaux, 'C_TRAVAUX', 'ID', 'TRAVAUX', 0, 38, '', $ID_CARAC, $bdd, 'travaux_resultat', 'checkBoxTravauxCheck', 'checkBoxTravauxOutcheck');
			}
		}
		elseif($TYPE == "checkBoxTravauxAutreOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$C_TRAVAUX = $_GET['C_TRAVAUX'];
			$C_TRAVAUX_AUTRE = $_GET['C_TRAVAUX_AUTRE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'UPDATE saisie_observation.caracterisation_travaux SET "TRAVAUX_AUTRE" = E'."'".utf8_encode(addslashes($C_TRAVAUX_AUTRE))."'".' WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "TRAVAUX" ='."'".$C_TRAVAUX."'".'');
			
			?>
				<table width="100%">
					<tr align="center"> 
						<th width="50%">Préciser : </th>
						<td width="50%"><input style="width:90%" type="text" id="C_TRAVAUX_AUTRE" value="<?php echo $C_TRAVAUX_AUTRE?>" onChange="RecAttribut('mare/enregmare.php', 'travaux_autre', 'checkBoxTravauxAutreOutcheck')" tabindex="70"></td>
					</tr>
				</table>
			<?php
		}
		elseif($TYPE == "checkBoxTravauxCheck"){
			//ON RECUPERE LES VARAIBLE
			$C_TRAVAUX = $_GET['C_TRAVAUX'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID_CARAC = $_GET['ID_CARAC'];
			$TypeLien = $_GET['TypeLien'];
			$DISABLED = $_GET['DISABLED'];
			
			if($DISABLED == "NON"){
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$rep = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_travaux WHERE "ID_CARAC"='."'".$ID_CARAC."'".' AND "TRAVAUX"='."'".$C_TRAVAUX."'".'');
			}
			
			if($TypeLien == "TypeTableau"){
				echo simpleDisplayCheckBox($listTravaux, 'C_TRAVAUX', 'ID', 'TRAVAUX', 0, 38, 'TypeTableau', $ID_CARAC, $bdd, 'travaux_resultat', 'checkBoxTravauxCheck', 'checkBoxTravauxOutcheck');
			}else{
				echo simpleDisplayCheckBox($listTravaux, 'C_TRAVAUX', 'ID', 'TRAVAUX', 0, 38, '', $ID_CARAC, $bdd, 'travaux_resultat', 'checkBoxTravauxCheck', 'checkBoxTravauxOutcheck');
			}
		}
		elseif($TYPE == "RecMareLocMod"){
			//ON RECUPERE LES VARAIBLE
			$L_ID = $_GET['L_ID'];
			$L_IDSTRP = $_GET['L_IDSTRP'];
			$L_LIEN = $_GET['L_LIEN'];
			$L_LIEN_AUTRE = $_GET['L_LIEN_AUTRE'];
			$L_NOM = $_GET['L_NOM'];
			// $L_STATUT = $_GET['L_STATUT'];
			$L_PROPR = $_GET['L_PROPR'];
			$L_ANON = $_GET['L_ANON'];
			$C_COMT = $_GET['C_COMT'];
			
			// requete mysql pour la mise a jour :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rq = pg_query($bdd, 'UPDATE saisie_observation.localisation SET
				"L_IDSTRP" = E'."'".utf8_encode(addslashes($L_IDSTRP))."'".',
				"L_NOM" = E'."'".utf8_encode(addslashes($L_NOM))."'".',
				"L_PROP" = E'."'".utf8_encode(addslashes($L_PROPR))."'".',				
				"C_COMT" = E'."'".utf8_encode(addslashes($C_COMT))."'".',
				"L_LIEN" = E'."'".utf8_encode(addslashes($L_LIEN))."'".',
				"L_LIEN_AUTRE" = E'."'".utf8_encode(addslashes($L_LIEN_AUTRE))."'".',
				"L_ANON" = E'."'".utf8_encode(addslashes($L_ANON))."'".'
				WHERE "L_ID"='."'".$L_ID."'".'');
		
		}
		elseif($TYPE == "RecMareLoc"){
			//ON RECUPERE LES VARAIBLE
			$ID_MARE = $_GET['ID_MARE'];
			$L_DATE = $_GET['L_DATE'];
			$L_ID = $_GET['L_ID'];
			$L_IDSTRP = $_GET['L_IDSTRP'];
			$L_STRP = $_GET['L_STRP'];
			$L_OBSV = $_GET['L_OBSV'];
			$L_LIEN = $_GET['L_LIEN'];
			$L_LIEN_AUTRE = $_GET['L_LIEN_AUTRE'];
			$L_NOM = $_GET['L_NOM'];
			$L_ADMIN = $_GET['L_ADMIN'];
			$L_STATUT = $_GET['L_STATUT'];
			$L_PROPR = $_GET['L_PROPR'];
			if($_GET['L_COOX'] == ""){
				$L_COOX = number_format(ConvertCoordWGS84(floatval($_GET['L_COOX93']), floatval($_GET['L_COOY93']), 'X'), 5, '.', '');
			}else{
				$L_COOX = $_GET['L_COOX'];
			}
			if($_GET['L_COOY'] == ""){
				$L_COOY = number_format(ConvertCoordWGS84(floatval($_GET['L_COOX93']), floatval($_GET['L_COOY93']), 'Y'), 5, '.', '');
			}else{
				$L_COOY = $_GET['L_COOY'];
			}
			if($_GET['L_COOX93'] == ""){
				$L_COOX93 = number_format(ConvertCoord(floatval($_GET['L_COOX']), floatval($_GET['L_COOY']), 'X'), 2, '.', '');
			}else{
				$L_COOX93 = $_GET['L_COOX93'];
			}
			if($_GET['L_COOY93'] == ""){
				$L_COOY93 = number_format(ConvertCoord(floatval($_GET['L_COOX']), floatval($_GET['L_COOY']), 'Y'), 2, '.', '');
			}else{
				$L_COOY93 = $_GET['L_COOY93'];
			}
			$L_PREC = $_GET['L_PREC'];
			$L_ANON = $_GET['L_ANON'];
			$C_COMT = $_GET['C_COMT'];
			// $CARACTERISATION = $_GET['CARACTERISATION'];
			
			if($_GET['TYPE_CARTO'] == "GPS"){
				$L_STYP = "localisation approximative";
			}else{
				$L_STYP = "Centroïde de la mare";
			}
		
			// requete mysql pour la mise a jour :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rq = pg_query($bdd, 'UPDATE saisie_observation.localisation SET
				"L_ID" = E'."'".utf8_encode(addslashes($L_ID))."'".',
				"L_IDSTRP" = E'."'".utf8_encode(addslashes($L_IDSTRP))."'".',
				"L_NOM" = E'."'".utf8_encode(addslashes($L_NOM))."'".',
				"L_ADMIN" = E'."'".utf8_encode(addslashes($L_ADMIN))."'".',
				"L_STATUT" = E'."'".utf8_encode(addslashes($L_STATUT))."'".',
				"L_DATE" = E'."'".utf8_encode(addslashes(transfDate($L_DATE)))."'".',
				"L_OBSV" = E'."'".utf8_encode(addslashes($L_OBSV))."'".',
				"L_STRP" = E'."'".utf8_encode(addslashes($L_STRP))."'".',
				"L_PROP" = E'."'".utf8_encode(addslashes($L_PROPR))."'".',				
				"L_COOX" = '."'".$L_COOX."'".',
				"L_COOY" = '."'".$L_COOY."'".',
				"L_COOX93" = '."'".$L_COOX93."'".',
				"L_COOY93" = '."'".$L_COOY93."'".',
				"L_PREC" = E'."'".addslashes($L_PREC)."'".',
				"L_STYP" = E'."'".addslashes($L_STYP)."'".',
				"L_DCNP" = '."'2787'".',
				"C_COMT" = E'."'".utf8_encode(addslashes($C_COMT))."'".',
				"L_VALID" = '."'A Valider'".',
				"geom" = ST_SetSRID(ST_MakePoint('."'".$L_COOX."'".', '."'".$L_COOY."'".'),4326),
				"L_LIEN" = E'."'".utf8_encode(addslashes($L_LIEN))."'".',
				"L_LIEN_AUTRE" = E'."'".utf8_encode(addslashes($L_LIEN_AUTRE))."'".',
				"L_ANON" = E'."'".utf8_encode(addslashes($L_ANON))."'".'
				WHERE "ID"='."'".$ID_MARE."'".'');
		}
		elseif($TYPE == "RecMareCaracterisation"){
			//ON RECUPERE LES VARAIBLE
			$ID_CARAC = $_GET['ID_CARAC'];
			$C_DATE = $_GET['C_DATE'];
			$C_STRP = $_GET['C_STRP'];
			$C_OBSV = $_GET['C_OBSV'];
			$C_TYPE = $_GET['C_TYPE'];
			$C_VEGET = $_GET['C_VEGET'];
			$C_EVOLUTION = $_GET['C_EVOLUTION'];
			$C_ABREUV = $_GET['C_ABREUV'];
			$C_TOPO = $_GET['C_TOPO'];
			$C_TOPO_AUTRE = $_GET['C_TOPO_AUTRE'];
			$C_CLOTURE = $_GET['C_CLOTURE'];
			$C_HAIE = $_GET['C_HAIE'];
			$C_FORM = $_GET['C_FORM'];
			$C_PROF = $_GET['C_PROF'];
			$C_LONG = $_GET['C_LONG'];
			$C_LARG = $_GET['C_LARG'];
			$C_NATFOND = $_GET['C_NATFOND'];
			$C_NATFOND_AUTRE = $_GET['C_NATFOND_AUTRE'];
			$C_BERGES = $_GET['C_BERGES'];
			$C_BOURRELET = $_GET['C_BOURRELET'];
			$C_BOURRELET_POURCENTAGE = $_GET['C_BOURRELET_POURCENTAGE'];
			$C_PIETINEMENT = $_GET['C_PIETINEMENT'];
			$C_HYDROLOGIE = $_GET['C_HYDROLOGIE'];
			$C_TURBIDITE = $_GET['C_TURBIDITE'];
			$C_COULEUR = $_GET['C_COULEUR'];
			$C_COULEUR_PRECISION = $_GET['C_COULEUR_PRECISION'];
			$C_TAMPON = $_GET['C_TAMPON'];
			$C_EXUTOIRE = $_GET['C_EXUTOIRE'];
			$C_RECOU_TOTAL = $_GET['C_RECOU_TOTAL'];
			$C_RECOU_HELOPHYTE = $_GET['C_RECOU_HELOPHYTE'];
			$C_RECOU_HYDROPHYTE_E = $_GET['C_RECOU_HYDROPHYTE_E'];
			$C_RECOU_HYDROPHYTE_NE = $_GET['C_RECOU_HYDROPHYTE_NE'];
			$C_RECOU_ALGUE = $_GET['C_RECOU_ALGUE'];
			$C_RECOU_EAU_LIBRE = $_GET['C_RECOU_EAU_LIBRE'];
			$C_RECOU_NON_VEGET = $_GET['C_RECOU_NON_VEGET'];
			$C_EMBROUS = $_GET['C_EMBROUS'];
			$C_OMBRAGE = $_GET['C_OMBRAGE'];
			$C_OBJEC_TRAV = $_GET['C_OBJEC_TRAV'];
			$C_COMT_CARAC = $_GET['C_COMT_CARAC'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rq = pg_query($bdd, 'UPDATE saisie_observation.caracterisation SET 
						"C_DATE" = '."'".transfDate($C_DATE)."'".',
						"C_OBSV" = '."'".$C_OBSV."'".',
						"C_STRP" = '."'".$C_STRP."'".',
						"C_TYPE" = '."'".$C_TYPE."'".', 
						"C_VEGET" = '."'".$C_VEGET."'".', 
						"C_EVOLUTION" = '."'".$C_EVOLUTION."'".',
						"C_ABREUV" = '."'".$C_ABREUV."'".',
						"C_TOPO" = '."'".$C_TOPO."'".',
						"C_TOPO_AUTRE" = E'."'".utf8_encode(addslashes($C_TOPO_AUTRE))."'".',
						"C_CLOTURE" = '."'".$C_CLOTURE."'".',
						"C_HAIE" = '."'".$C_HAIE."'".',
						"C_FORM" = '."'".$C_FORM."'".', 
						"C_LONG" = '."'".$C_LONG."'".',
						"C_LARG" = '."'".$C_LARG."'".',
						"C_PROF" = '."'".$C_PROF."'".',
						"C_NATFOND" = '."'".$C_NATFOND."'".',
						"C_NATFOND_AUTRE" = E'."'".utf8_encode(addslashes($C_NATFOND_AUTRE))."'".',
						"C_BERGES" = '."'".$C_BERGES."'".',
						"C_BOURRELET" = '."'".$C_BOURRELET."'".',
						"C_BOURRELET_POURCENTAGE" = '."'".$C_BOURRELET_POURCENTAGE."'".',
						"C_PIETINEMENT" = '."'".$C_PIETINEMENT."'".',	
						"C_HYDROLOGIE" = '."'".$C_HYDROLOGIE."'".',
						"C_TURBIDITE" = '."'".$C_TURBIDITE."'".',
						"C_COULEUR" = '."'".$C_COULEUR."'".',
						"C_TAMPON" = '."'".$C_TAMPON."'".',
						"C_EXUTOIRE" = '."'".$C_EXUTOIRE."'".',
						"C_RECOU_TOTAL" = '."'".$C_RECOU_TOTAL."'".',
						"C_RECOU_HELOPHYTE" = '."'".$C_RECOU_HELOPHYTE."'".',
						"C_RECOU_HYDROPHYTE_E" = '."'".$C_RECOU_HYDROPHYTE_E."'".',
						"C_RECOU_HYDROPHYTE_NE" = '."'".$C_RECOU_HYDROPHYTE_NE."'".',
						"C_RECOU_ALGUE" = '."'".$C_RECOU_ALGUE."'".',
						"C_RECOU_EAU_LIBRE" = '."'".$C_RECOU_EAU_LIBRE."'".',
						"C_EMBROUS" = '."'".$C_EMBROUS."'".',
						"C_OMBRAGE" = '."'".$C_OMBRAGE."'".',
						"C_COMT" = E'."'".utf8_encode(addslashes($C_COMT_CARAC))."'".',
						"C_RECOU_NON_VEGET" = '."'".$C_RECOU_NON_VEGET."'".',
						"TEST_CARAC" = '."'1'".',
						"C_COULEUR_PRECISION" = E'."'".utf8_encode(addslashes($C_COULEUR_PRECISION))."'".',
						"C_OBJEC_TRAV" = E'."'".utf8_encode(addslashes($C_OBJEC_TRAV))."'".'
						WHERE "ID_CARAC" = '."'".$ID_CARAC."'".'');
			
			//ETANT DONNER QUE ON AJOUTER UNE CARACTERISATION A UNE MARE IL FAUT QUE ON PASSE SON STAUT EN MARE CARACTERISEE
			//ON VA RECHERCHER L'IDENTIFIANT DE LA MARE PAR REQUETE
			$req_l_id = pg_query($bdd, 'SELECT "L_ID" FROM saisie_observation.caracterisation WHERE "ID_CARAC" = '."'".$ID_CARAC."'".''); 
			$donnees_l_id = pg_fetch_array($req_l_id);
			//MISE A JOUR DE LA TABLE LOCALISATION AVEC LE STATUT DE CARACTERISATION
			$rq = pg_query($bdd, 'UPDATE saisie_observation.localisation SET 
						"L_STATUT" = '."'4'".'
						WHERE "L_ID" = '."'".$donnees_l_id['L_ID']."'".'');
		}
		elseif($TYPE == "RecMareCaracterisationSimplifiee"){
			//ON RECUPERE LES VARAIBLE
			$ID_CARAC = $_GET['ID_CARAC'];
			$C_DATE = $_GET['C_DATE'];
			$C_STRP = $_GET['C_STRP'];
			$C_OBSV = $_GET['C_OBSV'];
			$C_TYPE = $_GET['C_TYPE'];
			$C_VEGET = $_GET['C_VEGET'];
			$C_EVOLUTION = $_GET['C_EVOLUTION'];
			// $C_PROF = $_GET['C_PROF'];
			$C_LONG = $_GET['C_LONG'];
			$C_LARG = $_GET['C_LARG'];
			$C_COMT_CARAC = $_GET['C_COMT_CARAC'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rq = pg_query($bdd, 'UPDATE saisie_observation.caracterisation SET 
						"C_DATE" = '."'".transfDate($C_DATE)."'".',
						"C_OBSV" = '."'".$C_OBSV."'".',
						"C_STRP" = '."'".$C_STRP."'".',
						"C_TYPE" = '."'".$C_TYPE."'".', 
						"C_VEGET" = '."'".$C_VEGET."'".', 
						"C_EVOLUTION" = '."'".$C_EVOLUTION."'".',
						"C_ABREUV" = 1,
						"C_TOPO" = 1,
						"C_TOPO_AUTRE" = '."''".',
						"C_CLOTURE" = 1,
						"C_HAIE" = 1,
						"C_FORM" = 1,
						"C_LONG" = '."'".$C_LONG."'".',
						"C_LARG" = '."'".$C_LARG."'".',
						"C_PROF" = 1,
						"C_NATFOND" = 1,
						"C_NATFOND_AUTRE" = '."''".',
						"C_BERGES" = 1,
						"C_BOURRELET" = 1,
						"C_BOURRELET_POURCENTAGE" = '."''".',
						"C_PIETINEMENT" = 1,
						"C_HYDROLOGIE" = 1,
						"C_TURBIDITE" = 1,
						"C_COULEUR" = 1,
						"C_TAMPON" = 1,
						"C_EXUTOIRE" = 1,
						"C_RECOU_TOTAL" = 0,
						"C_RECOU_HELOPHYTE" = 0,
						"C_RECOU_HYDROPHYTE_E" = 0,
						"C_RECOU_HYDROPHYTE_NE" = 0,
						"C_RECOU_ALGUE" = 0,
						"C_RECOU_EAU_LIBRE" = 0,
						"C_EMBROUS" = 1,
						"C_OMBRAGE" = 1,
						"C_COMT" = E'."'".utf8_encode(addslashes($C_COMT_CARAC))."'".',
						"C_RECOU_NON_VEGET" = 0,
						"TEST_CARAC" = '."'1'".',
						"C_COULEUR_PRECISION" = '."''".',
						"C_OBJEC_TRAV" = '."''".'
						WHERE "ID_CARAC" = '."'".$ID_CARAC."'".'');
			
			//ETANT DONNER QUE ON AJOUTER UNE CARACTERISATION A UNE MARE IL FAUT QUE ON PASSE SON STAUT EN MARE CARACTERISEE
			//ON VA RECHERCHER L'IDENTIFIANT DE LA MARE PAR REQUETE
			$req_l_id = pg_query($bdd, 'SELECT "L_ID" FROM saisie_observation.caracterisation WHERE "ID_CARAC" = '."'".$ID_CARAC."'".''); 
			$donnees_l_id = pg_fetch_array($req_l_id);
			//MISE A JOUR DE LA TABLE LOCALISATION AVEC LE STATUT DE CARACTERISATION
			$rq = pg_query($bdd, 'UPDATE saisie_observation.localisation SET 
						"L_STATUT" = '."'4'".'
						WHERE "L_ID" = '."'".$donnees_l_id['L_ID']."'".'');
		}
		elseif($TYPE == "faune_flore" || $TYPE == "faune_flore_dupliquer"){
			//ON RECUPERE LES VARAIBLE
			$ID_MARE = $_GET['ID_MARE'];
			$O_DATE = $_GET['DATE'];
			$O_NLAT = $_GET['TAXON'];
			$O_NBRT = $_GET['METHODE_ACQUISITION'];
			$O_SACQ = $_GET['TECH_ACQ'];
			$O_COMT = $_GET['COMMENTAIRE'];
			$O_STYP = $_GET['COLLECTE'];
			$O_OBSV = $_GET['OBSERVATEUR'];
			$O_STRP = $_GET['STRUCTURE'];
			
			//SI O_NBRT ES PRESENCE ABSENCE ALORS AUTOMATIQUEMENT O_NBRE = 1
			if(strstr($_GET['METHODE_ACQUISITION'],"/ absence")){
				$O_NBRE = 1;
			}else{
				$O_NBRE = $_GET['NBRE'];
			}
			
			//ON VA FAIRE UNE REQUETE POUR SAVOIR SI C'EST UNE ESPECE FAUNE OU UNE ESPECE FLORE
			$event_exist = pg_query($bdd, 'SELECT * FROM menu_deroulant.referentiel_faune WHERE "TAXON"=E'."'".utf8_encode(addslashes($O_NLAT))."'".'');
			$count = pg_num_rows($event_exist);
			//SI SUPERIEUR  OU EGAL A 1 CEST QUE CEST UNE ESPECE FAUNE
			if($count >= 1){
				
					//ON VA FAIRE UNE REQUETE DANS LE REFERNETIEL FAUNE POUR RECUPERE LES INFO DE LESPECE
					$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.referentiel_faune WHERE "TAXON"=E'."'".utf8_encode(addslashes($O_NLAT))."'".''); 
					$donnees = pg_fetch_array($req);
					
					//ON VA FAIRE UNE REQUETE DANS LE REFERNETIEL FAUNE POUR RECUPERE LES INFO DE LESPECE
					$req = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID"='."'".$O_STRP."'".''); 
					$donnees_structure = pg_fetch_array($req);
					
					// requete mysql pour l'insertion :
					//CREER LA REQUETE DANS UNE VARIABLE A PART
					$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.observation("L_ID", "O_DATE", "O_REFE", "O_NLAT", "O_REID", "O_NVER", "O_NBRE", "O_NBRT", "O_SACQ", "O_ID", "O_COMT", "O_OBSV", "O_STRP", "O_STYP") 
													VALUES('."'".stripslashes($ID_MARE)."'".',
															'."'".transfDate($O_DATE)."'".',
															'."'TAXREF v8.0'".',
															E'."'".utf8_encode(addslashes($O_NLAT))."'".',
															'."'".$donnees['CD_NOM']."'".',
															E'."'".addslashes($donnees['NOM_VERNACULAIRE'])."'".',
															'."'".$O_NBRE."'".',
															E'."'".utf8_encode(addslashes($O_NBRT))."'".',
															'."'".$O_SACQ."'".',
															'."'".$donnees_structure['ID_SINP']."'".',
															E'."'".utf8_encode(addslashes($O_COMT))."'".',
															'."'".$O_OBSV."'".',
															'."'".$O_STRP."'".',
															'."'".$O_STYP."'".')');				
					$listRefTax= array();
					$req = pg_query($bdd, 'SELECT "TAXON" AS "ID", "TAXON" AS "TAXON" FROM menu_deroulant.referentiel_faune UNION ALL SELECT "Taxon_TAXREF" AS "ID", "Nom_Complet" AS "TAXON" FROM menu_deroulant.referentiel_flore ORDER BY "TAXON"'); 
					while($donnees = pg_fetch_array($req))
					{
						array_push($listRefTax, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
					}
			}
			//ELSE CEST UNE ESPECE FLORE
			else{
				//ON REFAIT UNE VERIFICATION POUR VOIR SI ON RENTRE PAS UN NOM QUI N'EST PAS DANS LE REFERENTIEL
				$event_exist = pg_query($bdd, 'SELECT * FROM menu_deroulant.referentiel_flore WHERE "Nom_Complet"=E'."'".utf8_encode(addslashes($O_NLAT))."'".'');
				$count = pg_num_rows($event_exist);
				if($count >= 1){
					//ON VA FAIRE UNE REQUETE DANS LE REFERNETIEL FAUNE POUR RECUPERE LES INFO DE LESPECE
					$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.referentiel_flore WHERE "Nom_Complet"=E'."'".utf8_encode(addslashes($O_NLAT))."'".''); 
					$donnees = pg_fetch_array($req);
					
					//ON VA FAIRE UNE REQUETE DANS LE REFERNETIEL FAUNE POUR RECUPERE LES INFO DE LESPECE
					$req = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID"='."'".$O_STRP."'".''); 
					$donnees_structure = pg_fetch_array($req);
					
					// requete mysql pour l'insertion :
					//CREER LA REQUETE DANS UNE VARIABLE A PART
						$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.observation("L_ID", "O_DATE", "O_REFE", "O_NLAT", "O_REID", "O_NVER", "O_NBRE", "O_REF2", "O_NLA2", "O_REI2", "O_NBRT", "O_SACQ", "O_ID", "O_COMT", "O_OBSV", "O_STRP", "O_STYP") 
													VALUES('."'".stripslashes($ID_MARE)."'".',
															'."'".transfDate($O_DATE)."'".',
															'."'TAXREF v8.0'".',
															E'."'".utf8_encode(addslashes($donnees['Taxon_TAXREF']))."'".',
															'."'".$donnees['Code_TAXREF']."'".',
															E'."'".addslashes($donnees['Nom_Francais'])."'".',
															'."'".$O_NBRE."'".',
															'."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".',
															E'."'".utf8_encode(addslashes($O_NLAT))."'".',
															'."'".$donnees['ID_Taxon']."'".',
															E'."'".utf8_encode(addslashes($O_NBRT))."'".',
															'."'".$O_SACQ."'".',
															'."'".$donnees_structure['ID_SINP']."'".',
															E'."'".utf8_encode(addslashes($O_COMT))."'".',
															'."'".$O_OBSV."'".',
															'."'".$O_STRP."'".',
															'."'".$O_STYP."'".')');
															
				}else{
					echo "<p><b><em><font color='red'>Le taxon que vous essayez de rentrer ne figure dans aucun des référentiels taxonomique. Veuillez vérifier votre saisie.</font></em></b></p></center>";
				}
				
				$listRefTax= array();
				$req = pg_query($bdd, 'SELECT "TAXON" AS "ID", "TAXON" AS "TAXON" FROM menu_deroulant.referentiel_faune UNION ALL SELECT "Taxon_TAXREF" AS "ID", "Nom_Complet" AS "TAXON" FROM menu_deroulant.referentiel_flore ORDER BY "TAXON"'); 
				while($donnees = pg_fetch_array($req))
				{
					array_push($listRefTax, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
				}
			}

			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.observation WHERE "L_ID"='."'".$ID_MARE."'".' AND "O_STRP" = '."'".$O_STRP."'".' ORDER BY "O_ID_UNIQUE" DESC');
			?>			
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td style="width:8%;">
							<input style="width:95%" type="text" id="O_DATE_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo date('d/m/Y', $donnees['O_DATE']) ?>" placeholder="JJ/MM/AAAA" onblur="verifchampVide(this)">
						</td>
						<td style="width:22%;">
							<?php echo simpleDisplaySelect($listRefTax, 'O_NLAT_'.$donnees['O_ID_UNIQUE'], 'ID', 'TAXON', $donnees['O_NLAT'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:5%;">
							<input style="width:95%" type="text" id="O_NBRE_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo $donnees['O_NBRE'] ?>" onblur="verifchampVide(this)">
						</td>
						<td style="width:10%;">
							<select style="width:90%" id="O_NBRT_<?php echo $donnees['O_ID_UNIQUE'];?>" name="O_NBRT">
								<option value="Tous">A Saisir</option>
								<option value="Nombre d'adultes" <?php if($donnees['O_NBRT'] == "Nombre d'adultes"){ echo "selected";}?>>Nombre d'adultes</option>
								<option value="Présence / absence" <?php if($donnees['O_NBRT'] == "Présence / absence"){ echo "selected";}?>>Présence / absence</option>
							</select>
						</td>
						<td style="width:25%;">
							<?php echo simpleDisplaySelect($listSacq, 'O_SACQ_'.$donnees['O_ID_UNIQUE'], 'ID', 'SACQ', $donnees['O_SACQ'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:5%;">
							<?php echo simpleDisplaySelect($listStyp, 'O_STYP_'.$donnees['O_ID_UNIQUE'], 'ID', 'STYP', $donnees['O_STYP'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:20%;">
							<input style="width:95%" type="text" id="O_COMT_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo $donnees['O_COMT'] ?>">
						</td>
						<td style="width:15%;">
							<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['O_ID_UNIQUE'] ?>&IDSTRUCTURE=<?php echo $O_STRP ?>', 'resultat_petit', 'modifiefaune_flore')">
								<img src="../img/enreg.png" width="25">
							</a>
							<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['O_ID_UNIQUE'] ?>&IDSTRUCTURE=<?php echo $O_STRP ?>', 'resultat_petit', 'supprimefaune_flore')">
								<img src="../img/sup.png" width="25">
							</a>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "modifiefaune_flore"){
			//ON RECUPERE LES VARAIBLE
			$ID_MARE = $_GET['ID_MARE'];
			$O_DATE = $_GET['DATE'];
			$O_NLAT = $_GET['TAXON'];
			$O_NBRT = $_GET['METHODE_ACQUISITION'];
			$O_SACQ = $_GET['TECH_ACQ'];
			$O_COMT = $_GET['COMMENTAIRE'];
			$O_STYP = $_GET['COLLECTE'];
			$ID = $_GET['ID'];
			$IDSTRUCTURE = $_GET['IDSTRUCTURE'];
			
			//SI O_NBRT ES PRESENCE ABSENCE ALORS AUTOMATIQUEMENT O_NBRE = 1
			if(strstr($_GET['METHODE_ACQUISITION'],"/ absence")){
				$O_NBRE = 1;
			}else{
				$O_NBRE = $_GET['NBRE'];
			}
			
			//ON VA FAIRE UNE REQUETE POUR SAVOIR SI C'EST UNE ESPECE FAUNE OU UNE ESPECE FLORE
			$event_exist = pg_query($bdd, 'SELECT * FROM menu_deroulant.referentiel_faune WHERE "TAXON"=E'."'".utf8_encode(addslashes($O_NLAT))."'".'');
			$count = pg_num_rows($event_exist);
			//SI SUPERIEUR  OU EGAL A 1 CEST QUE CEST UNE ESPECE FAUNE
			if($count >= 1){
				
					//ON VA FAIRE UNE REQUETE DANS LE REFERNETIEL FAUNE POUR RECUPERE LES INFO DE LESPECE
					$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.referentiel_faune WHERE "TAXON"=E'."'".utf8_encode(addslashes($O_NLAT))."'".''); 
					$donnees = pg_fetch_array($req);

					// requete mysql pour l'insertion :
					//CREER LA REQUETE DANS UNE VARIABLE A PART
					$req_update = pg_query($bdd, 'UPDATE saisie_observation.observation SET
														"O_DATE" = '."'".transfDate($O_DATE)."'".', 
														"O_NLAT" = E'."'".utf8_encode(addslashes($O_NLAT))."'".', 
														"O_REID" = '."'".$donnees['CD_NOM']."'".', 
														"O_NVER" = E'."'".addslashes($donnees['NOM_VERNACULAIRE'])."'".', 
														"O_NBRE" = '."'".$O_NBRE."'".', 
														"O_NBRT" = E'."'".utf8_encode(addslashes($O_NBRT))."'".', 
														"O_SACQ" = '."'".$O_SACQ."'".', 
														"O_COMT" = E'."'".utf8_encode(addslashes($O_COMT))."'".', 
														"O_STYP" = '."'".$O_STYP."'".' 
														WHERE "O_ID_UNIQUE"='."'".$ID."'".'');	
					
					$listRefTax= array();
					$req = pg_query($bdd, 'SELECT "TAXON" AS "ID", "TAXON" AS "TAXON" FROM menu_deroulant.referentiel_faune UNION ALL SELECT "Taxon_TAXREF" AS "ID", "Nom_Complet" AS "TAXON" FROM menu_deroulant.referentiel_flore ORDER BY "TAXON"'); 
					while($donnees = pg_fetch_array($req))
					{
						array_push($listRefTax, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
					}
			}
			//ELSE CEST UNE ESPECE FLORE
			else{
				//ON REFAIT UNE VERIFICATION POUR VOIR SI ON RENTRE PAS UN NOM QUI N'EST PAS DANS LE REFERENTIEL
				$event_exist = pg_query($bdd, 'SELECT * FROM menu_deroulant.referentiel_flore WHERE "Taxon_TAXREF"=E'."'".utf8_encode(addslashes($O_NLAT))."'".'');
				$count = pg_num_rows($event_exist);
				if($count >= 1){
					//ON VA FAIRE UNE REQUETE DANS LE REFERNETIEL FLORE POUR RECUPERE LES INFO DE LESPECE
					$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.referentiel_flore WHERE "Taxon_TAXREF"=E'."'".utf8_encode(addslashes($O_NLAT))."'".''); 
					$donnees = pg_fetch_array($req);
					
					
					// requete mysql pour l'insertion :
					//CREER LA REQUETE DANS UNE VARIABLE A PART
					$req_update = pg_query($bdd, 'UPDATE saisie_observation.observation SET
													"O_DATE" = '."'".transfDate($O_DATE)."'".', 
													"O_NLAT" = '."'".$donnees['Taxon_TAXREF']."'".', 
													"O_REID" = '."'".$donnees['Code_TAXREF']."'".', 
													"O_NVER" = E'."'".addslashes($donnees['Nom_Francais'])."'".', 
													"O_NBRE" = '."'".$O_NBRE."'".',
													"O_REF2" = '."'Inventaire de la flore vasculaire de Haute-Normandie (CBNBL)'".',
													"O_NLA2" = '."'".$donnees['Nom_Complet']."'".', 
													"O_REI2" = '."'".$donnees['ID_Taxon']."'".', 
													"O_NBRT" = '."'".utf8_encode($O_NBRT)."'".', 
													"O_SACQ" = '."'".$O_SACQ."'".',
													"O_COMT" = '."'".utf8_encode($O_COMT)."'".',
													"O_STYP" = '."'".$O_STYP."'".'
													WHERE "O_ID_UNIQUE"='."'".$ID."'".'');
				}else{
					echo "<p><b><em><font color='red'>Le taxon que vous essayez de rentrer ne figure dans aucun des référentiels taxonomique. Veuillez vérifier votre saisie.</font></em></b></p></center>";
				}
				
				$listRefTax= array();
				$req = pg_query($bdd, 'SELECT "TAXON" AS "ID", "TAXON" AS "TAXON" FROM menu_deroulant.referentiel_faune UNION ALL SELECT "Taxon_TAXREF" AS "ID", "Nom_Complet" AS "TAXON" FROM menu_deroulant.referentiel_flore ORDER BY "TAXON"'); 
				while($donnees = pg_fetch_array($req))
				{
					array_push($listRefTax, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
				}
			}
			
			
		
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.observation WHERE "L_ID"='."'".$ID_MARE."'".' AND "O_STRP" = '."'".$IDSTRUCTURE."'".' ORDER BY "O_ID_UNIQUE" DESC');
			?>		
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td style="width:8%;">
							<input style="width:95%" type="text" id="O_DATE_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo date('d/m/Y', $donnees['O_DATE']) ?>" placeholder="JJ/MM/AAAA" onblur="verifchampVide(this)">
						</td>
						<td style="width:22%;">
							<?php echo simpleDisplaySelect($listRefTax, 'O_NLAT_'.$donnees['O_ID_UNIQUE'], 'ID', 'TAXON', $donnees['O_NLAT'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:5%;">
							<input style="width:95%" type="text" id="O_NBRE_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo $donnees['O_NBRE'] ?>" onblur="verifchampVide(this)">
						</td>
						<td style="width:10%;">
							<select style="width:90%" id="O_NBRT_<?php echo $donnees['O_ID_UNIQUE'];?>" name="O_NBRT">
								<option value="Tous">A Saisir</option>
								<option value="Nombre d'adultes" <?php if($donnees['O_NBRT'] == "Nombre d'adultes"){ echo "selected";}?>>Nombre d'adultes</option>
								<option value="Présence / absence" <?php if($donnees['O_NBRT'] == "Présence / absence"){ echo "selected";}?>>Présence / absence</option>
							</select>
						</td>
						<td style="width:25%;">
							<?php echo simpleDisplaySelect($listSacq, 'O_SACQ_'.$donnees['O_ID_UNIQUE'], 'ID', 'SACQ', $donnees['O_SACQ'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:5%;">
							<?php echo simpleDisplaySelect($listStyp, 'O_STYP_'.$donnees['O_ID_UNIQUE'], 'ID', 'STYP', $donnees['O_STYP'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:20%;">
							<input style="width:95%" type="text" id="O_COMT_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo $donnees['O_COMT'] ?>">
						</td>
						<td style="width:15%;">
							<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['O_ID_UNIQUE'] ?>&IDSTRUCTURE=<?php echo $IDSTRUCTURE ?>', 'resultat_petit', 'modifiefaune_flore')">
								<img src="../img/enreg.png" width="25">
							</a>
							<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['O_ID_UNIQUE'] ?>&IDSTRUCTURE=<?php echo $IDSTRUCTURE ?>', 'resultat_petit', 'supprimefaune_flore')">
								<img src="../img/sup.png" width="25">
							</a>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "supprimefaune_flore"){
			//ON RECUPERE LES VARAIBLE
			$IDSTRUCTURE = $_GET['IDSTRUCTURE'];
			$ID_MARE = $_GET['ID_MARE'];
			$ID = $_GET['ID'];
			
			$listRefTax= array();
			$req = pg_query($bdd, 'SELECT "TAXON" AS "ID", "TAXON" AS "TAXON" FROM menu_deroulant.referentiel_faune
								UNION
								SELECT "Taxon_TAXREF" AS "ID", "Nom_Complet" AS "TAXON" FROM menu_deroulant.referentiel_flore
								ORDER BY "TAXON"'); 
			while($donnees = pg_fetch_array($req))
			{
				array_push($listRefTax, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
			}

			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rep = pg_query($bdd, 'DELETE FROM saisie_observation.observation WHERE "O_ID_UNIQUE"='."'".$ID."'".'');

			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.observation WHERE "L_ID"='."'".$ID_MARE."'".' AND "O_STRP" = '."'".$IDSTRUCTURE."'".' ORDER BY "O_ID_UNIQUE" DESC');
			?>		
			<table width="100%">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td style="width:8%;">
							<input style="width:95%" type="text" id="O_DATE_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo date('d/m/Y', $donnees['O_DATE']) ?>" placeholder="JJ/MM/AAAA" onblur="verifchampVide(this)">
						</td>
						<td style="width:22%;">
							<?php echo simpleDisplaySelect($listRefTax, 'O_NLAT_'.$donnees['O_ID_UNIQUE'], 'ID', 'TAXON', $donnees['O_NLAT'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:5%;">
							<input style="width:95%" type="text" id="O_NBRE_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo $donnees['O_NBRE'] ?>" onblur="verifchampVide(this)">
						</td>
						<td style="width:10%;">
							<select style="width:90%" id="O_NBRT_<?php echo $donnees['O_ID_UNIQUE'];?>" name="O_NBRT">
								<option value="Tous">A Saisir</option>
								<option value="Nombre d'adultes" <?php if($donnees['O_NBRT'] == "Nombre d'adultes"){ echo "selected";}?>>Nombre d'adultes</option>
								<option value="Présence / absence" <?php if($donnees['O_NBRT'] == "Présence / absence"){ echo "selected";}?>>Présence / absence</option>
							</select>
						</td>
						<td style="width:25%;">
							<?php echo simpleDisplaySelect($listSacq, 'O_SACQ_'.$donnees['O_ID_UNIQUE'], 'ID', 'SACQ', $donnees['O_SACQ'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:5%;">
							<?php echo simpleDisplaySelect($listStyp, 'O_STYP_'.$donnees['O_ID_UNIQUE'], 'ID', 'STYP', $donnees['O_STYP'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:20%;">
							<input style="width:95%" type="text" id="O_COMT_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo $donnees['O_COMT'] ?>">
						</td>
						<td style="width:15%;">
							<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['O_ID_UNIQUE'] ?>&IDSTRUCTURE=<?php echo $IDSTRUCTURE ?>', 'resultat_petit', 'modifiefaune_flore')">
								<img src="../img/enreg.png" width="25">
							</a>
							<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['O_ID_UNIQUE'] ?>&IDSTRUCTURE=<?php echo $IDSTRUCTURE ?>', 'resultat_petit', 'supprimefaune_flore')">
								<img src="../img/sup.png" width="25">
							</a>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}
		elseif($TYPE == "affichage_faune_flore"){
			$listRefTax= array();
			$req = pg_query($bdd, 'SELECT "TAXON" AS "ID", "TAXON" AS "TAXON" FROM menu_deroulant.referentiel_faune
								UNION
								SELECT "Taxon_TAXREF" AS "ID", "Nom_Complet" AS "TAXON" FROM menu_deroulant.referentiel_flore
								ORDER BY "TAXON"'); 
			while($donnees = pg_fetch_array($req))
			{
				array_push($listRefTax, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
			}
			
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.observation WHERE "L_ID"='."'".$ID_MARE."'".' AND "O_STRP" = '."'".$IDSTRUCTURE."'".' ORDER BY "O_ID_UNIQUE" DESC');
			?>			
			<table width="100%" border="0">
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr align="center" class="<?php echo $style ?>"> 
						<td style="width:8%;">
							<input style="width:95%" type="text" id="O_DATE_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo date('d/m/Y', $donnees['O_DATE']) ?>" placeholder="JJ/MM/AAAA" onblur="verifchampVide(this)">
						</td>
						<td style="width:22%;">
							<?php echo simpleDisplaySelect($listRefTax, 'O_NLAT_'.$donnees['O_ID_UNIQUE'], 'ID', 'TAXON', $donnees['O_NLAT'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:5%;">
							<input style="width:95%" type="text" id="O_NBRE_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo $donnees['O_NBRE'] ?>" onblur="verifchampVide(this)">
						</td>
						<td style="width:10%;">
							<select style="width:90%" id="O_NBRT_<?php echo $donnees['O_ID_UNIQUE'];?>" name="O_NBRT">
								<option value="Tous">A Saisir</option>
								<option value="Nombre d'adultes" <?php if($donnees['O_NBRT'] == "Nombre d'adultes"){ echo "selected";}?>>Nombre d'adultes</option>
								<option value="Présence / absence" <?php if($donnees['O_NBRT'] == "Présence / absence"){ echo "selected";}?>>Présence / absence</option>
							</select>
						</td>
						<td style="width:25%;">
							<?php echo simpleDisplaySelect($listSacq, 'O_SACQ_'.$donnees['O_ID_UNIQUE'], 'ID', 'SACQ', $donnees['O_SACQ'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:5%;">
							<?php echo simpleDisplaySelect($listStyp, 'O_STYP_'.$donnees['O_ID_UNIQUE'], 'ID', 'STYP', $donnees['O_STYP'], 'verifchampSelect(this)', ''); ?>
						</td>
						<td style="width:20%;">
							<input style="width:95%" type="text" id="O_COMT_<?php echo $donnees['O_ID_UNIQUE'];?>" value="<?php echo $donnees['O_COMT'] ?>">
						</td>
						<td style="width:15%;">
							<a Title="Enregistrer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['O_ID_UNIQUE'] ?>&IDSTRUCTURE=<?php echo $IDSTRUCTURE ?>', 'resultat_petit', 'modifiefaune_flore')">
								<img src="../img/enreg.png" width="25">
							</a>
							<a Title="Supprimer" onclick="RecAttribut('mare/enregmare.php?ID=<?php echo $donnees['O_ID_UNIQUE'] ?>&IDSTRUCTURE=<?php echo $IDSTRUCTURE ?>', 'resultat_petit', 'supprimefaune_flore')">
								<img src="../img/sup.png" width="25">
							</a>
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			<?php
		}elseif($TYPE == "changer_statut"){
			$L_ID = $_GET['L_ID'];
			$STATUT = $_GET['statut'];
			
			if($STATUT == 1){
				echo "<p style='color:red'><b>Vous devez choisir un statut pour valider le changement</b></p>";
			}else{
				//ON VA CHERCHER LE STATUT DE LA MRE PAR REQUETE
				$req_statut = pg_query($bdd, 'SELECT "L_STATUT" FROM saisie_observation.localisation WHERE "L_ID"='."'".$L_ID."'".'');
				$donnees = pg_fetch_array($req_statut);
				$Staut_actuel_mare = $donnees['L_STATUT'];
				
				//SI STATUT CHOISI = POTENTIEL ALORS IL EST IMPOSIBLE DE PASSER UNE MARE VUE, CARACTERISER OU DISPARUE EN POTENTIEL
				if($STATUT == 2){
					echo "<p style='color:red'><b>Il est impossible de passer le statut de la mare au statut de mare potentielle</b></p>";
				}//SI STATUT CHOISI = VUE ALORS LA MARE NE PEUT ETRE QUE UNE MARE A LA BASE POTENTIEL
				elseif($STATUT == 3){
					if($Staut_actuel_mare == 2){
						//SI MARE POTENTIEL ALORS ON PEUT CHANGER LE STATUT EN MARE VUE
						//REQUETE DE MISE A JOUR SUR LE STATUT
						// requete mysql pour l'insertion :
						//CREER LA REQUETE DANS UNE VARIABLE A PART
						$req_update = pg_query($bdd, 'UPDATE saisie_observation.localisation SET
														"L_STATUT" = '."'".$STATUT."'".'
														WHERE "L_ID"='."'".$L_ID."'".'');
						echo "<p style='color:green'><b>Le statut de la mare a été mis à jour avec le statut de mare vue</b></p>";
					}elseif($Staut_actuel_mare == 3){
						echo "<p style='color:green'><b>Le statut sélectionné est déjà le statut actuel de la mare</b></p>";
					}else{
						echo "<p style='color:red'><b>Il est impossible de passer le statut de la mare au statut de mare vue car celle-ci ne possède pas le statut de mare potentielle</b></p>";
					}
				}elseif($STATUT == 4){
					//POUR PASSER UNE MARE CARACTERISER ON VA ALLER VERIFIER SI ELLE POSSEDE UNE CARACTERISATION SI ELLE NE POSSEDE PAS DE CARACTERISATION ALORS IL EST IMPOSSIBLE DE LA PASSER EN CARACTERISER
					$req_carac = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation WHERE "L_ID"='."'".$L_ID."'".'');
					$count = pg_num_rows($req_carac);
					if($Staut_actuel_mare == 4){
						echo "<p style='color:green'><b>Le statut sélectionné est déjà le statut actuel de la mare</b></p>";
					}else{
						if($count >= 1){
							$req_update = pg_query($bdd, 'UPDATE saisie_observation.localisation SET
															"L_STATUT" = '."'".$STATUT."'".'
															WHERE "L_ID"='."'".$L_ID."'".'');
							echo "<p style='color:green'><b>Le statut de la mare a été mis à jour avec le statut de mare caractérisée</b></p>";
						}else{
							echo "<p style='color:red'><b>Il est impossible de passer le statut de la mare au statut de mare caractérisée car celle-ci ne possède pas de caractérisation enregistrée dans la base de données.</b></p>";
						}
					}
				}elseif($STATUT == 5){
					if($Staut_actuel_mare == 5){
						echo "<p style='color:green'><b>Le statut sélectionné est déjà le statut actuel de la mare</b></p>";
					}else{
						$req_update = pg_query($bdd, 'UPDATE saisie_observation.localisation SET
														"L_STATUT" = '."'".$STATUT."'".'
														WHERE "L_ID"='."'".$L_ID."'".'');
						echo "<p style='color:green'><b>Le statut de la mare a été mis à jour avec le statut de mare disparue</b></p>";
					}				
				}
			}	
		
		
		}elseif($TYPE == "supprimer_mare"){
			$L_ID = $_GET['L_ID'];
						
			//ON VA SUPPRIMER LA LOCALISATION
			$sup_loca = pg_query($bdd, 'DELETE FROM saisie_observation.localisation WHERE "L_ID"='."'".$L_ID."'".'');
			// $donnees = pg_fetch_array($sup_loca);
			
			
			
			//ON VA FAIRE UNE REQUETE POUR ALLER CHERCHER LID DE LA CARACTERISTATION POUR SUPPRIMER DANS LES TABLES ENFANTS
			$select_carac = pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation WHERE "L_ID"='."'".$L_ID."'".'');
			
			//POUR CHAQUE ENREGISTREMENT ON VA FAIRE UNE BOUCLE POUR SUPPRIMER DANS LES DIFFERENTE TABLE
			while ($donnees_carac = pg_fetch_array($select_carac)){
					$sup_alim = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_alimentation WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_context = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_context WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_dechets = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_dechets WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_eaee = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_eaee WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_evee = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_evee WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_faune = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_faune WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_liaison = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_liaison WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_photo = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_photo WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_schema = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_schema WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_travaux = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_travaux WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
					$sup_usage = pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation_usage WHERE "ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".'');
			}
			
			//ON SUPPRIME LA LIGNE CARAXTERISATION DE LA MARE
			$sup_carac =  pg_query($bdd, 'DELETE FROM saisie_observation.caracterisation WHERE "L_ID"='."'".$L_ID."'".'');
			
			//ON SUPPRIME LES OBSERVATIONS FAUNE FLORE
			$sup_observation =  pg_query($bdd, 'DELETE FROM saisie_observation.observation WHERE "L_ID"='."'".$L_ID."'".'');
			
			//Message de confirmation
			echo "<p style='color:green'><b>La localisation de la mare ainsi que les caractérisations et les observations associées ont été supprimées.</b></p>";
		}elseif($TYPE == "checkBoxSymptomeOutCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_SYMPTOME = $_GET['l_symptome'];
			$ID_MARE = $_GET['id_mare'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'INSERT INTO module_pram.smbvpc_mod1_symptome(l_id, symptome) VALUES('."'".stripslashes($ID_MARE)."'".', '."'".$L_SYMPTOME."'".')'); 
			
			echo simpleDisplayCheckBox($listSymptome, 'l_symptome', 'id', 'symptome', 0, 7, 'module', $ID_MARE, $bdd, 'symptome_resultat', 'checkBoxSymptomeCheck', 'checkBoxSymptomeOutCheck');
		}
		elseif($TYPE == "checkBoxSymptomeCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_SYMPTOME = $_GET['l_symptome'];
			$ID_MARE = $_GET['id_mare'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rep = pg_query($bdd, 'DELETE FROM module_pram.smbvpc_mod1_symptome WHERE l_id='."'".$ID_MARE."'".' AND symptome='."'".$L_SYMPTOME."'".'');
			
			echo simpleDisplayCheckBox($listSymptome, 'l_symptome', 'id', 'symptome', 0, 7, 'module', $ID_MARE, $bdd, 'symptome_resultat', 'checkBoxSymptomeCheck', 'checkBoxSymptomeOutCheck');
		}
		elseif($TYPE == "checkBoxContextAmontOutCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONTEXT_AMONT = $_GET['l_context_amont'];
			$ID_MARE = $_GET['id_mare'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'INSERT INTO module_pram.smbvpc_mod1_context_amont(l_id, contexte_amont) VALUES('."'".stripslashes($ID_MARE)."'".', '."'".$L_CONTEXT_AMONT."'".')'); 
	
			echo simpleDisplayCheckBox($listContexteAmont, 'l_context_amont', 'id', 'context_amont', 0, 8, 'module', $ID_MARE, $bdd, 'context_amont_resultat', 'checkBoxContextAmontCheck', 'checkBoxContextAmontOutCheck');
		}
		elseif($TYPE == "checkBoxContextAmontAutreOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONTEXT_AMONT = $_GET['l_context_amont'];
			$C_CONTEXT_AMONT_AUTRE = $_GET['l_context_amont_autre'];
			$ID_MARE = $_GET['id_mare'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'UPDATE module_pram.smbvpc_mod1_context_amont SET contexte_amont_autre = E'."'".addslashes($C_CONTEXT_AMONT_AUTRE)."'".' WHERE l_id='."'".$ID_MARE."'".' AND contexte_amont ='."'".$L_CONTEXT_AMONT."'".'');
			
			?>
				<table width="100%">
				<tr align="center"> 
					<th width="20%">Préciser : </th>
					<td width="80%"><input style="width:90%" type="text" id="l_context_amont_autre" value="<?php echo $C_CONTEXT_AMONT_AUTRE?>" onChange="RecAttribut('../../mare/enregmare.php', 'context_amont_autre', 'checkBoxContextAmontAutreOutcheck')" tabindex="9"></td>
				</tr>
			</table>
			<?php
		}
		elseif($TYPE == "checkBoxContextAmontCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONTEXT_AMONT = $_GET['l_context_amont'];
			$ID_MARE = $_GET['id_mare'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rep = pg_query($bdd, 'DELETE FROM module_pram.smbvpc_mod1_context_amont WHERE l_id='."'".$ID_MARE."'".' AND contexte_amont='."'".$L_CONTEXT_AMONT."'".'');

			echo simpleDisplayCheckBox($listContexteAmont, 'l_context_amont', 'id', 'context_amont', 0, 8, 'module', $ID_MARE, $bdd, 'context_amont_resultat', 'checkBoxContextAmontCheck', 'checkBoxContextAmontOutCheck');
		}
		elseif($TYPE == "checkBoxContextRapprocheOutCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONTEXT_RAPPROCHE = $_GET['l_context_rapproche'];
			$ID_MARE = $_GET['id_mare'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'INSERT INTO module_pram.smbvpc_mod1_context_rapproche(l_id, contexte_rapproche) VALUES('."'".stripslashes($ID_MARE)."'".', '."'".$L_CONTEXT_RAPPROCHE."'".')'); 
	
			echo simpleDisplayCheckBox($listContexteRapproche, 'l_context_rapproche', 'id', 'context_rapproche', 0, 9, 'module', $ID_MARE, $bdd, 'context_rapproche_resultat', 'checkBoxContextRapprocheCheck', 'checkBoxContextRapprocheOutCheck');
		}
		elseif($TYPE == "checkBoxContextRapprocheAutreOutcheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONTEXT_RAPPROCHE = $_GET['l_context_rapproche'];
			$C_CONTEXT_RAPPROCHE_AUTRE = $_GET['l_context_rapproche_autre'];
			$ID_MARE = $_GET['id_mare'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'UPDATE module_pram.smbvpc_mod1_context_rapproche SET contexte_rapproche_autre = E'."'".addslashes($C_CONTEXT_RAPPROCHE_AUTRE)."'".' WHERE l_id='."'".$ID_MARE."'".' AND contexte_rapproche ='."'".$L_CONTEXT_RAPPROCHE."'".'');
			
			?>
				<table width="100%">
				<tr align="center"> 
					<th width="20%">Préciser : </th>
					<td width="80%"><input style="width:90%" type="text" id="l_context_rapproche_autre" value="<?php echo $C_CONTEXT_RAPPROCHE_AUTRE?>" onChange="RecAttribut('../../mare/enregmare.php', 'context_rapproche_autre', 'checkBoxContextRapprocheAutreOutcheck')" tabindex="9"></td>
				</tr>
			</table>
			<?php
		}
		elseif($TYPE == "checkBoxContextRapprocheCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONTEXT_RAPPROCHE = $_GET['l_context_rapproche'];
			$ID_MARE = $_GET['id_mare'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rep = pg_query($bdd, 'DELETE FROM module_pram.smbvpc_mod1_context_rapproche WHERE l_id='."'".$ID_MARE."'".' AND contexte_rapproche='."'".$L_CONTEXT_RAPPROCHE."'".'');

			echo simpleDisplayCheckBox($listContexteRapproche, 'l_context_rapproche', 'id', 'context_rapproche', 0, 9, 'module', $ID_MARE, $bdd, 'context_rapproche_resultat', 'checkBoxContextRapprocheCheck', 'checkBoxContextRapprocheOutCheck');
		}
		elseif($TYPE == "checkBoxContextAvalOutCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONTEXT_AVAL = $_GET['l_context_aval'];
			$ID_MARE = $_GET['id_mare'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$req_insert = pg_query($bdd, 'INSERT INTO module_pram.smbvpc_mod1_context_aval(l_id, contexte_aval) VALUES('."'".stripslashes($ID_MARE)."'".', '."'".$L_CONTEXT_AVAL."'".')'); 
	
			echo simpleDisplayCheckBox($listContexteAval, 'l_context_aval', 'id', 'context_aval', 0, 10, 'module', $ID_MARE, $bdd, 'context_aval_resultat', 'checkBoxContextAvalCheck', 'checkBoxContextAvalOutCheck');
		}
		elseif($TYPE == "checkBoxContextAvalCheck"){
			//ON RECUPERE LES VARAIBLE
			$L_CONTEXT_AVAL = $_GET['l_context_aval'];
			$ID_MARE = $_GET['id_mare'];
			$TypeLien = $_GET['TypeLien'];
			
			// requete mysql pour l'insertion :
			//CREER LA REQUETE DANS UNE VARIABLE A PART
			$rep = pg_query($bdd, 'DELETE FROM module_pram.smbvpc_mod1_context_aval WHERE l_id='."'".$ID_MARE."'".' AND contexte_aval='."'".$L_CONTEXT_AVAL."'".'');

			echo simpleDisplayCheckBox($listContexteAval, 'l_context_aval', 'id', 'context_aval', 0, 10, 'module', $ID_MARE, $bdd, 'context_aval_resultat', 'checkBoxContextAvalCheck', 'checkBoxContextAvalOutCheck');
		}elseif($TYPE == "FormulaireDemandeAcces"){
			//ON RECUPERE LES VARAIBLE
			$STRUCTURE = $_GET['STRUCTURE'];
			$PERSONNE = $_GET['PERSONNE'];
			$EMAIL = $_GET['EMAIL'];
			$OBJECTIF = $_GET['OBJECTIF'];
			$geojson = $_GET['geojson'];
			$Localisation = $_GET['Localisation'];
			$Caracterisation = $_GET['Caracterisation'];
			$Observations = $_GET['Observations'];
			
			//DANS UN PREMIER TEMPS ON VA INTEGRER CES DONNES DANS UNE TABLE POUR AVOIR UNE TRACE
			$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.demande_accessibilite(structure, nom_prenom, email, objectif, geom, localisation, caracterisation, observation) VALUES('."'".addslashes($STRUCTURE)."'".', '."'".addslashes($PERSONNE)."'".', '."'".addslashes($EMAIL)."'".', '."'".addslashes($OBJECTIF)."'".', st_transform(ST_SetSRID(ST_GeomFromGeoJSON('."'".$geojson."'".'),4326),2154), '."'".addslashes($Localisation)."'".', '."'".addslashes($Caracterisation)."'".', '."'".addslashes($Observations)."'".')'); 
			
			
			//ENSUITE NOUS ALLONS FAIRE LA REQUETE PAR RAPPORT AU MARE PRESENTE DANS LE POLYGONE EN GROUPANT PAR STRUCTURE ET EMAIL.
			$req = pg_query($bdd, 'select structure."S_ID", structure."STRUCTURE", structure."S_EMAIL", count(*) as nbmare from saisie_observation.localisation
									inner join saisie_observation.structure on localisation."L_STRP" = structure."S_ID"::text
									inner join saisie_observation.demande_accessibilite on st_intersects(localisation.geom, st_transform(demande_accessibilite.geom,4326))
									where demande_accessibilite.geom = st_transform(ST_SetSRID(ST_GeomFromGeoJSON('."'".$geojson."'".'),4326),2154)
									group by structure."S_ID", structure."STRUCTURE", structure."S_EMAIL"'); 
			//POUR CHAQUE STRUCTURE ON VA ENVOYER UN MAIL AVEC LA LISTE DES MARES
			while($donnees = pg_fetch_array($req))
			{
				//REQUETE POUR GENRER FICHIER CSV POUR LISTE DES MARE AVEC ID PRAM ET ID STRUCTURE
				$req_filtre = pg_query($bdd, 'select string_agg("L_ID"::text, '."' / '".'::text ORDER BY "L_ID") as mare, "Nom_Commune" from saisie_observation.localisation
												inner join saisie_observation.structure on localisation."L_STRP" = structure."S_ID"::text
												inner join ign_bd_topo.commune on localisation."L_ADMIN" = commune."Num_INSEE"
												where st_intersects(localisation.geom, (select st_transform(demande_accessibilite.geom,4326) as geom 
																							from saisie_observation.demande_accessibilite
																							where demande_accessibilite.geom = st_transform(ST_SetSRID(ST_GeomFromGeoJSON('."'".$geojson."'".'),4326),2154)))
												and structure."S_ID" = '."'".$donnees['S_ID']."'".'
												GROUP BY "Nom_Commune"');
				$liste_mare = "";
				while($resultat = pg_fetch_array($req_filtre)){			
					$liste_mare .= "Commune : ".$resultat['Nom_Commune']." - Mare : ".$resultat['mare']."<br/><br/>";
				}
				
				$headers ='From: "PRAM API"<'.$maildemandeideaccessibilite.'.com>'."\n";
				$headers .='Reply-To: '.$mailnepasrepondre."\n";
				$headers .='Content-Type: text/html; charset="UTF8"'."\n";
				$headers .='Content-Transfer-Encoding: 8bit';
				$Objet = "[PRAM] Demande d'accessibilite aux données de vos mares";
				
				$Message = "Bonjour,</br><br/>
								 Cette personne : ".$PERSONNE." de la structure : ".$STRUCTURE." à effectuée une demande d'accessibilité à vos données mares sur l'application du PRAM Normandie.</br><br/>
								 Elle souhaite avoir accès aux mares suivantes : </br><br/>
								 ".$liste_mare."
								 Elle souhaite disposer des inforamtions suivantes : </br></br>
								 Localisation des mares : ".$Localisation."<br/><br/>
								 Caractérisation des mares : ".$Caracterisation."<br/><br/>
								 Observations faune/flore des mares : ".$Observations."<br/><br/>
								 Le but et l'objectif de cette demande est : ".$OBJECTIF."</br></br>
								 Nous vous laissons vous rapprocher de cette personne (".$EMAIL.") afin de lui fournir, ou non, les informations qu'elle désire</br></br>
								 Cordialement l'équipe du PRAM";
						
				// mail($donnees['S_EMAIL'], $Objet, $Message, $headers);
				mail($mailadministrateur, $Objet, $Message, $headers);
			}
			//REQUETE POUR VOTRE LE NOMBRE DE MARE CONCERNEES
			$reqcount = pg_query($bdd, 'select count(*) as nbmare from saisie_observation.localisation
									inner join saisie_observation.structure on localisation."L_STRP" = structure."S_ID"::text
									inner join saisie_observation.demande_accessibilite on st_intersects(localisation.geom, st_transform(demande_accessibilite.geom,4326))
									where demande_accessibilite.geom = st_transform(ST_SetSRID(ST_GeomFromGeoJSON('."'".$geojson."'".'),4326),2154)');
			$donneescount = pg_fetch_array($reqcount);
			
			//ON VA ENVOYER UN EMAIL DE CONFIRMATION A LA PERSONNE QUI A FAIT LA DEMANDE
			$headers2 ='From: "PRAM API"<'.$maildemandeideaccessibilite.'.com>'."\n";
			$headers2 .='Reply-To: '.$mailnepasrepondre."\n";
			$headers2 .='Content-Type: text/html; charset="UTF8"'."\n";
			$headers2 .='Content-Transfer-Encoding: 8bit';
			$Objet2 = "[PRAM] Confirmation d'une demande d'accessibilite";
			
			$Message2 = "Bonjour,</br><br/>
								 Vous venez d'effectuer une demande d'accessibilité aux mares.</br></br>
								 Votre demande a bien été prise en compte et envoyé à nos structures partenaires.</br></br>
								 Une receverez une réponse d'ici quelques jours.</br></br>
								 Pour information votre demande concerne ".$donneescount['nbmare']." mare(s).</br></br>
								 Cordialement l'équipe du PRAM";
			mail($EMAIL, $Objet2, $Message2, $headers2);
			
			//ON AFFICHE LE RESULTAT DANS LA DIV
			?>
				<div id="textafficahge">
					<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
					<h3>Demande d'accès aux données mares</h3>
					<div id="resultat_obs">
						<p>
							Un email de confirmation vous a été envoyé. Votre demande a bien été prise en compte.</br>
							Cordialement, l'équipe du PRAM Normandie.
						</p>
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
												<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','')">
											</td>
										</tr>
									</table>
								</fieldset>
							</td>
						</tr>
					</table>
				</div>
			
			<?php
		}
	}
	
?>