<?php
namespace Fsv\SimpleOcr\Font;

use Fsv\SimpleOcr\Bitmap;
use Fsv\SimpleOcr\ExtractorInterface;
use Fsv\SimpleOcr\FontInterface;
use Fsv\SimpleOcr\GlyphCollection;

/**
 * Class BitmapFont
 * @package Fsv\SimpleOcr\Font
 */
class BitmapFont implements FontInterface
{
    /**
     * @var Bitmap
     */
    protected $bitmap;

    /**
     * @var ExtractorInterface
     */
    protected $extractor;

    /**
     * @var GlyphCollection
     */
    protected $glyphs;

    /**
     * @param Bitmap $bitmap
     * @param ExtractorInterface $extractor
     */
    public function __construct(Bitmap $bitmap, ExtractorInterface $extractor)
    {
        $this->bitmap = $bitmap;
        $this->extractor = $extractor;
        $this->extractGlyphs();
    }

    /**
     *
     */
    protected function extractGlyphs()
    {
        $this->glyphs = $this->extractor->extractGlyphs($this->bitmap);
    }

    /**
     * @return Bitmap
     */
    public function getBitmap()
    {
        return $this->bitmap;
    }

    /**
     * @return ExtractorInterface
     */
    public function getExtractor()
    {
        return $this->extractor;
    }

    /**
     * @return GlyphCollection
     */
    public function getGlyphs()
    {
        return $this->glyphs;
    }
}
