<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterValue extends Model
{
    use HasFactory;
    protected $fillable=[
        'filter_id',
        'filter_value',
        'created_at',
        'updated_at',
      ];
      // public  function filters_values()
      // {
      //     return $this->hasMany(ProductFilterValue::class);
      // }
}
