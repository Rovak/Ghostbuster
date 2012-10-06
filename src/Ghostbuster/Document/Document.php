<?php

namespace Ghostbuster\Document;

use Ghostbuster\Document\Document;

/**
 * Document
 */
class Document
{

    /**
     * @var string
     */
    protected $filename;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->setFilename($filename);
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Retrieve a range fromt this document
     *
     * @param integer|null $first
     * @param integer|null $last
     */
    public function getRange($first = null, $last = null)
    {
        return new Range($this, $first, $last);
    }
    
    /**
     * Return a single page
     * 
     * @param type $pageNumber
     */
    public function getPage($pageNumber)
    {
        return new Range($this, $pageNumber, $pageNumber);
    }

    /**
     * @return Document
     */
    public function getOutput()
    {
        return $this;
    }

}