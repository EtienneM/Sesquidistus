<?php

class My_Helper_Slideshow_GooglePlus implements My_Helper_Slideshow_Provider {
	public function getEmbeddedCode($url, $height = null, $width = null) {
		if(!preg_match('/^https?:\/\/.+\/photos\/([0-9]+)\/albums\/([0-9]+)/', $url, $matches)) {
			throw new Exception("Impossible to determine the user ID and the album ID");
		}
		return My_Helper_Slideshow_Google::getEmbeddedCode($matches[1], $matches[2], $height, $width);
	}
}
