<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantDeviceToken extends Model
{
    use HasFactory;

    protected $table = 'restaurant_device_token';

    protected $fillable = [
        'restaurant_id', 'device_token', 'created_at', 'updated_at'
    ];
}
