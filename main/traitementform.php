<!--Traitement des donnÈes entrÈes dans le formulaire et insertion dans la BDD-->
<?php 

require('./ressources/connexion.php');

//Traitement de l'image
if(!empty($_FILES['photo']['name'])) 
{ 
	$name_photo=urlencode($_FILES['photo']['name']);
	$tmp_name_photo=$_FILES['photo']['tmp_name'];
	$size_photo=$_FILES['photo']['size'];
	$type_photo=$_FILES['photo']['type'];
	$originale=imagecreatefromjpeg($tmp_name_photo);
	
	if(($size_photo>'0') && (($type_photo=="image/jpeg") || ($type_photo=="image/jpg"))) // Fichiers autorisés pour l'illustration: .jpg/.jpeg
	{
		//Resize
		$copie=imagecreatefromjpeg($tmp_name_photo); // On pourra conserver l'image dans un grand format pour faire une image cliquable
		$taille_originale=getimagesize($tmp_name_photo); //array; $taille_originale[0] donne la largeur de l'image, $taille_originale[1] sa hauteur.
	}
	
	if($taille_originale[1] > $taille_originale[0]) 
	{
		$nouvelle_hauteur=200;
		$rapport_de_reduction=$nouvelle_hauteur/$taille_originale[1];
		$nouvelle_largeur=$rapport_de_reduction*$taille_originale[0];
	}
	else if($taille_originale[0] >= $taille_originale[1]) 
	{
		$nouvelle_largeur=200;
		$rapport_de_reduction=$nouvelle_largeur/$taille_originale[0];
		$nouvelle_hauteur=$rapport_de_reduction*$taille_originale[1];
	}
	
	$copie = imagecreatetruecolor($nouvelle_largeur , $nouvelle_hauteur) or die ("Erreur");	
	imagecopyresampled($copie , $originale, 0, 0, 0, 0, $nouvelle_largeur, $nouvelle_hauteur, $taille_originale[0],$taille_originale[1]);
	
	imagejpeg($copie , "photos/$name_photo", 85);    // TAILLE INFERIEURE A 10 ko
	/*if($size_photo>4000000 & $size_photo>4000000) imagejpeg($copie , "photos/$name_photo", 85);
	if($size_photo>4000000) imagejpeg($copie , "photos/$name_photo", 85);
	if($size_photo>4000000) imagejpeg($copie , "photos/$name_photo", 85);
	if($size_photo>4000000) imagejpeg($copie , "photos/$name_photo", 85);
	if($size_photo>4000000) imagejpeg($copie , "photos/$name_photo", 85);*/
}

//Gestion d'un autre secteur
if (isset($_POST['autre_secteur']))
{
	if($_POST['autre_secteur']!="")
	{
		$secteur1=$_POST['autre_secteur'];
		$secteur=addslashes($secteur1);
		$requete100=mysql_query("insert into secteur(secteur) values('$secteur')") or die(mysql_error($connexion));
	}
}
else 
{
	$secteur1=$_POST['secteur'];
	$secteur=addslashes($secteur1);
}

//Affectation des variables
$poste=addslashes($_POST['poste']);
$pays=addslashes($_POST['pays']);
$ville=addslashes($_POST['ville']);
$duree=$_POST['duree'];
$region=addslashes($_POST['region']);
$commentaire=addslashes($_POST['commentaire']);
$entreprise=addslashes($_POST['entreprise']);
$secteur=$_POST['secteur'];
$promo=$_POST['promo'];
$user=$_SESSION['user'];

if(isset($_POST['mission1'])) $mission1=addslashes($_POST['mission1']);
if(isset($_POST['mission2'])) $mission2=addslashes($_POST['mission2']);
if(isset($_POST['mission3'])) $mission3=addslashes($_POST['mission3']);
if(isset($_POST['mission4'])) $mission4=addslashes($_POST['mission4']);
if(isset($_POST['mission5'])) $mission5=addslashes($_POST['mission5']);

if(isset($_POST['competence1'])) $competence1=addslashes($_POST['competence1']);
if(isset($_POST['competence2'])) $competence2=addslashes($_POST['competence2']);
if(isset($_POST['competence3'])) $competence3=addslashes($_POST['competence3']);
if(isset($_POST['competence4'])) $competence4=addslashes($_POST['competence4']);
if(isset($_POST['competence5'])) $competence5=addslashes($_POST['competence5']);

//Récupération de l'id de l'étudiant qui ajoute son expérience
$requete=mysql_query("select id from etudiant where user='$user'") or die(mysql_error($connexion));
while($ligne=mysql_fetch_row($requete)) $id_user=$ligne[0];

//On commence par geter l'ide qui est l'identifiant unique liant toutes les tables entre elles
$id=$_POST['id'];

//Ajout des données du formulaire dans la BDD
$requete2=mysql_query("insert into poste(poste,id) values('$poste', '$id')") or die(mysql_error($connexion));
$requete3=mysql_query("insert into lieu(pays,region, ville, id) values('$pays','$region', '$ville', '$id')") or die(mysql_error($connexion));
$requete4=mysql_query("insert into entreprise(nom, id) values('$entreprise', '$id')") or die(mysql_error($connexion));
if(isset($_FILES['photo']['name'])) $requete4=mysql_query("insert into photo(photo, id) values('photos/$name_photo', '$id')") or die(mysql_error($connexion));
$requete5=mysql_query("insert into duree(duree, id) values('$duree', '$id')") or die(mysql_error($connexion));
$requete6=mysql_query("insert into commentaire(commentaire, id) values('$commentaire', '$id')") or die(mysql_error($connexion));
$requete7=mysql_query("insert into secteur_activite(secteur, id) values('$secteur', '$id')") or die(mysql_error($connexion));
$requete2=mysql_query("insert into promo(promo, id) values('$promo', '$id')") or die(mysql_error($connexion));
$requete8=mysql_query("insert into fiche(etudiant, numero) values('$id_user', '$id')") or die(mysql_error($connexion));

if(isset($_POST['mission1'])) $requete=mysql_query("insert into mission_competence(mission1, id) values('$mission1', '$id')") or die(mysql_error($connexion));
if(isset($_POST['mission2'])) $requete=mysql_query("UPDATE mission_competence SET mission2='$mission2' WHERE id='$id' ") or die(mysql_error($connexion));
if(isset($_POST['mission3'])) $requete=mysql_query("UPDATE mission_competence SET mission3='$mission3' WHERE id='$id' ") or die(mysql_error($connexion));
if(isset($_POST['mission4'])) $requete=mysql_query("UPDATE mission_competence SET mission4='$mission4' WHERE id='$id' ") or die(mysql_error($connexion));
if(isset($_POST['mission5'])) $requete=mysql_query("UPDATE mission_competence SET mission5='$mission5' WHERE id='$id' ") or die(mysql_error($connexion));

if(isset($_POST['competence1'])) $requete=mysql_query("UPDATE mission_competence SET competence1='$competence1' WHERE id='$id' ") or die(mysql_error($connexion));
if(isset($_POST['competence2'])) $requete=mysql_query("UPDATE mission_competence SET competence2='$competence2' WHERE id='$id' ") or die(mysql_error($connexion));
if(isset($_POST['competence3'])) $requete=mysql_query("UPDATE mission_competence SET competence3='$competence3' WHERE id='$id' ") or die(mysql_error($connexion));
if(isset($_POST['competence4'])) $requete=mysql_query("UPDATE mission_competence SET competence4='$competence4' WHERE id='$id' ") or die(mysql_error($connexion));
if(isset($_POST['competence5'])) $requete=mysql_query("UPDATE mission_competence SET competence5='$competence5' WHERE id='$id' ") or die(mysql_error($connexion));


mysql_close($connexion);

header("location:index.php"); 
exit();
?>