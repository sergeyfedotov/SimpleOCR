<?php
namespace Fsv\SimpleOcr;

/**
 * Interface ComparatorInterface
 * @package Fsv\SimpleOcr
 */
interface ComparatorInterface
{
    /**
     * @param Glyph $firstGlyph
     * @param Glyph $secondGlyph
     * @return bool
     */
    public function compare(Glyph $firstGlyph, Glyph $secondGlyph);
}
