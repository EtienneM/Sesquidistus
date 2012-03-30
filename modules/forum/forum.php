<?php
 /* Fichier d'index du forum.
  * il représente la page de garde du forum.
  *
  * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
  */
  
  //-Include concernant le SGBD---
  include("./config/mysql.php");
  
  if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd) && isset($_SESSION['login']))
  {   
	$arrayScat  = array(); 
	$reqCat = " SELECT * FROM forum_cat ORDER BY RANG ASC";
	$queryCat = mysql_query($reqCat);
    
    if($queryCat)
    {
		//-Bouton d'index du forum---
		echo "<div class=\"arbo\"><a href=\"?categorie=forum\"><span class=\"bouton1\">Forum Sesquidistus</span></a></div>";
		//---
		
		//-On parcours les différentes catégories du forum---
		while($r = mysql_fetch_object($queryCat))
		{
	        echo '<div class="box">'.
						'<div class="titreNews">'.
			  				'<span class="h_titre">'.utf8_encode(stripslashes($r->LIBELLE)).'</span>'.
			  				'<span class="h_stat">Stats</span><span class="h_lstmsg">Dernier message</span>'.
		        		'</div>';
        
			$_query = "SELECT s.ID, s.LIBELLE, s.DESC FROM forum_scat s WHERE ".
							"s.ID_CAT=".mysql_real_escape_string($r->ID)." ORDER BY RANG ASC";
							
			$r_scat = mysql_query($_query); 
			if($r_scat)
			{
				//-On parcours les différents sous-catégories du forum---
				while($rscat = mysql_fetch_object($r_scat))
				{
					$info_query = "SELECT count(t.ID) AS NB_TOPIC FROM forum_topic t WHERE ID_SCAT=".$rscat->ID;
					$info_query2 = "SELECT count(m.ID) AS NB_MSG FROM forum_msg m WHERE ID_TOPIC IN (SELECT ID FROM forum_topic WHERE ID_SCAT=".$rscat->ID.")";
					$info_query3 = "SELECT m.DATE_PUB, mem.login FROM forum_msg m, membre mem WHERE m.ID_MEMBRE = mem.id AND m.ID_TOPIC"
										  ." in (SELECT id FROM forum_topic WHERE ID_SCAT =".$rscat->ID.") ORDER BY DATE_PUB DESC LIMIT 1";           
          
					$r_inf   = mysql_query($info_query);
					$r_inf2 = mysql_query($info_query2);
					$r_inf3 = mysql_query($info_query3);
  
					//-Si les requêtes se sont bien passées---
					if($r_inf && $r_inf2 && $r_inf3)
					{
						//-On récupère les objets résultat---
						$rinf = mysql_fetch_object($r_inf);
						$rinf2 = mysql_fetch_object($r_inf2);
						$rinf3 = mysql_fetch_object($r_inf3);              
              			//---
              			
              			//-Info sur le dernier post---
						$date = isset($rinf3->DATE_PUB) ? "le ".date("j/m/y \à H:i:s",$rinf3->DATE_PUB) : "-";
						$auteur = isset($rinf3->login) ? "Par ".$rinf3->login : "-";
						//---

						//-Accord lexicaux---              
						if(isset($rinf->NB_TOPIC))
						{
							$nb_topic = $rinf->NB_TOPIC > 1 ? $rinf->NB_TOPIC." Sujets" : $rinf->NB_TOPIC." Sujet";
						}
						else { $nb_topic = "-";}
              
						if(isset($rinf2->NB_MSG))
						{
							$nb_msg = $rinf2->NB_MSG > 1 ? $rinf2->NB_MSG." Messages" : $rinf2->NB_MSG." Message";              
						}
						else {$nb_msg = "-";}
						//------

						//-On affiche la mise en page----
						echo '<a href="?categorie=topics&scat='.$rscat->ID.'"><div class="cat">'.
									'<div class="souscat">'.
										'<span class="titre">'.utf8_encode(stripslashes($rscat->LIBELLE)).'</span>'.
										'<span class="stat">'.$nb_topic.'</span><span class="lstmsg">'.$auteur.'</span>'.
									'</div>'.
                    				'<div class="souscat">'.
                          				'<span class="desc">'.utf8_encode(stripslashes($rscat->DESC)).'</span>'.
     				                     '<span class="stat">'.$nb_msg.'</span><span class="lstmsg">'.$date.'</span>'.  
                    				'</div>'.
							'</div></a>';
                  
						//---    
					}
          			else
          			{
          				//-Si problème dans les requetes on redirige vers l'index du forum---
            			echo "Erreur ".mysql_error();
            			//---                  
          			}
          		} 
          	 	echo "</div><p></p>";
          }  
          else
          {
          	//-Si problème dans les requetes on redirige vers l'index du forum---
            echo "Erreur ".mysql_error();
          	//---              
          }
        }
        //-On libère les curseurs---
        @mysql_free_result($r_inf);
        @mysql_free_result($r_inf2);
        @mysql_free_result($r_inf3);
        //---
    }
	else
	{
    	//-Si problème dans les requetes on redirige vers l'index du forum---
        echo '<script type="text/javascript">window.location.href="./?categorie=forum";</script>';
        //---     
    }
    mysql_close();
  }
  else
  {
  	//-Si problème dans les requetes on redirige vers l'index de l'accueil---
 	echo '<script type="text/javascript">window.location.href="./?categorie=accueil";</script>';
 	//---     
  }
?>