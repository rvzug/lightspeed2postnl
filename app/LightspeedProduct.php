<?php

namespace App;

use App\Events\LightspeedProductSaved;
use App\LightspeedIndexer\LightspeedIndexerGuardedAttributes;
use App\LightspeedIndexer\LightspeedIndexerIndexSubmodels;
use Illuminate\Database\Eloquent\Model;

class LightspeedProduct extends Model
{
    use LightspeedIndexerGuardedAttributes, LightspeedIndexerIndexSubmodels;

    protected $table = 'lightspeed_products';
    public $incrementing = false;
    protected $fillable = ['id', 'createdAt', 'updatedAt', 'isVisible', 'visibility', 'data01', 'data02', 'data03', 'url', 'title', 'fulltitle', 'description', 'content', 'set', 'brand', 'deliverydate', 'image', 'type', 'supplier',];
    protected $guarded = ['brand', 'deliverydate', 'type', 'supplier'];
    public $submodels = [
        'attributes' => 'productsAttributes',
        'images' => 'productsImages',
//        'relations' => 'productsRelations',
    ];
    protected $events = [
        'saved' => LightspeedProductSaved::class,
    ];

    protected $casts = [
        'set' => 'array',
        'image' => 'array',
    ];

    public function categories()
    {
        return $this->hasManyThrough('App\LightspeedCategory', 'App\LightspeedCategoriesProduct', 'product', 'category');
    }

    public function images()
    {
        return $this->hasMany('App\LightspeedProductsImage', 'product');
    }

    public function relations()
    {
        return $this->hasManyThrough('App\LightspeedProduct', 'App\LightspeedProductsRelation', 'relatedProduct', 'product');
    }

    public function metafields()
    {
        return $this->morphMany('App\LightspeedMetafield', 'metafield', 'ownerType', 'ownerId');
    }

    public function reviews()
    {
        return $this->hasMany('App\LightspeedReview', 'product');
    }

    public function type()
    {
        return $this->belongsTo('App\LightspeedType', 'type');
    }

    public function attributes()
    {
        return $this->hasManyThrough('App\LightspeedAttribute', 'App\LightspeedProductAttribute', 'attribute', 'product');
    }

    public function productattributes()
    {
        return $this->hasMany('App\LightspeedProductAttribute', 'product', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\LightspeedSupplier', 'supplier');
    }

    public function tags()
    {
        return $this->hasManyThrough('App\LightspeedTag', 'App\LightspeedTagsProduct', 'tag', 'product');
    }

    public function variants()
    {
        return $this->hasMany('App\LightspeedVariant', 'product');
    }

    public function hasMatrix()
    {
        return true;
    }

    public function processBrand($brand = null)
    {
        if (is_array($brand) && (count($brand) === 1) && isset($brand["resource"]["id"])) {
            $this->brand = $brand["resource"]["id"];
            return true;
        } else {
            $this->brand = 0;
            return true;
        }
    }

    public function processDeliverydate($deliverydate = null)
    {
        if (is_array($deliverydate) && (count($deliverydate) === 1) && isset($deliverydate["resource"]["id"])) {
            $this->deliverydate = $deliverydate["resource"]["id"];
            return true;
        } else {
            $this->deliverydate = 0;
            return true;
        }
    }

    public function processType($type = null)
    {
        if (is_array($type) && (count($type) === 1) && isset($type["resource"]["id"])) {
            $this->type = $type["resource"]["id"];
            return true;
        } else {
            $this->type = 0;
            return true;
        }
    }

    public function processSupplier($supplier = null)
    {
        if (is_array($supplier) && (count($supplier) === 1) && isset($supplier["resource"]["id"])) {
            $this->supplier = $supplier["resource"]["id"];
            return true;
        } else {
            $this->supplier = 0;
            return true;
        }
    }

    public function attachAttributes($intermediate)
    {
        $productId = $this->id;

        $productattribute = new LightspeedProductAttribute([
            'value'=>$intermediate['value'],
            'product'=>$productId,
            'attribute'=>$intermediate['attribute']['id'],
        ]);

        $this->productattributes()->save($productattribute);
    }

    public function detachAttributes()
    {
        LightspeedProductAttribute::where('product', $this->id)->delete();
    }

    public function attachImages($intermediate)
    {
        $productId = $this->id;

        $productimage = new LightspeedProductsImage([
            'id'=>$intermediate['id'],
            'product'=>$productId,
            'sortOrder'=>$intermediate['sortOrder'],
            'createdAt'=>$intermediate['createdAt'],
            'updatedAt'=>$intermediate['updatedAt'],
            'extension'=>$intermediate['extension'],
            'size'=>$intermediate['size'],
            'title'=>$intermediate['title'],
            'thumb'=>$intermediate['thumb'],
            'src'=>$intermediate['src'],
        ]);

        $this->images()->save($productimage);
    }

    public function detachImages()
    {
        LightspeedProductsImage::where('product', $this->id)->delete();
    }
}
