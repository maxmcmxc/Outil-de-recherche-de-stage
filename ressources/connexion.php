<?php
//Connexion à la BDD spécifique Com'Book
//$connexion=mysql_connect("mysql51zfs-42.perso","rubixcubactu","1iryxhad") or die(mysql_error($connexion));

$connexion=mysql_connect('127.0.0.1','root','') or die(mysql_error($connexion));
mysql_query("SET NAMES UTF8");
//$connexion->query('CREATE DATABASE rubixcubactu') or die(mysql_error($connexion));
mysql_select_db("rubixcubactu",$connexion) or die();

//Connexion à la BDD élève pour les mdp
//$connexion2=mysql_connect("mysql51-42.perso","rubixcubactu","1iryxhad") or die(mysql_error($connexion));
//mysql_query("SET NAMES UTF8");
//mysql_select_db("rubixcubactu",$connexion) or die(mysql_error($connexion));
//$db2 = mysql_connect("localhost" , "root" , "password" , true);
?>