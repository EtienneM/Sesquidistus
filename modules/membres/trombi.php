<?php
 /* 
  * Fichier de présentation de l'équipe
  * (Trombi des joueurs)
  * (utilisé dans le module le club)
  *
  * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>, Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

include("./config/mysql.php");
include("./modules/membres/fonctions.php");

if($_GET['categorie']=="trombi"){
echo '<div class="box" style="width:700px; margin:0 auto;">
     <div class="titreNews">Trombinoscope</div>';
}
	 
if(mysql_connect($host, $user, $passwd) && mysql_select_db($bdd))
{
	$req = "SELECT * FROM membre m, profil p WHERE m.ID = p.ID_MEMBRE AND m.ADMIN >= 0 ORDER BY p.POSTE DESC";
	$query = mysql_query($req);
	if($query)
	{
		$i = 0;
 		$res = "";
		$ok = false;
		
		if($_GET['categorie']=="trombi"){
			$nb_joueur_ligne = 5;
		}
		else{
			$nb_joueur_ligne = 4;
		}
		
		while($r = mysql_fetch_array($query))
		{
			//S'il le membre n'a pas de poste, ==> Non-classé
			if($r['POSTE']==""){$r['POSTE']="Non-classé";}
			
			//On teste si le poste du nouveau joueur est égal au poste du précédent joueur (par rapport à l'ordre de réception)
			$ok = $r['POSTE'] == $res ? false : true;
			$res = $r['POSTE'];

			if($i % $nb_joueur_ligne == 0 || $ok)
			{	
				
				if($i > 0) echo "<tr/></table><br/>";
				if($ok)
				{
					echo $res."(s)<hr/>";
					$i=0;
				}
				echo '<table style="border-collapse:separate; border-spacing:12px 3px;"><tr>';
			}
			
			//On récupère l'objet résultat.
			echo '<td style="text-align:center;">'.
						'<div class="bouton4" style="padding:6px;">
							<a class="black" href="./?categorie=view_profil&u_id='.$r['ID_MEMBRE'].'">
								<img style="width:100px; height:115px" src="'.$r['AVATAR'].'" title="'.strtoupper($r['NOM']).' '.$r['PRENOM'].'"alt="'.strtoupper($r['NOM']).'" />
								<br/>'.strtoupper($r['NOM']).'
							</a>
						</div>'.
			     '</td>';
			$i++;
		   
		}
		if($i != 0) echo "<tr/></table>";
		
		mysql_free_result($query);
	}
	else
	{
		profil_form("Erreur", "Erreur de traitement de la base de données");
	}
	mysql_close();
}
else
{
	//Problème de connexion à la base.
	profil_form("Erreur", "Erreur de connexion à la base de données");
}
echo '</div>';
?>