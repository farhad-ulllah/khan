<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class BlogCategory extends Model
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
    protected $fillable=[
        'name',
        'description',
        'slug',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_at',
        'updated_at',
      ];
}
