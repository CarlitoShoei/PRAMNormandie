	function calendar(element){
		if(!element.calendarActive){
		//Propriété de la date ( année , mois etc ... )
		this.monthCurrent = null;
		this.yearCurrent = null;
		this.dayCurrent = null;
		this.dateCurrent = null;
		//Le timer pour les effet ( fade in ^^ )
		this.timer = null;
		/*###### Objet composant le calendrier ######*/
		// la div principale
		this.calendar = null;
		
		this.bugFrame = null;
		//div contenant les mois ainsi que les deux boutons suivant et précédent
		this.contentMonth = null;
		this.pMonth = null;
		this.MonthLeft = null;
		this.MonthRight = null;
		
		//Div contenant l'année ainsi que les deux boutons
		this.contentYear = null;
		this.pYear = null;
		this.YearTop = null;
		this.YearBottom = null;
		
		//Div contenant le nom des jours
		this.contentNameDay = null;
		
		//Div contenant la liste des jours
		this.contentListDay = null;
		
		/*###### FIN des Objet du calendrier ######*/
		
		//Liste des dates courantes
		this.from = null;
		//Liste des dates suivantes
		this.to = null;
		
		this.opacite = 0 ;
		this.direction = null;
		//Variable permettant de mettre a  jour le header + slide
		this.inMove = false;
		//Tableau d'élément a déplacé
		this.elementToSlide = new Array();
		//Index de l'élément en cours
		this.currentIndex = 0;
		//Paramètre pour lancement automatique
		this.timePause = 0 ; //permet de définir le temps de pause entre deux slide
		this.auto = false ; //Permet d'activer ou non le slide automatique
	
		//Input sur lequel on a cliqué
		this.element = (element) ? element: null;
		this.element.calendarActive = true ;
		//Tableaux contenant le nom des mois et jours
		this.monthListName = new Array('Janvier', 'FÃ©vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'AoÃ»t', 'Septembre', 'Octobre', 'Novembre', 'DÃ©cembre');
		this.dayListName = new Array('Lu','Ma','Me','Je','Ve','Sa','Di');
		this.dayFullName = new Array('Lun','Mar','Mer','Jeu','Ven','Sam','Dim');
			
		this.IsIE=!!document.all;
		
		this.init();
		}
	}
	
	calendar.prototype.init = function (){
		var me = this;
		//On créer une div principale
		this.calendar = this.newElement({"typeElement":"div","classeCss":"calendar","parent":null});
		//Pour combler un bug ie , on doit ajouter les filtres d'opacité
		//Ajout du filtre
	      if(this.IsIE)
	      {
	        this.calendar.style.filter='alpha(opacity=0)';
	        this.calendar.filters[0].opacity=0;
	      }
	      else
	      {
	        this.calendar.style.opacity='0';
	      }
		//Création d'une frame pour combler un bug lié aux liste sous ie
		this.bugFrame = this.newElement({"typeElement":"iframe","classeCss":"bugFrame","parent":this.calendar});
		//Création d'une divContenant le fond  pour combler un bug sous ie
		var temp = this.newElement({"typeElement":"div","classeCss":"bugFrame","parent":this.calendar});
		//Création des contenants ( mois , année , jours , listes jours etc ... )

		this.contentDay = this.newElement({"typeElement":"div","classeCss":"contentDay","parent":this.calendar});
		this.contentMonth = this.newElement({"typeElement":"div","classeCss":"contentMonth","parent":this.calendar});
		this.pMonth = this.newElement({"typeElement":"span","classeCss":"pMonth","parent":this.contentMonth});
		this.contentYear = this.newElement({"typeElement":"div","classeCss":"contentYear","parent":this.calendar});
		this.pYear = this.newElement({"typeElement":"span","classeCss":"pYear","parent":this.contentYear});
		this.contentNameDay = this.newElement({"typeElement":"ul","classeCss":"contentNameDay","parent":this.calendar});
		this.contentListDay = this.newElement({"typeElement":"div","classeCss":"contentListDay","parent":this.calendar});
		
		//Ajout des éléments dans les conteneurs ( bouton + initialisation des dates )
		this.MonthLeft = this.newElement({"typeElement":"div","classeCss":"MonthLeft","parent":this.contentMonth});
		this.MonthRight = this.newElement({"typeElement":"div","classeCss":"MonthRight","parent":this.contentMonth});
		//Ajout des évènements sur les div
		this.MonthLeft.onclick = function(){me.updateMonthBefNexCur("before");me.SlideToRight()};
		this.MonthRight.onclick = function(){me.updateMonthBefNexCur("next");me.SlideToLeft()};
		
		this.YearTop = this.newElement({"typeElement":"div","classeCss":"YearTop","parent":this.contentYear});
		this.YearBottom = this.newElement({"typeElement":"div","classeCss":"YearBottom","parent":this.contentYear});
		
		this.YearTop.onclick = function(){me.updateYearBefNexCur("next");me.SlideToTop()};
		this.YearBottom.onclick = function(){me.updateYearBefNexCur("before");me.SlideToBottom()};
		
		
		//Ajout des évènements liés au survol et appuis de la souris sur les éléments;
		this.MonthLeft.onmouseover = function(){this.className = "MonthLeftOver"};
		this.MonthLeft.onmouseout = function(){this.className = "MonthLeft"};
		this.MonthLeft.onmousedown = function(){this.className = "MonthLeftClick"};
		this.MonthLeft.onmouseup = function(){this.className = "MonthLeftOver"};
		
		this.MonthRight.onmouseover = function(){this.className = "MonthRightOver"};
		this.MonthRight.onmouseout = function(){this.className = "MonthRight"};
		this.MonthRight.onmousedown = function(){this.className = "MonthRightClick"};
		this.MonthRight.onmouseup = function(){this.className = "MonthRightOver"};
		
		this.YearTop.onmouseover = function(){this.className = "YearTopOver"};
		this.YearTop.onmouseout = function(){this.className = "YearTop"};
		this.YearTop.onmousedown = function(){this.className = "YearTopClick"};
		this.YearTop.onmouseup = function(){this.className = "YearTopOver"};
		
		this.YearBottom.onmouseover = function(){this.className = "YearBottomOver"};
		this.YearBottom.onmouseout = function(){this.className = "YearBottom"};
		this.YearBottom.onmousedown = function(){this.className = "YearBottomClick"};
		this.YearBottom.onmouseup = function(){this.className = "YearBottomOver"};
		
		//Récupération de la date du champs sinon date par défaut
		
		//Si l'élément sur lequel on a cliquez n'est pas vide on extrait la date
		if(this.element != null && this.element.value != ""){
			var reg=new RegExp("/", "g");
			var dateOfField = this.element.value;
			var dateExplode = dateOfField.split(reg);
			this.dateCurrent = this.getDateCurrent(dateExplode[0], dateExplode[1] - 1,dateExplode[2]);
		}
		else{
			this.dateCurrent = this.getDateCurrent();
		}
		
		//Récupération de la date du champs , sinon création d'une nouvelle;
		this.monthCurrent = this.dateCurrent.getMonth();
		this.yearCurrent = this.dateCurrent.getFullYear();
		this.dayCurrent = this.dateCurrent.getDate();
		
		//Création du mois courant
		this.from = this.createContentDay(0,"left");
		this.createMonth({"CurrentDay":this.dayCurrent,"CurrentMonth":this.monthCurrent,"CurrentYear":this.yearCurrent,"conteneur":this.from});
		//Création de la div qui défilera  On le remplira au moment ou on en aura besoins
		this.to = this.createContentDay(parseInt(this.calendar.offsetWidth),"left");
		this.createMonth({"CurrentDay":this.dayCurrent,"CurrentMonth":this.monthCurrent,"CurrentYear":this.yearCurrent,"conteneur":this.to});
		
		//On ajoute les éléments souhaités ( ici un tableau )  on peut utiliser la méthode AddElement pour ajouter un seul élément. on peut ajouter un id ou directement l'élément ;-)
		this.AddElements(Array(this.from,this.to));
		
		//Création de l'entete
		this.createHeader();
		this.updateDateHeader();
		
		//Positionnement du calendrier
		this.getPosition();
		
		//Apparition
		this.fadePic(0,true);
	}
	
	calendar.prototype.getDateCurrent = function (day,month,year){
			
			//Aujourd'hui si month et year ne sont pas renseignés
			if(year == null || month == null){
				return (new Date());
			}
			
			else{
				//Création d'une date en fonction de celle passée en paramètre
				return (new Date(year, month , day));
			}
	}
	
	calendar.prototype.newElement = function (parameter){
		var typeElement = parameter['typeElement'];
		var classToAffect = parameter['classeCss'];
		var parent = parameter['parent'];
		
		var newElement = document.createElement(typeElement);
		newElement.className = classToAffect;
		if(parent == null){
			document.body.appendChild(newElement);
		}
		else{
			parent.appendChild(newElement);
		}
		return newElement;
	}

	calendar.prototype.createMonth = function(parameter){
		//Récupération des paramètres
		var CurrentDay = parameter["CurrentDay"];
		var CurrentMonth = parameter["CurrentMonth"];
		var CurrentYear = parameter["CurrentYear"];
		var conteneur = parameter["conteneur"];
		
		//On commence par détruire toute les date du conteneur :)
		/*for(var i = 0 , l = conteneur.childNodes.length; i < l;i++ ){
			conteneur.removeChild(conteneur.childNodes[i]);
		}*/
		while (conteneur.childNodes.length>0) {
			conteneur.removeChild(conteneur.firstChild);
		}
		//conteneur.innerHTML = '';
		
		//Appel de la méthode getDateCurrent retournant la date courante ou la date passé en paramètre
		var dateCurrent = this.getDateCurrent(CurrentDay,CurrentMonth,CurrentYear);
		
		//Mois actuel
		var monthCurrent = dateCurrent.getMonth()
		
		//Année actuelle
		var yearCurrent = dateCurrent.getFullYear();
		
		//Jours actuel
		var dayCurrent = dateCurrent.getDate();
		
		// On récupère le premier jour de la semaine du mois
		var dateTemp = new Date(yearCurrent, monthCurrent,1);
		
		//test pour vérifier quel jour était le premier du mois par rapport a la semaine
		this.current_day_since_start_week = (( dateTemp.getDay()== 0 ) ? 6 : dateTemp.getDay() - 1);
		
		//On initialise le nombre de jour par mois et on vérifis si l'on est au mois de février
		var nbJoursfevrier = (yearCurrent % 4) == 0 ? 29 : 28;
		//Initialisation du tableau indiquant le nombre de jours par mois
		var day_number = new Array(31,nbJoursfevrier,31,30,31,30,31,31,30,31,30,31);
		
		//On commence par ajouter les nombre de jours du mois précédent
		
		//Calcul des date en fonction du moi précédent
		
		var dayBeforeMonth = ((day_number[((monthCurrent == 0) ? 11:monthCurrent-1)]) - this.current_day_since_start_week)+1;
	
		for(i  = dayBeforeMonth ; i <= (day_number[((monthCurrent == 0) ? 11:monthCurrent-1)]) ; i ++){
			
			this.createDayInContent(i,false,false,conteneur);
		}
		
		//On remplit le calendrier avec le nombre de jour, en remplissant les premiers jours par des champs vides
		for(var nbjours = 0 ; nbjours < (day_number[monthCurrent] + this.current_day_since_start_week) ; nbjours++){
		//et enfin on ajoute les dates au calendrier
		//Pour gèrer les jours "vide" et éviter de faire une boucle on vérifit que le nombre de jours corespond bien au
		//nombre de jour du mois
			if(nbjours < day_number[monthCurrent]){
				if(dayCurrent == (nbjours+1)){
					this.createDayInContent(nbjours+1,true,true,conteneur);
				}
				else{
					this.createDayInContent(nbjours+1,false,true,conteneur);
				}
			}
		}
		
		//Calcul des date en fonction du moi suivant
		var nbCelRest = 42 - (day_number[monthCurrent]+this.current_day_since_start_week);
		
		for(i  = 0 ; i <  nbCelRest ; i ++){
			
			this.createDayInContent(i+1,false,false,conteneur);
		}

	}
	
	calendar.prototype.createDayInContent = function (dateDay,CurrentDay,active,conteneur){
		var me = this;
		//Création d'un li comprenant un noeud texte avec la date du jour
		var liDay = document.createElement("li");
		var TextContent = document.createTextNode(dateDay);
		//Pour éviter les if else ....
		liDay.className = (CurrentDay) ? "dayCurrent":"liOut";
		liDay.className = (!active) ? "liInactive":liDay.className;
		liDay.appendChild(TextContent);
		//Ajout du survol :)
		if(active){
			liDay.onmouseover = function(){this.className = (this.className == "dayCurrent") ? this.className : "liHover";};
			liDay.onmouseout = function(){this.className = (this.className == "dayCurrent") ? this.className : "liOut";};
			liDay.onclick = function(){me.dayCurrent = this.innerHTML ; me.fillField()};
		}
		//Ajout de l'élément dans la liste
		conteneur.appendChild(liDay);
	}
	
	calendar.prototype.createContentDay = function (positionTo,position){
		//Création d'un li comprenant un noeud texte avec la date du jour
		var ulDays = document.createElement("ul");
		ulDays.className = "dayCal";
		
		if(position != "top"){
			if(positionTo != null){ulDays.style.left = positionTo + "px";}
			ulDays.style.top = 0 + "px";
		}
		else{
			if(positionTo != null){ulDays.style.top = positionTo + "px";}
			ulDays.style.left = 0 + "px";
		}
		this.contentListDay.appendChild(ulDays);
		return ulDays;
	}
	
	calendar.prototype.createCalendar = function (){
		//Création d'un li comprenant un noeud texte avec la date du jour
		var divContent = document.createElement("div");
		divContent.className = "calendrier";
		document.body.appendChild(divContent);
		return divContent;
	}
	
	calendar.prototype.createHeader = function(){

		//Ajout des jours
		for(var i = 0 , l = this.dayListName.length ; i < l ; i++){
			var liDayTemp = document.createElement("li");
			TextContent = document.createTextNode(this.dayListName[i]);
			liDayTemp.appendChild(TextContent);
			//Ajout du jour dans la liste
			this.contentNameDay.appendChild(liDayTemp);
		}
	}
	
	calendar.prototype.updateDateHeader = function(){
		var me = this ;
		//On commence par détruire tous les enfants des mois et années
		while (this.pMonth.childNodes.length>0) {
			this.pMonth.removeChild(this.pMonth.firstChild);
		}
		
		while (this.pYear.childNodes.length>0) {
			this.pYear.removeChild(this.pYear.firstChild);
		}
		
		while (this.contentDay.childNodes.length>0) {
			this.contentDay.removeChild(this.contentDay.firstChild);
		}
		
		//Ajout de la date du jour
		var nomDuJour =  this.dayFullName[((this.dateCurrent.getDay()-1) == -1) ? 6 :(this.dateCurrent.getDay()-1)];
		var TextContent = document.createTextNode(nomDuJour);
		this.contentDay.appendChild(TextContent);
		var retourLigne = document.createElement("br");
		this.contentDay.appendChild(retourLigne);
		TextContent = document.createTextNode(this.dayCurrent);
		this.contentDay.appendChild(TextContent);
		
		
		//Ajout du mois 
		TextContent = document.createTextNode(this.monthListName[(this.monthCurrent == 12) ? 0:this.monthCurrent]);
		this.pMonth.appendChild(TextContent);
		
		//Ajout de l'année 
		TextContent = document.createTextNode(this.yearCurrent);
		this.pYear.appendChild(TextContent);
	}
	
	calendar.prototype.updateMonthBefNexCur = function(direction){
			
			if(!this.inMove){
				if(this.timer == null){
					if(direction == "next"){
						this.updateDate("next");
						this.direction = "left";
						//on le remplit
						this.createMonth({"CurrentDay":this.dayCurrent,"CurrentMonth":this.monthCurrent,"CurrentYear":this.yearCurrent,"conteneur":this.to});
					}
					else if(direction == "before"){
						this.updateDate("before");
						this.direction = "right";
						this.createMonth({"CurrentDay":this.dayCurrent,"CurrentMonth":this.monthCurrent,"CurrentYear":this.yearCurrent,"conteneur":this.to});
						
					}
				}
				//On positionne la div
				this.Positionne();
			}
	}
	
	calendar.prototype.updateYearBefNexCur = function(direction){
			if(!this.inMove){
				if(this.timer == null){
					if(direction == "next"){
						this.yearCurrent++;
						this.direction = "top";
						//on le remplit
						this.createMonth({"CurrentDay":this.dayCurrent,"CurrentMonth":this.monthCurrent,"CurrentYear":this.yearCurrent,"conteneur":this.to});
					}
					else if(direction == "before"){
						this.yearCurrent--;
						this.direction = "bottom";
						this.createMonth({"CurrentDay":this.dayCurrent,"CurrentMonth":this.monthCurrent,"CurrentYear":this.yearCurrent,"conteneur":this.to});
						
					}
				}
				//Mise a jour de la date courante : 
				this.dateCurrent = new Date(this.yearCurrent, this.monthCurrent,this.dayCurrent);
				this.dateCurrent.setDate(this.dayCurrent);
				this.updateDateHeader();
				this.Positionne();
			}
	}
	
	calendar.prototype.updateDate = function(direction){
		if(this.timer == null){
			if(direction == "before"){
			//on calcul les dates suivante et précédente
				if(this.monthCurrent == 0){
					this.monthCurrent = 11;
				}
				else{
					this.monthCurrent = this.monthCurrent - 1 ;
				}
				this.yearCurrent = (this.monthCurrent == 11 ) ? this.yearCurrent - 1:this.yearCurrent;
			}
			else{
			//On récupère le mois actuel puis on vérifit que l'on est pas en janvier sinon on ajoute une année
				if(this.monthCurrent == 11){
					this.monthCurrent = 0;
			
				}
				else{
					this.monthCurrent =this.monthCurrent + 1;
				}
				this.yearCurrent = (this.monthCurrent == 0) ?  this.yearCurrent+1:this.yearCurrent;
			}
			
			//Mise a jour de la date courante : 
			this.dateCurrent = new Date(this.yearCurrent, this.monthCurrent,this.dayCurrent);
			this.dateCurrent.setDate(this.dayCurrent);
			this.updateDateHeader();
		}
	}
	
	//Fonction permettant de trouver la position de l'élément ( input ) pour pouvoir positioner le calendrier
	calendar.prototype.getPosition = function() {
	var tmpLeft = this.element.offsetLeft;
	var tmpTop = this.element.offsetTop;
	var MyParent = this.element.offsetParent;
	while(MyParent) {
		tmpLeft += MyParent.offsetLeft;
		tmpTop += MyParent.offsetTop;
		MyParent = MyParent.offsetParent;
	}
		this.calendar.style.left = tmpLeft;
		this.calendar.style.top = tmpTop +  this.element.offsetHeight + 2 +"px";
	}
	
	calendar.prototype.fillField = function(){
		if(this.dayCurrent<10){
			this.dayCurrent = "0"+this.dayCurrent;
		}

		
		this.element.value = this.dayCurrent+"/"+ ((this.monthCurrent+1 == 13) ? 1:this.monthCurrent+1)+"/"+this.yearCurrent;
		//On détruit le calendrier;
		this.purge(this.calendar);
		document.body.removeChild(this.calendar);
		this.element.calendarActive = false;
	}
	
	calendar.prototype.purge = function (CurrentNode){
		
		//Récupération de tous les noeuds enfants 
		while (CurrentNode.childNodes.length>0) {
			//Si le premier enfant a des enfants appel récursif de la méthode
			if(CurrentNode.firstChild.childNodes.length>0){
				this.purge(CurrentNode.firstChild);
			}
			//Sinon on parcours ses propriétés pour supprimer les évènements lié aux objet, puis destruction de l'objet
			else{
				
				var tempo = CurrentNode.firstChild ;
				var a = tempo.attributes, i, l, n;
			    if (a) {
			        l = a.length;
			        for (i = 0; i < l; i += 1) {
			            n = a[i].name;
			            if (typeof tempo[n] === 'function') {
			                tempo[n] = null;
			            }
			        }
			    }
				tempo = null;
				CurrentNode.removeChild(CurrentNode.firstChild);
				
			}
		}
	}
		

	/*##########################################################
	############  METHODES PERMETTANT DE SCROLLER LES DATES  ##############
	##########################################################*/
	//Permet de récupérer un élément par id
	calendar.prototype.$ = function(element){
		return document.getElementById(element);
	};
	
	//Méthode permettant de lancer les animations si en auto :)
	calendar.prototype.go = function(){
		if(this.auto){
			switch (this.direction ){
				case 'left':
					this.SlideToLeft();
				break;
				case 'right':
					this.SlideToRight();
				break;
				case 'top':
					this.SlideToTop();
				break;
				case 'bottom':
					this.SlideToBottom();
				break;
			}
		}
	}
	
	//Méthode permettant d'ajouter un élément
	calendar.prototype.AddElement = function(element){
		if(typeof(element) == "string"){
			this.elementToSlide.push(this.$(element));
		}
		else if(typeof(element) == "object"){
			this.elementToSlide.push(element);
		}
	}
	
	//Méthode permettant d'ajouter plusieurs élément d'un coup
	calendar.prototype.AddElements = function (elements){
		for(var i = 0 , l = elements.length; i < l ;i++){
			this.AddElement(elements[i]);
		}
	}
	
	//Méthode permettant de déplacer les éléments vers la gauche
	calendar.prototype.SlideToLeft = function(){
		if(this.direction == null || this.direction == 'left'){
			var me = this ;
			//On vérifit la direction pour initialiser le positionnement
			if(this.direction != 'left'){
					this.direction = 'left';
					if(this.timer == null){
						this.Positionne();
					}
			}
			else if(this.direction == 'left' && this.auto && this.timer == null){
				this.Positionne();
			}
			
			if(this.timer != null){
				clearTimeout(this.timer);
				this.timer = null;
			}
			//Si le timer n'est pas finit on détruit l'ancienne div
			if(parseInt(this.from.style.left) == Number.NaN || (parseInt(this.from.parentNode.offsetWidth) + parseInt(this.from.style.left))> 0){
				this.from.style.left = parseInt(this.from.style.left) - 15 + "px";
				this.to.style.left  =parseInt(this.to.style.left) - 15 + "px";
				this.inMove = true;
				this.timer = setTimeout(function(){me.SlideToLeft()},25);
				
			}
			else{
				clearTimeout(this.timer);
				this.timer = null;
				this.currentIndex = (this.currentIndex == (this.elementToSlide.length-1)) ? 0:this.currentIndex + 1;
				this.Positionne();
				this.direction = null;
				this.inMove = false;
			}
		}
	};
	
	//Méthode permettant de déplacer les éléments vers la droite
	calendar.prototype.SlideToRight = function(){
		var me = this ;
		if(this.direction == null || this.direction == 'right'){
				if(this.direction != 'right'){
					this.direction = 'right';
					if(this.timer == null){
						this.Positionne();
					}
				}
				else if(this.direction == 'right' && this.auto && this.timer == null){
					this.Positionne();
				}
				
				if(this.timer != null){
					clearTimeout(this.timer);
					this.timer = null;
				}
				//Si le timer n'est pas finit on détruit l'ancienne div
				if(parseInt(this.from.style.left) == Number.NaN ||  parseInt(this.from.style.left) < parseInt(this.from.parentNode.offsetWidth)){
					this.from.style.left = parseInt(this.from.style.left) + 15 + "px";
					this.to.style.left  =parseInt(this.to.style.left) + 15 + "px";
					this.inMove = true;
					this.timer = setTimeout(function(){me.SlideToRight()},25);
				}
				else{
					clearTimeout(this.timer);
					this.timer = null;
					this.currentIndex = (this.currentIndex == 0) ? this.elementToSlide.length-1:this.currentIndex - 1;
					this.Positionne();
					this.direction = null;
					this.inMove = false;
				}
		}
		

	};
	
	//Méthode permettant de déplacer les éléments vers la gauche
	calendar.prototype.SlideToTop = function(){
		var me = this ;
		if(this.direction == null || this.direction == 'top'){
			//On vérifit la direction pour initialiser le positionnement
			if(this.direction != 'top'){
					this.direction = 'top';
					if(this.timer == null){
						this.Positionne();
					}
			}
			if(this.timer != null){
				clearTimeout(this.timer);
				this.timer = null;
			}
			//Si le timer n'est pas finit on détruit l'ancienne div
			if(parseInt(this.from.style.top) == Number.NaN || (parseInt(this.from.style.top) > - parseInt(this.from.parentNode.offsetHeight))){
				this.from.style.top = parseInt(this.from.style.top) - 15 + "px";
				this.to.style.top  =parseInt(this.to.style.top) - 15 + "px";
				this.inMove = true;
				this.timer = setTimeout(function(){me.SlideToTop()},25);
			}
			else{
				clearTimeout(this.timer);
				this.timer = null;
				this.currentIndex = (this.currentIndex == 0) ? this.elementToSlide.length-1:this.currentIndex - 1;
				this.Positionne();					
				this.direction = null;
				this.inMove = false;
			}
		}
	};
	
	//Méthode permettant de déplacer les éléments vers le bas
	calendar.prototype.SlideToBottom = function(){
		var me = this 
		if(this.direction == null || this.direction == 'bottom'){
			//On vérifit la direction pour initialiser le positionnement
			if(this.direction != 'bottom'){
					this.direction = 'bottom';
					if(this.timer == null){
						this.Positionne();
					}
			}
			if(this.timer != null){
				clearTimeout(this.timer);
				this.timer = null;
			}
			//Si le timer n'est pas finit on détruit l'ancienne div
			if(parseInt(this.from.style.top) == Number.NaN || parseInt(this.from.style.top) < parseInt(this.from.parentNode.offsetHeight)){
				this.from.style.top = parseInt(this.from.style.top) + 15 + "px";
				this.to.style.top  =parseInt(this.to.style.top) + 15 + "px";
				this.inMove = true;
				this.timer = setTimeout(function(){me.SlideToBottom()},25);
			}
			else{
				clearTimeout(this.timer);
				this.timer = null;
				this.currentIndex = (this.currentIndex == this.elementToSlide.length-1) ? 0:this.currentIndex + 1;
				this.Positionne();
				this.direction = null;
				this.inMove = false;
			}
		}
	};
	
	//Fonction initialisant le tableau en positionnant tous les éléments :)
	calendar.prototype.Positionne = function(){
		if(this.direction == 'left'){
			//On vérifit que l'on est pas a la fin sinon le premier devient le dernier
			if(this.currentIndex == this.elementToSlide.length-1){
				//récupération des éléments : 
				this.from = this.elementToSlide[this.currentIndex];
				this.to = this.elementToSlide[0]; //Premier élément
			}
			else{
				this.from = this.elementToSlide[this.currentIndex];
				this.to = this.elementToSlide[this.currentIndex + 1];
			}
				this.from.style.display = "block" ;
				this.from.style.left = 0 + "px";
				this.to.style.left = this.from.parentNode.offsetWidth + "px";
				this.to.style.display = "block";
				//Posionement vertical
				this.to.style.top = 0 + "px";
				this.from.style.top = 0 + "px" ;
		}
		else if(this.direction == 'right'){
			if(this.currentIndex == 0){
				this.from = this.elementToSlide[this.currentIndex];
				this.to = this.elementToSlide[this.elementToSlide.length-1]; // dernier élément
			}
			else{
				this.from = this.elementToSlide[this.currentIndex];
				this.to = this.elementToSlide[this.currentIndex-1];
			}
			this.from.style.display = "block" ;
			this.from.style.left = 0 + "px";
			this.to.style.left = - (this.from.parentNode.offsetWidth )+ "px";
			this.to.style.display = "block";
			//Posionement vertical
			this.to.style.top = 0 + "px";
			this.from.style.top = 0 + "px" ;
		}
		else if(this.direction == 'bottom'){
			if(this.currentIndex == this.elementToSlide.length-1){
				this.from = this.elementToSlide[this.currentIndex];
				this.to = this.elementToSlide[0]; // dernier élément
			}
			else{
				this.from = this.elementToSlide[this.currentIndex];
				this.to = this.elementToSlide[this.currentIndex+1];
			}
			this.from.style.display = "block" ;
			this.from.style.top = 0 + "px";
			this.to.style.top = - (this.from.parentNode.offsetHeight )+ "px";
			this.to.style.display = "block";
			//Posionement horizontal
			this.to.style.left = 0 + "px";
			this.from.style.left = 0 + "px" ;
		}
		else if(this.direction == 'top'){
			if(this.currentIndex == 0){
				this.from = this.elementToSlide[this.currentIndex];
				this.to = this.elementToSlide[this.elementToSlide.length-1]; // dernier élément
			}
			else{
				this.from = this.elementToSlide[this.currentIndex];
				this.to = this.elementToSlide[this.currentIndex-1];
			}
			this.from.style.display = "block" ;
			this.from.style.top = 0 + "px";
			this.to.style.top = (this.from.parentNode.offsetHeight )+ "px";
			this.to.style.display = "block";
			//Posionement horizontal
			this.to.style.left = 0 + "px";
			this.from.style.left = 0 + "px" ;
		}
	};

	calendar.prototype.fadePic = function (current,up){
		this.calendar.style.display = "block";
		this.opacite = current ;
		this.up = up ;
		
		if (this.opacite< 100 && this.up){
			this.opacite+=3;
			this.IsIE?this.calendar.filters[0].opacity=this.opacite:this.calendar.style.opacity=this.opacite/100;
			var me = this;
			this.timer = setTimeout(function(){me.fadePic(me.opacite,true)},25);
		}
		else{
			clearTimeout(this.timer);
			this.timer = null;
			this.up = false;
		}
	}
	