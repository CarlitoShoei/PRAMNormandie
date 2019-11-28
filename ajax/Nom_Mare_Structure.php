<script src="js/newpram.js" type="text/javascript"></script>
<?php 
include '../bdd.php';
//REQUETE SQL POUR RECUPERER LE DEPARTEMENT OU SE SITUE LINTERCOMMUNALITE
$res_mare =  pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE st_contains(
																								(SELECT intercommunalite.geom FROM layer.intercommunalite WHERE st_contains(intercommunalite.geom,(SELECT st_centroid(geom) FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_POST["idstructure"]."'".'))), 
																								st_centroid(ST_Simplify(st_transform(localisation.geom,2154),1000))
																							) 
							ORDER BY "L_ID"');
?>
<select name="ID_MARE" id="ID_MARE" style='width:90%;' onChange='recherchemare()' onfocus='map.scrollWheelZoom.disable();map.dragging.disable()'>
	<option value='0'>Mare</option>
	<?php 
	if(isset($_POST["idstructure"])){
			while($donnees_mare = pg_fetch_array($res_mare)){
			?>
				<option  value="<?php echo $donnees_mare['L_ID'];?>"><?php echo $donnees_mare['L_ID'];?></option>
			<?php
			}
	}
	else{
	
	}
	?>
</select>