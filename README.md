SimpleOCR
=========

```php
<?php
use Fsv\SimpleOcr\Recognizer;
use Fsv\SimpleOcr\Recognizer\BitmapFont;
use Fsv\SimpleOcr\Recognizer\Extractor\SimpleExtractor;
use Fsv\SimpleOcr\Recognizer\Recognizer\StrictRecognizer;

$font = new BitmapFont(
    Bitmap::createFromFile('font.png', 200),
    new SimpleExtractor(),
    array('+', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9')
);

$recognizer = new Recognizer(
    $font,
    new SimpleExtractor(),
    new StrictRecognizer()
);
$recognizer->recognize(Bitmap::createFromFile('input.png'));
```
