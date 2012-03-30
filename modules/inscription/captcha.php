<?php
/*
 * Ce fichier regroupe les différentes instructions 
 * permettant de générer un captcha.
 * (utilisé lors de l'inscription)
 *
 * Auteur : Pierre LEROY <pleroy@etu.unistra.fr>
 */
session_start();

header("Content-type: image/png");

if(isset($_SESSION['captcha']) && !empty($_SESSION['captcha']))
{
	$img = imagecreate(50, 30);
	$blanc = imagecolorallocate($img, 255, 255, 255);
	$noir = imagecolorallocate($img, 0, 0, 0);
	imagestring($img, 10, 10, 15, $_SESSION['captcha'], $noir);
	imagepng($img);
}

?>