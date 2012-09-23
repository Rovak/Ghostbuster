<?php

namespace Ghostbuster\Renderer;

use Ghostbuster\Renderer\Parameters;

/**
 * Command
 */
class Command
{

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var array
     */
    protected $inputFiles = array();

    /**
     * Set output file
     *
     * @var string
     */
    protected $outputFile;

    /**
     * @var boolean
     */
    protected $separate;

    /**
     * @return ArrayObject
     */
    public function getParameters()
    {
        if (null == $this->parameters) {
            $this->parameters = new Parameters();
        }

        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        if (!$parameters instanceof Parameters && is_array($parameters)) {
            $parameters = new Parameters($parameters);
        }

        $this->parameters = $parameters;
    }

    /**
     * Add parameters
     *
     * @param array $parameters
     */
    public function addParameters($parameters)
    {
        if (!$parameters instanceof Parameters && is_array($parameters)) {
            $parameters = new Parameters($parameters);
        }

        $this->getParameters()->merge($parameters);
    }

    /**
     * Add parameter
     *
     * @param string $key
     * @param string $value
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * @param string $key
     * @return string
     */
    public function getParameter($key)
    {
        return $this->parameters[$key];
    }

    /**
     * @return boolean
     */
    public function isSeparate()
    {
        return $this->separate;
    }

    /**
     * Is this a seperate Ghostscript call?
     *
     * @param boolean $separate
     */
    public function setSeparate($separate)
    {
        $this->separate = (bool) $separate;
    }

    /**
     * @return array
     */
    public function getInputFiles()
    {
        return $this->inputFiles;
    }

    /**
     * @param array $inputFiles
     */
    public function addInputFile($inputFiles)
    {
        $this->inputFiles[] = $inputFiles;
    }

    /**
     * @return string
     */
    public function getOutputFile()
    {
        return $this->getParameter('sOutputFile');
    }

    /**
     * Set the output file
     *
     * @param string $outputFile
     */
    public function setOutputFile($outputFile)
    {
        $this->setParameter('sOutputFile', $outputFile);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $commands = array();

        foreach ($this->getParameters() as $key => $value) {
            if (is_numeric($key)) {
                $cmd = '-' . $value;
            } else {
                $cmd = sprintf('-%s=%s', $key, $value);
            }

            $commands[] = $cmd;
        }

        /**
         * Append the input file
         */
        foreach ($this->getInputFiles() as $inputFile) {
            $commands[] = $inputFile;
        }

        return implode(' ', $commands);
    }
}