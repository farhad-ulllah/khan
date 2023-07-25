<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Blog extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable=[
        'title',
        'description',
        'slug',
        'status',
        'image',
        'alt_image',
        'video',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'cat_id',
        'blog_count',
        'created_at',
        'updated_at',
      ];
      protected $guarded=[];
      public function sluggable():array
      {
          return[
              'slug'=>[
                  'source'=>'title'
                     ]
              ];
      }
      public function category()
      {
          return $this->belongsTo(BlogCategory::class, 'cat_id','id');
      }
        public  function comments()
      {
          return $this->hasMany(BlogComment::class)->whereNull('parent_id');
      }
}
