<?php
/*
 * Ce fichier regroupe les différentes fonctions utiles au modules
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
 //Réalise les tests sur les modules magic_quotes de php.
/* function stripMagic(&$value){
 if(function_exists("magic_quotes_gpc") && get_magic_quotes_gpc() ){
  $value = is_array($value) ? 
          array_map('stripMagic', $value) : 
          stripslashes($value); 
 }
    return $value; 
 }
*/

 //Retourne le hash stocké comme dans la BDD, ou NULL si erreur.
 function makeHash($passwd, $saltArray){
   $res = NULL;
   if(count($saltArray) == 2)
   {
     $hash = md5($passwd);
     $res = md5($saltArray[0].$hash.$saltArray[1]);
   }
   return $res;
 }
 
 //Affiche la box selon l'état de la déconnexion.
 function deconnexionForm($com, $stat){
   echo '<div class="totalBox">
          <div class="box">
           <div class="titreNews">Deconnexion :</div>  
           <p class="'.$stat.'">'.$com.'</p>
          </div>
         </div>';
   echo '<script type="text/javascript" src="./modules/membres/logout.js"></script>';
 }

 /*
   * Fonction de résultat de traitement.
  */
 function info($res, $succes){
  $class ="succes";
  if(!$succes){$class = "error";}
  echo '<div class="totalBox">'.
         '<div class="arbo">'.
          '<a href="./?categorie=login"><span class="bouton1">Espace membre</span></a>'.
         '</div>'.
         '<div class="box"><div class="titreNews">Membre :</div>'.
          '<p class="'.$class.'">'.$res.'</p>'.
         '</div>'.
       '</div>'.
       '<script type="text/javascript" src="./modules/membres/traitements.js"></script>'.
       '<script type="text/javascript">info();</script>';
 }


 function loginForm(){ 
  echo '<div class="totalBox">
     <div class="box">
      <div class="titreNews">Connexion :</div>
       <form method="POST" action="./?categorie=login">
        <p>Remplissez les champs ci-dessous afin de vous connecter:</p>
        <div class="log">
         <span class="lbl_log"><label for="login">Identifiant :</label></span>
         <span class="in_log"><input type="text" id="login" name="m_login" class="txtBox1"/></span>
        </div>
        <div class="log"> 
         <span class="lbl_log"><label for="passwd">Mot de passe :</label></span>
         <span class="in_log"><input type="password" id="passwd" name="m_passwd" class="txtBox1"/></span>
        </div>
        <div class="sub_log">
         <input type="hidden" value="login" name="action"/>
         <input type="submit" value="Se connecter" class="bouton1"/>
	  <input type="reset" value="Remettre à zéro" class="bouton1"/>
        </div>
       </form> 
       <div class="log"><p>[ <a href="./?categorie=mdp_oublie">Mot de passe oublié</a> ]</p></div>
      </div>
     </div>
    </div>';
 }
 
 function errForm($err){
 echo '<div class="totalBox">
    <div class="box">
     <div class="titreNews">Connexion : <span class="error">Erreur</span></div>
       <p class="error">'.$err.'</p>
       <p>[<a href="?categorie=login">Réessayer</a>]</p>
    </div>
   </div>';
 }

function profil_form($titre, $msg, $class){
	$class = $class == 0 ? "error" : "succes";
	echo '<div class="totalBox">'.
			  '<div class="box">'.
			  	'<div class="titreNews">'.$titre.'</div>'.
				  	'<p class="'.$class.'">'.$msg.'</p>'.
		  	   '</div>'.
			'</div>';
	echo '<script type="text/javascript" src="./modules/membres/view_profil.js"></script>';	
}

 /*
  * Variables utiles
  */

 //On génère tous les postes.
 $postes = array("Entraineur", "Capitaine", "Remplaçant", "Lanceur", "Rattrapeur");
 //On génère tous les postes.
 $coups = array("Lancé éclair", "La galette fusil", "La fusée magique");

?>
