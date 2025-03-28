<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';

    protected $fillable = [
        'title', 'image_url', 'created_at', 'updated_at'
    ];
}
