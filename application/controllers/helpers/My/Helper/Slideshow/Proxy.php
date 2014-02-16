<?php

class My_Helper_Slideshow_Proxy implements My_Helper_Slideshow_Provider {
	public function getEmbeddedCode($url, $height = null, $width = null) {
		if (strpos($url, 'plus.google.com') !== false) {
			$obj = new My_Helper_Slideshow_GooglePlus();
		}/* elseif (strpos($url, 'picasaweb.google.com') !== false) {
			$obj = new My_Helper_Slideshow_Picasa();
		} */else {
			throw new Exception("Website not yet supported.");
		}
		return $obj->getEmbeddedCode($url, $height, $width);
	}
}
