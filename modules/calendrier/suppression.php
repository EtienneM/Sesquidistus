<?php

 /* 
  * Module Calendrier
  * Supprime un évènement de la bdd.
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

include("../../config/mysql.php");

$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($db, $con);
mysql_query("SET NAMES 'utf8'");

$elementSuppr = $_POST['supprEvent'];


	$reqsql="DELETE FROM evenement WHERE id = $elementSuppr";

	if (!mysql_query($reqsql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }


mysql_close($con);

header('Location: ../../?categorie=calendrier');
?> 
