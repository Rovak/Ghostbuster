<?php

namespace Ghostbuster;

/**
 * Ghostscript
 */
class Ghost
{
    /**
     * Command to run ghostscript
     *
     * @var string
     */
    protected $path = 'gs';

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     *
     * @param string $cmd
     */
    public function setPath($cmd)
    {
        $this->path = $cmd;
    }
}