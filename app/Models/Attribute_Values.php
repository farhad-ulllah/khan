<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute_Values extends Model
{
    use HasFactory;
    protected $table='attributesvalue_values';
    protected $fillable = [
        'group_id',
        'attribute_value_id',
        'product_id',
        'value',
        'created_at'
    ];
    public function valuess()
    {
     return $this->belongsTo(Attribute::class, 'group_id','id');
    }
        public function group_values()
    {
     return $this->belongsTo(AttributeValue::class, 'attribute_value_id','id');
    }

  
}
