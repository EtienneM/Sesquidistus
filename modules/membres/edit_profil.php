<?php
/*
 * Ce fichier regroupe les différentes actions 
 * réaliser l'édition du profil membre.
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
 if(!isset($_SESSION['login']) || empty($_SESSION['login']))
 {
	//-Si le membre n'as pas les droits on le redirige---
 	echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
 	//---	
 }
 else
 {
	 //-On include les fonctions utiles au module---
	 include("./modules/membres/fonctions.php");
	 include("./modules/membres/avatar.php");
	 //---
	 if(!empty($_SESSION['id']) || !empty($_POST['user_id']))
	 {
		
	   //-Inclusion du fichier paramètres du SGBD---
	   include("./config/mysql.php");
	   //---
		
	   //On définit la priorité d'édition d'admin sur le profil.
	   $id = !empty($_POST['user_id']) ? $_POST['user_id'] : $_SESSION['id'];
	   if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	   {
	     $reqCat = "SELECT m.LOGIN, m.ADMIN, p.* FROM profil p, membre m WHERE m.ID = p.ID_MEMBRE AND m.ID=".mysql_real_escape_string($id);
	     $queryCat = mysql_query($reqCat);
	
	     if($queryCat)
	     {
	       $r = mysql_fetch_array($queryCat);//On récupère l'objet résultat.
	       mysql_free_result($queryCat);//On libère le curseur.
	     }
	     else
	     {
		//Erreur de traitement.		
	     }
	     mysql_close();
	   }
	 }
?> 
	<div class="totalBox">
	  <!-- Div edititon du profil -->
	  <div class="box">
	  	<div class="titreNews">Mon profil</div>
	  	  <fieldset>
	  	   <legend>Edition du profil: </legend>
		    <form method="POST" action="./?categorie=actions_profil">
		     <table style="width:100%">
		      <tr>
		       <td rowspan="6"><img src="<?php echo $r['AVATAR']; ?>" style="width:120px; height:140px; padding:8px; cursor:pointer" title="Cliquez pour changez votre photo!" class="bouton4" alt="Ma photo" id="avatar" /></td>     
		      </tr>
		      <tr class="style1">
		       <th><label for="nom">Nom:</label></th><td><input type="text" id="nom" name="nom" value="<?php echo utf8_encode(stripslashes($r['NOM'])); ?>"/></td>
		       <th><label for="poste">Poste préféré:</label></th>
		       <td>
		     	<select id="poste" name="poste"/>
		     	 <?php    	   
		     	   foreach ($postes as $val){
				     $sel="";
					 if(utf8_encode($r['POSTE']) == $val){$sel ='selected="selected"';}
		     	   	 echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';		
		     	   }
		     	 ?>
				</select>
		       </td>
		      </tr>
		      <tr class="style2">
		       <th><label for="prenom">Prénom:</label></th><td><input type="text" id="prenom" name="prenom" value="<?php echo utf8_encode(stripslashes($r['PRENOM'])); ?>"/></td>
		       <th><label for="coup">Coup favoris:</label></th>
		       <td>
		        <select id="coup" name="coup"/>
		     	 <?php
		     	   foreach ($coups as $val)
			   		{
			    		$sel="";
			    		echo '<div>';
			    		echo '</div>';
			    		if(utf8_encode($r['COUP']) == $val){$sel ='selected="selected"';}
		     	    		echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';	
		     	   }
		     	 ?>
		     	</select>
		       </td>
		      </tr>
		      <tr class="style1">
		       <th><label for="surnom">Login:</label></th><td><input type="text" id="surnom" name="surnom" value="<?php echo utf8_encode($r['LOGIN']); ?>" disabled="disabled"/></td>
		       <th><label for="membre_depuis">Membre depuis:</label></th>
		     	<td>
		     	 <select id="membre_depuis" name="membre_depuis">
		     	   <?php 
		              $year = substr($r['ADHESION'], 0,4);
		     	      //On génère les dates d'aujourd'hui jusqu'il y a 15 ans.
		     	      $date = date("Y");
		     	      for($i=0; $i<15; $i++)
			      {
				$res = $date-$i;
		                $sel = "";
				if($year == $res){$sel= "selected=selected";}
				echo '<option value="'.$res.'" '.$sel.'>'.$res.'</option>';	
		     	      }
		     	    ?>
		     	   </select>
		     	 </td>
		       </tr>
		       <tr class="style2">
		     	<th><label for="mail">Adresse mail:</label></th><td><input type="text" id="mail" name="mail" value="<?php echo $r['MAIL']; ?>"/></td>
		      </tr>
		      <tr class="style1">
		       <th><label for="main">Gaucher ou droitier ?:</label></th>
		       <td>
		     	<select id="main" name="main"/>
			<?php
		          if($r['MAIN'] == "Gaucher")
			  {   
			    echo '<option value="Gaucher" selected="selected">Gaucher</option>';
			    echo '<option value="Droitier">Droitier</option>';
			  }
			  else
			  {
			    echo '<option value="Gaucher">Gaucher</option>';
			    echo '<option value="Droitier" selected="selected">Droitier</option>';		  
			  }
			?>	
		     	</select>
		       </td>
			<?php 
			  if($_SESSION['lvl'] == 1)
			  {
			    $cat_mem = array("Compte non vérifié", "Membre", "Administrateur");		
		 	    echo '<th><label for="rang">Droits:</label></th>'.
				  '<td>'.
		 		   '<select id="rang" name="rang">';
			    for($i=-1, $j=0; $i<2; $i++, $j++)
			    {
			      $sel="";		
			      if($r['ADMIN'] == $i){$sel='selected="selected"';}
			      echo '<option value="'.$i.'" '.$sel.'/>'.$cat_mem[$j].'</option>';
			    }
			    echo  '</select>'.
				  '<input type="hidden" id="id_mem" name="id_mem" value="'.$id.'"/>'.
				  '<input type="hidden" id="rang_dpt" name="rang_dpt" value="'.$r['ADMIN'].'"/>'.
				 '</td>';
			 }
		       ?>
		     </tr>
			 <tr class="style2">
			  <th><label for="pq_ultimate">Pourquoi l'ultimate ?:</label></th>
			   <td colspan="2">
			 	<textarea rows="3" cols="50" id="pq_ultimate" name="pq_ultimate"><?php echo utf8_encode(stripslashes($r['POURQUOI'])); ?></textarea>
			   </td>
			 </tr>
			 <tr  class="style1">
			  <th><label for="souvenir">Mon meilleur souvenir:</label></th>
			   <td colspan="2">
			 	<textarea rows="3" cols="50" id="souvenir" name="souvenir"><?php echo utf8_encode(stripslashes($r['SOUVENIR'])); ?></textarea>
			   </td>
			  </tr>
		    </table>
		     <input type="hidden" value="maj_profil" name="mode" />
		     <input type="submit" value="Modifier" class="bouton1" />
		     <a href="./?categorie=view_profil&u_id=<?php echo $_SESSION['id']; ?>"><input type="button" value="Visualiser mon profil existant" class="bouton1"/></a>
		   </form>
	    </fieldset>
        <div style="position:absolute;bottom:10px;right:15px">
        	<a href="./doc/doc_membres/doc_membre.html#changer_photo" target="_blank"><img src="./images/help.png" alt="aide"/></a>
        </div>
	 </div>
	   
	<br />
	   
	<!-- Div du changement de mot de passe -->
	<?php
	 //Div qui va nous servir pour la dialog de confirmation.
	 echo '<div id="confirmation" title="Confirmation" style="display: none;">'.
	        '<p>Etes-vous sur de vouloir modifier le mot de passe?</p>'.
	      '</div>';
	?>
	<div class="box">
	  <div class="titreNews">Mot de passe</div>
	    <fieldset>
	      <legend>Changement du mot de passe:</legend>
	        <form method="POST" id="pwd_form" action="./?categorie=actions_profil">
	       	  <table id="pwd">
	       	   <tr class="style1">
	       	    <th><label for="old_pwd">Mot de passe actuel: </label></th><td><input type="password" id="old_pwd" name ="old_pwd" value="" ></td>
	    	   </tr>
	    	   <tr class="style2">
	    	    <th class="style2"><label for="new_pwd">Nouveau mot de passe: </label></th><td><input type="password" id="new_pwd" name="new_pwd" value="" ></td>
	    	   </tr>
	    	   <tr class="style1"> 
	    	    <th><label for="new_pwd_confirm">Confirmation: </label></th><td><input type="password" id="new_pwd_confirm" name="new_pwd_confirm" value="" ></td>
	    	   </tr>
	          </table>
		  <input type="hidden" value="maj_mdp" name="mode" />
		  <input type="submit" value="Valider" class="bouton1" id="btn_valider"/>
		  <script type="text/javascript" src="./modules/membres/profil.js"></script>
	        </form>
	      </fieldset>
	    </div> 
	    <div style="position:absolute;bottom:10px;right:15px">
	    	<a href="./doc/doc_membres/doc_membre.html#changer_mdp" target="_blank"><img src="./images/help.png" alt="aide"/></a>
	    </div>
	</div>
	
	
	<script type="text/javascript">
	    $(function() {
	                $( "#changeImg" ).dialog({
	                        autoOpen: false,
	                        width: 500,
							closeText: 'x',
							draggable: false,
							resizable: false,
							modal: true
	                });
		});
	    $("#avatar").click(function() {$("#changeImg").dialog("open");});
	</script>

<?php 
	//-On ferme le else permettant d'afficher l'édition de profil uniquement quand un memebre est connecté.
	 }
	//---
?>
 