<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantScheduleTime extends Model
{
    use HasFactory;

    protected $table = 'restaurant_schedule_time';

    protected $fillable = [
        'restaurant_id', 'day', 'open_time', 'close_time', 'created_at', 'updated_at'
    ];
}
