<?php
/*
 * Ce fichier regroupe les différentes actions 
 * possibles dans le panel administrateur, il peut être considéré
 * comme la vue du panel dans un modèle 
 * de type MVC.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
 if($_SESSION['lvl'] == 1)
 {
 	//-Dans le cas où l'utilisateur est administrateur---
 
	 //RÃ©cupÃ©ration du nombre d'inscription Ã  valider.
	 if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	 {
	   $reqCat = "SELECT count(ID) AS NB FROM membre WHERE ADMIN=-1";
	   $queryCat = mysql_query($reqCat);
	   if($queryCat)
	   {
	     //On rÃ©cupÃ¨re l'objet rÃ©sultat.
	     $r = mysql_fetch_array($queryCat);
	     $classBulle = "bouton2";
	     $nb = 0;
	     if($r['NB'] != 0)
	     {
	       $classBulle = "bouton3";
	       $nb = $r['NB'];
	     }
	     mysql_free_result($queryCat);
	   }  
	   mysql_close();
	 }
	//---
	
	 //-RÃ©cupÃ©ration du nombre de fiches d'inscription à lire---
	 if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	 {
	   $reqCat = "SELECT count(id_reponse) AS NB FROM reponse_inscription_tournoi WHERE lu=0";
	   $queryCat = mysql_query($reqCat);
	   if($queryCat)
	   {
	     //On rÃ©cupÃ¨re l'objet rÃ©sultat.
	     $r = mysql_fetch_array($queryCat);
	     $classBulle2 = "bouton2";
	     $nb2 = 0;
	     if($r['NB'] != 0)
	     {
	       $classBulle2 = "bouton3";
	       $nb2 = $r['NB'];
	     }
	     mysql_free_result($queryCat);
	   }  
	   mysql_close();
	 }
 
	 if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	 {
	   $reqCat = "SELECT count(id_image) AS NB FROM images WHERE id_album=1";
	   $queryCat = mysql_query($reqCat);
	   if($queryCat)
	   {
	     //On rÃ©cupÃ¨re l'objet rÃ©sultat.
	     $r = mysql_fetch_array($queryCat);
	     $nbImages = 0;
	     if($r['NB'] != 0)
	     {
	       $nbImages = $r['NB'];
	     }
	     mysql_free_result($queryCat);
	   }
   
	   $reqCat = "SELECT count(id_video) AS NB FROM videos WHERE id_dossier=1";
	   $queryCat = mysql_query($reqCat);
	   if($queryCat)
	   {
	     //On rÃ©cupÃ¨re l'objet rÃ©sultat.
	     $r = mysql_fetch_array($queryCat);
	     $nbVideos = 0;
	     if($r['NB'] != 0)
	     {
	       $nbVideos = $r['NB'];
	     }
	     mysql_free_result($queryCat);
	   }
	   
	   $nb3 = $nbVideos + $nbImages;
	   if ($nb3 != 0) {
		 $classBulle3 = "bouton3";
	   }
	   else {
	     $classBulle3 = "bouton2";
	   }
	   mysql_close();
	 }


 echo '<div class="totalBox">'.
			  '<div class="box" style="height:180px">'.
			   '<div class="titreNews">Espace administration</div>'.
			    '<ul class="login">'.
			     '<li>'.
				     '<div class="rotate">'.
				      '<a class="black" href="./?categorie=admin_membres">'.
				       '<img alt="" src="./images/membres/membre.png"/>'.
					   '<span style="position:absolute; margin-left:-20px" class="'.$classBulle.'">'.$nb.'</span><br/>Membres'.
				      '</a>'.
				     '</div>'.
			     '</li>'.
			     '<li><div class="rotate"><a class="black" href="./?categorie=admin_forum"><img alt="" src="./images/membres/forum.png"/><br/>Forum</a></div></li>'.
			     '<li><div class="rotate"><a class="black" href="./?categorie=admin_galerie"><img alt="" src="./images/membres/pictures.png"/><br/>Photo</a></div></li>'.
			     '<li><div class="rotate"><a class="black" href="./?categorie=admin_galerie_video"><img alt="" src="./images/membres/galerie.png"/><br/>Vidéo</a></div></li>'.
			     '<li>'.
				     '<div class="rotate">'.
					  '<a class="black" href="./?categorie=galerie_accept">'.
					   '<img alt="" src="./images/membres/acceptation.png"/>'.
					   '<span style="position:absolute; margin-left:-20px" class="'.$classBulle3.'">'.$nb3.'</span><br/>Acceptation'.
					  '</a>'.
				 	'</div>'.
				 '</li>'.
			     '<li>'.
			     	'<div class="rotate">'.
			     		'<a class="black" href="./?categorie=calendrier&page=ajout"><img alt="" src="./images/membres/calendrier.png" title="ajouter un évènement"/>'.
			     		'<br/>Calendrier</a>'.
			     	'</div>'.
			     '</li>'.
			     '<li>'.
			     	'<div class="rotate">'.
			     		'<a class="black" href="./?categorie=ajout_sondage"><img alt="" src="./images/membres/sondage.png" title="ajouter un sondage" /><br/>Sondage</a>'.
			     	'</div>'.
			     '</li>'.
			     '<li>'.
			     	'<div class="rotate">'.
				      '<a class="black" href="./?categorie=visualisation_inscription">'.
				       	'<img alt="" src="./images/membres/document.png" title="Visualiser les fiches d\'inscription aux tournois du club" />'.
						'<span style="position:absolute; margin-left:-20px" class="'.$classBulle2.'">'.$nb2.'</span><br/>Inscription tournoi'.
				      '</a>'.
			     	'</div>'.
			     '</li>'.
			    '<ul>'.
			   '</div>'.
			  '</div>';
 }
 else
 {
 	//-Si le membre n'as pas les droits on le redirige---
 	echo '<script type="text/javascript" src="">window.location.href="./?categorie=accueil";</script>';
 	//---	
 }
?>

