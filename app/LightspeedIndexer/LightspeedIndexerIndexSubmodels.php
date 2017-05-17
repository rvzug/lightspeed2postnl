<?php

namespace App\LightspeedIndexer;

use App\Jobs\ReindexLightspeed;

trait LightspeedIndexerIndexSubmodels
{

    public function indexSubmodels()
    {
        foreach ($this->subnodels as $relation => $resource) {
            dispatch(new ReindexLightspeed(get_class($this), $resource, $this));
        }
    }
}