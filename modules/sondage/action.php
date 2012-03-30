<?php 

 /* 
  * Module Sondage
  * S'occupe de la modification et de la création d'une réponse à un sondage par un membre. (dans la bdd)
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

session_start(); 
include("../../config/mysql.php");
$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($bdd, $con);
mysql_query("SET NAMES 'utf8'"); 
				
$id_sondage = $_POST['id_sondage'];
$mode = $_POST['mode'];

if($mode=="ajouter"){
		$id_membre = $_POST['id_membre'];
		$reponse = $_POST['reponse'];
		$reqsql="INSERT INTO reponse_sondage(id_reponse, id_sondage, id_membre, reponse, date) VALUES (NULL, $id_sondage, $id_membre, $reponse, CURDATE())";
}
else if($mode=="modifier"){
		$id_membre = $_POST['id_membre'];
		$reponse = $_POST['reponse'];
		$reqsql="UPDATE reponse_sondage SET reponse = $reponse, date = CURDATE()  WHERE id_membre = '$id_membre' AND id_sondage ='$id_sondage'";
}
else if($mode=="supprimer"){
		$reqsql="DELETE from sondage WHERE id_formulaire = $id_sondage";
}

if (!mysql_query($reqsql,$con))
{
	die('Error: ' . mysql_error());
}

include("./majSondage.php");
					
mysql_close($con);

if($mode=="supprimer"){
header('Location: ../../?categorie=sondage');
}
else{
header('Location: ../../?categorie=sondage#'.$id_sondage);
}
?>