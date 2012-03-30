<?php
 /* Fichier de génération de pages xml pour 
  * l'utilisation de l'ajax
  * (utilisé dans l'administration du forum)
  *
  * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
  */
  
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

// Dans tous les cas une page xml sera générée.
 
//-Traitements ajax---
 
include("../../config/mysql.php");

if($_POST['mode'] == 'edit_cat' && isset($_POST['valeur']))
{//Fichier généré lors de l'administration des catégories
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$req = "SELECT * FROM forum_cat WHERE id=".mysql_real_escape_string($_POST['valeur']);
		$query = mysql_query($req);
		if($query)
		{
			echo "<categorie>";
			while($r = mysql_fetch_array($query)){//On récupère l'objet résultat.
				$nom = htmlspecialchars (utf8_encode(stripslashes($r['LIBELLE'])),  ENT_QUOTES, "utf-8");
				echo '<item nom="'.$nom.'" rang="'.$r['RANG'].'" id="'.$r['ID'].'" />';
			}
			echo "</categorie>";
			mysql_free_result($query);
		}
		mysql_close();
	}
}
else if($_POST['mode'] == 'add_scat' && isset($_POST['valeur']))
{//Fichier généré lors de l'ajout de sous-catégories
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$req = "SELECT RANG FROM forum_scat WHERE id_cat=".mysql_real_escape_string($_POST['valeur']);
		$query = mysql_query($req);
		if($query)
		{
			echo "<rang>";
			while($r = mysql_fetch_array($query))
			{//On récupère l'objet résultat.
				echo '<option value="'.$r['RANG'].'">'.$r['RANG'].'</option>';
			}
			echo "</rang>";
			mysql_free_result($query);
		}
		mysql_close();
	}
}
else if($_POST['mode'] == 'edit_scat' && isset($_POST['valeur']))
{//Fichier généré lors de l'édition d'une catégorie
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$req = "SELECT LIBELLE, `DESC`, RANG, ID_CAT FROM forum_scat WHERE id=".mysql_real_escape_string($_POST['valeur']);
		$query = mysql_query($req);
		if($query)
		{
			$r = mysql_fetch_array($query);//On récupère l'objet résultat.
			$req2 = "SELECT ID, ID_CAT, max(RANG) AS MAX FROM forum_scat WHERE id_cat=".$r['ID_CAT'];
			$query2 = mysql_query($req2);//On récupère l'objet résultat.
			if($query2)
			{	  
				$r2 = mysql_fetch_array($query2);
				$nom = htmlspecialchars (utf8_encode(stripslashes($r['LIBELLE'])),  ENT_QUOTES, "utf-8");
				$desc = htmlspecialchars (utf8_encode(stripslashes($r['DESC'])),  ENT_QUOTES, "utf-8");
				echo "<scat>";
				echo '<item nom="'.$nom.'"  desc="'.$desc.'" id="'.$r['ID_CAT'].'" rang="'.$r['RANG'].'" max="'.$r2['MAX'].'" id_cat="'.$r['ID_CAT'].'" />';
				echo "</scat>";
				mysql_free_result($query2);
			}
			mysql_free_result($query);
		}
		mysql_close();
	}
}
else if($_POST['mode'] == 'del_topic')
{//Fichier généré lors de la suppression d'un sujet.
	if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
	{
		$req = "SELECT ID, LIBELLE FROM forum_topic WHERE id_scat=".mysql_real_escape_string($_POST['valeur']);
		$query = mysql_query($req);
		if($query)
		{
			echo "<topics>";
			while($r = mysql_fetch_array($query))
			{//On récupère l'objet résultat.
				$res = htmlspecialchars (utf8_encode(stripslashes($r['LIBELLE'])),  ENT_QUOTES, "utf-8");
				echo '<item id="'.$r['ID'].'" nom="'.$res.'"/>';
			}
			echo "</topics>";
			mysql_free_result($query);
		}
		mysql_close();
	}
}



?>
