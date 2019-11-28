<?php
//http://jquery.malsup.com/form/files-raw.php
//http://www.alternative.free.fr/blog
//upload AJAX student photo
include '../../bdd.php';
header('Content-type: text/html; charset=iso8859-1'); 

if ($_FILES['studentPhotoCarac'] && $_FILES['studentPhotoCarac']['type'] == 'image/jpeg' || $_FILES['studentPhotoCarac']['type'] == 'image/png' 
	|| $_FILES['studentPhotoCarac']['type'] == 'image/jpg' || $_FILES['studentPhotoCarac']['type'] == 'image/gif' || $_FILES['studentPhotoCarac']['type'] == 'image/tiff' 
	|| $_FILES['studentPhotoCarac']['type'] == 'image/tif' || $_FILES['studentPhotoCarac']['type'] == 'image/JPG' || $_FILES['studentPhotoCarac']['type'] == 'image/JPEG') 
{
	if ( in_array( strtolower(strrchr($_FILES['studentPhotoCarac']['name'], '.')), array('.jpg', '.jpeg', '.png', '.gif', '.tiff', '.tif') ) )
	{
		if ($_FILES['studentPhotoCarac']['size'] < 20480000) // file size inf 2Mb
		{
			$ImageNews = $_FILES['studentPhotoCarac']['name'];
			
			//On vérifier si les extension corresponde correctement à ce que on attend
			$ExtensionPresumee = explode('.', $ImageNews);
			$ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
			
			//On créer une copie de l'image à redimensionner
			$ImageChoisie = imagecreatefromjpeg($_FILES['studentPhotoCarac']['tmp_name']);
			//On récupére les dimensions de l'image de départ
			$TailleImageChoisie = getimagesize($_FILES['studentPhotoCarac']['tmp_name']);
			//On définit la nouvelle taille
			$NouvelleLargeur = 800; //Largeur choisie à 350 px mais modifiable
			$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
			
			//On créer une miniature
			$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
			imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
			
			//On supprime le ficer image que l'on veu plus
			imagedestroy($ImageChoisie);
			
			//On enregistre le nouveau nom de l'image
			// $NomImageChoisie = explode('.', $studentPhotoCarac);
			$NomImageChoisie = $ExtensionPresumee[0];
			$NomImageExploitable = time();

			//On enregistre la nouvelle image dans le dossier de notre choix tout en choisisant sa qualité
			imagejpeg($NouvelleImage , '../../img/photo/caracterisation/'.$NomImageExploitable.'.'.$ExtensionPresumee, 100);
			$LienImageNews = '../../img/photo/caracterisation/'.$NomImageExploitable.'.'.$ExtensionPresumee;
			
			if(!isset($_GET['Methode'])){
				if(strstr($_GET['ID_Mare'],'_')){
					$L_ID = $_GET['ID_Mare'];
				}else{
					//GRACE A LIDENTIFIANT UNIQUE DE LA MARE ON VA ALLER CHERCHER LE NUMERO L_ID DE LA MARE PAR UNE REQUETTE
					$req = pg_query($bdd, 'SELECT "L_ID" FROM saisie_observation.localisation WHERE "ID"='."'".$_GET['ID_Mare']."'".'');
					$donnees_lid = pg_fetch_array($req);
					//ON RECUPERE L_ID
					$L_ID = $donnees_lid['L_ID'];
				}
				if(!isset($_GET['ID_CARAC'])){
					//MAINTENANT ON RECUPERE LE ID_CARACTERE GRASE AU L_ID
					$req = pg_query($bdd, 'SELECT "ID_CARAC" FROM saisie_observation.caracterisation WHERE "L_ID"='."'".$L_ID."'".' AND "TEST_CARAC"=1');
					$donnees_carac = pg_fetch_array($req);
					//ON RECUPERE L_ID
					$ID_CARAC = $donnees_carac['ID_CARAC'];
				}else{
					$ID_CARAC = $_GET['ID_CARAC'];
				}
			}else{
				$L_ID = $_GET['ID_Mare'];
				$ID_CARAC = $_GET['ID_CARAC'];
			}
			$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation_photo("L_ID", "ID_CARAC", "DESCRIPTION", "LIEN", "NOM") VALUES('."'".$L_ID."'".', '."'".intval($ID_CARAC)."'".', '."'".stripslashes($_POST['ContenuNewsCarac'])."'".', '."'".stripslashes($LienImageNews)."'".', '."'".$NomImageExploitable."'".')'); 
			
			//ON MODIFIE LA COLONNE TEST_CARAC DE LA TABLE PRAM_CARACTERISATION EN 0 A LA PLACE DE 1
			$req_insert = pg_query($bdd, 'UPDATE saisie_observation.caracterisation SET "TEST_CARAC" = 0 WHERE "L_ID" = '."'".$L_ID."'".' AND "ID_CARAC"='."'".intval($ID_CARAC)."'".'');
			
				
			if ($req_insert){
				//Requete pour afficher la photo
				$req_photo =  pg_query($bdd, 'SELECT * FROM saisie_observation.caracterisation_photo WHERE "NOM" = '."'".$NomImageExploitable."'".'');
				$donnees_photo = pg_fetch_array($req_photo);
				if(!isset($_GET['Methode'])){
					echo "<img width='100%' src='".$donnees_photo['LIEN']."'/>";
				}else{
					echo "<img width='100%' src='".$donnees_photo['LIEN']."'/>";
				}
				// echo 'La news a bien été insérée';
			}
			
			
			
			
			//store file
			// $new_file = './upload/'.$_POST['studentId'].mktime().'.jpg';
			// if(move_uploaded_file($_FILES['studentPhotoCarac']['tmp_name'],$new_file))
				// echo "File transfer succesfull in ". $new_file;
				
		//errors
		}else{ 
			echo 'Le fichier spécifié est trop lourd : '.$_FILES['studentPhotoCarac']['size'].' bytes'; 
		}
	}else{
		echo 'L\'extension du fichier n\'est pas valable : '.strtolower(strrchr($_FILES['studentPhotoCarac']['name'], '.')); 
	}
}else{ 
	echo 'Le fichier n\est pas une image ou/et trop lourd : '.$_FILES['studentPhotoCarac']['type']; 
}
?>