//Script d'affichage page d'expérience - Com'BooK - ISTC
var w3c=document.getElementById && !document.all;
var ie=document.all;

if (ie||w3c) {
 // déclaration des variables uniquement pour IE
 var overlay;
 var my_window;
}


function affiche_overlay_window(image_fond_overlay,adresse_page){
	// creation de l'overlay et affichage de l'image
	montreoverlay("<table class = 'image_calque ' valign = 'center' border = '0' align = 'center'><tr><td> <IMG  SRC='"+image_fond_overlay+"'></td></tr>");
	// creation de la fenêtre
	montrefenetre(adresse_page);


}

function envoieRequete(url,id)
{
var xhr_object = null;
var position = id;
if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest();
else
if (window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
// On ouvre la requete vers la page désirée
xhr_object.open("GET", url, true);
xhr_object.onreadystatechange = function(){
	if ( xhr_object.readyState == 4 )
	{
	// j'affiche dans la DIV spécifiées le contenu retourné par le fichier
		if(document.getElementById(position) != null){
	document.getElementById(position).innerHTML = xhr_object.responseText;}
		else{
			
			window.parent.document.getElementById(position).innerHTML = xhr_object.responseText;
			
		}
	}
}
// dans le cas du get
xhr_object.send(null);
} 

function affiche_exp_non(){
	// 
	require('./admin/admin_exp_non.php');
}

function montreoverlay(text) {
  if (w3c||ie){
    overlay = document.all ? document.all["overlay"] : document.getElementById ? document.getElementById("overlay") : ""
	overlay.innerHTML = text; // fixe le code HTML dans l'overlay balise (div)
    overlay.style.visibility = "visible"; // modification du style

  }
}

function montrefenetre(html) {
  if (w3c||ie){
    //affichage de la fenetre
	my_window = document.all ? document.all['window'] : document.getElementById ? document.getElementById('window') : ""
    my_window.style.visibility = "visible";

	// affichage du corps de la fenêtre (balise iframe)
    my_window = document.all ? document.all['contempwindow'] : document.getElementById ? document.getElementById('contempwindow') : ""
    my_window.style.visibility = "visible";
    frames['contempwindow'].location.href= html ;

  }
}

function cachetout() {
	if (w3c||ie){
		
	// masque la fenetre (balise div [window] )
	my_window = parent.document.getElementById('window');
	my_window.style.visibility = "hidden";

	// masque le contenu (balise iframe [contempwindow])
	my_window = parent.document.getElementById('contempwindow');
	my_window.style.visibility = "hidden";

	// masque l'overlay (balise div [overlay])
	my_window = document.all ? parent.document.all['overlay'] : parent.document.getElementById ? parent.document.getElementById('overlay') : ""
	my_window.style.visibility = "hidden";

	envoieRequete('./admin/admin_exp_non.php','roger');
	envoieRequete('./admin/admin_exp_oui.php','roger2');
	
	}
}


