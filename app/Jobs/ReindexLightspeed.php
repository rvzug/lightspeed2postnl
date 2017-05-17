<?php

namespace App\Jobs;

use App\LightspeedIndexer\LightspeedReindexer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReindexLightspeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    public $timeout = 60;

    private $model;
    private $resource;
    private $level;
    private $parameters;

    public function __construct($model, $resource, $level = 1, $parameters = array())
    {
        $this->model = $model;
        $this->resource = $resource;
        $this->level = $level;

        if(!isset($parameters["limit"]))
            $parameters["limit"] = 250;

        if(!isset($parameters["page"]))
            $parameters["page"] = 1;

        $this->parameters = $parameters;
    }

    public function handle()
    {
        dump($this->model . ", " . $this->resource . ", " . $this->level .", " . print_r($this->parameters, true));

        $foo = new LightspeedReindexer();
        $response = $foo->reindex($this->model, $this->resource, $this->level, $this->parameters);

        dump($response);

        if($response === true)
        {
            //Log::info('Job Reindex '.$this->resource.' sync succes: '.print_r($response, true));
            return true;
        }
        elseif($response instanceof \WebshopappApiException) {
            dump($response);
            if ($this->attempts() == 3) {
                $this->release(5 * 60);
            }
        }
        elseif(is_float($response))
        {
            $pages = intval($response);

            $model_classname = $this->model;
            $model_classname::truncate();

            for($i=1; $i<=$pages; $i++)
            {
                dispatch(new static($this->model, $this->resource, 2, array("limit" => 250, "page" => $i)));
            }
            $this->delete();
        }
        else {
            return false;
        }
    }

    public function failed(Exception $exception)
    {
        //Log::alert('Job Reindex '.$this->resource.' sync failed: '.print_r($exception, true));
    }
}
