var map;
var idstructureconnectee;
var session = document.getElementById('session').value;
var role;

// Style POUR LES GEOJSON
var style_normandie={
    fillColor:'black',
    color:'black',
    fillOpacity:0,
    weight:2,
    opacity:1
    };
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
var potentielle_astructure = L.icon({
    iconUrl: '../img/Potentiel_astructure.png',
    iconSize:     [12, 12], // size of the icon
});
var vue_astructure = L.icon({
    iconUrl: '../img/Vue_astructure.png',
    iconSize:     [12, 12], // size of the icon
});
var caracterisee_astructure = L.icon({
    iconUrl: '../img/Caracterisee_astructure.png',
    iconSize:     [12, 12], // size of the icon
});
var disparue_astructure = L.icon({
    iconUrl: '../img/Disparue_astructure.png',
    iconSize:     [12, 12], // size of the icon
});
	
var style_interco={
    fillColor:'#d6b221',
    color:'#d6b221',
    fillOpacity:0,
    weight:2,
    opacity:1
    };
	
var style_commune={
    fillColor:'#f42222',
    color:'#f42222',
    fillOpacity:0,
    weight:2,
    opacity:1
    };
	
var style_structure={
    fillColor:'#925e92',
    color:'#925e92',
    fillOpacity:0.2,
    weight:2,
    opacity:1
    };


/////////////////////////////FONCTION RECHERCHE COORDONNES LATITUDE///////////////////////////////////
function recherchecoordlatlng(url,id){
	var latitudeok = verifchampVide(document.getElementById('Latitude_search'));
	var longitudeok = verifchampVide(document.getElementById('Longitude_search'));
	
	if(latitudeok && longitudeok){
		var latitude = document.getElementById('Latitude_search').value;
		var longitude = document.getElementById('Longitude_search').value;
		zoom_entity(longitude,latitude);
		
	}else{
		afficher_masquer('erreur','');
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
		
		// On ouvre la requete vers la page d괩rꥍ
		xhr_object.open("POST", url, true);
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV spꤩfi꦳ le contenu retourn顰ar le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);
		setTimeout("afficher_masquer('erreur','');", 5000);
	}
}


/////////////////////////////FONCTION RECHERCHE COORDONNES LATITUDE///////////////////////////////////
function recherchecoordlambert93(url,id,urltransforme,idtransforme){
	var xl93ok = verifchampVide(document.getElementById('xl93_search'));
	var yl93ok = verifchampVide(document.getElementById('yl93_search'));
	
	if(xl93ok && yl93ok){
		// var xl93 = document.getElementById('xl93_search').value;
		// var yl93 = document.getElementById('yl93_search').value;
		
		var xhr_object = null;
		var position = idtransforme;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que ça marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que ça marche avec Internet Explorer
		
		//IL FAUT DONNER LE/LES PARAMETRE A PASSER A LA PAGE, SINON IL NE RECOIT PAS DE $_POST
		urltransforme = urltransforme + "?X0="+document.getElementById('xl93_search').value
									  + "&Y0="+document.getElementById('yl93_search').value
									  + "&Transfo=RGF93_WGS84";
		//ON LE RECUPERE EN GET DERRIERE
		// On ouvre la requete vers la page désirée
		xhr_object.open("POST", urltransforme, true);
		
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV spécifiées le contenu retourné par le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);
		
	}else{
		afficher_masquer('erreur','');
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
		
		// On ouvre la requete vers la page d괩rꥍ
		xhr_object.open("POST", url, true);
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV spꤩfi꦳ le contenu retourn顰ar le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);
		setTimeout("afficher_masquer('erreur','');", 5000);
	}
}

///////////////////////////FOCNTION RECHERCHE DEPARTEMENT/////////////////////////////////////////////
///////////////////////////FOCNTION POUR AFFICHER LE CONTOUR DE LA STRUCTURE QUAND ELLE SE CONNECTE/////////////////////////////////////////////
function affichercontourstructure(idstructureconnectee){	
	///////POUR EFFACER LA COUCHE//////
	if(typeof(layer_departement) != "undefined"){
		layer_departement.clearLayers();
	}
	if(typeof(layer_interco) != "undefined"){
		layer_interco.clearLayers();
	}
	if(typeof(layer_commune) != "undefined"){
		layer_commune.clearLayers();
	}
	
	$.ajax({
	// requete a la bdd en ajax
	url      : "requete_ajax_structure.php?idstructureconnectee="+idstructureconnectee,
	data     : {myvar:"identifiant_idiot"},
	type     : "POST",
	dataType : "json",
	async    : false,
	error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
	success  : function(data) {
		polygone_structure = data;
		}
	});
	
	//POUR LE LAYER DES ZONES ZH DEJA PROSPECTEEE
	layer_structure = L.geoJson(polygone_structure,
		{style:style_structure,
        onEachFeature:function(feature,layer){}
        }
        ).addTo(map);
	map.fitBounds(layer_structure.getBounds());
	
	setTimeout("Nom_Commune_Interco_Structure();", 1500);
	
}




function AfficherMareStructure(idstructureconnectee,rolestructure){
	if(typeof(idstructureconnectee) == 'undefined' || typeof(rolestructure) == 'undefined'){
		idstructureconnectee = window.parent.document.getElementById('idstructureconnectee').value;
		rolestructure = window.parent.document.getElementById('rolestructure').value;
	}
	///////POUR EFFACER LA COUCHE//////
	layer_mare.clearLayers();
	
	//Max zoom si connecter ou non connecter
	if(document.getElementById('session').value == "Inactive"){
		map.options.maxZoom = 14;
	}else if(document.getElementById('session').value == "Active"){
		map.options.maxZoom = 20;
	}
	  
	  
	 $.ajax({
    // requete a la bdd en ajax zsc
    url      : "requete_ajax_marestructure.php?idstructureconnectee="+idstructureconnectee,
    data     : {myvar:"identifiant_idiot"},
    type     : "POST",
    dataType : "json",
    async    : false,
    // error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
    success  : function(data) {
        polygone_mare = data;
        }
    });
	
	//POUR LE LAYER DES ZONES ZH DEJA PROSPECTEEE
	layer_mare = L.geoJson(polygone_mare,
        {pointToLayer: function(feature, layer) {
			//check if it's the last point added
			if(feature.properties.idstructureloca == window.parent.document.getElementById('idstructureconnectee').value && window.parent.document.getElementById('session').value == "Active" && window.parent.document.getElementById('outildessin').style.display == "inline"){
				if (feature.properties.l_statut == '2'){
					// return L.circleMarker(layer, style_mare_potentielle)
					return L.marker(layer, {
						icon: potentielle,
						clickable:true,
						draggable:true
					})
				}else if(feature.properties.l_statut == '3'){
					// return L.circleMarker(layer, style_mare_vue)
					return L.marker(layer, {
						icon: vue,
						clickable:true,
						draggable:true
					})
				}else if(feature.properties.l_statut == '4'){
					// return L.circleMarker(layer, style_mare_carac)
					return L.marker(layer, {
						icon: caracterisee,
						clickable:true,
						draggable:true
					})
				}else if(feature.properties.l_statut == '5'){
					// return L.circleMarker(layer, style_mare_disparue)
					return L.marker(layer, {
						icon: disparue,
						clickable:true,
						draggable:true
					})
				}else{
					 return L.marker(layer, {
						icon: potentielle,
						clickable:true,
						draggable:true
					})
				};
			}else if(feature.properties.idstructureloca == window.parent.document.getElementById('idstructureconnectee').value && window.parent.document.getElementById('session').value == "Active" && window.parent.document.getElementById('outildessin').style.display == "none"){
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
			}else if(feature.properties.idstructureloca != window.parent.document.getElementById('idstructureconnectee').value && window.parent.document.getElementById('session').value == "Active"){
				if (feature.properties.l_statut == '2'){
					// return L.circleMarker(layer, style_mare_potentielle)
					return L.marker(layer, {
						icon: potentielle_astructure,
						clickable:true
						// draggable:true
					})
				}else if(feature.properties.l_statut == '3'){
					// return L.circleMarker(layer, style_mare_vue)
					return L.marker(layer, {
						icon: vue_astructure,
						clickable:true
						// draggable:true
					})
				}else if(feature.properties.l_statut == '4'){
					// return L.circleMarker(layer, style_mare_carac)
					return L.marker(layer, {
						icon: caracterisee_astructure,
						clickable:true
						// draggable:true
					})
				}else if(feature.properties.l_statut == '5'){
					// return L.circleMarker(layer, style_mare_disparue)
					return L.marker(layer, {
						icon: disparue_astructure,
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
			}else if(window.parent.document.getElementById('session').value == "Inactive"){
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
			};
		},
		onEachFeature:function(feature,layer){
			if(document.getElementById('session').value == "Active"){
				var contenupopup = "<div id='infoBox'>"
								+ "<table style='text-align:center' width='550px' border='0'>"
									+ "<tr height='100px'>"
										+ "<td colspan='2' style='text-align:left'>"
											+ "<p>"
												+ "<b>Identifiant de la mare : " + feature.properties.l_id + "</b>"
												+ "<br/> Statut de la mare : " + feature.properties.statut + "</b>"
												+ "<br/> Commune : " + feature.properties.l_commune + "</b>"
												+ "<br/><a style='color:green' onClick='load_page("+'"../API/mare/chargerphoto.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'>Ajouter une photo de localisation</a></b>"
												+ "<br/><a style='color:red' onClick='load_page("+'"../API/mare/supprimermare.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'>Supprimer la mare</a></b>"
											+ "</p>"
										+ "</td>";
										contenupopup = contenupopup + "<td><iframe width='120px' frameborder='0' src='mare/photo_localisation.php?l_id=" + feature.properties.l_id + "&Session="+ document.getElementById('session').value +"&id_structure_conectee="+ document.getElementById('idstructureconnectee').value +"'></iframe></td>";										
					 contenupopup = contenupopup + "</tr>"
									+ "<tr height='5px'></tr>"
									+ "<tr height='25px'>"
										+ "<td><img src='../img/visu_localisation.png' onClick='load_page("+'"../API/mare/visu_localisation.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/description.png' onClick='load_page("+'"../API/mare/choix_caracterisation_visu.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/observation.png' onClick='load_page("+'"../API/mare/description_espece.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
									+ "</tr>"
									+ "<tr height='2px'></tr>"
									+ "<tr height='25px'>"
										+ "<td><img src='../img/mod_localisation.png' onClick='load_page("+'"../API/mare/localisation.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/ajout_caracterisation.png' onClick='load_page("+'"../API/mare/choix_mode_carac.php?L_ID='+ feature.properties.l_id +'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/ajout_observation.png' onClick='load_page("+'"../API/mare/observation.php?L_ID='+ feature.properties.l_id +'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
									+ "</tr>"
									+ "<tr height='2px'></tr>"
									+ "<tr height='25px'>"
										+ "<td><img src='../img/editer_localisation.png' onClick='fiche_localisation("+'"../API/mare/fiche_mare_localisation.php?L_ID='+ feature.properties.l_id +'"'+")'></td>"
										+ "<td><img src='../img/generation_fiche.png' onClick='load_page("+'"../API/mare/choix_caracterisation.php?L_ID='+ feature.properties.l_id +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/liste_espece.png' onClick='load_page("+'"../API/mare/liste_espece.php?L_ID='+ feature.properties.l_id +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
									+ "</tr>"
								+ "</table></div>";
			}else if(document.getElementById('session').value == "Inactive"){
				var contenupopup = "<div id='infoBoxNC'><b>Identifiant de la mare : " + feature.properties.l_id + "</b>"
								+ "<br/> Statut de la mare : " + feature.properties.statut + "</b>"
								+ "<br/> Commune : " + feature.properties.l_commune + "</b>"
								+ "</div>";
			};
			 // var contenupopup = "<h3 onclick='load_page("+'"fichezone.php?id_fiche='+ feature.properties.l_statut +'"'+", "+'"affichage"'+", "+'"affichage"'+")'>Accéder à la fiche</h>"
			 layer.on("click",function(e){
				var popup = L.popup({
						maxWidth:2000
					})
			   .setLatLng(e.latlng) 
			   .setContent('' + contenupopup)
			   .openOn(map);
			});
			layer.on("dragend",function(event){
				var newlatitude =  document.getElementById("latitudemap").value;
			    var newlongitude =  document.getElementById("longitudemap").value;
				var lid = feature.properties.l_id;
				if (confirm("ATTENTION !! Souhaitez-vous déplacer la mare ?")) { // Clic sur OK
					DragAndDrop('mare/draganddrop_maj_mare.php','',lid,newlatitude,newlongitude);
				}else{
					actualisemare();
				}
			});
		}}
	).addTo(map);
}

function recherchedepartement(){
	//POUR REACTIVER LE SCRIOLL SUR LA MAP
	map.scrollWheelZoom.enable();
	map.dragging.enable();
	///////POUR EFFACER LA COUCHE//////
	if(typeof(layer_departement) != "undefined"){
		layer_departement.clearLayers();
	}
	if(typeof(layer_interco) != "undefined"){
		layer_interco.clearLayers();
	}
	if(typeof(layer_commune) != "undefined"){
		layer_commune.clearLayers();
	}
	//Max zoom si connecter ou non connecter
	if(document.getElementById('session').value == "Inactive"){
		map.options.maxZoom = 14;
	}else if(document.getElementById('session').value == "Active"){
		map.options.maxZoom = 20;
	}
	
	if(document.getElementById('ID_DEPARTEMENT').value == 0 && document.getElementById('ID_INTERCO').value == 0 
		&& document.getElementById('ID_COMMUNE').value == 0 && document.getElementById('ID_MARE').value == 0){
		if(document.getElementById('session').value == "Active"){
			AfficherMareStructure(window.parent.document.getElementById('idstructureconnectee').value,window.parent.document.getElementById('rolestructure').value)
		map.fitBounds(layer_mare.getBounds());	
		}else{
			layer_mare.clearLayers();
		}
	}else if(document.getElementById('ID_DEPARTEMENT').value != 0){
		$.ajax({
		// requete a la bdd en ajax
		url      : "requete_ajax_departement.php?num_dep="+document.getElementById('ID_DEPARTEMENT').value,
		data     : {myvar:"identifiant_idiot"},
		type     : "POST",
		dataType : "json",
		async    : false,
		error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
		success  : function(data) {
			polygone_departement = data;
			}
		});
		
		//POUR LE LAYER DES ZONES ZH DEJA PROSPECTEEE
		layer_departement = L.geoJson(polygone_departement,
			{style:style_commune,
			onEachFeature:function(feature,layer){}
			}
			).addTo(map);
		map.fitBounds(layer_departement.getBounds());	
		
		////POUR ACTUALISER LES MARE EN FONCTION DES FILTRE
		// setTimeout("actualisemare();", 1500);
		// setTimeout("map.fitBounds(layer_mare.getBounds());", 2000);
	}
}


function rechercheinterco(){
	//POUR REACTIVER LE SCRIOLL SUR LA MAP
	map.scrollWheelZoom.enable();
	map.dragging.enable();
	///////POUR EFFACER LA COUCHE//////
	if(typeof(layer_departement) != "undefined"){
		layer_departement.clearLayers();
	}
	if(typeof(layer_interco) != "undefined"){
		layer_interco.clearLayers();
	}
	if(typeof(layer_commune) != "undefined"){
		layer_commune.clearLayers();
	}
	//Max zoom si connecter ou non connecter
	if(document.getElementById('session').value == "Inactive"){
		map.options.maxZoom = 14;
	}else if(document.getElementById('session').value == "Active"){
		map.options.maxZoom = 20;
	}
	
	if(document.getElementById('ID_DEPARTEMENT').value == 0 && document.getElementById('ID_INTERCO').value == 0 
		&& document.getElementById('ID_COMMUNE').value == 0 && document.getElementById('ID_MARE').value == 0){
		AfficherMareStructure(window.parent.document.getElementById('idstructureconnectee').value,window.parent.document.getElementById('rolestructure').value)
		map.fitBounds(layer_mare.getBounds());
	}else if(document.getElementById('ID_INTERCO').value != 0){
		$.ajax({
		// requete a la bdd en ajax
		url      : "requete_ajax_interco.php?interco="+document.getElementById('ID_INTERCO').value,
		data     : {myvar:"identifiant_idiot"},
		type     : "POST",
		dataType : "json",
		async    : false,
		error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
		success  : function(data) {
			polygone_interco = data;
			}
		});
		
		//POUR LE LAYER DES ZONES ZH DEJA PROSPECTEEE
		layer_interco = L.geoJson(polygone_interco,
			{style:style_interco,
			onEachFeature:function(feature,layer){}
			}
			).addTo(map);
		map.fitBounds(layer_interco.getBounds());	
		
		////POUR ACTUALISER LES MARE EN FONCTION DES FILTRE
		setTimeout("actualisemare();", 1500);
		// setTimeout("map.fitBounds(layer_mare.getBounds());", 2000);
	}else if(document.getElementById('ID_INTERCO').value == 0 && document.getElementById('ID_DEPARTEMENT').value != 0){
		if(document.getElementById('session').value == "Active"){
			recherchedepartement();
			AfficherMareStructure(window.parent.document.getElementById('idstructureconnectee').value,window.parent.document.getElementById('rolestructure').value)
			map.fitBounds(layer_mare.getBounds());
		}else{
			recherchedepartement();
			layer_mare.clearLayers();
		}
		
		
		
	}else{
		if(document.getElementById('session').value == "Active"){
			AfficherMareStructure(window.parent.document.getElementById('idstructureconnectee').value,window.parent.document.getElementById('rolestructure').value)
			map.fitBounds(layer_mare.getBounds());
		}else{
			recherchedepartement();
			
		}
	}
}
///////////////////////////FOCNTION RECHERCHE COMMUNE/////////////////////////////////////////////
function recherchecommune(){	
	//POUR REACTIVER LE SCRIOLL SUR LA MAP
	map.scrollWheelZoom.enable();
	map.dragging.enable();
	///////POUR EFFACER LA COUCHE//////
	if(typeof(layer_commune) != "undefined"){
		layer_commune.clearLayers();
	}
	if(typeof(layer_interco) != "undefined"){
		layer_interco.clearLayers();
	}
	if(typeof(layer_departement) != "undefined"){
		layer_departement.clearLayers();
	}
	
	//Max zoom si connecter ou non connecter
	if(document.getElementById('session').value == "Inactive"){
		map.options.maxZoom = 14;
	}else if(document.getElementById('session').value == "Active"){
		map.options.maxZoom = 20;
	}

	if(document.getElementById('ID_DEPARTEMENT').value == 0 && document.getElementById('ID_INTERCO').value == 0 
		&& document.getElementById('ID_COMMUNE').value == 0 && document.getElementById('ID_MARE').value == 0){
		AfficherMareStructure(window.parent.document.getElementById('idstructureconnectee').value,window.parent.document.getElementById('rolestructure').value)
		map.fitBounds(layer_mare.getBounds());
	}else if(document.getElementById('ID_COMMUNE').value != 0){
		$.ajax({
		// requete a la bdd en ajax
		url      : "requete_ajax_commune.php?insee="+document.getElementById('ID_COMMUNE').value,
		data     : {myvar:"identifiant_idiot"},
		type     : "POST",
		dataType : "json",
		async    : false,
		error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
		success  : function(data) {
			polygone_commune = data;
			}
		});
		
		//POUR LE LAYER DES ZONES ZH DEJA PROSPECTEEE
		layer_commune = L.geoJson(polygone_commune,
			{style:style_commune,
			onEachFeature:function(feature,layer){}
			}
			).addTo(map);
		map.fitBounds(layer_commune.getBounds());

		////POUR ACTUALISER LES MARE EN FONCTION DES FILTRE
		setTimeout("actualisemare();", 1500);
		// setTimeout("map.fitBounds(layer_mare.getBounds());", 1200);
	}else if(document.getElementById('ID_COMMUNE').value == 0 && document.getElementById('ID_INTERCO').value != 0){
		rechercheinterco();
	}else{
		if(document.getElementById('session').value == "Active"){
			AfficherMareStructure(window.parent.document.getElementById('idstructureconnectee').value,window.parent.document.getElementById('rolestructure').value)
			map.fitBounds(layer_mare.getBounds());
		}else{
			recherchedepartement();
		}
	}
}

///////////////////////////FOCNTION RECHERCHE MARE/////////////////////////////////////////////
function recherchemare(){	
	//POUR REACTIVER LE SCRIOLL SUR LA MAP
	map.scrollWheelZoom.enable();
	map.dragging.enable();
	///////POUR EFFACER LA COUCHE//////
	// if(typeof(layer_commune) != "undefined"){
		// layer_commune.clearLayers();
	// }
	if(typeof(layer_departement) != "undefined"){
		layer_departement.clearLayers();
	}
	if(typeof(layer_mare) != "undefined"){
		layer_mare.clearLayers();
	}
	//Max zoom si connecter ou non connecter
	if(document.getElementById('session').value == "Inactive"){
		map.options.maxZoom = 14;
	}else if(document.getElementById('session').value == "Active"){
		map.options.maxZoom = 20;
	}

	if(document.getElementById('ID_DEPARTEMENT').value == 0 && document.getElementById('ID_INTERCO').value == 0 
		&& document.getElementById('ID_COMMUNE').value == 0 && document.getElementById('ID_MARE').value == 0){
		AfficherMareStructure(window.parent.document.getElementById('idstructureconnectee').value,window.parent.document.getElementById('rolestructure').value)
		map.fitBounds(layer_mare.getBounds());
	}else{
		////POUR ACTUALISER LES MARE EN FONCTION DES FILTRE
		setTimeout("actualisemare();", 1000);
		setTimeout("map.fitBounds(layer_mare.getBounds());", 1200);
	}
	
}

///////////////////////////FOCNTION POUR RACTUALISER CARTE/////////////////////////////////////////////
function actualisemare(idstructureconnectee,rolestructure){	
	if(typeof(idstructureconnectee) == 'undefined' || typeof(rolestructure) == 'undefined'){
		idstructureconnectee = window.parent.document.getElementById('idstructureconnectee').value;
		rolestructure = window.parent.document.getElementById('rolestructure').value;
	}
	///////POUR EFFACER LA COUCHE//////
	layer_mare.clearLayers();
	
	//Max zoom si connecter ou non connecter
	if(document.getElementById('session').value == "Inactive"){
		map.options.maxZoom = 14;
	}else if(document.getElementById('session').value == "Active"){
		map.options.maxZoom = 20;
	}
	  
	  
	 $.ajax({
    // requete a la bdd en ajax zsc
    url      : "requete_ajax_mare.php?num_dep="+document.getElementById('ID_DEPARTEMENT').value+"&interco="+document.getElementById('ID_INTERCO').value+"&insee="+document.getElementById('ID_COMMUNE').value+"&idmare="+document.getElementById('ID_MARE').value,
    data     : {myvar:"identifiant_idiot"},
    type     : "POST",
    dataType : "json",
    async    : false,
    error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
    success  : function(data) {
        polygone_mare = data;
        }
    });
	
	//POUR LE LAYER DES ZONES ZH DEJA PROSPECTEEE
	layer_mare = L.geoJson(polygone_mare,
        {pointToLayer: function(feature, layer) {
			//check if it's the last point added
			if(feature.properties.idstructureloca == window.parent.document.getElementById('idstructureconnectee').value && window.parent.document.getElementById('session').value == "Active" && window.parent.document.getElementById('outildessin').style.display == "inline"){
				if (feature.properties.l_statut == '2'){
					// return L.circleMarker(layer, style_mare_potentielle)
					return L.marker(layer, {
						icon: potentielle,
						clickable:true,
						draggable:true
					})
				}else if(feature.properties.l_statut == '3'){
					// return L.circleMarker(layer, style_mare_vue)
					return L.marker(layer, {
						icon: vue,
						clickable:true,
						draggable:true
					})
				}else if(feature.properties.l_statut == '4'){
					// return L.circleMarker(layer, style_mare_carac)
					return L.marker(layer, {
						icon: caracterisee,
						clickable:true,
						draggable:true
					})
				}else if(feature.properties.l_statut == '5'){
					// return L.circleMarker(layer, style_mare_disparue)
					return L.marker(layer, {
						icon: disparue,
						clickable:true,
						draggable:true
					})
				}else{
					 return L.marker(layer, {
						icon: potentielle,
						clickable:true,
						draggable:true
					})
				};
			}else if(feature.properties.idstructureloca == window.parent.document.getElementById('idstructureconnectee').value && window.parent.document.getElementById('session').value == "Active" && window.parent.document.getElementById('outildessin').style.display == "none"){
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
			}else if(feature.properties.idstructureloca != window.parent.document.getElementById('idstructureconnectee').value && window.parent.document.getElementById('session').value == "Active"){
				if (feature.properties.l_statut == '2'){
					// return L.circleMarker(layer, style_mare_potentielle)
					return L.marker(layer, {
						icon: potentielle_astructure,
						clickable:true
						// draggable:true
					})
				}else if(feature.properties.l_statut == '3'){
					// return L.circleMarker(layer, style_mare_vue)
					return L.marker(layer, {
						icon: vue_astructure,
						clickable:true
						// draggable:true
					})
				}else if(feature.properties.l_statut == '4'){
					// return L.circleMarker(layer, style_mare_carac)
					return L.marker(layer, {
						icon: caracterisee_astructure,
						clickable:true
						// draggable:true
					})
				}else if(feature.properties.l_statut == '5'){
					// return L.circleMarker(layer, style_mare_disparue)
					return L.marker(layer, {
						icon: disparue_astructure,
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
			}else if(window.parent.document.getElementById('session').value == "Inactive"){
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
			};
		},
		onEachFeature:function(feature,layer){
			if(document.getElementById('session').value == "Active"){
				var contenupopup = "<div id='infoBox'>"
								+ "<table style='text-align:center' width='550px' border='0'>"
									+ "<tr height='100px'>"
										+ "<td colspan='2' style='text-align:left'>"
											+ "<p>"
												+ "<b>Identifiant de la mare : " + feature.properties.l_id + "</b>"
												+ "<br/> Statut de la mare : " + feature.properties.statut + "</b>"
												+ "<br/> Commune : " + feature.properties.l_commune + "</b>"
												+ "<br/><a style='color:green' onClick='load_page("+'"../API/mare/chargerphoto.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'>Ajouter une photo de localisation</a></b>"
												+ "<br/><a style='color:red' onClick='load_page("+'"../API/mare/supprimermare.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'>Supprimer la mare</a></b>"
											+ "</p>"
										+ "</td>";
										contenupopup = contenupopup + "<td><iframe width='120px' frameborder='0' src='mare/photo_localisation.php?l_id=" + feature.properties.l_id + "&Session="+ document.getElementById('session').value +"&id_structure_conectee="+ document.getElementById('idstructureconnectee').value +"'></iframe></td>";																			
					 contenupopup = contenupopup + "</tr>"
									+ "<tr height='5px'></tr>"
									+ "<tr height='25px'>"
										+ "<td><img src='../img/visu_localisation.png' onClick='load_page("+'"../API/mare/visu_localisation.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/description.png' onClick='load_page("+'"../API/mare/choix_caracterisation_visu.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/observation.png' onClick='load_page("+'"../API/mare/description_espece.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
									+ "</tr>"
									+ "<tr height='2px'></tr>"
									+ "<tr height='25px'>"
										+ "<td><img src='../img/mod_localisation.png' onClick='load_page("+'"../API/mare/localisation.php?L_ID='+ feature.properties.l_id +'&Session='+ document.getElementById('session').value +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/ajout_caracterisation.png' onClick='load_page("+'"../API/mare/choix_mode_carac.php?L_ID='+ feature.properties.l_id +'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/ajout_observation.png' onClick='load_page("+'"../API/mare/observation.php?L_ID='+ feature.properties.l_id +'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
									+ "</tr>"
									+ "<tr height='2px'></tr>"
									+ "<tr height='25px'>"
										+ "<td><img src='../img/editer_localisation.png' onClick='fiche_localisation("+'"../API/mare/fiche_mare_localisation.php?L_ID='+ feature.properties.l_id +'"'+")'></td>"
										+ "<td><img src='../img/generation_fiche.png' onClick='load_page("+'"../API/mare/choix_caracterisation.php?L_ID='+ feature.properties.l_id +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
										+ "<td><img src='../img/liste_espece.png' onClick='load_page("+'"../API/mare/liste_espece.php?L_ID='+ feature.properties.l_id +'&id_structure_conectee='+ document.getElementById('idstructureconnectee').value +'&role='+document.getElementById('rolestructure').value+'"'+", "+'"affichage"'+", "+'"affichagesaisiemare"'+")'></td>"
									+ "</tr>"
								+ "</table></div>";
			}else if(document.getElementById('session').value == "Inactive"){
				var contenupopup = "<div id='infoBoxNC'><b>Identifiant de la mare : " + feature.properties.l_id + "</b>"
								+ "<br/> Statut de la mare : " + feature.properties.statut + "</b>"
								+ "<br/> Commune : " + feature.properties.l_commune + "</b>"
								+ "</div>";
			};
			 // var contenupopup = "<h3 onclick='load_page("+'"fichezone.php?id_fiche='+ feature.properties.l_statut +'"'+", "+'"affichage"'+", "+'"affichage"'+")'>Accéder à la fiche</h>"
			 layer.on("click",function(e){
				var popup = L.popup({
						maxWidth:2000
					})
			   .setLatLng(e.latlng) 
			   .setContent('' + contenupopup)
			   .openOn(map);
			});
			layer.on("dragend",function(event){
				var newlatitude =  document.getElementById("latitudemap").value;
			    var newlongitude =  document.getElementById("longitudemap").value;
				var lid = feature.properties.l_id;
				if (confirm("ATTENTION !! Souhaitez-vous déplacer la mare ?")) { // Clic sur OK
					DragAndDrop('mare/draganddrop_maj_mare.php','',lid,newlatitude,newlongitude);
				}else{
					actualisemare();
				}
			});
		}}
	).addTo(map);
	
	map.scrollWheelZoom.enable();
	map.dragging.enable();
	
}

function DragAndDrop(url,id,lid,newlatitude,newlongitude){
	//On declare les variables
	var xhr_object = null;
	var position = id;
	if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
	if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
	//IL FAUT DONNER LE/LES PARAMETRE A PASSER A LA PAGE, SINON IL NE RECOIT PAS DE $_POST
	url = url + "?lid=" + lid
			  + "&newlatitude="+newlatitude 
			  + "&newlongitude="+newlongitude;
	// On ouvre la requete vers la page d괩rꥍ
	xhr_object.open("POST", url, true);
	xhr_object.onreadystatechange = function(){
		if ( xhr_object.readyState == 4 ){
			// j'affiche dans la DIV spꤩfi꦳ le contenu retourn顰ar le fichier
			// document.getElementById(position).innerHTML = xhr_object.responseText;
		}
	}
	// dans le cas du get
	xhr_object.send(null);
}

function actualiseMareAfterMod(){
	if(document.getElementById('ID_DEPARTEMENT').value == 0 && document.getElementById('ID_INTERCO').value == 0 
		&& document.getElementById('ID_COMMUNE').value == 0 && document.getElementById('ID_MARE').value == 0){
		AfficherMareStructure(window.parent.document.getElementById('idstructureconnectee').value,window.parent.document.getElementById('rolestructure').value)
		map.fitBounds(layer_mare.getBounds());
	}else{
		////POUR ACTUALISER LES MARE EN FONCTION DES FILTRE
		setTimeout("actualisemare();", 1000);
		setTimeout("map.fitBounds(layer_mare.getBounds());", 1200);
	}
}

function desactive_saisie(){
	//////////////////////////////////////POUR LES OUTILS DE DESSINS////////////////////////////////////////	
	 map.removeControl(drawControl);
	
	//APPELLE AJAX POUR AFFICHER LE MENU AVEC DESACTIVER LA SAISIE
	var xhr_object = null;
	var position = 'edit';
	if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
	else
	if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
	// On ouvre la requete vers la page d괩rꥍ
	xhr_object.open("POST", '../API/mare/menusaisiemare.php?type=desactive', true);
	
	xhr_object.onreadystatechange = function(){
		if ( xhr_object.readyState == 4 ){
			// j'affiche dans la DIV spꤩfi꦳ le contenu retourn顰ar le fichier
			document.getElementById(position).innerHTML = xhr_object.responseText;
		}
	}
	// dans le cas du get
	xhr_object.send(null);
}

function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y) {
    $i = $j = $c = 0;

    for ($i = 0, $j = $points_polygon-1; $i < $points_polygon; $j = $i++) {
        if (($vertices_y[$i] >  $latitude_y != ($vertices_y[$j] > $latitude_y)) && ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i])) {
            $c = !$c;
        }
    }

    return $c;
}	
	
	
function active_saisie(){
	////VERIFIE AVANT SI UNE COMMUNE EST SELECTIONNER
	if(document.getElementById('ID_COMMUNE').value != 0 
			|| (document.getElementById('Longitude_search').value != "" && document.getElementById('Latitude_search').value != "") 
			|| (document.getElementById('xl93_search').value != "" && document.getElementById('yl93_search').value != "")){
		// var drawnItems = L.featureGroup().addTo(map);
		//////////////////////////////////////POUR LES OUTILS DE DESSINS////////////////////////////////////////	
		drawControl = new L.Control.Draw({
			edit: false,
			draw: {
				polygon : false,
				circle: false,
				rectangle: false,
				marker: true,
				polyline:false
			},
			position : 'topleft'
		});
		map.addControl(drawControl);
		map.on('draw:created', function(event) {
			var layer = event.layer;
			// drawnItems.addLayer(layer);
			var shape = layer.toGeoJSON().geometry;
			var shape_for_db = JSON.stringify(shape);
			//VERIFIER LE NIVEAU DE ZOOM ET SI OUI OU NON ON PEUT AJOUTER UNE MARE
			if(map.getZoom() < 18){ 
				alert("La saisie d'une mare n'est valide que si l'échelle est égale à 30 mètres. Merci de zoomer afin de pouvoir saisir la localisation d'une mare.");
			}else{
				if (confirm("Souhaitez-vous localiser une nouvelle mare maintenant ?")) { // Clic sur OK
					//PERMET D'OUVIR LA POPUP
					load_page('mare/saisie_mare.php?Longitude='+document.getElementById("longitudemap").value+'&Latitude='+document.getElementById("latitudemap").value+'&Commune='+document.getElementById("ID_COMMUNE").value+'&STRUCTURE_SESSION='+window.parent.document.getElementById('idstructureconnectee').value,'affichage','affichagesaisiemare');
					// window.open ('../mare/saisie_mare.php?Longitude='+location.lng()+'&Latitude='+location.lat()+'&Commune='+unescape(encodeURIComponent(commune_mare))+'&STRUCTURE_SESSION='+window.parent.document.getElementById('STRUCTURE_SESSION').value,'Parcourir',config='height=900, width=1800, toolbar=no, menubar=no, scrollbars=yes, resizable=no, location=no, directories=no, status=no');
				}
			}
		});
		
		//APPELLE AJAX POUR AFFICHER LE MENU AVEC DESACTIVER LA SAISIE
		var xhr_object = null;
		var position = 'edit';
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
		// On ouvre la requete vers la page d괩rꥍ
		xhr_object.open("POST", '../API/mare/menusaisiemare.php?type=active', true);
		
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV spꤩfi꦳ le contenu retourn顰ar le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);
	}else{
		afficher_masquer('outildessin','');
		alert("Merci de sélectionner une commune dans le menu filtre, puis d'activer à nouveau la saisie.");
		
	}
}

function zoom_entity(lng,lat){
	var latlng = L.latLng(lat, lng);
	map.setView(latlng, 21);
	var marker = L.marker([lat, lng]).addTo(map);
	// map.removeLayer(marker);
	// setTimeout('markers.clearLayers();',15000);
	map.scrollWheelZoom.enable();
	map.dragging.enable();
}


function zoom_entity_tableau(lng,lat){
	var latlng = L.latLng(lat, lng);
	map.setView(latlng, 21);
	// var marker = L.marker([lat, lng]).addTo(map);
	// map.removeLayer(marker);
	// setTimeout('markers.clearLayers();',15000);
	map.scrollWheelZoom.enable();
	map.dragging.enable();
}

function init_map() {
    // set up the map
    console.log("init_map");
	
	if(typeof(map) == "undefined"){
		map = new L.Map('map')
	}
	
	//Max zoom si connecter ou non connecter
	if(document.getElementById('session').value == "Inactive"){
		map.options.maxZoom = 14;
	}else if(document.getElementById('session').value == "Active"){
		map.options.maxZoom = 20;
	}

	$.ajax({
    // requete a la bdd en ajax
    url      : "requete_ajax_hn.php",
    data     : {myvar:"identifiant_idiot"},
    type     : "POST",
    dataType : "json",
    async    : false,
    error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
    success  : function(data) {
        polygone_geojson = data;
        }
    });
	
	 $.ajax({
   // requete a la bdd en ajax zsc
    url      : "requete_ajax_mare.php",
    data     : {myvar:"identifiant_idiot"},
    type     : "POST",
    dataType : "json",
    async    : false,
    error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
    success  : function(data) {
        polygone_mare = data;
        }
    });
	
	//POUR LE LAYER DU CONTOUR DE LA HAUTE NORMANDIE
    layer_geojson = L.geoJson(polygone_geojson,
        {style:style_normandie,
        onEachFeature:function(feature,layer){}
        }
        ).addTo(map);
	
	 //POUR LE LAYER DE LA CARTO ZH
	 layer_mare = L.geoJson(polygone_mare,
        {pointToLayer: function(feature, layer) {
			if (feature.properties.l_statut == '2'){
				return L.marker(layer, {
					icon: potentielle,
					clickable:true
				})
			}else if(feature.properties.l_statut == '3'){
				return L.marker(layer, {
					icon: vue,
					clickable:true
					
				})
			}else if(feature.properties.l_statut == '4'){
				return L.marker(layer, {
					icon: caracterisee,
					clickable:true
				})
			}else if(feature.properties.l_statut == '5'){
				return L.marker(layer, {
					icon: disparue,
					clickable:true
				})
			}else{
				 return L.marker(layer, {
					icon: potentielle,
					clickable:true
				})
			};
		},
		onEachFeature:function(feature,layer){
			if(document.getElementById('session').value == "Inactive"){
				var contenupopup = "<div id='infoBoxNC'><b>Identifiant de la mare : " + feature.properties.l_id + "</b>"
								+ "<br/> Statut de la mare : " + feature.properties.statut + "</b>"
								+ "<br/> Commune : " + feature.properties.l_commune + "</b>"
								+ "</div>";
			};
			 layer.on("click",function(e){
				var popup = L.popup()
			   .setLatLng(e.latlng) 
			   .setContent('' + contenupopup)
			   .openOn(map);
			});
		}}
	);
	
	 
    // create the tile layer with correct attribution
    // var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    // var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
    // var osm=new L.TileLayer(osmUrl,{minZoom:1,maxZoom:20,attribution:osmAttrib});
    // map.addLayer(osm);
	// map.setView(new L.LatLng(49.92448055859924, 1.758276373601069),20);
	
	
	///////////////////////////////POUR LES FONDS CARTO////////////////////////////////////////////////////////////////////////
	var cloudmadeUrl = 'http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}',
	cloudmadeAttribution = 'Map data &copy; Google Maps / IGN © ORTHOPHOTOS 2006-2010 - BD Parcellaire / SCAN25';
	var cloudmade = new L.TileLayer(cloudmadeUrl, {zoom: 10, maxZoom: 20, attribution: cloudmadeAttribution});
	map.addLayer(cloudmade);
	
	//avec la clé
    var ignOrtho=   'http://wxs.ign.fr/ehpg7fhion1egbf8oxc7xcn9/geoportail/wmts?service=WMTS&request=GetTile&version=1.0.0&tilematrixset=PM&tilematrix={z}&tilecol={x}&tilerow={y}&layer=ORTHOIMAGERY.ORTHOPHOTOS2006-2010&format=image/jpeg&style=normal';
    var ignSCAN25=  'http://wxs.ign.fr/ehpg7fhion1egbf8oxc7xcn9/geoportail/wmts?service=WMTS&request=GetTile&version=1.0.0&tilematrixset=PM&tilematrix={z}&tilecol={x}&tilerow={y}&layer=GEOGRAPHICALGRIDSYSTEMS.MAPS&format=image/jpeg&style=normal';
    var wmsLayer = L.tileLayer.wms('http://wxs.ign.fr/ehpg7fhion1egbf8oxc7xcn9/geoportail/r/wms?', {layers: 'CADASTRALPARCELS.PARCELS'});
    
	var ignO = new L.TileLayer(ignOrtho,{minZoom:1,maxZoom:24,attribution:cloudmadeAttribution});
    var ignS = new L.TileLayer(ignSCAN25,{minZoom:1,maxZoom:24,attribution:cloudmadeAttribution});
	
	var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
		maxZoom: 20,
		subdomains:['mt0','mt1','mt2','mt3']
	});
	
	var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
		maxZoom: 20,
		subdomains:['mt0','mt1','mt2','mt3']
	});
	
	var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
		maxZoom: 20,
		subdomains:['mt0','mt1','mt2','mt3']
	});
	
	///////////////////////////////////////////////POUR LA LEGENDE DE LA CARTE//////////////////////////////////////////
	
	
    new L.Control.Draw({
			edit: false,
			draw: {
				polygon : false,
				circle: false,
				rectangle: false,
				marker: true,
				polyline:false
			},
			position : 'topleft'
		});
		
    L.control.scale({
		position : 'bottomright'
		}).addTo(map);
    ////////////////////////AJOUTE LE BOUTON CONTROLE DES COUCHES SUR LA CARTE///////////////////////////////////////////
    overlaysMaps={
		"Normandie":layer_geojson
		};
    baseMaps={
		// "Open Street Map":osm,
		"Google Map Satellite":cloudmade,
		"Google Map Street":googleStreets,
		"Google Map Hybride":googleHybrid,
		"Google Map Hybride":googleTerrain,
		"IGN":ignO,
		"SCAN":ignS,
		"parcellaire":wmsLayer
		};
    ControlLayer=L.control.layers(baseMaps, overlaysMaps, {position: 'topleft'}).addTo(map);
	map.fitBounds(layer_geojson.getBounds());

	
	////////////////////////////////////////POUR LES COORDONNER//////////////////////////////////////////
	map.addEventListener('mousemove', function(ev) {
	   document.getElementById("latitudemap").value = ev.latlng.lat;
	   document.getElementById("longitudemap").value = ev.latlng.lng;
	});
};

/////////////////////////////LANCE LA FONCTION
init_map();