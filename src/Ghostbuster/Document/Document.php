<?php

namespace Ghostbuster\Document;

/**
 * Document
 */
class Document
{

    protected $filename;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->setFilename($filename);
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
}