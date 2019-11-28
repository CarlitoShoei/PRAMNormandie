<?php
	header( 'content-type: text/html; charset=utf-8' );
	header('Content-type: text/html; charset=iso8859-1');
	include '../../function.php';
	//Declare le code pour le captcha
	$code = captcha();
?>
<div id="textafficahge">
<img id="close" src="../img/delete.png" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')"/>
<h3>Mot de passe perdu</h3>
<div id="resultat_obs">
	<table class="contact" border="0" align="center" width="90%" height="80%">
		<tr>
			<td width="100%">
				<div id="errorFormMdpPerdu"></div>
				<div class="inscription" id="divFormMdpPerdu">
					<table border="0" width="100%">
						<tr>
							<th align="right" width="25%">
								Identifiant de connexion*
							</th>
							<td align="center" width="75%">
								<input style="width:90%;" type="text" name="id_session" id="id_session" value="" onblur="verifIdentifiant(this)" />
							</td>								
						</tr>
						
						<tr>
							<th align="right" width="25%">
								Email*
							</th>
							<td align="center" width="75%">
								<input style="width:90%;" type="text" name="email" id="email" value="" onblur="verifEmail(this)"/>
							</td>								
						</tr>
						
						<tr>
							<th align="right" width="25%">
								Entrer le code d'approbation
							</th>
							<td align="center" width="75%">
								<img src="identifiant/captcha_code_file.php?rand=<?php echo rand(); ?>&code=<?php echo $code; ?>" id='captchaimg' ><br><br>
								
								<input style="width:90%;" id="captcha" name="captcha" type="text" onblur="verifcaptcha(this,'<?php echo $code?>')"><br>
								<small>Impossible de lire ? Cliquez <a onClick="refreshCaptcha()">ici</a> pour rafraichir</small>
							</td>								
						</tr>
						
						<tr>
							<th align="right" width="25%"></th>
							<td align="center" width="75%">
								<input type="Button" value="Envoyer" onClick="verifForm('identifiant/error.php','errorFormMdpPerdu','<?php echo $code; ?>','Mdp')"></input>
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
				<!--<fieldset class="pied_popup" align="center">
					<table align="center" border="0">
						<tr>
							<td width="30" align="center">
								<img src="../img/delete.png" width="20" Title="Fermer" OnClick="afficher_masquer('affichage','affichage_vide.php')">
							</td>
						</tr>
					</table>
				</fieldset>-->
			</td>
		</tr>
	</table>
</div>