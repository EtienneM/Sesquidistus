<?php

 /* 
  * Module Calendrier
  * Renvoi le nombre d��v�nements appartenant � un type d��v�nement donn�.
  * Utilis� pour AJAX.
  *
  * Auteur : Beno�t SOUFFLET <benoit.soufflet@gmail.com>
  */

include("../../config/mysql.php");

$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($db, $con);
mysql_query("SET NAMES 'utf8'");

$type=$_POST['type'];

$res = mysql_query("SELECT count(*) FROM evenement WHERE type = $type");
if(!$res){
	echo 'erreur';
	exit;
}

$row = mysql_fetch_row($res);

echo $row[0];

mysql_close($con);
?> 
