<?php

namespace App\LightspeedIndexer;

use Gunharth\Lightspeed\Lightspeed;

class LightspeedReindexer {

    private $model;
    private $resource;
    private $link = null;
    private $level = 1;
    private $parameters = array();

    public function __construct()
    {
    }

    public function reindex($model, $resource, $level = 1, $parameters = array())
    {
        $this->model = $model;
        $this->resource = $resource;
        $this->level = $level;
        $this->parameters = $parameters;

        $api = new Lightspeed();

        if($this->level === 1)
        {
            try {
                $count = $api->{$this->resource}()->count();

                if($count === 0) {
                    return true;
                }
                elseif ($count > 250) {
                    $pages = ceil($count / 250);
                    return $pages;
                }
            }
            catch (\WebshopappApiException $e) {
                return $e;
            }
        }

        try {
            $items = $api->{$this->resource}()->get(null, $this->parameters);
        }
        catch (\WebshopappApiException $e) {
            return $e;
        }

        if($this->level === 1) {
            $model_classname = $this->model;
            $model_classname::truncate();
        }

        foreach ($items as $item) {

            $instance = new $this->model();
            $instance->fill($item);
            if(method_exists($instance, 'processGuardedAttributes'))
                $instance->processGuardedAttributes($item);

            $instance->save();

        }

        return true;
    }

}