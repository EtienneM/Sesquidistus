<?php
/*
 * Ce fichier regroupe les différentes actions 
 * possibles dans l'administration des membres, il peut être considéré
 * comme la vue de l'administration des membres dans un modèle 
 * de type MVC.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 
 if(isset($_SESSION['lvl']) && $_SESSION['lvl'] == 1)
 {
 	echo '<div class="totalBox">
				 <div class="arbo"><a href="./?categorie=login"><span class="bouton1">Espace administration</span></a></div>
				  <div class="box">
				   <div class="titreNews">Administration des Membres</div>
				    <fieldset>
				     <legend>Selectionnez un traitement: </legend>
				     <form method="POST" action="./?categorie=traitements_membres">
				     <table>
				       <tr>
					<td><label for="mode">Traitement:</label></td>
					<td>
					  <select id="mode" name="mode"/>
					    <optgroup label="Choisir un traitement">
					      <option value="valider">Valider les inscriptions</option>
					      <option value="editer">Editer un membre</option>
					    </optgroup>
					  </select>
					  <input type="submit" value="Valider" class="bouton1"/>
					</td>
				       </tr>
				      </table>
				      </form>
				    </fieldset>
  			        <div style="position:absolute;bottom:10px;right:15px">
			         <a href="./doc/doc_membres/doc_admin_membres.html" target="_blank"><img src="./images/help.png" alt="aide"/>
			       </div>
				 </div>
				</div>';
 }
else
{
   //-Cas où le visiteur n'a pas de droits, on le redirige---
   echo '<script type="text/javascript" src="">window.location.href="./?categorie=accueil";</script>';
   //---
}