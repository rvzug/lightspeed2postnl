<?php

namespace App;

use App\LightspeedIndexer\LightspeedIndexerGuardedAttributes;
use Illuminate\Database\Eloquent\Model;

class LightspeedType extends Model
{
    use LightspeedIndexerGuardedAttributes;

    protected $table = 'lightspeed_types';
    public $incrementing = false;
    protected $fillable = ['id', 'title'];
    protected $guarded = ['attributes'];

    protected $casts = [
        'path' => 'array',
        'image' => 'array',
    ];

    public function attributes(){
        return $this->belongsToMany('App\LightspeedAttributes', 'lightspeed_typesattributes', 'type', 'attribute');
    }

    public function processAttributes($attributes = null)
    {
        if(is_array($attributes) && (count($attributes) >= 1)) {
            foreach($attributes as $attribute)
            {
                if(isset($attribute["resource"]["id"]))
                    $this->attributes()->attatch($attribute["resource"]["id"]);
            }
            return true;
        }
        else {
            $this->attributes = [];
            return true;
        }
    }
}
