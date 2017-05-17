<?php

namespace App;

use App\LightspeedIndexer\LightspeedIndexerGuardedAttributes;
use Illuminate\Database\Eloquent\Model;

class LightspeedTypesAttribute extends Model
{
    use LightspeedIndexerGuardedAttributes;

    protected $table = 'lightspeed_typesattributes';
    public $incrementing = false;
    protected $fillable = ['id', 'sortOrder'];
    protected $guarded = ['type', 'attribute'];

    protected $casts = [
    ];

    public function type(){
        return $this->hasMany('App\LightspeedType', 'id', 'type');
    }

    public function attribute(){
        return $this->hasMany('App\LightspeedAttribute', 'id', 'attribute');
    }

    public function processGuardedAttributes($item = array())
    {
        foreach ($this->guarded as $attribute) {
            if (method_exists($this, 'process' . ucfirst($attribute)))
                $this->{'process' . ucfirst($attribute).''}($item[$attribute]);
        }
    }

    public function processType($type = null)
    {
        if(is_array($type) && (count($type) === 1) && isset($type["resource"]["id"])) {
            $this->type = $type["resource"]["id"];
            return true;
        }
        else{
            $this->type = 0;
            return true;
        }
    }

    public function processAttribute($attribute = null)
{
        if(is_array($attribute) && (count($attribute) === 1) && isset($attribute["resource"]["id"])) {
            $this->attribute = $attribute["resource"]["id"];
            return true;
        }
        else{
            $this->attribute = 0;
            return true;
        }
    }
}
