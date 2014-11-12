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
     * @param $fileName
     * @param int $brightnessThreshold
     * @return Bitmap
     * @throws Exception
     */
    public static function createFromFile(
        $fileName,
        $brightnessThreshold = 128
    ) {
        if (false === ($imageData = @file_get_contents($fileName))) {
            throw new Exception();
        }

        if (false === ($sourceImage = @imagecreatefromstring($imageData))) {
            throw new Exception();
        }

        return self::createFromImage($sourceImage, $brightnessThreshold);
    }

    /**
     * @param resource $sourceImage
     * @param int $brightnessThreshold
     * @return Bitmap
     * @throws Exception
     */
    public static function createFromImage(
        $sourceImage,
        $brightnessThreshold = 128
    ) {
        if (!is_resource($sourceImage)) {
            throw new Exception();
        }

        $bitmap = new self(imagesx($sourceImage), imagesy($sourceImage));

        for ($x = 0; $x < $bitmap->getWidth(); $x++) {
            for ($y = 0; $y < $bitmap->getHeight(); $y++) {
                $rgba = imagecolorsforindex(
                    $sourceImage,
                    imagecolorat($sourceImage, $x, $y)
                );
                $brightness = 0.299 * $rgba['red'] + 0.587 * $rgba['green'] + 0.114 * $rgba['blue'];
                $bitmap->setPixel($x, $y, ($brightness < $brightnessThreshold) ? 1 : 0);
            }
        }

        return $bitmap;
    }

    /**
     * @param Bitmap $sourceBitmap
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     * @return Bitmap
     * @throws Exception
     */
    public static function createFromBitmap(
        Bitmap $sourceBitmap,
        $x,
        $y,
        $width,
        $height
    ) {
        $bitmap = new Bitmap($width, $height);

        if (false ===
            (@imagecopy(
                $bitmap->getImage(),
                $sourceBitmap->getImage(),
                0,
                0,
                $x,
                $y,
                $width,
                $height
            ))
        ) {
            throw new Exception();
        }

        return $bitmap;
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
