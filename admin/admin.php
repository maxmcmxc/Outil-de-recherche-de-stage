<!--Traitement du nouveau mot de passe-->
<?php 
if (isset($_POST['oldmdp']) and isset($_POST['mdp1']) and isset($_POST['mdp2']))
{
	require('./ressources/connexion.php');

	$oldmdp=$_POST['oldmdp'];
	$mdp1=$_POST['mdp1'];
	$mdp2=$_POST['mdp2'];
	
	$mdpreq=mysql_query("SELECT password FROM admin WHERE user='combook_admin'");
	$row=mysql_fetch_array($mdpreq);
	$mdp=$row[0];
	if ($oldmdp==$mdp)
	{
		if ($mdp1==$mdp2)
		{
			$requete=mysql_query("UPDATE admin SET password='$mdp1' WHERE user='combook_admin'");
		}
	}
}

?>

<!--Affichage de l'interface pour se logger-->
<?php

if(!isset($_SESSION['useradmin']))
{
	echo("
	<form method='post' action='./admin/verifpassadmin.php' enctype='multipart/form-data' id='log' >
		<center>
			<table>
				<tr>
					<td>
						<label>Nom d'utilisateur :</label>
						<input type='text' name='useradmin'  maxlength='15' /> 
					</td>
				</tr>
				<tr>
					<td>
						<label>Mot de passe :</label>
						<input type='password' name='passadmin' maxlength='15'/>
					</td>
				<tr>
					<td>
					<center><input id='button' type='submit' value='Connexion'></center>
					</td>
					
				</tr>
			</table>
		</center>
	</form>
	");
}
else 
{
	echo("
	<div id='affichage_admin'>
		<div>
			<span class='button'>
				<a id='buttonRequete1'  href = '#' OnClick = \"envoieRequete('./admin/admin_exp_non.php','roger');\">
					Exp&eacute;riences non valid&eacute;es
				</a>
			</span>
			<div id='roger'>
				<br/>
			</div>
			<br/>
		</div>
		
		<div>
			<span class='button'>
				<a href = '#' id='buttonRequete2' OnClick = \"envoieRequete('./admin/admin_exp_oui.php','roger2');\">
					Exp&eacute;riences valid&eacute;es
				</a>
			</span>
			<div id='roger2'>
				<br/>
			</div>
			<br/>
		</div>
		
	</div>
	");
}
?>