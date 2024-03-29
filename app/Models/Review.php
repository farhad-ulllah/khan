<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'title',
        'description',
        'created_at',
        'updated_at',
      ];

    //   public function products()
    //   {
    //       return $this->belongsTo(Product::class, 'product_id','id');
    //   }
}
