<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;
// use Spatie\Activitylog\LogOptions;
// use Spatie\Activitylog\Models\Activity;
class Module extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'status',
        'created_at',
        'updated_at',
      ];
      public  function permissions()
      {
          return $this->hasMany(Permission::class);
      }
      // public function tapActivity(Activity $activity, string $eventName)
      // {
      //     $activity->ip = request()->ip();
      // }
      // public function getActivitylogOptions(): LogOptions
      // {
          
      //     return LogOptions::defaults()
      //     ->logOnly(['name', 'status']);
      //     // Chain fluent methods for configuration options
      // }
}
