<?php
namespace Fsv\SimpleOcr;

/**
 * Class BitmapFactory
 * @package Fsv\SimpleOcr
 */
class BitmapFactory
{
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

        $bitmap = new Bitmap(imagesx($sourceImage), imagesy($sourceImage));

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
}
