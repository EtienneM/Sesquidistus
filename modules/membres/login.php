<?php
/*
 * Ce fichier regroupe les différentes actions 
 * pour la connexion du membre.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
 //On charge les infos concernant la BDD.
 include("./config/mysql.php");
 include("./config/mysql.class.php");
 
 //On charche les fonctions utiles à la connexion.
 include_once("./modules/membres/fonctions.php");

 if(!isset($_SESSION['lvl']))
 {
  //Si l'on arrive sur la page directement.
  if(!isset($_POST['action']))
  {
    loginForm();
  }
  else if($_POST['action'] == "login")
  {
   if(isset($_POST['m_login']) && !empty($_POST['m_login']) && isset($_POST['m_passwd']) && !empty($_POST['m_passwd']))
   {
    //On vérifie dans la BDD.
    $sql = new MySQL($host, $user, $passwd, $bdd); 
    if($sql->connection())
    {
     //Traitement si la connexion à réussie.
      //On regarde s'il y a un membre qui existe avec le couple login/mdp precédent.
     
     //stripMagic($_POST); //on traite le cas des magicQuotes 
     
     //On banalise par le SGBD.
     $m_login = mysql_real_escape_string($_POST['m_login']);
     $m_passwd = makeHash($_POST['m_passwd'], $psswdHash);

     //Requête émise au SGBD.
     $query = "SELECT m.*, p.AVATAR_MIN FROM membre m, profil p WHERE m.ID = p.ID_MEMBRE AND LOGIN='".$m_login."' AND PASSWD='".$m_passwd."'";
     
     if($sql->execute($query))
     {
      //Si la requête c'est bien passée. 
      //Si le membre à été trouvé on renseigne la session.
      if($sql->getNumRows() == 1)
      {
       //On récupère la ligne sous forme d'un objet.
       $r = $sql->getObjectResult(); 
       //Si le statut du compte est non vérifié
       if($r->ADMIN == -1)
       {
        errForm("Compte en attente de validation par un administrateur!");
       }
       else
       {
         //On démarre et on renseigne le tableau session.
         $_SESSION['id'] = $r->ID;
         $_SESSION['login'] = $r->LOGIN;
         $_SESSION['lvl'] = $r->ADMIN;
         $_SESSION['AVATAR_MIN'] = $r->AVATAR_MIN;
       }
       $sql->free(); //On libère les résultats.
       //On se redirige vers l'espace membre en js.
       echo '<script type="text/javascript">document.location.href="./?categorie=login";</script>';
      }
      else
      {
       //Le membre n'a pas été trouvé il y a une erreur de login/mdp.
       errForm("Compte non reconnu!");
      }
     }   
     else
     {
      //Erreur avec la base de données. 
      errForm("Une erreur avec la base de données est survenue!");
     }
     //On ferme la connexion
      $sql->close(); 
    }
    else
    {
     //Erreur avec la base de données. 
     errForm("Une erreur avec la base de données est survenue!");
    }
   }
    else
    {
    //Il y a un problème un des deux champs.
    errForm("Le ou les champ(s) a/ont été(s) mal renseigné(s)!");
    }
  }//fin de $_POST['action'] == login.
 }//fin de !isset($_SESSION['lvl'])
 else if(isset($_SESSION['lvl']))
 {
  //Dans le cas ou le membre est connecté.
  include("./modules/membres/accueil_membre.php"); 
 }
?>
