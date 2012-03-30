/* Fichier js pour la configuration
 * de tinyMCE
 * (Utilisé dans toutes les pages d'ajout du forum)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */

/* Génération de l'accordion jQuery */
$(document).ready(function(){$("#accordion").accordion({active: false, collapsible: true, fillspace: true});});

/* Configuration de TinyMCE */
	$().ready(function() {
				$("textarea.tinymce").tinymce({
				/* Location of TinyMCE script */
				script_url : "./tinymce/tiny_mce.js",
				
				/* General options */
				theme : "advanced",
				plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
				skin : "o2k7",
				skin_variant : "silver",
				width : "500",
				height : "250",
				language : "fr",

				/* Theme options */
				theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,fullscreen",
				theme_advanced_buttons4 : "",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : false,
				theme_advanced_path : false,

				/* Example content CSS (should be your site CSS) */
				content_css : "css/content.css",
	
				/* Drop lists for link/image/media/template dialogs */
				template_external_list_url : "lists/template_list.js",
				external_link_list_url : "lists/link_list.js",
				external_image_list_url : "lists/image_list.js",
				media_external_list_url : "lists/media_list.js",
	
				/* Replace values for the template plugin */
				template_replace_values : {
					username : "Some User",
					staffid : "991234"
				}
			});
	});

//-Action du bouton "Tout effacer"---
$("#reset").click(function(){$("#elm1").innerHTML = "";});
//---