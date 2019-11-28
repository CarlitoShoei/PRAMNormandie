<script src="js/newpram.js" type="text/javascript"></script>
<?php 
include '../bdd.php';
//REQUETE SQL POUR RECUPERER LE DEPARTEMENT OU SE SITUE LINTERCOMMUNALITE
$res_dep =  pg_query($bdd, 'SELECT "Num_Dep" FROM ign_bd_topo.departement WHERE st_contains(departement.geom,(SELECT st_centroid(geom) FROM saisie_observation.structure WHERE "S_ID_SESSION"='."'".$_POST["idstructure"]."'".'))
								GROUP BY "Num_Dep"
								ORDER BY "Num_Dep"');
$donnees_dep = pg_fetch_array($res_dep);
?>
<select name="ID_DEPARTEMENT" id="ID_DEPARTEMENT" style='width:90%;' onChange='Nom_Commune();Interco_Dep();Mare_Dep();recherchedepartement();' onfocus='map.scrollWheelZoom.disable();map.dragging.disable()'>
	<option value='0'>Département</option>
	<?php 
	if(isset($_POST["idstructure"])){
		
		
		
		$res=  pg_query($bdd, 'SELECT "Num_Dep" FROM ign_bd_topo.departement GROUP BY "Num_Dep"	ORDER BY "Num_Dep"');
		
			while($donnees = pg_fetch_array($res)){
			?>
				<option  value="<?php echo $donnees['Num_Dep'];?>" <?php if($donnees['Num_Dep'] == $donnees_dep["Num_Dep"]){echo "selected";}?>><?php echo $donnees['Num_Dep'];?></option>
			<?php
			}
	}
	else{
	
	}
	?>
</select>