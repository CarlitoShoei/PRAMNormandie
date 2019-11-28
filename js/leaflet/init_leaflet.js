var map;
var layer_geojson;

// Style Neutre
var style_neutre={
    fillColor:'#00dd00',
    color:'#00dd00',
    fillOpacity:0.1,
    weight:1,
    opacity:1
    };

function supprime_couche () {
    layer_geojson.clearLayers();
}
function export_map () {
    console.log("export");
    
    setTimeout(function() {
        leafletImage(map, function(err, canvas) {
        // now you have canvas
        // example thing to do with that canvas:
        var img = document.createElement('img');
        img.setAttribute("id","image2send");
        var dimensions = map.getSize();
        img.width = dimensions.x;
        img.height = dimensions.y;
        img.src = canvas.toDataURL();
        document.getElementById('images_out').innerHTML = '';
        document.getElementById('images_out').appendChild(img);
        });
    }, 1000);
    
    
    
}

function export_img2pdf () {
    console.log('generation du PDF');
    
    var img = false;
    
    //console.log($("#image2send").attr("src"));
    
    $.ajax({
    // requete a la bdd en ajax
    url      : "save_pdf.php",
    async    : false,
    type     : "POST",
    data     : { image_src: $("#image2send").attr("src") },
    dataType : "text",
    error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
    success  : function(data) {
        console.log("PDF Généré");
        console.log(data);
        //recupere le nom fichier à ouvrir (data)
        window.open(data, '_blank', 'fullscreen=yes');
        
        }
    });
    
    
}


function init_map() {
    // set up the map
    console.log("init_map");
    map = new L.Map('map');
    
    $.ajax({
    // requete a la bdd en ajax
    url      : "requete_ajax.php",
    data     : {myvar:"identifiant_idiot"},
    type     : "POST",
    dataType : "json",
    async    : false,
    error    : function(request, error) { alert("Erreur : responseText: "+request.responseText);},
    success  : function(data) {
        polygone_geojson = data;
        }
    });
    
    layer_geojson = L.geoJson(polygone_geojson,
        {style:style_neutre,
        onEachFeature:function(feature,layer)
            {
                layer.on("mouseover",function(e){
                    console.log("survol");
                });
            }
        }
        ).addTo(map);


    // create the tile layer with correct attribution
    var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
    var osm=new L.TileLayer(osmUrl,{minZoom:1,maxZoom:20,attribution:osmAttrib});
    map.addLayer(osm);
    
    
    
    //Ajoute le bouton controle des couches avec les fonds et les layers
    overlaysMaps={"Geojson":layer_geojson };
    baseMaps={"OSM":osm};
    //ControlLayer=L.control.layers(baseMaps,overlaysMaps).addTo(map);
    

    map.fitBounds(layer_geojson.getBounds());
};


init_map();

































