<?php
	session_start();
	include '../../bdd.php';
	include '../../function.php';
	//ON RECUPERE LES VARAIBLE
	$S_ID = $_GET['ID_STRUCTURE'];
	
	//REQUETE POUR ALLER CHERCHER LE NOM DE LA STRUCTURE
	$strucutre = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID"='."'".$S_ID."'".''); 
	$donnees = pg_fetch_array($strucutre);
?>

	<div id="textafficahge">
	<h3>Ajout d'un observateur</h3>

	<table align="center" width="100%" border="0">
		<tr class="entete">
			<th width="25%">Nom de l'observateur</th>
			<th width="25%">Prénom de l'observateur</th>
			<th width="25%">Structure de l'observateur</th>
			<th width="25%">Action</th>
		</tr>

		<tr align="center">
			<td style="width:25%;">
				<input style="width:90%;" type="text" name="OBS_NOM" id="OBS_NOM" value="" onblur="verifchampVide(this)"/>
			</td>
			<td style="width:25%;">
				<input style="width:90%;" type="text" name="OBS_PRENOM" id="OBS_PRENOM" value="" onblur="verifchampVide(this)"/>
			</td>
			<td style="width:25%;">
				<input style="width:90%;" disabled='disabled' type="text" name="OBS_STRUCTURE" id="OBS_STRUCTURE" value="<?php echo $donnees['STRUCTURE'];?>" onblur="verifchampVide(this)"/>
			</td>
			<th align="center" style="width:90%;">
				<input width="25" type="image" src="../img/add.png" Title="Ajouter" onclick="verifForm('observateurs/enregobservateur.php', 'observateur_resultat', '', 'observateur');Effect.Pulsate('observateur_resultat',{pulses:1,duration:0.5}); return false;">
			</th>
		</tr>
	</table>
		<?php 
			$TYPE = "observateur";
			$MOD = "MODE";
			$OBS_STRUCTURE = $donnees['STRUCTURE'];
			include 'enregobservateur.php'								
		?>
	</div>
	<div id="piedaffichage">
		<table align="center" width="100%" border="0">
			<tr>
				<td width="100%">
					<fieldset class="pied_popup" align="center">
						<table align="center" border="0">
							<tr>
								<td width="30" align="center">
									<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('observateur','affichage_vide.php');load_page('observateurs/actualise_observateurcarac.php?S_ID=<?php echo $S_ID ?>','actualise_observateurcarac', 'actualise_observateurcarac')">
								</td>
							</tr>
						</table>
					</fieldset>
				</td>
			</tr>
		</table>
	</div>