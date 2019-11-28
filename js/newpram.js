function AjaxMare(url,id,type){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
	// if(verifie_date()){
			var xhr_object = null;
			var position = id;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			//IL FAUT DONNER LE/LES PARAMETRE A PASSER A LA PAGE, SINON IL NE RECOIT PAS DE $_POST
			if(type == "RecMareLoc"){
				url = url + "?TYPE="+type
						  + "&TYPE_CARTO="+document.getElementById('Type').value
						  + "&ID_MARE="+document.getElementById('ID_Mare').value
						  + "&L_DATE="+document.getElementById('L_DATE').value
						  + "&L_ID="+document.getElementById('L_ID').value
						  + "&L_IDSTRP="+escape(document.getElementById('L_IDSTRP').value)
						  + "&L_STRP="+document.getElementById('L_STRP').value
						  + "&L_OBSV="+document.getElementById('L_OBSV').value
						  + "&L_LIEN="+document.getElementById('L_LIEN').value
						  + "&L_NOM="+escape(document.getElementById('L_NOM').value)
						  + "&L_ADMIN="+document.getElementById('L_ADMIN').value
						  + "&L_STATUT="+document.getElementById('L_STATUT').value
						  + "&L_PROPR="+document.getElementById('L_PROPR').value
						  + "&L_COOX="+document.getElementById('L_COOX').value
						  + "&L_COOY="+document.getElementById('L_COOY').value
						  + "&L_COOX93="+document.getElementById('L_COOX93').value
						  + "&L_COOY93="+document.getElementById('L_COOY93').value
						  + "&L_PREC="+document.getElementById('L_PREC').value
						  + "&L_ANON="+document.getElementById('L_ANON').value
						  + "&C_COMT="+escape(document.getElementById('C_COMT').value);
				//Pour gerer autre de la topographie
				if(document.getElementById('L_LIEN').value == 5){
					url = url + "&L_LIEN_AUTRE="+escape(document.getElementById('L_LIEN_AUTRE').value);
				}else{
					url = url + "&L_LIEN_AUTRE=";
				}			
			}else if(type == "changer_statut"){
				url = url + "?L_ID=" +document.getElementById('L_ID').value
							+ "&TYPE="+type
							+ "&statut="+document.getElementById('L_STATUT').value;
				afficher_masquer('erreur','');
				setTimeout("afficher_masquer('erreur','');", 5000);
			}
			else if(type == "RecMareCaracterisation"){
					url = url + "?TYPE="+type
							  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
							  + "&C_DATE="+document.getElementById('C_DATE').value
							  + "&C_STRP="+document.getElementById('C_STRP').value
							  + "&C_OBSV="+document.getElementById('C_OBSV').value
							  + "&C_TYPE="+document.getElementById('C_TYPE').value
							  + "&C_VEGET="+document.getElementById('C_VEGET').value
							  + "&C_EVOLUTION="+document.getElementById('C_EVOLUTION').value
							  + "&C_ABREUV="+document.getElementById('C_ABREUV').value
							  + "&C_TOPO="+document.getElementById('C_TOPO').value;
					//Pour gerer autre de la topographie
					if(document.getElementById('C_TOPO').value == 5){
						url = url + "&C_TOPO_AUTRE="+escape(document.getElementById('C_TOPO_AUTRE').value);
					}else{
						url = url + "&C_TOPO_AUTRE=";
					}
					url = url + "&C_CLOTURE="+document.getElementById('C_CLOTURE').value
							  + "&C_HAIE="+document.getElementById('C_HAIE').value
							  + "&C_FORM="+document.getElementById('C_FORM').value
							  + "&C_PROF="+document.getElementById('C_PROF').value
							  + "&C_LONG="+document.getElementById('C_LONG').value
							  + "&C_LARG="+document.getElementById('C_LARG').value
							  + "&C_NATFOND="+document.getElementById('C_NATFOND').value;
					//Pour gerer nature fond
					if(document.getElementById('C_NATFOND').value == 5){
						url = url + "&C_NATFOND_AUTRE="+escape(document.getElementById('C_NATFOND_AUTRE').value);
					}else{
						url = url + "&C_NATFOND_AUTRE=";
					}			  
					url = url + "&C_BERGES="+document.getElementById('C_BERGES').value  
							  + "&C_BOURRELET="+document.getElementById('C_BOURRELET').value;  
					//Pour le pourcentage du bourrelet de curage
					if(document.getElementById('C_BOURRELET').value == 2){
						url = url + "&C_BOURRELET_POURCENTAGE="+escape(document.getElementById('C_BOURRELET_POURCENTAGE').value);
					}else{
						url = url + "&C_BOURRELET_POURCENTAGE=0";
					}		  
					url = url + "&C_PIETINEMENT="+document.getElementById('C_PIETINEMENT').value		  
							  + "&C_HYDROLOGIE="+document.getElementById('C_HYDROLOGIE').value
							  + "&C_TURBIDITE="+document.getElementById('C_TURBIDITE').value
							  + "&C_COULEUR="+document.getElementById('C_COULEUR').value
					//Pour la couleurs
					if(document.getElementById('C_COULEUR').value == 3){
						url = url + "&C_COULEUR_PRECISION="+escape(document.getElementById('C_COULEUR_PRECISION').value);
					}else{
						url = url + "&C_COULEUR_PRECISION=0";
					}			  
					url = url + "&C_TAMPON="+document.getElementById('C_TAMPON').value
							  + "&C_EXUTOIRE="+document.getElementById('C_EXUTOIRE').value
							  + "&C_RECOU_TOTAL="+document.getElementById('C_RECOU_TOTAL').value
							  + "&C_RECOU_HELOPHYTE="+document.getElementById('C_RECOU_HELOPHYTE').value
							  + "&C_RECOU_HYDROPHYTE_E="+document.getElementById('C_RECOU_HYDROPHYTE_E').value
							  + "&C_RECOU_HYDROPHYTE_NE="+document.getElementById('C_RECOU_HYDROPHYTE_NE').value
							  + "&C_RECOU_ALGUE="+document.getElementById('C_RECOU_ALGUE').value
							  + "&C_RECOU_EAU_LIBRE="+document.getElementById('C_RECOU_EAU_LIBRE').value
							  + "&C_RECOU_NON_VEGET="+document.getElementById('C_RECOU_NON_VEGET').value
							  + "&C_EMBROUS="+document.getElementById('C_EMBROUS').value
							  + "&C_OMBRAGE="+document.getElementById('C_OMBRAGE').value
							  + "&C_OBJEC_TRAV="+escape(document.getElementById('C_OBJEC_TRAV').value)
							  + "&C_COMT_CARAC="+escape(document.getElementById('C_COMT_CARAC').value);
				}else if(type == "RecMareCaracterisationSimplifiee"){
					url = url + "?TYPE="+type
							  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
							  + "&C_DATE="+document.getElementById('C_DATE').value
							  + "&C_STRP="+document.getElementById('C_STRP').value
							  + "&C_OBSV="+document.getElementById('C_OBSV').value
							  + "&C_TYPE="+document.getElementById('C_TYPE').value
							  + "&C_VEGET="+document.getElementById('C_VEGET').value
							  + "&C_EVOLUTION="+document.getElementById('C_EVOLUTION').value
							  // + "&C_PROF="+document.getElementById('C_PROF').value
							  + "&C_LONG="+document.getElementById('C_LONG').value
							  + "&C_LARG="+document.getElementById('C_LARG').value
							  + "&C_COMT_CARAC="+escape(document.getElementById('C_COMT_CARAC').value);
				}
				else if(type == "RecMareLocMod"){
					url = url + "?TYPE="+type
							  + "&L_ID="+escape(document.getElementById('L_ID').value)
							  + "&L_IDSTRP="+escape(document.getElementById('L_IDSTRP').value)
							  + "&L_LIEN="+document.getElementById('L_LIEN').value
							  + "&L_NOM="+escape(document.getElementById('L_NOM').value)
							  + "&L_STATUT="+document.getElementById('L_STATUT').value
							  + "&L_PROPR="+document.getElementById('L_PROPR').value
							  + "&L_ANON="+document.getElementById('L_ANON').value
							  + "&C_COMT="+escape(document.getElementById('C_COMT').value);
					//Pour gerer autre de la topographie
					if(document.getElementById('L_LIEN').value == 5){
						url = url + "&L_LIEN_AUTRE="+escape(document.getElementById('L_LIEN_AUTRE').value);
					}else{
						url = url + "&L_LIEN_AUTRE=";
					}
				}
				else if(type == 'generateur'){
					url = url + "?Identifiant_Session="+document.getElementById('Identifiant').value
							  + "&Mare="+document.getElementById('ID_MARE').value;
							  
					window.open(url);
				
				}
				else if(type == 'supprimer_mare'){
					url = url + "&TYPE="+type;
							  				
				}else if(type == "FormulaireDemandeAcces"){
				url = url + "?TYPE="+type
						  + "&STRUCTURE="+document.getElementById('STRUCTURE').value
						  + "&PERSONNE="+document.getElementById('PERSONNE').value
						  + "&EMAIL="+document.getElementById('EMAIL').value
						  + "&OBJECTIF="+document.getElementById('OBJECTIF').value
						  + "&geojson="+document.getElementById('geojson').value;
				if(document.getElementById('Localisation').checked){
					url = url + "&Localisation="+document.getElementById('Localisation').value;
				}else{
					url = url + "&Localisation=non";
				}
				if(document.getElementById('Caracterisation').checked){
					url = url + "&Caracterisation="+document.getElementById('Caracterisation').value;
				}else{
					url = url + "&Caracterisation=non";
				}
				if(document.getElementById('Observations').checked){
					url = url + "&Observations="+document.getElementById('Observations').value;
				}else{
					url = url + "&Observations=non";
				}
			}				
			//ON LE RECUPERE EN GET DERRIERE
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
			
			if(type == "RecMareLoc" || type == "RecMareCaracterisation" || type == "RecMareLocMod" || type == "RecMareCaracterisationSimplifiee"){
				setTimeout("afficher_masquer('valider','../API/mare/valider.php');", 1500);
				setTimeout("afficher_masquer('valider','');", 5000);
			}
}




///////////////////////////////////FONCTION POUR LES FILTRES//////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function test_active_atlas(){
	if(document.getElementById('ID_MARE').value == 0){
		alert("Avant de générer un atlas vous devez sélectionner une mare dans les filtres de recherche");
	}else{
		AjaxMare('generateur_cartographie/mep_cartographie.php', '', 'generateur')
	}
}


///////////////////////////////////FONCTION POUR LES LIENS//////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function load_page(url,id,type){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
	if(type == "affichage"){
		afficher_masquer('affichage','');
	}else if(type == "tableau"){
		afficher_masquer('affichage','');
	}else if(type == "affichagesaisiemare"){
		afficher_masquer('affichage','');
	}else if(type == "observateur"){
		afficher_masquer('observateur','');
	}else if(type == "allmare"){
		afficher_masquer('allmare','');
	}
	
	var xhr_object = null;
	var position = id;
	if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
	else
	if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
	//On redefinie URL
	if(type == "contact"){
		url = url + "?type_contact="+document.getElementById('type_contact').value
				  + "&contact_name="+document.getElementById('contact_name').value
				  + "&contact_email="+document.getElementById('contact_email').value
				  + "&contact_subject="+document.getElementById('contact_subject').value
				  + "&contact_text="+document.getElementById('contact_text').value;
		if(document.getElementById('contact_email_copy').checked){
			url = url + "&contact_email_copy="+document.getElementById('contact_email_copy').value;
		}else{
			url = url + "&contact_email_copy=0";
		}
	}else if(type == "identifiant"){
		url = url + "?nom_structure="+document.getElementById('nom_structure').value
				  // + "&num_fiscalite="+document.getElementById('num_fiscalite').value
				  // + "&id_sinp="+document.getElementById('id_sinp').value
				  + "&logo_structure="+document.getElementById('Fichier').value
				  + "&id_typestrucuture="+document.getElementById('type_structure').value
				  + "&id_session="+document.getElementById('id_session').value
				  + "&email="+document.getElementById('email').value
				  + "&departement="+document.getElementById('departement').value
				  + "&adresse="+document.getElementById('adresse').value
				  + "&telephone="+document.getElementById('telephone').value
				  + "&mdp="+document.getElementById('mdp').value;
		if(document.getElementById('condition').checked){
			url = url + "&condition="+document.getElementById('condition').value;
		}else{
			url = url + "&condition=0";
		}
	}else if(type == "identifiantparticulier"){
		url = url + "?nom_particulier="+document.getElementById('nom_particulier').value
				  // + "&num_fiscalite="+document.getElementById('num_fiscalite').value
				  // + "&id_sinp="+document.getElementById('id_sinp').value
				  + "&prenom_particulier="+document.getElementById('prenom_particulier').value
				  + "&id_typestrucuture="+document.getElementById('type_structure').value
				  + "&id_session="+document.getElementById('id_session').value
				  + "&email="+document.getElementById('email').value
				  + "&departement="+document.getElementById('departement').value
				  + "&adresse="+document.getElementById('adresse').value
				  + "&telephone="+document.getElementById('telephone').value
				  + "&mdp="+document.getElementById('mdp').value;
		if(document.getElementById('condition').checked){
			url = url + "&condition="+document.getElementById('condition').value;
		}else{
			url = url + "&condition=0";
		}
	}else if(type == "mdpperdu"){
		url = url + "?id_session="+document.getElementById('id_session').value
				  + "&email="+document.getElementById('email').value;
	}else if(type == "tableau"){
		url = url + "&Mare="+document.getElementById('ID_MARE').value
				  + "&Departement="+document.getElementById('ID_DEPARTEMENT').value
				  + "&Commune="+document.getElementById('ID_COMMUNE').value
				  + "&id_session="+document.getElementById('Session').value;
	}else if(type == "tableaudescription"){
		url = url + "&type=tableau";
	}else if(type == "validation"){
		url = url + "&Departement="+document.getElementById('ID_DEPARTEMENT').value;
	}else if(type == "affichageCaracMare"){
		url = url + "&ID_CARAC="+document.getElementById('ID_CARAC').value;
	}
	
	
	if(type == "affichagesaisiemare"){
		// On ouvre la requete vers la page d�sir�e
		xhr_object.open("POST", url, true);
		
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
				window.parent.document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);
		

		
		setTimeout('if (window.parent.document.getElementById("resultat_loca") != null) {document.getElementById("resultat_loca").scrollTop = 0}',3000);
		setTimeout('if (window.parent.document.getElementById("resultat_carac") != null) {document.getElementById("resultat_carac").scrollTop = 0}',2000);
		setTimeout('if (window.parent.document.getElementById("resultat_carac_edit") != null) {document.getElementById("resultat_carac_edit").scrollTop = 0}',2000);
	}else{
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
	}
	
	if(type == "affichageEditCaracMare"){
		setTimeout('if (window.parent.document.getElementById("resultat_carac_edit") != null) {document.getElementById("resultat_carac_edit").scrollTop = 0}',2000);
	}
}
////////////////////////////////////FONCTION DEPENDANTE POUR DEPARTEMENT INTERCO COMMUNE ET MARE//////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function Nom_Commune_Connexion(){
	
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Nom_Commune').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Nom_Commune.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	sel = document.getElementById('ID_DEPARTEMENT_CONNEXION');
	Num_Dep = sel.options[sel.selectedIndex].value;
	xhr.send("Num_Dep="+Num_Dep);
}

function Interco_Dep(){
	
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Nom_Interco').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Nom_Interco.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	sel = document.getElementById('ID_DEPARTEMENT');
	Num_Dep = sel.options[sel.selectedIndex].value;
	xhr.send("Num_Dep="+Num_Dep);
}


function Departement_Structure(){
	
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Nom_Departement').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Departement_Structure.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	// sel = document.getElementById('ID_DEPARTEMENT');
	idstructure = document.getElementById('idstructureconnectee').value;
	xhr.send("idstructure="+idstructure);
}

function Interco_Structure(){
	
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Nom_Interco').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Interco_Structure.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	idstructure = document.getElementById('idstructureconnectee').value;
	xhr.send("idstructure="+idstructure);
}

function Nom_Commune_Interco_Structure(){
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Nom_Commune').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Nom_Commune_Structure.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	idstructure = document.getElementById('idstructureconnectee').value;
	xhr.send("idstructure="+idstructure);
}

function Nom_Mare_Interco_Structure(idstructure,rolestructure){
	
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Num_Mare').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Nom_Mare_Structure.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	idstructure = document.getElementById('idstructureconnectee').value;
	xhr.send("idstructure="+idstructure);
	
	setTimeout("actualisemare('"+idstructure+"','"+rolestructure+"');", 1500);
}

function Nom_Commune(){
	
	var xhr = getXhr();
	// On d�fini ce qu'on va faire quand on aura la r�ponse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re�u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Nom_Commune').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Nom_Commune.php",true);
	// ne pas oublier �a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	sel = document.getElementById('ID_DEPARTEMENT');
	Num_Dep = sel.options[sel.selectedIndex].value;
	xhr.send("Num_Dep="+Num_Dep);
}

function Nom_Commune_Interco(){
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Nom_Commune').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Nom_Commune_Interco.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	sel = document.getElementById('ID_INTERCO');
	Num_Interco = sel.options[sel.selectedIndex].value;
	xhr.send("Num_Interco="+Num_Interco);
}

function Nom_Mare_Interco(){
	
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Num_Mare').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Nom_Mare_Interco.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	sel = document.getElementById('ID_INTERCO');
	Num_Interco = sel.options[sel.selectedIndex].value;
	xhr.send("Num_Interco="+Num_Interco);
}



function Mare(){
	
	var xhr = getXhr();
	// On d�fini ce qu'on va faire quand on aura la r�ponse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re�u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Num_Mare').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Num_Mare.php",true);
	// ne pas oublier �a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	sel = document.getElementById('ID_COMMUNE');
	Num_INSEE = sel.options[sel.selectedIndex].value;
	xhr.send("Num_INSEE="+Num_INSEE);
}

function Mare_Dep(){
	
	var xhr = getXhr();
	// On dꧩni ce qu'on va faire quand on aura la r걯nse
	xhr.onreadystatechange = function(){
		
		// On ne fait quelque chose que si on a tout re赠et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			
			leselect = xhr.responseText;
			
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('Num_Mare').innerHTML = leselect;
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("POST","../ajax/Num_Mare_Dep.php",true);
	// ne pas oublier 衠pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, le nom de la commune
	sel = document.getElementById('ID_DEPARTEMENT');
	Num_Dep = sel.options[sel.selectedIndex].value;
	xhr.send("Num_Dep="+Num_Dep);
}

function ActuMarePhotoloLad(idstructureconnectee,rolestructure){

	if(window.document.getElementById('ID_DEPARTEMENT').value == '0' && window.document.getElementById('ID_INTERCO').value == '0' && window.document.getElementById('ID_COMMUNE').value == '0' && window.document.getElementById('ID_MARE').value == '0'){
		actualisemare(idstructureconnectee,rolestructure);
	}else{
		AfficherMareStructure(idstructureconnectee,rolestructure);
	}
}

///////////////////////////////////FONCTION POUR L'AUTHENTIFICATION DE L'UTILISATEUR//////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function EnvoieReqConnexion(url,id){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
		
		//IL FAUT DONNER LE/LES PARAMETRE A PASSER A LA PAGE, SINON IL NE RECOIT PAS DE $_POST
		url = url + "?Identifiant="+document.getElementById('Identifiant').value + "&Password="+document.getElementById('Password').value;
		//ON LE RECUPERE EN GET DERRIERE
		
		// On ouvre la requete vers la page d�sir�e
		xhr_object.open("POST", url, true);
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);		
}

///////////////////////////////////FONCTION POUR L'AUTHENTIFICATION DE L'UTILISATEUR//////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function affichermenu(url,id){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
		
		//IL FAUT DONNER LE/LES PARAMETRE A PASSER A LA PAGE, SINON IL NE RECOIT PAS DE $_POST
		url = url + "?Identifiant="+document.getElementById('Identifiant').value;
		//ON LE RECUPERE EN GET DERRIERE
		
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
}

///////////////////////////////////FONCTION POUR L'AUTHENTIFICATION DE L'UTILISATEUR SUR LES MODULE////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function EnvoieReqConnexionModule(url,id){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
		
		//IL FAUT DONNER LE/LES PARAMETRE A PASSER A LA PAGE, SINON IL NE RECOIT PAS DE $_POST
		url = url + "&Identifiant="+document.getElementById('Identifiant').value + "&Password="+document.getElementById('Password').value;
		//ON LE RECUPERE EN GET DERRIERE
		
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
}
///////////////////////////////////FONCTION POUR LES EXPORT///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function Export(url){
	window.open(url);
}

//POUR RAFRAICHIR IMAGE CAPTCHA
function refreshCaptcha(code)
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000+"&code="+code;
}

///////////////////////////////////FONCTION POUR VERIFIER LES FORMULAIRES///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function surligne(champ, erreur){
   if(erreur)
      champ.style.backgroundColor = "#e4b285";
   else
      champ.style.backgroundColor = "";
}

function verifEmail(champ){
	 var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	if(!regex.test(champ.value)){
      surligne(champ, true);
      return false;
	}else
	{
		surligne(champ, false);
		return true;
	}
}

function veriftypestruct(champ){
	if(champ.value == 1){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifNumFiscalite(champ){
	if(champ.value == 0){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifIdentifiant(champ){
	 // Caractères autorisés
	var regex = new RegExp("[A-Z0-9-_]", "i");
	var valid;
	var surlignechamp = 0;
	for (x = 0; x < champ.value.length; x++) {
		valid = regex.test(champ.value.charAt(x));
		if (valid == false) {
			// champ.value = champ.value.substr(0, x) + champ.value.substr(x + 1, champ.value.length - x + 1); x--;
			surlignechamp++;
		}
	}
	if(surlignechamp > 0){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifDepartement(champ){
	if(champ.value != "76" && champ.value != "27" && champ.value != "14" && champ.value != "61" && champ.value != "50"){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifTelephone(champ){
	if(champ.value.length < 10 || champ.value.length > 10){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifCondition(champ){
	if(champ.checked){
		surligne(champ, false);
		return true;
	}else{
		surligne(champ, true);
		return false;
	}
}

function verifmdp(champ){
	if(champ.value != document.getElementById('mdp').value){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifcaptcha(champ,code){
	if(champ.value != code){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifchampVide(champ){
	if(champ.value == ""){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifchampDeroulant(champ){
	if(champ.value == "Tous"){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}


function verifchampDeroulantFctSelect(champ){
	if(champ.value == 0){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifdate(champ){
    var date_pas_sure = champ.value;
    var format = /^(\d{1,2}\/){2}\d{4}$/;
    if(!format.test(date_pas_sure)){
		// alert('Date non valable !');
		surligne(champ, true);
		return false;
	}
    else{
        var date_temp = date_pas_sure.split('/');
        date_temp[1] -=1;        // On rectifie le mois !!!
        var ma_date = new Date();
        ma_date.setFullYear(date_temp[2]);
        ma_date.setMonth(date_temp[1]);
        ma_date.setDate(date_temp[0]);
        if(ma_date.getFullYear()==date_temp[2] && ma_date.getMonth()==date_temp[1] && ma_date.getDate()==date_temp[0]){
            // alert('Date valable !');
			surligne(champ, false);
			return true;
        }
        else{
            // alert('Date non valable !');
			surligne(champ, true);
			return false;
        }
    }
}

function verifForm(url,id,code,type){

	if(type == 'identifiant'){
		var sessionok = verifIdentifiant(document.getElementById('id_session'));
		var sessionokvide = verifchampVide(document.getElementById('id_session'));
		
		// var NumFiscaliteok = verifNumFiscalite(document.getElementById('num_fiscalite'));
		// var idsinpok = verifNumFiscalite(document.getElementById('id_sinp'));
		var idtypestruct = veriftypestruct(document.getElementById('type_structure'));
		
		if(document.getElementById('type_structure').value != 2){
			var nomstrucutreok = verifchampVide(document.getElementById('nom_structure'));
			var logostructureok = verifchampVide(document.getElementById('Fichier'));
		}else{
			var nomparticulierok = verifchampVide(document.getElementById('nom_particulier'));
			var prenomparticulierok = verifchampVide(document.getElementById('prenom_particulier'));
		}
		var emailok = verifEmail(document.getElementById('email'));
		var departementok = verifDepartement(document.getElementById('departement'));
		var adresseok = verifchampVide(document.getElementById('adresse'));
		var telephoneok = verifTelephone(document.getElementById('telephone'));
		var conditionok = verifCondition(document.getElementById('condition'));
		var mdpok = verifmdp(document.getElementById('mdp_confirmation'));
		var mdpvide = verifchampVide(document.getElementById('mdp'));
		var captchaok = verifcaptcha(document.getElementById('captcha'),code);
	
		//SI PARTICULIER
		if(document.getElementById('type_structure').value != 2){
			if(sessionok && sessionokvide && nomstrucutreok && logostructureok && idtypestruct && emailok && departementok && adresseok && telephoneok && conditionok && mdpok && mdpvide && captchaok){
				//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
				load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
			}else{
				var xhr_object = null;
				var position = id;
				if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
				else
				if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
				
				// On ouvre la requete vers la page d�sir�e
				xhr_object.open("POST", url, true);
				xhr_object.onreadystatechange = function(){
					if ( xhr_object.readyState == 4 ){
						// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
						document.getElementById(position).innerHTML = xhr_object.responseText;
					}
				}
				// dans le cas du get
				xhr_object.send(null);
			}
		}else{
			if(sessionok && sessionokvide && nomparticulierok && prenomparticulierok && idtypestruct && emailok && departementok && adresseok && telephoneok && conditionok && mdpok && mdpvide && captchaok){
				//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
				load_page('identifiant/traitement_form.php','divFormInscription','identifiantparticulier');
			}else{
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
			}
		}
	}
	else if(type == 'Mdp'){
		var sessionok = verifIdentifiant(document.getElementById('id_session'));
		var emailok = verifEmail(document.getElementById('email'));
		var captchaok = verifcaptcha(document.getElementById('captcha'),code);
		
		if(sessionok && emailok && captchaok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			load_page('identifiant/traitement_form_mdp.php','divFormMdpPerdu','mdpperdu');
		else{
			var xhr_object = null;
			var position = id;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
			
			// On ouvre la requete vers la page d�sir�e
			xhr_object.open("POST", url, true);
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
					document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);
		}
	}
	else if(type == 'observateur'){
		var nomok = verifchampVide(document.getElementById('OBS_NOM'));
		var prenomok = verifchampVide(document.getElementById('OBS_PRENOM'));
		var structureok = verifchampVide(document.getElementById('OBS_STRUCTURE'));
		
		if(nomok && prenomok && structureok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			RecAttribut('observateurs/enregobservateur.php', 'resultat', 'observateur');
		else{
			var xhr_object = null;
			var position = id;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
			
			// On ouvre la requete vers la page d�sir�e
			xhr_object.open("POST", url, true);
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
					document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);
		}
	}
	else if(type == 'modifieobservateur'){
		//On recupere l'ID du d�but de l'url pour avoir l'id du select
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		var nomok = verifchampVide(document.getElementById('OBS_NOM_'+ID));
		var prenomok = verifchampVide(document.getElementById('OBS_PRENOM_'+ID));
		var structureok = verifchampVide(document.getElementById('OBS_STRUCTURE_'+ID));
		
		if(nomok && prenomok && structureok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			RecAttribut('observateurs/enregobservateur.php?ID='+ID, 'observateur_resultat', 'modifieobservateur');
		else{
			var xhr_object = null;
			var position = id;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
			
			// On ouvre la requete vers la page d�sir�e
			xhr_object.open("POST", url, true);
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
					document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);
		}
	}
	else if(type == 'GPX'){
		
		var dateok = verifdate(document.getElementById('OBS_STRUCTURE'));
		var obsok = verifchampDeroulantFctSelect(document.getElementById('L_OBSV'));
		var structureok = verifchampVide(document.getElementById('L_DATE'));
		var fichierok = verifchampVide(document.getElementById('uploadFile'));
		
		if(dateok && obsok && structureok && fichierok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			Import('import_gpx/importation.php', 'uploadStatus', 'GPX');
		else{
			var xhr_object = null;
			var position = id;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
			
			// On ouvre la requete vers la page d�sir�e
			xhr_object.open("POST", url, true);
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
					document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);
		}
	}
	else if(type == 'contact'){
		
		var contactok = verifchampDeroulant(document.getElementById('type_contact'));
		var nomok = verifchampVide(document.getElementById('contact_name'));
		var adresseok = verifEmail(document.getElementById('contact_email'));
		var objetok = verifchampVide(document.getElementById('contact_subject'));
		var messageok = verifchampVide(document.getElementById('contact_text'));
		
		if(contactok && nomok && adresseok && objetok && messageok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			load_page('contact/traitement_form.php','divFormMail','contact');
		else{
			var xhr_object = null;
			var position = id;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
			
			// On ouvre la requete vers la page d�sir�e
			xhr_object.open("POST", url, true);
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
					document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);
		}
	}
	else if(type == 'contact_description'){
		
		var contactok = verifchampDeroulant(document.getElementById('type_contact'));
		var nomok = verifchampVide(document.getElementById('contact_name'));
		var adresseok = verifEmail(document.getElementById('contact_email'));
		var objetok = verifchampVide(document.getElementById('contact_subject'));
		var messageok = verifchampVide(document.getElementById('contact_text'));
		
		if(contactok && nomok && adresseok && objetok && messageok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			load_page('traitement_form.php','divFormMail','contact');
		else{
			var xhr_object = null;
			var position = id;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
			
			// On ouvre la requete vers la page d�sir�e
			xhr_object.open("POST", url, true);
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
					document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);
		}
	}
}


/////////////////////////////////////////////POUR ENREGISTER LES DONNNES DES TABLE ATTRIBUTAIRE/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function RecAttribut(url,id,type,typelien){
	//On declare les variables
	var xhr_object = null;
	var position = id;
	if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
		else
	if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
	//IL FAUT DONNER LE/LES PARAMETRE A PASSER A LA PAGE, SINON IL NE RECOIT PAS DE $_POST
	if(type == 'observateur'){
		url = url + "?OBS_NOM="+escape(document.getElementById('OBS_NOM').value) 
				  + "&OBS_PRENOM="+escape(document.getElementById('OBS_PRENOM').value)
				  + "&TYPE="+type
				  + "&OBS_STRUCTURE="+document.getElementById('OBS_STRUCTURE').value;
	}
	else if(type == 'modifieobservateur'){
		//On recupere l'ID du d�but de l'url pour avoir l'id du select
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];

		url = url + "&TYPE="+type
				  + "&OBS_STRUCTURE="+document.getElementById('OBS_STRUCTURE_'+ID).value
				  + "&OBS_NOM="+document.getElementById('OBS_NOM_'+ID).value
				  + "&OBS_PRENOM="+escape(document.getElementById('OBS_PRENOM_'+ID).value);
	}
	else if(type == 'supprimeobservateur'){
		//On recupere l'ID du d�but de l'url pour avoir l'id du select
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];

		url = url + "&TYPE="+type
				  + "&OBS_STRUCTURE="+document.getElementById('OBS_STRUCTURE_'+ID).value;
	}
	else if(type == 'id_caracterisation'){
		url = url + "?ID_MARE="+document.getElementById('L_ID').value
				  + "&TYPE="+type;
	}
	else if(type == 'berge'){
		if(!isNaN(document.getElementById('C_NATBERGES_POURCENTAGE').value)){
			url = url + "?C_NATBERGES="+escape(document.getElementById('C_NATBERGES').value) 
					  + "&C_NATBERGES_POURCENTAGE="+document.getElementById('C_NATBERGES_POURCENTAGE').value
					  + "&TYPE="+type
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value;
		}else{
			document.getElementById('C_NATBERGES_POURCENTAGE').value = "Merci d'indiquer un entier";
			url = url + "?ERROR=ERROR";
		}
	}
	else if(type == 'modifieberge'){
		//On recupere l'ID du d�but de l'url pour avoir l'id du select
		var temp_ID = new Array();
		var temp_ID2 = new Array();
		temp_ID = url.split('=');
		var IDTemp = temp_ID[1];
		temp_ID2 = IDTemp.split('&');
		var ID = temp_ID2[0];
		if(!isNaN(document.getElementById('C_NATBERGES_POURCENTAGE').value)){
			url = url + "&TYPE="+type
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&C_NATBERGES_POURCENTAGE="+document.getElementById('C_NATBERGES_POURCENTAGE_'+ID).value
					  + "&C_NATBERGES="+escape(document.getElementById(ID).value);
		}else{
			document.getElementById('C_NATBERGES_POURCENTAGE').value = "Merci d'indiquer un entier";
			url = url + "?ERROR=ERROR";
		}
	}
	else if(type == 'supprimeberge'){
		url = url + "&TYPE="+type
				  + "&ID_MARE="+document.getElementById('L_ID').value;
	}
	else if(type == 'id_caracterisation'){
		url = url + "?ID_MARE="+document.getElementById('L_ID').value
				  + "&TYPE="+type;
	}
	else if(type == 'eaee'){
		url = url + "?C_EAEE="+escape(document.getElementById('C_EAEE').value) 
					  + "&TYPE="+type
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value;
	}
	else if(type == 'modifieeaee'){
		//On recupere l'ID du dꣵt de l'url pour avoir l'id du select
		var temp_ID = new Array();
		var temp_ID2 = new Array();
		temp_ID = url.split('=');
		var IDTemp = temp_ID[1];
		temp_ID2 = IDTemp.split('&');
		var ID = temp_ID2[0];
		url = url + "&TYPE="+type
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&C_EAEE="+document.getElementById(ID).value;
	}
	else if(type == 'supprimeeaee'){
		url = url + "&TYPE="+type
				  + "&ID_MARE="+document.getElementById('L_ID').value;
	}
	else if(type == 'evee'){
		url = url + "?C_EVEE="+escape(document.getElementById('C_EVEE').value) 
					  + "&C_EVEE_POURCENT="+escape(document.getElementById('C_EVEE_POURCENT').value) 
					  + "&TYPE="+type
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value;
	}
	else if(type == 'modifieevee'){
		//On recupere l'ID du dꣵt de l'url pour avoir l'id du select
		var temp_ID = new Array();
		var temp_ID2 = new Array();
		temp_ID = url.split('=');
		var IDTemp = temp_ID[1];
		temp_ID2 = IDTemp.split('&');
		var ID = temp_ID2[0];
		url = url + "&TYPE="+type
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&C_EVEE="+document.getElementById(ID).value
				  + "&C_EVEE_POURCENT="+document.getElementById('POURCENT'+ID).value;
	}
	else if(type == 'supprimeevee'){
		url = url + "&TYPE="+type
				  + "&ID_MARE="+document.getElementById('L_ID').value;
	}
	else if(type == 'checkBoxFauneAutreOutcheck'){
		url = url + "?TYPE="+type
			      + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_FAUNE="+document.getElementById('C_FAUNE_7').value;
				  
		if(document.getElementById('C_FAUNE_7').value == 7){
			url = url + "&C_FAUNE_AUTRE="+document.getElementById('C_FAUNE_AUTRE').value;	
		}
	}
	else if(type == 'checkBoxContextCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
				
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&L_CONT="+document.getElementById('L_CONT_'+ID).value;
	}
	else if(type == 'checkBoxContextOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_mare.elements.length; i++ ){
			if (document.form_mare.elements[i].type == 'checkbox' && document.form_mare.elements[i].name == 'L_CONT'){
				if (document.form_mare.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if(total <= 2){
			if(document.getElementById('L_CONT_18').checked && document.getElementById('L_CONT_'+ID).value != 18){
				url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&L_CONT="+document.getElementById('L_CONT_'+ID).value
					  + "&DISABLED=OUI";
			}else if(document.getElementById('L_CONT_'+ID).value == 18 && total > 1){
				url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&L_CONT="+document.getElementById('L_CONT_'+ID).value
					  + "&DISABLED=OUI";
			}else{
				url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&L_CONT="+document.getElementById('L_CONT_'+ID).value
					  + "&DISABLED=NON";
			}
		}else{
			url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&L_CONT="+document.getElementById('L_CONT_'+ID).value
				  + "&DISABLED=OUI";
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	else if(type == 'checkBoxPatrimoineCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_liaison.elements.length; i++ ){
			if (document.form_liaison.elements[i].type == 'checkbox' && document.form_liaison.elements[i].name == 'C_PATRIMOINE'){
				if (document.form_liaison.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if(document.getElementById('C_PATRIMOINE_6').checked && document.getElementById('C_PATRIMOINE_'+ID).value != 6){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_PATRIMOINE="+document.getElementById('C_PATRIMOINE_'+ID).value
				  + "&DISABLED=OUI";
		}else if(document.getElementById('C_PATRIMOINE_'+ID).value == 6 && total > 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_PATRIMOINE="+document.getElementById('C_PATRIMOINE_'+ID).value
				  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_PATRIMOINE="+document.getElementById('C_PATRIMOINE_'+ID).value
				  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxPatrimoineOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_patrimoine.elements.length; i++ ){
			if (document.form_patrimoine.elements[i].type == 'checkbox' && document.form_patrimoine.elements[i].name == 'C_PATRIMOINE'){
				if (document.form_patrimoine.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if(document.getElementById('C_PATRIMOINE_1').checked && document.getElementById('C_PATRIMOINE_'+ID).value != 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_PATRIMOINE="+document.getElementById('C_PATRIMOINE_'+ID).value
				  + "&DISABLED=OUI";
		}else if(document.getElementById('C_PATRIMOINE_'+ID).value == 1 && total > 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_PATRIMOINE="+document.getElementById('C_PATRIMOINE_'+ID).value
				  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_PATRIMOINE="+document.getElementById('C_PATRIMOINE_'+ID).value
				  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxPatrimoineAutreOutcheck'){
		url = url + "?TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_PATRIMOINE="+document.getElementById('C_PATRIMOINE_1').value;
				  
		if(document.getElementById('C_PATRIMOINE_6').value == 6){
			url = url + "&C_PATRIMOINE_AUTRE="+document.getElementById('C_PATRIMOINE_AUTRE').value;	
		}
	}
	else if(type == 'checkBoxLiaisonCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_liaison.elements.length; i++ ){
			if (document.form_liaison.elements[i].type == 'checkbox' && document.form_liaison.elements[i].name == 'C_LIAISON'){
				if (document.form_liaison.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if((document.getElementById('C_LIAISON_1').checked && document.getElementById('C_LIAISON_'+ID).value != 1) || (document.getElementById('C_LIAISON_7').checked && document.getElementById('C_LIAISON_'+ID).value != 7)){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_LIAISON="+document.getElementById('C_LIAISON_'+ID).value
				  + "&DISABLED=OUI";
		}else if((document.getElementById('C_LIAISON_'+ID).value == 1 && total > 1) || (document.getElementById('C_LIAISON_'+ID).value == 7 && total > 1)){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_LIAISON="+document.getElementById('C_LIAISON_'+ID).value
				  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_LIAISON="+document.getElementById('C_LIAISON_'+ID).value
				  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxLiaisonOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_liaison.elements.length; i++ ){
			if (document.form_liaison.elements[i].type == 'checkbox' && document.form_liaison.elements[i].name == 'C_LIAISON'){
				if (document.form_liaison.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if((document.getElementById('C_LIAISON_1').checked && document.getElementById('C_LIAISON_'+ID).value != 1) || (document.getElementById('C_LIAISON_7').checked && document.getElementById('C_LIAISON_'+ID).value != 7)){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_LIAISON="+document.getElementById('C_LIAISON_'+ID).value
				  + "&DISABLED=OUI";
		}else if((document.getElementById('C_LIAISON_'+ID).value == 1 && total > 1) || (document.getElementById('C_LIAISON_'+ID).value == 7 && total > 1)){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_LIAISON="+document.getElementById('C_LIAISON_'+ID).value
				  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_LIAISON="+document.getElementById('C_LIAISON_'+ID).value
				  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxLiaisonAutreOutcheck'){
		url = url + "?TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_LIAISON="+document.getElementById('C_LIAISON_6').value;
				  
		if(document.getElementById('C_LIAISON_6').value == 6){
			url = url + "&C_LIAISON_AUTRE="+document.getElementById('C_LIAISON_AUTRE').value;	
		}
	}
	else if(type == 'checkBoxAlimentationCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_alimentation.elements.length; i++ ){
			if (document.form_alimentation.elements[i].type == 'checkbox' && document.form_alimentation.elements[i].name == 'C_ALIMENTATION'){
				if (document.form_alimentation.elements[i].checked == true ){
					total ++;
				}
			}
		}

		if((document.getElementById('C_ALIMENTATION_8').checked && document.getElementById('C_ALIMENTATION_'+ID).value != 8) || (document.getElementById('C_ALIMENTATION_1').checked && document.getElementById('C_ALIMENTATION_'+ID).value != 1)){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_ALIMENTATION="+document.getElementById('C_ALIMENTATION_'+ID).value
				  + "&DISABLED=OUI";
		}else if((document.getElementById('C_ALIMENTATION_'+ID).value == 8 && total > 1) || (document.getElementById('C_ALIMENTATION_'+ID).value == 1 && total > 1)){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_ALIMENTATION="+document.getElementById('C_ALIMENTATION_'+ID).value
				  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_ALIMENTATION="+document.getElementById('C_ALIMENTATION_'+ID).value
				  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxAlimentationOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		var total = 0;
		for ( var i = 0; i <  document.form_alimentation.elements.length; i++ ){
			if (document.form_alimentation.elements[i].type == 'checkbox' && document.form_alimentation.elements[i].name == 'C_ALIMENTATION'){
				if (document.form_alimentation.elements[i].checked == true ){
					total ++;
				}
			}
		}

		if((document.getElementById('C_ALIMENTATION_8').checked && document.getElementById('C_ALIMENTATION_'+ID).value != 8) || (document.getElementById('C_ALIMENTATION_1').checked && document.getElementById('C_ALIMENTATION_'+ID).value != 1)){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_ALIMENTATION="+document.getElementById('C_ALIMENTATION_'+ID).value
				  + "&DISABLED=OUI";
		}else if((document.getElementById('C_ALIMENTATION_'+ID).value == 8 && total > 1) || (document.getElementById('C_ALIMENTATION_'+ID).value == 1 && total > 1)){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_ALIMENTATION="+document.getElementById('C_ALIMENTATION_'+ID).value
				  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_ALIMENTATION="+document.getElementById('C_ALIMENTATION_'+ID).value
				  + "&DISABLED=NON";
		}
						  
		if(document.getElementById('C_ALIMENTATION_'+ID).value == 6){
			url = url + "&C_ALIMENTATION_AUTRE="+document.getElementById('C_ALIMENTATION_AUTRE').value;	
		}
	}
	else if(type == 'checkBoxAutreAlimentationOutcheck'){
		url = url + "?TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_ALIMENTATION="+document.getElementById('C_ALIMENTATION_6').value;
				  
		if(document.getElementById('C_ALIMENTATION_6').value == 6){
			url = url + "&C_ALIMENTATION_AUTRE="+document.getElementById('C_ALIMENTATION_AUTRE').value;	
		}
	}
	else if(type == 'checkBoxFauneCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_faune.elements.length; i++ ){
			if (document.form_faune.elements[i].type == 'checkbox' && document.form_faune.elements[i].name == 'C_FAUNE'){
				if (document.form_faune.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if(document.getElementById('C_FAUNE_8').checked && document.getElementById('C_FAUNE_'+ID).value != 8){
			url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&C_FAUNE="+document.getElementById('C_FAUNE_'+ID).value
					  + "&DISABLED=OUI";
		}else if(document.getElementById('C_FAUNE_'+ID).value == 8 && total > 1){
			url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&C_FAUNE="+document.getElementById('C_FAUNE_'+ID).value
					  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&C_FAUNE="+document.getElementById('C_FAUNE_'+ID).value
					  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxFauneOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_faune.elements.length; i++ ){
			if (document.form_faune.elements[i].type == 'checkbox' && document.form_faune.elements[i].name == 'C_FAUNE'){
				if (document.form_faune.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if(document.getElementById('C_FAUNE_8').checked && document.getElementById('C_FAUNE_'+ID).value != 8){
			url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&C_FAUNE="+document.getElementById('C_FAUNE_'+ID).value
					  + "&DISABLED=OUI";
		}else if(document.getElementById('C_FAUNE_'+ID).value == 8 && total > 1){
			url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&C_FAUNE="+document.getElementById('C_FAUNE_'+ID).value
					  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
					  + "&TypeLien="+typelien
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
					  + "&C_FAUNE="+document.getElementById('C_FAUNE_'+ID).value
					  + "&DISABLED=NON";
		}				  
	}
	else if(type == 'checkBoxAutespecesCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
				
		url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_AUTESPECES="+document.getElementById('C_AUTESPECES_'+ID).value;
	}
	else if(type == 'checkBoxAutespecesOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_AUTESPECES="+document.getElementById('C_AUTESPECES_'+ID).value;
	}
	else if(type == 'checkBoxAutespecesAutreOutcheck'){
		url = url + "?TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_AUTESPECES="+document.getElementById('C_AUTESPECES_5').value;
				  
		if(document.getElementById('C_AUTESPECES_5').value == 5){
			url = url + "&C_AUTESPECES_AUTRE="+document.getElementById('C_AUTESPECES_AUTRE').value;	
		}
	}
	else if(type == 'checkBoxDechetsCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_dechets.elements.length; i++ ){
			if (document.form_dechets.elements[i].type == 'checkbox' && document.form_dechets.elements[i].name == 'C_FAUNE'){
				if (document.form_dechets.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if(document.getElementById('C_DECHETS_1').checked && document.getElementById('C_DECHETS_'+ID).value != 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_DECHETS="+document.getElementById('C_DECHETS_'+ID).value
					  + "&DISABLED=OUI";
		}else if(document.getElementById('C_DECHETS_'+ID).value == 1 && total > 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_DECHETS="+document.getElementById('C_DECHETS_'+ID).value
					  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_DECHETS="+document.getElementById('C_DECHETS_'+ID).value
					  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxDechetsOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		//POUR COMPTER LES CHECKBOX COCHEES
		var total = 0;
		for ( var i = 0; i <  document.form_dechets.elements.length; i++ ){
			if (document.form_dechets.elements[i].type == 'checkbox' && document.form_dechets.elements[i].name == 'C_DECHETS'){
				if (document.form_dechets.elements[i].checked == true ){
					total ++;
				}
			}
		}
		
		if(document.getElementById('C_DECHETS_1').checked && document.getElementById('C_DECHETS_'+ID).value != 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_DECHETS="+document.getElementById('C_DECHETS_'+ID).value
					  + "&DISABLED=OUI";
		}else if(document.getElementById('C_DECHETS_'+ID).value == 1 && total > 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_DECHETS="+document.getElementById('C_DECHETS_'+ID).value
					  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_DECHETS="+document.getElementById('C_DECHETS_'+ID).value
					  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxUsageCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
				
		url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_USAGE="+document.getElementById('C_USAGE_'+ID).value;
	}
	else if(type == 'checkBoxUsageOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_USAGE="+document.getElementById('C_USAGE_'+ID).value;
	}
	else if(type == 'checkBoxTravauxCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		var total = 0;
		for ( var i = 0; i <  document.form_travaux.elements.length; i++ ){
			if (document.form_travaux.elements[i].type == 'checkbox' && document.form_travaux.elements[i].name == 'C_TRAVAUX'){
				if (document.form_travaux.elements[i].checked == true ){
					total ++;
				}
			}
		}

		if(document.getElementById('C_TRAVAUX_1').checked && document.getElementById('C_TRAVAUX_'+ID).value != 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_TRAVAUX="+document.getElementById('C_TRAVAUX_'+ID).value
				  + "&DISABLED=OUI";
		}else if(document.getElementById('C_TRAVAUX_'+ID).value == 1 && total > 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_TRAVAUX="+document.getElementById('C_TRAVAUX_'+ID).value
				  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_TRAVAUX="+document.getElementById('C_TRAVAUX_'+ID).value
				  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxTravauxOutcheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		
		var total = 0;
		for ( var i = 0; i <  document.form_travaux.elements.length; i++ ){
			if (document.form_travaux.elements[i].type == 'checkbox' && document.form_travaux.elements[i].name == 'C_TRAVAUX'){
				if (document.form_travaux.elements[i].checked == true ){
					total ++;
				}
			}
		}

		if(document.getElementById('C_TRAVAUX_1').checked && document.getElementById('C_TRAVAUX_'+ID).value != 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_TRAVAUX="+document.getElementById('C_TRAVAUX_'+ID).value
				  + "&DISABLED=OUI";
		}else if(document.getElementById('C_TRAVAUX_'+ID).value == 1 && total > 1){
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_TRAVAUX="+document.getElementById('C_TRAVAUX_'+ID).value
				  + "&DISABLED=OUI";
		}else{
			url = url + "&TYPE="+type
				  + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_TRAVAUX="+document.getElementById('C_TRAVAUX_'+ID).value
				  + "&DISABLED=NON";
		}
	}
	else if(type == 'checkBoxTravauxAutreOutcheck'){
		url = url + "?TYPE="+type
			      + "&TypeLien="+typelien
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&ID_CARAC="+document.getElementById('ID_CARAC').value
				  + "&C_TRAVAUX="+document.getElementById('C_TRAVAUX_13').value;
				  
		if(document.getElementById('C_TRAVAUX_13').value == 13){
			url = url + "&C_TRAVAUX_AUTRE="+document.getElementById('C_TRAVAUX_AUTRE').value;	
		}
	}
	else if(type == 'Identifiant'){
		url = url + "?INSEE="+document.getElementById('L_ADMIN').value;
	}
	else if(type == 'faune_flore'){
		url = url + "?TYPE="+type
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&DATE="+document.getElementById('O_DATE').value
				  + "&TAXON="+escape(document.getElementById('O_NLAT').value)
				  + "&NBRE="+document.getElementById('O_NBRE').value
				  + "&METHODE_ACQUISITION="+escape(document.getElementById('O_NBRT').value)
				  + "&TECH_ACQ="+escape(document.getElementById('O_SACQ').value)
				  + "&COLLECTE="+escape(document.getElementById('O_STYP').value)
				  + "&COMMENTAIRE="+escape(document.getElementById('O_COMT').value)
				  + "&OBSERVATEUR="+escape(document.getElementById('O_OBSV').value)
				  + "&STRUCTURE="+escape(document.getElementById('O_STRP').value);
	}
	else if(type == 'faune_flore_dupliquer'){
		url = url + "?TYPE="+type
				  + "&ID_MARE="+document.getElementById('L_ID').value
				  + "&DATE="+document.getElementById('O_DATE').value
				  + "&TAXON="+escape(document.getElementById('O_NLAT').value)
				  + "&NBRE="+document.getElementById('O_NBRE').value
				  + "&METHODE_ACQUISITION="+escape(document.getElementById('O_NBRT').value)
				  + "&TECH_ACQ="+escape(document.getElementById('O_SACQ').value)
				  + "&COLLECTE="+escape(document.getElementById('O_STYP').value)
				  + "&COMMENTAIRE="+escape(document.getElementById('O_COMT').value)
				  + "&OBSERVATEUR="+escape(document.getElementById('O_OBSV').value)
				  + "&STRUCTURE="+escape(document.getElementById('O_STRP').value);
	}
	else if(type == 'modifiefaune_flore'){
		//On recupere l'ID du dꣵt de l'url pour avoir l'id du select
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		var temp_ID2 = new Array();
		temp_ID2 = ID.split('&');
		var ID2 = temp_ID2[0];
			url = url + "&TYPE="+type
					  + "&ID_MARE="+document.getElementById('L_ID').value
					  + "&DATE="+document.getElementById('O_DATE_'+ID2).value
					  + "&TAXON="+escape(document.getElementById('O_NLAT_'+ID2).value)
					  + "&NBRE="+document.getElementById('O_NBRE_'+ID2).value
					  + "&METHODE_ACQUISITION="+escape(document.getElementById('O_NBRT_'+ID2).value)
					  + "&TECH_ACQ="+escape(document.getElementById('O_SACQ_'+ID2).value)
					  + "&COLLECTE="+document.getElementById('O_STYP_'+ID2).value
					  + "&COMMENTAIRE="+escape(document.getElementById('O_COMT_'+ID2).value);
	}
	else if(type == 'supprimefaune_flore'){
		url = url + "&TYPE="+type
				  + "&ID_MARE="+document.getElementById('L_ID').value;
	}
	else if(type == 'VerifCoordComm'){
		if((document.getElementById('L_COOX').value == "" && document.getElementById('L_COOY').value == "") && (document.getElementById('L_COOX93').value != "" && document.getElementById('L_COOY93').value != "")){
			url = url + "?CoordX="+document.getElementById('L_COOX93').value
					  + "&CoordY="+document.getElementById('L_COOY93').value
					  + "&INSEE="+document.getElementById('L_ADMIN').value
					  + "&SysCoord=L93";
		}else if((document.getElementById('L_COOX93').value == "" && document.getElementById('L_COOY93').value == "") && (document.getElementById('L_COOX').value != "" && document.getElementById('L_COOY').value != "")){
			url = url + "?CoordX="+document.getElementById('L_COOX').value
					  + "&CoordY="+document.getElementById('L_COOY').value
					  + "&INSEE="+document.getElementById('L_ADMIN').value
					  + "&SysCoord=LatLng";
		}else if((document.getElementById('L_COOX93').value != "" && document.getElementById('L_COOY93').value != "") && (document.getElementById('L_COOX').value != "" && document.getElementById('L_COOY').value != "")){
			url = url + "?CoordX="+document.getElementById('L_COOX').value
					  + "&CoordY="+document.getElementById('L_COOY').value
					  + "&INSEE="+document.getElementById('L_ADMIN').value
					  + "&SysCoord=LatLng";
		}else if(document.getElementById('L_COOX93').value == "" && document.getElementById('L_COOY93').value == "" && document.getElementById('L_COOX').value == "" && document.getElementById('L_COOY').value == ""){
			url = url + "?CoordX=0&CoordY=0"
					  + "&INSEE="+document.getElementById('L_ADMIN').value
					  + "&SysCoord=LatLng";
		}
	}
	else if(type == 'VerifIDConnexion'){
		url = url + "?Identifiant="+document.getElementById('id_session').value;
	}
	else if(type == 'checkBoxSymptomeCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
				
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_symptome="+document.getElementById('l_symptome_'+ID).value;
	}
	else if(type == 'checkBoxSymptomeOutCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_symptome="+document.getElementById('l_symptome_'+ID).value;
	}
	else if(type == 'checkBoxContextAmontCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
				
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_context_amont="+document.getElementById('l_context_amont_'+ID).value;
	}
	else if(type == 'checkBoxContextAmontOutCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_context_amont="+document.getElementById('l_context_amont_'+ID).value;
	}
	else if(type == 'checkBoxContextAmontAutreOutcheck'){
		url = url + "?TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_context_amont="+document.getElementById('l_context_amont_8').value;
				  
		if(document.getElementById('l_context_amont_8').value == 8){
			url = url + "&l_context_amont_autre="+document.getElementById('l_context_amont_autre').value;	
		}
	}
	else if(type == 'checkBoxContextRapprocheCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
				
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_context_rapproche="+document.getElementById('l_context_rapproche_'+ID).value;
	}
	else if(type == 'checkBoxContextRapprocheOutCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_context_rapproche="+document.getElementById('l_context_rapproche_'+ID).value;
	}
	else if(type == 'checkBoxContextRapprocheAutreOutcheck'){
		url = url + "?TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_context_rapproche="+document.getElementById('l_context_rapproche_8').value;
				  
		if(document.getElementById('l_context_rapproche_8').value == 8){
			url = url + "&l_context_rapproche_autre="+document.getElementById('l_context_rapproche_autre').value;	
		}
	}
	else if(type == 'checkBoxContextAvalCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
				
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_context_aval="+document.getElementById('l_context_aval_'+ID).value;
	}
	else if(type == 'checkBoxContextAvalOutCheck'){
		var temp_ID = new Array();
		temp_ID = url.split('=');
		var ID = temp_ID[1];
		url = url + "&TYPE="+type
			      + "&TypeLien="+typelien
				  + "&id_mare="+document.getElementById('l_id').value
				  + "&l_context_aval="+document.getElementById('l_context_aval_'+ID).value;
	}
	else if(type == 'listeespece'){
		if(document.getElementById('groupe_espece_flore').checked){
			url = url + "?ordre="+document.getElementById('groupe_espece_flore').value;
		}else if(document.getElementById('groupe_espece_odonate').checked){
			url = url + "?ordre="+document.getElementById('groupe_espece_odonate').value;
		}else if(document.getElementById('groupe_espece_amphibien').checked){
			url = url + "?ordre="+document.getElementById('groupe_espece_amphibien').value;
		}
	}else if(type == 'listeosacq'){
		if(document.getElementById('groupe_espece_flore').checked){
			url = url + "?ordre="+document.getElementById('groupe_espece_flore').value;
		}else if(document.getElementById('groupe_espece_odonate').checked){
			url = url + "?ordre="+document.getElementById('groupe_espece_odonate').value;
		}else if(document.getElementById('groupe_espece_amphibien').checked){
			url = url + "?ordre="+document.getElementById('groupe_espece_amphibien').value;
		}
	}
	
	
	// On ouvre la requete vers la page d�sir�e
	xhr_object.open("POST", url, true);
	xhr_object.onreadystatechange = function(){
		if ( xhr_object.readyState == 4 ){
			// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
			document.getElementById(position).innerHTML = xhr_object.responseText;
		}
	}
	// dans le cas du get
	xhr_object.send(null);
	
	//ON EFFACE LES CHAMP
	if(type == 'observateur'){
		document.getElementById('OBS_NOM').value = "";
		document.getElementById('OBS_PRENOM').value = "";
	}
	else if(type == 'faune_flore'){
		document.getElementById('O_DATE').value = "";
		document.getElementById('O_NLAT').value = 0;
		document.getElementById('O_NBRE').value = "";
		document.getElementById('O_NBRT').value = 0;
		document.getElementById('O_SACQ').value = 0;
		document.getElementById('O_STYP').value = 0;
		document.getElementById('O_COMT').value = "";
	}else if(type == 'faune_flore_dupliquer'){
		document.getElementById('O_NLAT').value = 0;
		document.getElementById('O_COMT').value = "";
	}else if(type == 'eaee'){
		document.getElementById('C_EAEE').value = 0;
	}else if(type == 'evee'){
		document.getElementById('C_EVEE').value = 0;
		document.getElementById('C_EVEE_POURCENT').value = 1;
	}
}

function verifSomme(champ){
	if(champ.value == "100"){
		surligne(champ, false);
		return true;
	}else{
		surligne(champ, true);
		return false;
	}
}

function maj_total_recouvrement(){
	helophyte = document.getElementById('C_RECOU_HELOPHYTE').value;
	hydrophyte_e = document.getElementById('C_RECOU_HYDROPHYTE_E').value;
	hydrophyte_ne = document.getElementById('C_RECOU_HYDROPHYTE_NE').value;
	algue = document.getElementById('C_RECOU_ALGUE').value;
	eau_libre = document.getElementById('C_RECOU_EAU_LIBRE').value;
	non_veget = document.getElementById('C_RECOU_NON_VEGET').value;

	document.getElementById('C_RECOU_TOTAL').value = parseInt(helophyte) + parseInt(hydrophyte_e) + parseInt(hydrophyte_ne) + parseInt(algue) + parseInt(eau_libre) + parseInt(non_veget);
	
	verifSomme(document.getElementById('C_RECOU_TOTAL'));
}


function CoordXL93(){
	var Long = document.getElementById('L_COOX').value;
	var Lat = document.getElementById('L_COOY').value;

}

//////////////////POUR GENERATOR DE CARTE////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function capture2() {
        $('#target').html2canvas({
            onrendered: function (canvas) {
                //Set hidden field's value to image data (base-64 string)
                $('#img_val').val(canvas.toDataURL("image/png"));
                //Submit the form manually
                document.getElementById("myForm").submit();
            }
        });
    }
	
function capture3() {	
	var element = $('#target');
	html2canvas(element, {
			useCORS: true,
			onrendered: function(canvas) {
				var dataUrl= canvas.toDataURL("image/png");
				document.write('<img src="'+dataUrl+'" />');
			}
		});
}

function capture() {	
	html2canvas($('#target'), {
	//html2canvas(document.getElementById('map'), {
	useCORS: true,
	// proxy: './html2canvasproxy.php',
	logging : true,
	onrendered: function(canvas) {
	var myImage = canvas.toDataURL("image/png");
	window.open(myImage);
	}
	});
}

 function imagen()
	{
		var html2obj = html2canvas($('#map_canvas'));
		var queue  = html2obj.parse();
		var canvas = html2obj.render(queue);
		var img = canvas.toDataURL();
		window.open(img);
	};

///////////////////////////////////FONCTION POUR GENERER LA FICHE DE DESCRIPTION PDF///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function fiche(url){
	url = url + "&ID_CARAC="+document.getElementById('ID_CARAC').value
	window.open(url);
}

///////////////////////////////////FONCTION POUR GENERER LA FICHE DE DESCRIPTION PDF///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function fiche_localisation(url){
	window.open(url);
}		

////////////////////////////////////////////////////////////POUR LA VALIDATION///////////////////////////////////////////////////////
function Coche_Case(url,Element,id){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
		
		url = url + "&Element=" + Element;
		
		// On ouvre la requete vers la page d�sir�e
		xhr_object.open("POST", url, true);
		
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);
}


///////////////////////////////////////////////////////////AFFICHER MASQUER//////////////////////////////////////
function afficher_masquer(type,ID){
	if(type == 'import_carac'){
		var valeur_visibility = document.getElementById("import_carac").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("import_carac").style.display = 'none';
		}else{
			document.getElementById("import_carac").style.display = 'inline';
	   }
	}
	else if(type == 'import_observation'){
		var valeur_visibility = document.getElementById("import_observation").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("import_observation").style.display = 'none';
		}else{
			document.getElementById("import_observation").style.display = 'inline';
	   }
	}
	else if(type == 'photolocalisation'){
		var valeur_visibility = document.getElementById("photolocalisation").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("photolocalisation").style.display = 'none';
		}else{
			document.getElementById("photolocalisation").style.display = 'inline';
	   }
	}
	else if(type == 'photocaracterisation'){
		var valeur_visibility = document.getElementById("photocaracterisation").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("photocaracterisation").style.display = 'none';
		}else{
			document.getElementById("photocaracterisation").style.display = 'inline';
	   }
	}
	else if(type == 'schemacaracterisation'){
		var valeur_visibility = document.getElementById("schemacaracterisation").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("schemacaracterisation").style.display = 'none';
		}else{
			document.getElementById("schemacaracterisation").style.display = 'inline';
	   }
	}
	else if(type == 'caracterisation'){
		var valeur_visibility = document.getElementById("caracterisation_mare").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("caracterisation_mare").style.display = 'none';
		}else{
			document.getElementById("caracterisation_mare").style.display = 'inline';
	   }
	}
	else if(type == 'bourrelet'){
		var bourrelet = document.getElementById("C_BOURRELET").value
		if (bourrelet == '3' || bourrelet == '1'){
			document.getElementById("bouret_pourcetage").style.display = 'none';
		}else if(bourrelet == '2'){
			document.getElementById("bouret_pourcetage").style.display = 'inline';
	   }
	}
	else if(type == 'topo'){
		var bourrelet = document.getElementById("C_TOPO").value
		if(bourrelet == 5){
			document.getElementById("topo_autre").style.display = 'inline';
	   }else{
			document.getElementById("topo_autre").style.display = 'none';
	   }
	}
	else if(type == 'liaison'){
		var liaison = document.getElementById("C_LIAISON_"+ID).value
		if(liaison == 6 && document.getElementById("C_LIAISON_"+ID).checked){
			document.getElementById("liaison_autre").style.display = 'inline';
	   }else{
			document.getElementById("liaison_autre").style.display = 'none';
	   }
	}
	else if(type == 'patrimoine'){
		var patrimoine = document.getElementById("C_PATRIMOINE_"+ID).value
		if(patrimoine == 6 && document.getElementById("C_PATRIMOINE_"+ID).checked){
			document.getElementById("patrimoine_autre").style.display = 'inline';
	   }else{
			document.getElementById("patrimoine_autre").style.display = 'none';
	   }
	}
	else if(type == 'alimentation'){
		var alimentation = document.getElementById("C_ALIMENTATION_"+ID).value
		if(alimentation == 7 && document.getElementById("C_ALIMENTATION_"+ID).checked){
			document.getElementById("alimentation_autre").style.display = 'inline';
	   }else{
			document.getElementById("alimentation_autre").style.display = 'none';
	   }
	}
	else if(type == 'faune_resultat'){
		var faune_resultat = document.getElementById("C_FAUNE_"+ID).value
		if((faune_resultat == 7) && document.getElementById("C_FAUNE_"+ID).checked){
			document.getElementById("faunistique_autre").style.display = 'inline';
	   }else{
			document.getElementById("faunistique_autre").style.display = 'none';
	   }
	}
	else if(type == 'autespeces'){
		var autespeces = document.getElementById("C_AUTESPECES_"+ID).value
		if((autespeces == 5 || autespeces == 4) && document.getElementById("C_AUTESPECES_"+ID).checked){
			document.getElementById("autespeces_autre").style.display = 'inline';
	   }else{
			document.getElementById("autespeces_autre").style.display = 'none';
	   }
	}
	else if(type == 'exotique'){
		var exotique = document.getElementById("C_EXOTIQUE").value
		if(exotique == 4){
			document.getElementById("exotique_precision").style.display = 'inline';
	   }else{
			document.getElementById("exotique_precision").style.display = 'none';
	   }
	}
	else if(type == 'patrimoine'){
		var patrimoine = document.getElementById("C_PATRIMOINE").value
		if(patrimoine == 6){
			document.getElementById("patrimoine_autre").style.display = 'inline';
	   }else{
			document.getElementById("patrimoine_autre").style.display = 'none';
	   }
	}
	else if(type == 'naturefond'){
		var naturefond = document.getElementById("C_NATFOND").value
		if(naturefond == 5){
			document.getElementById("naturefond_autre").style.display = 'inline';
	   }else{
			document.getElementById("naturefond_autre").style.display = 'none';
	   }
	}
	else if(type == 'liaison_resultat'){
		var liaison_resultat = document.getElementById("C_LIAISON_"+ID).value
		if((liaison_resultat == 6) && document.getElementById("C_LIAISON_"+ID).checked){
			document.getElementById("liaison_autre").style.display = 'inline';
	   }else{
			document.getElementById("liaison_autre").style.display = 'none';
	   }
	}
	else if(type == 'alimentation_resultat'){
		var alimentation_resultat = document.getElementById("C_ALIMENTATION_"+ID).value
		if((alimentation_resultat == 7) && document.getElementById("C_ALIMENTATION_"+ID).checked){
			document.getElementById("alimentation_autre").style.display = 'inline';
	   }else{
			document.getElementById("alimentation_autre").style.display = 'none';
	   }
	}
	else if(type == 'couleur'){
		var couleur = document.getElementById("C_COULEUR").value
		if(couleur == 3){
			document.getElementById("couleur_precision").style.display = 'inline';
	   }else{
			document.getElementById("couleur_precision").style.display = 'none';
	   }
	}
	else if(type == 'travaux_resultat'){
		if(document.getElementById("Travaux_Envisager_Oui").checked){
			document.getElementById("travaux_resultat").style.display = 'inline';
	   }else{
			document.getElementById("travaux_resultat").style.display = 'none';
	   }
	}
	else if(type == 'travaux'){
		var travaux = document.getElementById("C_TRAVAUX_"+ID).value
		if(travaux == 13 && document.getElementById("C_TRAVAUX_"+ID).checked){
			document.getElementById("travaux_autre").style.display = 'inline';
	   }else{
			document.getElementById("travaux_autre").style.display = 'none';
	   }
	}
	else if(type == 'observation'){
		var valeur_visibility = document.getElementById("observation_mare").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("observation_mare").style.display = 'none';
		}else{
			document.getElementById("observation_mare").style.display = 'inline';
	   }
	}
	else if(type == 'lien'){
		var lien = document.getElementById("L_LIEN").value
		if(lien == 5){
			document.getElementById("lien_autre").style.display = 'inline';
	   }else{
			document.getElementById("lien_autre").style.display = 'none';
	   }
	}
	else if(type == 'typestrucutre'){
		var typestructure = document.getElementById("type_structure").value
		if (typestructure == 2){
			document.getElementById("type_strucutre").style.display = 'none';
			document.getElementById("particulier").style.display = 'inline';
		}else{
			document.getElementById("type_strucutre").style.display = 'inline';
			document.getElementById("particulier").style.display = 'none';
	   }
	}else if(type == 'context_amont'){
		var context_amont = document.getElementById("l_context_amont_"+ID).value
		if(context_amont == 8 && document.getElementById("l_context_amont_"+ID).checked){
			document.getElementById("context_amont_autre").style.display = 'inline';
	   }else{
			document.getElementById("context_amont_autre").style.display = 'none';
	   }
	}else if(type == 'context_rapproche'){
		var context_amont = document.getElementById("l_context_rapproche_"+ID).value
		if(context_amont == 8 && document.getElementById("l_context_rapproche_"+ID).checked){
			document.getElementById("context_rapproche_autre").style.display = 'inline';
	   }else{
			document.getElementById("context_rapproche_autre").style.display = 'none';
	   }
	}else if(type == 'connexion'){
		var valeur_visibility = document.getElementById("formconnexion").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("formconnexion").style.display = 'none';
			
			var xhr_object = null;
			var position = "connexion";
			var url = ID;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			url = url + '?type=fermer';
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
		}else{
			document.getElementById("formconnexion").style.display = 'inline';
			
			var xhr_object = null;
			var position = "connexion";
			var url = ID;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			url = url + '?type=connexion';
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
	   }	   
	}else if(type == 'bienvenue'){
		var valeur_visibility = document.getElementById("formconnexion").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("formconnexion").style.display = 'none';
			
			var xhr_object = null;
			var position = "connexion";
			var url = ID;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			url = url + '?type=bienvenue';
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
		}	   
	}else if(type == 'affichage'){
		var valeur_visibility = document.getElementById("affichage").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("affichage").style.display = 'none';
			
			
			var xhr_object = null;
			var position = "affichage";
			var url = ID;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			url = url + '?type=bienvenue';
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
			if (document.getElementById("resultat_loca") != null) {document.getElementById("resultat_loca").scrollTop = 0};
			if (document.getElementById("resultat_carac") != null) {document.getElementById("resultat_carac").scrollTop = 0};
			if (document.getElementById("resultat_carac_edit") != null) {document.getElementById("resultat_carac_edit").scrollTop = 0};
		}else{
			document.getElementById("affichage").style.display = 'inline';
			// document.getElementById("resultat_loca").scrollTop = 0;
			
	   }
	}else if(type == 'affichagesaisiemare'){
		var valeur_visibility = window.parent.document.getElementById("affichage").style.display;
		if (valeur_visibility == 'inline'){
			window.parent.document.getElementById("affichage").style.display = 'none';
			
		}else{
			window.parent.document.getElementById("affichage").style.display = 'inline';
			
	   }
	}else if(type == 'search'){
		var valeur_visibility = document.getElementById("search").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("search").style.display = 'none';
		}else{
			document.getElementById("search").style.display = 'inline';
	   }
	}else if(type == 'observateur'){
		var valeur_visibility = document.getElementById("observateur").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("observateur").style.display = 'none';
		}else{
			document.getElementById("observateur").style.display = 'inline';
	   }
	}else if(type == 'allmare'){
		var valeur_visibility = document.getElementById("allmare").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("allmare").style.display = 'none';
		}else{
			document.getElementById("allmare").style.display = 'inline';
	   }
    }else if(type == 'menupram'){
		var valeur_visibility = document.getElementById("menupram").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("menupram").style.display = 'none';
		}else{
			document.getElementById("menupram").style.display = 'inline';
	   }
	}else if(type == 'edit'){
		var valeur_visibility = document.getElementById("edit").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("edit").style.display = 'none';
		}else{
			document.getElementById("edit").style.display = 'inline';
	   }
	}else if(type == 'import'){
		var valeur_visibility = document.getElementById("import").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("import").style.display = 'none';
		}else{
			document.getElementById("import").style.display = 'inline';
	   }
	}else if(type == 'export'){
		var valeur_visibility = document.getElementById("export").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("export").style.display = 'none';
		}else{
			document.getElementById("export").style.display = 'inline';
	   }
	}else if(type == 'info'){
		var valeur_visibility = document.getElementById("info").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("info").style.display = 'none';
		}else{
			document.getElementById("info").style.display = 'inline';
	   }
	}else if(type == 'menu'){
		var valeur_visibility = document.getElementById("formconnexion").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("formconnexion").style.display = 'none';
		}else{	
			var xhr_object = null;
			var position = "menu";
			var url = ID;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			url = url + '?type=menu';
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
		}	   
	}else if(type == 'erreur_connexion'){
		var valeur_visibility = document.getElementById("erreur_connexion").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("erreur_connexion").style.display = 'none';
		}else{
			document.getElementById("erreur_connexion").style.display = 'inline';
			
			var xhr_object = null;
			var position = "erreur_connexion";
			var url = ID;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			url = url;
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
			
			setTimeout("afficher_masquer('erreur_connexion','')",5000);
		}
	}else if(type == 'valider'){
		var valeur_visibility = document.getElementById("valider").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("valider").style.display = 'none';
			if (document.getElementById("resultat_loca") != null) {document.getElementById("resultat_loca").scrollTop = 0};
		}else{
			document.getElementById("valider").style.display = 'inline';
			
			var xhr_object = null;
			var position = "valider";
			var url = ID;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			url = url + '?type=enregistrmentmare';
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
		}	   
	}else if(type == 'supprimephotoloca'){
		var valeur_visibility = window.parent.document.getElementById("valider").style.display;
		if (valeur_visibility == 'inline'){
			window.parent.document.getElementById("valider").style.display = 'none';
		}else{
			window.parent.document.getElementById("valider").style.display = 'inline';
			
			var xhr_object = null;
			var position = "valider";
			var url = ID;
			if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
			else
			if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
			
			url = url + '?type=supprimephotoloca';
			// On ouvre la requete vers la page d괩rꥍ
			xhr_object.open("POST", url, true);
			
			xhr_object.onreadystatechange = function(){
				if ( xhr_object.readyState == 4 ){
					// j'affiche dans la DIV spꤩfi꦳ le contenu retourn顰ar le fichier
					window.parent.document.getElementById(position).innerHTML = xhr_object.responseText;
				}
			}
			// dans le cas du get
			xhr_object.send(null);
		}	   
	}else if(type == 'exporthorsconnexion'){
		var valeur_visibility = document.getElementById("exporthorsconnexion").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("exporthorsconnexion").style.display = 'none';
		}else{
			document.getElementById("exporthorsconnexion").style.display = 'inline';
	   }
	}else if(type == 'outildessin'){
		var valeur_visibility = document.getElementById("outildessin").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("outildessin").style.display = 'none';
		}else{
			document.getElementById("outildessin").style.display = 'inline';
	   }
	}else if(type == 'erreur'){
		var valeur_visibility = document.getElementById("erreur").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("erreur").style.display = 'none';
		}else{
			document.getElementById("erreur").style.display = 'inline';
	   }
	}else if(type == 'bodypage'){
			document.getElementById("bodypage").style.display = 'none';
	}else if(type == 'legendedetaillee'){
		var valeur_visibility = document.getElementById("legendedetaillee").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("legendedetaillee").style.display = 'none';
		}else{
			document.getElementById("legendedetaillee").style.display = 'inline';
	   }
	}else if(type == 'legend'){
		var valeur_visibility = document.getElementById("legend").style.display;
		if (valeur_visibility == 'inline'){
			document.getElementById("legend").style.display = 'none';
		}else{
			document.getElementById("legend").style.display = 'inline';
	   }
	} 
}


function SupprimerCaracterisation(url,id){
//INTEGRER LA FONCTION SUPPRIMER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
	if(supprimer()){
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
	}
	actualisemare();
	
	afficher_masquer('affichage','');
}


//Script pour message d'alert quand on supprime
function supprimer(){
	if(confirm("Etes vous sur de vouloir supprimer la caractérisation ?")){
		return true;
	}
	else{
		return false;
	}
}


//////////////////////////////////POUR LA GESTION DAFFICHAGE PAR PAGE//////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function Page(url,id){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que �a marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que �a marche avec Internet Explorer
		
		url = url + "&Mare="+document.getElementById('ID_MARE').value
					  + "&Departement="+document.getElementById('ID_DEPARTEMENT').value
					  + "&Commune="+document.getElementById('ID_COMMUNE').value
					  + "&id_session="+document.getElementById('Session').value;
					  
		// On ouvre la requete vers la page d�sir�e
		xhr_object.open("POST", url, true);
		
		xhr_object.onreadystatechange = function(){
			if ( xhr_object.readyState == 4 ){
				// j'affiche dans la DIV sp�cifi�es le contenu retourn� par le fichier
				document.getElementById(position).innerHTML = xhr_object.responseText;
			}
		}
		// dans le cas du get
		xhr_object.send(null);
}

/////////////////////////////////////////////////POUR LES FICHES DEPOT/////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function Export_Fiche_Depot(url){
	
	url = url + "&Date_Debut="+document.getElementById('Date_Debut').value
			      + "&Date_Fin="+document.getElementById('Date_Fin').value;
				  
	window.open(url)
}


/////////////////////////////////////////////////POUR LES PARCOURIR LOGO/////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function affichage_popup_parcourir(event){
	
	// souris(event);	
	
	window.open ('identifiant/popup_parcourir/popup.php','Parcourir',config='height=450, width=450, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');
}


function confirmecoordonneeGPS(url){
	if (confirm("Souhaitez-vous localiser une nouvelle mare maintenant ?")) { // Clic sur OK
		//PERMET D'OUVIR LA POPUP
		load_page(url, 'affichage', 'affichage');
		// window.open(url, 'Parcourir', config='height=900, width=1800, toolbar=no, menubar=no, scrollbars=yes, resizable=no, location=no, directories=no, status=no');
	}
}



//////////////////////////////FONCTION POUR MODULE PRAM////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function acces_module(url,id,type){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
					 
		//ON LE RECUPERE EN GET DERRIERE
		
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
}

function import_mare(url,id){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
					 
		//ON LE RECUPERE EN GET DERRIERE
		
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
}

function rec_mare_module(url,id,type){
//INTEGRER LA FONCTION VALIDER DANS L'APPEL AJAX.
//SI ELLE EST OK, ENVOYER LA REQUETE
		var xhr_object = null;
		var position = id;
		if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest(); // Pour que 衠marche avec Firefox
		else
		if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); //Pour que 衠marche avec Internet Explorer
		
		if(type == 'mod1smbvpc'){
			url = url + "?type="+type
				  + "&l_id="+document.getElementById('l_id').value
				  + "&lieudit="+document.getElementById('l_lieudit').value
				  + "&proprietaire="+document.getElementById('proprietaire').value
				  + "&adresse_proprietaire="+document.getElementById('adresse_proprietaire').value
				  + "&gestionnaire="+document.getElementById('gestionnaire').value
				  + "&adresse_gestionnaire="+document.getElementById('adresse_gestionnaire').value
				  + "&periode_creation="+document.getElementById('periode_creation').value
				  + "&taille_moy_long="+document.getElementById('taille_moy_long').value
				  + "&taille_moy_larg="+document.getElementById('taille_moy_larg').value
				  + "&l_hteau="+document.getElementById('l_hteau').value
				  + "&flore="+document.getElementById('flore').value
				  + "&travaux_realise="+document.getElementById('travaux_realise').value
				  + "&date_travaux_realise="+document.getElementById('date_travaux_realise').value;
		}else if(type == 'filtremare'){
			url = url + "?type="+type
				  + "&id_mare_pram="+document.getElementById('id_mare_pram').value
				  + "&commune_pram="+document.getElementById('commune_pram').value;
		}else if(type == 'mod1me'){
			url = url + "?type="+type
				  + "&l_id="+document.getElementById('l_id').value
				  + "&heure="+document.getElementById('heure').value
				  + "&sous_categories="+escape(document.getElementById('sous_categories').value)
				  + "&presence_clap="+document.getElementById('presence_clap').value
				  + "&loca_clap="+document.getElementById('loca_clap').value
				  + "&mare_assec="+document.getElementById('mare_assec').value
				  + "&endiguement="+document.getElementById('endiguement').value
				  + "&salinite="+document.getElementById('salinite').value
				  + "&temperature_eau="+document.getElementById('temperature_eau').value
				  + "&conductivite="+document.getElementById('conductivite').value
				  + "&profondeur_sonde="+document.getElementById('profondeur_sonde').value
				  + "&type_ouvrage_hydro="+document.getElementById('type_ouvrage_hydro').value
				  + "&localisation_ouvrage_hydro_xl93="+document.getElementById('localisation_ouvrage_hydro_xl93').value
				  + "&localisation_ouvrage_hydro_yl93="+document.getElementById('localisation_ouvrage_hydro_yl93').value
				  + "&pas_fauche="+document.getElementById('pas_fauche').value
				  + "&mare_sans_entretien="+document.getElementById('mare_sans_entretien').value
				  + "&mare_assec_partiel="+document.getElementById('mare_assec_partiel').value
				  + "&type_ouvrage_hydro_commentaire="+escape(document.getElementById('type_ouvrage_hydro_commentaire').value);
		}
		
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
}

////////////////////////////////ENREGISTREMENT MARE /////////////////////////////
function verifCasecoche(champ,champcheck){
	if(champcheck.checked){
		surligne(champ, false);
		return true;
	}else{
		surligne(champ, true);
		return false;
	}
}


function verifchampSelect(champ){
	if(champ.value == "0" || champ.value == "1"){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}


function verifchampStatut(champ){
	if(champ.value == "0" || champ.value == "1"){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}

function verifchampSelect2(champ){
	if(champ.value == "0"){
		surligne(champ, true);
		return false;
	}else{
		surligne(champ, false);
		return true;
	}
}


function verifLocalisationAfter(url,id,type){
		//champs pour les données obligatoire de la caractérisation
		var datecaracok = verifdate(document.getElementById('C_DATE'));
		var observcaracok = verifchampSelect2(document.getElementById('C_OBSV'));
		var typemareok = verifchampSelect(document.getElementById('C_TYPE'));
		var groupfaune1ok = verifCasecoche(document.getElementById('Label_C_FAUNE_1'),document.getElementById('C_FAUNE_1'));
		var groupfaune2ok = verifCasecoche(document.getElementById('Label_C_FAUNE_2'),document.getElementById('C_FAUNE_2'));
		var groupfaune3ok = verifCasecoche(document.getElementById('Label_C_FAUNE_3'),document.getElementById('C_FAUNE_3'));
		var groupfaune4ok = verifCasecoche(document.getElementById('Label_C_FAUNE_4'),document.getElementById('C_FAUNE_4'));
		var groupfaune5ok = verifCasecoche(document.getElementById('Label_C_FAUNE_5'),document.getElementById('C_FAUNE_5'));
		var groupfaune6ok = verifCasecoche(document.getElementById('Label_C_FAUNE_6'),document.getElementById('C_FAUNE_6'));
		var groupfaune7ok = verifCasecoche(document.getElementById('Label_C_FAUNE_7'),document.getElementById('C_FAUNE_7'));
		var groupfaune8ok = verifCasecoche(document.getElementById('Label_C_FAUNE_8'),document.getElementById('C_FAUNE_8'));
		var vegeaquaok = verifchampSelect(document.getElementById('C_VEGET'));
		var stadeevook = verifchampSelect(document.getElementById('C_EVOLUTION'));
	
		if(datecaracok && observcaracok && typemareok && vegeaquaok && stadeevook
				&& (groupfaune1ok || groupfaune2ok || groupfaune3ok || groupfaune4ok || 
					groupfaune5ok || groupfaune6ok || groupfaune7ok || groupfaune8ok))
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			AjaxMare('mare/enregmare.php', '', 'Ajout_Caracterisation')
			// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
		else{
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

function verifLocalisationTemporaireLocalisation(url,id,type){
		//Champ pour localisation
		var dateobsok = verifdate(document.getElementById('L_DATE'));
		var observateurok = verifchampSelect2(document.getElementById('L_OBSV'));
		// var lienok = verifchampSelect(document.getElementById('L_LIEN'));
		// if(document.getElementById('L_LIEN').value == 5){
			// var lienautreok = verifchampVide(document.getElementById('C_LIEN_AUTRE'));
		// }else{
			// var lienautreok = true;
		// }	
		// var nommareok = verifchampVide(document.getElementById('L_NOM'));
		var communeok = verifchampSelect(document.getElementById('L_ADMIN'));
		var statutok = verifchampStatut(document.getElementById('L_STATUT'));
		var proprieteok = verifchampSelect(document.getElementById('L_PROPR'));
		var coox93ok = verifchampVide(document.getElementById('L_COOX93'));
		var cooy93ok = verifchampVide(document.getElementById('L_COOY93'));
		var localisationok = verifchampSelect(document.getElementById('L_PREC'));
		
		if(dateobsok && observateurok && communeok && statutok && proprieteok && coox93ok && cooy93ok && localisationok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			AjaxMare('mare/enregmare.php', '', 'RecMareLocCaracterisationTemporaireLocalisation')
			// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
		else{
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

function verifLocalisation(url,id,type){
	//Champ pour localisation
	var dateobsok = verifdate(document.getElementById('L_DATE'));
	var observateurok = verifchampSelect2(document.getElementById('L_OBSV'));
	var communeok = verifchampSelect(document.getElementById('L_ADMIN'));
	var statutok = verifchampStatut(document.getElementById('L_STATUT'));
	var proprieteok = verifchampSelect(document.getElementById('L_PROPR'));
	var coox93ok = verifchampVide(document.getElementById('L_COOX93'));
	var cooy93ok = verifchampVide(document.getElementById('L_COOY93'));
	var localisationok = verifchampSelect(document.getElementById('L_PREC'));
	
	if(dateobsok && observateurok && communeok && statutok && proprieteok && coox93ok && cooy93ok && localisationok)
		//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
		AjaxMare('mare/enregmare.php', '', 'RecMareLoc')
		// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
	else{
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



function verifCaracterisation(url,id,type){	
	//champs pour les données obligatoire de la caractérisation
	var datecaracok = verifdate(document.getElementById('C_DATE'));
	var observcaracok = verifchampSelect2(document.getElementById('C_OBSV'));
	var typemareok = verifchampSelect(document.getElementById('C_TYPE'));
	var groupfaune1ok = verifCasecoche(document.getElementById('Label_C_FAUNE_1'),document.getElementById('C_FAUNE_1'));
	var groupfaune2ok = verifCasecoche(document.getElementById('Label_C_FAUNE_2'),document.getElementById('C_FAUNE_2'));
	var groupfaune3ok = verifCasecoche(document.getElementById('Label_C_FAUNE_3'),document.getElementById('C_FAUNE_3'));
	var groupfaune4ok = verifCasecoche(document.getElementById('Label_C_FAUNE_4'),document.getElementById('C_FAUNE_4'));
	var groupfaune5ok = verifCasecoche(document.getElementById('Label_C_FAUNE_5'),document.getElementById('C_FAUNE_5'));
	var groupfaune6ok = verifCasecoche(document.getElementById('Label_C_FAUNE_6'),document.getElementById('C_FAUNE_6'));
	var groupfaune7ok = verifCasecoche(document.getElementById('Label_C_FAUNE_7'),document.getElementById('C_FAUNE_7'));
	var groupfaune8ok = verifCasecoche(document.getElementById('Label_C_FAUNE_8'),document.getElementById('C_FAUNE_8'));
	var vegeaquaok = verifchampSelect(document.getElementById('C_VEGET'));
	var stadeevook = verifchampSelect(document.getElementById('C_EVOLUTION'));

	if(datecaracok && observcaracok && typemareok && vegeaquaok && stadeevook
			&& (groupfaune1ok || groupfaune2ok || groupfaune3ok || groupfaune4ok || 
				groupfaune5ok || groupfaune6ok || groupfaune7ok || groupfaune8ok))
		//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
		AjaxMare('mare/enregmare.php', '', 'RecMareCaracterisation')
		// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
	else{
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

function verifCaracterisationsimplifiee(url,id,type){	
	//champs pour les données obligatoire de la caractérisation
	var datecaracok = verifdate(document.getElementById('C_DATE'));
	var observcaracok = verifchampSelect2(document.getElementById('C_OBSV'));
	var typemareok = verifchampSelect(document.getElementById('C_TYPE'));
	var groupfaune1ok = verifCasecoche(document.getElementById('Label_C_FAUNE_1'),document.getElementById('C_FAUNE_1'));
	var groupfaune2ok = verifCasecoche(document.getElementById('Label_C_FAUNE_2'),document.getElementById('C_FAUNE_2'));
	var groupfaune3ok = verifCasecoche(document.getElementById('Label_C_FAUNE_3'),document.getElementById('C_FAUNE_3'));
	var groupfaune4ok = verifCasecoche(document.getElementById('Label_C_FAUNE_4'),document.getElementById('C_FAUNE_4'));
	var groupfaune5ok = verifCasecoche(document.getElementById('Label_C_FAUNE_5'),document.getElementById('C_FAUNE_5'));
	var groupfaune6ok = verifCasecoche(document.getElementById('Label_C_FAUNE_6'),document.getElementById('C_FAUNE_6'));
	var groupfaune7ok = verifCasecoche(document.getElementById('Label_C_FAUNE_7'),document.getElementById('C_FAUNE_7'));
	var groupfaune8ok = verifCasecoche(document.getElementById('Label_C_FAUNE_8'),document.getElementById('C_FAUNE_8'));
	var vegeaquaok = verifchampSelect(document.getElementById('C_VEGET'));
	var stadeevook = verifchampSelect(document.getElementById('C_EVOLUTION'));

	if(datecaracok && observcaracok && typemareok && stadeevook && vegeaquaok
			&& (groupfaune1ok || groupfaune2ok || groupfaune3ok || groupfaune4ok || 
				groupfaune5ok || groupfaune6ok || groupfaune7ok || groupfaune8ok))
		//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
		AjaxMare('mare/enregmare.php', '', 'RecMareCaracterisationSimplifiee')
		// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
	else{
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

function verifLocalisationMod(url,id,type){
		//Champ pour localisation
		var proprieteok = verifchampSelect(document.getElementById('L_PROPR'));
		
		if(proprieteok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			AjaxMare('mare/enregmare.php', '', 'RecMareLocMod');
			// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
		else{
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

function verifformdemandeaccess(url,id,type){
		
		//Champ pour localisation
		var strucutureok = verifchampVide(document.getElementById('STRUCTURE'));
		var personneok = verifchampVide(document.getElementById('PERSONNE'));
		var emailok = verifchampVide(document.getElementById('EMAIL'));
		var objectifok = verifchampVide(document.getElementById('OBJECTIF'));
		var geojesonok = verifchampVide(document.getElementById('geojson'));
		
		if(strucutureok && personneok && emailok && objectifok && geojesonok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			AjaxMare('mare/enregmare.php', 'affichage', 'FormulaireDemandeAcces')
			// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
		else{
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

///////////////////////POUR FAUNE FLOR/////////////////////

function verifFauneFlore(url,id,type){

	if(type == 'faune_flore'){
		var observateurok = verifchampSelect2(document.getElementById('O_OBSV'));
		var dateok = verifdate(document.getElementById('O_DATE'));
		var taxonok = verifchampVide(document.getElementById('O_NLAT'));
		var nombreok = verifchampVide(document.getElementById('O_NBRE'));
		var denombrementok = verifchampSelect(document.getElementById('O_NBRT'));
		var techacquisitionok = verifchampSelect2(document.getElementById('O_SACQ'));
		var collectok = verifchampSelect2(document.getElementById('O_STYP'));
	
		if(observateurok && dateok && taxonok && nombreok && denombrementok && techacquisitionok && collectok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			RecAttribut('mare/enregmare.php', 'resultat_petit', 'faune_flore');
			// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
		else{
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
	}else if(type == 'faune_flore_dupliquer'){
		var observateurok = verifchampSelect2(document.getElementById('O_OBSV'));
		var dateok = verifdate(document.getElementById('O_DATE'));
		var taxonok = verifchampVide(document.getElementById('O_NLAT'));
		var nombreok = verifchampVide(document.getElementById('O_NBRE'));
		var denombrementok = verifchampSelect(document.getElementById('O_NBRT'));
		var techacquisitionok = verifchampSelect2(document.getElementById('O_SACQ'));
		var collectok = verifchampSelect2(document.getElementById('O_STYP'));
	
		if(observateurok && dateok && taxonok && nombreok && denombrementok && techacquisitionok && collectok)
			//SI TOUT EST OK ON EXECUTE LE SCRIPT PHP
			RecAttribut('mare/enregmare.php', 'resultat_petit', 'faune_flore_dupliquer');
			// load_page('identifiant/traitement_form.php','divFormInscription','identifiant');
		else{
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
}