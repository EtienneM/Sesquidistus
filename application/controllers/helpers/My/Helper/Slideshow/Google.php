<?php

class My_Helper_Slideshow_Google {
	public static function getEmbeddedCode($user_id, $album_id, $height, $width) {
		return '<embed width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" src="https://picasaweb.google.com/s/c/bin/slideshow.swf" flashvars="host=picasaweb.google.com&amp;captions=1&amp;hl=en_US&amp;feat=flashalbum&amp;RGB=0x000000&amp;feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2F'.$user_id.'%2Falbumid%2F'.$album_id.'%3Falt%3Drss%26kind%3Dphoto%26hl%3Den_US" pluginspage="http://www.macromedia.com/go/getflashplayer" />';
	}
}
