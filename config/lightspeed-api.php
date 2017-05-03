<?php

return [

    /*
     * Lightspeed cluser_id
     */
    'cluster_id' => env('SHOPAPI_CLUSTER_ID', 'eu1'), //eu1 or us1

     /*
     * Lightspeed API key
     */
    'api_key' => env('SHOPAPI_API_KEY', 'eu1'),

    /*
     * Lightspeed API secret
     */
    'api_secret' => env('SHOPAPI_API_SECRET', 'eu1'),

    /*
     * Lightspeed Default API Language
     */
    'locale' => env('SHOPAPI_LOCALE', 'nl'),

];
