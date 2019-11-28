<?php
	//Demare la session
	session_start();
	//connection BDD
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES VARAIBLES
	$L_ID = $_GET['L_ID'];
	$Session = $_GET['Session'];
	$role = $_GET['role'];
	$id_structure_conectee = $_GET['id_structure_conectee'];
	
	//REQUETE POUR ALLER CHERCHER L'IDENDIFIANT DE LA STRUCTURE
	$idstructure = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.structure
										WHERE saisie_observation.structure."S_ID_SESSION"='."'".$id_structure_conectee."'".''); 
	$donnees_idstructure = pg_fetch_array($idstructure);
	
	//REQUETE SQL POUR CHERCHER LA MARE EN QUESTION
	$mare_localisation = pg_query($bdd, 'SELECT * 
										FROM saisie_observation.localisation
										WHERE saisie_observation.localisation."L_ID"='."'".$L_ID."'".''); 
	$donnees_loca = pg_fetch_array($mare_localisation);
	
?>
<div id="textafficahge_carac_edit">	
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<input style="width:90%;display:none" type="text" id="L_ID" value="<?php echo $L_ID ?>">
	<h3>Suppression de la mare</h3>
	<div id="resultat_loca">
			<?php if($role == 'administrateur' || ($donnees_idstructure['S_ID'] == $donnees_loca['L_STRP'])){ ?>
				<table border="0" width="90%" align="center">
					<tr>
						<td width="100%" colspan="5"><p><b>ATTENTION</b> la suppression de la mare implique la suppression de la localisation, ainsi que les caractérisations associées et les observations faune/flore.</p></td>
					</tr>
					<tr height="25"></tr>
					<tr>
						<td width="50%" align="center">Voulez-vous supprimer la mare ?</td>
						<td width="5%"><img src="../img/sup.png" width="30" Title="Supprimer la mare" onclick="AjaxMare('mare/enregmare.php?L_ID=<?php echo $L_ID; ?>', 'msgconfirm', 'supprimer_mare');actualiseMareAfterMod()"></td>
						<td width="20%" style="cursor:pointer;" align="center" onclick="AjaxMare('mare/enregmare.php?L_ID=<?php echo $L_ID; ?>', 'msgconfirm', 'supprimer_mare');actualisemare('<?php echo $id_structure_conectee; ?>','<?php echo $role; ?>')">Oui</td>
						<td width="5%"><img src="../img/delete.png" width="30" Title="Annuler" OnClick="afficher_masquer('affichage','')"></td>
						<td width="20%" style="cursor:pointer;" align="center" OnClick="afficher_masquer('affichage','')">Non</td>
					</tr>
				</table>
				<div id="msgconfirm"></div>
			<?php }else{ ?>
				<table border="0" width="90%">
					<tr>
						<td width="55%" colspan="3">
							<p>Cette mare a été localisée par une autre structure. Vous ne pouvez pas la supprimer.
								Pour plus d'information sur la mare <a href='http://www.pramnormandie.com/contacts-pram-normandie.php' target='_bank'>contactez-nous</a>
							</p>
						</td>
					</tr>
				</table>
			<?php } ?>
	</div>
</div>
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