<div id="results">
	<table>
		<tr>
			<th>Métier</th>
			<th>Entreprise</th>
			<th>Pays</th>
		</tr>
<?php 

require("./ressources/connexion.php");

if(isset($_GET['choix']))
{
	$choix=$_GET['choix'];
	$choix=urldecode($choix);
} 

if(isset($_GET['number']))
{
	$number=(int)($_GET['number']);
}

if(isset($_GET['tri']))
{
	$tri=$_GET['tri'];
}

$type=$_GET['type'];

if (isset($type))
{
	switch ($type)
	{
		case 'entreprise':
			$req=mysql_query("SELECT entreprise.nom, poste.poste, lieu.pays, poste.id	   
			FROM entreprise
			JOIN poste ON poste.id = entreprise.id
			JOIN lieu ON lieu.id = poste.id
			JOIN fiche ON fiche.numero = poste.id
			WHERE entreprise.nom='$choix' AND fiche.validite=1");
			break;
		case 'poste':
			switch ($tri) 
			{
				case 'poste':	
					$req=mysql_query("SELECT poste.poste, entreprise.nom, lieu.pays, poste.id	   
						FROM entreprise
						JOIN poste ON poste.id = entreprise.id
						JOIN lieu ON lieu.id = poste.id
						JOIN fiche ON fiche.numero = poste.id
						WHERE poste.poste='$choix' AND fiche.validite=1");
					break;
				case 'pays':	
					$req=mysql_query("SELECT poste.poste, entreprise.nom, lieu.pays, poste.id	   
						FROM entreprise
						JOIN poste ON poste.id = entreprise.id
						JOIN lieu ON lieu.id = poste.id
						JOIN fiche ON fiche.numero = poste.id
						WHERE lieu.pays='$choix' AND fiche.validite=1");
					break;
				case 'promo':
					$req=mysql_query("SELECT poste.poste, entreprise.nom, lieu.pays, poste.id   
						FROM entreprise
						JOIN poste ON poste.id = entreprise.id
						JOIN lieu ON lieu.id = poste.id
						JOIN fiche ON fiche.numero = poste.id
						JOIN promo ON promo.id = poste.id
						WHERE promo.promo='$choix' AND fiche.validite=1");
					break;
			}
			break;
		case 'secteur':
			$req=mysql_query("SELECT entreprise.nom, poste.poste, lieu.pays, poste.id
				FROM entreprise
				JOIN poste ON poste.id = entreprise.id
				JOIN lieu ON lieu.id = poste.id
				JOIN fiche ON fiche.numero = poste.id
				JOIN secteur_activite ON secteur_activite.id = poste.id
				WHERE secteur_activite.secteur='$choix' AND fiche.validite=1");
			break;
		case 'region':
			$req0=mysql_query("SELECT nom FROM regions WHERE id=$number");
			while($ligne=mysql_fetch_row($req0)) $region=$ligne[0];
				$req=mysql_query("SELECT entreprise.nom, poste.poste, lieu.region, lieu.id
					FROM entreprise
					JOIN poste ON poste.id = entreprise.id
					JOIN lieu ON lieu.id = poste.id
					JOIN fiche ON fiche.numero = poste.id
					WHERE lieu.region='$region' AND fiche.validite=1") or die(mysql_error($connexion));
			break;
	}
		
	$requete=$req or die(mysql_error($connexion));

	while($ligne=mysql_fetch_row($requete))
	{
		$entreprise=$ligne[0];
		$poste=$ligne[1];
		$pays=$ligne[2];
		$id=$ligne[3];
		echo("<tr>
				<td>$entreprise</td>
				<td>$poste</td>
				<td>$pays
					<span class='button'>
						<a href = '#' OnClick = \"affiche_overlay_window('./images/load.gif','experience.php?pg=experience&pg2=tri&tri=$tri&id=$id');\">Afficher</a>
					</span>
				</td>
			</tr>"); 
	}
}
	mysql_close($connexion);		
?>
	</table>
</div>