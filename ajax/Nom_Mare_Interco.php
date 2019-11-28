<script src="js/newpram.js" type="text/javascript"></script>

<select name="ID_MARE" id="ID_MARE" style='width:90%;' onChange='recherchemare()' onfocus='map.scrollWheelZoom.disable()'>
	<option value='0'>Mare</option>
	<?php 
	if(isset($_POST["Num_Interco"])){
		
		include '../bdd.php';
		
		// $res = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE "L_ADMIN"='."'".$_POST["Num_INSEE"]."'".' ORDER BY "L_ID"');
		$res=  pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE st_contains((SELECT intercommunalite.geom FROM layer.intercommunalite WHERE "Num_fiscalite"='."'".$_POST["Num_Interco"]."'".'), st_centroid(ST_Simplify(st_transform(localisation.geom,2154),1000))) ORDER BY "L_ID"');
		
			while($donnees = pg_fetch_array($res)){
			?>
				<option  value="<?php echo $donnees['L_ID'];?>"><?php echo $donnees['L_ID'];?></option>
			<?php
			}
	}
	else{
	
	}
	?>
</select>