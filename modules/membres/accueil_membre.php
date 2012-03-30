<?php 
/*
 * Ce fichier regroupe les différentes actions 
 * possibles dans le panel membre, il peut être considéré
 * comme la vue du panel dans un modèle 
 * de type MVC.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
	 if(!isset($_SESSION['login']))
	 {
	   //-Cas où le visiteur n'a pas de droits, on le redirige---
	   echo '<script type="text/javascript" src="">window.location.href="./?categorie=accueil";</script>';
	   //---
	 }
	else
	{
	 	//-----------------
	 	include("./config/mysql.php");
		mysql_connect($host, $user, $passwd); 
		mysql_select_db($bdd); 
		include("./modules/sondage/maj_sondage.php");
		$classBulle = "bouton3";
		if(count($tabSondage)==0){
			$classBulle = "bouton2";
		}
	 	//-----------------					
		echo '<div class="totalBox">'.
				  '<div class="box">'.
				    '<div class="titreNews">Espace membre : Bienvenue '.$_SESSION['login'].' !</div>'.
				      '<ul class="login">'.
				        '<li title="Accédez à votre profil">'.
				        	'<div class="rotate"><a class="black" href="./?categorie=edit_profil"><img alt="Profil" src="./images/membres/profil.png"/><br/>Profil</a></div>'.
				        '</li>'.
				        '<li title="Accédez au trombinoscope">'.
				        	'<div class="rotate"><a class="black" href="./?categorie=trombi"><img alt="Trombi" src="./images/membres/membre.png"/><br/>Trombi</a></div>'.
				        '</li>'.
				        '<li title="Accédez au forum">'.
				        	'<div class="rotate"><a class="black" href="./?categorie=forum"><img alt="Forum" src="./images/membres/forum.png"/><br/>Forum</a></div>'.
				        '</li>'.
				        '<li title="Accédez à la galerie">'.
				        	'<div class="rotate"><a class="black" href="./?categorie=member_galerie"><img alt="Galerie" src="./images/membres/galerie.png"/><br/>Galerie</a></div>'.
				        '</li>'.
				        '<li title="Accédez à la page de sondage">'.
					   	  '<div class="rotate">'.
				           '<a class="black" href="./?categorie=sondage'.$tabSondage[0].'">'.
				             '<img alt="Sondage" src="./images/membres/sondage.png"/>'.
				            '<span style="position:absolute; margin-left:-20px" class="'.$classBulle.'">'.count($tabSondage).'</span><br/>Sondage'.
				           '</a>'.
				          '</div>'.
				        '</li>'.
				      '</ul>'.
				      '<p>[<a class="black" href="?categorie=deconnexion">Deconnexion</a>]</p>'.
				    '</div>'.
				  '</div>';
  
	  	//-Si le membre est un administrateur, on lui rajoute le panel adéquat---
	  	if($_SESSION['lvl'] == 1)
	  		include("./modules/membres/administration.php"); 
		//---
	
		echo '</div>'.
				'<script type="text/javascript" src="./modules/membres/login.js"></script>';
	}
?>