<?php

namespace App;

use App\LightspeedIndexer\LightspeedIndexerGuardedAttributes;
use Illuminate\Database\Eloquent\Model;

class LightspeedVariantsMovement extends Model
{
    use LightspeedIndexerGuardedAttributes;

    protected $table = 'lightspeed_variantmovements';
    public $incrementing = false;
    protected $fillable = ['id', 'createdAt', 'updatedAt', 'channel', 'stockLevelChange'];
    protected $guarded = ['product', 'variant'];
    protected $submodels = ['App\LightspeedProductsImages', 'App\LightspeedProductsRelation', 'App\LightspeedProductsAttribute', 'App\LightspeedProductsMetafield'];

    protected $casts = [
        'image' => 'array',
        'options' => 'array',
    ];

    public function processProduct($product = null)
    {
        if(is_array($product) && (count($product) === 1) && isset($product["resource"]["id"])) {
            $this->product = $product["resource"]["id"];
            return true;
        }
        else{
            $this->product = 0;
            return true;
        }
    }

    public function processVariant($variant = null)
    {
        if(is_array($variant) && (count($variant) === 1) && isset($variant["resource"]["id"])) {
            $this->variant = $variant["resource"]["id"];
            return true;
        }
        else{
            $this->variant = 0;
            return true;
        }
    }
}
