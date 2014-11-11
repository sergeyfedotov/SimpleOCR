<?php
namespace Fsv\SimpleOcr;

/**
 * Interface ExtractorInterface
 * @package Fsv\SimpleOcr
 */
interface ExtractorInterface
{
    /**
     * @param Bitmap $bitmap
     * @return GlyphCollection
     */
    public function extractGlyphs(Bitmap $bitmap);
}
