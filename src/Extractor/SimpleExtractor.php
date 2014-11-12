<?php
namespace Fsv\SimpleOcr\Comparator;

use Fsv\SimpleOcr\Bitmap;
use Fsv\SimpleOcr\ExtractorInterface;
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
        return new GlyphCollection();
    }
}
