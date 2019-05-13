window.onload = function() {
	var searchItemElement = document.getElementById('searchItem');
	searchItemElement.onkeyup = function() {
		var searchResultsElement = document.getElementById('searchResults');
		searchResultsElement.innerHTML = "";
		if(this.value.length == 0) {
			return;
		}
		var items = [
			"Tunique de rédemption",
			"Garde-jambes de rédemption",
			"Bottes de rédemption",
			"Garde-mains de rédemption",
			"Ceinturon de rédemption",
			"Garde-poignets de rédemption"
		];
		for(var i = 0; i < items.length ; i++) {
			if(items[i].toLowerCase().search(this.value.toLowerCase()) == -1) {
				continue;
			}
			var resultLiElement = document.createElement('LI'),
				resultLiLinkElement = document.createElement('A'),
				resultLiElementContent = document.createTextNode(items[i]);
			resultLiLinkElement.setAttribute('href','#');
			resultLiLinkElement.appendChild(resultLiElementContent);
			resultLiElement.appendChild(resultLiLinkElement);
			searchResultsElement.appendChild(resultLiElement);
		}
	};
};