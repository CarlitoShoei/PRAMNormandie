<?php 
$type = $_GET['type']; 
if($type == 'menu'){
?>
	<table width="100%">
			<tr><td colspan="5"><b>Programme régional d'actions en faveur des mares de Normandie</b></td></tr>
		<tr>
			<td id="hover3" onClick="afficher_masquer('menupram','');setTimeout('afficher_masquer(\'menupram\',\'\')',5000);"><img src="../img/menu.png" title="Consultation" alt="Consultation"></td>
			<td id="hover3" onClick="afficher_masquer('edit','');setTimeout('afficher_masquer(\'edit\',\'\')',5000);"><img src="../img/edit.png" title="Edition" alt="Edition"></td>
			<td id="hover3" onClick="afficher_masquer('import','');setTimeout('afficher_masquer(\'import\',\'\')',5000);"><img src="../img/folder_into.png" title="Importation" alt="Importation"></td>
			<td id="hover3" onClick="afficher_masquer('export','');setTimeout('afficher_masquer(\'export\',\'\')',5000);"><img src="../img/folder_out.png" title="Exportation" alt="Exportation"></td>
		</tr>
	</table>
<?php 
}
?>