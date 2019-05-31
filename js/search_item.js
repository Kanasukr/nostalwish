window.onload = function() {
	var searchItemElement = document.getElementById('searchItem');
	searchItemElement.onkeyup = function() {
		var searchItemElement = this,
			searchResultsElement = document.getElementById('searchResults'),
			items,
			xhr = new XMLHttpRequest();

		// Si le champ de requête est vide, retour
		if(this.value.length == 0) {
			searchResultsElement.innerHTML = "";
			return;
		}

		// Envoi de la requête à la fonction PHP
		xhr.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
    			searchResultsElement.innerHTML = "";
       			items = JSON.parse(this.response);
       			
       			// Comparaison de la recherche avec les items
  				for(var i = 0; i < items.length ; i++) {
					if(items[i]['name'].toLowerCase().search(searchItemElement.value.toLowerCase()) == -1) {
						continue;
					}
					var resultLiElement = document.createElement('LI'),
						resultLiLinkElement = document.createElement('A'),
						resultLiElementContent = document.createTextNode(items[i]['name']);
					resultLiLinkElement.setAttribute('href','#');
					resultLiLinkElement.appendChild(resultLiElementContent);
					resultLiElement.appendChild(resultLiLinkElement);
					searchResultsElement.appendChild(resultLiElement);
				}
    		}
		};
		xhr.open("POST","functions/search_item.php");
		xhr.send();
	};
};