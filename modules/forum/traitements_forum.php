<?php
 /* Fichier permettant la réalisation des traitements
  * il représente les vues des traitements réalisables
  * à partir de l'administration du forum.
  *
  * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
  */
  
//-Include du fichiers de fonctions---
include("./modules/forum/fonctions.php");

//-Si accès par une personne non administratrice--
if(!isset($_SESSION['lvl']) || $_SESSION['lvl'] < 1){
	exit("Accès interdit!");
}
//-Si l'on viens bien de la page admin_forum (formulaire bien submit)---
else if(isset($_POST['action']) && !empty($_POST['action']))
{
	//-Ajout d'une catégorie---
	if($_POST['action'] == "add_cat")
	{
    	//-On récupère les informations sur les catégories(Rangs)---
    	$arrayCat = get_cats_rang();
    	headerBox("Ajout d'une catégorie", "Remplissez les champs ci-dessous: ");
		echo '<table>'.
  				   '<tr><td><label for="nom">Nom: </label></td><td><input type="text" id="nom" name="nom" value=""/></td></tr>'.
       	    		'<tr><td><label for="rang">Position: </label></td><td><select id="rang" name="rang">';
    	//-S'il y en a au moins une on affiche---
    	if(!empty($arrayCat)){$max=$arrayCat[count($arrayCat)-1]; for($i=count($arrayCat)-1; $i>=0; $i--){echo '<option value="'.$arrayCat[$i].'">'.$arrayCat[$i].'</option>';}}
  
    	//-Sinon ça sera la première---
    	else {echo '<option value="1">1</option>'; $max=1;}
    	echo '	</select></td></tr>'.
      			 '</table>'.
	 			'<input type="hidden" name="max" value="'.$max.'"/>'.
         		'<input type="hidden" name="mode" value="add_cat"/>';
    	footerBox();
	}
	else if($_POST['action'] == "edit_cat")
	{
		//-Edition d'une catégorie---
	
		//-On récupère les informations sur les catégories---
	    $arrayCat = get_cats();
	    
	    //-On récupère les informations sur les catégories(Rangs)---
	    $arrayCatR = get_cats_rang();   
	    
	    //-S'il y en a au moins une on affiche---
	    if(!empty($arrayCat))
	    {
			headerBox("Edition d'une catégorie", "Selectionnez le champ ci-dessous: ");
			echo '<label for="categorie">Catégorie: </label><select name="categorie" id="categorie">'.
            			 '<optgroup label="Choisir une catégorie">';
      		for($i=0; $i<count($arrayCat); $i++){echo '<option value="'.$arrayCat[$i]['id'].'">'.utf8_encode($arrayCat[$i]['LIBELLE']).'</option>';}
      		echo '</optgroup></select><span id="wait" style="display:none;">&nbsp;<img src="./modules/forum/loading.gif" width="24" height="24"/></span>';
		    echo '</fieldset>';
		    //-Fieldset à mettre à jour---
		    echo '<fieldset><legend>Remplissez les champs ci-dessous: </legend>';
		    echo '<table>'.
				  	   '<tr><td><label for="nom">Nom: </label></td><td><input type="text" id="nom" name="nom" value=""/></td></tr>'.
		            	'<tr><td><label for="rang">Position: </label></td><td><select id="rang" name="rang">';
		    if(!empty($arrayCatR)){$max=$arrayCatR[count($arrayCat)-1]; for($i=0; $i<count($arrayCatR)-1; $i++){echo '<option value="'.$arrayCatR[$i].'">'.$arrayCatR[$i].'</option>';}}          
		    echo '	</select></td></tr>'.
		      	      '</table>';
		    echo '<input type="hidden" name="max" value="'.$max.'"/>'.
			        '<input type="hidden" name="rg" id="rg"/>'.
		            '<input type="hidden" name="mode" value="edit_cat"/>';
		    //-Adjnction de l'ajax magique---
		    echo '<script type="text/javascript" src="./modules/forum/traitements.js"></script>';
		    echo '<script type="text/javascript" src="./modules/forum/edit_cat.js"></script>';
		    footerBox();
		}
		//-S'il n'y en a pas on affiche un message d'erreur---
		else
		{
			headerBox("Edition d'une catégorie", "Aucune catégorie disponible"); 
			echo "Veuillez retourner sur la page d'administration.";
			footerBox();
		}
	} 
	elseif($_POST['action'] == "del_cat")
	{
		//-Suppression d'une catégorie---
		
		//-On récupère les informations sur les catégories---
		$arrayCat = get_cats();
		//-On récupère les informations sur les catégories(Rangs)---
		$arrayCatR = get_cats_rang();
		//-S'il y en a au moins une on affiche---
		if(!empty($arrayCat))
		{
			headerBox("Suppression d'une catégorie", "Selectionnez le champ ci-dessous: ");
			echo '<label for="cat">Nom: </label>'.
					 '<select id="cat" name="cat">';
			if(!empty($arrayCatR))
			{
				$max=$arrayCatR[count($arrayCat)-1]; 
				for($i=0; $i<count($arrayCat); $i++){echo '<option value="'.$arrayCatR[$i].'-'.$arrayCat[$i]['id'].'">'.utf8_encode($arrayCat[$i]['LIBELLE']).'</option>';}
			}
			echo '</select>'.
					'<input type="hidden" name="max" value="'.$max.'"/>'.
					'<input type="hidden" name="mode" value="del_cat"/>';	  

			//-Div qui va nous servir pour la dialog de confirmation---
			echo '<div id="confirmation" title="Confirmation" style="display: none;">'.
					'<p>Etes-vous sur de vouloir supprimer cette catégorie?</p>'.
					'</div>';
			footerBox();
			echo '<script type="text/javascript" src="./modules/forum/del_cat.js"></script>';
		}
		//-S'il n'y en a pas on affiche un message d'erreur---
		else
		{
    		headerBox("Suppression d'une catégorie", "Aucune catégorie disponible"); 
    		echo "Veuillez retourner sur la page d'administration.";
    		footerBox();
  		}	
	}
	elseif($_POST['action'] == "add_scat")
	{
		//-Ajout d'une sous-catégorie---
		
		//-On récupère les informations sur les catégories---
		$arrayCat = get_cats();   
		//-S'il y en a au moins une on affiche---
		if(!empty($arrayCat))
		{
			headerBox("Ajout d'une sous-catégorie", "Remplissez les champs ci-dessous: ");
			echo  '<table>'.
						'<tr><td><label for="nom">Nom: </label></td><td><input type="text" id="nom" name="nom" value=""/></td></tr>'.
	  		  			'<tr><td><label for="desc">Description: </label></td><td><input type="text" id="desc" name="desc" value=""/></td></tr>'.
	  		  			'<tr><td><label for="categorie">Catégorie: </label></td><td>'.
	  		  				'<select name="cat" id="categorie">';
    		for($i=0; $i<count($arrayCat); $i++){echo '<option value="'.$arrayCat[$i]['id'].'">'.utf8_encode($arrayCat[$i]['LIBELLE']).'</option>';}
    		echo '		</select><span id="wait" style="display:none;">&nbsp;<img src="./modules/forum/loading.gif" width="24" height="24"/></span></td></tr>'.
    					'<tr><td><label for="rang">Position: </label></td><td><select id="rang" name="rang">'.
    					'</select></td></tr>'.
    	    		'</table>'.
					'<input type="hidden" name="max" id="max"/>'.
	        		'<input type="hidden" name="mode" value="add_scat"/>';
      		//-Adjonction de l'ajax magique---
      		echo '<script type="text/javascript" src="./modules/forum/traitements.js"></script>';
			echo '<script type="text/javascript" src="./modules/forum/add_scat.js"></script>';	
			footerBox();
		}
		//-S'il n'y en a pas on affiche un message d'erreur---
		else
		{
			headerBox("Ajout d'une sous-catégorie", "Aucune catégorie disponible"); 
			echo "Veuillez d'abord ajouter une catégorie.";
			footerBox();
		}
	}
	elseif($_POST['action'] == "edit_scat")
	{
		//-Edition d'une sous-catégorie---
   		
   		//-On récupère les informations sur les catégories---
		$arrayCat = get_cats();  
		//-On récupère les informations sur les sous-catégories---
		$arrayScat = get_scats(); 
		$j = 0; 
		
		if(!empty($arrayCat) && !empty($arrayScat))
		{
			headerBox("Edition d'une sous-catégorie", "Selectionnez le champ ci-dessous: ");
			echo '<label for="scat">Sous-catégorie: </label>'.
						'<select id="scat" name="scat">';
			for($i=0; $i<count($arrayCat); $i++)
			{
				echo '<optgroup label="'.utf8_encode(stripslashes($arrayCat[$i]['LIBELLE'])).'">';
				while($arrayScat[$j]['id_cat'] == $arrayCat[$i]['id'])
				{
					echo '<option value="'.$arrayScat[$j]['id'].'">'.utf8_encode(stripslashes($arrayScat[$j]['LIBELLE'])).'</option>';
					$j++;
				}
				echo '</optgroup>';
			}
			echo '</select><span id="wait" style="display:none;">&nbsp;<img src="./modules/forum/loading.gif" width="24" height="24"/></span></fieldset>';
			
			//-Fieldset à mettre à jour---
			echo '<fieldset><legend>Remplissez les champs ci-dessous: </legend>';
			echo '<table>'.
						'<tr><td><label for="nom">Nom: </label></td><td><input type="text" id="nom" name="nom" value=""/></td></tr>'.
						'<tr><td><label for="desc">Description: </label></td><td><input type="text" id="desc" name="desc" value=""/></td></tr>'.
						'<tr><td><label for="rang">Position: </label></td><td><select id="rang" name="rang">';
			echo '</select></td></tr>'.
					'</table>'.	
					'<input type="hidden" name="id_cat" id="id_cat"/>'.
					'<input type="hidden" name="max" id="max"/>'.
					'<input type="hidden" name="rg" id="rg"/>'.
					'<input type="hidden" name="mode" value="edit_scat"/>';	
			//-Adjonction de l'ajax magique---
			echo '<script type="text/javascript" src="./modules/forum/traitements.js"></script>';
			echo '<script type="text/javascript" src="./modules/forum/edit_scat.js"></script>';	  
			footerBox();
		}
		//-S'il n'y en a pas on affiche un message d'erreur---
		else
		{
			headerBox("Ajout d'une sous-catégorie", "Aucune catégorie disponible"); 
			echo "Veuillez d'abord ajouter une catégorie.";
			footerBox();
		}
	}
	elseif($_POST['action'] == "del_scat")
	{
		//-Suppression d'une sous-catégorie---
   		
   		//-On récupère les informations sur les catégories---
   		$arrayCat = get_cats();  
   		//-On récupère les informations sur les sous-catégories---
		$arrayScat = get_scats(); 
		$j = 0; 

		if(!empty($arrayCat) && !empty($arrayScat))
		{
			headerBox("Suppression d'une sous-catégorie", "Selectionnez le champ ci-dessous: ");
			echo '<label for="scat">Nom: </label>'.
					'<select id="scat" name="scat">';
			$tmp_max = array();
			for($i=0; $i<count($arrayCat); $i++)
			{  
				$max = 0;
				while($arrayScat[$j]['id_cat'] == $arrayCat[$i]['id']){$max++; $j++;}
				$tmp_max[$i] = $max;
			}
			$j=0;
			for($i=0; $i<count($arrayCat); $i++)
			{  
				echo '<optgroup label="'.utf8_encode($arrayCat[$i]['LIBELLE']).'">';
				while($arrayScat[$j]['id_cat'] == $arrayCat[$i]['id'])
				{
					echo '<option value="'.$arrayScat[$j]['id_cat'].'-'.$arrayScat[$j]['id'].'-'.$arrayScat[$j]['rang'].'-'.$tmp_max[$i].'">'.utf8_encode($arrayScat[$j]['LIBELLE']).'</option>';
					$j++;
				}
				echo '</optgroup>';
			}
			echo '</select>';
			echo '<input type="hidden" name="mode" value="del_scat"/>';
			//-Div qui va nous servir pour la dialog de confirmation---
			echo '<div id="confirmation" title="Confirmation" style="display: none;">'.
						'<p>Etes-vous sur de vouloir supprimer cette sous-catégorie?</p>'.
					'</div>';
			footerBox();
			echo '<script type="text/javascript" src="./modules/forum/del_cat.js"></script>';
		}
	}
	elseif($_POST['action'] == "del_topic")
	{
		//-Suppression d'une sous-catégorie---
        echo '<div id="no_topic" title="Attention" style="display: none;">'.
     		   		'<p>'.
     		   			'Aucun sujet n\'est répertorié dans cette sous-catégorie!<br/><br/>'.
     		   			'Pour supprimer un autre sujet veuillez sélectionner une autre sous-catégorie.'.
     		   		'</p>'.
      			'</div>';
		//-On récupère les informations sur les catégories---
		$arrayCat = get_cats();  
		//-On récupère les informations sur les sous-catégories---
		$arrayScat = get_scats(); 
		$j = 0; 

		if(!empty($arrayCat) && !empty($arrayScat))
		{
			headerBox("Suppression d'un sujet", "Selectionnez le champ ci-dessous: ");
			echo '<label for="scat">Sous-catégorie: </label>'.
						'<select id="scat" name="scat">';
			for($i=0; $i<count($arrayCat); $i++)
			{
				echo '<optgroup label="'.utf8_encode($arrayCat[$i]['LIBELLE']).'">';
				while($arrayScat[$j]['id_cat'] == $arrayCat[$i]['id'])
				{
					echo '<option value="'.$arrayScat[$j]['id'].'">'.utf8_encode($arrayScat[$j]['LIBELLE']).'</option>';
					$j++;
	   			}
				echo '</optgroup>';
			}
			echo '</select><span id="wait" style="display:none;">&nbsp;<img src="./modules/forum/loading.gif" width="24" height="24"/></span>'.
          			'</fieldset>';
			echo '<fieldset id="sujets"><legend>Selectionnez le champ ci-dessous:	</legend>';
			echo '<label for="scat">Nom: </label><select id="topics"></select>';
			echo '<input type="hidden" name="action" value="suppr_sujet"/>';
			echo '<input type="hidden" name="id" id="id"/><br/ ><br />';
			
			//-Adjonction de l'ajax magique---
			echo '<script type="text/javascript" src="./modules/forum/traitements.js"></script>';
			echo '<script type="text/javascript" src="./modules/forum/del_topic.js"></script>';	  
			footerBox();
		}
		//-S'il n'y en a pas on affiche un message d'erreur---
		else
		{
			headerBox("Ajout d'une sous-catégorie", "Aucune catégorie disponible"); 
			echo "Veuillez d'abord ajouter une catégorie.";
			footerBox();
		}
 	}
}
?>
