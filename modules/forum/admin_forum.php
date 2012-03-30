<?php 
/* Page d'accueil de l'administration du forum
 * sur cette page se fait la sélection d'un traitement
 * à réaliser sur le forum.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

//-On vérifie l'accès à la page--- 
if(isset($_SESSION['lvl']) && $_SESSION['lvl'] > 0)
{
	//-Si aucun traitement n'est en cours de réalisation---
 	if(!isset($_POST['action']))
 	{
   		echo '<div class="totalBox">'.
				  '<div class="arbo"><a href="./?categorie=login"><span class="bouton1">Espace administration</span></a></div>'.
			  	  '<div class="box">'.
				   '<div class="titreNews">Administration du forum</div>'.
				     '<form method="POST" action="./?categorie=traitements_forum">'.
				 	'<fieldset>'.
					 '<legend>Sélectionnez le traitement à réaliser:</legend><br />'.
					  '<label for="actions">Traitement:</label>'.
					  '<select name="action" size="1">'.
				  	   '<optgroup label="Catégorie">'.
					    '<option value="add_cat">Ajouter une catégorie</option>'.
					    '<option value="edit_cat">Modifier une catégorie</option>'.
					    '<option value="del_cat">Supprimer une catégorie</option>'.
			 		   '</optgroup>'.
				  	   '<optgroup label="Sous-catégorie">'.
					    '<option value="add_scat">Ajouter une sous-catégorie</option>'.
				   	    '<option value="edit_scat">Modifier une sous-catégorie</option>'.
			  	   	    '<option value="del_scat">Supprimer une sous-catégorie</option>'.
				  	   '</optgroup>'.
				   	   '<optgroup label="Sujet">'.
			  	  	    '<option value="del_topic">Supprimer un sujet</option>'.
				  	   '</optgroup>'.
				 	  '</select>'.
				 	  '<input type="submit" value="Valider" class="bouton1"/>'.
			    		 '</fieldset>'.
				     '</form>'.
			         '<div style="position:absolute;bottom:10px;right:15px">'.
			         	'<a href="./doc/doc_forum/doc_admin_forum.html" target="_blank"><img src="./images/help.png" alt="aide"/>'.
			        '</div>'.
			     '</div>'.
			   '</div>';
  	}
  	//---
}
else 
{ 
	/*Accès non autorisé.*/
	//-On redirige sur la page d'accueil du site en js---
	echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
	//---
}
?>
