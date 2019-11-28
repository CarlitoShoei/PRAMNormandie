<?php
	//Demare la session
	session_start();
	//connection BDD
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES VARAIBLES
	$ID = $_GET['L_ID'];
	

	//Requete sur la base utilisateur pour connaitre le pr�nom de l'utilisateur
	$req_aut = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION" ='."'".$_SESSION['Identifiant']."'".'');
	$donnees_aut = pg_fetch_array($req_aut);
	
	//FAUT RECUPERER LA LISTE AVEC TOUS LES SALARIES, MAIS UNE SEULE FOIS :)
	$listStructure = array();
	$req = pg_query($bdd, 'SELECT * FROM saisie_observation.structure ORDER BY "S_ID"'); 
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
	
	$listStyp= array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.o_styp ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listStyp, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
?>

<div id="textafficahge">
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<input style="width:90%;display:none" type="text" id="L_ID" value="<?php echo $ID ?>">	
	<h3>Observations faune/flore de la mare (les espèces déjà présentes ont été saisies précédement par votre structure)</h3>
	<table border="0" width="100%">
		<tr align="center">
			<th width="25%">Structure : </th>
			<td width="25%" colspan="2"><?php echo simpleDisplaySelectDisabled($listStructure, 'O_STRP', 'S_ID', 'STRUCTURE', $donnees_aut['S_ID'], '', 63, 'disabled'); ?></td>
			<th width="25%" colspan="2">Observateur : </th>
			<td width="25%" colspan="2">
				<div id="actualise_observateurfauneflore">
					<?php echo simpleDisplaySelect($listObs, 'O_OBSV', 'ID', 'OBS_NOM_PRENOM', 0, '', 64); ?>        <img src="../img/observateur_add.png" alt="Ajouter un observateur" title="Ajouter un observateur" width="20" onClick="load_page('observateurs/observateurs_especefauneflore.php?ID_STRUCTURE=<?php echo  $donnees_aut['S_ID'];?>', 'observateur', 'observateur')"/>
				</div>	
			</td>
		</tr>
		<tr align="left">
			<th width="25%">Quel groupe d'espèce souhaitez-vous saisir ?</th>
			<th width="12%">Flore</th>
			<td width="13%">
				<input type="radio" class="Caract" name="groupe_espece" id="groupe_espece_flore" value="flore" alt="Flore" onClick="RecAttribut('mare/listespece.php','listespece','listeespece');RecAttribut('mare/listosacq.php','listosacq','listeosacq')" tabindex="77">
			</td>
			<th width="12%">Odonate</th>
			<td width="13%">
				<input type="radio" class="Caract" name="groupe_espece" id="groupe_espece_odonate" value="odonate" alt="Odonate" onClick="RecAttribut('mare/listespece.php','listespece','listeespece');RecAttribut('mare/listosacq.php','listosacq','listeosacq')" tabindex="78">
			</td>
			<th width="12%">Amphibien</th>
			<td width="13%">
				<input type="radio" class="Caract" name="groupe_espece" id="groupe_espece_amphibien" value="amphibien" alt="Amphibien" onClick="RecAttribut('mare/listespece.php','listespece','listeespece');RecAttribut('mare/listosacq.php','listosacq','listeosacq')" tabindex="79">
			</td>
		</tr>
	</table>
	</br>
	<table width="100%" border="0">
		<tr style="background-color:#e4b285" align="center" height="20">
			<th width="10%">Date</th>
			<th width="20%">Taxon</th>
			<th width="5%">Nombre</th>
			<th width="10%">Type de dénombrement</th>
			<th width="25%">Technique acquisition</th>
			<th width="5%">Collecte</th>
			<th width="15%">Commentaire</th>
			<th width="10%">Action</th>
		</tr>
		<tr align="center">
			<td style="width:10%;">
				<input style="width:100%" type="text" id="O_DATE" value="" tabindex="65" onClick="" placeholder="JJ/MM/AAAA">
			</td>
			<td style="width:20%;">
				<div id="listespece">
					<select style="width:100%" id="O_NLAT" name="O_NLAT" tabindex="66">
						<option value="0">A Saisir</option>
					</select>
				</div>
			</td>
			<td style="width:5%;">
				<input style="width:100%" type="text" id="O_NBRE" value="" tabindex="67" onblur="verifchampVide(this)">
			</td>
			<td style="width:10%;">
				<select style="width:100%" id="O_NBRT" name="O_NBRT" tabindex="68" onblur="verifchampSelect(this)">
					<option value="0">A Saisir</option>
					<option value="Nombre d'adultes">Nombre d'adultes</option>
					<option value="Présence / absence">Présence / absence</option>
				</select>
			</td>
			<td style="width:25%;">
				<div id="listosacq">
					<select style="width:100%" id="O_SACQ" name="O_SACQ" tabindex="69">
						<option value="0">A Saisir</option>
					</select>
				</div>
				<?php //  ?>
			</td>
			<td style="width:5%;">
				<?php echo simpleDisplaySelect($listStyp, 'O_STYP', 'ID', 'STYP', '', 'verifchampSelect2(this)', 70); ?>
			</td>
			<td style="width:15%;">
				<input style="width:100%" type="text" id="O_COMT" value="" tabindex="71">
			</td>
			<td style="width:10%;" align="center">
				<input width="25" type="image" tabindex="72" src="../img/add.png" Title="Ajouter" onclick="verifFauneFlore('mare/error.php', 'erreur', 'faune_flore')">
				<input width="25" type="image" tabindex="72" src="../img/add3.png" Title="Ajouter & Dupliquer" onclick="verifFauneFlore('mare/error.php', 'erreur', 'faune_flore_dupliquer')">
			</td>
	</table>
	<div id="resultat_petit">
		<?php 
			$IDSTRUCTURE = $donnees_aut['S_ID'];
			$TYPE = "affichage_faune_flore";
			$ID_MARE = $ID;
			include 'enregmare.php'								
		?>
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