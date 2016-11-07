<form method="post" action="password.php" enctype="multipart/form-data" id="log" >
	<center>
		<table>
			<tr>
				
				<td>
					<label>Nom d'utilisateur :</label>
					<?php 
						echo "<input type='text' name='user'  maxlength='15'";
						if(isset($_COOKIE['login'])) 
						{
							echo "value='".$_COOKIE['login']."'";
						} 
						echo "/>";/*Cookie qui mémorise le nom d'uilisateur*/
					?>   
				</td>
			</tr>
			<tr>
				<td>
					<label>Mot de passe :</label>
					<input type="password" name="password" maxlength="15"/>
				</td>
			<tr>
				<td>
				<center><input id="button" type="submit" value="Connexion"></center>
				</td>
				
			</tr>
		</table>
	</center>
</form>