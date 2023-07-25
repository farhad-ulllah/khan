<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'comment_id',
        'like',
        'dislike',
        'user_id',
        'created_at',
        'updated_at',
      ];
       public  function like()
      {
          return $this->belongsTo(Comment::class);
      }
}
