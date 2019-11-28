<?php
date_default_timezone_set('Europe/Paris');
function simpleDisplayDepartement($data, $nom, $value, $option, $selected, $onChange, $tabindex, $onfocus){
	$outPut = "";
	$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' onfocus='".$onfocus."' tabindex='".$tabindex."'>";
	$outPut .= "<option value='0'>Département</option>";
	
		foreach($data as $ligne){
		// WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".$ligne[$value]."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= $ligne[$option];
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return utf8_encode($outPut);
	// return $test;
}

function simpleDisplayIntercommunalite($data, $nom, $value, $option, $selected, $onChange, $tabindex){
	$outPut = "";
	$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."'>";
	$outPut .= "<option value='0'>Intercommunalité</option>";
	
		foreach($data as $ligne){
		// WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".$ligne[$value]."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= utf8_decode($ligne[$option]);
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return utf8_encode($outPut);
	// return $test;
}

function simpleDisplayCommune($data, $nom, $value, $option, $selected, $onChange, $tabindex){
	$outPut = "";
	$outPut .= "<select style='width:90%;overflow:hidden' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."'>";
	$outPut .= "<option value='0'>Commune</option>";
	
		foreach($data as $ligne){
		// WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".$ligne[$value]."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= $ligne[$option];
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return $outPut;
	// return $test;
}
	
function simpleDisplayMare($data, $nom, $value, $option, $selected, $onChange, $tabindex){
	$outPut = "";
	$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."'>";
	$outPut .= "<option value='0'>Mare</option>";
	
		foreach($data as $ligne){
		// WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".$ligne[$value]."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= $ligne[$option];
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return $outPut;
	// return $test;
}
	
function simpleDisplaySelect($data, $nom, $value, $option, $selected, $onChange, $tabindex){
		$outPut = "";
		$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."'>";
		$outPut .= "<option value='0'>A Saisir</option>";
		
			foreach($data as $ligne){
			// WHILE... YA DES LIGNES DANS LE $DATA
				$outPut .= "<option value='".$ligne[$value]."' ";
				if($ligne[$value] == $selected){
					$outPut .= "selected>";
				}else{
					$outPut .= ">";
				};
				$outPut .= $ligne[$option];
				$outPut .= "</option>";
			}
			///FIN WHILE		
		$outPut .= "</select>";
		
		return $outPut;
		// return $test;
	}
	
function simpleDisplaySelectOnBlur($data, $nom, $value, $option, $selected, $onChange, $tabindex, $onBlur){
		$outPut = "";
		$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."' onBlur='".$onBlur."'>";
		$outPut .= "<option value='0'>A Saisir</option>";
		
			foreach($data as $ligne){
			// WHILE... YA DES LIGNES DANS LE $DATA
				$outPut .= "<option value='".$ligne[$value]."' ";
				if($ligne[$value] == $selected){
					$outPut .= "selected>";
				}else{
					$outPut .= ">";
				};
				$outPut .= $ligne[$option];
				$outPut .= "</option>";
			}
			///FIN WHILE		
		$outPut .= "</select>";
		
		return $outPut;
		// return $test;
	}	

function simpleDisplaySelectDisabled($data, $nom, $value, $option, $selected, $onChange, $tabindex, $disabled){
		$outPut = "";
		$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."' disabled='".$disabled."'>";
		$outPut .= "<option value='0'>A Saisir</option>";
		
			foreach($data as $ligne){
			// WHILE... YA DES LIGNES DANS LE $DATA
				$outPut .= "<option value='".$ligne[$value]."' ";
				if($ligne[$value] == $selected){
					$outPut .= "selected>";
				}else{
					$outPut .= ">";
				};
				$outPut .= $ligne[$option];
				$outPut .= "</option>";
			}
			///FIN WHILE		
		$outPut .= "</select>";
		
		return $outPut;
		// return $test;
	}	
	
function simpleDisplaySelectDisabledOnBlur($data, $nom, $value, $option, $selected, $onChange, $tabindex, $disabled, $onBlur){
		$outPut = "";
		$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."' disabled='".$disabled."' onBlur='".$onBlur."'>";
		$outPut .= "<option value='0'>A Saisir</option>";
		
			foreach($data as $ligne){
			// WHILE... YA DES LIGNES DANS LE $DATA
				$outPut .= "<option value='".$ligne[$value]."' ";
				if($ligne[$value] == $selected){
					$outPut .= "selected>";
				}else{
					$outPut .= ">";
				};
				$outPut .= $ligne[$option];
				$outPut .= "</option>";
			}
			///FIN WHILE		
		$outPut .= "</select>";
		
		return $outPut;
		// return $test;
	}	
	
function simpleDisplaySelect2($data, $nom, $value, $option, $selected, $onChange, $tabindex){
	$outPut = "";
	$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."'>";
	// $outPut .= "<option value='Tous'>A Saisir</option>";
	
		foreach($data as $ligne){
		//WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".$ligne[$value]."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= $ligne[$option];
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return $outPut;
}	

function simpleDisplaySelectmodule($data, $nom, $value, $option, $selected, $onChange, $tabindex){
	$outPut = "";
	$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."'>";
	// $outPut .= "<option value='Tous'>A Saisir</option>";
	
		foreach($data as $ligne){
		//WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".str_replace("|", "'", $ligne[$value])."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= $ligne[$option];
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return $outPut;
}	

function simpleDisplaySelect2OnBlur($data, $nom, $value, $option, $selected, $onChange, $tabindex, $onBlur){
	$outPut = "";
	$outPut .= "<select style='width:90%' id='".$nom."'  name='".$nom."' onChange='".$onChange."' tabindex='".$tabindex."' onBlur='".$onBlur."'>";
	// $outPut .= "<option value='Tous'>A Saisir</option>";
	
		foreach($data as $ligne){
		//WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".$ligne[$value]."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= $ligne[$option];
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return $outPut;
}	
	
function simpleDisplaySelectAffichage($data, $nom, $value, $option, $selected, $onChange, $tabindex, $id){
	$outPut = "";
	$outPut .= "<select style='width:90%' id='".$id."'  name='".$id."' onChange='".$onChange."' tabindex='".$tabindex."'>";
	// $outPut .= "<option value='Tous'>A Saisir</option>";
	
		foreach($data as $ligne){
		//WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".$ligne[$value]."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= $ligne[$option];
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return $outPut;
}

function simpleDisplaySelectAffichage2($data, $nom, $value, $option, $selected, $onChange, $tabindex, $id){
	$outPut = "";
	$outPut .= "<select style='width:90%' id='".$id."'  name='".$id."' onChange='".$onChange."' tabindex='".$tabindex."'>";
	$outPut .= "<option value='Tous'>A Saisir</option>";
	
		foreach($data as $ligne){
		//WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<option value='".$ligne[$value]."' ";
			if($ligne[$value] == $selected){
				$outPut .= "selected>";
			}else{
				$outPut .= ">";
			};
			$outPut .= $ligne[$option];
			$outPut .= "</option>";
		}
		///FIN WHILE		
	$outPut .= "</select>";
	
	return $outPut;
}	

function simpleDisplayCheckBox($data, $nom, $value, $option, $selected, $tabindex, $typetableau, $idcarac, $bdd, $div, $typeCheck, $typeOutCheck){
	$outPut = "";
	// $outPut .= "<select style='width:90%' id='".$id."'  name='".$id."' onChange='".$onChange."' tabindex='".$tabindex."'>";
	$outPut .= "<table style='width:90%' class='context'>";
	
		foreach($data as $ligne){
		//requete SQL pour redéfinir le selected
			if($div == 'context_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_context WHERE "ID_CARAC" = '.$idcarac.' AND "CONTEXT"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['CONTEXT'];
			}elseif($div == 'patrimoine_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_patrimoine WHERE "ID_CARAC" = '.$idcarac.' AND "PATRIMOINE"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['PATRIMOINE'];
			}elseif($div == 'liaison_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_liaison WHERE "ID_CARAC" = '.$idcarac.' AND "LIAISON"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['LIAISON'];
			}elseif($div == 'alimentation_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_alimentation WHERE "ID_CARAC" = '.$idcarac.' AND "ALIMENTATION"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['ALIMENTATION'];
			}elseif($div == 'faune_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_faune WHERE "ID_CARAC" = '.$idcarac.' AND "FAUNE"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['FAUNE'];
			}elseif($div == 'autespeces_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_autespeces WHERE "ID_CARAC" = '.$idcarac.' AND "AUTESPECES"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['AUTESPECES'];
			}elseif($div == 'dechets_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_dechets WHERE "ID_CARAC" = '.$idcarac.' AND "DECHETS"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['DECHETS'];
			}elseif($div == 'usage_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_usage WHERE "ID_CARAC" = '.$idcarac.' AND "C_USAGE"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['C_USAGE'];
			}elseif($div == 'travaux_resultat'){
				$sql = 'SELECT * FROM saisie_observation.caracterisation_travaux WHERE "ID_CARAC" = '.$idcarac.' AND "TRAVAUX"='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['TRAVAUX'];
			}elseif($div == 'symptome_resultat'){
				$sql = 'SELECT * FROM module_pram.smbvpc_mod1_symptome WHERE l_id = '."'".$idcarac."'".' AND symptome='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['symptome'];
			}elseif($div == 'context_amont_resultat'){
				$sql = 'SELECT * FROM module_pram.smbvpc_mod1_context_amont WHERE l_id = '."'".$idcarac."'".' AND contexte_amont='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['contexte_amont'];
			}elseif($div == 'context_rapproche_resultat'){
				$sql = 'SELECT * FROM module_pram.smbvpc_mod1_context_rapproche WHERE l_id = '."'".$idcarac."'".' AND contexte_rapproche='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['contexte_rapproche'];
			}elseif($div == 'context_aval_resultat'){
				$sql = 'SELECT * FROM module_pram.smbvpc_mod1_context_aval WHERE l_id = '."'".$idcarac."'".' AND contexte_aval='.$ligne[$value].'';
				$rq = pg_query($bdd, $sql);
				$result = pg_fetch_array($rq);
				$selected = $result['contexte_aval'];
			}
			
			
		//WHILE... YA DES LIGNES DANS LE $DATA
			$outPut .= "<tr align='left'>";
			$outPut .= "<td>";
			$outPut .= "<label id='Label_".$nom."_".$ligne[$value]."'>";
			$outPut .= "<input type='checkbox' id='".$nom."_".$ligne[$value]."' name='".$nom."' value='".$ligne[$value]."' tabindex='".$tabindex."' ";
			if($ligne[$value] == $selected){ 
				$outPut .= "checked ";
			};
			$outPut .= "onClick=";
			if($ligne[$value] == $selected){ 
				if($typetableau == "TypeTableau"){
					$outPut .= "RecAttribut('mare/enregmare.php?ID=".$ligne[$value]."','".$div."','".$typeCheck."','TypeTableau')";
				}else if($typetableau == "module"){
					$outPut .= "RecAttribut('../mare/enregmare.php?ID=".$ligne[$value]."','".$div."','".$typeCheck."','module')";
				}else{
					$outPut .= "RecAttribut('mare/enregmare.php?ID=".$ligne[$value]."','".$div."','".$typeCheck."')";
				}
						if($div == 'liaison_resultat'){
							$outPut .= ";afficher_masquer('liaison','".$ligne[$value]."')";
						}elseif($div == 'alimentation_resultat'){
							$outPut .= ";afficher_masquer('alimentation','".$ligne[$value]."')";
						}elseif($div == 'faune_resultat'){
							$outPut .= ";afficher_masquer('faune_resultat','".$ligne[$value]."')";
						}elseif($div == 'travaux_resultat'){
							$outPut .= ";afficher_masquer('travaux','".$ligne[$value]."')";
						}elseif($div == 'context_amont_resultat'){
							$outPut .= ";afficher_masquer('context_amont','".$ligne[$value]."')";
						}elseif($div == 'context_rapproche_resultat'){
							$outPut .= ";afficher_masquer('context_rapproche','".$ligne[$value]."')";
						}elseif($div == 'patrimoine_resultat'){
							$outPut .= ";afficher_masquer('patrimoine','".$ligne[$value]."')";
						}
						
			}else{
				if($typetableau == "TypeTableau"){
					$outPut .= "RecAttribut('mare/enregmare.php?ID=".$ligne[$value]."','".$div."','".$typeOutCheck."','TypeTableau')";
				}else if($typetableau == "module"){
					$outPut .= "RecAttribut('../mare/enregmare.php?ID=".$ligne[$value]."','".$div."','".$typeOutCheck."','module')";
				}else{
					$outPut .= "RecAttribut('mare/enregmare.php?ID=".$ligne[$value]."','".$div."','".$typeOutCheck."')";
				}
						if($div == 'liaison_resultat'){
							$outPut .= ";afficher_masquer('liaison','".$ligne[$value]."')";
						}elseif($div == 'alimentation_resultat'){
							$outPut .= ";afficher_masquer('alimentation','".$ligne[$value]."')";
						}elseif($div == 'faune_resultat'){
							$outPut .= ";afficher_masquer('faune_resultat','".$ligne[$value]."')";
						}elseif($div == 'travaux_resultat'){
							$outPut .= ";afficher_masquer('travaux','".$ligne[$value]."')";
						}elseif($div == 'context_amont_resultat'){
							$outPut .= ";afficher_masquer('context_amont','".$ligne[$value]."')";
						}elseif($div == 'context_rapproche_resultat'){
							$outPut .= ";afficher_masquer('context_rapproche','".$ligne[$value]."')";
						}elseif($div == 'patrimoine_resultat'){
							$outPut .= ";afficher_masquer('patrimoine','".$ligne[$value]."')";
						}
			};
			$outPut .= ">";
			$outPut .= "</label>";
			$outPut .= "</td>";
			$outPut .= "<th>";
			$outPut .= $ligne[$option];
			$outPut .= "</th>";
			$outPut .= "</tr>";
		}
		///FIN WHILE		
	$outPut .= "</table>";
	
	return $outPut;
}	
	
//FONCTION PERMETTANT DE TROUVER LE NUMERO INSEE DE LA COMMUNE OU ON EST
function insseCommune($bdd, $Longitude, $Latitude){
	$numInsee = pg_query($bdd, 'SELECT * FROM ign_bd_topo.commune WHERE st_intersects(st_transform(commune.geom,4326),st_setsrid(st_makepoint('."'".$Longitude."'".','."'".$Latitude."'".'),4326))'); 
	$donnee = pg_fetch_array($numInsee);
	$INSEE = $donnee["Num_INSEE"];
	return $INSEE;
}

//PERMET DE TRANSFORMER LES COORDONNER WGS84 en LAMBERT93
function ConvertCoord($CoordX, $CoordY, $TypeCoord){
	$a = 6378137; //demi grand axe de l'ellipsoide  (m)
	$e = 0.081819190842622; //première excentricité de l'ellipsoide	
	
	//varaible
	$l0 = $lc = deg2rad(3);
	$phi0 = deg2rad(46.5); //latitude d'origine
	$phi1 = deg2rad(44); //1er parrallele automécoique
	$phi2 = deg2rad(49); //2er parrallele automécoique
	$x0 = 700000; //coordonners à l'origine
	$y0 = 6600000; //coordonnées à l'origine
	
	$phi=deg2rad($CoordY); //latitude radian
	$l=deg2rad($CoordX); //longitude radian
	
	//calcul des grandre normales nommée r1 et r2
	$r1=$a/sqrt(1-$e*$e*sin($phi1)*sin($phi1));//ok
	$r2=$a/sqrt(1-$e*$e*sin($phi2)*sin($phi2));//ok
	
	//calculs des latitudes isométriques
	$gl1=log(tan(pi()/4+$phi1/2)*pow((1-$e*sin($phi1))/(1+$e*sin($phi1)),$e/2));//ok
	$gl2=log(tan(pi()/4+$phi2/2)*pow((1-$e*sin($phi2))/(1+$e*sin($phi2)),$e/2));//ok
	$gl0=log(tan(pi()/4+$phi0/2)*pow((1-$e*sin($phi0))/(1+$e*sin($phi0)),$e/2));//ok
	$gl=log(tan(pi()/4+$phi/2)*pow((1-$e*sin($phi))/(1+$e*sin($phi)),$e/2));//ok
	
	//calcul de l'exposant de la projection
	$n=(log(($r2*cos($phi2))/($r1*cos($phi1))))/($gl1-$gl2);
	
	//calcul de la constante de projection
	$c=(($r1*cos($phi1))/$n)*exp($n*$gl1);
		
	//calcul des coordonnées
	$xs = $x0;
	$ys=$y0+$c*exp(-1*$n*$gl0);
	
	
	if($TypeCoord == "X"){
		$x93=$x0+$c*exp(-1*$n*$gl)*sin($n*($l-$lc));
		return $x93;
	}elseif($TypeCoord == "Y"){
		$y93=$ys-$c*exp(-1*$n*$gl)*cos($n*($l-$lc)); 	
		return $y93;
	}
}
//PERMET DE TRANSFORMER LES COORDONNER L93 en WGS84
function ConvertCoordWGS84($CoordX, $CoordY, $TypeCoord){
	//varaibles
	$a = 6378137; //demi grand axe de l'ellipsoide  (m)
	$e = 0.081819190842622; //première excentricité de l'ellipsoide	
		
		$l0 = 3;
	$phi0 = deg2rad(46.5); //latitude d'origine
	$phi1 = deg2rad(44); //1er parrallele automécoique
	$phi2 = deg2rad(49); //2er parrallele automécoique
	$x0 = 700000; //coordonners à l'origine
	$y0 = 6600000; //coordonnées à l'origine
	$ys = 12655612.049876;
	$c = 11754255.4261;
	$n = 0.725607765053267;
	
		
	//calcul de deltaX deltaY
	$delX = $CoordX-$x0; //delta X
	$delY = $CoordY-$ys; //delta Y
	//Calcul de gamma
	$gamma = atan(-1*$delX/$delY);
	//calcul de R
	$r = sqrt($delX*$delX+$delY*$delY);
	//calcul des latitudes isométrique
	$gl1 = log($c/$r)/$n;
	//calcul des sin phi it0 --> 6
	$phiit0 = tanh($gl1+$e*atanh($e*sin(1))); //it0
	$phiit1 = tanh($gl1+$e*atanh($e*$phiit0)); //it1
	$phiit2 = tanh($gl1+$e*atanh($e*$phiit1)); //it2
	$phiit3 = tanh($gl1+$e*atanh($e*$phiit2)); //it3
	$phiit4 = tanh($gl1+$e*atanh($e*$phiit3)); //it4
	$phiit5 = tanh($gl1+$e*atanh($e*$phiit4)); //it5
	$phiit6 = tanh($gl1+$e*atanh($e*$phiit5)); //it6
	//calcul longitude radian
	$lng = $gamma/$n+$l0/180*pi();
	//calcul latitude radian 
	$lat = asin($phiit6);
	
	if($TypeCoord == "X"){
		$longitude = $lng/pi()*180;
		return $longitude;
	}elseif($TypeCoord == "Y"){
		$latitude = $lat/pi()*180;
		return $latitude;
	}

}


function createMare($bdd){
	//Déclaration d'une variable pour la création d'un enregistrement
	$L_NOM='NEW';
	$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.localisation("L_NOM") VALUES('."'".$L_NOM."'".')'); 
	
	$rq_ID = 'SELECT max("ID") AS "ID" FROM saisie_observation.localisation';
	$req_ID = pg_query($bdd, $rq_ID);
	$donnees_ID = pg_fetch_array($req_ID);
	$ID = $donnees_ID["ID"];
	
	return $ID;
}


function transfDate($Date){
	$temp = array();
	$temp = explode("/", $Date);
	$L_DATE = mktime((int)0,(int)0,(int)0,(int)$temp[1],(int)$temp[0],(int)$temp[2]);
	
	return $L_DATE;
}

function captcha(){
	//Settings: You can customize the captcha here
	$characters_on_image = 6;
	// $font = 'img/monofont.ttf';

	//The characters that can be used in the CAPTCHA code.
	//avoid confusing characters (l 1 and i for example)
	$possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
	$random_dots = 0;
	$random_lines = 20;
	$captcha_text_color="0x142864";
	$captcha_noice_color = "0x142864";

	$code = '';


	$i = 0;
	while ($i < $characters_on_image) { 
	$code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
	$i++;
	}
	return $code;
}

function stripAccents($string){
	return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

function SplitPosition($latLng,$Type_Coord){
	$temp = array();
	$temp = explode(", ", $latLng);
	$L_COOX = $temp[1];
	$L_COOY = $temp[0];
	
	if($Type_Coord == "Lat"){
		return $L_COOY;
	}else if($Type_Coord == "Lng"){
		return $L_COOX;
	}
}

function generatorIdentifiantMare($INSEE,$bdd){
	//On va faire une requete sur la table de localisation des mare pour voir combien il existe de mare ayant ce numéro INSEE
	//on vérifie ensuite si la journée n'est pas prise par une RTTE
	$event_exist = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE "L_ADMIN" = '."'".$INSEE."'".'');
	$count = pg_num_rows($event_exist);
	// pg_close($event_exist);
	
	
	//ON VA GENERER LIDENTIFIANT AUTOMATIQUEMENT
	if($count == 0){
		$count = $count + 1;
	}
	$Identifiant_Mare = $INSEE."_".$count;
	
	//ON VA VERIFIER SI L4IDENTIFIANT NEXISTE PAS
	$rq_verif = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE "L_ID" = '."'".$Identifiant_Mare."'".'');
	$verif = pg_num_rows($rq_verif);
	// $rq_verif->closeCursor();
	
	if($verif == 1){
		$i = 1;
		while($i <> 0){
			$count = $count + 1;
			$Identifiant_Mare = $INSEE."_".$count;
			
			$rq_verif2 = pg_query($bdd, 'SELECT * FROM saisie_observation.localisation WHERE "L_ID" = '."'".$Identifiant_Mare."'".'');
			$i = pg_num_rows($rq_verif2);
			// $rq_verif2->closeCursor();
		}	
				
		return $Identifiant_Mare;
	}else{
		return $Identifiant_Mare;
	}

}

function ajoutCaracteristique($bdd,$L_ID){
	//Déclaration d'une variable pour la création d'un enregistrement
	$L_NOM="NEW";
	$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.caracterisation("L_ID") VALUES('."'".$L_ID."'".')');
	
	$req_ID = pg_query($bdd, 'SELECT max("ID_CARAC") AS "ID_CARAC" FROM saisie_observation.caracterisation');
	$donnees_ID = pg_fetch_array($req_ID);
	$ID_CARAC = $donnees_ID['ID_CARAC'];
	
	return $ID_CARAC;
}

function VerifCoordCom($CoordX,$CoordY,$INSEE,$bdd,$SysCoord){
	if($SysCoord == 'LatLng'){
		//ON TRANSFORME LES COORDON2ES DU POINT DORIGINE EN LAMBERT 93
		$CoordXL93 = ConvertCoord(floatval($CoordX), floatval($CoordY), 'X');
		$CoordYL93 = ConvertCoord(floatval($CoordX), floatval($CoordY), 'Y');
				
		
	}elseif($SysCoord = 'L93'){
		$CoordXL93 = $CoordX;
		$CoordYL93 = $CoordY;
		
		
	}
	
	//ON FAIT UNE REQUETE POUR SAVOIR SI LES COORDONNER SONT DANS LA COMMUNE
	$intersect = pg_query($bdd, 'SELECT * FROM ign_bd_topo.commune WHERE st_intersects(st_transform(commune.geom,2154),st_setsrid(st_makepoint('."'".$CoordXL93."'".','."'".$CoordYL93."'".'),2154)) AND commune."Num_INSEE"='."'".$INSEE."'".''); 
	$count = pg_num_rows($intersect);
	if($count > 0){
		$msg = "<p style='color:green'><b>Les coordonnées saisies sont comprises dans la commune spécifiée</b></p>";
	}else{
		$msg = "<p style='color:red'><b>Les coordonnées saisies ne sont pas comprises dans la commune spécifiée</b></p>";
	}
	
	return $msg;
}



function VerifCoordCombeta($CoordX,$CoordY,$INSEE,$bdd,$SysCoord){
	//ON VA VERIFIER SI LE POINT EST DANS LE POLYGONE
	//POUR CHAQUE COTER DU POLYGONE ON VA CALCULER LE POINT D'INTERSECTION AVEC LA DROITE FORMER PAR LE SOMMET DU POLYGON ET UNE DROITE FORMER ENTRE LE POINT D'ORIGINE ET UN POINT SITUER EN ALSACE
	//LES COORDONEES DU POINT EN ALSACE SONT (COORDONNES DE STRASBOURG EN L93)
	$CoordXAlsace = 1049492.55;
	$CoordYAlsace = 6841929.79;
	$nbintersection = 0;
	
	if($SysCoord == 'LatLng'){
		//ON TRANSFORME LES COORDON2ES DU POINT DORIGINE EN LAMBERT 93
		$CoordXL93 = ConvertCoord(floatval($CoordX), floatval($CoordY), 'X');
		$CoordYL93 = ConvertCoord(floatval($CoordX), floatval($CoordY), 'Y');
	}elseif($SysCoord = 'L93'){
		$CoordXL93 = $CoordX;
		$CoordYL93 = $CoordY;
	}
	
	//ON CALCULE LEQUATION REDUITE DE LA DROITE DU SOMMET
	//y' = mbis * x' + pbis ou m est le coefficient directeur et p l'ordonnées à l'origine
	$mbis = ($CoordYAlsace - $CoordYL93) / ($CoordXAlsace - $CoordXL93);
	//p = Ya - m * Xa
	$pbis = $CoordYL93 - $mbis * $CoordXL93;
	
	//ON VA FAIRE UNE REQUETTE QUE LA COMMUNE POUR R2CUP2RER LES COORDONN2ERS DES SOMMET
	$Commune = pg_query($bdd, 'SELECT * FROM pram_commune_spatial WHERE INSEE="'.$INSEE.'" ORDER BY ID'); 
	//Boucle
	//ON VA INCREMENTER IN NOMBRE
	$i = 1;
	while($donnee = $Commune->fetch()){
		$CoordXSommetL93 = ConvertCoord(floatval($donnee['Longitude']), floatval($donnee['Latitude']), 'X');
		$CoordYSommetL93 = ConvertCoord(floatval($donnee['Longitude']), floatval($donnee['Latitude']), 'Y');
		
		//ON VA COMPTER LE NOMBRE D'ENREGISTREMENT PAR COMMUNE
		$ReqCountID = pg_query($bdd, 'SELECT * FROM pram_commune_spatial WHERE INSEE="'.$donnee['INSEE'].'" ORDER BY ID'); 
		$CountID = $ReqCountID->rowCount();
		
		//SI $i EGALE 1 ALORS ON RETIENS LE PREMIER ID
		if($i == 1){
			$FistID = $donnee['ID'];
			$LastID = $CountID + $donnee['ID'] - 1;
		}
		
		//ON DETERMINE LID DU SOMMET SUIVANT
		if(($donnee['ID']) == $LastID){
			$IDSuiv = $FistID;
		}else{
			$IDSuiv = ($donnee['ID'] + 1);
		}
			//ON VA ALLER CHERCHER LES COORDOONER DU PROCHAINE SOMMET DONC ON FAIS UNE REQUETE
			$SommetProchain = pg_query($bdd, 'SELECT * FROM pram_commune_spatial WHERE INSEE="'.$donnee['INSEE'].'" AND ID = "'.$IDSuiv.'" ORDER BY ID'); 
			$donneeSommetProchain = $SommetProchain->fetch();
			
			
			//COORDONNES DU SOMMET SUIVANT
			$CoordXSommetSuivL93 = ConvertCoord(floatval($donneeSommetProchain['Longitude']), floatval($donneeSommetProchain['Latitude']), 'X');
			$CoordYSommetSuivL93 = ConvertCoord(floatval($donneeSommetProchain['Longitude']), floatval($donneeSommetProchain['Latitude']), 'Y');
	
		if($CoordXSommetSuivL93 <> $CoordXSommetL93 AND $CoordYSommetSuivL93 <> $CoordYSommetL93){
			// echo $FistID."<br/>".$LastID."<br/>".$CountID."<br/>".$donnee['ID']."<br/>".$IDSuiv."<br/>".$CoordXSommetL93."<br/>".$CoordYSommetL93."<br/>".$CoordXSommetSuivL93."<br/>".$CoordYSommetSuivL93."<br/><br/>";
			//ON CALCULE LEQUATION REDUITE DE LA DROITE DU SOMMET
			//y = mx + p ou m est le coefficient directeur et p l'ordonnées à l'origine
			//donc m = (Yb - Ya) / (Xb - Xa)
			$m = ($CoordYSommetSuivL93 - $CoordYSommetL93) / ($CoordXSommetSuivL93 - $CoordXSommetL93);
			//p = Ya - m * Xa
			$p = $CoordYSommetL93 - $m * $CoordXSommetL93;
			
			//MAINTENANT ON CALCULE LE POINT D'INTERSECTION ENTRE LES DEUX DROITES GRACE AUX DEUX EQUATION
			//ON DECLARE x ET y
			$x;
			$y;
			//POUR LA DROITE DU SOMMET ON A 
			// $y = $m * $x + $p
			//POUR LA DROITE AVEC LALSACE ON A
			// $y = $mbis * $x + $pbis
			//ON OBTIENT DONC 
			$x = ($p - $pbis) / ($mbis - $m);
			$y = $m * (($p - $pbis) / ($mbis - $m)) + $p;
			
			//ON VA VERIFIER SI LE POINT DINTERSECTION APPARTIEN AU SEGMENT DU COTER
			if(($x >= $CoordXSommetL93 AND $x <= $CoordXSommetSuivL93) AND ($y >= $CoordYSommetSuivL93 AND $y <= $CoordYSommetL93) AND ($x >= $CoordXL93)){
				$nbintersection = $nbintersection + 1;
			}elseif(($x <= $CoordXSommetL93 AND $x >= $CoordXSommetSuivL93) AND ($y >= $CoordYSommetSuivL93 AND $y <= $CoordYSommetL93) AND ($x >= $CoordXL93)){
				$nbintersection = $nbintersection + 1;
			}elseif(($x <= $CoordXSommetL93 AND $x >= $CoordXSommetSuivL93) AND ($y <= $CoordYSommetSuivL93 AND $y >= $CoordYSommetL93) AND ($x >= $CoordXL93)){
				$nbintersection = $nbintersection + 1;
			}elseif(($x >= $CoordXSommetL93 AND $x <= $CoordXSommetSuivL93) AND ($y <= $CoordYSommetSuivL93 AND $y >= $CoordYSommetL93) AND ($x >= $CoordXL93)){
				$nbintersection = $nbintersection + 1;
			}
		}	
		//INCREMENTATION
		$i++;		
	}
	
	if($nbintersection%2 == 1){
		$msg = "<p style='color:green'><b>Les coordonnées saisies sont comprises dans la commune spécifiée</b></p>";
	}else{
		$msg = "<p style='color:red'><b>Les coordonnées saisies ne sont pas comprises dans la commune spécifiée</b></p>";
	}
	
	// echo "<br/><br/><br/><br/>".$nbintersection;
	
	return $msg;
}	


function TrouveCom($CoordX,$CoordY,$bdd,$SysCoord){
	//ON VA VERIFIER SI LE POINT EST DANS LE POLYGONE
	//POUR CHAQUE COTER DU POLYGONE ON VA CALCULER LE POINT D'INTERSECTION AVEC LA DROITE FORMER PAR LE SOMMET DU POLYGON ET UNE DROITE FORMER ENTRE LE POINT D'ORIGINE ET UN POINT SITUER EN ALSACE
	//LES COORDONEES DU POINT EN ALSACE SONT (COORDONNES DE STRASBOURG EN L93)
	$CoordXAlsace = 1049492.55;
	$CoordYAlsace = 6841929.79;
	
	
	if($SysCoord == 'LatLng'){
		//ON TRANSFORME LES COORDON2ES DU POINT DORIGINE EN LAMBERT 93
		$CoordXL93 = ConvertCoord(floatval($CoordX), floatval($CoordY), 'X');
		$CoordYL93 = ConvertCoord(floatval($CoordX), floatval($CoordY), 'Y');
	}elseif($SysCoord = 'L93'){
		$CoordXL93 = $CoordX;
		$CoordYL93 = $CoordY;
	}
	
	//ON CALCULE LEQUATION REDUITE DE LA DROITE DU SOMMET
	//y' = mbis * x' + pbis ou m est le coefficient directeur et p l'ordonnées à l'origine
	$mbis = ($CoordYAlsace - $CoordYL93) / ($CoordXAlsace - $CoordXL93);
	//p = Ya - m * Xa
	$pbis = $CoordYL93 - $mbis * $CoordXL93;
	
	//ON VA CHERCHER DANS QUELLE EPCI EST LE POINT POUR DIMINUER A LA COMMUNE
	$EPCI = pg_query($bdd, 'SELECT NUM_FISCALITE FROM pram_epci_spatial GROUP BY NUM_FISCALITE ORDER BY NUM_FISCALITE'); 
	
	while($donnee_epci = $EPCI->fetch()){
		$nbintersection = 0;
		//ON VA FAIRE UNE REQUETTE QUE LA COMMUNE POUR R2CUP2RER LES COORDONN2ERS DES SOMMET
		$epci_spatial = pg_query($bdd, 'SELECT * FROM pram_epci_spatial WHERE NUM_FISCALITE = "'.$donnee_epci['NUM_FISCALITE'].'" ORDER BY ID'); 
		//Boucle
		$i = 1;
		while($donnee = $epci_spatial->fetch()){
			$CoordXSommetL93 = ConvertCoord(floatval($donnee['LONGITUDE']), floatval($donnee['LATITUDE']), 'X');
			$CoordYSommetL93 = ConvertCoord(floatval($donnee['LONGITUDE']), floatval($donnee['LATITUDE']), 'Y');
			
			//ON VA COMPTER LE NOMBRE D'ENREGISTREMENT PAR COMMUNE
			$ReqCountID = pg_query($bdd, 'SELECT * FROM pram_epci_spatial WHERE NUM_FISCALITE="'.$donnee['NUM_FISCALITE'].'" ORDER BY ID'); 
			$CountID = $ReqCountID->rowCount();
			
			//SI $i EGALE 1 ALORS ON RETIENS LE PREMIER ID
			if($i == 1){
				$FistID = $donnee['ID'];
				$LastID = $CountID + $donnee['ID'] - 1;
			}
			
			//ON DETERMINE LID DU SOMMET SUIVANT
			if(($donnee['ID']) == $LastID){
				$IDSuiv = $FistID;
			}else{
				$IDSuiv = ($donnee['ID'] + 1);
			}
			
			//ON VA ALLER CHERCHER LES COORDOONER DU PROCHAINE SOMMET DONC ON FAIS UNE REQUETE
			$SommetProchain = pg_query($bdd, 'SELECT * FROM pram_epci_spatial WHERE NUM_FISCALITE = "'.$donnee['NUM_FISCALITE'].'" AND ID = "'.$IDSuiv.'" ORDER BY ID'); 
			$donneeSommetProchain = $SommetProchain->fetch();
			//COORDONNES DU SOMMET SUIVANT
			$CoordXSommetSuivL93 = ConvertCoord(floatval($donneeSommetProchain['LONGITUDE']), floatval($donneeSommetProchain['LATITUDE']), 'X');
			$CoordYSommetSuivL93 = ConvertCoord(floatval($donneeSommetProchain['LONGITUDE']), floatval($donneeSommetProchain['LATITUDE']), 'Y');
			
			if($CoordXSommetSuivL93 <> $CoordXSommetL93 AND $CoordYSommetSuivL93 <> $CoordYSommetL93){
				//ON CALCULE LEQUATION REDUITE DE LA DROITE DU SOMMET
				//y = mx + p ou m est le coefficient directeur et p l'ordonnées à l'origine
				//donc m = (Yb - Ya) / (Xb - Xa)
				$m = ($CoordYSommetSuivL93 - $CoordYSommetL93) / ($CoordXSommetSuivL93 - $CoordXSommetL93);
				//p = Ya - m * Xa
				$p = $CoordYSommetL93 - $m * $CoordXSommetL93;
				
				//MAINTENANT ON CALCULE LE POINT D'INTERSECTION ENTRE LES DEUX DROITES GRACE AUX DEUX EQUATION
				//ON DECLARE x ET y
				$x;
				$y;
				//POUR LA DROITE DU SOMMET ON A 
				// $y = $m * $x + $p
				//POUR LA DROITE AVEC LALSACE ON A
				// $y = $mbis * $x + $pbis
				//ON OBTIENT DONC 
				$x = ($p - $pbis) / ($mbis - $m);
				$y = $m * (($p - $pbis) / ($mbis - $m)) + $p;
				
				//ON VA VERIFIER SI LE POINT DINTERSECTION APPARTIEN AU SEGMENT DU COTER
				if(($x >= $CoordXSommetL93 AND $x <= $CoordXSommetSuivL93) AND ($y >= $CoordYSommetSuivL93 AND $y <= $CoordYSommetL93) AND ($x >= $CoordXL93)){
					$nbintersection = $nbintersection + 1;
				}elseif(($x <= $CoordXSommetL93 AND $x >= $CoordXSommetSuivL93) AND ($y >= $CoordYSommetSuivL93 AND $y <= $CoordYSommetL93) AND ($x >= $CoordXL93)){
					$nbintersection = $nbintersection + 1;
				}elseif(($x <= $CoordXSommetL93 AND $x >= $CoordXSommetSuivL93) AND ($y <= $CoordYSommetSuivL93 AND $y >= $CoordYSommetL93) AND ($x >= $CoordXL93)){
					$nbintersection = $nbintersection + 1;
				}elseif(($x >= $CoordXSommetL93 AND $x <= $CoordXSommetSuivL93) AND ($y <= $CoordYSommetSuivL93 AND $y >= $CoordYSommetL93) AND ($x >= $CoordXL93)){
					$nbintersection = $nbintersection + 1;
				}
			}
			//INCREMENTATION
			$i++;
		}
		//POUR DETERMINER LE NUMERO FISCALITE DE LEPCI
		if(($nbintersection%2) == 1){
			$NUM_FISCALITE = $donnee_epci['NUM_FISCALITE'];
		}
	}
	
	//ON VA ALLER RECHERHCER LES NUMERO INSEE
	$INSEE = pg_query($bdd, 'SELECT INSEE FROM pram_commune_spatial WHERE EPCI="'.$NUM_FISCALITE.'"  GROUP BY INSEE ORDER BY INSEE'); 
	
	
	while($donnee_insee = $INSEE->fetch()){
		$nbintersection = 0;
		//ON VA FAIRE UNE REQUETTE QUE LA COMMUNE POUR R2CUP2RER LES COORDONN2ERS DES SOMMET
		$Commune = pg_query($bdd, 'SELECT * FROM pram_commune_spatial WHERE INSEE = "'.$donnee_insee['INSEE'].'" ORDER BY ID'); 
		//Boucle
		$i = 1;
		while($donnee = $Commune->fetch()){
			$CoordXSommetL93 = ConvertCoord(floatval($donnee['Longitude']), floatval($donnee['Latitude']), 'X');
			$CoordYSommetL93 = ConvertCoord(floatval($donnee['Longitude']), floatval($donnee['Latitude']), 'Y');
			
			//ON VA COMPTER LE NOMBRE D'ENREGISTREMENT PAR COMMUNE
			$ReqCountID = pg_query($bdd, 'SELECT * FROM pram_commune_spatial WHERE INSEE="'.$donnee['INSEE'].'" ORDER BY ID'); 
			$CountID = $ReqCountID->rowCount();
			
			//SI $i EGALE 1 ALORS ON RETIENS LE PREMIER ID
			if($i == 1){
				$FistID = $donnee['ID'];
				$LastID = $CountID + $donnee['ID'] - 1;
			}
			
			//ON DETERMINE LID DU SOMMET SUIVANT
			if(($donnee['ID']) == $LastID){
				$IDSuiv = $FistID;
			}else{
				$IDSuiv = ($donnee['ID'] + 1);
			}
			
			//ON VA ALLER CHERCHER LES COORDOONER DU PROCHAINE SOMMET DONC ON FAIS UNE REQUETE
			$SommetProchain = pg_query($bdd, 'SELECT * FROM pram_commune_spatial WHERE INSEE = "'.$donnee['INSEE'].'" AND ID = "'.$IDSuiv.'" ORDER BY ID'); 
			$donneeSommetProchain = $SommetProchain->fetch();
			//COORDONNES DU SOMMET SUIVANT
			$CoordXSommetSuivL93 = ConvertCoord(floatval($donneeSommetProchain['Longitude']), floatval($donneeSommetProchain['Latitude']), 'X');
			$CoordYSommetSuivL93 = ConvertCoord(floatval($donneeSommetProchain['Longitude']), floatval($donneeSommetProchain['Latitude']), 'Y');
			
			if($CoordXSommetSuivL93 <> $CoordXSommetL93 AND $CoordYSommetSuivL93 <> $CoordYSommetL93){
				//ON CALCULE LEQUATION REDUITE DE LA DROITE DU SOMMET
				//y = mx + p ou m est le coefficient directeur et p l'ordonnées à l'origine
				//donc m = (Yb - Ya) / (Xb - Xa)
				$m = ($CoordYSommetSuivL93 - $CoordYSommetL93) / ($CoordXSommetSuivL93 - $CoordXSommetL93);
				//p = Ya - m * Xa
				$p = $CoordYSommetL93 - $m * $CoordXSommetL93;
				
				//MAINTENANT ON CALCULE LE POINT D'INTERSECTION ENTRE LES DEUX DROITES GRACE AUX DEUX EQUATION
				//ON DECLARE x ET y
				$x;
				$y;
				//POUR LA DROITE DU SOMMET ON A 
				// $y = $m * $x + $p
				//POUR LA DROITE AVEC LALSACE ON A
				// $y = $mbis * $x + $pbis
				//ON OBTIENT DONC 
				$x = ($p - $pbis) / ($mbis - $m);
				$y = $m * (($p - $pbis) / ($mbis - $m)) + $p;
				
				//ON VA VERIFIER SI LE POINT DINTERSECTION APPARTIEN AU SEGMENT DU COTER
				if(($x >= $CoordXSommetL93 AND $x <= $CoordXSommetSuivL93) AND ($y >= $CoordYSommetSuivL93 AND $y <= $CoordYSommetL93) AND ($x >= $CoordXL93)){
					$nbintersection = $nbintersection + 1;
				}elseif(($x <= $CoordXSommetL93 AND $x >= $CoordXSommetSuivL93) AND ($y >= $CoordYSommetSuivL93 AND $y <= $CoordYSommetL93) AND ($x >= $CoordXL93)){
					$nbintersection = $nbintersection + 1;
				}elseif(($x <= $CoordXSommetL93 AND $x >= $CoordXSommetSuivL93) AND ($y <= $CoordYSommetSuivL93 AND $y >= $CoordYSommetL93) AND ($x >= $CoordXL93)){
					$nbintersection = $nbintersection + 1;
				}elseif(($x >= $CoordXSommetL93 AND $x <= $CoordXSommetSuivL93) AND ($y <= $CoordYSommetSuivL93 AND $y >= $CoordYSommetL93) AND ($x >= $CoordXL93)){
					$nbintersection = $nbintersection + 1;
				}
			}
			//INCREMENTATION
			$i++;
		}
		//POUR DETERMINER LE NUMERO INSEE DE LA COMMUNE
		if(($nbintersection%2) == 1){
			$L_ADMIN = $donnee_insee['INSEE'];
		}
	}
	
	return $L_ADMIN;
}	






function VerifDoublon($CoordX,$CoordY,$bdd,$INSEE,$TYPE){
	//ON VA VERIFIER SI LA MARE QUE L'ON PASSE DANS LA FINCTION N'EST PAS UNE MARE EN DOUBLON AVEC UNE MARE DEJA EXISTANTE DANS LA BASE DE DONNEES
	//REQUETE SUR TOUTE LES MARE DE LA COMMUNE CONCERNER
	//ON TRANSFORME LES COORDONNER EN LAMBERT 93 CAR PLUS FACILE POUR LE CALCUL DE DISTANCE
	if($TYPE == 'LatLng'){
		//ON TRANSFORME LES COORDON2ES DU POINT DORIGINE EN LAMBERT 93
		$CoordXL93 = ConvertCoord(floatval($CoordX), floatval($CoordY), 'X');
		$CoordYL93 = ConvertCoord(floatval($CoordX), floatval($CoordY), 'Y');
	}elseif($TYPE = 'L93'){
		$CoordXL93 = $CoordX;
		$CoordYL93 = $CoordY;
	}
	$mareDbl = pg_query($bdd, 'SELECT * FROM pram_localisation WHERE L_ADMIN="'.$INSEE.'"'); 
	//ON FAIT UNE BOUCLE ET ON VA VERIFIER POUR CHAQUE MARE
	$doublon = 0;
	while($donnee = $mareDbl->fetch()){
		//POUR CHAQUE MARE ON VA CALCULER LA DISTANCE ENTRE LES COORDOONEES
		$distance = sqrt((($donnee['L_COOX93'] - $CoordXL93) * ($donnee['L_COOX93'] - $CoordXL93)) + (($donnee['L_COOY93'] - $CoordYL93) * ($donnee['L_COOY93'] - $CoordYL93)));
		//SI DISTANCE INFERIERU OU EGAL A 50M ALORS ON PEU DIRE QUE C'EST UN DOUBLON POTENTIEL
		if($distance <= 50){
			$doublon++;
		}
	}
	
	return $doublon;

}

function compter_visite($bdd){
    global $bdd;
     
    // On prépare les données à insérer
    $ip   = $_SERVER['REMOTE_ADDR']; // L'adresse IP du visiteur
    $date = mktime(0,0,0,date('m'),date('j'),date('Y'));           // La date d'aujourd'hui, sous la forme mktime
     
    // Mise à jour de la base de données
    // 1. On initialise la requête préparée
	$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.stats_visites("IP", "DATE_VISITE") VALUES('."'".$ip."'".', '."'".$date."'".')'); 
	
}

function compter_visite_site($bdd){
    global $bdd;
     
    // On prépare les données à insérer
    $ip   = $_SERVER['REMOTE_ADDR']; // L'adresse IP du visiteur
    $date = mktime(0,0,0,date('m'),date('j'),date('Y'));           // La date d'aujourd'hui, sous la forme mktime
     
    // Mise à jour de la base de données
    // 1. On initialise la requête préparée
	$req_insert = pg_query($bdd, 'INSERT INTO saisie_observation.stats_visites_site("ip", "date_visite") VALUES('."'".$ip."'".', '."'".$date."'".')'); 
	
}

function Verifidentifiant($Identifiant,$bdd){
		//ON FAIT UNE REQUETE POUR SAVOIR SI LIDENTIFIANT EXISTE DEJA
	$verifid = pg_query($bdd, 'SELECT * FROM saisie_observation.structure WHERE "S_ID_SESSION" = '."'".$Identifiant."'".''); 
	$count = pg_num_rows($verifid);
	if($count > 0){
		$msg = "<p style='color:red'><b>L'identifiant de connexion que vous avez choisi existe déjà. Merci de choisir un autre identifiant.</b></p>";
	}else{
		$msg = "";	
	}
	
	return utf8_encode($msg);
}


?>