Ghostbuster
===========

PHP wrapper for Ghostscript 

This library is still work in progress and should not be used in a production environment

## Installation

### Using composer

You can install this module via [composer](https://getcomposer.org/) by running the following
command in your application's root directory:

```sh
$ ./composer.phar require rovak/ghostbuster
```

## Usage

Documentation will be added when the API is stable


```php
$document = new \Ghostbuster\Document\Document('document.pdf');

$batch = new \Ghostbuster\Renderer\Batch();
$batch->addDocument($document);
$batch->addDocument($document->getRange(1,3));
$batch->addDocument($document->getRange(2,2));

$batch->output('result.pdf');
```