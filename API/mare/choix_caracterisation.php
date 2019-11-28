<?php
	// header( 'content-type: text/html; charset=utf-8' );
	// header('Content-type: text/html; charset=iso8859-1');
	include '../../bdd.php';
	$L_ID = $_GET['L_ID'];
	$role = $_GET['role'];
	$id_structure_conectee = $_GET['id_structure_conectee'];
	
	//REQUETE POUR VERIFIER SI IL Y A BIEN UNE CARCTERISATION SUR LA MARE
	$observation_exist = pg_query($bdd, 'SELECT * 
									FROM saisie_observation.caracterisation
									WHERE saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
									AND "C_DATE" <> '."'943920000'".' AND "C_DATE" is not Null');
	$count_observation = pg_num_rows($observation_exist);
	
	//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE EST PROPRIETAIRE DES DONNEES
	$observation_obs_ss_contour = pg_query($bdd, 'SELECT * 
									FROM saisie_observation.caracterisation, saisie_observation.structure
									WHERE caracterisation."C_STRP"::text = structure."S_ID"::text
									AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
									AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
									AND "C_DATE" <> '."'943920000'".' AND "C_DATE" is not Null 
									ORDER BY "C_DATE"');
	
	//REQUETE POUR RECUPERER LES DONNEES DE CARACTERISATION OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
	$observation_util_ac_contour = pg_query($bdd, 'SELECT "ID_CARAC", "C_DATE", "STRUCTURE"
										FROM saisie_observation.caracterisation, saisie_observation.structure, saisie_observation.localisation 
										WHERE caracterisation."L_ID"::text = localisation."L_ID"::text
										AND st_contains(st_transform((SELECT geom FROM saisie_observation.structure WHERE "S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'),4326),localisation.geom) 
										AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
										AND structure."S_ID"::text = caracterisation."C_STRP"::text
										AND "C_DATE" <> '."'943920000'".' AND "C_DATE" is not Null
										ORDER BY "C_DATE"');
	
	//REQUETE POUR RECUPERER LES DONNEES CARACTERISATION OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
	$observation_obs_ac_contour = pg_query($bdd, 'SELECT "ID_CARAC", "C_DATE", "STRUCTURE"
									FROM(
										SELECT "ID_CARAC", "C_DATE", "STRUCTURE"
										FROM saisie_observation.caracterisation, saisie_observation.structure, saisie_observation.localisation 
										WHERE caracterisation."L_ID"::text = localisation."L_ID"::text
										AND st_contains(st_transform((SELECT geom FROM saisie_observation.structure WHERE "S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'),4326),localisation.geom) 
										AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
										AND structure."S_ID"::text = caracterisation."C_STRP"::text
										AND "C_DATE" <> '."'943920000'".' AND "C_DATE" is not Null										
										UNION ALL
										SELECT "ID_CARAC", "C_DATE", "STRUCTURE"
										FROM saisie_observation.caracterisation, saisie_observation.structure
										WHERE caracterisation."C_STRP"::text = structure."S_ID"::text
										AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
										AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
										AND "C_DATE" <> '."'943920000'".' AND "C_DATE" is not Null
										) as obs
									GROUP BY "ID_CARAC", "C_DATE", "STRUCTURE"
									ORDER BY "C_DATE"');
									
	//REQUETE POUR RECUPERER LES DONNEES CARACTERISATION OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
	$observation_admin = pg_query($bdd, 'SELECT *
										FROM saisie_observation.caracterisation, saisie_observation.structure
										WHERE caracterisation."C_STRP"::text = structure."S_ID"::text
										AND saisie_observation.caracterisation."L_ID"='."'".$L_ID."'".'
										AND "C_DATE" <> '."'943920000'".' AND "C_DATE" is not Null
										ORDER BY "C_DATE"');								
	
	//REQUETE POUR REGARDER SI LA STRUCTURE CONNECTER POSSEDE UN CONTOUR
	$req_contour_structure = pg_query($bdd, 'SELECT * FROM saisie_observation.structure
											WHERE "S_ID_SESSION"::text='."'".$id_structure_conectee."'".' 
											AND structure.geom is Not Null');
	$count_contour = pg_num_rows($req_contour_structure);
	
	
?>
<?php if($count_observation >= 1){ ?>
		<?php if($role == "administrateur"){ ?>
					<div id="textafficahge">	
						<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
						<h3>Fiche caractéristique de la mare : <?php echo $L_ID ?></h3>
							<div id="resultat">
								<table border="0" align="left" width="100%" height="20%">
									<tr>
										<td width="25%" align="center" >
											<p>Pour permettre de générer la fiche de caractérisation de la mare merci de sélectionner dans la liste déroulante la date de caractérisation que vous souhaitez éditer :</p>
										</td>
										<td width="20%">
											<select style="width:100%" id="ID_CARAC" onchange="fiche('mare/fiche_mare.php?L_ID=<?php echo $L_ID ?>')">
												<option value="Tous">A Saisir</option>
												<?php
												while($donnees = pg_fetch_array($observation_admin))
												{
												?>
												<option value="<?php echo $donnees['ID_CARAC'];?>"><?php echo "Caractérisation faite le ".date('d/m/Y', $donnees['C_DATE'])." par ".$donnees['STRUCTURE'];?></option>
												<?php
												}
												?>
											</select>			
										</td>
									</tr>
								</table>
							</div>
						</div>
		<?php }elseif($role == "observateur"){ ?>
			<?php if($count_contour >= 1){?>
						<?php if(pg_num_rows($observation_obs_ac_contour) == 0){ ?>
							<div id="textafficahge">
							<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
							<h3>Fiche caractéristique de la mare : <?php echo $L_ID ?></h3>
								<div id="resultat">			
									<p>Une caractérisation de la mare est disponible, cependant les droits qui vous ont été affectés nous vous permettent pas d'accéder aux données. 
										Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a></p>
								</div>
							</div>
						<?php }else{ ?>
							<div id="textafficahge">
							<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>							
							<h3>Fiche caractéristique de la mare : <?php echo $L_ID ?></h3>
								<div id="resultat">
									<table border="0" align="left" width="100%" height="20%">
										<tr>
											<td width="25%" align="center" >
												<p>Pour permettre de générer la fiche de caractérisation de la mare merci de sélectionner dans la liste déroulante la date de caractérisation que vous souhaitez éditer :</p>
											</td>
											<td width="20%">
												<select style="width:100%" id="ID_CARAC" onchange="fiche('mare/fiche_mare.php?L_ID=<?php echo $L_ID ?>')">
													<option value="Tous">A Saisir</option>
													<?php
													while($donnees = pg_fetch_array($observation_obs_ac_contour))
													{
													?>
													<option value="<?php echo $donnees['ID_CARAC'];?>"><?php echo "Caractérisation faite le ".date('d/m/Y', $donnees['C_DATE'])." par ".$donnees['STRUCTURE'];?></option>
													<?php
													}
													?>
												</select>			
											</td>
										</tr>
									</table>
								</div>
							</div>
						<?php } ?>
			<?php }else{ ?>
						<?php if(pg_num_rows($observation_obs_ss_contour) == 0){ ?>
							<div id="textafficahge">
							<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
							<h3>Fiche caractéristique de la mare : <?php echo $L_ID ?></h3>
								<div id="resultat">			
									<p>Une caractérisation de la mare est disponible, cependant les droits qui vous ont étéffectés nous vous permettent pas d'accéder aux données. 
										Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a></p>
								</div>
							</div>
						<?php }else{ ?>
							<div id="textafficahge">
							<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
							<h3>Fiche caractéristique de la mare : <?php echo $L_ID ?></h3>
								<div id="resultat">
									<table border="0" align="left" width="100%" height="20%">
										<tr>
											<td width="25%" align="center" >
												<p>Pour permettre de générer la fiche de caractérisation de la mare merci de sélectionner dans la liste déroulante la date de caractérisation que vous souhaitez éditer :</p>
											</td>
											<td width="20%">
												<select style="width:100%" id="ID_CARAC" onchange="fiche('mare/fiche_mare.php?L_ID=<?php echo $L_ID ?>')">
													<option value="Tous">A Saisir</option>
													<?php
													while($donnees = pg_fetch_array($observation_obs_ss_contour))
													{
													?>
													<option value="<?php echo $donnees['ID_CARAC'];?>"><?php echo "Caractérisation faite le ".date('d/m/Y', $donnees['C_DATE'])." par ".$donnees['STRUCTURE'];?></option>
													<?php
													}
													?>
												</select>			
											</td>
										</tr>
									</table>
								</div>
							</div>
						<?php } ?>
			<?php } ?>
		<?php }elseif($role == "utilisateur"){ ?>
					<?php if(pg_num_rows($observation_util_ac_contour) == 0){ ?>
						<div id="textafficahge">
						<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
						<h3>Fiche caractéristique de la mare : <?php echo $L_ID ?></h3>
							<div id="resultat">			
								<p>Une caractérisation de la mare est disponible, cependant les droits qui vous ont étéffectés nous vous permettent pas d'accéder aux données. 
									Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a></p>
							</div>
						</div>
					<?php }else{ ?>
						<div id="textafficahge">
						<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>						
						<h3>Fiche caractéristique de la mare : <?php echo $L_ID ?></h3>
							<div id="resultat">
								<table border="0" align="left" width="100%" height="20%">
									<tr>
										<td width="25%" align="center" >
											<p>Pour permettre de générer la fiche de caractérisation de la mare merci de sélectionner dans la liste déroulante la date de caractérisation que vous souhaitez éditer :</p>
										</td>
										<td width="20%">
											<select style="width:100%" id="ID_CARAC" onchange="fiche('mare/fiche_mare.php?L_ID=<?php echo $L_ID ?>')">
												<option value="Tous">A Saisir</option>
												<?php
												while($donnees = pg_fetch_array($observation_util_ac_contour))
												{
												?>
												<option value="<?php echo $donnees['ID_CARAC'];?>"><?php echo "Caractérisation faite le ".date('d/m/Y', $donnees['C_DATE'])." par ".$donnees['STRUCTURE'];?></option>
												<?php
												}
												?>
											</select>			
										</td>
									</tr>
								</table>
							</div>
						</div>
					<?php } ?>
		<?php } ?>
<?php }else{ ?>
		<div id="textafficahge">
		<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
		<h3>Fiche caractéristique de la mare : <?php echo $L_ID ?></h3>
			<div id="resultat">			
				<p>Cette mare ne posséde pas de caractérisation.</p>
			</div>
		</div>
<?php } ?>
<div id="piedaffichage">
	<table align="center" width="100%" border="0">
		<tr>
			<td>
				<!--<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>
						</tr>
					</table>
				</fieldset>-->
			</td>
		</tr>
	</table>
</div>





