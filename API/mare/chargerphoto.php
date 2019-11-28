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
<h3>Ajouter une photo de localisation</h3>
	<div id="resultat_carac">
		<?php if($role == 'administrateur' || ($donnees_idstructure['S_ID'] == $donnees_loca['L_STRP'])){ ?>
			<iframe id="photolocalisation" src="mare/iframephoto.php?ID_Mare=<?php echo $L_ID?>&type=photolocalisation&idstructureconnectee=<?php echo $donnees_idstructure['S_ID_SESSION']?>&rolestructure=<?php echo $donnees_idstructure['ROLE']?>" width="100%" height="420px" frameborder="0"></iframe>
		<?php }else{ ?>
				<table border="0" width="90%">
					<tr>
						<td width="55%" colspan="3">
							<p>Les droits qui vous ont été affectés ne vous permettent pas modifier la photo de localisation de cette mare.
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