<script src="js/newpram.js" type="text/javascript"></script>

<select name="ID_COMMUNE" id="ID_COMMUNE" style='width:90%;' onChange='Mare();recherchecommune()' onfocus='map.scrollWheelZoom.disable()'>
	<option value='0'>Commune</option>
	<?php 
	if(isset($_POST["Num_Interco"])){
		
		include '../bdd.php';
		
		$res=  pg_query($bdd, 'SELECT * FROM ign_bd_topo.commune WHERE st_contains((SELECT intercommunalite.geom FROM layer.intercommunalite WHERE "Num_fiscalite"='."'".$_POST["Num_Interco"]."'".'), st_centroid(ST_Simplify(commune.geom,1000))) ORDER BY "Nom_Commune"');
		
			while($donnees = pg_fetch_array($res)){
			?>
				<option  value="<?php echo $donnees['Num_INSEE'];?>"><?php echo $donnees['Nom_Commune'];?></option>
			<?php
			}
	}
	else{
	
	}
	?>
</select>