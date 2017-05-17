<?php

namespace App;

use App\LightspeedIndexer\LightspeedIndexerGuardedAttributes;
use Illuminate\Database\Eloquent\Model;

class LightspeedProductsRelation extends Model
{
    use LightspeedIndexerGuardedAttributes;

    protected $table = 'lightspeed_productrelations';
    public $incrementing = false;
    protected $fillable = ['id', 'product', 'sortOrder'];
    protected $guarded = ['relatedProduct'];

    public function __construct(LightspeedProduct $product)
    {
        $this->product = $product;
    }

    public function product()
    {
        return $this->belongsTo('App\LightspeedProduct', 'product');
    }

    public function relatedProduct()
    {
        return $this->hasOne('App\LightspeedProduct', 'relatedProduct');
    }

    public function processRelatedproduct($relatedproduct = null)
    {
        if(is_array($relatedproduct) && (count($relatedproduct) === 1) && isset($relatedproduct["resource"]["id"])) {
            $this->relatedproduct = $relatedproduct["resource"]["id"];
            return true;
        }
        else{
            $this->relatedProduct = 0;
            return true;
        }
    }
}
