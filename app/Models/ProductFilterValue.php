<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilterValue extends Model
{
    use HasFactory;
    protected $table='product_filter_values';
    protected $fillable=[
        'product_filter_id',
        'product_id',
        'product_filter_value',
        'filter_values_id',
        'created_at',
        'updated_at',
      ];

      public function filteres()
      {
          return $this->belongsTo(Filter::class, 'product_filter_id','id');
      }
}
