<?php
/*
 * Ce fichier regroupe les différentes fonctions utiles
 * concernant le module d'inscription.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
 /* Retourne le hash stocké comme dans la BDD, ou NULL si erreur---
  * Exemple : 
  * 				password -> abc 
  * 				saltArray -> aa et bb
  * Résultat : 
  *					MD5(aa . MD5(abc)  .  bb)
  */
 function makeHash($passwd, $saltArray)
 {
  $res = NULL;
  if(count($saltArray) == 2)
  {
    $hash = md5($passwd);
    $res = md5($saltArray[0].$hash.$saltArray[1]);
  }
  return $res;
 }

/*
 * Fonction de résultat de traitement.
 */
function info($res, $succes){
 $class = "succes";
 if($succes == 0){$class = "error";}
 echo '<div class="totalBox">'.
	'<div class="arbo">'.
	  '<a href="./?categorie=accueil"><span class="bouton1">Accueil</span></a>'.
	'</div>'.
	 '<div class="box"><div class="titreNews">Inscription :</div>'.
	  '<p class="'.$class.'">'.$res.'</p>'.
         '</div>'.
      '</div>';
 echo '<script type="text/javascript" src="./modules/inscription/traitements.js"></script>';
 echo '<script type="text/javascript">info();</script>';
}
 //-On génère toute les questions pour le mot de passe---
 $qst = array("Quel est le nom de votre animal de compagnie ?",
 					"Quel est le nom de votre professeur préféré ?",
 					"Quel est votre lieu de naissance ?",
 					"Quel est votre film préféré ?");
 //---
?>
