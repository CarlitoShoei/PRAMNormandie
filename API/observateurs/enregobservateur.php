<?php
	ini_set("display_errors",1);
	include '../../bdd.php';
	include_once '../../function.php';

	
		//On recupere la variable TYPE
		if(isset($_GET['TYPE'])){
			$TYPE = $_GET['TYPE'];
		}
		
		if($TYPE == "observateur"){
			if(!isset($MOD)){
				//ON RECUPERE LES VARAIBLE
				$OBS_NOM = $_GET['OBS_NOM'];
				$OBS_PRENOM = $_GET['OBS_PRENOM'];
				$OBS_STRUCTURE = $_GET['OBS_STRUCTURE'];
				
				// requete mysql pour l'insertion :
				//CREER LA REQUETE DANS UNE VARIABLE A PART
				$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.observateur("OBS_NOM", "OBS_PRENOM", "OBS_NOM_PRENOM", "OBS_STRUCTURE") VALUES(E'."'".utf8_encode(addslashes(strtoupper($OBS_NOM)))."'".', E'."'".utf8_encode(addslashes(ucfirst($OBS_PRENOM)))."'".', E'."'".utf8_encode(addslashes(strtoupper($OBS_NOM)))." ".utf8_encode(addslashes(ucfirst($OBS_PRENOM)))."'".', E'."'".addslashes($OBS_STRUCTURE)."'".')');
		
			};
			//ON AFFICHE LE RESULTAT DANS LA DIV
			$req = pg_query($bdd, 'SELECT * FROM saisie_observation.observateur WHERE "OBS_STRUCTURE"=E'."'".addslashes($OBS_STRUCTURE)."'".' ORDER BY "ID" DESC');
			
			?>
			<div id="resultat">
			<table>
				<?php
				$i=1;
				while ($donnees = pg_fetch_array($req))
				{
				$style= ($i%2) ? "stryleattribut" : "stryleattribut2";	
				?>
					<tr height="30" class="<?php echo $style ?>"> 
						<td align="center" width="25%"><?php echo stripslashes($donnees['OBS_NOM']);?></td>
						<td align="center" width="25%"><?php echo stripslashes($donnees['OBS_PRENOM']);?></td>
						<td align="center" width="25%"><?php echo stripslashes($donnees['OBS_STRUCTURE']);?></td>
						<td align="center" width="25%"></td>
					</tr>
				<?php
				$i++;
				}
				?>
			</table>
			</div>
			<?php
		}
			?>