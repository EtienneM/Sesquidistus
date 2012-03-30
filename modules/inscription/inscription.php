<?php 
include("./modules/inscription/fonctions.php"); 
/*
 * Ce fichier regroupe les différent éléments 
 * pour l'affichage de la page d'inscription d'un nouveau membre.
 * Il s'agit de la "vue" du module d'inscription.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

?>
<div class="totalBox">
  <div class="box">
   <div class="titreNews">Inscription</div>
    <fieldset>
     <legend>Remplissez les champs çi-dessous: </legend>
     <form id="inscription" method="POST" action="./?categorie=action_inscription">
      <table>
	<tr class="style1">
   	 <th><label for="surnom">Pseudo:</label></th><td><input type="text" id="login" name="login" value="" />* min. 3 caractères</td>
	</tr>
     </table><br/>
      <table>
       	<tr class="style1">
         <th><label for="pwd">Mot de passe: </label></th><td><input type="password" id="pwd" name ="pwd" value="" />* min. 5 caractères</td>
        </tr>
       	<tr>
         <th><label for="confirm_pwd">Confirmation: </label></th><td><input type="password" id="confirm_pwd" name ="confirm_pwd" value="" />*</td>
        </tr>
      </table><br/>
     <table>
	<tr class="style1">
	 <th><label for="nom">Nom:</label></th><td><input type="text" id="nom" name="nom" value="" />*</td>
	</tr>
	<tr>
	 <th><label for="prenom">Prénom:</label></th><td><input type="text" id="prenom" name="prenom" value="" />*</td>
	</tr>
      </table><br/>
      <table>
     	<tr class="style1">
     	 <th><label for="mail">Adresse mail:</label></th><td><input type="text" id="mail" name="mail" value="" />*</td>
     	</tr>
     	<tr>
     	 <th><label for="confirm_mail">Confirmation:</label></th><td><input type="text" id="confirm_mail" name="confirm_mail" value="" />*</td>
     	</tr>
     	</table><br/>
     	<table>
     	<tr class="style1">
     	 <th><label for="qst_secrete">Sélectionnez une question:</label></th>
     	 <td>
     	 	<select id="qst_secrete" name="qst_secrete">
     	 		<?php 
     	 			foreach($qst as $val)
     	 			{
     	 					echo '<option value="'.$val.'">'.$val.'</option>';
     	 			}
     	 		?>
     	 	</select>*
     	 </td>
     	</tr>
     	<tr>
     	 <th><label for="qst_reponse">Confirmation:</label></th><td><input type="text" id="qst_reponse" name="qst_reponse" value="" size="40"/>*</td>
     	</tr>
     	<tr>
     	 <th><label for="code_confirm">Code de confirmation:</label></th>
     	 <td>
     	 		<?php $_SESSION['captcha'] = rand(1000, 9999); ?>
     	 		<input type="text" id="code_confirm" name="code_confirm" value="" size="10"/>*
     	 		<img src="./modules/inscription/captcha.php" alt="" />
     	 </td>
     	</tr>
     </table><br/>
     <input type="hidden" value="inscription" name="mode" />
	<input type="submit" value="S'inscrire" style="bouton" class="bouton1" />
     </form>
     <div style="position:absolute;bottom:0px;right:0px">
     	<a href="./doc/doc_membres/doc_membre.html#comment_sinscrire" target="_blank"><img src="./images/help.gif" alt="aide"/></a>
     </div>
     <p>
       N.B: Les champs pourront-êtres complétés ou modifiés par la suite,<br />&nbsp;&nbsp;
       néanmoins ceux marqués d'une * sont obligatoires.
     </p>
    </fieldset>
   </div>
</div>
