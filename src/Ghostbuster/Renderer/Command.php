<?php

namespace Ghostbuster\Renderer;

use Ghostbuster\Renderer\Parameters;

/**
 * Command
 */
class Command
{
    protected $parameters;

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
        $this->getParameters()->offsetSet($key, $value);
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

        return implode(' ', $commands);
    }
}