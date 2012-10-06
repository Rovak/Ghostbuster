<?php

namespace Ghostbuster\Device;

use Ghostbuster\Renderer\Parameters;

/**
 * Provides device specific parameters
 */
interface DeviceInterface
{
    /**
     * @return Parameters
     */
    public function getParameters();
}