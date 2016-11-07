<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<!--En-tête de la page contenant les informations de lecture et les propriétés de la page-->
    <head>
    	<!--Titre de la page / affiché dans la barre de titre du navigateur-->
        <title>
       		Com'Book ISTC - 
       		<?php
				if (isset ($_GET['pg']))
					{
						$pg=$_GET['pg'];
						if (isset ($_GET['tri'])) $tri=$_GET['tri'];
						switch ($pg)
						{
							case 'rosace':
								$titrepage='Accueil';
								break;
							case 'tri':
								switch ($tri)
								{
									case 'secteur':
										$titrepage='Entreprise';
										break;
									case 'poste':
										$titrepage='Métier';
										break;
									case 'region':
										$titrepage='Région';
										break;
									case 'pays':
										$titrepage='Pays';
										break;
									case 'promo':
										$titrepage='Promo';
										break;
								}
								break;
								
							case 'affichage_exp':
								switch ($tri)
								{
									case 'entreprise':
										$titrepage='Entreprise';
										break;
									case 'secteur':
										$titrepage='Entreprise';
										break;
									case 'poste':
										$titrepage='Métier';
										break;
									case 'region':
										$titrepage='Région';
										break;
									case 'pays':
										$titrepage='Pays';
										break;
									case 'promo':
										$titrepage='Promo';
										break;
									
								}
								break;
							case 'experience':
								$titrepage='Expérience';
								break;
							case 'formajout':
								$titrepage='Ajout d\'expérience';
								break;
							case 'formajoutadmin':
								$titrepage='Modifier une expérience';
								break;
							case 'login':
								$login=1;
								$titrepage='Connexion';
								break;
							case 'carte':
								$titrepage='Région';
								break;
							case 'admin':
								$titrepage='Administration';
								break;
							case 'logadmin';
								$titrepage='Connexion Admin';
						}
					}
				else
					{
						$titrepage='Accueil';
					}
				echo $titrepage;
			?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Com'Book ISTC" content="Outil de recherche de témoignage de stage de l'ISTC - Stratégie&Communication"/>
        <script src="verifForm.js"></script>
		<script src="overlay.js"></script>
		<link rel="stylesheet" media="screen" type="text/css" title="Design Com'Book" href="styles.css"/>
		<div id="overlay" class="calque"></div>
		<div id="window" class="window"><iframe class = "contemp_window" id = "contempwindow" name = "contempwindow"></iframe></div>
	</head>

	<body>
		<div id="container">
			<!--Début de la bannière horizontale supérieur-->
			<div id="topbanner">
					<!--Vérification de session-->
					<?php 
						 session_start();
						 if(isset($_SESSION['user']))
						 {
						 }
						 else 
						 {if(!isset($login))
						 	{header("location:index.php?pg=login");exit();}
						 }
					?>
				<?php require('./topbanner/topbanner.php')?>
			</div>
			<!--Fin de la zone de bannière horizontale-->
			
			<!--Début de la partie principale de la page-->
			<div id="corps">
				
				<!--Début de la partie gauche de la page-->
				<div id="main">
				<?php
					if (isset ($_GET['pg']))
					{
						if (($_GET['pg'] == 'formajout') and (file_exists('./main/'.$_GET['pg'].'.php')))
						{
							require ('./main/'.$_GET['pg'].'.php');
						}
						elseif (($_GET['pg'] == 'affichage_exp') and (file_exists('./main/'.$_GET['pg'].'.php')))
						{
							require ('./main/'.$_GET['pg'].'.php');
						}
						elseif (($_GET['pg'] == 'traitementform') and (file_exists('./main/'.$_GET['pg'].'.php')))
						{
							require ('./main/'.$_GET['pg'].'.php');
						}
						elseif (($_GET['pg'] == 'login') and (file_exists('./main/'.$_GET['pg'].'.php')))
						{
							require ('./main/'.$_GET['pg'].'.php');
						}
						elseif (($_GET['pg'] == 'carte'))
						{
							require ('./main/'.$_GET['pg'].'.php');
						}
						elseif (($_GET['pg'] == 'tri'))
						{
							 echo ("<center><img src='./main/logoistc.jpg'/></center>");
						}
						elseif (($_GET['pg'] == 'admin') and (file_exists('./admin/'.$_GET['pg'].'.php')) /* and (isset($_SESSION['useradmin']))*/)
						{
							require ('./admin/'.$_GET['pg'].'.php');
						}
						elseif (($_GET['pg'] == 'formajoutadmin') and (file_exists('./admin/'.$_GET['pg'].'.php'))  and (isset($_SESSION['useradmin'])))
						{
							require ('./admin/'.$_GET['pg'].'.php');
						}
						elseif (($_GET['pg'] == 'traitementformadmin') /*and (file_exists('./admin/'.$_GET['pg'].'.php'))  and (isset($_SESSION['useradmin']))*/)
						{
							require ('./admin/'.$_GET['pg'].'.php');
						}
						elseif (($_GET['pg'] == 'logadmin') and (file_exists('./admin/'.$_GET['pg'].'.php')))
						{
							require ('./admin/'.$_GET['pg'].'.php');
						}
						else require('./main/rosace.php');
					}
					else
					{
						require('./main/rosace.php');
					}
				 ?>	
				</div>
				<!--Fin de la partie gauche de la page-->
	
				<!--Début de la partie droite de la page -->
				<?php echo("<div id='right'>");require('./right/right.php');echo("</div>");
				?>
				<!--Fin de la partie droite de la page -->
			
			</div>
			<!--Fin de la partie principale de la page-->
	
			<!--Début de la bannière horizontale inférieure de la page-->
			<div id="bottom">
				<center style="padding-top:6px;">
					© ISTC - Com'BooK 
				</center>
			</div>
			<!--Fin de la bannière horizontale inférieure de la page-->
    	</div>
	</body>

</html>