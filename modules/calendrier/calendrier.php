<!-- Sous-menu de la categorie Calendrier -->
<div id="menuSelectionCat">
		
 <?php if(isset($_SESSION['id']) && $_SESSION['lvl']==1){
			$admin=true;
	
	     	echo '<script type="text/javascript">
			 var tabType_numero = new Array();
		   	 var tabType_nom = new Array();
		 	 var tabType_color = new Array();
		     </script>';  
 ?>

		   <span id="consultButton" class="bouton1" onclick="javascript:document.location='./?categorie=calendrier&amp;page=consultation'">Consulter le calendrier</span>		
		   <span id="ajoutButton" class="bouton1" onclick="javascript:document.location='./?categorie=calendrier&amp;page=ajout'">Ajouter un √©v√®nement</span>
<?php } ?>

</div>
	
<?php 
 /* 
  * Module Calendrier
  * (Consultation et Ajout d'ÈvËnement relantant de l'activitÈ du club)
  *
  * Auteur : BenoÓt SOUFFLET <benoit.soufflet@gmail.com>
  */
  
include("./config/mysql.php");
$getPage = false;
$tabSousCatName = array("consultation","ajout");

//Definir la date du jour (cot√© serveur)
		$monthNow = (int)date("m");
		$yearNow = (int)date("Y");

	//Si la variable GET page est vide on charge la page de consultation.
	if(!isset($_GET['page'])){
		$_GET['page']="consultation";
	}

	//Verification que la variable GET page est dans le tableau $tabSousCatName.
	for($i=0; $i<count($tabSousCatName) && !$getPage; $i++){
	  if($tabSousCatName[$i] == $_GET['page']){
		$getPage = true;
	  }
	 }
	 
	 //Si la variable GET page n'est pas dans le tableau $tabSousCatName, on charge la page de consultation.
	 if(!$getPage){$_GET['page']="consultation";}
	 
	 $pageSousCat = $_GET['page'];
	 
	 //Si la variable GET 'page' retourne "ajout", alors on lance l'interface d'ajout d'√©v√®nement
	 if($pageSousCat == "ajout"){
		include("./modules/calendrier/calendrier_ajout.php");
	 }

			
	//Sinon si la variable GET retourne "consultation", alors on affiche un simple calendrier pour la consultation des events.
	else if($pageSousCat == "consultation"){ 
		include("./modules/calendrier/calendrier_consultation.php");
	}
?>