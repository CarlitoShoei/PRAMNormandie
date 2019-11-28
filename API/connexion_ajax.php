<?php 
$type = $_GET['type']; 
if($type == 'connexion'){
?>
	<table class="tableconnexion" height="100%">
		<tr>
			<td id="hover" onClick="afficher_masquer('connexion','connexion_ajax.php')">
				<table class="tableconnexion"  height="100%">
					<tr>
						<td align="right" width="15%"><img src="../img/delete.png"></td>
						<th align="left" width="35%">Fermer</th>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<?php 
}elseif($type == 'fermer'){
?>
	<table class="tableconnexion" height="100%">
		<tr>
			<td id="hover" onClick="afficher_masquer('connexion','connexion_ajax.php')">
				<table class="tableconnexion"  height="100%">
					<tr>
						<td align="right" width="15%"><img src="../img/door2.png"></td>
						<th align="left" width="35%">M'identifier</th>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<?php 
}elseif($type == 'bienvenue'){
	//On se connecte à la base de données
	include '../bdd.php';
	session_start();
	
	$reponse = pg_query($bdd, 'SELECT "STRUCTURE" FROM saisie_observation.structure WHERE "S_ID_SESSION" = '."'".$_SESSION['Identifiant']."'".' AND "S_VALIDATION" = 1');
	$donnees = pg_fetch_array($reponse);
?>
	<table class="tableconnexion" height="100%">
		<tr>
			<td id="hover">
				<table class="tableconnexion"  height="100%">
					<tr>
						<td align="right" width="15%"><a href="authOut.php"><img src="../img/deconnect.png" title="Déconnexion"></a></td>
						<th align="left" width="35%">Bienvenue <?php echo $donnees["STRUCTURE"];?></th>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<?php 
}
?>