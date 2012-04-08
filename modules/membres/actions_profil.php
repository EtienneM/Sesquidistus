<?php
/*
 * Ce fichier regroupe les différentes actions 
 * possibles pour le profil d'un membre, il peut être considéré
 * comme un controleur du forum dans un modèle 
 * de type MVC.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

  //On include les paramètres de la db.
  include("./config/mysql.php");
  include("./modules/membres/fonctions.php");
  $id_membre = isset($_POST['id_mem']) ? $_POST['id_mem'] : $_SESSION['id'];

  //-Si Maj du profil---
  if($_POST['mode'] == 'maj_profil')
  {
    extract($_POST);
    if(mysql_connect($host, $user, $passwd) && mysql_select_db($db)){
      $query="UPDATE profil SET NOM='".mysql_real_escape_string(utf8_decode($nom))."',".
                                "PRENOM='".mysql_real_escape_string(utf8_decode($prenom))."',".
                                "MAIL='".mysql_real_escape_string(utf8_decode($mail))."',".
                                "MAIN='".mysql_real_escape_string(utf8_decode($main))."',".
                                "POSTE='".mysql_real_escape_string(utf8_decode($poste))."',".
                                "COUP='".mysql_real_escape_string(utf8_decode($coup))."',".
                                "ADHESION='".mysql_real_escape_string(utf8_decode($membre_depuis.'-01-01'))."',".
                                "SOUVENIR='".mysql_real_escape_string(utf8_decode($souvenir))."',".
                                "POURQUOI='".mysql_real_escape_string(utf8_decode($pq_ultimate)).
      "' WHERE ID_MEMBRE=".mysql_real_escape_string($id_membre);
 
      $queryCat = mysql_query($query);
      if($queryCat)
      {
		//-Si pas de problème.---
	
		//-En cas de modification des droits on vérifie si la personne est admin pour executer la requete---
        if($_SESSION['lvl'] == 1 && $rang_dpt != $rang)
		{
	  		$query="UPDATE membre SET ADMIN=".mysql_real_escape_string($rang).
		 				" WHERE ID=".mysql_real_escape_string($id_membre);
		  	$queryCat = mysql_query($query);
	  		if($queryCat)
          	{
	    		//-Si pas de problème---
			    info("Profil mis à jour avec succès!", 1);	
	  		}
	  		else
	  		{
	    		info("Un problème de traitement est survenu!", 0);	
	  		}
		} 
		else
		{
	  		info("Profil mis à jour avec succès!", 1);	
  		}
     }	
     else
     {
       info("Un problème de traitement est survenu!", 0);
     }
     mysql_close();
   }
   else
   {
    info("Un problème de connexion est survenu!", 0);
   }	
 }
 //-Si maj du mot de passe---
 else if($_POST['mode'] == 'maj_mdp')
 {
   extract($_POST);
   //-Si les deux mots de passe sont indentiques---
   if(makeHash($new_pwd, $psswdHash) == makeHash($new_pwd_confirm, $psswdHash))
   {
     //-On se connecte à la BDD---
     if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
     {
       $query = "SELECT PASSWD FROM membre WHERE ID=".mysql_real_escape_string($id_membre);
       $queryCat = mysql_query($query);

       //-On récupère le password existant---
       if($queryCat)
       {
         $r = mysql_fetch_array($queryCat);
	 	 //-Cas où tout est identique---
         if(makeHash($old_pwd, $psswdHash) == $r['PASSWD'])
	 	{
	   		$queryUpdate = "UPDATE membre SET PASSWD='".mysql_real_escape_string(makeHash($new_pwd, $psswdHash)).
									"' WHERE ID=".mysql_real_escape_string($id_membre);
		    $queryUp = mysql_query($queryUpdate);
           //-That's All folks !---
	   	   if($queryUp)
	   	   {
	    		info("Mot de passe mis à jour avec succès!", 1);
	   		}
		   else
		   {
			  info("Un problème de traitement est survenu!", 0);
		   }
        }
        else
		{
		  info("Mot de passe actuel incorrect!", 0);
		}
        mysql_free_result($queryCat);
      }
      else
      {
		info("Un problème de traitement est survenu!", 0);
      }
      mysql_close();
    }
    else
    {
      info("Un problème de connexion est survenu!", 0);
    }
  }
  //-Si les deux mots de passe sont différents---
  else
  {
    info("Le nouveau mot de passes et la confirmation sont différents!", 0);	
  }
}
?>
