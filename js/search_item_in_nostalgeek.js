window.onload = function() {
	var searchItemElement = document.getElementById('searchItem'),
		timeout = null;

	// S'il n'y a pas de barre de recherche, retour
	if(searchItemElement == null) {
		return;
	}

	// Lorsque l'entrée clavier est terminée
	searchItemElement.onkeyup = function() {

		var searchItemElement = this,
			searchResultsElement = document.getElementById('searchResults'),
			spinnerElement = document.getElementById('spinner'),
			wishlistIdElement = document.getElementById('wishlistId'),
			items,
			xhr = new XMLHttpRequest(),
			params = 'name='+searchItemElement.value.toLowerCase();

		// Si la touche appuyée est une direction, retour
		var e = e || window.event;
	    if (e.keyCode == '37' ||
	    	e.keyCode == '38' ||
	    	e.keyCode == '39' ||
	    	e.keyCode == '40') {
	    	spinnerElement.style.display = "none";
	        return;
	    }

		// Si le champ de requête est vide, retour
		searchResultsElement.innerHTML = "";
		if(this.value.length == 0) {
			spinnerElement.style.display = "none";
			return;
		}

		// Apparition du spinner
		spinnerElement.style.display = "";

		clearTimeout(timeout);

    	// Ajout du délai du timout pour éviter les multiples requêtes serveur
    	timeout = setTimeout(function () {
        	
    		// Envoi de la requête à la fonction PHP
			xhr.open("POST","functions/search_item_in_nostalgeek.php");
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.onreadystatechange = function() {
	    		if (this.readyState == 4 && this.status == 200) {
	       			items = JSON.parse(this.response);
	       			
	  				for(var i = 0; i < items.length ; i++) {

	  					// Remplacement des charactères échapés dans les noms
	  					items[i]['name'] = items[i]['name'].replace("\\","");
	  					items[i]['name'] = items[i]['name'].replace("\\'","'");

	  					// Encodage du nom pour les liens d'ajouts
	  					var encodedName = encodeURIComponent(items[i]['name']);

	  					// Ajout des items sur la liste affichée
						var resultLiElement = document.createElement('LI'),
							resultLiLinkElement = document.createElement('A'),
							resultLiElementContent = document.createTextNode(items[i]['name']),
							resultLiAddElement = document.createElement('SPAN');
						resultLiAddElement.innerHTML = 
						' - <a href="functions/add_item_to_wishlist.php?item_name='
						+encodedName+
						'&wishlist_id='
						+wishlistIdElement.value+
						'">Ajouter</a>';
						resultLiLinkElement.setAttribute('href','#');
						resultLiLinkElement.appendChild(resultLiElementContent);
						resultLiElement.appendChild(resultLiLinkElement);
						resultLiElement.appendChild(resultLiAddElement);
						searchResultsElement.appendChild(resultLiElement);
					}

					// Disparition du spinner
					spinnerElement.style.display = "none";
	    		}
			};
			xhr.send(params);
    	}, 1000);		
	};
};