<?php 
	$useradmin=$_POST['useradmin'];
	$passadmin=/*md5*/($_POST['passadmin']);
	setcookie("loginadmin", $useradmin, time()+60);
	
	require('../ressources/connexion.php');
	
	$requete=mysql_query("select user,password from admin") or die(mysql_error($connexion));
	
	while($ligne=mysql_fetch_row($requete))
	{
		$user2=$ligne[0];
		$password2=$ligne[1];
		
		if($useradmin==$user2 && $passadmin==$password2) 
		{
			session_start();
		 	$_SESSION['useradmin']=$_POST['useradmin'];
			header("location:../index.php?pg=admin"); exit();
		} 
	}
	
	header("location:../index.php");
	
	mysql_close($connexion);
?>