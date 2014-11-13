<?php
namespace Fsv\SimpleOcr\Comparator;

use Fsv\SimpleOcr\Bitmap;
use Fsv\SimpleOcr\ComparatorInterface;
use Fsv\SimpleOcr\Glyph;

/**
 * Class StrictComparator
 * @package Fsv\SimpleOcr\Comparator
 */
class StrictComparator implements ComparatorInterface
{
    /**
     * @param Glyph $firstGlyph
     * @param Glyph $secondGlyph
     * @return bool
     */
    public function compare(Glyph $firstGlyph, Glyph $secondGlyph)
    {
        $firstBitmap = $firstGlyph->getBitmap();
        $secondBitmap = $secondGlyph->getBitmap();

        if (!$this->compareSize($firstBitmap, $secondBitmap)) {
            return false;
        }

        /* Compare all pixels */
        for ($x = 0; $x < $firstBitmap->getWidth(); $x++) {
            for ($y = 0; $y < $firstBitmap->getHeight(); $y++) {
                if (!$this->comparePixel($firstBitmap, $secondBitmap, $x, $y)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param Bitmap $firstBitmap
     * @param Bitmap $secondBitmap
     * @return bool
     */
    protected function compareSize(Bitmap $firstBitmap, Bitmap $secondBitmap)
    {
        return $firstBitmap->getWidth() == $secondBitmap->getWidth()
            && $firstBitmap->getHeight() == $secondBitmap->getHeight();
    }

    /**
     * @param Bitmap $firstBitmap
     * @param Bitmap $secondBitmap
     * @param int $x
     * @param int $y
     * @return bool
     */
    protected function comparePixel(
        Bitmap $firstBitmap,
        Bitmap $secondBitmap,
        $x,
        $y
    ) {
        return $firstBitmap->getPixel($x, $y) == $secondBitmap->getPixel($x, $y);
    }
}
