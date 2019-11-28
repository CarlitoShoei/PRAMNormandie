<script src="../../js/newpram.js" type="text/javascript"></script>
<script src="../../js/getXhr.js" type="text/javascript"></script>


<?php
	session_start();
	// header( 'content-type: text/html; charset=utf-8' );
	// header('Content-type: text/html; charset=iso8859-1');
	include '../../bdd.php';
	include '../../function.php';
	//Declare le code pour le captcha
	$code = captcha();
	
	$listeTypeStrucutre = array();
	$req = pg_query($bdd, 'SELECT * FROM menu_deroulant.type_structure ORDER BY "ID"'); 
	while($donnees = pg_fetch_array($req))
	{
		array_push($listeTypeStrucutre, $donnees); //AJOUTER DANS LE TABLEAU LES INFOS DU SALARIE
	}
?>
<div id="textafficahge">
<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
<h3>Demande d'identifiant de connexion</h3>
<div id="resultat_obs">
<p>Les données obligatoires sont précédées d'un astérisque *</p>
<table border="0" align="center" width="100%">
	<tr>
		<td width="50%" rowspan="2">
			<div id="errorFormInscription"></div>
			<div class="inscription" id="divFormInscription">
				<table border="0" width="100%">
					<tr>
						<th align="right" width="50%">
							*Vous êtes : 
						</th>
						<td align="center" width="50%">
							<?php echo simpleDisplaySelect2($listeTypeStrucutre, 'type_structure', 'ID', 'TYPE', '', 'afficher_masquer("typestrucutre","")', ''); ?>
						</td>								
					</tr>
					
					<tr>
						<td colspan="2">
							<div style="display:inline"  id="type_strucutre">
								<table width="100%">
									<tr>
										<th align="right" width="50%">
											*Nom de votre structure : 
										</th>
										<td align="center" width="50%">
											<input style="width:90%;" type="text" name="nom_structure" id="nom_structure" value="" />
										</td>
									</tr>
									
									<tr>
										<th align="right" width="50%">
											*Choix de votre logo : 
										</th>
										<td align="center" width="50%">
											<table width="90%" border="0">
												<tr align="center">
													<td  width="70%" >
														<div class="logostructure">
														<p class="hint">Si votre logo n'est pas présent dans la liste, merci de choisir le </br>logo intitulé "1_NON_DISPONIBLE". Nous effectuerons la mise à <br/>jour lors de votre inscription.</p>
															<input style="width:100%"  type="text" id="Fichier"/>
														</div>
													</td>
													<td  width="30%" >
														<img src="../img/parcourir.png" onclick="affichage_popup_parcourir(event)"/>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</div>
						</td>	
					</tr>
					<tr>
						<td colspan="2">
							<div style="display:none"  id="particulier">
								<table width="100%">
									<tr>	
										<th align="right" width="50%">
											*Nom : 
										</th>
										<td align="center" width="50%">
											<input style="width:90%;" type="text" name="nom_particulier" id="nom_particulier" value="" />
										</td>
									</tr>
									
									<tr>	
										<th align="right" width="50%">
											*Prénom : 
										</th>
										<td align="center" width="50%">
											<input style="width:90%;" type="text" name="prenom_particulier" id="prenom_particulier" value="" />
										</td>
									</tr>
								</table>
							</div>
						</td>	
					</tr>
					
					<tr>
						<th align="right" width="50%">
							*Créer votre identifiant de connexion :
						</th>
						<td align="center" width="50%">
							<div class="idconnexion">
								<p class="hint">L'identifiant de connexion ne doit pas contenir d'espace. <br/> Il ne peux contenir que des chiffres et lettres, majuscules ou minuscule.</p>
								<input style="width:90%;" type="text" name="id_session" id="id_session" value="" onblur="verifIdentifiant(this);RecAttribut('identifiant/verifidentifiant.php','errorFormInscription','VerifIDConnexion')" />
							</div>
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%">
							*Email :
						</th>
						<td align="center" width="50%">
							<input style="width:90%;" type="text" name="email" id="email" value="" onblur="verifEmail(this)"/>
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%">
							*Département : 
						</th>
						<td align="center" width="50%">
							<input style="width:90%;" type="text" name="departement" id="departement" value="" onblur="verifDepartement(this)"/>
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%">
							*Adresse postale complète : 
						</th>
						<td align="center" width="50%">
							<textarea style="width:90%;" rows="5" name="adresse" id="adresse"></textarea>
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%">
							*Téléphone :
						</th>
						<td align="center" width="50%">
							<input style="width:90%;" type="text" name="telephone" id="telephone" value="" onblur="verifTelephone(this)" />
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%">
							Merci de cocher la case qui indique que vous avez pris <a href="../doc/CGU_APIPRAM.pdf" target="_bank">connaissances des conditions générales d'utilisation du site</a>
						</th>
						<td align="center" width="50%">
							<input style="width:90%;" type="checkbox" name="condition" id="condition" value="1" onblur="verifCondition(this)"/>
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%">
							*Mot de passe :
						</th>
						<td align="center" width="50%">
							<input style="width:90%;" type="password" name="mdp" id="mdp" value="" />
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%">
							*Confirmation mot de passe :
						</th>
						<td align="center" width="50%">
							<input style="width:90%;" type="password" name="mdp_confirmation" id="mdp_confirmation" value="" onblur="verifmdp(this)"/>
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%">
							*Entrer le code d'approbation
						</th>
						<td align="center" width="50%">
							<img src="identifiant/captcha_code_file.php?rand=<?php echo rand(); ?>&code=<?php echo $code; ?>" id='captchaimg' ><br><br>
							
							<input style="width:90%;" id="captcha" name="captcha" type="text" onblur="verifcaptcha(this,'<?php echo $code?>')"><br>
							<small>Impossible de lire ? Cliquez <a onClick="refreshCaptcha('<?php echo captcha()?>')"><b>ici</b></a> pour rafraichir</small>
						</td>								
					</tr>
					
					<tr>
						<th align="right" width="50%"></th>
						<td align="center" width="50%">
							<input type="Button" value="Envoyer" onClick="verifForm('identifiant/error.php','resultat_obs','<?php echo $code; ?>','identifiant');"></input>
						</td>								
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
</div>
</div>
<div id="piedaffichage">
	<table align="center" width="100%" border="0">
		<tr>
			<td>
				<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</div>
