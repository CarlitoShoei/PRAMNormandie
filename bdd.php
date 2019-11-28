<?php
//Varaible a changer pour l'export Shape des mare
$ogr2ogrPath = {{ LINKOGR2OGR.EXE }};
$shapefile_dir = {{ LINKFOLDEREXPORTSHAPE }};
$shapefile_out_dir = {{ LINKOUTFOLDEREXPORTSHAPE }};

$host = "localhost";
$port = "5432";
$dbname = {{ NAMEBD }};
$user = {{ USERDATABASEPRAM }};
$password = {{ PWDDATABASEPRAM }};


//Varaible a changer pour l'utilisation du pram
$mailadministrateur = {{ MAILADMINISTRATOR}};
$maildemandeidentification = {{ MAILAUTHENTIFICATION }};
$maildemandeideaccessibilite = {{ MAILACCESSINFO }};
$mailnepasrepondre = {{ MAILNOREPLY }};
$maildestinataireidentification = {{ MAILCONTACT }};


				try
				{
					// On se connecte � MySQL
							$bdd = pg_connect('host='.$host.' port='.$port.' dbname='.$dbname.' user='.$user.' password='.$password.');
				}
				catch(Exception $e)
				{
					// En cas d'erreur, on affiche un message et on arr�te tout
						die('Erreur : '.$e->getMessage());
				}
	?>