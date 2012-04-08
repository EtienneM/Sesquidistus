<?php
/* Fichier de fonction nécessaires au fonctionnement
 * nomminal du forum
 * (Utilisé dans tout le forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */


//-Fonctions de mise en page---------------------
 
/**
 * headerBox
 *
 * Fonction d'affiche le haut de div de traitement.
 *
 * @param : titre de la div de traitement. 
 * @param : texte (action demandé à l'utlisateur) à afficher. 
 */ 
function headerBox($titre, $action){
   echo '<div class="totalBox">'.
	  '<div class="arbo">'.
	     '<a href="./?categorie=login"><span class="bouton1">Espace administration</span></a>&nbsp;&nbsp;>'.
	     '<a href="./?categorie=admin_forum"><span class="bouton1">Forum</span></a>'.
	  '</div>'.
  	  '<div class="box">'.
	    '<div class="titreNews">Forum: '.$titre.'</div>'.
	     '<form id="action_form" method="POST" action="./?categorie=actions_forum">'.
	      '<fieldset>'.
	       '<legend>'.$action.'</legend><br />';
}

/**
 * footerBox
 *
 * Fonction d'affiche du bas de div de traitement.
 */
function footerBox(){
  echo  '<input type="submit" value="Valider" class="bouton1" id="btn_valider"/>'.
        		'</fieldset>'.
        	'</form>'.
       	'</div>'.
       '</div>';
}

/**
 * info
 *
 * Affiche le résultat d'un traitement à l'administrateur et redirige
 * sur la page d'admnistration du forum.
 *
 * @param : texte à afficher.
 * @param : class du texte (0 pour erreur, 1 pour succès).
 */
function info($res, $succes){
  $class ="succes";
  if(!$succes){$class = "error";}
  echo '<div class="totalBox">'.
	'<div class="arbo">'.
	  '<a href="./?categorie=login"><span class="bouton1">Espace administration</span></a>&nbsp;&nbsp;>'.
	  '<a href="./?categorie=admin_forum"><span class="bouton1">Forum</span></a>'.
	'</div>'.
	 '<div class="box"><div class="titreNews">Administration du forum:</div>'.
	  '<p class="'.$class.'">'.$res.'</p>'.
         '</div>'.
      '</div>';
  echo '<script type="text/javascript" src="./modules/forum/traitements.js"></script>';
  echo '<script type="text/javascript">info();</script>';
}

/**
 * info_forum
 *
 * Affiche le résultat d'un traitement à un membre et redirige
 * sur la page du topic passé en paramètre.
 *
 * @param : texte à afficher.
 * @param : class du texte (0 pour erreur, 1 pour succès).
 * @param : id du topic sur lequel on doit rediriger.
 */
function info_forum($res, $succes, $p_id){
  $class ="succes";
  if(!$succes){$class = "error";}
  echo '<div class="totalBox">'.
	'<div class="arbo">'.
	  '<a href="./?categorie=forum"><span class="bouton1">Forum</span></a>'.
	'</div>'.
	 '<div class="box"><div class="titreNews">Forum:</div>'.
	  '<p class="'.$class.'">'.$res.'</p>'.
         '</div>'.
      '</div>';
  echo '<script type="text/javascript" src="./modules/forum/message.js"></script>';
  echo '<script type="text/javascript">info('.$p_id.');</script>';
}

//--------------------



//-Fonctions de traitement, récupération d'infos à la BDD---------

/**
 * get_cats
 *
 * Retourne un tableau de dimension 2 contenant 
 * les id et les libellés des catégories.
 */
function get_cats(){
   include("./config/mysql.php");
   $array_cat = array();

   if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
   {
     $req_cat = "SELECT id, LIBELLE FROM forum_cat ORDER BY RANG ASC";
     $query_cat = mysql_query($req_cat);
     if($query_cat)
     {
       //On récupère l'objet résultat.
       while($r = mysql_fetch_array($query_cat))
       {
	     $r['LIBELLE'] = stripslashes($r['LIBELLE']);
		 array_push($array_cat, $r);	 
       }
       mysql_free_result($query_cat);
     }
   	 mysql_close();
   }
  return $array_cat;
}

/**
 * get_scats
 *
 * Retourne un tableau de dimension 3 contenant 
 * les id, les rangs et les libellés des sous-catégories et
 * les id des catégories auxquelles ils appartiennent.
 */
 function get_scats()
 {
   include("./config/mysql.php");
   $array_cat = array();

   if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
   {
     $req_cat = "SELECT id, id_cat, rang, LIBELLE FROM forum_scat ORDER BY id_cat ASC, RANG ASC";
     $query_cat = mysql_query($req_cat);
     if($query_cat)
     {
       //On récupère l'objet résultat.
       while($r = mysql_fetch_array($query_cat))
       {
		 array_push($array_cat, $r);
       }
       mysql_free_result($query_cat);
     }
     mysql_close();
   }
  return $array_cat;
 }

/**
 * get_cats_rang
 *
 * Retourne tous les rangs des catégories.
 */
 function get_cats_rang()
 {
   include("./config/mysql.php");
   $array_cat = array();

   if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
   {
     $req_cat = "SELECT RANG FROM forum_cat ORDER BY RANG ASC";
     $query_cat = mysql_query($req_cat);
     if($query_cat)
     {
       //On récupère l'objet résultat.
       while($r = mysql_fetch_array($query_cat))
       {
	 		array_push($array_cat, $r['RANG']);
       }
       $last = $array_cat[count($array_cat)-1]+1;
       array_push($array_cat, $last);
       mysql_free_result($query_cat);
     }
     mysql_close();
   }
   return $array_cat;
 }

/**
 * get_scats_rang
 *
 * Retourne tous les rangs de sous-catégories 
 * concernant la catégorie passée en paramètre.
 *
 * @param : id de la catégorie.
 */
 function get_scats_rang($cat_id)
 {
   $array_cat = array();
   include("./config/mysql.php");

   if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
   {
     $req_cat = "SELECT RANG FROM forum_scat ORDER BY id ASC, RANG ASC WHERE id_cat=".mysql_real_escape_string($cat_id);
     $query_cat = mysql_query($req_cat);
     if($query_cat)
     {
       //On récupère l'objet résultat.
       while($r = mysql_fetch_array($query_cat))
       {
	     array_push($array_cat, $r['RANG']);
       }
       $last = $array_cat[count($array_cat)-1]+1;
       array_push($array_cat, $last);
       mysql_free_result($query_cat);
     }
     mysql_close();
   }
   return $array_cat;
 }

/**
 * get_cat_info
 * 
 * Retourne le nom de la catégorie passée en paramètre.
 * 
 * @param : id de la catégorie  
 */
 function get_cat_info($cat_id)
 {
   $res = array();
   $cat = $cat_id;

   include("./config/mysql.php");
   
   
   if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
   {
     $req_cat = "SELECT ID, LIBELLE FROM  forum_scat WHERE ID=".$cat;
     $query_cat = mysql_query($req_cat);
     if($query_cat)
     {
       //On récupère le résultat.
       $res = mysql_fetch_array($query_cat);
       mysql_free_result($query_cat);
     }
     mysql_close();
   }
   return $res;
 }
 
 //-----------------------------
