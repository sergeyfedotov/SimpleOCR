<?php
use Fsv\SimpleOcr\Bitmap;

class BitmapTest extends PHPUnit_Framework_TestCase
{
    public function testBitmapCreation()
    {
        $bitmap = new Bitmap(10, 20);

        $this->assertEquals(10, $bitmap->getWidth());
        $this->assertEquals(20, $bitmap->getHeight());

    }

    public function testBitmapPixelManipulation()
    {
        $bitmap = new Bitmap(10, 10);

        $this->assertEquals(0, $bitmap->getPixel(5, 3));

        $bitmap->setPixel(5, 3, 1);
        $bitmap->setPixel(7, 2, 1);

        $this->assertEquals(1, $bitmap->getPixel(5, 3));
        $this->assertEquals(1, $bitmap->getPixel(7, 2));

        $bitmap->setPixel(5, 3, 0);

        $this->assertEquals(0, $bitmap->getPixel(5, 3));
    }
}
