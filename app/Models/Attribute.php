<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'icon',
        'created_at',
    ];
    public  function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    // public function deployments()
    // {
    //     return $this->hasManyThrough(
    //         Attribute_Values::class,
    //         AttributeValue::class,
    //         'attribute_id', // Foreign key on the environments table...
    //         'attribute_value_id', // Foreign key on the deployments table...
    //         'id', // Local key on the projects table...
    //         'id' // Local key on the environments table...
    //     );
    // }
    
}
