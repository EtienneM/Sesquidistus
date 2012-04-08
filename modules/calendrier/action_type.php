<?php

 /* 
  * Module Calendrier des évènements
  * Gère les actions relatant de la création et de la modification d'un type d'évènement.
  * Agit sur la couleur et le nom d'un type d'évènement.
  *
  * Auteur : BenoÃ®t SOUFFLET <benoit.soufflet@gmail.com>
  */
  

include("../../config/mysql.php");

$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($db, $con);
mysql_query("SET NAMES 'utf8'");

$mode = $_POST['modeType'];
$titre = $_POST['nomType'];
$color = $_POST['color'];
	
if($mode=="ajouter"){ //ajout d'un type d'évènement
	$reqsql="INSERT INTO type_event (numero, nom, color)
			 VALUES ('"."','".$titre."','".$color."')";
}
else if($mode=="modifier"){ //modification d'un type d'évènement
	
$idType_event = $_POST['idType_event'];

	$reqsql = "UPDATE type_event SET nom = '$titre', color = '$color' WHERE numero = '$idType_event'";

}

if (!mysql_query($reqsql,$con)){
	die('Error: ' . mysql_error());
}
	  
mysql_close($con);

header('Location: ../../?categorie=calendrier&page=ajout');
?> 
