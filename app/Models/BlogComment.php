<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    protected $table = 'blogcomments';
    protected $fillable=[
        'user_id',
        'blog_id',
        'comment',
        'parent_id',
        'created_at',
        'updated_at',
      ];

      public  function user()
      {
          return $this->belongsTo(User::class);
      }

      public  function blogs()
      {
          return $this->belongsTo(Blog::class,'blog_id');
      }
      public  function replies()
      {
          return $this->hasMany(BlogComment::class,'parent_id');
      }
      // Likes
    public function likes(){
        return $this->hasMany(BlogLikeDislike::class,'comment_id')->sum('like');
    }
    // Dislikes
    public function dislikes(){
        return $this->hasMany(BlogLikeDislike::class,'comment_id')->sum('dislike');
    }
}
