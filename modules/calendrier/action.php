<?php
 /* 
  * Module Calendrier des évènements
  * Gère les actions relatant de la création, et de la modification d'un évènement.
  * Agit sur le type, le nom, la date, la durée, les horaires et le commentaire liés à un évènement.
  *
  * Auteur : BenoÃ®t SOUFFLET <benoit.soufflet@gmail.com>
  */
  
include("../../config/mysql.php");

$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($bdd, $con);
mysql_query("SET NAMES 'utf8'");

$nomEvent = $_POST['nomEvent'];
$commentaire = $_POST['commentaireEvent'];
$dateEvent = $_POST['dateEvent'];
$id_lieuEvent = $_POST['id_lieuEvent'];
$text_lieu = $_POST['text_lieuEvent'];
$typeEvent = $_POST['typeEvent'];

if(!isset($_POST['duree_event'])){$_POST['duree_event']=1;}
$duree = $_POST['duree_event'];

$debutH = $_POST['debutEventHeure'];
$debutM = $_POST['debutEventMinute'];
$finH = $_POST['finEventHeure'];
$finM = $_POST['finEventMinute'];
$debut = $debutH . "h" . $debutM;
$fin = $finH . "h" . $finM;

if(isset($_POST['boolHoraire']) && $_POST['boolHoraire'] == "true"){
	$debut = NULL;
	$fin = NULL;
}
	
if($text_lieu != ""){$id_lieuEvent = 0;}	
if($_POST['mode']=="modification"){ //modification d'un évènement existant
$idEvent = $_POST['idEvent'];

 $reqsql = "UPDATE evenement SET date = STR_TO_DATE('$dateEvent', '%d/%m/%Y'), duree = '$duree', lieu = '$text_lieu', id_lieu ='$id_lieuEvent', horaire_debut ='$debut', horaire_fin ='$fin', 
			type = '$typeEvent' , titre ='$nomEvent' , description = '$commentaire'  WHERE id = '$idEvent'";

	if (!mysql_query($reqsql,$con)){
		die('Error: ' . mysql_error());
	}
		  
}
else{ //Création d'un évènement

	$tabDateEvent = split(",", $dateEvent);

	for($i=0; $i<count($tabDateEvent);$i++){
		$reqsql="INSERT INTO evenement (id, date, duree, lieu, id_lieu, horaire_debut, horaire_fin, type, titre, description)
		VALUES ('"."',STR_TO_DATE('$tabDateEvent[$i]', '%d/%m/%Y'), '".$duree."', '".$text_lieu."', '".(int)$id_lieuEvent."', '".$debut."','".$fin."','".$typeEvent."','".$nomEvent."','".$commentaire."')";

		if (!mysql_query($reqsql,$con)){
			die('Error: ' . mysql_error());
		}
	}
	$path='&page=ajout';
}




mysql_close($con);

header('Location: ../../?categorie=calendrier'.$path);
?> 