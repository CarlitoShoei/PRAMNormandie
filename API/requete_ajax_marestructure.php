<?php
//connexion a la BD
include '../bdd.php';
$idstructureconnectee = $_GET['idstructureconnectee'];

//REQUETE POUR SAVOIR COMBIEN DE MARE POSS2DE LA STRUCTURE DANS SONT CONTOUR
$req_countmare = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation As lg
							LEFT JOIN ign_bd_topo.commune ON lg."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
							LEFT JOIN menu_deroulant.l_statut ON lg."L_STATUT"::text = l_statut."ID"::text
							LEFT JOIN saisie_observation.structure ON lg."L_STRP"::int = structure."S_ID"
							WHERE structure."S_ID_SESSION" = '."'".$idstructureconnectee."'".'
							UNION ALL
							SELECT * FROM saisie_observation.localisation As lg
							LEFT JOIN ign_bd_topo.commune ON lg."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
							LEFT JOIN menu_deroulant.l_statut ON lg."L_STATUT"::text = l_statut."ID"::text
							LEFT JOIN saisie_observation.structure ON st_contains(structure.geom, st_transform(lg.geom,2154))
							WHERE structure."S_ID_SESSION" = '."'".$idstructureconnectee."'".'
							AND "L_STRP"::int <> structure."S_ID"');
					$count = pg_num_rows($req_countmare);
if($count >= 1){

	$sql = 'SELECT row_to_json(fc) FROM (
				SELECT '."'FeatureCollection'".' As type, array_to_json(array_agg(f)) As features	
				FROM (
					SELECT '."'Feature'".' As type, 
						ST_AsGeoJSON(ST_SimplifyPreserveTopology(lg.geom,10))::json As geometry, 
						row_to_json((SELECT l FROM (SELECT lg."ID" as id, lg."L_ID" as l_id, lg."L_ADMIN" as l_admin, lg."L_STATUT" as l_statut, l_statut."STATUT" as statut, lg."L_DATE" as l_date, lg."L_STRP" as l_strp, lg."L_COOX" as l_coox, lg."L_COOY" as l_cooy, "Nom_Commune" as l_commune, (SELECT "S_ID_SESSION" FROM saisie_observation.structure WHERE "S_ID"::text = "L_STRP") as idstructureloca) As l)) as properties
					FROM saisie_observation.localisation As lg
					LEFT JOIN ign_bd_topo.commune ON lg."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
					LEFT JOIN menu_deroulant.l_statut ON lg."L_STATUT"::text = l_statut."ID"::text
					LEFT JOIN saisie_observation.structure ON st_contains(structure.geom, st_transform(lg.geom,2154))
					WHERE structure."S_ID_SESSION" = '."'".$idstructureconnectee."'".'
					AND "L_STRP"::int <> structure."S_ID"
					UNION ALL
					SELECT '."'Feature'".' As type, 
						ST_AsGeoJSON(ST_SimplifyPreserveTopology(lg.geom,10))::json As geometry, 
						row_to_json((SELECT l FROM (SELECT lg."ID" as id, lg."L_ID" as l_id, lg."L_ADMIN" as l_admin, lg."L_STATUT" as l_statut, l_statut."STATUT" as statut, lg."L_DATE" as l_date, lg."L_STRP" as l_strp, lg."L_COOX" as l_coox, lg."L_COOY" as l_cooy, "Nom_Commune" as l_commune, (SELECT "S_ID_SESSION" FROM saisie_observation.structure WHERE "S_ID"::text = "L_STRP") as idstructureloca) As l)) as properties
					FROM saisie_observation.localisation As lg
					LEFT JOIN ign_bd_topo.commune ON lg."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
					LEFT JOIN menu_deroulant.l_statut ON lg."L_STATUT"::text = l_statut."ID"::text
					LEFT JOIN saisie_observation.structure ON lg."L_STRP"::int = structure."S_ID"
					WHERE structure."S_ID_SESSION" = '."'".$idstructureconnectee."'".'
				) As f 
			)  As fc';
			
			
		//execute la requete dans le moteur de base de donnees
		$query_result = pg_exec($bdd,$sql) or die (pgErrorMessage());
		while($row = pg_fetch_row($query_result))
		{
		  echo trim($row[0]);
		}
		//ferme la connexion a la BD
}

pg_close($bdd);


?>



