<?php

namespace Ghostbuster\Device;

use Ghostbuster\Renderer\Parameters;

abstract class AbstractDevice
{
    /**
     * @return Parameters
     */
    abstract public function getParameters();
}