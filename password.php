<?php 
	$user=$_POST['user'];
	$password=/*md5*/($_POST['password']);
	setcookie("login", $user, time()+60);
	
	require('./ressources/connexion.php');
	
	$requete=mysql_query("select user,password from etudiant order by id") or die(mysql_error($connexion));
	
	while($ligne=mysql_fetch_row($requete))
	{
		$user2=$ligne[0];
		$password2=$ligne[1];
		
		if($user==$user2 && $password==$password2) 
		{
			session_start();
		 	$_SESSION['user']=$_POST['user'];
		 	/*if ($_SESSION['user']=='admin'){header("location:affichage.php");exit();}
		 	else {*/
			header("location:index.php"); exit();
		} 
	}
	
	header("location:index.php?pg=login");
	
	mysql_close($connexion);
?>