<?php

namespace App\LightspeedIndexer;;

trait LightspeedIndexerGuardedAttributes
{

    public function processGuardedAttributes($item = array())
    {
        foreach ($this->guarded as $attribute) {
            if (method_exists($this, 'process' . ucfirst($attribute)))
                $this->{'process' . ucfirst($attribute).''}($item[$attribute]);
        }
    }
}