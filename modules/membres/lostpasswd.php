<?php
/*
 * Ce fichier regroupe les différentes actions 
 * possibles pour la récupération du mot de passe d'un membre
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
//Inclusion du fichier contenant les paramètres du SGBD.
include("./config/mysql.php");
include("./modules/inscription/fonctions.php");

function lostpasswdForm()
{
	echo '<div class="totalBox">
			  <div class="box">
			    <div class="titreNews">Mot de passe oublié :</div>
			      <fieldset>
			        <legend>Veuillez saisir votre identifiant et adresse email dans les champs ci-dessous :</legend>
				      <form method="POST" action="./?categorie=mdp_oublie">
				      	<table>
				      	  <tr><td><label for="login">Identifiant : </label></td><td><input type="text" id="login" name="login" /></td></tr>
				      	  <tr><td><label for="mail">Email : </label></td><td><input type="text" id="mail" name="mail" /></td></tr>
				      	 </table>
				      	<div>
					      	<input type="hidden" name="action" value="recherche" />
					      	<input type="submit" value="Envoyer" class="bouton1" />
			    	      	<input type="reset" value="Remettre à zéro" class="bouton1" />
		    	      	</div>
				      </form>
     				<div style="position:absolute;bottom:10px;right:15px">
     					<a href="./doc/doc_membres/doc_membre.html#mdp_perdu" target="_blank">
     						<img src="./images/help.png" alt="aide"/>
     					</a>
     				</div>
  			       </fieldset>
			    </div>
			  </div>';
}
//S'il n'y a pas d'action précédente
if(!isset($_POST['action']) && !isset($_GET['action']))
{
	echo lostpasswdForm();
}
//Si l'utilisateur à envoyer le formulaire.
else if($_POST['action'] == "recherche")
{
	extract($_POST);
	
	//Vérification de saisie.
	if(empty($login) || empty($mail))
	{
		info("Veuillez remplir tous les champs", 0);	
	}
	else
	{
		if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
		{//Si la connexion se passe bien 
			$reqCat = "SELECT m.ID, p.NOM, p.PRENOM, p.MAIL FROM membre m, profil p WHERE m.ID = p.ID_MEMBRE AND m.LOGIN='".mysql_real_escape_string($login)."' AND p.MAIL='".mysql_real_escape_string($mail)."'";
			$queryCat = mysql_query($reqCat);
			if($queryCat)
			{//Si la requête a réussie.
				$res = mysql_fetch_object($queryCat);
				//Si l'on a trouvé une personne on lui envoie un mail.
				if(isset($res->NOM))
				{//Si le login existe.
					
					$headers = 'From: "Sesquidistus" <no-reply@sesdistus.com>'."\r\n";
					$headers .= 'Return-Path: <no-reply@sesdistus.com>'."\n"; 
					$headers .= 'Mime-Version: 1.0'."\r\n";
					$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
					$headers .= "\r\n";
					
					$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&action=repondre&id=".$res->ID;
					$msg = '<html>'.
									'<body>'.
										'<h2>[SESQUIDISTUS] Récupération de votre mot de passe</h2>'.
										'<i>Si vous n\'avez pas fait de demande de récupération veuillez surtout ne pas tenir compte de cet email!</i>'.
										'<br/>'.
										'<h2>Bonjour '.$res->PRENOM.' '.$res->NOM.',</h2>'.
										'<p>'.
											'Nous avons bien pris en compte votre demande et vous prions de vous rendre sur la page suivante afin de compléter votre demande:<br/><br/>'.
											$url.
										'</p>'.
									'</body>'.
								'</html>';
					
					 $envoi = mail($res->MAIL, "[SESQUIDISTUS] Récupération de votre mot de passe", $msg, $headers);
					 if($envoi == 1)
					 {
					 	info("Un email vous a été envoyé!", 1);				
					 }
					 else
					 {
					 	info("Une erreur de traitement est survenue, veuillez recommencer!", 0);		
					 }
				}
				else
				{
					info("Aucun membre n'a été trouvé avec ces informations", 0);				
				}
			}
			else
			{
				info("Une erreur de traitement est survenue!", 0);
			}
		}
	}
}
else if($_GET['action'] == "repondre" && !empty($_GET['id']))
{
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
	{//Si la connexion se passe bien 
			$reqCat = "SELECT p.QUESTION FROM profil p WHERE p.ID_MEMBRE=".mysql_real_escape_string($_GET['id']);
			$queryCat = mysql_query($reqCat);
			if($queryCat)
			{//Si la requête a réussie.
				$res = mysql_fetch_object($queryCat);
				//Si l'on a trouvé une personne on lui envoie un mail.
				if(isset($res->QUESTION))
				{//Si le membre existe.
					echo '<div class="totalBox">
							  <div class="box">
							    <div class="titreNews">Récupération du mot de passe :</div>
							      <fieldset>
							      	<legend>Veuillez répondre à la question suivante:</legend>
								      <form method="POST" action="./?categorie=mdp_oublie">
								      	<table>
									      	<tr><td>Question : </td><td>'.$res->QUESTION.'</td></tr>
									      	<tr><td><label for="reponse">Réponse : </label></td><td><input type="text" id="reponse" name="reponse" /></td></tr>
						    	      	</table><br/>
							    	      <div>
							    	        <input type="hidden" name="id" value="'.$_GET['id'].'" />
										   	<input type="hidden" name="action" value="modifier" />
										   	<input type="submit" value="Envoyer" class="bouton1" />
									       	<input type="reset" value="Remettre à zéro" class="bouton1" />
								    	  </div>
						    	    </fieldset>
							      </form>
							    </div>
							  </div>';
					mysql_free_result($queryCat);
				}		
				else
				{
					info("Membre inconnu!", 0);
				}
			}
			else
			{
				info("Une erreur de traitement est survenue!", 0);
			}		
	}
	else
	{
		info("Un problème de connexion à la base de données est survenu!", 0);
	}
}
else if($_POST['action'] == "modifier")
{
	extract($_POST);
	if(empty($reponse))
	{
		info("Veuillez répondre à la question!", 0);
	}
	else if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
	{//Si la connexion se passe bien 
			echo "bien connecté";
			$reqCat = "SELECT p.REPONSE, m.LOGIN, p.NOM, p.PRENOM, p.MAIL FROM membre m, profil p WHERE m.ID = p.ID_MEMBRE  AND m.ID=".mysql_real_escape_string($id);
			$queryCat = mysql_query($reqCat);
			if($queryCat)
			{//Si la requête a réussie.
				echo "réponse exacte";
				$res = mysql_fetch_object($queryCat);
				//Si la réponse est correcte on envoie un mail.
				if($res->REPONSE == $reponse)
				{
					$nom = $res->NOM;
					$prenom = $res->PRENOM;
					$mail = $res->MAIL;
					echo "réponse exacte";

						$new_pass = rand(0, 100).$res->LOGIN.rand(0, 200);
						echo $new_pass."\n";			
						echo makeHash($new_pass, $psswdHash);
												
						$reqCat = "UPDATE membre SET PASSWD='".makeHash($new_pass, $psswdHash)."'  WHERE ID=".mysql_real_escape_string($id);
						$queryCat = mysql_query($reqCat);
						if($queryCat)
						{//Si ça a réussi on envoie un mail avec le mot de passe.			
									
							$headers = 'From: "Sesquidistus" <no-reply@sesdistus.com>'."\r\n";
							$headers .= 'Return-Path: <no-reply@sesdistus.com>'."\n"; 
							$headers .= 'Mime-Version: 1.0'."\r\n";
							$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
							$headers .= "\r\n";
							
							$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&action=repondre&id=".$res->ID;
							$msg = '<html>'.
											'<body>'.
												'<h2>[SESQUIDISTUS] Changement de votre mot de passe</h2>'.
												'<h2>Bonjour '.$prenom.' '.$nom.',</h2>'.
												'<p>'.
													'Votre mot de passe à été réinitialisé suite à votre demande, veuillez vous connecter et le changer dans votre rubrique profil :<br/><br/>'.
													'Nouveau mot de passe : '.$new_pass.
												'</p>'.
											'</body>'.
										'</html>';
							
							 $envoi = mail($mail, "[SESQUIDISTUS] Changement de votre mot de passe", $msg, $headers);
							 if($envoi == 1)
							 {
							 	info("Votre mot de passe a été réinitialisé, un email vous a été envoyé!", 1);				
							 }
							 else
							 {
							 	info("Une erreur de traitement est survenue, veuillez recommencer!", 0);		
							 }		
						}
						else
						{
						 	info("Une erreur de traitement est survenue, veuillez recommencer!", 0);		
						}
					}
					else
					{
					 	info("La réponse saisie est inexacte, veuillez recommencer!", 0);		
					}
				}
				else
				{
				 	info("Une erreur de traitement est survenue, veuillez recommencer!", 0);		
				}		
			}
		//On ferme la connection.
		mysql_close();	
	}
?>
