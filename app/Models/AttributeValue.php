<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $table='attribute_values';
    protected $fillable = [
        'attribute_id',
        'value',
        'created_at'
    ];

    public  function attribute_values()
    {
        return $this->hasMany(Attribute_Values::class);
    }
}
