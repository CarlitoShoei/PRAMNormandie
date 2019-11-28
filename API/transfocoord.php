<?php 
function ConvertCoord($CoordX, $CoordY, $TypeCoord, $TypeTransfo){
	if($TypeTransfo == "GRS80_RGF93" || $TypeTransfo == "RGF93_GRS80"){
		//varaibles
		$a = 6378137; //demi grand axe de l'ellipsoide  (m)
		$e = 0.081819191042816; //première excentricité de l'ellipsoide
	}elseif($TypeTransfo == "WGS84_RGF93" || $TypeTransfo == "RGF93_WGS84"){
		//varaibles
		$a = 6378137; //demi grand axe de l'ellipsoide  (m)
		$e = 0.081819190842622; //première excentricité de l'ellipsoide	
	}
	
	if($TypeTransfo == "GRS80_RGF93" || $TypeTransfo == "WGS84_RGF93"){
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
		
	}elseif($TypeTransfo == "RGF93_GRS80" || $TypeTransfo == "RGF93_WGS84"){
		//varaible
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
	
}

?>
<iframe onload="zoom_entity('<?php echo ConvertCoord($_GET['X0'], $_GET['Y0'], 'X', $_GET['Transfo'])?>','<?php echo ConvertCoord($_GET['X0'], $_GET['Y0'], 'Y', $_GET['Transfo'])?>');" frameborder="1" height="1%" width="10%"></iframe>