<!--Traitement de la rosace lors du clique sur une des pétales-->
<?php 
require('./ressources/connexion.php');

if(isset($_GET['tri']))
{
	$tri=$_GET['tri'];
	
	switch ($tri) 
	{
		case 'poste':
			$requete=mysql_query("SELECT poste FROM poste JOIN fiche ON fiche.numero = poste.id WHERE fiche.validite=1 GROUP BY poste") or die(mysql_error($connexion));
			break;
		case 'promo':
			$requete=mysql_query("SELECT promo FROM promo JOIN fiche ON fiche.numero = promo.id WHERE fiche.validite=1 GROUP BY promo") or die(mysql_error($connexion));
			break;
		case 'pays':
			$requete=$requete=mysql_query("SELECT pays FROM lieu WHERE pays!='france' GROUP BY pays") or die(mysql_error($connexion));
			break;
		case 'secteur':
			echo("<ul>");
				$requete=mysql_query("SELECT secteur FROM secteur_activite JOIN fiche ON fiche.numero = secteur_activite.id WHERE fiche.validite=1 GROUP BY secteur") or die(mysql_error($connexion));
				
				while($ligne=mysql_fetch_row($requete))
				{
					$secteur=urlencode($ligne[0]);
					$secteur2=urldecode($secteur);
					echo("<li>$secteur2</li>");
					
					$requete0=mysql_query("SELECT entreprise.nom 
						FROM entreprise  
						JOIN secteur_activite ON entreprise.id=secteur_activite.id
						JOIN fiche ON fiche.numero = entreprise.id
						WHERE secteur_activite.secteur='$secteur2' AND fiche.validite=1
						GROUP BY entreprise.nom") or die(mysql_error($connexion));
			
					while($ligne=mysql_fetch_row($requete0))
					{	
						$entreprise=urlencode($ligne[0]);
						$entreprise2=urldecode($entreprise);
						echo("<span class='button' style='display:inline;'>
								<a href=index.php?pg=affichage_exp&pg2=tri&tri=$tri&choix=$entreprise&type=entreprise>$entreprise2</a>
						 	</span>&nbsp");
					}
					echo ("<br/>");
				}
			echo("</ul>");
			break;
	}
	if ($tri!='secteur' && $tri!='region')
	{
		while($ligne=mysql_fetch_row($requete))
		{
			$var1=urlencode($ligne[0]);
			$var2=urldecode($var1);
			echo("
				<table>
					<tr>
						<td>
							<span class='button'>
								<a href=index.php?pg=affichage_exp&pg2=tri&tri=$tri&choix=$var1&type=poste>$var2</a>
							</span>
						</td>
					</tr>
				</table>
			");
		}
	}
}
else
{
	header("location:index.php");
	mysql_close($connexion);		
}	
mysql_close($connexion);			
?>