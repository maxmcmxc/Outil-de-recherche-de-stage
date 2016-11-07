<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" media="screen" type="text/css" title="Design Com'Book" href="../styles.css"/>
		<script src="overlay.js"></script>
		<script src="verifForm.js"></script>
	</head>

<body>
	<div id='temoignage'>
	<!--Formulaire de soumission de nouveau témoignage-->
	<?php 
			session_start();
			require('../ressources/connexion.php');
			if(isset($_SESSION['useradmin']))
			{	
			 	$id=$_GET['id'];
				
				$requete=mysql_query("SELECT entreprise.nom, poste.poste, commentaire.commentaire, duree.duree, lieu.region, lieu.pays, secteur_activite.secteur, photo.photo, lieu.ville, mission_competence.mission1, mission_competence.mission2, mission_competence.mission3, mission_competence.mission4, mission_competence.mission5, mission_competence.competence1, mission_competence.competence2, mission_competence.competence3, mission_competence.competence4, mission_competence.competence5, promo.promo
					FROM entreprise
					JOIN poste ON poste.id = entreprise.id
					JOIN commentaire ON commentaire.id = poste.id
					JOIN duree ON duree.id = commentaire.id
					JOIN lieu ON lieu.id = duree.id
					JOIN photo ON photo.id = lieu.id
					JOIN secteur_activite ON secteur_activite.id = photo.id
					JOIN mission_competence ON mission_competence.id = secteur_activite.id
					JOIN promo ON promo.id = secteur_activite.id
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
				}
				
				$requete2=mysql_query("SELECT etudiant.nom, etudiant.prenom
					FROM etudiant INNER JOIN fiche
					ON etudiant.id = fiche.etudiant
					WHERE fiche.numero='$id'") or die(mysql_error($connexion));
				while($ligne=mysql_fetch_row($requete2))
				{
					$nom=$ligne[0];
					$prenom=$ligne[1];
				}
	
				mysql_close($connexion);	
				
			 }
			 else 
			 {	
			 	header("location:index.php");
			 }
	?>
	
	
	<form id="formulaire_ajout" enctype="multipart/form-data" method="post" action="traitementformadmin.php">				
		
		<fieldset id="info_metier">
			<label>Nom de l'entreprise :</label>
			<input  name="entreprise"  type="text" maxlength="50" value="<?php echo $entreprise;?>"/><br/>
		
			<label>M&eacute;tier :</label>
			<input name="poste" type="text" maxlength="50" value="<?php echo $poste;?>"/><br/>
	
			<label>Secteur d'activit&eacute :</label>
			<select name="secteur" > 
				<?php 
					$c=0;
					require('../ressources/connexion.php');
					$requete0=mysql_query("SELECT secteur FROM secteur_activite where id='$id'")or die(mysql_error($connexion));
					while($ligne=mysql_fetch_row($requete0))
						{$secteur0=$ligne[0];}
					$requete=mysql_query("SELECT secteur FROM secteur order by secteur asc")or die(mysql_error($connexion));
					while($ligne=mysql_fetch_row($requete))
						{	
							$secteur=$ligne[0];
							if($secteur==$secteur0)
							{echo("<option value=\"$secteur\" selected=\"selected\">$secteur</option>");	$c=$c+1;}
							else echo("<option value=\"$secteur\">$secteur</option>");	
						}										
				?>
			<option value="autre" <?php if($c=='0') echo ("selected=\"selected\" ");?>>Autre</option>
			</select>
			
			<input  name="autre_secteur"  type="hidden" maxlength="50" value="<?php if($c=='0') echo ("$secteur");?>"/><br/>
		</fieldset>
	
		<fieldset id="info_stage">
			<label>Ville :</label>
			<input name="ville" type="text" maxlength="40" value="<?php echo $ville;?>"/><br/>
			
			<label>Pays :</label>
			<input name="pays" type="text" maxlength="40" value="<?php echo $pays;?>"/><br/>
			
			<label>R&eacute;gion :</label>
			<input name="region" type="text" maxlength="30" value="<?php echo $region;?>"/>
			<select name="region2" >
				<?php 
					require('../ressources/connexion.php');
					$requete=mysql_query("SELECT nom FROM regions order by nom asc")or die(mysql_error($connexion));
					while($ligne=mysql_fetch_row($requete))
						{
							$region=$ligne[0];
							echo("<option value=\"$region\">$region</option>");			
						}						
				?>
			</select>
			<br/>
			<label>Dur&eacute;e :</label>
			<select name="duree"> 
				<?php 
					require('../ressources/connexion.php');
					$requete0=mysql_query("SELECT duree FROM duree WHERE id='$id'") or die(mysql_error($connexion));
					while($ligne=mysql_fetch_row($requete0))
						{$duree0=$ligne[0];}
					$requete=mysql_query("SELECT duree FROM duree_formulaire") or die(mysql_error($connexion));
					while($ligne=mysql_fetch_row($requete))
						{
							$duree=$ligne[0];
							if($duree0==$duree) 
							echo("<option value=\"$duree\" selected=\"selected\">$duree</option>");
							else echo("<option value=\"$duree\">$duree</option>");
						}							
				?>
			</select> mois<br/>
			
		</fieldset>
			
		<fieldset id="info_etud">
		
			<label>Promo :</label>
			<select name="promo">
				<option value="">---</option>
				<option value="L3" <?php if($promo=='L3')echo("selected=\"selected\"");?>> L3</option>
				<option value="M1" <?php if($promo=='M1')echo("selected=\"selected\"");?>> M1</option>
				<option value="M2" <?php if($promo=='M2')echo("selected=\"selected\"");?>> M2</option>
			</select>
		
		</fieldset>
		
		<div style='clear:both'></div>
		
		<fieldset id="info_avis">
			<div id="info_mission">
				<label >Missions (au moins une) :</label></br>
				<input name="mission1" type="text" maxlength="50" size="40" value="<?php echo $mission1;?>" /><br/>
				<input name="mission2" type="text" maxlength="50" size="40" value="<?php echo $mission2;?>" /><br/>
				<input name="mission3" type="text" maxlength="50" size="40" value="<?php echo $mission3;?>" /><br/>
				<input name="mission4" type="text" maxlength="50" size="40" value="<?php echo $mission4;?>" /><br/>
				<input name="mission5" type="text" maxlength="50" size="40" value="<?php echo $mission5;?>"/><br/>
			
				<label>Comp&eacute;tences requises (au moins une) :</label></br>
				<input name="competence1" type="text" maxlength="50" size="40" value="<?php echo $competence1;?>"/><br/>
				<input name="competence2" type="text" maxlength="50" size="40" value="<?php echo $competence2;?>" /><br/>
				<input name="competence3" type="text" maxlength="50" size="40" value="<?php echo $competence3;?>" /><br/>
				<input name="competence4" type="text" maxlength="50" size="40" value="<?php echo $competence4;?>" /><br/>
				<input name="competence5" type="text" maxlength="50" size="40" value="<?php echo $competence5;?>"/><br/>
			</div>
			
			<div id="avis">
				<label>Avis sur le stage (comp&eacute;tences acquises, etc...) :</label><br/><br/>
				<textarea name="commentaire" rows="10" cols="40"><?php echo $commentaire; ?></textarea> <br/>
			</div>
			<?php 
				echo("<input name=\"id\" value=\"$id\" type=\"hidden\" />"); 
			?>
		</fieldset>
		
		<center>
			<input class="button_text" name="submit1" type="submit" value="Envoyer"/>
		</center>
	</form>
	</div>
</body>