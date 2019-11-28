<?php
//connexion a la BD
include '../bdd.php';
$idstructureconnectee = $_GET['idstructureconnectee'];

$sql = 'SELECT row_to_json(fc) FROM (
    SELECT '."'FeatureCollection'".' As type, array_to_json(array_agg(f)) As features
        FROM (
            SELECT '."'Feature'".' As type, ST_AsGeoJSON(st_transform(ST_SimplifyPreserveTopology(lg.geom,1),4326))::json As geometry , row_to_json((SELECT l FROM (SELECT lg."S_ID" as s_id) As l)) as properties
            FROM saisie_observation.structure As lg
			WHERE lg."S_ID_SESSION" = '."'".$idstructureconnectee."'".'
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



