<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;
    protected $fillable=[
        'filter_name',
        'created_at',
        'updated_at',
      ];
      public  function filter_value()
      {
          return $this->hasMany(FilterValue::class);
      }
      public function filtervalues()
      {
          return $this->hasManyThrough(
              FilterValue::class,
              ProductFilterValue::class,
              'filter_id', // Foreign key on the environments table...
              'product_filter_id', // Foreign key on the deployments table...
              'id', // Local key on the projects table...
              'id' // Local key on the environments table...
          );
      }
}
