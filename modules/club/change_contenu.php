<?php if(isset($_SESSION['id']) && $_SESSION['lvl']==1){?>
<!-- Load TinyMCE -->
<script type="text/javascript" src="./js/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : './tinymce/tiny_mce.js',

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
				include("./config/mysql.php");
						mysql_connect($host, $user, $passwd); 
						mysql_select_db($bdd);
						mysql_query("SET NAMES 'utf8'");
				
			
					$id = $_POST['id'];
					$req = "SELECT titre, contenu FROM club WHERE id = $id";
					$res = mysql_query($req) or die (mysql_error());
					$row = mysql_fetch_row($res);
					$titre="Modification du contenu de la catégorie: " . $row[0];
					$titre_categorie = $row[0];
					$contenu = $row[1];

			
				
					
?>

<form id="form" style="margin-bottom:200px;" method="post" action="./modules/club/action.php">
	<div style="width:700px; margin:0 auto;">
		<h3><?php echo $titre; ?></h3>
		 
			 
			<div style="display:inline; padding:8px 5px;" class="bouton2">
				<input type="text" maxlength="50" size="50" name="titre" value="<?php echo $titre_categorie; ?>" /> <span>(Titre de la catégorie)</span>
			</div>
		

		<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<div id="tinyMceBox" style="margin-top:30px;">
			<textarea id="elm1" name="elm1" rows="15" cols="80" class="tinymce">
				<?php
				
					echo $contenu;
				mysql_close();
				?>
			</textarea>
		</div>

		<!-- Some integration calls 
		<a href="javascript:;" onmousedown="$('#elm1').tinymce().show();">[Show]</a>
		<a href="javascript:;" onmousedown="$('#elm1').tinymce().hide();">[Hide]</a>
		<a href="javascript:;" onmousedown="$('#elm1').tinymce().execCommand('Bold');">[Bold]</a>
		<a href="javascript:;" onmousedown="alert($('#elm1').html());">[Get contents]</a>
		<a href="javascript:;" onmousedown="alert($('#elm1').tinymce().selection.getContent());">[Get selected HTML]</a>
		<a href="javascript:;" onmousedown="alert($('#elm1').tinymce().selection.getContent({format : 'text'}));">[Get selected text]</a>
		<a href="javascript:;" onmousedown="alert($('#elm1').tinymce().selection.getNode().nodeName);">[Get selected element]</a>
		<a href="javascript:;" onmousedown="$('#elm1').tinymce().execCommand('mceInsertContent',false,'<b>Hello world!!</b>');">[Insert HTML]</a>
		<a href="javascript:;" onmousedown="$('#elm1').tinymce().execCommand('mceReplaceContent',false,'<b>{$selection}</b>');">[Replace selection]</a>
		-->
		
		<br />
		<input id="contenu_categorie" type="hidden" name="contenu_categorie" value="" />
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="mode" value="update" />
		<input class="bouton1" style="float:right" id="buttonValider" type="button" name="save" value="Valider le contenu" />

	</div>
</form>

<script type="text/javascript">
$('#buttonValider').click(function(){
	$('#contenu_categorie').val($('#elm1').html());
	$('#form').submit();
});

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
