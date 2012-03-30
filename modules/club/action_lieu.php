<?php

 /* 
  * Ce fichier réalise les actions de modification, d'ajout et de suppression des lieux d'entrainement
  * du club SUC Ultimate
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

include("../../config/mysql.php");

$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($bdd, $con);
mysql_query("SET NAMES 'utf8'");

	
if($text_lieu != ""){$id_lieuEvent = 0;}	
if($_POST['mode']=="suppr"){

		$num_lieu = $_POST['id_lieu'];
		$reqsql="DELETE FROM lieu_ultimate WHERE numero = '$num_lieu'";	
		
}
else if($_POST['mode']=="add"){
	
		$nom = $_POST['nom'];
		$adresse = $_POST['adresse'];
		$reqsql="INSERT INTO lieu_ultimate (numero, nom, adresse)
		VALUES ('"."','".$nom."', '".$adresse."')";
		
}
else if($_POST['mode']=="modif"){
		
		$num_lieu = $_POST['id_lieu'];
		$nom = $_POST['nom'];
		$adresse = $_POST['adresse'];
		$reqsql="UPDATE lieu_ultimate SET nom = '$nom', adresse ='$adresse'  WHERE numero = '$num_lieu'";
		
}
	
if(!mysql_query($reqsql,$con)){
		die('Error: ' . mysql_error());
	}

mysql_close($con);
header('Location: ../../?categorie=club&id=6');
?> 