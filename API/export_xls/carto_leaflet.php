<script src="../../js/leaflet/draw/leaflet-src.js"></script>
<link rel="stylesheet" href="../../js/leaflet/draw/leaflet.css" />
<script src="../../js/leaflet/Leaflet.draw.js"></script>
<link rel="stylesheet" href="../../js/leaflet/dist/leaflet.draw.css" />
<script src="../../js/leaflet/Toolbar.js"></script>
<script src="../../js/leaflet/Tooltip.js"></script>
<script src="../../js/leaflet/ext/GeometryUtil.js"></script>
<script src="../../js/leaflet/ext/LatLngUtil.js"></script>
<script src="../../js/leaflet/ext/LineUtil.Intersect.js"></script>
<script src="../../js/leaflet/ext/Polygon.Intersect.js"></script>
<script src="../../js/leaflet/ext/Polyline.Intersect.js"></script>
<script src="../../js/leaflet/ext/TouchEvents.js"></script>
<script src="../../js/leaflet/draw/DrawToolbar.js"></script>
<script src="../../js/leaflet/draw/handler/Draw.Feature.js"></script>
<script src="../../js/leaflet/draw/handler/Draw.SimpleShape.js"></script>
<script src="../../js/leaflet/draw/handler/Draw.Polyline.js"></script>
<script src="../../js/leaflet/draw/handler/Draw.Circle.js"></script>
<script src="../../js/leaflet/draw/handler/Draw.Marker.js"></script>
<script src="../../js/leaflet/draw/handler/Draw.Polygon.js"></script>
<script src="../../js/leaflet/draw/handler/Draw.Rectangle.js"></script>
<script src="../../js/leaflet/edit/EditToolbar.js"></script>
<script src="../../js/leaflet/edit/handler/EditToolbar.Edit.js"></script>
<script src="../../js/leaflet/edit/handler/EditToolbar.Delete.js"></script>
<script src="../../js/leaflet/Control.Draw.js"></script>
<script src="../../js/leaflet/edit/handler/Edit.Poly.js"></script>
<script src="../../js/leaflet/edit/handler/Edit.SimpleShape.js"></script>
<script src="../../js/leaflet/edit/handler/Edit.Circle.js"></script>
<script src="../../js/leaflet/edit/handler/Edit.Rectangle.js"></script>
<script src="../../js/leaflet/edit/handler/Edit.Marker.js"></script>

<div id="map" style="width: 100%; height: 100%; border: 0px solid #ccc"></div>
<script>
	var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
		osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
		osm = L.tileLayer(osmUrl, {maxZoom: 18, attribution: osmAttrib});
		map = new L.Map('map', {center: new L.LatLng(49.36734700, 0.93730100), zoom: 8}),
		drawnItems = L.featureGroup().addTo(map);
	L.control.layers({
	 'OpenStreet':osm.addTo(map),
	 "Google": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
			attribution: 'google'
		})
	}, {'Couche Dessin':drawnItems}, { position: 'topleft', collapsed: false }).addTo(map);
	map.addControl(new L.Control.Draw({
		edit: {
			featureGroup: drawnItems,
			poly : {
				allowIntersection : false
			}
		},
		draw: {
			polygon : {
				allowIntersection: false,
				showArea:true
			}
		}
	}));

	map.on('draw:created', function(event) {
		var layer = event.layer;

		drawnItems.addLayer(layer);
		
		var shape = layer.toGeoJSON().geometry;
		var shape_for_db = JSON.stringify(shape);
		
		window.parent.document.getElementById('geojson').value = shape_for_db;
	});
</script>