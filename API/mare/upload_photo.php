<?php
//http://jquery.malsup.com/form/files-raw.php
//http://www.alternative.free.fr/blog
//upload AJAX student photo
include '../../bdd.php';
header('Content-type: text/html; charset=iso8859-1'); 

if ($_FILES['studentPhoto'] && $_FILES['studentPhoto']['type'] == 'image/jpeg' || $_FILES['studentPhoto']['type'] == 'image/png' 
	|| $_FILES['studentPhoto']['type'] == 'image/jpg' || $_FILES['studentPhoto']['type'] == 'image/gif' || $_FILES['studentPhoto']['type'] == 'image/tiff' 
	|| $_FILES['studentPhoto']['type'] == 'image/tif' || $_FILES['studentPhoto']['type'] == 'image/JPG' || $_FILES['studentPhoto']['type'] == 'image/JPEG' ) 
{
	if ( in_array( strtolower(strrchr($_FILES['studentPhoto']['name'], '.')), array('.jpg', '.jpeg', '.png', '.gif', '.tiff', '.tif') ) )
	{
		if ($_FILES['studentPhoto']['size'] < 20480000) // file size inf 4Mb
		{
			$ImageNews = $_FILES['studentPhoto']['name'];
			
			//On vérifier si les extension corresponde correctement à ce que on attend
			$ExtensionPresumee = explode('.', $ImageNews);
			$ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
			
			//On créer une copie de l'image à redimensionner
			$ImageChoisie = imagecreatefromjpeg($_FILES['studentPhoto']['tmp_name']);
			//On récupére les dimensions de l'image de départ
			$TailleImageChoisie = getimagesize($_FILES['studentPhoto']['tmp_name']);
			//On définit la nouvelle taille
			$NouvelleLargeur = 800; //Largeur choisie à 350 px mais modifiable
			$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
			
			//On créer une miniature
			$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
			imagecopyresampled($NouvelleImage, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
			
			//On supprime le ficer image que l'on veu plus
			imagedestroy($ImageChoisie);
			
			//On enregistre le nouveau nom de l'image
			// $NomImageChoisie = explode('.', $studentPhoto);
			$NomImageChoisie = $ExtensionPresumee[0];
			$NomImageExploitable = time();

			//On enregistre la nouvelle image dans le dossier de notre choix tout en choisisant sa qualité
			imagejpeg($NouvelleImage , '../../img/photo/'.$NomImageExploitable.'.'.$ExtensionPresumee, 100);
			$LienImageNews = '../../img/photo/'.$NomImageExploitable.'.'.$ExtensionPresumee;
			
			//GRACE A LIDENTIFIANT UNIQUE DE LA MARE ON VA ALLER CHERCHER LE NUMERO L8ID DE LA MARE PAR UNE REQUETTE
			$req = pg_query($bdd, 'SELECT "L_ID" FROM saisie_observation.localisation WHERE "L_ID"='."'".$_GET['ID_Mare']."'".'');
			$donnees_lid = pg_fetch_array($req);
			//ON RECUPERE L_ID
			$L_ID = $donnees_lid['L_ID'];
			
			$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.localisation_photo("L_ID", "DESCRIPTION", "LIEN", "NOM") VALUES('."'".$L_ID."'".', '."'".stripslashes($_POST['ContenuNews'])."'".', '."'".stripslashes($LienImageNews)."'".', '."'".$NomImageExploitable."'".')'); 

			if ($req_insert){
				//Requete pour afficher la photo
				$req_photo = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation_photo WHERE "NOM" ='."'".$NomImageExploitable."'".'');
				$donnees_photo = pg_fetch_array($req_photo);
				echo "<img width='100%' src='".$donnees_photo["LIEN"]."'/>";
				// echo 'La news a bien été insérée';
			}
			
			//store file
			// $new_file = './upload/'.$_POST['studentId'].mktime().'.jpg';
			// if(move_uploaded_file($_FILES['studentPhoto']['tmp_name'],$new_file))
				// echo "File transfer succesfull in ". $new_file;
				
		//errors
		}else{ 
			echo 'Le fichier spécifié est trop lourd : '.$_FILES['studentPhoto']['size'].' bytes'; 
		}
	}else{
		echo 'L\'extension du fichier n\'est pas valable : '.strtolower(strrchr($_FILES['studentPhoto']['name'], '.')); 
	}
}else{ 
	echo 'Le fichier n\est pas une image ou/et trop lourd : '.$_FILES['studentPhoto']['type']; 
}
?>