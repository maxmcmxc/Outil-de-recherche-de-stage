<!--Partie supérieur de la page -->
<div id="right2">
	<?php
		if ((isset ($_GET['pg']) and ($_GET['pg'] == 'tri')) or (isset ($_GET['pg2']) and ($_GET['pg2'] == 'tri')) )
		{
			require ('./right/tri.php');
		}
		else
		{
			echo ("
				<center>
					<h4>Contact</h4>
					<table>
						<tr>
							<td>
								<a href='mailto:combookistc@gmail.com'>Contacter l'équipe de Com'BooK</a>
							</td>
						</tr>
					</table>
					<table>
					 	<tr>
						 	<td>
						 		<span class='button'>
						 			<a href = 'index.php?pg=admin' >
										Administration
									</a>
						 		</span>
						 	</td>
						 </tr>
					</table>
					<table>
					 	<tr>
						 	<td>
								<span class='button'>
									<a href='index.php?pg=formajout'>
										Ajout d'exp&eacute;rience
									</a>
								</span>
						 	</td>
						 </tr>
					</table>
				</center>
			");
		}
	?>
</div>
		
<!--Partie inférieur de la page -->
<div id="actu">
	<center>
		<h4>Actu : Les derniers stages</h4>
	</center>
	<table>	
		<?php	
			require('./ressources/connexion.php');
			if(isset($_SESSION['user']))
			{
				$requete=mysql_query("SELECT entreprise.nom, poste.id, poste.poste, lieu.pays
										FROM entreprise
										JOIN poste ON poste.id = entreprise.id
										JOIN lieu ON lieu.id = poste.id
										JOIN fiche ON fiche.numero = poste.id
										WHERE fiche.validite=1
										ORDER BY poste.id DESC
										LIMIT 3") or die(mysql_error($connexion));
										
				while($ligne=mysql_fetch_row($requete))
				{
					$entreprise=$ligne[0];
					 $id=$ligne[1];
					 $poste=$ligne[2];
					 $pays=$ligne[3];
			
					echo("
							<tr>
								<td>
									<a href = '#' OnClick = \"affiche_overlay_window('./images/load.gif','experience.php?pg=experience&id=$id');\">$entreprise>$poste>$pays</a>
									<br/>
									<br/>
								</td>
							</tr>
					"); 
				}
			}
			else 
			{
				if(!isset($login))
				{
					header("location:index.php?pg=login");exit();
				}
			}
		?>
	</table>
	

	
</div>
