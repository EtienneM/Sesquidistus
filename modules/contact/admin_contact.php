<?php
/* 
 * Modification des pages "Contact", "Mentions légales", "A propos du site" grace à TinyMCE
*/
?>

<?php
	// Si l'utilisateur est connecté et est administrateur
	if(isset($_SESSION['id']) && $_SESSION['lvl'] == 1){
?>

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
			theme_advanced_blockformats : "iframe,p,div,h1,h2,h3,h4,h5,h6,blockquote,dt,dd,code,samp",
			extended_valid_elements: "iframe[class|src|frameborder=0|alt|title|width|height|align|name]",


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
		if (isset($_GET['page'])){ // Si il y a une variable $_GET['page'] dans l'url
			if ($_GET['page'] == 'mentions'){ // si la page ciblé est la page "Mentions légales"
				$nom_fichier = "./modules/contact/mentions.txt";
				$titre = "Informations légales";
				$href = "?categorie=admin_contact&page=mentions";
			}
			else if ($_GET['page'] == 'apropos'){ // si la page ciblé est la page "A propos du site"
				$nom_fichier = "./modules/contact/apropos.txt";
				$titre = "A propos du site";
				$href = "?categorie=admin_contact&page=apropos";
			}
			else { // sinon tous les autres cas cible la page "Contact"
				$nom_fichier = "./modules/contact/contact.txt";
				$titre = "Comment nous contacter ?";
				$href = "?categorie=admin_contact&page=contact";
			}
		}
		else { // Sinon affiche la page contact par défaut pour tout autre variable $_GET[''] dans l'url ou s'il n'y en a pas
			$nom_fichier = "./modules/contact/contact.txt";
			$titre = "Comment nous contacter ?";
			$href = "?categorie=admin_contact";
		}
?>

		<form id="form" style="margin-bottom:200px;" method="post" action="<?php echo $href; ?>">
		<div class="totalBox" style="margin-bottom:20px">
			<div class="box" style="margin-bottom:20px">
				<div class="titreNews"><?php echo $titre; ?></div>
		
<?php
				// Récupération du contenu du fichier
				$fichier = fopen($nom_fichier, "r+");
				$contenu = fread($fichier, filesize($nom_fichier));
				fclose($fichier);		
?>
				<div id="tinyMceBox" style="margin-top:30px;">
					<textarea id="txt" name="txt" rows="15" cols="80" class="tinymce">
<?php
							// affichage du contenu pour qu'il soit utilisé par TinyMCE
							echo stripslashes($contenu) . "\n";
?>
					</textarea>
				</div>
		
			</div>
			<input type="hidden" id="contenu" name="contenu" value="" /> <!-- Utilisé pour récupérer le contenu de TinyMCE à la validation -->
			<input type="button" class="bouton1" id="buttonValider" name="modification" value="Valider le contenu" style="float: right;"/>

		</div>
		</form>

		<script type="text/javascript">
		// Lorsque l'utilisateur clique sur le bouton Valider
		$('#buttonValider').click(function(){
			$('#contenu').val($('#txt').html());
			$('#form').submit();
		});
		</script>

<?php
		// Enregistrement du contenu dans le fichier
		if (isset($_POST['contenu'])) {
			if ($_POST['contenu'] == "") {
				$_POST['contenu'] = "Cette page est en cours de construction...";
			}
			$fichier2 = fopen($nom_fichier, "w+");
			fwrite($fichier2, $_POST['contenu']);
			fclose($fichier2);
			
			echo '<script language="Javascript">';
			echo 'document.location.replace("?categorie=contact&page=' . $_GET['page'] . '");';
			echo '</script>';
		}
?>

<?php 
	}
	else{ // sinon afficher le message d'erreur
?>
	<div class="totalBox">
		<div class="box">
			<div class="titreNews">Erreur :</div>
			<span>Cette page est uniquement accessible aux administrateurs du site...</span>
		</div>
	</div>
<?php
	}	
?>
