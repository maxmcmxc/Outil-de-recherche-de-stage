<?php 
require("../ressources/connexion.php");

			$req=mysql_query("SELECT entreprise.nom, poste.poste, lieu.pays, poste.id
			FROM entreprise
			JOIN poste ON poste.id = entreprise.id
			JOIN lieu ON lieu.id = poste.id
			JOIN fiche ON fiche.numero = poste.id
			WHERE fiche.validite='1'");
			
			$requete=$req or die(mysql_error($connexion));

			while($ligne=mysql_fetch_row($requete))
			{
				$entreprise=$ligne[0];
				$poste=$ligne[1];
				$pays=$ligne[2];
				$id=$ligne[3];
				echo("</br><tr>
						<td>$entreprise</td>
						<td>$poste</td>
						<td>$pays</td>
						<span class='exp_ouinon'><td><span class='button'>
								<a href = '#' OnClick = \"affiche_overlay_window('./images/load.gif','experience.php?id=$id');\">Afficher</a>
							</span>
						</td>
						</span>
					</tr>"); 
	}

	mysql_close($connexion);		
?>