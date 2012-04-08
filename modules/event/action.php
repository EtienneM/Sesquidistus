<?php 

/* 
  * Module Event
  * Sert à l'ajout et à la modification d'articles, liés aux évènements de type tournois, dans la bdd.
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */


include("../../config/mysql.php");
session_start(); 

$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($db, $con);
mysql_query("SET NAMES 'utf8'");

$id = $_POST['id'];
$mode = $_POST['mode'];
$membre = $_SESSION['id'];

if($mode=="supprimer"){
	$reqsql="DELETE from article where id = '$id'";
}
else
{ 
$contenu_article = $_POST['contenu_article'];
$titre = $_POST['titre'];

	if($mode=="creer"){
		$reqsql="INSERT INTO article (id, titre, contenu, date_article, id_event, id_member) VALUES (NULL, '$titre', '$contenu_article', CURDATE(), $id, $membre)";
	}
	else if($mode=="modifier"){
		$reqsql="UPDATE article SET titre = '$titre', contenu ='$contenu_article'  WHERE id = '$id'";
	}
}
	if (!mysql_query($reqsql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }

mysql_close($con);


header('Location: ../../?categorie=event');
?>
