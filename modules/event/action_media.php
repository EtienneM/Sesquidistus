<?php 

 /* 
  * Module Event
  * Sert à modifier un évènement en mettant à jour ses informations multimédia (photo et vidéo)
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

include("../../config/mysql.php");
$con = mysql_connect($host, $user, $passwd); 
mysql_select_db($bdd, $con);
mysql_query("SET NAMES 'utf8'");

$id = $_POST['id'];
$mode = $_POST['mode'];


if($mode=="doc_image"){
$lien_photo = $_POST['lien_photo'];

	$reqsql="UPDATE evenement SET contenu_photo = '$lien_photo' WHERE id = '$id'";
}
else if($mode=="doc_video"){
$lien_video = $_POST['lien_video'];
	$reqsql="UPDATE evenement SET contenu_video = '$lien_video' WHERE id = '$id'";
}

	if (!mysql_query($reqsql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }

mysql_close($con);

header('Location: ../../?categorie=event');
?>