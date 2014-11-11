<?php
namespace Fsv\SimpleOcr\Comparator;

use Fsv\SimpleOcr\ComparatorInterface;
use Fsv\SimpleOcr\Glyph;

/**
 * Class StrictComparator
 * @package Fsv\SimpleOcr\Comparator
 */
class StrictComparator implements ComparatorInterface
{
    /**
     * @param Glyph $glyph1
     * @param Glyph $glyph2
     * @return bool
     */
    public function compare(Glyph $glyph1, Glyph $glyph2)
    {
        return false;
    }
}
