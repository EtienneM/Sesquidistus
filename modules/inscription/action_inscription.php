<?php

/*
 * Ce fichier regroupe les différentes actions 
 * pour l'inscription d'un membre. Il peut être considéré
 * comme le controleur du module inscription dans un modèle MVC.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
session_start();

//Inclusion du fichier contenant les paramètres du SGBD.
include("./config/mysql.php");
include("./modules/inscription/fonctions.php");

if($_POST['mode'] == "inscription"){//S'il c'est bien le formulaire qui à été submit.
 extract($_POST);
  
  /*
   * Vérifications de saise.
   */
 
 //Vérification du remplissage de l'intégralité des champs.
 if(empty($login) || empty($pwd) || empty($confirm_pwd) || empty($nom) || empty($prenom) ||  empty($mail) || empty($confirm_mail) || empty($qst_reponse) || empty($code_confirm)){//Si un champ n'est pas complété
 	info("Veuillez compléter tous les champs!", 0);
 } 
  else if($code_confirm != $_SESSION['captcha'])
 {//si les deux mails sont différents.
 	info("Le code de sécurité est incorrect!", 0);
 }
 //Vérifications annexes.
 else if(strlen($login) < 3)
 {//si les deux mdp sont différents.
 	info("Veuillez saisir un pseudonyme d'au moins 3 caractères!", 0);
 }	
 else if(strlen($pwd) < 5)
 {//si les deux mdp sont différents.
 	info("Veuillez saisir un mot de passe d'au moins 5 caractères!", 0);
 }
 else if($pwd != $confirm_pwd)
 {//si les deux mdp sont différents.
 	info("Les deux mots de passe saisis sont différents!", 0);
 }	
 else if($mail != $confirm_mail)
 {//si les deux mails sont différents.
 	info("Les deux adresses email saises sont différents!", 0);
 }
 else if(strlen($qst_reponse) < 1)
 {//si le champ contient au moins 1 caractère.
 	info("Veuillez répondre à la question secrète", 0);
 }
 else if(!preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $mail))
 {//si le mail n'est pas conforme.
 	info("Veuillez saisir une adresse email valide!", 0);
 }
 else{//Tous les tests sont bon, donc on procède à l'ajout de l'utilisateur dans la base.
 
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
	{//Si la connexion se passe bien 
		$reqCat = "SELECT m.LOGIN, p.MAIL FROM membre m, profil p WHERE m.ID = p.ID_MEMBRE AND (m.LOGIN='".mysql_real_escape_string($login)."' OR p.MAIL='".mysql_real_escape_string($mail)."')";
		$queryCat = mysql_query($reqCat);
		if($queryCat)
		{//Si la requête a réussie.
			$continuer = 1;
			$res = mysql_fetch_object($queryCat);
			if(isset($res->LOGIN) && ($res->LOGIN == $login))
			{//Si le login existe.
				info("Un compte porte déjà ce pseudo, veuillez en choisir un autre!\n", 0);
				$continuer = 0;
			}
			elseif(isset($res->MAIL) && strlen($res->MAIL) > 0)
			{//Si le mail existe.
				info("Un compte à déjà été créé avec cette adresse email!", 0);
				$continuer = 0;
			}
			else if($continuer)
			{//Sinon on peut creer le compte.
				$reqCat = "INSERT INTO membre (LOGIN, PASSWD, ADMIN) VALUES ('".mysql_real_escape_string($login)."', '".mysql_real_escape_string(makeHash($pwd, $psswdHash))."', -1)";
				$queryCat = mysql_query($reqCat);
				if($queryCat)
				{//Si l'entrée à bien été insérée, on mets à jour la table profil.
					$reqCat = "SELECT ID FROM membre WHERE LOGIN='".mysql_real_escape_string($login)."'";				
					$queryCat = mysql_query($reqCat);
					if($queryCat)
					{//On récupère l'id du membre pour mettre à jour la table profil.
						$id = mysql_fetch_array($queryCat);
						$reqCat = "INSERT INTO profil (ID_MEMBRE, NOM, PRENOM, MAIL, MAIN, POSTE, COUP, ADHESION, AVATAR, AVATAR_MIN, QUESTION, REPONSE) ".
								  "VALUES ('".$id['ID']."',".
								      "'".mysql_real_escape_string($nom)."',".
									  "'".mysql_real_escape_string($prenom)."',".
   									  "'".mysql_real_escape_string($mail)."',".
   									  "'Droitier',".
   									  "'Lanceur',".
   									  "'".utf8_decode("Lancé éclair")."',".
									  "'".date("Y-m-d")."',".   									  
   									  "'./modules/membres/avatar/no_avatar.png',".
   									  "'./modules/membres/mini_avatar/mini_no_avatar.jpg',".
   									  "'".mysql_real_escape_string($qst_secrete)."',".
									  "'".mysql_real_escape_string($qst_reponse)."')";
									
						$queryCat = mysql_query($reqCat);
						if($queryCat) info("Inscription réussie avec succès!, néanmoins elle doit-être validée par un administrateur.", 1);
						else info("Une erreur de traitement est survenue!", 0);
					}
					else info("Une erreur de traitement est survenue!", 0);
				}
				else info("Une erreur de traitement est survenue!", 0);
			}
		}
		else info("Une erreur de traitement est survenue", 0);
	}
	else
	{//Si la connexion a échouée.
		info("La connexion à la base de donnée a échouée!", 0);
	}				
  }
}
else
{
 //-Si l'utilisateur tombe directmeent sur la page, on le redirige---
 echo '<script type="text/javascript" src="">window.location.href="./?categorie=accueil";</script>';	
 //---
}

?>
