<?php
/*
 * 
 */

/**
 * Description of VideoID
 *
 * @author emichon
 */
class My_Filter_VideoID implements Zend_Filter_Interface {
    protected static $_youtube = 'youtube';
    protected static $_dailymotion = 'dailymotion';

    /**
     * Get information about a video from different provider.
     * 
     * @param string $uri
     * @return array with the four following keys:
     * <ul><li>Id from the website provider</li><li>type which correspond to the provider</li>
     * <li>title from the website</li><li>description from the website</li></ul>
     * @throws Zend_Uri_Exception If the URI cannot be parsed
     */
    public function filter($uri) {
        if (strpos($uri, 'youtube.com') !== false || strpos($uri, 'youtu.be') !== false) {
            $type = self::$_youtube;
        } else if (preg_match("/\bdailymotion\b/i", $uri)) {
            $type = self::$_dailymotion;
        } else {
            throw new Zend_Uri_Exception("L'uri donnée ne provient pas de youtube ni de dailymotion");
        }
        $id = null;
        switch($type) {
            case self::$_youtube:
                if (preg_match('/http:\/\/youtu.be/', $uri)) {
                    $id = str_replace('/', '', parse_url($uri, PHP_URL_PATH));
                } elseif (preg_match('/watch/', $uri)) {
                    $url_vars = null;
                    parse_str(parse_url($uri, PHP_URL_QUERY), $url_vars);
                    $id = $url_vars['v'];
                } else {
                    throw new Zend_Uri_Exception("Impossible de déterminer l'identifiant de cette vidéo");
                }
                $yt = new Zend_Gdata_YouTube();
                $video = $yt->getVideoEntry($id);
                $title = $video->getTitleValue();
                $description = $video->getContent()->getText();
                break;
            case self::$_dailymotion:
                $id = strtok(basename($uri), '_');
                break;
            default:
                break;
        }
        return array(
            'type' => $type,
            'id' => $id,
            'title' => $title,
            'description' => $description,
        );
    }

}
