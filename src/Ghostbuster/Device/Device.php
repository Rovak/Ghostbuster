<?php

namespace Ghostbuster\Device;

use Ghostbuster\Renderer\Parameters;

class Device extends AbstractDevice
{
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @param string $name
     */
    public function __construct($name = null)
    {
        if ($name) {
            $this->setName($name);
        }
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Parameters
     */
    public function getParameters()
    {
        return new Parameters(array(
            'sDEVICE' => $this->getName(),
        ));
    }
}