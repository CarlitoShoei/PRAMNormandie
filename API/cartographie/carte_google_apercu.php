<head>

<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	header('Content-type: text/html; charset=iso8859-1'); 
	header('Content-type: text/html; charset=UTF-8'); 
	include '../../bdd.php';
	$req = pg_query($bdd, 'SELECT row_to_json(fc) FROM (
									SELECT '."'FeatureCollection'".' As type, array_to_json(array_agg(f)) As features	
									FROM (
										SELECT '."'Feature'".' As type, ST_AsGeoJSON(lg.geom)::json As geometry, row_to_json((lg."ID", lg."L_ID", lg."L_ADMIN", lg."L_DATE", lg."L_STRP", lg."L_STATUT", lg."L_COOX", lg."L_COOY")) As properties
										FROM saisie_observation.localisation As lg
										WHERE lg."L_ID" <> '."'NEW'".'
									) As f 
								)  As fc');
	$coord_x = 0;
	$coord_y = 0;
?>
	
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Application WEB PRAM</title>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript" src="../../js/GeoJSON.js"></script>
<script type="text/javascript">
var coord_x = <?php echo $coord_x ?>;
var coord_y = <?php echo $coord_y ?>;
var geojson_FeatureCollection =
	<?php while ($donnees = pg_fetch_array($req)){
		 echo $donnees['row_to_json'];
	} ?>;
	
//Initialise la fonction load pour permettree la création de la carte google map
var map;
function load() {
	map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat: 49.36734700, lng: 0.93730100},
	  zoom: 12,
	  maxZoom: 13
	});
	
	var urlKML = "../img/docs/region_normandie.kml";
	var coucheKML = new google.maps.KmlLayer({
		map: map,
		url: urlKML
	}); 
	
	showFeature(geojson_FeatureCollection);
}

function showFeature(geojson, style){
	currentFeature_or_Features = new GeoJSON(geojson, style || null);
	if (currentFeature_or_Features.type && currentFeature_or_Features.type == "Error"){
	return;
	}
	
	if (currentFeature_or_Features.length){
		for (var i = 0; i < currentFeature_or_Features.length; i++){
			
			if(currentFeature_or_Features[i].length){
				for(var j = 0; j < currentFeature_or_Features[i].length; j++){
					//boucle pour les proprietes
					// alert(currentFeature_or_Features[i][j].geojsonProperties);
					for (var h in currentFeature_or_Features[i][j].geojsonProperties) {
						if(h == "f6"){
							if(currentFeature_or_Features[i][j].geojsonProperties[h] == "2"){
									var imageMarqueur = {url: "../img/docs/mare_potentiel_structure.png"};
							}else if(currentFeature_or_Features[i][j].geojsonProperties[h] == "3"){
									var imageMarqueur = {url: "../img/docs/mare_vue_structure.png"};							
							}else if(currentFeature_or_Features[i][j].geojsonProperties[h] == "4"){
									var imageMarqueur = {url: "../img/docs/mare_caracterisee_structure.png"};					
							}else if(currentFeature_or_Features[i][j].geojsonProperties[h] == "5"){
									var imageMarqueur = {url: "../img/docs/mare_disparue_structure.png"};							
							};
						};							
					};
					currentFeature_or_Features[i][j].setMap(map);
					currentFeature_or_Features[i][j].setIcon(imageMarqueur);
				}
			}
			else{
				//boucle pour les proprietes
				for (var j in currentFeature_or_Features[i].geojsonProperties) {
					if(j == "f6"){
						if(currentFeature_or_Features[i].geojsonProperties[j] == "2"){
								var imageMarqueur = {url: "../img/docs/mare_potentiel_structure.png"};					
						}else if(currentFeature_or_Features[i].geojsonProperties[j] == "3"){
								var imageMarqueur = {url: "../img/docs/mare_vue_structure.png"};							
						}else if(currentFeature_or_Features[i].geojsonProperties[j] == "4"){
								var imageMarqueur = {url: "../img/docs/mare_caracterisee_structure.png"};	
						}else if(currentFeature_or_Features[i].geojsonProperties[j] == "5"){
								var imageMarqueur = {url: "../img/docs/mare_disparue_structure.png"};								
						};
					};
				};
				currentFeature_or_Features[i].setMap(map);
				////////////////////////////////////////////////////
				currentFeature_or_Features[i].setIcon(imageMarqueur);
				////////////////////////////////////////////////////
			}
		}
	}
	else{
		//boucle pour les proprietes
		for (var j in currentFeature_or_Features.geojsonProperties) {
			if(j == "f6"){
				if(currentFeature_or_Features.geojsonProperties[j] == "2"){
					var imageMarqueur = {url: "../img/docs/mare_potentiel_structure.png"};
				}else if(currentFeature_or_Features.geojsonProperties[j] == "3"){
					var imageMarqueur = {url: "../img/docs/mare_vue_structure.png"};
				}else if(currentFeature_or_Features.geojsonProperties[j] == "4"){
					var imageMarqueur = {url: "../img/docs/mare_caracterisee_structure.png"};
				}else if(currentFeature_or_Features.geojsonProperties[j] == "5"){
					var imageMarqueur = {url: "../img/docs/mare_disparue_structure.png"};
				};
			};
		};
		currentFeature_or_Features.setMap(map)
		currentFeature_or_Features.setIcon(imageMarqueur);
	}
}
</script>
  </head>
  
  <body onload="load()">
	  <div id="map" style="width:100%; height:100%"></div>
  </body>
</html>
