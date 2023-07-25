<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'image',
        'product_id',
        'created_at',
        'updated_at',
      ];
}
