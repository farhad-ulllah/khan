<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable=[
        'feature_name',
        'created_at',
        'updated_at',
        'feature_icon',
      ];
      public  function feature_value()
      {
          return $this->hasMany(FeatureValue::class);
      }
}
