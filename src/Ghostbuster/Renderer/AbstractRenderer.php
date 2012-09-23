<?php

namespace Ghostbuster\Renderer;

use Ghostbuster\Device\AbstractDevice;
use Ghostbuster\Device\PDF as PDFDevice;
use Ghostbuster\Ghost;
use Ghostbuster\Renderer\AbstractRenderer;

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
    protected $elements = array();

    /**
     * @var Parameters
     */
    protected $parameters;

    /**
     * @var AbstractDevice
     */
    protected $device;

    /**
     * @var Ghost
     */
    protected $ghost;

    /**
     * @return AbstractDevice
     */
    public function getDevice()
    {
        if (null == $this->device) {
            $this->device = new PDFDevice();
        }

        return $this->device;
    }

    /**
     * @param AbstractDevice $device
     */
    public function setDevice(AbstractDevice $device)
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
     * @param element $element
     */
    public function add($element)
    {
        $this->elements[] = $element;
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
     * Output to a file
     *
     * @param string|null $filename
     */
    public function output($filename = null)
    {
        $command = new Command();
        $command->addParameters($this->getParameters());
        $command->addParameters($this->getDevice()->getParameters());

        if (null !== $filename) {
            $command->setParameter('sOutputFile', $filename);
        }

        $commands = array($this->getGhost()->getPath());
        $commands[] = $command;
        $commands[] = '"' . getcwd() . '/data/fase/1/1.pdf"';

        return implode(' ', $commands);
    }
}

