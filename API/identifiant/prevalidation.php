<?php
	include '../../bdd.php';
	
	//ON RECUPERE LES VARIABLE
	$valide = $_GET['valide'];
	$email = $_GET['email'];
	$id_session = $_GET['id_session'];
	$mdp = $_GET['mdp'];
		
	echo "
	
		<h3>Renseignements complémentaire avant validation</h3></br>
		<form action='validation.php?valide=".$valide."&email=".$email."&id_session=".$id_session."&mdp=".$mdp."' method='post'>
		<table>
			<tr>
				<th> Rôle de la structure : </th>
				<td>
					<select name='role'>
						<option value='A Saisir'>A Saisir</option>
						<option value='administrateur'>Administrateur</option>
						<option value='observateur'>Observateur</option>
						<option value='utilisateur'>Utilisateur</option>
					</select>
				</td>
			</tr>
			<tr>
				<th> Identifiant SINP : </th>
				<td>
					<input type='text' name='identifiant_sinp' value=''>
				</td>
			</tr>
			<tr>
				<th> Identifiant DCNP : </th>
				<td>
					<input type='text' name='dcnp' value=''>
				</td>
			</tr>
		</table>
		<input type='submit' value='Envoyer'>
		</form>
	";	
?>