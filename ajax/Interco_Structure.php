<script src="js/newpram.js" type="text/javascript"></script>
<?php 
include '../bdd.php';
//REQUETE SQL POUR RECUPERER LE DEPARTEMENT OU SE SITUE LINTERCOMMUNALITE
$res_interco =  pg_query($bdd, 'SELECT "Num_fiscalite" FROM layer.intercommunalite WHERE st_contains(intercommunalite.geom,(SELECT st_centroid(geom) FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_POST["idstructure"]."'".'))
								GROUP BY "Num_fiscalite"
								ORDER BY "Num_fiscalite"');
$donnees_interco = pg_fetch_array($res_interco);
?>
<select name="ID_INTERCO" id="ID_INTERCO" style='width:90%;' onChange='Nom_Commune_Interco();Nom_Mare_Interco();rechercheinterco()' onfocus='map.scrollWheelZoom.disable();map.dragging.disable()'>
	<option value='0'>Intercommunalité</option>
	<?php 
	if(isset($_POST["idstructure"])){
		
		include '../bdd.php';
		
		$res=  pg_query($bdd, 'SELECT * FROM layer.intercommunalite ORDER BY "Intercommunalite"');
		
			while($donnees = pg_fetch_array($res)){
			?>
				<option  value="<?php echo $donnees['Num_fiscalite'];?>" <?php if($donnees['Num_fiscalite'] == $donnees_interco["Num_fiscalite"]){echo "selected";}?>><?php echo $donnees['Intercommunalite'];?></option>
			<?php
			}
	}
	else{
	
	}
	?>
</select>