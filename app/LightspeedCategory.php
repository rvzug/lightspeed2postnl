<?php

namespace App;

use App\LightspeedIndexer\LightspeedIndexerGuardedAttributes;
use Illuminate\Database\Eloquent\Model;

class LightspeedCategory extends Model
{
    use LightspeedIndexerGuardedAttributes;

    protected $table = 'lightspeed_categories';
    public $incrementing = false;
    protected $fillable = ['id', 'createdAt', 'updatedAt', 'isVisible', 'depth', 'path', 'sortOrder', 'sorting', 'url', 'title', 'fulltitle', 'description', 'content', 'image'];
    protected $guarded = ['parent', 'children', 'products'];

    protected $casts = [
        'path' => 'array',
        'image' => 'array',
    ];

    public function children()
    {
        return $this->hasMany('App\LightspeedCategory', 'parent');
    }

    public function processParent($parent = null)
    {
        if(is_array($parent) && (count($parent) === 1) && isset($parent["resource"]["id"])) {
            $this->parent = $parent["resource"]["id"];
            return true;
        }
        else{
            $this->parent = 0;
            return true;
        }

        return false;

    }



}
