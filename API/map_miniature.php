<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../css/newpram.css" type="text/css" />
	<script src="../js/getXhr.js" type="text/javascript"></script>
	<script src="../js/newpram.js" type="text/javascript"></script>
	<script type='text/javascript' src='../js/jquery-1.7.2.min.js'></script>
	<script type='text/javascript' src='../js/jquery.form.js'></script>
</head>
<?php 
//ON RECUPERE LES VARIABLE
$L_ID = $_GET['L_ID'];
?>
<input style="display:none" id="L_ID" type="text" value="<?php echo $L_ID ?>">
<div id="mapminiature">

</div>
<script type="text/javascript" src="js/leaflet/leaflet.js"></script>
	<!-- Leaflet Plugins -->
	<link rel="stylesheet" href="js/src/Control.MiniMap.css" />
	<link rel="stylesheet" href="js/draw/leaflet.css" />
	<link rel="stylesheet" href="js/dist/leaflet.draw.css" />
	<script src="js/src/Control.MiniMap.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

	<script src="js/leafletlabel/Label.js"></script>
	<script src="js/leafletlabel/BaseMarkerMethods.js"></script>
	<script src="js/leafletlabel/Marker.Label.js"></script>
	<script src="js/leafletlabel/CircleMarker.Label.js"></script>
	<script src="js/leafletlabel/Path.Label.js"></script>
	<script src="js/leafletlabel/Map.Label.js"></script>
	<script src="js/leafletlabel/FeatureGroup.Label.js"></script>

	<script src="js/draw/leaflet-src.js"></script>
	<script src="js/Leaflet.draw.js"></script>
	<script src="js/Toolbar.js"></script>
	<script src="js/Tooltip.js"></script>
	<script src="js/ext/GeometryUtil.js"></script>
	<script src="js/ext/LatLngUtil.js"></script>
	<script src="js/ext/LineUtil.Intersect.js"></script>
	<script src="js/ext/Polygon.Intersect.js"></script>
	<script src="js/ext/Polyline.Intersect.js"></script>
	<script src="js/ext/TouchEvents.js"></script>
	<script src="js/draw/DrawToolbar.js"></script>
	<script src="js/draw/handler/Draw.Feature.js"></script>
	<script src="js/draw/handler/Draw.SimpleShape.js"></script>
	<script src="js/draw/handler/Draw.Polyline.js"></script>
	<script src="js/draw/handler/Draw.Circle.js"></script>
	<script src="js/draw/handler/Draw.Marker.js"></script>
	<script src="js/draw/handler/Draw.Polygon.js"></script>
	<script src="js/draw/handler/Draw.Rectangle.js"></script>
	<script src="js/edit/EditToolbar.js"></script>
	<script src="js/edit/handler/EditToolbar.Edit.js"></script>
	<script src="js/edit/handler/EditToolbar.Delete.js"></script>
	<script src="js/Control.Draw.js"></script>
	<script src="js/edit/handler/Edit.Poly.js"></script>
	<script src="js/edit/handler/Edit.SimpleShape.js"></script>
	<script src="js/edit/handler/Edit.Circle.js"></script>
	<script src="js/edit/handler/Edit.Rectangle.js"></script>
	<script src="js/edit/handler/Edit.Marker.js"></script>
	<script type="text/javascript" src="js/init_leaflet_miniature.js"></script>