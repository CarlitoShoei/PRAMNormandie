<?php
//connexion a la BD
include '../bdd.php';
if(isset( $_GET['idmare'])){
	$idmare = $_GET['idmare'];
}
if(isset( $_GET['insee'])){
	$insee = $_GET['insee'];
}
if(isset($_GET['interco'])){
	$interco = $_GET['interco'];
}
if(isset( $_GET['num_dep'])){
	$num_dep = $_GET['num_dep'];
}

//FONCTION POUR ECRIRE EN FONCTION DES CHAMPS CHOISI
function requetefiltre($num_dep,$insee,$idmare,$interco){
	//POUR LES DEPARTEMENT
	if($num_dep <> 0){
		$condition = 'AND LEFT(lg."L_ADMIN",2) = '."'".$num_dep."'".'';
	}else{
		$condition = '';
	}
	//POUR LES INTERCO
	if($interco <> 0){
		$condition .= 'AND intercommunalite."Num_fiscalite" = '."'".$interco."'".'';
	}else{
		$condition .= '';
	}
	//POUR LES COMMUNES
	if($insee <> 0){
		$condition .= 'AND lg."L_ADMIN" = '."'".$insee."'".'';
	}else{
		$condition .= '';
	}
	//POUR LES MARE
	if($idmare <> 0){
		$condition = ' AND lg."L_ID" = '."'".$idmare."'".'';
	}else{
		$condition .= '';
	}
	
	return $condition;
	
}

if(!isset($idmare) && !isset($insee) && !isset($num_dep) && !isset($interco)){
	$sql = 'SELECT row_to_json(fc) FROM (
			SELECT '."'FeatureCollection'".' As type, array_to_json(array_agg(f)) As features	
			FROM (
				SELECT '."'Feature'".' As type, 
					ST_AsGeoJSON(ST_SimplifyPreserveTopology(lg.geom,10))::json As geometry, 
					row_to_json((SELECT l FROM (SELECT lg."ID" as id, lg."L_ID" as l_id, lg."L_ADMIN" as l_admin, lg."L_STATUT" as l_statut, l_statut."STATUT" as statut, lg."L_DATE" as l_date, lg."L_STRP" as l_strp, lg."L_COOX" as l_coox, lg."L_COOY" as l_cooy, "Nom_Commune" as l_commune, "S_ID_SESSION" as idstructureloca) As l)) as properties
				FROM saisie_observation.localisation As lg
				LEFT JOIN ign_bd_topo.commune ON lg."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
				LEFT JOIN saisie_observation.structure ON lg."L_STRP" = structure."S_ID"::text
				LEFT JOIN menu_deroulant.l_statut ON lg."L_STATUT"::text = l_statut."ID"::text
				LEFT JOIN layer.intercommunalite ON st_contains(intercommunalite.geom, st_transform(lg.geom,2154))
				WHERE lg."L_ID" <> '."'NEW'".' LIMIT 1
			) As f 
		)  As fc';
}else{
	$sql = 'SELECT row_to_json(fc) FROM (
			SELECT '."'FeatureCollection'".' As type, array_to_json(array_agg(f)) As features	
			FROM (
				SELECT '."'Feature'".' As type, 
					ST_AsGeoJSON(ST_SimplifyPreserveTopology(lg.geom,100000))::json As geometry, 
					row_to_json((SELECT l FROM (SELECT lg."ID" as id, lg."L_ID" as l_id, lg."L_ADMIN" as l_admin, lg."L_STATUT" as l_statut, l_statut."STATUT" as statut, lg."L_DATE" as l_date, lg."L_STRP" as l_strp, lg."L_COOX" as l_coox, lg."L_COOY" as l_cooy, "Nom_Commune" as l_commune, "S_ID_SESSION" as idstructureloca) As l)) as properties
				FROM saisie_observation.localisation As lg
				LEFT JOIN ign_bd_topo.commune ON lg."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
				LEFT JOIN saisie_observation.structure ON lg."L_STRP" = structure."S_ID"::text
				LEFT JOIN menu_deroulant.l_statut ON lg."L_STATUT"::text = l_statut."ID"::text
				LEFT JOIN layer.intercommunalite ON st_contains(intercommunalite.geom, st_transform(lg.geom,2154))
				WHERE lg."L_ID" <> '."'NEW'".' '."".requetefiltre($num_dep,$insee,$idmare,$interco)."".'
				) As f 
			)  As fc';
}


//execute la requete dans le moteur de base de donnees
$query_result = pg_exec($bdd,$sql) or die (pgErrorMessage());
while($row = pg_fetch_row($query_result))
{
  echo trim($row[0]);
}
//ferme la connexion a la BD
pg_close($bdd);

?>



