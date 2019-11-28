<?php
	date_default_timezone_set('Europe/Paris');
	ini_set("display_errors",1);
	include '../../bdd.php';
	$L_ID = $_GET['L_ID'];
	$ID_CARAC = $_GET['ID_CARAC'];
	$Session = $_GET['Session'];
	$role = $_GET['role'];
	$id_structure_conectee = $_GET['id_structure_conectee'];
	
	//REQUETE POUR ALLER CHERCHER L'IDENDIFIANT DE LA STRUCTURE
	$idstructure = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.structure
										WHERE saisie_observation.structure."S_ID_SESSION"='."'".$id_structure_conectee."'".''); 
	$donnees_idstructure = pg_fetch_array($idstructure);
	
	//REQUETE POUR COMPTER LE NOM DE CARACTERISATION MAIS IL SERA TOUJOURS EGALE A UN CAR ON FILTRE AVANT
	$carac_exist = pg_query($bdd, 'SELECT *
										FROM saisie_observation.caracterisation
										WHERE saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
										AND saisie_observation.caracterisation."ID_CARAC"='."'".$ID_CARAC."'".'');
	$count_carac = pg_num_rows($carac_exist);
	
	//REQUETE POUR REGARDER SI LA STRUCTURE CONNECTER POSSEDE UN CONTOUR
	$req_contour_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure
											WHERE "S_ID_SESSION"::text='."'".$id_structure_conectee."'".' 
											AND structure.geom is Not Null');
	$count_contour = pg_num_rows($req_contour_structure);
	
	if($role == "administrateur"){
		//REQUETE POUR RECUPERER LES DONNEES CARACTERISATION OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
		$mare_caracterisation = pg_query($bdd, 'SELECT *
											FROM saisie_observation.caracterisation
											WHERE saisie_observation.caracterisation."ID_CARAC"='."'".$ID_CARAC."'".'
											ORDER BY "C_DATE"');
	}elseif($role == "observateur"){
		if($count_contour >= 1){
			//REQUETE POUR RECUPERER LES DONNEES CARACTERISATION OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
			$mare_caracterisation = pg_query($bdd, 'SELECT obs.*
											FROM(
												SELECT caracterisation.*, structure.*
												FROM saisie_observation.caracterisation, saisie_observation.localisation, saisie_observation.structure
												WHERE caracterisation."L_ID"::text = localisation."L_ID"::text
												AND st_contains(st_transform((select geom from saisie_observation.structure where structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'),4326),(select geom from saisie_observation.localisation where localisation."L_ID"::text = '."'".$L_ID."'".')) 
												AND caracterisation."C_STRP"::text = structure."S_ID"::text
												AND saisie_observation.caracterisation."ID_CARAC" = '."'".$ID_CARAC."'".'
												UNION ALL
												SELECT caracterisation.*, structure.*
												FROM saisie_observation.caracterisation, saisie_observation.structure
												WHERE caracterisation."C_STRP"::text = structure."S_ID"::text
												AND saisie_observation.caracterisation."ID_CARAC"='."'".$ID_CARAC."'".'
												AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
												) as obs
											');
		}else{
			//REQUETE POUR RECUPERER LES DONNEES DE CARACTERISATION OU LA STRUCTURE CONNECTEE EST PROPRIETAIRE DES DONNEES 
			$mare_caracterisation = pg_query($bdd, 'SELECT * 
											FROM saisie_observation.caracterisation, saisie_observation.structure
											WHERE caracterisation."C_STRP"::text = structure."S_ID"::text
											AND saisie_observation.caracterisation."ID_CARAC"='."'".$ID_CARAC."'".'
											AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
											ORDER BY "C_DATE"');
		}	
	}elseif($role == "utilisateur"){
		//REQUETE POUR RECUPERER LES DONNEES DE CARACTERISATION OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
		$mare_caracterisation = pg_query($bdd, 'SELECT caracterisation.*, structure.*
												FROM saisie_observation.caracterisation, saisie_observation.localisation, saisie_observation.structure
												WHERE caracterisation."L_ID"::text = localisation."L_ID"::text
												AND st_contains(st_transform((select geom from saisie_observation.structure where structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'),4326),(select geom from saisie_observation.localisation where localisation."L_ID"::text = '."'".$L_ID."'".')) 
												AND caracterisation."C_STRP"::text = structure."S_ID"::text
												AND saisie_observation.caracterisation."ID_CARAC" = '."'".$ID_CARAC."'".'
										ORDER BY "C_DATE"');
	}	
?>
<div id="textafficahge">
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<h3>Description de la caractérisation de la mare : <?php echo $L_ID ?></h3>
	<div id="resultat_carac">
		<table border="0">
			<tr>
				<td width="15%">
					<table class="description" border="0" width="100%">
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>DONNEES GENERALES</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Date de caractérisation :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".date('d/m/Y', $donnees_carac['C_DATE'])."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Structure :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$strucutre = pg_query($bdd, 'SELECT * 
																	FROM saisie_observation.structure
																	WHERE structure."S_ID"='."'".$donnees_carac['C_STRP']."'".''); 
									$datastrucutre = pg_fetch_array($strucutre);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datastrucutre['STRUCTURE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Observateur :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$obs = pg_query($bdd, 'SELECT * 
																	FROM saisie_observation.observateur
																	WHERE observateur."ID"='."'".$donnees_carac['C_OBSV']."'".''); 
									$dataobs = pg_fetch_array($obs);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataobs['OBS_NOM_PRENOM']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Type de mare :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$type = pg_query($bdd, 'SELECT * 
																FROM menu_deroulant.c_type
																WHERE menu_deroulant.c_type."ID"='."'".$donnees_carac['C_TYPE']."'".''); 
									$datatype = pg_fetch_array($type);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datatype['TYPE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Groupe faunistique observé :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$gpfaune = pg_query($bdd, 'SELECT menu_deroulant.c_faune."FAUNE", saisie_observation.caracterisation_faune."FAUNE_AUTRE"
														FROM saisie_observation.caracterisation_faune, menu_deroulant.c_faune
														WHERE saisie_observation.caracterisation_faune."FAUNE" = menu_deroulant.c_faune."ID"
														AND saisie_observation.caracterisation_faune."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$textfaune = "";
									$countcarac = pg_num_rows($gpfaune);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($datagpfaune = pg_fetch_array($gpfaune)){
										if($datagpfaune['FAUNE'] == "Autre"){
											$textfaune .= $datagpfaune['FAUNE']." (".$datagpfaune['FAUNE_AUTRE'].") ; ";
										}else{
											$textfaune .= $datagpfaune['FAUNE']." ; ";
										} 
										if($j == $countcarac){echo $textfaune;}
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Végétation aquatique :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$vegetation = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_veget
														WHERE menu_deroulant.c_veget."ID"='."'".$donnees_carac['C_VEGET']."'".''); 
									$datavegetation = pg_fetch_array($vegetation);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datavegetation['VEGET']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Stade d'évolution :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$evolution = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_evolution
														WHERE menu_deroulant.c_evolution."ID"='."'".$donnees_carac['C_EVOLUTION']."'".''); 
									$dataevolution = pg_fetch_array($evolution);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataevolution['EVOLUTION']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>USAGES</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Usage principal :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$usage = pg_query($bdd, 'SELECT menu_deroulant.c_usage."USAGE"
														FROM saisie_observation.caracterisation_usage, menu_deroulant.c_usage
														WHERE saisie_observation.caracterisation_usage."C_USAGE" = menu_deroulant.c_usage."ID"
														AND saisie_observation.caracterisation_usage."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$textusage = "";
									$countcarac = pg_num_rows($usage);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($datausage = pg_fetch_array($usage)){
										$textusage .= $datausage['USAGE']." ; ";
										if($j == $countcarac){echo $textusage;};
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Mare équipée d'une pompe à nez :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$abreuv = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_abreuv
														WHERE menu_deroulant.c_abreuv."ID"='."'".$donnees_carac['C_ABREUV']."'".''); 
									$dataabreuv = pg_fetch_array($abreuv);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataabreuv['ABREUV']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Présence de déchets :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$dechet = pg_query($bdd, 'SELECT menu_deroulant.c_dechets."DECHETS"
														FROM saisie_observation.caracterisation_dechets, menu_deroulant.c_dechets
														WHERE saisie_observation.caracterisation_dechets."DECHETS" = menu_deroulant.c_dechets."ID"
														AND saisie_observation.caracterisation_dechets."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$textdechet = "";
									$countcarac = pg_num_rows($dechet);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($datadechet = pg_fetch_array($dechet)){
										$textdechet .= $datadechet['DECHETS']." ; ";
										if($j == $countcarac){echo $textdechet;};
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>SITUATION DE LA MARE</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Topographie :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$topo = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_topo
														WHERE menu_deroulant.c_topo."ID"='."'".$donnees_carac['C_TOPO']."'".''); 
									$datatopo = pg_fetch_array($topo);
									if($datatopo['TOPO'] == "autre"){
										echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datatopo['TOPO']." (".$donnees_carac['C_TOPO_AUTRE'].")"."</td>";
									}else{
										echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datatopo['TOPO']."</td>";
									}
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Contexte de la mare :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$context = pg_query($bdd, 'SELECT menu_deroulant.c_context."CONTEXT"
														FROM saisie_observation.caracterisation_context, menu_deroulant.c_context
														WHERE saisie_observation.caracterisation_context."CONTEXT" = menu_deroulant.c_context."ID"
														AND saisie_observation.caracterisation_context."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$textcontext = "";
									$countcarac = pg_num_rows($context);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($datacontext = pg_fetch_array($context)){
										$textcontext .= $datacontext['CONTEXT']." ; ";
										if($j == $countcarac){echo $textcontext;}
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Petit patrimoine associé :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$patrimoine = pg_query($bdd, 'SELECT menu_deroulant.c_patrimoine."PATRIMOINE"
														FROM saisie_observation.caracterisation_patrimoine, menu_deroulant.c_patrimoine
														WHERE saisie_observation.caracterisation_patrimoine."PATRIMOINE" = menu_deroulant.c_patrimoine."ID"
														AND saisie_observation.caracterisation_patrimoine."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$textpatrimoine = "";
									$countcarac = pg_num_rows($patrimoine);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($datacontext = pg_fetch_array($patrimoine)){
										$textpatrimoine .= $datacontext['PATRIMOINE']." ; ";
										if($j == $countcarac){echo $textpatrimoine;}
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Mare clôturée :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$cloture = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_cloture
														WHERE menu_deroulant.c_cloture."ID"='."'".$donnees_carac['C_CLOTURE']."'".''); 
									$datacloture = pg_fetch_array($cloture);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datacloture['CLOTURE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Présence d'une haie en contact avec la mare:</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$haie = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_haie
														WHERE menu_deroulant.c_haie."ID"='."'".$donnees_carac['C_HAIE']."'".''); 
									$datahaie = pg_fetch_array($haie);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datahaie['HAIE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>CARACTERISTIQUES ABIOTIQUE DE LA MARE</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Forme de la mare  :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$forme = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_form
														WHERE menu_deroulant.c_form."ID"='."'".$donnees_carac['C_FORM']."'".''); 
									$dataforme = pg_fetch_array($forme);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataforme['FORM']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Longueur :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_LONG']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Largeur :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_LARG']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Hauteur d'eau maximum observée :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$prof = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_prof
														WHERE menu_deroulant.c_prof."ID"='."'".$donnees_carac['C_PROF']."'".''); 
									$dataprof = pg_fetch_array($prof);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataprof['PROF']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Nature du fond  :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$natfond = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_natfond
														WHERE menu_deroulant.c_natfond."ID"='."'".$donnees_carac['C_NATFOND']."'".''); 
									$datanatfond = pg_fetch_array($natfond);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datanatfond['NATFOND']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Pente des berges :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$berge = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_berges
														WHERE menu_deroulant.c_berges."ID"='."'".$donnees_carac['C_BERGES']."'".''); 
									$databerge = pg_fetch_array($berge);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$databerge['BERGES']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Bourrelet de curage :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$bourrelet = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_bourrelet
														WHERE menu_deroulant.c_bourrelet."ID"='."'".$donnees_carac['C_BOURRELET']."'".''); 
									$databourrelet = pg_fetch_array($bourrelet);
									if($databourrelet['BOURRELET'] == "Oui"){
										echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$databourrelet['BOURRELET']." (".$donnees_carac['C_BOURRELET_POURCENTAGE'].")"."</td>";
									}else{
										echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$databourrelet['BOURRELET']."</td>";
									}
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Surpiétinement des abords :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$poetinement = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_pietinement
														WHERE menu_deroulant.c_pietinement."ID"='."'".$donnees_carac['C_PIETINEMENT']."'".''); 
									$datapietinement = pg_fetch_array($poetinement);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datapietinement['PIETINEMENT']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>HYDROLOGIE</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Régime hydrologique  :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$regimehydro = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_hydrologie
														WHERE menu_deroulant.c_hydrologie."ID"='."'".$donnees_carac['C_HYDROLOGIE']."'".''); 
									$dataregimehydro = pg_fetch_array($regimehydro);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataregimehydro['HYDROLOGIE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Liaison(s) avec le réseau hydrographique superficiel :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$liaison = pg_query($bdd, 'SELECT menu_deroulant.c_liaison."LIAISON", saisie_observation.caracterisation_liaison."LIAISON_AUTRE"
														FROM saisie_observation.caracterisation_liaison, menu_deroulant.c_liaison
														WHERE saisie_observation.caracterisation_liaison."LIAISON" = menu_deroulant.c_liaison."ID"
														AND saisie_observation.caracterisation_liaison."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$textliaison = "";
									$countcarac = pg_num_rows($liaison);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($dataliaison = pg_fetch_array($liaison)){
										if($dataliaison['LIAISON'] == "autre"){
											$textliaison .= $dataliaison['LIAISON']." (".$dataliaison['LIAISON_AUTRE'].") ; ";
										}else{
											$textliaison .= $dataliaison['LIAISON']." ; ";
										}
										if($j == $countcarac){echo $textliaison;}
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Alimentation spécifique :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$alim = pg_query($bdd, 'SELECT menu_deroulant.c_alimentation."ALIMENTATION", saisie_observation.caracterisation_alimentation."ALIMENTATION_AUTRE"
														FROM saisie_observation.caracterisation_alimentation, menu_deroulant.c_alimentation
														WHERE saisie_observation.caracterisation_alimentation."ALIMENTATION" = menu_deroulant.c_alimentation."ID"
														AND saisie_observation.caracterisation_alimentation."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$textalim = "";
									$countcarac = pg_num_rows($alim);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($dataalim = pg_fetch_array($alim)){
										if($dataalim['ALIMENTATION'] == "autre"){
											$textalim .= $dataalim['ALIMENTATION']." (".$dataalim['ALIMENTATION_AUTRE'].") ; ";
										}else{
											$textalim .= $dataalim['ALIMENTATION']." ; ";
										}
										if($j == $countcarac){echo $textalim;}
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Turbidité de l'eau :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$turbidite = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_turbidite
														WHERE menu_deroulant.c_turbidite."ID"='."'".$donnees_carac['C_TURBIDITE']."'".''); 
									$dataturbidite = pg_fetch_array($turbidite);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataturbidite['TURBIDITE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Couleur spécifique de l'eau :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$couleureau = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_couleur
														WHERE menu_deroulant.c_couleur."ID"='."'".$donnees_carac['C_COULEUR']."'".''); 
									$datacouleureau = pg_fetch_array($couleureau);
									if($datacouleureau['COULEUR'] == "Oui"){
										echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datacouleureau['COULEUR']." (".$donnees_carac['C_COULEUR_PRECISION'].")"."</td>";
									}else{
										echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datacouleureau['COULEUR']."</td>";
									}
									
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Zone tampon :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$tampon = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_tampon
														WHERE menu_deroulant.c_tampon."ID"='."'".$donnees_carac['C_TAMPON']."'".''); 
									$datatampon = pg_fetch_array($tampon);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$datatampon['TAMPON']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Présence d'éxutoire :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$exutoire = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_exutoire
														WHERE menu_deroulant.c_exutoire."ID"='."'".$donnees_carac['C_EXUTOIRE']."'".''); 
									$dataexutoire = pg_fetch_array($exutoire);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataexutoire['EXUTOIRE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>ECOLOGIE</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Recouvrement total :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_RECOU_TOTAL']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Recouvrement Hélophytes :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_RECOU_HELOPHYTE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Recouvrement Hydrophytes enracinées :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_RECOU_HYDROPHYTE_E']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Recouvrement Hydrophytes non enracinés :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_RECOU_HYDROPHYTE_NE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Recouvrement algues :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_RECOU_ALGUE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Recouvrement eau libre :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_RECOU_EAU_LIBRE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Recouvrement non végétalisé :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_RECOU_NON_VEGET']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Embroussaillement :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$embrous = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_embrous
														WHERE menu_deroulant.c_embrous."ID"='."'".$donnees_carac['C_EMBROUS']."'".''); 
									$dataembrous = pg_fetch_array($embrous);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataembrous['EMBROUS']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Ombrage sur la surface de la mare par les ligneux :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$ombre = pg_query($bdd, 'SELECT * 
														FROM menu_deroulant.c_ombrage
														WHERE menu_deroulant.c_ombrage."ID"='."'".$donnees_carac['C_OMBRAGE']."'".''); 
									$dataombre = pg_fetch_array($ombre);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$dataombre['OMBRAGE']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Espéce animale exotique envahissante :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$eaee = pg_query($bdd, 'SELECT menu_deroulant.c_eaee."TAXON", menu_deroulant.c_eaee."NOM_VERNACULAIRE"
														FROM saisie_observation.caracterisation_eaee, menu_deroulant.c_eaee
														WHERE saisie_observation.caracterisation_eaee."EAEE" = menu_deroulant.c_eaee."ID"
														AND saisie_observation.caracterisation_eaee."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$texteaee = "";
									$countcarac = pg_num_rows($eaee);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($dataeaee = pg_fetch_array($eaee)){
										$texteaee .= $dataeaee['TAXON']." ; ";
										if($j == $countcarac){echo $texteaee;}
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Espéce végétale exotique envahissante :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$evee = pg_query($bdd, 'SELECT menu_deroulant.c_evee."TAXON", menu_deroulant.c_evee."NOM_VERNACULAIRE", menu_deroulant.c_evee_pourcent."POURCENTAGE"
														FROM saisie_observation.caracterisation_evee, menu_deroulant.c_evee, menu_deroulant.c_evee_pourcent
														WHERE saisie_observation.caracterisation_evee."EVEE" = menu_deroulant.c_evee."ID"
														AND saisie_observation.caracterisation_evee."EVEE_POURCENT" = menu_deroulant.c_evee_pourcent."ID"
														AND saisie_observation.caracterisation_evee."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$textevee = "";
									$countcarac = pg_num_rows($evee);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($dataevee = pg_fetch_array($evee)){
										$textevee .= $dataevee['TAXON']." (".$dataevee['POURCENTAGE'].") ; ";
										if($j == $countcarac){echo $textevee;}
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>INTERVENTION</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Travaux de restauration :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									$travaux = pg_query($bdd, 'SELECT menu_deroulant.c_travaux."TRAVAUX", saisie_observation.caracterisation_travaux."TRAVAUX_AUTRE"
														FROM saisie_observation.caracterisation_travaux, menu_deroulant.c_travaux
														WHERE saisie_observation.caracterisation_travaux."TRAVAUX" = menu_deroulant.c_travaux."ID"
														AND saisie_observation.caracterisation_travaux."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									$texttravaux = "";
									$countcarac = pg_num_rows($travaux);
									$j = 1;
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
									while($datatravaux = pg_fetch_array($travaux)){
										if($datatravaux['TRAVAUX'] == "autres"){
											$texttravaux .= $datatravaux['TRAVAUX']." (".$datatravaux['TRAVAUX_AUTRE'].") ; ";
										}else{
											$texttravaux .= $datatravaux['TRAVAUX']." ; ";
										}
										if($j == $countcarac){echo $texttravaux;}
										$j++;
									}
									echo "</td>";
									$i++;
								}
							?>
							
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>COMMENTAIRE</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Commentaire :</th>
							<?php 
								$i = 0;
								while($i < $count_carac){
									$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
									echo "<td width='".(75/$count_carac)."%' class='ligne_v'>".$donnees_carac['C_COMT']."</td>";
									$i++;
								}
							?>
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>PHOTO</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Photo de caractérisation  :</th>
							<?php 
							$i = 0;
							while($i < $count_carac){
								$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
								echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
								//REQUETE AVANT POUR VOIR SI IL EXISTE UNE PHOTO
								$mare_photo_carac_exist = pg_query($bdd, 'SELECT * 
																FROM saisie_observation.caracterisation_photo
																WHERE saisie_observation.caracterisation_photo."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
								$count_photo_carac = pg_num_rows($mare_photo_carac_exist);
								if($count_photo_carac >= 1){
									//REQUETE SQL POUR SAVOIR SI PHOTO OU PAS DE CARACTERISATION DE LA MARE
									$mare_photo_carac = pg_query($bdd, 'SELECT * 
																FROM saisie_observation.caracterisation_photo
																WHERE saisie_observation.caracterisation_photo."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									
									while($donnees_photo_carac = pg_fetch_array($mare_photo_carac))
										echo "<img src="."PRAM/".$donnees_photo_carac['LIEN']." width='200px'>";
								}else{
									echo "<img src='../img/photo/no_picture.jpg' width='200px''>";	
								}
							echo "</td>";	
							$i++;
							}
								
						?>
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>SCHEMA</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Schéma de caractérisation :</th>
							<?php 
							$i = 0;
							while($i < $count_carac){
								$donnees_carac = pg_fetch_array($mare_caracterisation,$i);
								echo "<td width='".(75/$count_carac)."%' class='ligne_v'>";
								//REQUETE AVANT POUR VOIR SI IL EXISTE UNE PHOTO
								$mare_photo_carac_exist = pg_query($bdd, 'SELECT * 
																FROM saisie_observation.caracterisation_schema
																WHERE saisie_observation.caracterisation_schema."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
								$count_photo_carac = pg_num_rows($mare_photo_carac_exist);
								if($count_photo_carac >= 1){
									//REQUETE SQL POUR SAVOIR SI PHOTO OU PAS DE CARACTERISATION DE LA MARE
									$mare_photo_carac = pg_query($bdd, 'SELECT * 
																FROM saisie_observation.caracterisation_schema
																WHERE saisie_observation.caracterisation_schema."ID_CARAC"='."'".$donnees_carac['ID_CARAC']."'".''); 
									
									while($donnees_photo_carac = pg_fetch_array($mare_photo_carac))
										echo "<img src="."PRAM/".$donnees_photo_carac['LIEN']." width='200px'>";
								}else{
									echo "<img src='../img/photo/no_picture.jpg' width='200px''>";	
								}
							echo "</td>";	
							$i++;
							}
								
						?>
						</tr>
						<tr align="center" height="50">
							<td colspan="<?php echo $count_carac + 1?>" width="100%">
								<hr><legend><b>ACTION</b></legend><hr>
							</td>
						</tr>
						<tr align="center" height="40">
							<th width="25%" class="ligne_v">Action :</th>
							<?php 
							$i = 0;
							while($i < $count_carac){
								$donnees_carac = pg_fetch_array($mare_caracterisation,$i); ?>
									<td width="<?php echo (75/$count_carac) ?>" class='ligne_v' align="center">
										<?php if($role == 'administrateur' OR ($donnees_idstructure['S_ID'] == $donnees_carac['C_STRP'])){ ?>
											<img src="../img/edit.png" alt="Modifier" title="Modifier" width="30" onClick="load_page('mare/caracterisation.php?ID_CARAC=<?php echo $donnees_carac['ID_CARAC'] ?>&L_ID=<?php echo $donnees_carac['L_ID'] ?>', 'affichage', 'affichageEditCaracMare')">
											<img src="../img/sup.png" alt="Modifier" title="Modifier" width="30" onClick="SupprimerCaracterisation('mare/supprime_carac.php?ID_CARAC=<?php echo $donnees_carac['ID_CARAC'] ?>&L_ID=<?php echo $donnees_carac['L_ID'] ?>&type=lien&Session=<?php echo $Session ?>&role=<?php echo $role ?>&id_structure_conectee=<?php echo $id_structure_conectee ?>', '');actualiseMareAfterMod()">
										<?php }else{ ?>
													<p>
													Cette caractérisation a été renseignée par une autre structure. Vous ne pouvez pas la modifier.
													Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a>
													</p>
										<?php } ?>
									</td>
								<?php 
								$i++;
							}	
							?>
						</tr>
					</table>
				</td>
			</tr>
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
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</div>
	
	
	
	
