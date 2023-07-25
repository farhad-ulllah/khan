<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'country',
         'date',
         'flag_icon',
        'created_at',
        'updated_at',
      ];
}
