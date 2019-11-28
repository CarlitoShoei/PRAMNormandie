<link rel="stylesheet" type="text/css" href="../../css/gallerystyle.css" />
<script type="text/javascript" src="../../js/motiongallery.js"></script>
<script type="text/javascript" src="../../js/newpram.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
/***********************************************
* CMotion Image Gallery- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* Please keep this notice intact
* Modified by Jscheuer1 for autowidth and optional starting positions
***********************************************/

function Valid_delete(id){

	if (confirm("Souhaitez-vous supprimer la photo de localisation ?")) {
		var xhr_object = null;
		var position = "";
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que ?marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que ?m
		
			url = "supprime_photolocalisation.php?ID=" + id
					  + "&Session="+ window.parent.document.getElementById('session').value
					  + "&id_structure_conectee="+ window.parent.document.getElementById('idstructureconnectee').value
					  + "&role="+ window.parent.document.getElementById('rolestructure').value;
					  
					  // alert(url);
		
		// On ouvre la requete vers la page d?r?
			xhr_object.open("POST", url, true);
			
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV sp?fi? le contenu retourn?ar le fichier
					document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);	
			
			setTimeout("afficher_masquer('supprimephotoloca','valider.php');", 1000);
			setTimeout("afficher_masquer('supprimephotoloca','valider.php');", 4000);
			
			Annul_delete();
	}
}

function Annul_delete(){
	$('#alert_deleteODK').remove();	
}

function deletePhotoLoca(event,lienphoto,id){
	// var row_position = $(event.currentTarget).parent().parent().index();;
	$('body').append('<div id="alert_deleteODK"></div>');
	// $('body > #alert_deleteODK').append('<p>Que souhaitez vous faire ?</p>');
	$('body > #alert_deleteODK').append('<div></div>');
	$('body > #alert_deleteODK > div').append('<img src="../../img/displayphotoloc.png" id="button" title="Affciher" alt="Afficher" onclick="enlargeimage(\''+lienphoto+'\');Annul_delete()"></br></br><img src="../../img/deletephotoloc.png" id="button" title="Supprimer" alt="Supprimer" onclick="Valid_delete(\''+id+'\');";>');
}




</script>

<?php
include '../../bdd.php';

$l_id = $_GET['l_id'];
$Session = $_GET['Session'];
$id_structure_conectee = $_GET['id_structure_conectee'];

///ON VA FAIRE UNE REQUETE POUR RECUPERER TOUTE LES PHOTOS DE LA MARRE
$req_photolocalisation = pg_query($bdd, 'SELECT "S_ID_SESSION", localisation_photo."ID" as idphoto, "LIEN" 
											FROM saisie_observation.localisation_photo, saisie_observation.localisation, saisie_observation.structure 
											WHERE  localisation_photo."L_ID" = localisation."L_ID" 
											AND localisation."L_STRP"::text = structure."S_ID"::text
											AND localisation."L_ID"='."'".$l_id."'".'');
?>


<body>
 
<div id="motioncontainer" style="position:relative;overflow:hidden;">
<div id="motiongallery" style="position:absolute;left:0;top:0;white-space: nowrap;">

<div id="trueContainer" style="white-space: nowrap;">

<ul>
<?php if(pg_num_rows($req_photolocalisation) == 0){ ?>
		<li><a href="#" onClick="enlargeimage('../../img/photo/no_picture.jpg'); return false"><img src='../../img/photo/no_picture.jpg' height='120px'/></a></li>
		
<?php }else{
		while($donnees = pg_fetch_array($req_photolocalisation)){ 
			if($id_structure_conectee == $donnees['S_ID_SESSION']){ ?>
				<li><a href="#" onClick="deletePhotoLoca('','<?php echo $donnees['LIEN']?>','<?php echo $donnees['idphoto']?>'); return false"><img src="<?php echo $donnees['LIEN']?>" height='120px'/></a></li>
			<?php }else{ ?>
				<li><a href="#" onClick="enlargeimage('<?php echo $donnees['LIEN']?>'); return false"><img src="<?php echo $donnees['LIEN']?>" height='120px'/></a></li>
<?php		}
		}
	  }
?>
</ul>

</div>

</div>
</div>


 
</body>
