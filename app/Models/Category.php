<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded=[];
public function sluggable():array
{
    return[
        'slug'=>[
            'source'=>'cat_name'
               ]
        ];
}
    protected $table='categories';
    protected $fillable=[
      'name',
      'slug',
       'description',
      'status',
       'popular',
       'image',
      'meta_title',
      'alt_image',
       'meta_descrip',
      'meta_keywords',
      'created_at',
      'updated_at',
    ];
}
