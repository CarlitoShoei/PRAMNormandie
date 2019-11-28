<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	session_start();
	header( 'content-type: text/html; charset=utf-8' );
	header('Content-type: text/html; charset=iso8859-1');
	include '../../bdd.php';
	include '../../function.php';
	//ON RECUPERE LES VARAIBLE
	$S_ID = $_GET['ID_STRUCTURE'];
	
	//REQUETE POUR ALLER CHERCHER LE NOM DE LA STRUCTURE
	$strucutre =pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID"='."'".$S_ID."'".''); 
	$donnees = pg_fetch_array($strucutre);
?>
<div id="textafficahge">
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<input style="width:100%;display:none" type="text" name="OBS_STRUCTURE" id="OBS_STRUCTURE" onblur="verifchampVide(this)" value="<?php echo $donnees['STRUCTURE'];?>" tabindex="1" onblur="verifchampVide(this)"/>
	<h3>Importation de données en masse</h3>
	<div id="resultat">
		<table border="0" align="center" width="100%">
			<tr>
				<td width="100%" align="center">	
					<p>
						Pour une importation en masse de vos données sur les mares, il est nécesaire de les formater au standard régional.</br>
						
						<a style="font-size:13px" href="import_excel/pram_importation.zip">Télécharger ICI</a> les fichiers Excel nécessaires à ce travail. 
						Pour vous aider, un dictionnaire de données et un Modéle Conceptuel de Données sont à votre disposition.</br>
						
						
						ATTENTION, toutes les données importées en masse doivent provenir uniquement d'une seule et même structure.
					</p>
					<p>
						Une fois le formatage de vos données réalisé, enviyer les fichiers au responsable de la base de données du PRAM (Charles Bouteiller).<br>
						
						En cas de doute, <a href="http://pramnormandie.com/contacts-pram-normandie.php" target="_bank">Contactez-nous</a>.</br>
						
						Merci
					</p>
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
</html>