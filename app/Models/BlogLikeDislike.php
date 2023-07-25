<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogLikeDislike extends Model
{
    use HasFactory;
    protected $fillable=[
        'comment_id',
        'like',
        'dislike',
        'user_id',
        'created_at',
        'updated_at',
      ];
}
