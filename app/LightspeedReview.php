<?php

namespace App;

use App\LightspeedIndexer\LightspeedIndexerGuardedAttributes;
use Illuminate\Database\Eloquent\Model;

class LightspeedReview extends Model
{
    use LightspeedIndexerGuardedAttributes;

    protected $table = 'lightspeed_reviews';
    public $incrementing = false;
    protected $fillable = ['id', 'createdAt', 'updatedAt', 'isVisible', 'score', 'name', 'content', 'customer', 'language'];
    protected $guarded = ['customer', 'product'];

    protected $casts = [
        'customer' => 'array',
        'language' => 'array',
    ];

    public function product()
    {
        return $this->hasOne('App\LightspeedProduct', 'id', 'product');
    }

    public function processProduct($product = null)
    {
        if(is_array($product) && (count($product) === 1) && isset($product["resource"]["id"])) {
            $this->product = $product["resource"]["id"];
            return true;
        }
        else{
            $this->parent = 0;
            return true;
        }

        return false;
    }
}
