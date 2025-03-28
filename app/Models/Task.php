<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $fillable = [
        'title', 'description', 'status', 'assigned_to', 'created_at', 'updated_at'
    ];
}
