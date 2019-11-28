<link rel="stylesheet" type="text/css" href="../../css/gallerystyle_visu.css" />
<script type="text/javascript" src="../../js/motiongallery.js">

/***********************************************
* CMotion Image Gallery- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* Please keep this notice intact
* Modified by Jscheuer1 for autowidth and optional starting positions
***********************************************/

</script>

<?php
include '../../bdd.php';

$l_id = $_GET['l_id'];

///ON VA FAIRE UNE REQUETE POUR RECUPERER TOUTE LES PHOTOS DE LA MARRE
$req_photolocalisation = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation_photo WHERE "L_ID"='."'".$l_id."'".'');
?>


<body align="center">
 
<div id="motioncontainer" style="position:relative;overflow:hidden;">
<div id="motiongallery" style="position:absolute;left:0;top:0;white-space: nowrap;">

<div id="trueContainer" style="white-space: nowrap;">

<ul>
<?php while($donnees = pg_fetch_array($req_photolocalisation)){ ?>
		<li><a href="#" onClick="enlargeimage('<?php echo $donnees['LIEN']?>'); return false"><img src="<?php echo $donnees['LIEN']?>" height='120px'/></a></li>
	<?php } ?>
</ul>

</div>

</div>
</div>


 
</body>
