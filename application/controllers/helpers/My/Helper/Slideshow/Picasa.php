<?php

class My_Helper_Slideshow_Picasa implements My_Helper_Slideshow_Provider {
	public function getEmbeddedCode($url, $height = null, $width = null) {
		if(!preg_match('/^https?:\/\/.+\/(.+)\/(.+)\??.*/', $url, $matches)) {
			throw new Exception("Impossible to determine the user ID and the album ID");
		}
		$user_id = $matches[1];
		$album_id = $matches[2];
		echo $user_id."\n";
		echo $album_id;
		return My_Helper_Slideshow_Google::getEmbeddedCode($matches[1], $matches[2], $height, $width);
	}
}
