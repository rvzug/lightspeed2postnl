<?php

namespace App;

use App\LightspeedIndexer\LightspeedIndexerGuardedAttributes;
use Illuminate\Database\Eloquent\Model;

class LightspeedVariant extends Model
{
    use LightspeedIndexerGuardedAttributes;

    protected $table = 'lightspeed_variants';
    public $incrementing = false;
    protected $fillable = ['id', 'createdAt', 'updatedAt', 'isDefault', 'sortOrder', 'articleCode', 'ean', 'sku', 'url', 'unitPrice', 'unitUnit', 'priceExcl', 'priceIncl', 'priceCost', 'oldPriceExcl', 'oldPriceIncl', 'stockTracking', 'stockLevel', 'stockAlert', 'stockMinimum', 'stockSold', 'stockBuyMinimum', 'stockBuyMaximum', 'weight', 'weightValue', 'weightUnit', 'volume', 'volumeValue', 'volumeUnit', 'colli', 'sizeX', 'sizeY', 'sizeZ', 'sizeXValue', 'sizeYValue', 'sizeZValue', 'sizeUnit', 'matrix', 'title', 'taxType', 'image', 'options'];
    protected $guarded = ['tax', 'product', 'additionalcost'];
    protected $submodels = ['App\LightspeedProductsImages', 'App\LightspeedProductsRelation', 'App\LightspeedProductsAttribute', 'App\LightspeedProductsMetafield'];

    protected $casts = [
        'image' => 'array',
        'options' => 'array',
    ];

    public function processProduct($product = null)
    {
        if (is_array($product) && (count($product) === 1) && isset($product["resource"]["id"])) {
            $this->product = $product["resource"]["id"];
            return true;
        } else {
            $this->product = 0;
            return true;
        }
    }

    public function processTax($tax = null)
    {
        if (is_array($tax) && (count($tax) === 1) && isset($tax["resource"]["id"])) {
            $this->tax = $tax["resource"]["id"];
            return true;
        } else {
            $this->tax = 0;
            return true;
        }
    }

    public function processAdditionalcost($additionalcost = null)
    {
        if (is_array($additionalcost) && (count($additionalcost) === 1) && isset($additionalcost["resource"]["id"])) {
            $this->additionalcost = $additionalcost["resource"]["id"];
            return true;
        } else {
            $this->additionalcost = 0;
            return true;
        }
    }

}
