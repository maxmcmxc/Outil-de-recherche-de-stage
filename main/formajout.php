<!--Formulaire de soumission de nouveau témoignage-->
<?php 
		 
		 if(isset($_SESSION['user']))
		 {
		 	require('./ressources/connexion.php');
		 }
		 else 
		 {
		 	header("location:index.php");
		 }
?>


<form id="formulaire_ajout" enctype="multipart/form-data" method="post" action="index.php?pg=traitementform">				
	
	<fieldset id="info_metier">
		<label>Nom de l'entreprise :</label>
		<input  name="entreprise"  type="text" maxlength="50" value=""/><br/>
	
		<label>M&eacute;tier :</label>
		<input name="poste" type="text" maxlength="50" value=""/><br/>

		<label>Secteur d'activit&eacute :</label>
		<select name="secteur" onChange="afficherChamp(this.form)"> 
			<?php 
				require('./ressources/connexion.php');
				$requete=mysql_query("SELECT secteur FROM secteur order by secteur asc")or die(mysql_error($connexion));
				while($ligne=mysql_fetch_row($requete))
					{
						$secteur=$ligne[0];
						echo("<option value=\"$secteur\">$secteur</option>");			
					}										
			?>
		<option value="autre">Autre</option>
		</select>
		
		<input  name="autre_secteur"  type="hidden" maxlength="50" value=""/><br/>
	</fieldset>

	<fieldset id="info_stage">
		<label>Ville :</label>
		<input name="ville" type="text" maxlength="40" value=""/><br/>
		
		<label>Pays :</label>
		<input name="pays" type="text" maxlength="40" value=""/><br/>
		
		<label>R&eacute;gion :</label>
		<input name="region" type="text" maxlength="30" value=""/>
		<select name="region2" onChange="copierValeur(this.form)">
			<?php 
				require('./ressources/connexion.php');
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
				require('./ressources/connexion.php');
				$requete=mysql_query("SELECT duree FROM duree_formulaire") or die(mysql_error($connexion));
				while($ligne=mysql_fetch_row($requete))
					{
						$duree=$ligne[0];
						echo("<option value=\"$duree\">$duree</option>");			
					}							
			?>
		</select> mois<br/>
		
	</fieldset>
		
	<fieldset id="info_etud">
	
		<label>Photo de l'étudiant :</label>
		<input name="photo" class="element file" type="file"/>
	
		<label>Promo :</label>
		<select name="promo">
			<option value="">---</option>
			<option value="L3">L3</option>
			<option value="M1">M1</option>
			<option value="M2">M2</option>
		</select>
	
	</fieldset>
	
	<div style='clear:both'></div>
	
	<fieldset id="info_avis">
		<div id="info_mission">
			<label >Missions (au moins une) :</label></br>
			<input name="mission1" type="text" maxlength="50" size="40" value="" onChange="afficherChamp2(this.form)"/><br/>
			<input name="mission2" type="hidden" maxlength="50" size="40" value="" onChange="afficherChamp2(this.form)"/><br/>
			<input name="mission3" type="hidden" maxlength="50" size="40" value="" onChange="afficherChamp2(this.form)"/><br/>
			<input name="mission4" type="hidden" maxlength="50" size="40" value="" onChange="afficherChamp2(this.form)"/><br/>
			<input name="mission5" type="hidden" maxlength="50" size="40" value=""/><br/>
		
			<label>Compétences requises (au moins une) :</label></br>
			<input name="competence1" type="text" maxlength="50" size="40" value="" onChange="afficherChamp3(this.form)"/><br/>
			<input name="competence2" type="hidden" maxlength="50" size="40" value="" onChange="afficherChamp3(this.form)"/><br/>
			<input name="competence3" type="hidden" maxlength="50" size="40" value="" onChange="afficherChamp3(this.form)"/><br/>
			<input name="competence4" type="hidden" maxlength="50" size="40" value="" onChange="afficherChamp3(this.form)"/><br/>
			<input name="competence5" type="hidden" maxlength="50" size="40" value=""/><br/>
		</div>
		
		<div id="avis">
			<label>Avis sur le stage (compétences acquises, etc...) :</label><br/><br/>
			<textarea name="commentaire" rows="10" cols="40"></textarea> <br/>
		</div>
		<?php 
			$prior_requete2=mysql_query("select id from entreprise order by date asc") or die(mysql_error($connexion));
			
			while($ligne=mysql_fetch_row($prior_requete2)) 
			{
				$id0=$ligne[0];
			}
			$ide=$id0+1;
			echo("<input name=\"id\" value=$ide type=\"hidden\" />"); 
		?>
	</fieldset>
	
	<center>
		<input  class="button_text" type="submit" name="submit1" value="Envoyer" onClick='return verifForm(this.form);'/>
	</center>
</form>