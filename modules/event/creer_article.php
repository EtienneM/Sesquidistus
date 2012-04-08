<?php

/* 
  * Module Event
  * Utile à la création et à la modification d'article, lance la librairie tinyMCE et sauvegarde les modifications.
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

 if(isset($_SESSION['id']) && $_SESSION['lvl']==1){?>
<!-- Load TinyMCE -->
<script type="text/javascript" src="./js/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : './js/tinymce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
			skin : "o2k7",
			skin_variant : "silver",
			width : "700",
			height : "475",
			language : "fr",




			// Theme options
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,fullscreen",
			theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : false,
			theme_advanced_path : false,


			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
</script>
<!-- /TinyMCE -->

<?php 
				include("./config/mysql.php");
				mysql_connect($host, $user, $passwd); 
				mysql_select_db($db);
				mysql_query("SET NAMES 'utf8'");

				$mode = $_POST['mode'];
				$titre;
				$titre_article = "";
				$contenu;
				$id;
				
				if($mode == $tabSousCatName[1]){
					$idArticle = $_POST['id_article'];
					$req = "SELECT titre, contenu FROM article WHERE id = $idArticle";
					$res = mysql_query($req) or die (mysql_error());
					$row = mysql_fetch_row($res);
					$titre="Modification de l'article: " . $row[0];
					$titre_article = $row[0];
					$contenu = $row[1];
					$id= $idArticle;
				}
				else if($mode == $tabSousCatName[2]){
					$idEvent = $_POST['id_event'];
					$req = "SELECT titre FROM evenement WHERE id = $idEvent";
					$res = mysql_query($req) or die (mysql_error());
					$row = mysql_fetch_row($res);
					$titre="CrÃ©ation d'un article pour l'Ã©vÃ¨nement: " . $row[0];
					$id=$idEvent;
				}
				mysql_close();
					
?>

<form id="form" style="margin-bottom:200px;" method="post" action="./modules/event/action.php">
	<div style="width:700px; margin:0 auto;">
		<h3><?php echo $titre; ?></h3>
		 
			 
			<div style="display:inline; padding:8px 5px;" class="bouton2">
				<input type="text" maxlength="50" size="50" name="titre" value="<?php echo $titre_article; ?>" /> <span>(Titre de l'article)</span>
			</div>
		

		<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<div id="tinyMceBox" style="margin-top:30px;">
			<textarea id="elm1" name="elm1" rows="15" cols="80" class="tinymce">
				<?php
				
					echo $contenu;
				?>
			</textarea>
		</div>
		
		<br />
		<input id="contenu_article" type="hidden" name="contenu_article" value="" />
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input id="modeHidden" type="hidden" name="mode" value="<?php echo $mode; ?>" />
		<input class="bouton1" style="float:right" id="buttonValider" type="button" name="save" value="Valider l'article" />

	</div>
</form>

<script type="text/javascript">
var buttonValider = document.getElementById("buttonValider");
var hiddenMode = document.getElementById("modeHidden");
buttonValider.onclick = soumettre;

function soumettre(){
	var contenu_article = document.getElementById("contenu_article");
	contenu_article.value = $('#elm1').html();
	$("#form").submit();
}

</script>
<?php 
}
 else{
		echo '<div class="totalBox">
			<div class="box">
			<div class="titreNews">Erreur :</div>
				<span>Cette page est uniquement accessible aux administrateurs du site...</span>
			</div>
		</div>';
	  }	
?>
