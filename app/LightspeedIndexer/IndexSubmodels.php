<?php

namespace App\LightspeedIndexer;

use Gunharth\Lightspeed\Lightspeed;

class IndexSubmodels
{
    private $instance;
    private $relation;
    private $resource;

    public function __construct()
    {
    }

    public function getRelation($instance, $relation, $resource)
    {

        $this->instance = $instance;
        $this->relation = $relation;
        $this->resource = $resource;

        dump(get_class($this->instance)."::attach". ucfirst($this->relation));

        if(!method_exists($this->instance, "attach". ucfirst($this->relation)))
            return false;

        if(!method_exists($this->instance, "detach". ucfirst($this->relation)))
            return false;

        try {
            $api = new Lightspeed();
            $count = $api->{$this->resource}()->count($this->instance->id);
            dump($count);

            if($count > 0)
                $items = $api->{$this->resource}()->get($this->instance->id);
            else
                return true;
        }
        catch (\WebshopappApiException $e) {
            return $e;
        }

        //$this->instance->{"detach". ucfirst($this->relation)}();

        foreach ($items as $item)
        {
            $this->instance->{"attach". ucfirst($this->relation)}($item);
        }
        return true;
    }
}
