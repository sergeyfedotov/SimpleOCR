<?php
namespace Fsv\SimpleOcr;

/**
 * Class Recognizer
 * @package Fsv\SimpleOcr
 */
class Recognizer
{
    /**
     * @var FontInterface
     */
    protected $font;

    /**
     * @var ExtractorInterface
     */
    protected $extractor;

    /**
     * @var ComparatorInterface
     */
    protected $comparator;

    /**
     * @param FontInterface $font
     * @param ExtractorInterface $extractor
     * @param ComparatorInterface $comparator
     */
    public function __construct(
        FontInterface $font,
        ExtractorInterface $extractor,
        ComparatorInterface $comparator
    ) {
        $this->font = $font;
        $this->extractor = $extractor;
        $this->comparator = $comparator;
    }

    /**
     * @return FontInterface
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * @return ExtractorInterface
     */
    public function getExtractor()
    {
        return $this->extractor;
    }

    /**
     * @return ComparatorInterface
     */
    public function getComparator()
    {
        return $this->comparator;
    }

    /**
     * @param Bitmap $image
     * @return GlyphCollection
     */
    public function recognize(Bitmap $image)
    {
        $glyphs = $this->extractor->extractGlyphs($image);

        foreach ($glyphs as $glyph1) {
            foreach ($this->font->getGlyphs() as $glyph2) {
                if ($this->comparator->compare($glyph1, $glyph2)) {
                    $glyph1->setCharacter($glyph2->getCharacter());
                }
            }
        }

        return $glyphs;
    }
}
