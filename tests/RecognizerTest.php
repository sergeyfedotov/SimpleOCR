<?php
use Fsv\SimpleOcr\Font\BitmapFont;
use Fsv\SimpleOcr\Extractor\SimpleExtractor;
use Fsv\SimpleOcr\Comparator\StrictComparator;
use Fsv\SimpleOcr\BitmapFactory;
use Fsv\SimpleOcr\Recognizer;


class RecognizerTest extends PHPUnit_Framework_TestCase
{
    public function testRecognizeImage()
    {
        $recognizer = new Recognizer(
            new BitmapFont(
                BitmapFactory::createFromFile(__DIR__ . '/assets/font.png'),
                new SimpleExtractor(),
                array('+', '-', ',', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9')
            ),
            new SimpleExtractor(),
            new StrictComparator()
        );
        $output = $recognizer->recognize(
            BitmapFactory::createFromFile(__DIR__ . '/assets/test.png')
        );

        $this->assertEquals("+29375637-08-47,\n+381-98-5137533", (string)$output);
    }
}
