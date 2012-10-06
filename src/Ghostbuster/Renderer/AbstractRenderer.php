<?php

namespace Ghostbuster\Renderer;

use ArrayObject;
use Ghostbuster\Device\DeviceInterface;
use Ghostbuster\Device\PDF as PDFDevice;
use Ghostbuster\Document\Document;
use Ghostbuster\Ghost;
use Ghostbuster\Renderer\AbstractRenderer;
use Ghostbuster\Renderer\Command;

/**
 * Renders ghostscript
 */
abstract class AbstractRenderer
{
    /**
     * Should the renderer escape the console commands
     * @var boolean
     */
    protected $safeMode = true;

    /**
     * @var array
     */
    protected $documents = array();

    /**
     * @var Parameters
     */
    protected $parameters;

    /**
     * @var DeviceInterface
     */
    protected $device;

    /**
     * @var Ghost
     */
    protected $ghost;

    /**
     * @return DeviceInterface
     */
    public function getDevice()
    {
        if (null == $this->device) {
            $this->device = new PDFDevice();
        }

        return $this->device;
    }

    /**
     * @param DeviceInterface $device
     */
    public function setDevice(DeviceInterface $device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @return Ghost
     */
    public function getGhost()
    {
        if (null == $this->ghost) {
            $this->ghost = new Ghost();
        }
        return $this->ghost;
    }

    /**
     *
     * @param Ghost $ghost
     * @return AbstractRenderer
     */
    public function setGhost(Ghost $ghost)
    {
        $this->ghost = $ghost;
        return $this;
    }

    /**
     * @param Document $document
     */
    public function addDocument($document)
    {
        $this->documents[] = $document;
        return $this;
    }

    /**
     * @return ArrayObject
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Retrieve documents
     *
     * @return string
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Run command
     *
     * @param Command $command
     */
    protected function runCommand(Command $command)
    {
        $command->addParameters($this->getParameters());
        $command->addParameters($this->getDevice()->getParameters());

        $cmd = $this->getGhost()->getPath()
            . " " . $command;
    }

    /**
     * Output to a file
     *
     * @param string|null $filename
     */
    public function output($filename)
    {
        $command = new Command();
        $command->addParameters($this->getParameters());
        $command->addParameters($this->getDevice()->getParameters());
        $command->setOutputFile($filename);

        foreach ($this->getDocuments() as $document) {
            $output = $document->getOutput();
            if ($output instanceof Parameters) {
                $command->addParameters($output);
            } elseif ($output instanceof Document) {
                $command->addInputFile($output->getFilename());
            } elseif ($output instanceof Command) {
                $outputFile = dirname($command->getOutputFile()) . '/' . uniqid();
                $output->setOutputFile($outputFile);
                $this->runCommand($output);
                $command->addInputFile($outputFile);
            }
        }

        $this->runCommand($command);

        return $filename;
    }
}

