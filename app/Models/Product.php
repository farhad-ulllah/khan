<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Product extends Model
{
    use \Conner\Tagging\Taggable;
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'orignal_price',
        'selling_price',
        'cat_id',
        'small_description',
        'qty',
        'tax',
        'status',
        'trending',
        'upcomming',
        'popular',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tags',
        'alt_image',
        'product_attributes',
        'brand_id',
        'video_host',
        'video_link',
        'click_count',
        'ram',
        'storage',
        'battery',
        'ram_storage1',
        'ram_storage2',
        'ram_storage3',
        'ram_storage1_price',
        'ram_storage2_price',
        'ram_storage3_price',

    ];
    // protected $casts=[
    //     'product_attributes'=>'array' 
    //  ];
    // protected static function booted()
    // {
    //     static::saving(function ($product) {
    //         // dd(json_encode(request('product_attributes')));
    //         $product->product_attributes = json_encode(request('product_attributes'));
    //         // $product->save();
    //     });
    // }
  
    protected $guarded=[];
public function sluggable():array
{
    return[
        'slug'=>[
            'source'=>'name'
               ]
        ];
}
   
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id','id');
    }

    //Brands
    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'brand_id','id');
    // }
  

    public  function attribute_values()
    {
        return $this->hasMany(Attribute_Values::class);
    }
    public  function features()
    {
        return $this->hasMany(FeatureValue::class);
    }
    public  function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public  function product_filters()
    {
        return $this->hasMany(ProductFilterValue::class);
    }
    public  function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
     public function commentsWithLikesAndDislikes()
    {
        return $this->comments()->with('likes', 'dislikes','user:id,name')->withCount('likes', 'dislikes');
    }
    public  function commentReply()
    {
        return $this->hasMany(CommentReply::class);
    }
     public function comments_likes()
    {
        // return $this->hasManyThrough(LikeDislike::class,Comment::class);
        return $this->hasManyThrough(
            LikeDislike::class,
            Comment::class,
            'product_id', // Foreign key on the Comment table...
            'comment_id', // Foreign key on the LikeDislike table...
            'id', // Local key on the users table...
            'id' // Local key on the product table...
     );
    }
    public function comments_dislikes()
    {
        // return $this->hasManyThrough(LikeDislike::class,Comment::class);
        return $this->hasManyThrough(
            LikeDislike::class,
            Comment::class,
             'product_id', // Foreign key on the Comment table...
            'comment_id', // Foreign key on the LikeDislike table...
            'id', // Local key on the users table...
            'id' // Local key on the product table...
     );
    }
  
}
