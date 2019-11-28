<?php
	include '../../bdd.php';
	$id_structure_conectee = $_GET['identifiant'];
	
?>
<body>
	<div id="textafficahge">
	<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
	<h3>Fiche de saisie :</h3>
	<table border="0" align="center" width="100%">
		<tr>
			<td width="50%" align="center" >
				<p>Pour générer une fiche de saisie, veuillez choisir la période : </p>
			</td>
			<td width="10%">
				<p>Date de début : </p>	
			</td>
			<td width="10%">
				<input style="width:95%;" type="text" id="Date_Debut" placeholder="JJ/MM/AAAA">
			</td>
			<td width="10%">
				<p>Date de fin : </p>
			</td>
			<td width="10%">
				<input style="width:95%;" type="text" id="Date_Fin" placeholder="JJ/MM/AAAA">
			</td>
			<td width="10%">
				<img width="30" src="../img/pdf.png" title="Export fiche saisie PDF" onClick="Export_Fiche_Depot('fiche_depot/pdf_fiche_depot.php?S_ID_SESSION=<?php echo $id_structure_conectee?>')">
			</td>
		</tr>
	</table>
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
</body>



