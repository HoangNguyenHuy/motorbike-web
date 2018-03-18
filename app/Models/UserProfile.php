<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'phone_number', 'sex', 'address', 'avatar',
    ];
}