<?php 
session_start(); 

include("../../config/mysql.php");
$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($db, $con);
mysql_query("SET NAMES 'utf8'"); 
				
$id_reponse = $_POST['id_reponse'];



	$reqsql="UPDATE reponse_inscription_tournoi SET lu = 1 WHERE id_reponse =  '$id_reponse' ";




if (!mysql_query($reqsql,$con))
{
	die('Error: ' . mysql_error());
}


mysql_close($con);


header('Location: ../../?categorie=visualisation_inscription');
?>
