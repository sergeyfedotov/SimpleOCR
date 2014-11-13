<?php
namespace Fsv\SimpleOcr\Extractor;

use Fsv\SimpleOcr\Bitmap;
use Fsv\SimpleOcr\BitmapFactory;
use Fsv\SimpleOcr\ExtractorInterface;
use Fsv\SimpleOcr\Glyph;
use Fsv\SimpleOcr\GlyphCollection;

/**
 * Class SimpleExtractor
 * @package Fsv\SimpleOcr\Comparator
 */
class SimpleExtractor implements ExtractorInterface
{
    /**
     * @param Bitmap $bitmap
     * @return GlyphCollection
     */
    public function extractGlyphs(Bitmap $bitmap)
    {
        $glyphs =  new GlyphCollection();

        foreach ($this->extractLines($bitmap) as $lineNum => $lineBounds) {
            if ($lineNum > 0) {
                $glyphs->add(new Glyph(new Bitmap(1, 1), "\n"));
            }

            foreach (
                $this->extractLineCharacters($bitmap, $lineBounds)
                    as $characterBounds
            ) {
                $glyphs->add(new Glyph(
                    BitmapFactory::createFromBitmap(
                        $bitmap,
                        $characterBounds[0],
                        $characterBounds[2],
                        $characterBounds[1] - $characterBounds[0],
                        $characterBounds[3] - $characterBounds[2]
                    )
                ));
            }
        }

        return $glyphs;
    }

    /**
     * @param Bitmap $bitmap
     * @return array
     */
    protected function extractLines(Bitmap $bitmap)
    {
        $bounds = array();
        $prevLevel = 0;
        $lineIndex = 0;
        $lastY = $bitmap->getHeight() - 1;

        /* Iterate over all lines */
        for ($y = 0; $y < $bitmap->getHeight(); $y++) {
            $level = 0;

            /* Find pixel with foreground color */
            for ($x = 0; $x < $bitmap->getWidth(); $x++) {
                if ($bitmap->getPixel($x, $y)) {
                    $level = 1;
                    break;
                }
            }

            /* Detect rising edge */
            if (
                $level > $prevLevel
                || ($level != 0 && $y == 0)
            ) {
                $bounds[$lineIndex][0] = $y;
            /* Detect falling edge */
            } else if (
                $level < $prevLevel
                || ($level != 0 && $y == $lastY)
            ) {
                $bounds[$lineIndex][1] = $y;
                $lineIndex++;
            }

            $prevLevel = $level;
        }

        return $bounds;
    }

    /**
     * @param Bitmap $bitmap
     * @param array $lineBounds
     * @return Glyph[]
     */
    protected function extractLineCharacters(Bitmap $bitmap, $lineBounds)
    {
        $prevLevel = 0;
        $characterIndex = 0;
        $yMin = $lineBounds[1];
        $yMax = $lineBounds[0];
        $lastX = $bitmap->getWidth() - 1;
        $bounds = array();

        for ($x = 0; $x < $bitmap->getWidth(); $x++) {
            $level = 0;

            for ($y = $lineBounds[0]; $y < $lineBounds[1]; $y++) {
                if ($bitmap->getPixel($x, $y)) {
                    $level = 1;
                    $yMin = min($y, $yMin);
                    $yMax = max($y, $yMax);
                }
            }

            if (
                $level > $prevLevel
                || ($level != 0 && $x == 0)
            ) {
                $bounds[$characterIndex][0] = $x;
            } else if (
                $level < $prevLevel
                || ($level != 0 && $x == $lastX)
            ) {
                $bounds[$characterIndex][1] = $x;
                $bounds[$characterIndex][2] = $yMin;
                $bounds[$characterIndex][3] = $yMax + 1;
                $yMin = $lineBounds[1];
                $yMax = $lineBounds[0];
                $characterIndex++;
            }

            $prevLevel = $level;
        }

        return $bounds;
    }
}
