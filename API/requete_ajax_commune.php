<?php
//connexion a la BD
include '../bdd.php';
$insee = $_GET['insee'];

$sql = 'SELECT row_to_json(fc) FROM (
    SELECT '."'FeatureCollection'".' As type, array_to_json(array_agg(f)) As features
        FROM (
            SELECT '."'Feature'".' As type, ST_AsGeoJSON(st_transform(ST_SimplifyPreserveTopology(lg.geom,1),4326))::json As geometry , row_to_json((SELECT l FROM (SELECT lg."Num_INSEE" as insee) As l)) as properties
            FROM ign_bd_topo.commune As lg
			WHERE lg."Num_INSEE" = '."'".$insee."'".'
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



