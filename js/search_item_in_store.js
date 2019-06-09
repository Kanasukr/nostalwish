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
					var priceCupper = items[i]['price']%100, 
						priceSilver = Math.floor((items[i]['price']%10000)/100), 
						priceGold = Math.floor((items[i]['price'])/10000);

					var resultContent = "<li>";
					resultContent += '<a href="#">'+items[i]['name']+'</a>';
					resultContent += ' - Prix : ';
					if(priceGold > 0) {
						resultContent += priceGold+'po ';
					}
					if(priceSilver > 0) {
						resultContent += priceSilver+'pa ';
					}
					resultContent += priceCupper+'pc';
					resultContent += "</li>";

					searchResultsElement.innerHTML = resultContent;
					wishlistProposalElement.style.display = "none";
				}
    		}
		};
		xhr.send(params);
	};
};