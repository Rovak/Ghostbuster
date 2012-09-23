<?php

namespace Ghostbuster\Renderer;

/**
 * Create a batch
 */
class Batch extends AbstractRenderer
{
    public function __construct()
    {
        $this->parameters = new Parameters(array(
            'dNOPAUSE',
            'dBATCH',
            'dSAFER'
        ));
    }
}