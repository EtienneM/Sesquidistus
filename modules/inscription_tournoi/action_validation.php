<?php 
session_start(); 

include("../../config/mysql.php");
$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($db, $con);
mysql_query("SET NAMES 'utf8'"); 
				
$id_form = $_POST['id_form'];
$reponses = $_POST['reponseFinale'];
$questions = $_POST['questions'];
$mode = $_POST['mode'];


	$reqsql="INSERT INTO reponse_inscription_tournoi (id_reponse, id_formulaire, questions, reponses, date) VALUES (NULL, '$id_form', '$questions', '$reponses', CURDATE())";




if (!mysql_query($reqsql,$con))
{
	die('Error: ' . mysql_error());
}


mysql_close($con);


header('Location: ../../?categorie=event');
?>
