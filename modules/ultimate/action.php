<?php include("../../config/mysql.php");

 /* 
  * Ce fichier réalise les actions de modification, d'ajout et de suppression des sous-catégories
  * du module Ultimate et de leur contenu
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */


session_start(); 

$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($db, $con);
mysql_query("SET NAMES 'utf8'");

$mode = $_POST['mode'];
$id = $_POST['id'];
$titre = $_POST['titre'];

if($mode=="update"){
	$contenu_categorie = $_POST['contenu_categorie'];

		$reqsql="UPDATE ultimate SET titre = '$titre', contenu ='$contenu_categorie'  WHERE id = '$id'";
}
else if($mode=="ajout"){
	$reqsql="INSERT INTO ultimate (id, titre, contenu) VALUES (NULL, '$titre', '')";
}	
else if($mode=="suppr"){
	$reqsql="DELETE FROM ultimate WHERE id='$id'";
	$id="";
}

	  if (!mysql_query($reqsql,$con)){
		die('Error: ' . mysql_error());
	  }

mysql_close($con);


header('Location: ../../?categorie=ultimate&id='.$id);
?>
