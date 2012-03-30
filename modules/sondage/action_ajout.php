<?php 

 /* 
  * Module Sondage
  * S'occupe d'ajouter un sondage à la bdd. 
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

session_start(); 
include("../../config/mysql.php");
$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($bdd, $con);
mysql_query("SET NAMES 'utf8'"); 
				
$question = $_POST['nomQuestion'];
$choixRep= $_POST['reponseFinale'];


$reqsql="INSERT INTO sondage(id_formulaire, question, reponse_possible, date) VALUES (NULL, '$question', '$choixRep', CURDATE())";



if (!mysql_query($reqsql,$con))
{
	die('Error: ' . mysql_error());
}

include("./majSondage.php");

mysql_close($con);


header('Location: ../../?categorie=sondage');
?>