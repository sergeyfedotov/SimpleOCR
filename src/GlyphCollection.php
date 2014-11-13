<?php
namespace Fsv\SimpleOcr;

use Fsv\ObjectCollection\AbstractCollection;

/**
 * Class GlyphCollection
 * @package Fsv\SimpleOcr
 */
class GlyphCollection extends AbstractCollection
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'Fsv\SimpleOcr\Glyph';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $string = '';

        foreach ($this->objects as $glyph) {
            $string .= $glyph->getCharacter();
        }

        return $string;
    }
}
