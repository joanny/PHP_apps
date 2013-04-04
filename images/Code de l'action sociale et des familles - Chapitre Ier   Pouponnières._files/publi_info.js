// Récupération de l'url courante
var url_courante = document.location.href;

// Sélection de la bonne css
url_css = "";
if(url_courante.search('linternaute.com/femmes') != -1) url_css = 'http://www.linternaute.com/femmes/html_externe3/style/publi_info.css';
else if(url_courante.search('journaldunet.com') != -1) url_css = 'http://www.journaldunet.com/html_externe3/style/publi_info.css';
else {
	if(url_courante.search('mer-voile') == -1) {
		url_css = 'http://www.linternaute.com/html_externe3/style/publi_info.css';
	}
}

if(url_css != "") {
	// Ajout de la css dans le dom
	var headID = document.getElementsByTagName("head")[0];         
	var cssNode = document.createElement('link');
	cssNode.type = 'text/css';
	cssNode.rel = 'stylesheet';
	cssNode.href = url_css;
	cssNode.media = 'screen';
	headID.appendChild(cssNode);
}