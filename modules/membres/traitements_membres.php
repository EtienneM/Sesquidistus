<?php
/*
 * Ce fichier regroupe les différentes actions 
 * possibles pour le traitement des membres
 * ce sont les différentes vues de l'administration des membres.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
if(isset($_SESSION['login']) && $_SESSION['lvl'] == 1)
{
	echo '<div class="totalBox">
				 <div class="arbo">
					<a href="./?categorie=login"><span class="bouton1">Espace administration</span></a>&nbsp;&nbsp;>
				  	<a href="./?categorie=admin_membres"><span class="bouton1">Membres</span></a>
				 </div>';
				 
	 //On ajoute les informations concernant la BDD.
	 include("./config/mysql.php");
	 //On ajoute les fonctions utiles aux traitements.
	 include("./modules/membres/fonctions.php");
	
	 //On est dans le mode édition d'un membre. 
	 if($_POST['mode'] == "editer")
	 {
	   echo '<div class="box">'.
		'<div class="titreNews">Edition d\'un membre</div>'.
	         '<fieldset>'.
	          '<legend>Selectionnez un membre: </legend>'.
	          '<form method="POST" action="./?categorie=edit_profil">'.
	           '<table>'.
	    	    '<tr>'.
	     	     '<td><label for="mode">Membre:</label></td>'.
	  	     '<td>'.
	      	      '<select id="user_id" name="user_id"/>';
	  if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	  {
	    $reqCat = "SELECT m.ID, m.LOGIN, p.NOM, p.PRENOM, p.MAIL FROM membre m, profil p WHERE m.ID = p.ID_MEMBRE AND m.ADMIN >= 0";
	    $queryCat = mysql_query($reqCat);
	    if($queryCat)
	    {
	      while($r = mysql_fetch_array($queryCat))
	      {//On récupère l'objet résultat.
	        echo utf8_encode('<option value="'.$r['ID'].'">'.$r['LOGIN'].' ('.$r['NOM'].' '.$r['PRENOM'].')</option>');
	      }
	     mysql_free_result($queryCat);
	    }
	    mysql_close();
	  }
	  echo	       '</select>'.
		      '</td>'.
		     '<td><input type="submit" value="Editer" class="bouton1"/></td>'.
		    '</tr>'.
		   '</table>'.
		  '</form>'.
	         '</fieldset> </div>';
	 }
	 //On est dans le mode validation des inscriptions.
	 else if($_POST['mode'] == "valider")
	 {
	 	echo '<div id="confirmation" title="Confirmation" style="display:none;">'.
	 				'<p>Etes-vous sur de vouloir supprimer ces inscriptions ?</p>'.
	 			'</div>';
	   echo  ' <div class="box">'.
	  	   '<div class="titreNews">Validation des inscriptions</div>'.
	            '<fieldset>'.
	            '<legend>Selectionnez les inscriptions à valider: </legend>'.
	            '<form id="form_membre" method="POST" action="./?categorie=traitements_membres">'.
	            '<div><img src="./modules/membres/fleche.png" alt="fleche"/>&nbsp;Tout <span id="cocher">cocher</span >/<span id="decocher">décocher</span></div>'.
	             '<table>'.
	   	      '<tr class="style1">'.
		       '<th style="width:80px"><input type="checkbox" id="tous" value=""/></th>'.	     
	   	       '<th>Login:</th>'.
		       '<th>Nom:</th>'.
		       '<th>Prénom:</th>'.
		       '<th>email:</th>'.
		      '</tr>';
	   if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	   {
	     $reqCat = "SELECT m.ID, m.LOGIN, p.NOM, p.PRENOM, p.MAIL FROM membre m, profil p WHERE m.ID = p.ID_MEMBRE AND m.ADMIN=-1";
	     $queryCat = mysql_query($reqCat);
	     if($queryCat)
	     {
	       $j = 0;
	       //On récupère l'objet résultat.
	       while($r = mysql_fetch_array($queryCat))
	       {
	         $i =  $j++ % 2 > 0 ? "background:#e1e1e1" : "background-color:#FFF";
	         echo '<tr style="'.$i.'"><td class="checkbox"><input type="checkbox" value="'.$r['ID'].'" /></td><td>'.$r['LOGIN'].'</td><td>'.utf8_encode($r['NOM']).'</td><td>'.utf8_encode($r['PRENOM']).'</td><td>'.$r['MAIL'].'</td></tr>';
	       }
	       mysql_free_result($queryCat);
	     }
	     mysql_close();
	   }
	   echo     '</table>'.
		     '<input type="hidden" name="res" id="res"/>'.
		     '<input type="hidden" name="mode" id="mode" value="confirm_validation"/>'.
		     '<input type="submit" id="valider" value="Valider" class="bouton1"/>'.
		     '<input type="submit" id="supprimer" value="Supprimer" class="bouton1"/>'.
		    '</form>'.
	            '</fieldset>';
	   echo '<script type="text/javascript" src="./modules/membres/validation.js"></script></div>';
	 }
	 //Si le formulaire de validation à été soumis.
	 else if($_POST['mode'] == "confirm_validation")
	 {
	   extract($_POST);
	   $compteur = 0;
	
	   //On traite les résultats.
	   $tmp_res = explode(";", $res);
	   $resArray = array();
	
	   foreach($tmp_res as $val)
	   {
	      if(!empty($val)) array_push($resArray, $val);	
	   }
	
	   //On se connecte à la base de donnée.
	   if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	   {
	     //On vérifie que le membre à valider ne l'est pas encore et qu'il est bien valide.
	     foreach($tmp_res as $val)
	     {
	       $req = "SELECT ADMIN FROM membre WHERE ID=".mysql_real_escape_string($val);
	       $queryCat = mysql_query($req);
	
	       //Si la requête à réussie on teste le résultat et on update la valeur du rang.
	       if($queryCat)
	       {
	 	 $rang = mysql_fetch_array($queryCat);
	
	         //Si le membre existe et qu'il vaut bien -1 on update
		 if($rang['ADMIN'] == -1)
	         {
		   $req = "UPDATE membre SET ADMIN=0 WHERE ID=".mysql_real_escape_string($val);
		   $queryCat = mysql_query($req);
	           //Le membre a bien été validé.
		   if($queryCat)
	           {
		     $compteur++;
		   }
		   else {}//La validation de ce membre a échouée.
		 }		
	       }
	       else {} //Membre inconnu
	     }
	     if($compteur == count($resArray))
	     {
	       info("Le ou les membre(s) a/ont été validé(s)!", 1);
	     }
	     else if($compteur > 0) info("La validation à partiellement réussie", 0);
	     else info("La validation des membres à échouée!", 0); 
	     mysql_close();
	  }
	  else {info("Un problème de connexion est survenu!", 0);} //Un problème de connexion est survenu.
	 }
	 //Si le formulaire de validation à été soumis.
	 else if($_POST['mode'] == "confirm_suppression")
	 {
	   extract($_POST);
	   $compteur = 0;
	
	   //On traite les résultats.
	   $tmp_res = explode(";", $res);
	
	   foreach($tmp_res as $val)
	   {
	      if(!empty($val)) $list_res += $val.",";
	   }
	   if(count($res) % 2 == 0) {$list_res = substr($res, 0, strlen($list_res)-2);} 
	   //On se connecte à la base de donnée.
	   if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	   { 
	       $req = "DELETE FROM membre WHERE ID in (".mysql_real_escape_string($list_res).")";
	       $query = mysql_query($req);
	
	       //Si la requête à réussie on teste le résultat et on update la valeur du rang.
	       if($query)
	       {
	 	        info("La ou les inscription(s) a/ont été supprimée(s)!", 1);
	     	}
		   else info("La suppression du/des inscription(s) a échouée!", 0); 
	     	mysql_close();
	  }
	  else {info("Un problème de connexion est survenu!", 0);} //Si un problème de connexion est survenu.
	 }
}
else
{
	//-Si le membre n'a pas les droits d'accès, on le redirige---
	echo '<script type="text/javascript" src="">window.location.href="./?categorie=accueil";</script>';
	//---
}
?>

</div>
