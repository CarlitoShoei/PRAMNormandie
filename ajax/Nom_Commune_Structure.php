<script src="js/newpram.js" type="text/javascript"></script>
<?php 
include '../bdd.php';
//REQUETE SQL POUR RECUPERER LE DEPARTEMENT OU SE SITUE LINTERCOMMUNALITE
$res_commune =  pg_query($bdd, 'SELECT * 
								FROM ign_bd_topo.commune
								WHERE st_intersects(commune.geom,
											(SELECT geom FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_POST["idstructure"]."'".')
											)
								ORDER BY "Nom_Commune"');
?>
<select name="ID_COMMUNE" id="ID_COMMUNE" style='width:90%' onChange='Mare();recherchecommune()' onfocus='map.scrollWheelZoom.disable();map.dragging.disable()'>
	<option value='0'>Commune</option>
	<?php 
	if(isset($_POST["idstructure"])){
		
			while($donnees_commune = pg_fetch_array($res_commune)){
			?>
				<option  value="<?php echo $donnees_commune['Num_INSEE'];?>"><?php echo $donnees_commune['Nom_Commune'];?></option>
			<?php
			}
	}
	else{
	
	}
	?>
</select>