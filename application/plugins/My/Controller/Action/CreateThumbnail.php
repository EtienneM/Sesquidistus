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
    private $thumbnailDirectory;

    /**
     * Default is 120
     * @var int
     */
    private $maxWidth;

    /**
     * Default is 120
     * @var int
     */
    private $maxHeight;

    /**
     * Image name (without path and with extension)
     * @var string
     */
    private $imageName;

    /**
     *
     * @param string $imagePath Absolute path to the image
     * @param string $thumbnailDirectory Absolute path to the directory where the thumbnail will be stored
     * @param int $maxWidth Default is 120
     * @param int $maxHeight Default is 120
     */
    public function __construct($imagePath, $thumbnailDirectory, $maxWidth = 120, $maxHeight = 140) {
        $this->imagePath = $imagePath;
        $this->thumbnailDirectory = $thumbnailDirectory;
        if (!is_dir($this->thumbnailDirectory)) {
            mkdir($this->thumbnailDirectory);
        }
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
        $this->imageName = basename($imagePath);
    }

    public function create() {
        $thumbnailSrc = imagecreatefromjpeg($this->imagePath);
        $imageSize = getimagesize($this->imagePath);
        $imageWidth = $imageSize[0];
        $imageHeight = $imageSize[1];
        $ratioMax = $this->maxHeight / $this->maxWidth;
        $ratio = $imageHeight / $imageWidth;

        // Si max est de type paysage
        if (($this->maxWidth > $this->maxHeight &&
                ($imageWidth < $imageHeight // Image est portrait
                || $ratio > $ratioMax))
            || ($imageWidth < $imageHeight && $ratio > $ratioMax)) {
            $width = round($imageWidth * $this->maxHeight / $imageHeight);
            $height = $this->maxHeight;
        } // Si max est de type portrait
        else {
            $width = $this->maxWidth;
            $height = round($imageHeight * $this->maxWidth / $imageWidth);
        }
        $thumbnail = imagecreatetruecolor($width, $height);
        imagecopyresampled($thumbnail, $thumbnailSrc, 0, 0, 0, 0, $width, $height, $imageWidth, $imageHeight);
        imagejpeg($thumbnail, $this->thumbnailDirectory.'/'.$this->imageName);
    }

}

