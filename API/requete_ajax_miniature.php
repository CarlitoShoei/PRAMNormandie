<?php
//connexion a la BD
include '../bdd.php';
$l_id = $_GET['l_id'];

$sql = 'SELECT row_to_json(fc) FROM (
			SELECT '."'FeatureCollection'".' As type, array_to_json(array_agg(f)) As features	
			FROM (
				SELECT '."'Feature'".' As type, 
					ST_AsGeoJSON(ST_SimplifyPreserveTopology(lg.geom,10))::json As geometry, 
					row_to_json((SELECT l FROM (SELECT lg."ID" as id, lg."L_ID" as l_id, lg."L_ADMIN" as l_admin, lg."L_STATUT" as l_statut, l_statut."STATUT" as statut, lg."L_DATE" as l_date, lg."L_STRP" as l_strp, lg."L_COOX" as l_coox, lg."L_COOY" as l_cooy, "NOM" as nom, "Nom_Commune" as l_commune) As l)) as properties
				FROM saisie_observation.localisation As lg
				LEFT JOIN saisie_observation.localisation_photo ON lg."L_ID" = saisie_observation.localisation_photo."L_ID"
				LEFT JOIN ign_bd_topo.commune ON lg."L_ADMIN" = ign_bd_topo.commune."Num_INSEE"
				LEFT JOIN saisie_observation.structure ON lg."L_STRP" = structure."S_ID"::text
				LEFT JOIN menu_deroulant.l_statut ON lg."L_STATUT"::text = l_statut."ID"::text
				WHERE lg."L_ID" = '."'".$l_id."'".'
			) As f 
		)  As fc';


//execute la requete dans le moteur de base de donnees
$query_result = pg_exec($bdd,$sql) or die (pgErrorMessage());
while($row = pg_fetch_row($query_result))
{
  echo trim($row[0]);
}
//ferme la connexion a la BD
pg_close($bdd);

?>



