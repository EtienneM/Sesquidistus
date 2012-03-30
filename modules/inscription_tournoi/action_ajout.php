<?php 
session_start(); 

include("../../config/mysql.php");
$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($bdd, $con);
mysql_query("SET NAMES 'utf8'"); 
				
$id_event = $_POST['id_event'];
$questions = $_POST['questionFinale'];
$mode = $_POST['mode'];

if($mode=="ajout"){
	$reqsql="INSERT INTO inscription_tournoi (id_formulaire, id_event, questions, date) VALUES (NULL, '$id_event', '$questions', CURDATE())";
}
else if($mode=="update"){
	$reqsql="UPDATE inscription_tournoi SET questions = '$questions' WHERE id_event =  '$id_event' ";
}
else if($mode=="suppression"){
	$reqsql="DELETE FROM inscription_tournoi WHERE id_event =  '$id_event' ";
}

if (!mysql_query($reqsql,$con))
{
	die('Error: ' . mysql_error());
}


mysql_close($con);


header('Location: ../../?categorie=event');
?>