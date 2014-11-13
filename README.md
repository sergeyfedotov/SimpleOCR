SimpleOCR
=========

```php
use Fsv\SimpleOcr\BitmapFactory;
use Fsv\SimpleOcr\Recognizer;
use Fsv\SimpleOcr\Comparator\StrictComparator;
use Fsv\SimpleOcr\Extractor\SimpleExtractor;
use Fsv\SimpleOcr\Font\BitmapFont;

$recognizer = new Recognizer(
    new BitmapFont(
        BitmapFactory::createFromFile('font.png'),
        new SimpleExtractor(),
        array('+', '-', ',', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9')
    ),
    new SimpleExtractor(),
    new StrictComparator()
);
print $recognizer->recognize(BitmapFactory::createFromFile('test.png'));
```
