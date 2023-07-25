<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_id',
        'comment',
        'parent_id',
        'created_at',
        'updated_at',
      ];

      public  function user()
      {
          return $this->belongsTo(User::class);
      }

      public  function product()
      {
          return $this->belongsTo(Product::class);
      }
      public  function replies()
      {
          return $this->hasMany(Comment::class,'parent_id');
      }
      // Likes
   public function likes()
    {
        return $this->hasMany(LikeDislike::class, 'comment_id')->where('like', 1);
    }

    public function dislikes()
    {
        return $this->hasMany(LikeDislike::class, 'comment_id')->where('dislike', 1);
    }

}
