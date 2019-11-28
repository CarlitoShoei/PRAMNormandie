var latitude = document.getElementById('latitude').value;
var longitude = document.getElementById('longitude').value;

function init_map_miniature_saisie() {
	var map = L.map('mapminiature').setView([latitude, longitude], 18);
	L.circle([latitude, longitude], 1, {
		color: 'red',
		fillColor: 'red',
		fillOpacity: 1
	}).addTo(map)
	///////////////////////////////POUR LES FONDS CARTO////////////////////////////////////////////////////////////////////////
	var cloudmadeUrl = 'http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}',
	cloudmadeAttribution = 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery @ <a href="http://mapbox.com">Mapbox</a>';
	var cloudmade = new L.TileLayer(cloudmadeUrl, {zoom: 10, maxZoom: 20, attribution: cloudmadeAttribution});
	map.addLayer(cloudmade);
	
	
	var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
		maxZoom: 20,
		subdomains:['mt0','mt1','mt2','mt3']
	});

};
init_map_miniature_saisie();

































