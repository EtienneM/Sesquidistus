<?php

/**
 * Create a thumbnail of a jpeg image
 *
 * @author emichon
 */
class My_Controller_Action_CreateThumbnail {
    /**
     * Absolute path to the image
     * @var string 
     */
    private $imagePath;
    /**
     * Absolute path to the directory where thumbnail is stored
     * @var string
     */
    private $thumbnailPath;
    /**
     * Default is 120
     * @var int
     */
    private $max;
    /**
     * Image name (without path and with extension)
     * @var string
     */
    private $imageName;

    /**
     *
     * @param string $imagePath Absolute path to the image
     * @param string $thumbnailPath Absolute path to the directory where thumbnail is stored
     * @param int $max Default is 120
     */
    public function __construct($imagePath, $thumbnailPath, $max = 120) {
        $this->imagePath = $imagePath;
        $this->thumbnailPath = $thumbnailPath;
        if (!is_dir($this->thumbnailPath)) {
            mkdir($this->thumbnailPath);
        }
        $this->max = $max;
        $this->imageName = basename($imagePath);
    }
    
    public function create() {
        $thumbnailSrc = imagecreatefromjpeg($this->imagePath);
        $imageSize = getimagesize($this->imagePath);
        // on teste si notre image est de type paysage...
        if ($imageSize[0] > $imageSize[1]) {
            $height = round($imageSize[1] / $imageSize[0] * $this->max);
            $width = $this->max;
        } else { // ... ou portrait
            $height = $this->max;
            $width = round($imageSize[0] / $imageSize[1] * $this->max);
        }
        $thumbnail = imagecreatetruecolor($width, $height);
        imagecopyresampled($thumbnail, $thumbnailSrc, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);
        imagejpeg($thumbnail, $this->thumbnailPath . '/' . $this->imageName);
    }
}

