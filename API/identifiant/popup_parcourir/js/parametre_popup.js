function Fonction_listing(url,id){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
	
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que ça marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que ça marche avec Internet Explorer
		
		url = url + "?Lecteur=" + escape(document.getElementById('Lecteur').value);   
		
		// On ouvre la requete vers la page désirée
		xhr_object.open("POST", url, true);
		
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV spécifiées le contenu retourné par le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);
		
		//Permet de remettre les champs a zéro vide quoi
		document.getElementById('Lecteur').value = "";   
}

function explore_dossier(url,id,input){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
	
		var xhr_object = null;
		var position = id;
		var input = input;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que ça marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que ça marche avec Internet Explorer
		
		url = url + "?Lecteur=" + escape(document.getElementById(input).value);   
		
		// On ouvre la requete vers la page désirée
		xhr_object.open("POST", url, true);
		
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV spécifiées le contenu retourné par le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);  
}

function fct_precedent(url,id){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		//On va aller chercher la valeur d'un input
		var input = document.getElementById('3').value;
		//On creer notre tableau
		var temp_url = new Array();
		temp_url = input.split('/');
		//Calcule la longueur pour savoir jusqua quand on boucle
		var nb_enreg = temp_url.length;
		
		
		if(nb_enreg > 5){
			//On fait notre boucle pour refaire le lien
			var i = 1;
			var url_new = "";
			while(i < nb_enreg-2)
			{
				url_new = url_new + '/' + temp_url[i];
				i++;
			}
			
			
			var xhr_object = null;
			var position = id;
			var input = input;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que ça marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que ça marche avec Internet Explorer
			
			url = url + "?Lecteur=" + url_new
			
			// On ouvre la requete vers la page désirée
			xhr_object.open("POST", url, true);
			
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV spécifiées le contenu retourné par le fichier
					document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);  
		}
}

function selection_fichier(input){
	var input = input;
	window.opener.document.getElementById('Fichier').value = document.getElementById(input).value;
	setTimeout("window.close();", 500);	
}

