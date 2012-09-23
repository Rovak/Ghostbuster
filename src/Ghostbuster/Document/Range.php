<?php

namespace Ghostbuster\Document;

use Ghostbuster\Document\Document;
use Ghostbuster\Renderer\Parameters;

/**
 * A range selection from a document
 */
class Range
{

    /**
     * @var Document
     */
    protected $document;

    /**
     * The page from which this range starts
     *
     * @var integer
     */
    protected $firstPage;

    /**
     * The last page included in this range
     *
     * @var integer
     */
    protected $lastPage;

    /**
     * @param Document $document
     * @param integer|null $firstPage
     * @param integer|null $lastPage
     */
    public function __construct(Document $document, $firstPage, $lastPage)
    {
        $this->document = $document;
        $this->setFirstPage($firstPage);
        $this->setLastPage($lastPage);
    }

    /**
     * @return integer
     */
    public function getFirstPage()
    {
        return $this->firstPage;
    }

    /**
     * Set the first page
     *
     * @param integer $firstPage
     */
    public function setFirstPage($firstPage)
    {
        $this->firstPage = $firstPage;
    }

    /**
     * @return integer
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }

    /**
     * Set the last page
     *
     * @param integer $lastPage
     */
    public function setLastPage($lastPage)
    {
        $this->lastPage = $lastPage;
    }

    /**
     * @return Parameters
     */
    public function getParameters()
    {
        $parameters = new Parameters();

        if (null !== $this->getFirstPage()) {
            $parameters['dFirstPage'] = $this->getFirstPage();
        }

        if (null !== $this->getLastPage()) {
            $parameters['dLastPage'] = $this->getLastPage();
        }

        return $parameters;
    }

    /**
     * @return \Ghostbuster\Renderer\Command
     */
    public function getOutput()
    {
        $command = new \Ghostbuster\Renderer\Command();
        $command->setParameters($this->getParameters());
        $command->addInputFile($this->document->getFilename());

        return $command;
    }
}