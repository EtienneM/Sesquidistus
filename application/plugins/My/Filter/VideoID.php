<?php
/*
 * 
 */

/**
 * Filter an URI to test wether or not it comes from a supported video provider
 * (i.e. youtube or dailymotion).
 *
 * @author emichon
 */
class My_Filter_VideoID implements Zend_Filter_Interface {
    protected static $_youtube = 'youtube';
    protected static $_dailymotion = 'dailymotion';
    protected static $_vimeo = 'vimeo';

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
        } else if (preg_match("/\bvimeo\b/i", $uri)) {
            $type = self::$_vimeo;
        } else {
            throw new Zend_Uri_Exception("L'uri donnée ne provient pas de youtube ni de dailymotion");
        }
        $id = null;
        $title = null;
        $description = null;
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
            case self::$_vimeo:
                $result = preg_match('/(\d+)/', $uri, $matches);
                if ($result == 0) {
                    throw new Exception('Erreur lors de la récupération de l\'identifiant de la vidéo Viméo');
                }
                $id = $matches[0];
                $hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.$id.'.php'));
                $title = $hash[0]['title'];
                $description = $hash[0]['description'];
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
