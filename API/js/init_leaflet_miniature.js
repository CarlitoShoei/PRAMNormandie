var l_id = document.getElementById('L_ID').value;
var map;
var layer_mare;
var polygone_mare;

var potentielle = L.icon({
    iconUrl: '../img/Potentiel.png',
    iconSize:     [12, 12], // size of the icon
});
var vue = L.icon({
    iconUrl: '../img/Vue.png',
    iconSize:     [12, 12], // size of the icon
});
var caracterisee = L.icon({
    iconUrl: '../img/Caracterisee.png',
    iconSize:     [12, 12], // size of the icon
});
var disparue = L.icon({
    iconUrl: '../img/Disparue.png',
    iconSize:     [12, 12], // size of the icon
});


function init_map_miniature() {
	map = new L.Map('mapminiature')
	
	 $.ajax({
    // requete a la bdd en ajax zsc
    url      : "requete_ajax_miniature.php?l_id="+l_id,
    data     : {myvar:"identifiant_idiot"},
    type     : "POST",
    dataType : "json",
    async    : false,
    error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
    success  : function(data) {
        polygone_mare = data;
        }
    });
	
	 //POUR LE LAYER DE LA CARTO ZH
	 layer_mare = L.geoJson(polygone_mare,
        {pointToLayer: function(feature, layer) {
			//check if it's the last point added
			if (feature.properties.l_statut == '2'){
				// return L.circleMarker(layer, style_mare_potentielle)
				return L.marker(layer, {
					icon: potentielle,
					clickable:true
					// draggable:true
				})
			}else if(feature.properties.l_statut == '3'){
				// return L.circleMarker(layer, style_mare_vue)
				return L.marker(layer, {
					icon: vue,
					clickable:true
					// draggable:true
				})
			}else if(feature.properties.l_statut == '4'){
				// return L.circleMarker(layer, style_mare_carac)
				return L.marker(layer, {
					icon: caracterisee,
					clickable:true
					// draggable:true
				})
			}else if(feature.properties.l_statut == '5'){
				// return L.circleMarker(layer, style_mare_disparue)
				return L.marker(layer, {
					icon: disparue,
					clickable:true
					// draggable:true
				})
			}else{
				 return L.marker(layer, {
					icon: potentielle,
					clickable:true
					// draggable:true
				})
			};
		}}
	).addTo(map);
	

	///////////////////////////////POUR LES FONDS CARTO////////////////////////////////////////////////////////////////////////
	var cloudmadeUrl = 'http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}',
	cloudmadeAttribution = 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery @ <a href="http://mapbox.com">Mapbox</a>';
	var cloudmade = new L.TileLayer(cloudmadeUrl, {zoom: 10, maxZoom: 20, attribution: cloudmadeAttribution});
	map.addLayer(cloudmade);
	
	
	var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
		maxZoom: 18,
		subdomains:['mt0','mt1','mt2','mt3']
	});
	map.fitBounds(layer_mare.getBounds());

};
init_map_miniature();

































