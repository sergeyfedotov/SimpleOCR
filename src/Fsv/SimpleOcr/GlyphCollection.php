<?php
namespace Fsv\SimpleOcr;

/**
 * Class GlyphCollection
 * @package Fsv\SimpleOcr
 */
class GlyphCollection implements \Iterator
{
    /**
     * @var array
     */
    protected $glyphs = array();

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @param Glyph $glyph
     */
    public function addGlyph(Glyph $glyph)
    {
        $this->glyphs[] = $glyph;
    }

    /**
     * @return array
     */
    public function getGlyphs()
    {
        return $this->glyphs;
    }

    /**
     * @return Glyph
     */
    public function current()
    {
        return current($this->glyphs);
    }

    /**
     * @return void
     */
    public function next()
    {
        next($this->glyphs);
    }

    /**
     * @return int|null
     */
    public function key()
    {
        return key($this->glyphs);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return current($this->glyphs) !== null;
    }

    /**
     * @return void
     */
    public function rewind()
    {
        reset($this->glyphs);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $string = '';

        foreach ($this->glyphs as $glyph) {
            $string .= $glyph->getCharacter();
        }

        return $string;
    }
}
