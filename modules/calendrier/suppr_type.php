<?php

 /* 
  * Module Calendrier
  * Supprime un type d'�v�nement de la bdd.
  *
  * Auteur : Beno�t SOUFFLET <benoit.soufflet@gmail.com>
  */


include("../../config/mysql.php");

$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($bdd, $con);
mysql_query("SET NAMES 'utf8'");

$numero = $_POST['idType_eventSuppr'];

$reqsql="DELETE FROM type_event WHERE numero = '$numero'";

		 if (!mysql_query($reqsql,$con)){
		   die('Error: ' . mysql_error());
		 }

		  
mysql_close($con);
header('Location: ../../?categorie=calendrier&page=ajout');
?> 