SimpleOCR
=========

```php
<?php
use Fsv\SimpleOcr\Recognizer;
use Fsv\SimpleOcr\Recognizer\Extractor\SimpleExtractor;
use Fsv\SimpleOcr\Recognizer\Recognizer\StrictRecognizer;

$recognizer = new Recognizer(
    BitmapFont::createFromFile('font.png'),
    new SimpleExtractor(),
    new StrictRecognizer()
);
$recognizer->recognize('input.png');
```