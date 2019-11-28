<script src="js/newpram.js" type="text/javascript"></script>

<select name="ID_INTERCO" id="ID_INTERCO" style='width:90%;' onChange='Nom_Commune_Interco();Nom_Mare_Interco();rechercheinterco()' onfocus='map.scrollWheelZoom.disable();map.dragging.disable()'>
	<option value='0'>Intercommunalité</option>
	<?php 
	if(isset($_POST["Num_Dep"])){
		
		include '../bdd.php';
		
		$res=  pg_query($bdd, 'SELECT * FROM layer.intercommunalite WHERE st_contains((SELECT departement.geom FROM ign_bd_topo.departement WHERE "Num_Dep"='."'".$_POST["Num_Dep"]."'".'), st_centroid(ST_Simplify(intercommunalite.geom,1000))) ORDER BY "Intercommunalite"');
		
			while($donnees = pg_fetch_array($res)){
			?>
				<option  value="<?php echo $donnees['Num_fiscalite'];?>"><?php echo $donnees['Intercommunalite'];?></option>
			<?php
			}
	}
	else{
	
	}
	?>
</select>