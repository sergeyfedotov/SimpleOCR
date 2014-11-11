<?php
namespace Fsv\SimpleOcr;

/**
 * Interface FontInterface
 * @package Fsv\SimpleOcr
 */
interface FontInterface
{
    /**
     * @return GlyphCollection
     */
    public function getGlyphs();
}
