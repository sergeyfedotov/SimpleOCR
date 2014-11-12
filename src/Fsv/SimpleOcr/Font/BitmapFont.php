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
     * @var array
     */
    protected $characters = array();

    /**
     * @var GlyphCollection
     */
    protected $glyphs;

    /**
     * @param Bitmap $bitmap
     * @param ExtractorInterface $extractor
     * @param array $characters
     */
    public function __construct(
        Bitmap $bitmap,
        ExtractorInterface $extractor,
        array $characters
    ) {
        $this->bitmap = $bitmap;
        $this->extractor = $extractor;
        $this->characters = $characters;
        $this->extractGlyphs();
    }

    /**
     *
     */
    protected function extractGlyphs()
    {
        $this->glyphs = $this->extractor->extractGlyphs($this->bitmap);

        foreach ($this->glyphs as $i => $glyph) {
            if (isset($this->characters[$i])) {
                $glyph->setCharacter($this->characters[$i]);
            }
        }
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
     * @return array
     */
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * @return GlyphCollection
     */
    public function getGlyphs()
    {
        return $this->glyphs;
    }
}
