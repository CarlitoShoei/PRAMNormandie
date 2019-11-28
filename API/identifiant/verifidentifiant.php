<?php
	
	include "../../bdd.php";
	include "../../function.php";
	
	//RECUPERE LES VARIABLE
	$Identifiant = $_GET['Identifiant'];
	
	echo Verifidentifiant($Identifiant,$bdd)	
?>