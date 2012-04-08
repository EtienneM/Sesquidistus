<?php
/*
 * Ce fichier regroupe les différentes instructions
 * permettant de la consultation d'un profil membre.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
//-Inclusion du fichier de fonctions---
include("./modules/membres/fonctions.php");

if(!empty($_POST['u_id']) || !empty($_GET['u_id']))
 {	
   //-Inclusion du fichier paramètres du SGBD---
   include("./config/mysql.php");	
   
   $id = !empty($_POST['u_id']) ? $_POST['u_id'] : $_GET['u_id'];
   
   if(mysql_connect($host, $user, $passwd) && mysql_select_db($db))
   {
     $req = "SELECT m.LOGIN, p.* FROM profil p, membre m WHERE m.ID = p.ID_MEMBRE AND m.ID=".mysql_real_escape_string($id);
     $query = mysql_query($req);

     if($query)
     {
       $r = mysql_fetch_array($query);//On récupère l'objet résultat.
       if(!empty($r))
       {
	       echo '<div class="totalBox">'.
					 '<!-- Div edititon du profil -->'.
					  '<div class="box">'.
					  	'<div class="titreNews">Feuille profil membre</div>'.
					  	  '<fieldset>'.
					  	   '<legend>Profil :</legend>'.
						     '<table style="width:100%">'.
						      '<tr>'.
						       '<td rowspan="9" id="avatar"><img src="'.$r['AVATAR'].'" style="width:120px; height:140px; padding:8px" alt="Ma photo" class="bouton2"/></td>'.
						      '</tr>'.
						      '<tr class="style1">'.
						       '<th><label for="nom">Nom:</label></th><td>'.utf8_encode(stripslashes($r["NOM"])).'</td>'.
						       '<th><label for="poste">Poste préféré:</label></th>'.
						       '<td>'.
								 utf8_encode($r['POSTE']).
						       '</td>'.
						      '</tr>'.
						      '<tr class="style2">'.
						       '<th><label for="prenom">Prénom:</label></th><td>'.utf8_encode(stripslashes($r['PRENOM'])).'</td>'.
						       '<th><label for="coup">Coup favoris:</label></th>'.
						       '<td>'.
									utf8_encode($r['COUP']).
						       '</td>'.
						      '</tr>'.
						      '<tr class="style1">'.
						       '<th><label for="surnom">Login:</label></th><td>'.$r['LOGIN'].'</td>'.
						       '<th><label for="membre_depuis">Membre depuis:</label></th>'.
						     	'<td>'.
						     		substr($r['ADHESION'], 0,4).
						     	 '</td>'.
						       '</tr>'.
						       '</tr>'.
						       '<tr class="style2">'.
						     	'<th><label for="mail">Adresse mail:</label></th><td>'.$r["MAIL"].'</td>'.
						      '</tr>'.
						       '<tr class="style1">'.
						       	 '<th><label for="main">Gaucher ou droitier ?:</label></th>'.
						         '<td>'.
									$r['MAIN'].
						         '</td>'.
						      '<tr></tr>'.
							 '<tr class="style2">'.
							  '<th><label for="pq_ultimate">Pourquoi l\'ultimate ?:</label></th>'.
							   '<td colspan="2">'.
						 			utf8_encode(stripslashes($r['POURQUOI'])).
							   '</td>'.
							 '</tr>'.
							 '<tr  class="style1">'.
							  '<th><label for="souvenir">Mon meilleur souvenir:</label></th>'.
							   '<td colspan="2">'.
							   		utf8_encode(stripslashes($r['SOUVENIR'])).
							   '</td>'.
							  '</tr>'.
						    '</table>'.
					    '</fieldset>'.
					  '</div>'.
					'</div>';
			mysql_free_result($query);//On libère le curseur.
       	}
       	else
       	{
       		profil_form("Feuille profil membre", "Profil inexistant ou indisponible!");
       	}
     }
     else
     {
		profil_form("Feuille profil membre", "Erreur de connexion!");	
     }
     mysql_close();
   }
 }
 else
 {
   	profil_form("Feuille profil membre", "Erreur de traitement!");	
 }
?>
