window.onload = function() {
	var searchItemElement = document.getElementById('searchItem');
	searchItemElement.onkeyup = function() {
		var searchItemElement = this,
			searchResultsElement = document.getElementById('searchResults'),
			wishlistProposalElement = document.getElementById('wishlistProposal'),
			items,
			xhr = new XMLHttpRequest(),
			params = 'item_name='+searchItemElement.value.toLowerCase();

		// Si le champ de requête est vide, retour
		if(this.value.length == 0) {
			searchResultsElement.innerHTML = "";
			wishlistProposalElement.style.display = "none";
			return;
		}

		// Envoi de la requête à la fonction PHP
		xhr.open("POST","functions/search_item_in_store.php");
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
    			searchResultsElement.innerHTML = "";
    			wishlistProposalElement.style.display = "";
       			items = JSON.parse(this.response);
       			
  				for(var i = 0; i < items.length ; i++) {
  					// Ajout des items sur la liste affichée
					var resultLiElement = document.createElement('LI'),
						resultLiLinkElement = document.createElement('A'),
						resultLiElementContent = document.createTextNode(items[i]['name']);
					resultLiLinkElement.setAttribute('href','#');
					resultLiLinkElement.appendChild(resultLiElementContent);
					resultLiElement.appendChild(resultLiLinkElement);
					searchResultsElement.appendChild(resultLiElement);
					wishlistProposalElement.style.display = "none";
				}
    		}
		};
		xhr.send(params);
	};
};