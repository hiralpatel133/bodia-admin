<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $table = 'admin_user';

    protected $fillable = [
        'admin_id', 'user_id', 'role', 'created_at', 'updated_at'
    ];
}