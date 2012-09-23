Ghostbuster
===========

PHP wrapper for Ghostscript 

This library is still work in progress and should not be used in a production environment

## Installation

### Using composer

The recommended way is to install this module through composer, do this by adding 
`"rovak/ghostbuster":"dev-master"` to your required libraries and install by running
`php composer.phar install`

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