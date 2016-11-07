<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" media="screen" type="text/css" title="Design Com'Book" href="styles.css"/>
		<script src="overlay.js"></script>
	</head>
	
	<body>
		<div id='temoignage'>
		<?php 	
			session_start();
			require('./ressources/connexion.php');
					
			$id=$_GET['id'];
			
			if (isset($_GET['act']) and isset($_SESSION['useradmin']))
			{
				$act=$_GET['act'];
				
				if($act=='valider')
				{
					$prenom=$_GET['prenom'];
					 $nom=$_GET['nom'];
					 $req_val1=mysql_query("UPDATE fiche SET validite='1' WHERE numero='$id'");
					
					$message = "Felicitations, votre expérience a bien été ajoutée ! Pour la consulter, rendez-vous sur combook_istc.fr";
					// Envoi du mail
					mail("duroycharles@gmail.com", 'combook', $message);
					//Retour aux expériences non validées
					header("location:experience.php?pg=experience&id=$id");exit();
				}
				
				elseif($act=='modifier')
				{	
					header("location:./admin/formajoutadmin.php?id=$id");exit();
				}
				
				elseif($act=='supprimer')
				{
					//Suppression d'une entrée complète
					$photorow=mysql_query("SELECT photo FROM photo WHERE id='$id'")or die(mysql_error($connexion));
					$row=mysql_fetch_array($photorow);
					$photo=$row[0];
					if($photo!="photos/"){
					unlink($photo);}
					$req_supp1=mysql_query("DELETE FROM entreprise WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp2=mysql_query("DELETE FROM poste WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp3=mysql_query("DELETE FROM commentaire WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp4=mysql_query("DELETE FROM duree WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp5=mysql_query("DELETE FROM lieu WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp6=mysql_query("DELETE FROM photo WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp7=mysql_query("DELETE FROM secteur_activite WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp8=mysql_query("DELETE FROM mission_competence WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp9=mysql_query("DELETE FROM promo WHERE id='$id'")or die(mysql_error($connexion));
					$req_supp10=mysql_query("DELETE FROM fiche WHERE numero='$id'")or die(mysql_error($connexion));
					echo("<div id='temoignage'>
						L'expérience a bien été supprimée <br/></div>");
				}	
			}
			else 
			{
				$requete=mysql_query("SELECT entreprise.nom, poste.poste, commentaire.commentaire, duree.duree, lieu.region, lieu.pays, secteur_activite.secteur, photo.photo, lieu.ville, mission_competence.mission1, mission_competence.mission2, mission_competence.mission3, mission_competence.mission4, mission_competence.mission5, mission_competence.competence1, mission_competence.competence2, mission_competence.competence3, mission_competence.competence4, mission_competence.competence5, promo.promo, fiche.validite
					FROM entreprise
					JOIN poste ON poste.id = entreprise.id
					JOIN commentaire ON commentaire.id = poste.id
					JOIN duree ON duree.id = commentaire.id
					JOIN lieu ON lieu.id = duree.id
					JOIN photo ON photo.id = lieu.id
					JOIN secteur_activite ON secteur_activite.id = photo.id
					JOIN mission_competence ON mission_competence.id = secteur_activite.id
					JOIN promo ON promo.id = secteur_activite.id
					JOIN fiche ON secteur_activite.id = fiche.numero
					WHERE lieu.id='$id'") or die(mysql_error($connexion));
							
				while($ligne=mysql_fetch_row($requete))
				{
					$entreprise=stripslashes($ligne[0]);
					$poste=stripslashes($ligne[1]);
					$commentaire=stripslashes($ligne[2]);
					$duree=$ligne[3];
					$region=stripslashes($ligne[4]);
					$pays=stripslashes($ligne[5]);
					$secteur=stripslashes($ligne[6]);
					
					if ($ligne[7]!="" and $ligne[7]!="photos/")
					{
						$photo=$ligne[7];
					}
					else
					{
						$photo='./photos/pointinterrogation.jpg';
					}
					
					$ville=stripslashes($ligne[8]);
					
					$mission1=stripslashes($ligne[9]);
					$mission2=stripslashes($ligne[10]);
					$mission3=stripslashes($ligne[11]);
					$mission4=stripslashes($ligne[12]);
					$mission5=stripslashes($ligne[13]);
					
					$competence1=stripslashes($ligne[14]);
					$competence2=stripslashes($ligne[15]);
					$competence3=stripslashes($ligne[16]);
					$competence4=stripslashes($ligne[17]);
					$competence5=stripslashes($ligne[18]);
					
					$promo=$ligne[19];
					$validite=$ligne[20];
				}
				echo("<div id='entreprise'>$entreprise</div>
						<div id='photo'>
							<center>
								<img src=$photo style='max-height:180px;max-width:200px;'/>
							</center>"); 
				$requete2=mysql_query("SELECT etudiant.nom, etudiant.prenom
					FROM etudiant INNER JOIN fiche
					ON etudiant.id = fiche.etudiant
					WHERE fiche.numero='$id'") or die(mysql_error($connexion));
				while($ligne=mysql_fetch_row($requete2))
				{
					$nom=$ligne[0];
					$prenom=$ligne[1];
				}
				echo ("<div id='ident'>
						<span style ='text-transform:uppercase;'>$nom</span>&nbsp;$prenom<br/>$promo<br/>
						<a href='mailto:$prenom.$nom@istc.fr'><span style='text-transform:lowercase;'>$prenom.$nom@istc.fr</span></a><br/>
						<span><a href='./admin/experience.php?act=supp&id=$id'>Supprimer l'expérience</a></span>
						<br/>
					</div>
					<div id='commentaire'>\"$commentaire\"</div>
					</div>
					<div id='zone_haut_gauche'>
						<span id='duree'><b>Durée :</b>&nbsp;$duree</span>&nbsp;mois<br/>
						<span id='secteur'><b>Secteur d'activité : </b>&nbsp;$secteur</span><br/>
						<span id='metier'><b>Métier :</b>&nbsp;$poste</span><br/>
						<span id='ville'><b>Lieu :</b>&nbsp;$ville</span>&nbsp;-&nbsp;<span id='region'>$region</span>&nbsp;-&nbsp;
						<span id='pays' style='text-transform:uppercase;'>$pays</span>
					</div>
					<div id='liste_mission'>
						Missions :
						<ul>
				");
				$i=1;
				while ($i<=5)
				{
					if (${'mission'.$i} !="" )
					{
						echo("
						<li>${'mission'.$i}</li>
						");
					}
					$i=$i+1;
				}
				echo("
						</ul>
					</div>								
					<div id='liste_competence'>
						Compétences :
						<ul>
					");
				$j=1;
				while ($j<=5)
				{
					if (${'competence'.$j} !="" )
					{
						echo("
						<li>${'competence'.$j}</li>
						");
					}
					$j=$j+1;
				}
				echo("	</ul>
					</div>
					<div id='admin' style='clear:both'>
					");
				
				if(isset($_SESSION['useradmin']))
				{
					echo
					("<center>
						<table>
						<tr>
						<td>
						<span class='button'><a href='experience.php?act=supprimer&id=$id&prenom=$prenom&nom=$nom'>
							Supprimer l'expérience</a>
						</span>
						</td>
						<td>
						<span class='button'><a href='experience.php?act=modifier&id=$id'>Modifier l'expérience</a>
						</span>
						</td>");
				if(empty($validite)) echo("<td><span class='button'><a href='experience.php?act=valider&id=$id&prenom=$prenom&nom=$nom'>
						Valider l'expérience</a>
						</span>
						</td>
						</tr>
						</table>
						</center>
					");
				else echo("</tr></table></center>");
				mysql_close($connexion);
				}
			}
			echo("
			</div>
			<div id='bouton'>
				<center>
					<span class='button'>
						<a href = '#' OnClick = 'cachetout();'>Retour</a>
					</span>
				</center>
			</div>
			");
			?>
		</div>
			
	</body>
</html>