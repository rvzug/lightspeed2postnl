<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LightspeedCategoriesProduct extends Model
{
    use LightspeedIndexerGuardedAttributes;

    protected $table = 'lightspeed_categoriesproducts';
    public $incrementing = false;
    protected $fillable = ['id', 'sortOrder'];
    protected $guarded = ['category', 'product'];

    protected $casts = [
    ];

    public function category(){
        return $this->hasMany('App\LightspeedCategory', 'id', 'category');
    }

    public function attribute(){
        return $this->hasMany('App\LightspeedProduct', 'id', 'product');
    }

    public function processCategory($category = null)
    {
        if(is_array($category) && (count($category) === 1) && isset($category["resource"]["id"])) {
            $this->category = $category["resource"]["id"];
            return true;
        }
        else{
            $this->category = 0;
            return true;
        }
    }

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
    }}
