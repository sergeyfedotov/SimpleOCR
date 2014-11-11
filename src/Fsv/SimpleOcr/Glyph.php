<?php
namespace Fsv\SimpleOcr;

/**
 * Class Glyph
 * @package Fsv\SimpleOcr
 */
class Glyph
{
    /**
     * @var Bitmap
     */
    protected $bitmap;

    /**
     * @var string
     */
    protected $character;

    /**
     * @param Bitmap $bitmap
     * @param string $character
     */
    public function __construct(Bitmap $bitmap, $character = '')
    {
        $this->bitmap = $bitmap;
        $this->character = $character;
    }

    /**
     * @param Bitmap $bitmap
     * @return Glyph
     */
    public function setBitmap(Bitmap $bitmap)
    {
        $this->bitmap = $bitmap;

        return $this;
    }

    /**
     * @return Bitmap
     */
    public function getBitmap()
    {
        return $this->bitmap;
    }

    /**
     * @param $character
     * @return Glyph
     */
    public function setCharacter($character)
    {
        $this->character = $character;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->character;
    }
}
