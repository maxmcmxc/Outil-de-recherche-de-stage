<!--Traitement des donnÈes entrÈes dans le formulaire pour la modification admin et insertion dans la BDD-->
<?php 

require('../ressources/connexion.php');

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

//On commence par geter l'id qui est l'identifiant unique liant toutes les tables entre elles
$id=$_POST['id']; 

//Ajout des données du formulaire dans la BDD
$requete2=mysql_query("UPDATE poste SET poste='$poste' WHERE id='$id'") or die(mysql_error($connexion));
$requete3=mysql_query("UPDATE lieu SET pays='$pays', region='$region', ville='$ville' WHERE id='$id'") or die(mysql_error($connexion));
$requete4=mysql_query("UPDATE entreprise SET nom='$entreprise' WHERE id='$id'") or die(mysql_error($connexion));
$requete5=mysql_query("UPDATE duree SET duree='$duree' WHERE id='$id'") or die(mysql_error($connexion));
$requete6=mysql_query("UPDATE commentaire SET commentaire='$commentaire' WHERE id='$id'") or die(mysql_error($connexion));
$requete7=mysql_query("UPDATE secteur_activite SET secteur='$secteur' WHERE id='$id'") or die(mysql_error($connexion));
$requete2=mysql_query("UPDATE promo SET promo='$promo' WHERE id='$id'") or die(mysql_error($connexion));

if(isset($_POST['mission1'])) $requete=mysql_query("UPDATE mission_competence SET mission1='$mission1' WHERE id='$id' ") or die(mysql_error($connexion));
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
header("location:../experience.php?pg=experience&id=$id");
exit();
?>