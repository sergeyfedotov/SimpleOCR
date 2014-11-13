<?php
namespace Fsv\SimpleOcr;

/**
 * Class Bitmap
 * @package Fsv\SimpleOcr
 */
class Bitmap
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var resource
     */
    protected $image;

    /**
     * @var int
     */
    protected $backgroundColorIndex;

    /**
     * @var int
     */
    protected $foregroundColorIndex;

    /**
     * @param $width
     * @param $height
     * @throws Exception
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->createImage();
        $this->createPalette();
    }

    /**
     * @throws Exception
     */
    protected function createImage()
    {
        if (false === ($this->image = @imagecreate($this->width, $this->height))) {
            throw new Exception();
        }
    }

    /**
     *
     */
    protected function createPalette()
    {
        $this->backgroundColorIndex = imagecolorallocate($this->image, 255, 255, 255);
        $this->foregroundColorIndex = imagecolorallocate($this->image, 0, 0, 0);
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return resource
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $x
     * @param $y
     * @param $value
     * @return $this
     */
    public function setPixel($x, $y, $value)
    {
        imagesetpixel(
            $this->image,
            $x,
            $y,
            $value ? $this->foregroundColorIndex : $this->backgroundColorIndex
        );

        return $this;
    }

    /**
     * @param $x
     * @param $y
     * @return int
     */
    public function getPixel($x, $y)
    {
        return imagecolorat($this->image, $x, $y) === $this->backgroundColorIndex ? 0 : 1;
    }
}
