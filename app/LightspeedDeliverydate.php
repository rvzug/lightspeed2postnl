<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LightspeedDeliverydate extends Model
{
    protected $table = 'lightspeed_deliverydates';
    public $incrementing = false;
    protected $fillable = ['id', 'createdAt', 'updatedAt', 'name', 'inStockMessage', 'outStockMessage'];

    public function __construct()
    {
    }

}
