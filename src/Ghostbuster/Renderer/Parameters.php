<?php

namespace Ghostbuster\Renderer;

use ArrayObject;

class Parameters extends ArrayObject
{

    public function merge($merge)
    {
        if ($merge instanceof ArrayObject) {
            $merge = $merge->getArrayCopy();
        }
  
        foreach ($merge as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }
}