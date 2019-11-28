<?php
		date_default_timezone_set('Europe/Paris');
		// header( 'content-type: text/html; charset=utf-8' );
		// header('Content-type: text/html; charset=iso8859-1');
		ini_set("display_errors",0);
		include '../../bdd.php';
		$L_ID = $_GET['L_ID'];
		$Session = $_GET['Session'];
		$role = $_GET['role'];
		$id_structure_conectee = $_GET['id_structure_conectee'];
		
		//REQUETE POUR VERIFIER SI IL Y A BIEN DES OBSERVATIONS FAUNE FLORE
		$observation_exist = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.observation
										WHERE saisie_observation.observation."L_ID"='."'".$L_ID."'".'');
		$count_observation = pg_num_rows($observation_exist);
		
		//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE EST PROPRIETAIRE DES DONNEES
		$observation_obs_ss_contour = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.observation, saisie_observation.structure, menu_deroulant.o_sacq
										WHERE observation."O_STRP"::text = structure."S_ID"::text
										AND observation."O_SACQ"::text = o_sacq."ID"::text
										AND saisie_observation.observation."L_ID"='."'".$L_ID."'".'
										AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'');
		
		//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
		$observation_util_ac_contour = pg_query($bdd, 'SELECT "O_DATE", "O_NLAT", "O_NBRE", "O_NBRT", "SACQ", "O_COMT"
										FROM(
											SELECT "O_DATE", "O_NLAT", "O_NBRE", "O_NBRT", "SACQ", "O_COMT"
											FROM saisie_observation.observation, saisie_observation.structure, saisie_observation.localisation, menu_deroulant.o_sacq 
											WHERE observation."L_ID"::text = localisation."L_ID"::text
											AND observation."O_SACQ"::text = o_sacq."ID"::text
											AND st_contains(st_transform(structure.geom,4326),localisation.geom) 
											AND saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
											AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".' 
											UNION ALL
											SELECT "O_DATE", "O_NLAT", "O_NBRE", "O_NBRT", "SACQ", "O_COMT" 
											FROM saisie_observation.observation, saisie_observation.structure, menu_deroulant.o_sacq
											WHERE observation."O_STRP"::text = structure."S_ID"::text
											AND observation."O_SACQ"::text = o_sacq."ID"::text
											AND saisie_observation.observation."L_ID"='."'".$L_ID."'".'
											AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
											) as obs
										GROUP BY "O_DATE", "O_NLAT", "O_NBRE", "O_NBRT", "SACQ", "O_COMT"');
										
		//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
		$observation_obs_ac_contour = pg_query($bdd, 'SELECT "O_DATE", "O_NLAT", "O_NBRE", "O_NBRT", "SACQ", "O_COMT"
										FROM(
											SELECT "O_DATE", "O_NLAT", "O_NBRE", "O_NBRT", "SACQ", "O_COMT"
											FROM saisie_observation.observation, saisie_observation.structure, saisie_observation.localisation, menu_deroulant.o_sacq
											WHERE observation."L_ID"::text = localisation."L_ID"::text
											AND observation."O_SACQ"::text = o_sacq."ID"::text
											AND st_contains(st_transform(structure.geom,4326),localisation.geom) 
											AND saisie_observation.localisation."L_ID"='."'".$L_ID."'".'
											AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".' 
											UNION ALL
											SELECT "O_DATE", "O_NLAT", "O_NBRE", "O_NBRT", "SACQ", "O_COMT" 
											FROM saisie_observation.observation, saisie_observation.structure, menu_deroulant.o_sacq
											WHERE observation."O_STRP"::text = structure."S_ID"::text
											AND observation."O_SACQ"::text = o_sacq."ID"::text
											AND saisie_observation.observation."L_ID"='."'".$L_ID."'".'
											AND structure."S_ID_SESSION"::text = '."'".$id_structure_conectee."'".'
											) as obs
										GROUP BY "O_DATE", "O_NLAT", "O_NBRE", "O_NBRT", "SACQ", "O_COMT"');
		
		//REQUETE POUR RECUPERER LES DONNEES FAUNE/FLORE OU LA STRUCTURE CONNECTEE POSSEDE LA MARE DANS SON CONTOUR
		$observation_admin = pg_query($bdd, 'SELECT *
											FROM saisie_observation.observation
											WHERE saisie_observation.observation."L_ID"='."'".$L_ID."'".'');
		
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
		<h3>Liste des espèces faune / flore observées</h3>
			<table align="center"  width="100%" border="0">
				<tr class="entete">
					<th width="8%">Date</th>
					<th width="22%">Taxon</th>
					<th width="10%">Nombre</th>
					<th width="15%">Type de dénombrement</th>
					<th width="25%">Technique acquisition</th>
					<th width="20%">Commentaire</th>
				</tr>
			</table>	
			<div id="resultat_obs">			
				<table width="100%" border="0">
					<?php
					$i=1;
					while($donnees = pg_fetch_array($observation_admin))
					{
					$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
					?>
						<tr align="center" class="<?php echo $style ?>" height="25"> 
							<td style="width:8%;">
								<?php echo date('d/m/Y', $donnees['O_DATE']) ?>
							</td>
							<td style="width:22%;">
								<?php echo $donnees['O_NLAT'] ?>
							</td>
							<td style="width:10%;">
								<?php echo $donnees['O_NBRE'] ?>
							</td>
							<td style="width:15%;">
								<?php echo $donnees['O_NBRT'] ?>
							</td>
							<td style="width:25%;">
								<?php echo $donnees['SACQ'] ?>
							</td>
							<td style="width:20%;">
								<?php echo $donnees['O_COMT'] ?>
							</td>
						</tr>
					<?php
					$i++;
					}
					?>
				</table>
			</div>
		</div>
	<?php }elseif($role == "observateur"){?>
			<?php if($count_contour >= 1){?>
					<?php if(pg_num_rows($observation_obs_ac_contour) == 0){ ?>
						<div id="textafficahge">
						<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
						<h3>Liste des espèces faune / flore observées</h3>
							<div id="resultat">			
								<p>Des observations faune/flore sont disponibles, cependant les droits qui vous ont été affectés nous vous permettent pas d'accéder aux données. 
									Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a></p>
							</div>
						</div>
					<?php }else{ ?>
						<div id="textafficahge">
						<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
						<h3>Liste des espèces faune / flore observées</h3>
							<table align="center"  width="100%" border="0">
								<tr class="entete">
									<th width="8%">Date</th>
									<th width="22%">Taxon</th>
									<th width="10%">Nombre</th>
									<th width="15%">Type de dénombrement</th>
									<th width="25%">Technique acquisition</th>
									<th width="20%">Commentaire</th>
								</tr>
							</table>	
							<div id="resultat">			
								<table width="100%" border="0">
									<?php
									$i=1;
									while($donnees = pg_fetch_array($observation_obs_ac_contour))
									{
									$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
									?>
										<tr align="center" class="<?php echo $style ?>" height="25"> 
											<td style="width:8%;">
												<?php echo date('d/m/Y', $donnees['O_DATE']) ?>
											</td>
											<td style="width:22%;">
												<?php echo $donnees['O_NLAT'] ?>
											</td>
											<td style="width:10%;">
												<?php echo $donnees['O_NBRE'] ?>
											</td>
											<td style="width:15%;">
												<?php echo $donnees['O_NBRT'] ?>
											</td>
											<td style="width:25%;">
												<?php echo $donnees['SACQ'] ?>
											</td>
											<td style="width:20%;">
												<?php echo $donnees['O_COMT'] ?>
											</td>
										</tr>
									<?php
									$i++;
									}
									?>
								</table>
							</div>
						</div>
					<?php } ?>
			<?php }else{ ?>
					<?php if(pg_num_rows($observation_obs_ac_contour) == 0){ ?>
						<div id="textafficahge">
						<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
						<h3>Liste des espèces faune / flore observées</h3>
							<div id="resultat">			
								<p>Des observations faune/flore sont disponibles, cependant les droits qui vous ont été affectés nous vous permettent pas d'accéder aux données. 
									Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a></p>
							</div>
						</div>
					<?php }else{ ?>
					<div id="textafficahge">
					<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
					<h3>Liste des espèces faune / flore observées</h3>
						<table align="center"  width="100%" border="0">
							<tr class="entete">
								<th width="8%">Date</th>
								<th width="22%">Taxon</th>
								<th width="10%">Nombre</th>
								<th width="15%">Type de dénombrement</th>
								<th width="25%">Technique acquisition</th>
								<th width="20%">Commentaire</th>
							</tr>
						</table>	
						<div id="resultat">			
							<table width="100%" border="0">
								<?php
								$i=1;
								while($donnees = pg_fetch_array($observation_obs_ss_contour))
								{
								$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
								?>
									<tr align="center" class="<?php echo $style ?>" height="25"> 
										<td style="width:8%;">
											<?php echo date('d/m/Y', $donnees['O_DATE']) ?>
										</td>
										<td style="width:22%;">
											<?php echo $donnees['O_NLAT'] ?>
										</td>
										<td style="width:10%;">
											<?php echo $donnees['O_NBRE'] ?>
										</td>
										<td style="width:15%;">
											<?php echo $donnees['O_NBRT'] ?>
										</td>
										<td style="width:25%;">
											<?php echo $donnees['SACQ'] ?>
										</td>
										<td style="width:20%;">
											<?php echo $donnees['O_COMT'] ?>
										</td>
									</tr>
								<?php
								$i++;
								}
								?>
							</table>
						</div>
					</div>
					<?php } ?>
			<?php } ?>
	<?php }elseif($role == "utilisateur"){ ?>
			<?php if(pg_num_rows($observation_obs_ac_contour) == 0){ ?>
				<div id="textafficahge">
				<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
				<h3>Liste des espèces faune / flore observées</h3>
					<div id="resultat">			
						<p>Des observations faune/flore sont disponibles, cependant les droits qui vous ont été affectés nous vous permettent pas d'accéder aux données. 
							Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a></p>
					</div>
				</div>
			<?php }else{ ?>
				<div id="textafficahge">
				<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
				<h3>Liste des espèces faune / flore observées</h3>
					<table align="center"  width="100%" border="0">
						<tr class="entete">
							<th width="8%">Date</th>
							<th width="22%">Taxon</th>
							<th width="10%">Nombre</th>
							<th width="15%">Type de dénombrement</th>
							<th width="25%">Technique acquisition</th>
							<th width="20%">Commentaire</th>
						</tr>
					</table>	
					<div id="resultat">			
						<table width="100%" border="0">
							<?php
							$i=1;
							while($donnees = pg_fetch_array($observation_util_ac_contour))
							{
							$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
							?>
								<tr align="center" class="<?php echo $style ?>" height="25"> 
									<td style="width:8%;">
										<?php echo date('d/m/Y', $donnees['O_DATE']) ?>
									</td>
									<td style="width:22%;">
										<?php echo $donnees['O_NLAT'] ?>
									</td>
									<td style="width:10%;">
										<?php echo $donnees['O_NBRE'] ?>
									</td>
									<td style="width:15%;">
										<?php echo $donnees['O_NBRT'] ?>
									</td>
									<td style="width:25%;">
										<?php echo $donnees['SACQ'] ?>
									</td>
									<td style="width:20%;">
										<?php echo $donnees['O_COMT'] ?>
									</td>
								</tr>
							<?php
							$i++;
							}
							?>
						</table>
					</div>
				</div>
			<?php } ?>
	<?php }	?>
<?php }else{ ?>
		<div id="textafficahge">
		<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
		<h3>Liste des espèces faune / flore observées</h3>
			<div id="resultat">			
				<p>Cette mare ne contient pas de données faune / flore.</p>
			</div>
		</div>
<?php } ?>
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
