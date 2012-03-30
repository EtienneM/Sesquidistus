<?php 
/*
 * Ce fichier regroupe les différentes actions 
 * réaliser lors de la deconnexion d'un membre
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

 /*
  * On récupère le tableau $_SESSION, on stoque le login de l'utilisateur et
  * on vide le tableau et on regarde si le login n'est pas vide (cas ou l'on 
  * tombe sur la page déconnexion par hasard).
  */
 session_start();

 $login  = $_SESSION['id'];

 session_destroy();
 session_unset();

 $_SESSION = array();
 
 include_once("./modules/membres/fonctions.php");

 if(empty($login))
 {
   //-Si l'utilisateur tombe sur la page déconnexion par hazard---
   include("./modules/membres/login.php");
   //---
 }
 else if(count($_SESSION) == 0 && !empty($login))
 {
   //-Si l'utilisateur s'est bien déco---
   deconnexionForm("Déconnexion réussie!", "success");
   //---
 }
 else
 {
   //-S'il y a eu une erreur---
   deconnexionForm("Déconnexion échouée!", "error");
   //---
 }

?>