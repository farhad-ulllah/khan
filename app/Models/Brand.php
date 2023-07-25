<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Brand extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table='brands';
    protected $fillable=[
        'brand_name',
        'description',
        'slug',
        'status',
         'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'created_at',
        'updated_at',
      ];
      protected $guarded=[];
      public function sluggable():array
      {
          return[
              'slug'=>[
                  'source'=>'brand_name'
                     ]
              ];
      }
}
