<?php 
	session_start(); 
	header('Content-type: text/html; charset=utf-8');
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html 	xmlns="http://www.w3.org/1999/xhtml">
 	<head>
		<meta property="og:title" content="SESQUIDISTUS" />
		<meta property="og:type" content="sport" />
		<meta property="og:url" content="" />
		<meta property="og:image" content="SESQUIDISTUS" />
		<meta property="og:site_name" content="" />
		<meta property="fb:admins" content="1018024861" />
	 
	 <title>SESQUIDISTUS</title>
	 <meta name="Description" content="Le Site du club d'Ultimate Frisbee de Strasbourg" /> 
	
	  <!-- Déclaration de la meta pour l'encodage -->
	  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	  
	  <link rel="SHORTCUT ICON" href="favicon.ico" />
	  
	  <!-- Déclaration des fichiers javascript -->
	  <script type="text/javascript" src="./js/jquery/jquery-1.4.2.min.js"></script>
	  <script type="text/javascript" src="./fix_ie/iepngfix_tilebg.js"></script>
	  <script type="text/javascript" src="./js/jquery/jquery-ui.min.js"></script>
	  <script type="text/javascript" src="./js/galerie.js"></script>
	  <script type="text/javascript" src="./js/jquery/jquery.dropmenu.js"></script>
	  <script type="text/javascript" src="./js/jquery/jquery.ba-resize.min.js"></script>

	 
	 <!-- Déclaration des fichiers css -->	
	  <link href="./css/style.css" media="screen" rel="stylesheet" type="text/css" />
	  <link href="./css/dropmenu_apple.css" type="text/css" rel="stylesheet" />
	  <link type="text/css" href="./css/dialog.css" rel="stylesheet" />
	  <link href="./css/accordion.css" rel="stylesheet" type="text/css" />
	  <!--[if IE 6]><link href="./css/accordionIE.css" rel="stylesheet" type="text/css" /><![endif]-->

	  <!-- Déclaration du fichier css à charger pour le module choisie et pas que calendrier !!! -->	
	  <?php 
	  		if (isset($_GET['categorie'])) { 
				if ($_GET['categorie']=="calendrier") {
					if($_GET['page']=="ajout") {
						echo '<link href="./modules/calendrier/calendrier_ajout.css" rel="stylesheet" type="text/css" />';
					}
					else{
						echo '<link href="./modules/calendrier/calendrier_consultation.css" rel="stylesheet" type="text/css" />';
					}
				}
				else if($_GET['categorie']=="galerie_accueil"){
					echo '<link href="./modules/gallery/galerie.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']=="login" || $_GET['categorie']=="deconnexion"){
					echo '<link href="./modules/membres/login.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']=="event"){
					echo '<link href="./modules/event/event.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']=="sondage" || $_GET['categorie']=="ajout_sondage"){
					echo '<link href="./modules/sondage/sondage.css" rel="stylesheet" type="text/css" />';
					echo '<link href="./modules/event/event.css" rel="stylesheet" type="text/css" />';
				}
				else  if($_GET['categorie']=="admin_galerie_album") {
					echo '<link href="./modules/galerie/galerie.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']=="forum" || $_GET['categorie']=="topics" || $_GET['categorie']=="admin_forum" || $_GET['categorie']=="traitements_forum" || $_GET['categorie']=="topic" || $_GET['categorie']== "actions_forum" || $_GET['categorie']== "actions_profil" || $_GET['categorie']=="topic" || $_GET['categorie']=="topic_update" || $_GET['categorie']=="topic_ajout"){
					echo '<link href="./modules/forum/forum.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']=="club" || $_GET['categorie']== "ultimate"){
					echo '<link href="./modules/club/club.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']== "ultimate"){
					echo '<link href="./modules/ultimate/ultimate.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']== "edit_profil" || $_GET['categorie'] == "view_profil"){
					echo '<link href="./modules/membres/profil.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']== "inscription" || $_GET['categorie']== "action_inscription" || $_GET['categorie']== "admin_membres" || $_GET['categorie']== "traitements_membres" || $_GET['categorie']== "mdp_oublie" || $_GET['categorie']== "avatar"){
					echo '<link href="./modules/inscription/inscription.css" rel="stylesheet" type="text/css" />';
				}
				else if($_GET['categorie']=="galerie" || $_GET['categorie']=="galerie_album" || $_GET['categorie']=="admin_galerie" || $_GET['categorie']=="galerie_accept"){
					echo '<link href="./modules/galerie/galerie.css" rel="stylesheet" type="text/css" />';
				}
			}
  	?>
  	</head>
	<?php include("./config/pages.php");	?>

	<body>
	 <!-- Header : Bandeau logo -->
	 <div id="bandeau1" class="bandeau">
		<div style="position:relative; color:white; width:800px; margin:0 auto 0 auto;">
			<a href="http://www.sucstrasbourg.com/"><img style="position:absolute; left:0px; top:0px;" src="./images/suc_logo.png" title="SUC Strasbourg" alt="SUC Strasbourg"/></a>
			<a href="./"><img style="position:absolute; left:78px; top:2px;" src="./images/minilogo.png" alt="SESQUIDISTUS"/></a>
			
			
			<?php if(isset($_SESSION['id'])){
						echo '<a href="./?categorie=login">'.
								'<img style="position:absolute; left:480px; top:11px" src="'.$_SESSION['AVATAR_MIN'].'" alt="" title="Espace Membre de '.$_SESSION['login'].'" />'.
							 '</a>'.
							 '<span style="position:absolute; left:512px; top:10px">'.
								'<a class="white2" href="./?categorie=login">'.
									$_SESSION['login'].
								'</a>'.
							 '</span>'.
							 '<span style="position:absolute; left:512px; top:23px">'.
								'<a class="white" href="?categorie=forum">Forum</a>'.
								' | '.
							   '<a class="white" href="?categorie=deconnexion">Déconnexion</a>'.
							 '</span>';
				  }
				  else{
					echo '<span id="statutLog">'.
							'<a class="white" href="./?categorie=inscription">Créer un compte</a>'.
							' | '.
							'<a class="white" href="./?categorie=login">S\'identifier</a>'.
						  '</span>';
				  }
			?>
			<a href="./?categorie=club"><img style="position:absolute; left:710px; top:17px; " src="./images/drapeau/drapeau-francais.png" alt="fr" title="Français"/></a>
			<a href="./?categorie=visiteur&lang=en"><img style="position:absolute; left:737px; top:17px; " src="./images/drapeau/drapeau-anglais.png" alt="en" title="English"/></a>
			<a href="./?categorie=visiteur&lang=de"><img style="position:absolute; left:764px; top:17px; " src="./images/drapeau/drapeau-allemand.png" alt="de" title="Deutsch"/></a>
		</div>
	  </div>
		
		<!-- Menu style apple -->
		<div id="barreMenu">
			<ul id="menuDrop" class="apple" style="filter:alpha(opacity=0); opacity:0;">
				<?php generationMenu($tpnNb, $tabPageName, $liensCat); ?>
			</ul>
		</div>
		
		<noscript>
			<p style="text-align:center; font-weight:bold; color:red">
				Le JavaScript est désactivé sur votre navigateur. 
				Veuillez l'activer afin de profiter de tous les services proposés par ce site.
			</p>
		</noscript>

		<script type="text/javascript">
			$(document).ready(function() {
				$("#menuDrop").dropmenu();
			});
			
			$(document).ready(function(){
				$("#menuDrop").fadeTo(0,1);
			});	
		</script>
		
		<!-- Gallerie sous menu -->
		<div id="gallery">
			<?php $tabImagesGalerie = array("./images/gallery/img1.jpg","./images/gallery/img2.jpg","./images/gallery/img3.jpg");?>
		</div>
		
	<!-- Div de contenu -->
	<div id="globalBox">			
	  <?php include($linkPage); ?>		
	</div>		
		
	<!-- Footer -->
	<div id="footerPage">
	  <img style="margin-left:100px" src="./images/silhouette.png" alt="Frisbee"/>
	  <?php 
			$debutYear = "2010"; 
			$nowYear = (int)date("Y");
			if($nowYear == $debutYear){
				$nowYear++;
			}
	   ?>
	  <div id="bandeau2" class="bandeau">
			<img src="./images/minilogo2B.png" style="position:absolute; right:25px; top:-28px;" />
			<span style="font-weight:bold; font-size:10px;">Copyright © <?php echo $debutYear.'-'.$nowYear; ?> SESQUIDISTUS </span><br />
			<a class="white" href="?categorie=contact&page=apropos">A propos du site</a> | <a class="white" href="?categorie=contact&page=mentions">Mentions légales</a>
	  </div>
	</div>	
 </body>

	<script type="text/javascript">
	  var elementTableauImgGal = "<?php echo join(",", $tabImagesGalerie); ?>";
	  var tabImgGalerie = elementTableauImgGal.split(',');  
	 <?php if($_GET['categorie']==$tabPageName[0]){
	 
			echo 'gallery(document.getElementById("gallery"), tabImgGalerie, 0);';
	  
         }
		else{
			echo 'gallery(document.getElementById("gallery"), tabImgGalerie, 1);';
		} ?>
	
	</script>
	
	<script type="text/javascript" src="./js/jquery/hoverIE.js"></script>
 
 </html>
