<?php
//connection BDD
include '../../bdd.php';
include_once '../../function.php';

$S_ID = $_GET['S_ID'];


$listObs = array();
$req = pg_query($bdd, 'SELECT * FROM saisie_observation.observateur, saisie_observation.structure WHERE structure."STRUCTURE" = observateur."OBS_STRUCTURE" AND structure."S_ID"=E'."'".utf8_decode(addslashes($S_ID))."'".' ORDER BY "ID"'); 
while($donnees = pg_fetch_array($req))
{
	array_push($listObs, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
}

echo simpleDisplaySelect($listObs, 'O_OBSV', 'ID', 'OBS_NOM_PRENOM', 0, '', 64); ?>             <img src="../img/observateur_add.png" alt="Ajouter un observateur" title="Ajouter un observateur" width="20" onClick="load_page('observateurs/observateurs_especefauneflore.php?ID_STRUCTURE=<?php echo  $S_ID;?>', 'observateur', 'observateur')"/>