//Script de vérification du formulaire (champs vides ?) - Com'BooK - ISTC

function afficherChamp(formulaire)
{
	if(formulaire.secteur.value=="autre") formulaire.autre_secteur.type="text";
	if(formulaire.secteur.value!="autre")  formulaire.autre_secteur.type="hidden";
}

//Script affichant les champs supplémentaires de missions

function afficherChamp2(formulaire)
{
	if(formulaire.mission1.value!="") 
	{
		formulaire.mission2.type="text";
	}
	else 
	{
		formulaire.mission2.type="hidden";
		formulaire.mission2.value="";
	}
	
	if(formulaire.mission2.value!="") 
	{
		formulaire.mission3.type="text";
	}
	else 
	{
		formulaire.mission3.type="hidden";
		formulaire.mission3.value="";
	}
	
	if(formulaire.mission3.value!="") 
	{
		formulaire.mission4.type="text";
	}
	else 
	{
		formulaire.mission4.type="hidden";
		formulaire.mission4.value="";
	}
	
	if(formulaire.mission4.value!="") 
	{
		formulaire.mission5.type="text";
	}
	else 
	{
		formulaire.mission5.type="hidden";
		formulaire.mission5.value="";
	}
}

//Script affichant les champs supplémentaires de compétences

function afficherChamp3(formulaire)
{
	if(formulaire.competence1.value!="") 
	{
		formulaire.competence2.type="text";
	}
	else 
	{
		formulaire.competence2.type="hidden";
		formulaire.competence2.value="";
	}
	
	if(formulaire.competence2.value!="") 
	{
		formulaire.competence3.type="text";
	}
	else 
	{
		formulaire.competence3.type="hidden";
		formulaire.competence3.value="";
	}
	
	if(formulaire.competence3.value!="") 
	{
		formulaire.competence4.type="text";
	}
	else 
	{
		formulaire.competence4.type="hidden";
		formulaire.competence4.value="";
	}
	
	if(formulaire.competence4.value!="") 
	{
		formulaire.competence5.type="text";
	}
	else 
	{
		formulaire.competence5.type="hidden";
		formulaire.competence5.value="";
	}
}

//Script recopiant la région de la liste à la case texte

function copierValeur(formulaire)
{
	if(formulaire.region2.value==" liste des regions francaises") 
	{
		formulaire.region.value="";
	}
	else
	{
		formulaire.region.value=formulaire.region2.value;
	}
}

/* On crée une fonction de verification */
function verifForm(formulaire)
{
	 /* on detecte si champ vide */
	if(formulaire.poste.value == "" || formulaire.entreprise.value == "" ||formulaire.ville.value == "" || formulaire.region.value == "" || formulaire.pays.value == "" || formulaire.promo.value == "" || formulaire.secteur.value == "" || formulaire.poste.value == "sélectionnez un secteur"
	|| formulaire.mission1.value == "" || formulaire.competence1.value == "" || formulaire.commentaire.value == "" || (formulaire.pays.value =="france" && formulaire.region.value == "liste des régions françaises"))
	{
		alert("Remplissez tous les champs et au moins 1 mission et 1 comp\351tence ");
		return false;
	}
	else  
	{
		return true;
//		document.forms["formulaire_ajout"].submit(); /* sinon le formulaire est envoyé */
	}
}

