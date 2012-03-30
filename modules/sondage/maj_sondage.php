<?php

/* 
  * Module Sondage
  * Met à jour la variable session " sondage " de chaque membre afin de modifier la notification se trouvant dans l'interface membre de chaque membre.  *
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

	
	$query = "SELECT id_formulaire FROM sondage WHERE id_formulaire NOT IN
	(SELECT id_sondage FROM reponse_sondage WHERE id_membre='".$_SESSION['id']."') ORDER BY date DESC";
	$res = mysql_query($query) or die('Erreur SQL !<br />'.$query.'<br />'.mysql_error());
	
	$tabSondage = array();
	while($data = mysql_fetch_array($res)){
		array_push($tabSondage, "#".$data['id_formulaire']);
	}
	$_SESSION['sondage'] = $tabSondage;
?>