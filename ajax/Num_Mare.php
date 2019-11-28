<script src="js/newpram.js" type="text/javascript"></script>

<select name="ID_MARE" id="ID_MARE" style='width:90%;' onChange='recherchemare();' onfocus='map.scrollWheelZoom.disable();map.dragging.disable()'>
	<option value='0'>Mare</option>
	<?php 
	if(isset($_POST["Num_INSEE"])){
		
		include '../bdd.php';
		
			$res = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE "L_ADMIN"='."'".$_POST["Num_INSEE"]."'".' ORDER BY "L_ID"');
				
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