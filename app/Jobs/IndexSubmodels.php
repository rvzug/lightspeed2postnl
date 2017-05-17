<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class IndexSubmodels implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    public $timeout = 60;

    private $instance;
    private $relation;
    private $resource;

    public function __construct($instance, $relation, $resource)
    {
        $this->instance = $instance;
        $this->relation = $relation;
        $this->resource = $resource;
    }

    public function handle()
    {
        $foo = new \App\LightspeedIndexer\IndexSubmodels();
        dump("product: ".$this->instance->id);
        dump($foo->getRelation($this->instance, $this->relation, $this->resource));
        return true;

    }

    public function failed(Exception $exception)
    {
        //Log::alert('Job Reindex '.$this->resource.' sync failed: '.print_r($exception, true));
    }

}