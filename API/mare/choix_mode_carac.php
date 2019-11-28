<?php
	//Demare la session
	session_start();
	//connection BDD
	include '../../bdd.php';
	include_once '../../function.php';
	
	//ON RECUPERE LES VARAIBLES
	$L_ID = $_GET['L_ID'];
	
?>

<input style="width:90%;display:none" type="text" id="L_ID" value="<?php echo $L_ID ?>">
<div id="textafficahge_carac_edit">	
<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
<h1>Caractérisation de la mare</h1>
	<div id="resultat_carac_edit">	
		<table border="0" width="90%">
			<table border="0" width="90%" align="center">
				<tr>
					<td width="50%" align="center">Choisissez votre mode de caractérisation ?</td>
					<td width="20%" style="cursor:pointer;" align="center">
						<img id="button" src="../img/caracsimple.png" value="Caractérisation simplifiée" title="Caractérisation simplifiée" alt="Caractérisation simplifiée" OnClick="load_page('../API/mare/caracterisation_simplifie.php?L_ID=<?php echo $L_ID; ?>', 'affichage', 'choixcaracterisation')"/>
					</td>
					<td width="20%" style="cursor:pointer;" align="center">
						<img id="button" src="../img/caracfull.png" value="Caractérisation complète" title="Caractérisation complète" alt="Caractérisation complète" OnClick="load_page('../API/mare/caracterisation.php?L_ID=<?php echo $L_ID; ?>', 'affichage', 'choixcaracterisation')"/>
					</td>
				</tr>
			</table>
		</table>
	</div>
</div>
<!--<div id="piedaffichage">
	<table align="center" width="100%" border="0">
		<tr>
			<td>
				<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<input width="30" type="image" onclick="verifCaracterisation('mare/error.php', 'erreur', '');actualiseMareAfterMod();" src="../img/enreg.png" Title="Enregistrer">
							</td>
							<!--<td width="30" align="center">
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</div>-->